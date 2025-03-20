<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $upcomingEvents = Event::where('event_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->get();
            
        $pastEvents = Event::where('event_date', '<', Carbon::today())
            ->orWhere('status', 'completed')
            ->orderBy('event_date', 'desc')
            ->orderBy('start_time')
            ->take(5)
            ->get();
            
        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'max_participants' => 'required|integer|min:0',
            'registration_deadline' => 'nullable|date|before_or_equal:event_date',
        ]);
        
        $event = new Event([
            'title' => $request->title,
            'description' => $request->description,
            'organizer_id' => Auth::id(),
            'location' => $request->location,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_participants' => $request->max_participants,
            'registration_deadline' => $request->registration_deadline ?? $request->event_date,
            'status' => 'active'
        ]);
        
        $event->save();
        
        return redirect()->route('events.show', $event->id)->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $event = Event::with('participants.user')->findOrFail($id);
        $isRegistered = $event->isUserRegistered(Auth::id());
        $isOrganizer = $event->organizer_id === Auth::id();
        
        return view('events.show', compact('event', 'isRegistered', 'isOrganizer'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        
        // Only organizer can edit event
        if ($event->organizer_id !== Auth::id()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are not authorized to edit this event');
        }
        
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        // Only organizer can update event
        if ($event->organizer_id !== Auth::id()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are not authorized to update this event');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'max_participants' => 'required|integer|min:0',
            'registration_deadline' => 'nullable|date|before_or_equal:event_date',
            'status' => 'required|in:active,canceled,completed'
        ]);
        
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_participants' => $request->max_participants,
            'registration_deadline' => $request->registration_deadline ?? $request->event_date,
            'status' => $request->status
        ]);
        
        return redirect()->route('events.show', $event->id)->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        // Only organizer can delete event
        if ($event->organizer_id !== Auth::id()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are not authorized to delete this event');
        }
        
        $event->delete();
        
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
    
    /**
     * Register current user to event
     */
    public function register($id)
    {
        $event = Event::findOrFail($id);
        $userId = Auth::id();
        
        // Check if already registered
        if ($event->isUserRegistered($userId)) {
            return redirect()->route('events.show', $event->id)
                ->with('info', 'You are already registered for this event');
        }
        
        // Check if event is full
        if ($event->max_participants > 0 && $event->participant_count >= $event->max_participants) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'This event has reached its maximum number of participants');
        }
        
        // Check if registration deadline has passed
        if (Carbon::parse($event->registration_deadline)->isPast()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'Registration for this event has closed');
        }
        
        // Register the user
        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => $userId,
            'registration_date' => now(),
            'attendance_status' => 'registered'
        ]);
        
        return redirect()->route('events.show', $event->id)
            ->with('success', 'You have successfully registered for this event!');
    }
    
    /**
     * Unregister current user from event
     */
    public function unregister($id)
    {
        $event = Event::findOrFail($id);
        $userId = Auth::id();
        
        $participant = EventParticipant::where('event_id', $event->id)
            ->where('user_id', $userId)
            ->first();
            
        if (!$participant) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are not registered for this event');
        }
        
        // Allow unregistering only if event has not passed
        if (Carbon::parse($event->event_date)->isPast()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'Cannot unregister from a past event');
        }
        
        $participant->delete();
        
        return redirect()->route('events.show', $event->id)
            ->with('success', 'You have successfully unregistered from this event');
    }
    
    /**
     * Mark attendance for participants
     */
    public function attendance($id)
    {
        $event = Event::with('participants.user')->findOrFail($id);
        
        // Only organizer can mark attendance
        if ($event->organizer_id !== Auth::id()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are not authorized to manage attendance');
        }
        
        return view('events.attendance', compact('event'));
    }
    
    /**
     * Update attendance status
     */
    public function updateAttendance(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        // Only organizer can update attendance
        if ($event->organizer_id !== Auth::id()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'You are not authorized to update attendance');
        }
        
        $request->validate([
            'attendance' => 'required|array',
            'attendance.*' => 'in:attended,absent',
        ]);
        
        foreach ($request->attendance as $participantId => $status) {
            $participant = EventParticipant::find($participantId);
            if ($participant && $participant->event_id == $id) {
                $participant->attendance_status = $status;
                $participant->save();
            }
        }
        
        return redirect()->route('events.show', $event->id)
            ->with('success', 'Attendance updated successfully!');
    }
    
    /**
     * Display my events (organized and participated)
     */
    public function myEvents()
    {
        $userId = Auth::id();
        
        $organizedEvents = Event::where('organizer_id', $userId)
            ->orderBy('event_date', 'desc')
            ->get();
            
        $participatedEvents = Event::whereHas('participants', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('event_date', 'desc')
            ->get();
            
        return view('events.my-events', compact('organizedEvents', 'participatedEvents'));
    }
}
