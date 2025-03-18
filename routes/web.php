<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourcesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});

Route::middleware('auth', 'twofactor')->group(function () {
    // Single dashboard route that fetches assignments & events
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update.picture');

    // Resources
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');

    // Announcements
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');

    // Courses
    Route::resource('courses', CourseController::class);
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');

    // Timetable
    Route::resource('timetable', TimetableController::class);
    Route::post('/timetable', [TimetableController::class, 'store'])->name('timetable.store');

    // Assignments
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');

    // Events
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});

// Academics Section
Route::get('/courses', [CourseController::class, 'index'])->name('courses')->middleware('auth');
Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable')->middleware('auth');

require __DIR__.'/auth.php';
