<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Resource;
use App\Models\ResourceReservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ResourceReservationController extends Controller
{
    /**
     * Display the resource reservation page.
     */
    public function index()
    {
        $departments = Department::all();
        $resources = Resource::all();
        
        // Get user's active reservations
        $user = Auth::user();
        $reservations = ResourceReservation::where('user_id', $user->id)
            ->where('handover_dateTime', '>=', now())
            ->orderBy('request_dateTime')
            ->get();
            
        return view('resource-reservation.index', compact('departments', 'resources', 'reservations'));
    }
    
    /**
     * Get resources by department
     */
    public function getResourcesByDepartment(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);
        
        $resources = Resource::where('department_id', $request->department_id)->get();
        return response()->json($resources);
    }
    
    /**
     * Check resource availability
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'resource_id' => 'required|exists:resources,id',
            'request_date' => 'required|date|after_or_equal:today',
            'request_time' => 'required',
            'handover_date' => 'required|date|after_or_equal:request_date',
            'handover_time' => 'required',
            'qty' => 'required|integer|min:1'
        ]);
        
        // Create datetime objects
        $requestDateTime = Carbon::parse($request->request_date . ' ' . $request->request_time);
        $handoverDateTime = Carbon::parse($request->handover_date . ' ' . $request->handover_time);
        
        // Validate handover time is after request time
        if ($requestDateTime->greaterThanOrEqualTo($handoverDateTime)) {
            return response()->json([
                'available' => false,
                'message' => 'Handover time must be after request time'
            ]);
        }
        
        $resource = Resource::find($request->resource_id);
        $availableQty = $resource->getAvailableQuantity($requestDateTime, $handoverDateTime);
        
        return response()->json([
            'available' => $availableQty >= $request->qty,
            'availableQty' => $availableQty,
            'requestedQty' => $request->qty,
            'message' => $availableQty >= $request->qty 
                ? 'Resource available for the selected time period' 
                : 'Not enough quantity available for the selected time period'
        ]);
    }
    
    /**
     * Store a new reservation
     */
    public function store(Request $request)
    {
        $request->validate([
            'resource_id' => 'required|exists:resources,id',
            'request_date' => 'required|date|after_or_equal:today',
            'request_time' => 'required',
            'handover_date' => 'required|date|after_or_equal:request_date',
            'handover_time' => 'required',
            'qty' => 'required|integer|min:1',
            'purpose' => 'required|string|max:255'
        ]);
        
        // Create datetime objects
        $requestDateTime = Carbon::parse($request->request_date . ' ' . $request->request_time);
        $handoverDateTime = Carbon::parse($request->handover_date . ' ' . $request->handover_time);
        
        // Validate handover time is after request time
        if ($requestDateTime->greaterThanOrEqualTo($handoverDateTime)) {
            return back()->with('error', 'Handover time must be after request time');
        }
        
        $resource = Resource::find($request->resource_id);
        $availableQty = $resource->getAvailableQuantity($requestDateTime, $handoverDateTime);
        
        if ($availableQty < $request->qty) {
            return back()->with('error', 'Not enough quantity available for the selected time period');
        }
        
        // Create the reservation
        $user = Auth::user();
        $reservation = ResourceReservation::create([
            'resource_id' => $request->resource_id,
            'user_id' => $user->id,
            'request_dateTime' => $requestDateTime,
            'handover_dateTime' => $handoverDateTime,
            'status' => 'pending',
            'qty' => $request->qty,
            'purpose' => $request->purpose
        ]);
        
        return redirect()->route('resource-reservation.index')->with('success', 'Reservation request submitted successfully!');
    }
    
    /**
     * Cancel a reservation
     */
    public function cancel($id)
    {
        $user = Auth::user();
        $reservation = ResourceReservation::findOrFail($id);
        
        // Check if the reservation belongs to the user
        if ($reservation->user_id != $user->id) {
            return back()->with('error', 'You are not authorized to cancel this reservation');
        }
        
        // Check if the reservation can still be canceled (not already started)
        if (Carbon::parse($reservation->request_dateTime)->isPast()) {
            return back()->with('error', 'Cannot cancel a reservation that has already started');
        }
        
        $reservation->status = 'canceled';
        $reservation->save();
        
        return redirect()->route('resource-reservation.index')->with('success', 'Reservation canceled successfully');
    }
    
    /**
     * Display user's reservation history
     */
    public function history()
    {
        $user = Auth::user();
        $reservations = ResourceReservation::where('user_id', $user->id)
            ->orderBy('request_dateTime', 'desc')
            ->get();
            
        return view('resource-reservation.history', compact('reservations'));
    }
}