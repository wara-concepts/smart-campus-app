<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\student\studentController;
use App\Http\Controllers\lecturer\lecturerController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\StudentRegisterController;
use App\Http\Controllers\admin\LecturerRegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ResourceReservationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [Controller::class, 'showWelcomePage'])->name('welcomepage');
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});

Route::middleware('auth')->group(function () {
    // Resource Reservation routes
    Route::get('/resource-reservation', [ResourceReservationController::class, 'index'])->name('resource-reservation.index');
    Route::post('/resource-reservation', [ResourceReservationController::class, 'store'])->name('resource-reservation.store');
    Route::get('/resource-reservation/history', [ResourceReservationController::class, 'history'])->name('resource-reservation.history');
    Route::put('/resource-reservation/{id}/cancel', [ResourceReservationController::class, 'cancel'])->name('resource-reservation.cancel');
    Route::post('/resource-reservation/check-availability', [ResourceReservationController::class, 'checkAvailability'])->name('resource-reservation.check-availability');
    Route::get('/resource-reservation/resources-by-department', [ResourceReservationController::class, 'getResourcesByDepartment'])->name('resource-reservation.resources-by-department');
});

// Event Management Routes
Route::middleware(['auth'])->group(function () {
    // Basic event routes
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Event registration routes
    Route::post('/events/{id}/register', [EventController::class, 'register'])->name('events.register');
    Route::post('/events/{id}/unregister', [EventController::class, 'unregister'])->name('events.unregister');

    // Attendance management routes
    Route::get('/events/{id}/attendance', [EventController::class, 'attendance'])->name('events.attendance');
    Route::post('/events/{id}/attendance', [EventController::class, 'updateAttendance'])->name('events.update-attendance');

    // My events route
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my');
});

Route::middleware('auth', 'twofactor')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
});

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');

    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::resource('courses', CourseController::class);

    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');

    Route::resource('timetable', TimetableController::class);
    Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable');
});


Route::middleware(['auth', 'twofactor', 'studentMiddleware'])->group(function () {
    Route::get('/dashboard', [studentController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'twofactor', 'lecturerMiddleware'])->group(function () {
    Route::get('/lecturer/dashboard', [lecturerController::class, 'index'])->name('lecturer.dashboard');
});

Route::middleware(['auth', 'twofactor', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [adminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/register-student', [StudentRegisterController::class, 'showStudentRegistrationForm'])->name('register.student.form');
    Route::post('/admin/register-student', [StudentRegisterController::class, 'registerStudent'])->name('register.student');
    Route::get('/admin/register-lecturer', [LecturerRegisterController::class, 'showLecturerRegistrationForm'])->name('register.lecturer.form');
    Route::post('/admin/register-lecturer', [LecturerRegisterController::class, 'registerLecturer'])->name('register.lecturer');

});


// Academics Section
Route::get('/courses', [CourseController::class, 'index'])->name('courses')->middleware('auth');
Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable')->middleware('auth');
Route::get('/results', [ResultsController::class, 'index'])->name('results')->middleware('auth');



