<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('course')->get();
        return view('assignments', compact('assignments'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('assignments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:Pending,Completed',
            'deadline' => 'required|date',
            'submission' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $submissionPath = null;
        if ($request->hasFile('submission')) {
            $submissionPath = $request->file('submission')->store('submissions');
        }

        Assignment::create([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'submission' => $submissionPath
        ]);

        return redirect()->route('assignments.create')->with('success', 'Assignment added successfully!');
    }

    public function edit(Assignment $assignment)
    {
        $courses = Course::all();
        return view('assignments.edit', compact('assignment', 'courses'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:Pending,Completed',
            'deadline' => 'required|date',
            'submission' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('submission')) {
            if ($assignment->submission) {
                Storage::delete($assignment->submission);
            }
            $assignment->submission = $request->file('submission')->store('submissions');
        }

        $assignment->update([
            'title' => $request->title,
            'course_id' => $request->course_id,
            'status' => $request->status,
            'deadline' => $request->deadline
        ]);

        return redirect()->route('assignments')->with('success', 'Assignment updated successfully!');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->submission) {
            Storage::delete($assignment->submission);
        }
        $assignment->delete();
        return redirect()->route('dashboard')->with('success', 'Assignment deleted successfully!');
    }
}
