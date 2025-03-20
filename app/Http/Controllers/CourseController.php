<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(5);
        return view('courses', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
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

        $materials = [];

        if ($request->hasFile('materials')) {
            foreach ($request->file('materials') as $file) {
                $path = $file->store('materials', 'public');
                $materials[] = [
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ];
            }
        }

        // Store as JSON in DB if needed
        Course::create([
            'name' => $request->name,
            'code' => $request->code,
            'credits' => $request->credits,
            'description' => $request->description,
            'materials' => json_encode($materials), // Ensure JSON storage
        ]);

        return redirect()->route('courses')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
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

        // Store uploaded files
        if ($request->hasFile('materials')) {
            $existingMaterials = json_decode($course->materials, true) ?? [];

            foreach ($request->file('materials') as $file) {
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('materials', $filename, 'public');

                $existingMaterials[] = [
                    'title' => $filename,
                    'file_path' => $path,
                ];
            }

            $course->update([
                'materials' => json_encode($existingMaterials),
            ]);
        }

        return redirect()->route('courses.show', $course->id)->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses')->with('success', 'Course deleted successfully.');
    }
}
