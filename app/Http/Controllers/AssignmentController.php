<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('assignments'));
    }

    public function create()
    {
        return view('assignments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'status' => 'required|in:Pending,Completed',
        ]);

        Assignment::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Assignment added successfully!');
    }
}

