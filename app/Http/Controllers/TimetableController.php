<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Course;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with('course')->get();
        return view('timetable', compact('timetables'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('timetable.create', compact('courses'));
    }

    public function store(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'day' => 'required|string',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'instructor' => 'required|string',
        'location' => 'required|string',
    ]);

    Timetable::create([
        'course_id' => $request->course_id,
        'day' => $request->day,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'instructor' => $request->instructor,
        'location' => $request->location,
    ]);

    return redirect()->route('timetable')->with('success', 'Timetable entry added successfully.');
}

    public function edit(Timetable $timetable)
    {
        $courses = Course::all();
        return view('timetable.edit', compact('timetable', 'courses'));
    }

    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'nullable|string',
            'instructor' => 'nullable|string',
            'room' => 'nullable|string'
        ]);

        $timetable->update($request->all());

        return redirect()->route('timetable')->with('success', 'Timetable updated successfully.');
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return redirect()->route('timetable')->with('success', 'Timetable entry deleted successfully.');
    }
}