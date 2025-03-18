<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch assignments
        $assignments = Assignment::orderBy('created_at', 'desc')->get();

        // Fetch upcoming events sorted by date
        $events = Event::orderBy('event_date', 'asc')->get();

        // Pass data to the view
        return view('dashboard', compact('assignments', 'events'));
    }
}
