<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
{
    $announcements = Announcement::all(); // Fetch announcements from DB
    return view('announcements', compact('announcements'));
}

}