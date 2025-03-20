<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        })->paginate(5);

        return view('courses', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with('materials')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:courses',
            'credits' => 'required|integer',
            'description' => 'nullable',
            'materials' => 'nullable|array',
            'materials.*' => 'file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
        ]);

        $course = Course::create([
            'name' => $request->name,
            'code' => $request->code,
            'credits' => $request->credits,
            'description' => $request->description,
        ]);

        if ($request->hasFile('materials')) {
            foreach ($request->file('materials') as $file) {
                $path = $file->store('materials', 'public');
                Material::create([
                    'course_id' => $course->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('courses')->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        $course = Course::with('materials')->findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'credits' => 'required|integer',
            'description' => 'nullable|string',
            'materials.*' => 'file|mimes:pdf,doc,docx,ppt,pptx,jpg,png,jpeg|max:2048',
        ]);

        $course->update([
            'name' => $request->name,
            'code' => $request->code,
            'credits' => $request->credits,
            'description' => $request->description,
        ]);

        if ($request->hasFile('materials')) {
            foreach ($request->file('materials') as $file) {
                $filename = $file->hashName();
                $path = $file->storeAs('materials', $filename, 'public');

                Material::create([
                    'course_id' => $course->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('courses.show', $course->id)->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $materials = Material::where('course_id', $course->id)->get();

        foreach ($materials as $material) {
            Storage::disk('public')->delete($material->file_path);
            $material->delete();
        }

        $course->delete();

        return redirect()->route('courses')->with('success', 'Course deleted successfully.');
    }
}
