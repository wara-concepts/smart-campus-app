<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    // Store uploaded materials
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

    // Show course materials
    public function show($courseId)
    {
        $course = Course::with('materials')->findOrFail($courseId);
        return view('courses.show', compact('course'));
    }

    // Delete material
    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($material->file_path);

        // Delete the material record from the database
        $material->delete();

        return redirect()->back()->with('success', 'Material deleted successfully.');
    }
}
