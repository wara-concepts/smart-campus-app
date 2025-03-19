<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class StudentRegisterController extends Controller
{
    public function showStudentRegistrationForm()
    {
        $courses = Course::all(); // Fetch all courses
        return view('admin.register-student', compact('courses'));
    }

    public function registerStudent(Request $request)
    {

        $request->validate([
            'fname' => 'required|string|max:191',
            'lname' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'fullname' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'nic' => 'required|string|max:12',   
            'phone' => 'required|string|max:20',   
            'dob' => 'required|date',
            'course' => 'required|string|max:191',
        ]);

        // Generate Student ID
        $year = now()->format('y'); // Get last two digits of the year (e.g., 2025 -> 25)
        $prefix = "ST{$year}";

        // Get the highest student ID of the current year
        $lastStudent = Student::where('id', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        // Extract the numeric part and increment
        if ($lastStudent) {
            $lastNumber = (int)substr($lastStudent->id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = "0001";
        }

        $studentID = "{$prefix}{$newNumber}";

        $password = Str::password(16, true, true, true, false);

        // Create user
        $user = User::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($password),
            'usertype' => 'student',
        ]);

        // Create student
        Student::create([
            'user_id' => $user->id,
            'student_id' => $studentID,
            'address' => $request->address,
            'full_name' => $request->fullname,
            'nic' => $request->nic,
            'phone_number' => $request->phone,
            'dob' => $request->dob,
            'course_id' => $request->course,
        ]);

        Mail::raw("You are registered as a student in Smart campus. Your student ID is: $studentID. Your login user name: $user->email and your password: $password", function ($message) use ($user) {
            $message->to($user->email)->subject('You are registered as a student in Smart Campus');
        });

        event(new Registered($user));

        return redirect()->route('register.student.form')->with('success', "Student registered successfully! ID: {$studentID}");
    
    }


}
