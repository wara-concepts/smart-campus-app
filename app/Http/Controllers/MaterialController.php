<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'materials.*' => 'file|mimes:pdf,doc,docx,ppt,pptx|max:20240', 
        ]);

        $course = Course::findOrFail($courseId);

        if ($request->hasFile('materials')) {
            foreach ($request->file('materials') as $file) {
                $path = $file->store('materials', 'public'); 

                Material::create([
                    'course_id' => $course->id,
                    'filename' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('courses.show', $courseId)->with('success', 'Materials uploaded successfully.');
    }

    public function show($courseId)
    {
        $course = Course::with('materials')->findOrFail($courseId);
        return view('courses.show', compact('course'));
    }
}
