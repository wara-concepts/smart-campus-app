<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all(); 
        return view('announcements', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'publish_date' => 'required|date',
            'content' => 'required',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('announcements', 'public'); 
            $data['attachment'] = $filePath;
        }

        Announcement::create($data);

        return redirect()->route('announcements')->with('success', 'Announcement added successfully!');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'publish_date' => 'required|date',
            'content' => 'required',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048'
        ]);

        $announcement = Announcement::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('attachment')) {
            if ($announcement->attachment) {
                Storage::disk('public')->delete($announcement->attachment);
            }
            $filePath = $request->file('attachment')->store('announcements', 'public');
            $data['attachment'] = $filePath;
        }

        $announcement->update($data);

        return redirect()->route('announcements')->with('success', 'Announcement updated successfully!');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('announcements')->with('success', 'Announcement deleted successfully!');
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show', compact('announcement'));
    }
    
    public function download($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->attachment) {
            $filePath = $announcement->attachment; 
            
            if (Storage::disk('public')->exists($filePath)) {
                return Storage::disk('public')->download($filePath);
            } else {
                return redirect()->back()->with('error', 'File not found.');
            }
        }

        return redirect()->back()->with('error', 'No attachment found.');
    }
}