<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourcesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\ResourceController;
<<<<<<< Updated upstream
use App\Http\Controllers\student\studentController;
use App\Http\Controllers\lecturer\lecturerController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\StudentRegisterController;
=======
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\AnnouncementController;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});

Route::middleware('auth', 'twofactor')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/resources',[ResourceController::class,'index'])->name('resources');
    Route::get('/announcements', [AnnouncementsController::class, 'index'])->name('announcements');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::resource('courses', CourseController::class);
});

<<<<<<< Updated upstream
Route::middleware('auth','twofactor', 'studentMiddleware')->group(function () {
    Route::get('/dashboard', [studentController::class, 'index'])->name('dashboard');
});

Route::middleware('auth','twofactor', 'lecturerMiddleware')->group(function () {
    Route::get('/lecturer/dashboard', [lecturerController::class, 'index'])->name('lecturer.dashboard');
});

Route::middleware('auth','twofactor', 'adminMiddleware')->group(function () {
    Route::get('/admin/dashboard', [adminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/register-student', [StudentRegisterController::class, 'showStudentRegistrationForm'])->name('register.student.form');
    Route::post('/register-student', [StudentRegisterController::class, 'registerStudent'])->name('register.student');

});
=======
// Academics Section
Route::get('/courses', [CourseController::class, 'index'])->name('courses')->middleware('auth');
Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable')->middleware('auth');
Route::get('/results', [ResultsController::class, 'index'])->name('results')->middleware('auth');
>>>>>>> Stashed changes

require __DIR__.'/auth.php';


