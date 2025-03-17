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
            'day' => 'required',
            'time' => 'required',
            'course_id' => 'required',
            'instructor' => 'required',
            'room' => 'required'
        ]);

        Timetable::create($request->all());

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
            'day' => 'required',
            'time' => 'required',
            'course_id' => 'required',
            'instructor' => 'required',
            'room' => 'required'
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