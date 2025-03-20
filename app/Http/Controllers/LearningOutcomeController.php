<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use App\Models\Course;
use Illuminate\Http\Request;

class LearningOutcomeController extends Controller
{
    /**
     * Display a listing of the learning outcomes for a specific course.
     */
    public function index($courseId)
    {
        $course = Course::with('learningOutcomes')->findOrFail($courseId);
        return view('learning_outcomes.index', compact('course'));
    }

    /**
     * Show the form for creating a new learning outcome.
     */
    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('learning_outcomes.create', compact('course'));
    }

    /**
     * Store a newly created learning outcome in storage.
     */
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        LearningOutcome::create([
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $courseId, // Link to the course
        ]);

        return redirect()->route('courses.show', $courseId)->with('success', 'Learning Outcome added successfully.');
    }

    /**
     * Show the form for editing a specific learning outcome.
     */
    public function edit($id)
    {
        $learningOutcome = LearningOutcome::findOrFail($id);
        return view('learning_outcomes.edit', compact('learningOutcome'));
    }

    /**
     * Update the specified learning outcome.
     */
    public function update(Request $request, $id)
    {
        $learningOutcome = LearningOutcome::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $learningOutcome->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('courses.show', $learningOutcome->course_id)->with('success', 'Learning Outcome updated successfully.');
    }

    /**
     * Remove the specified learning outcome.
     */
    public function destroy($id)
    {
        $learningOutcome = LearningOutcome::findOrFail($id);
        $courseId = $learningOutcome->course_id;
        $learningOutcome->delete();

        return redirect()->route('courses.show', $courseId)->with('success', 'Learning Outcome deleted.');
    }
}
