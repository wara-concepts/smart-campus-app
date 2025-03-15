<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class StudentRegisterController extends Controller
{
    public function showStudentRegistrationForm()
    {
        return view('admin.register-student');
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'course' => 'required|string|max:255',
        ]);

        // Generate Student ID
        $year = now()->format('y'); // Get last two digits of the year (e.g., 2025 -> 25)
        $prefix = "ST{$year}";

        // Get the highest student ID of the current year
        $lastStudent = Student::where('student_id', 'LIKE', "{$prefix}%")
            ->orderBy('student_id', 'desc')
            ->first();

        // Extract the numeric part and increment
        if ($lastStudent) {
            $lastNumber = (int)substr($lastStudent->student_id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = "0001";
        }

        $studentID = "{$prefix}{$newNumber}";

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        // Create student
        Student::create([
            'user_id' => $user->id,
            'student_id' => $studentID,
            'address' => $request->address,
            'dob' => $request->dob,
            'course' => $request->course,
        ]);

        event(new Registered($user));

        return redirect()->route('student.dashboard')->with('success', "Student registered successfully! ID: {$studentID}");
    
    }
}
