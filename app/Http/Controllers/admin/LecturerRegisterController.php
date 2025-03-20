<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class LecturerRegisterController extends Controller
{
    public function showLecturerRegistrationForm()
    {
        $departments = department::all(); // Fetch all departments
        return view('admin.register-lecturer', compact('departments'));
    }

    public function registerLecturer(Request $request)
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
            'department' => 'required|string|max:191',
        ]);

        // Generate Lecturer ID
        $year = now()->format('y'); // Get last two digits of the year (e.g., 2025 -> 25)
        $prefix = "LT{$year}";

        // Get the highest lecturer ID of the current year
        $lastLecturer = Lecturer::where('id', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        // Extract the numeric part and increment
        if ($lastLecturer) {
            $lastNumber = (int)substr($lastLecturer->id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = "0001";
        }

        $lecturerID = "{$prefix}{$newNumber}";

        $password = Str::password(16, true, true, true, false);

        // Create user
        $user = User::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($password),
            'usertype' => 'lecturer',
        ]);

        // Create student
        Lecturer::create([
            'user_id' => $user->id,
            'id' => $lecturerID,
            'address' => $request->address,
            'full_name' => $request->fullname,
            'nic' => $request->nic,
            'phone_number' => $request->phone,
            'dob' => $request->dob,
            'department_id' => $request->department,
        ]);

        Mail::raw("You are registered as a lecturer in Smart campus. Your lecturer ID is: $lecturerID. Your login user name: $user->email and your password: $password", function ($message) use ($user) {
            $message->to($user->email)->subject('You are registered as a lecturer in Smart Campus');
        });

        event(new Registered($user));

        return redirect()->route('register.lecturer.form')->with('success', "Lecturer registered successfully! ID: {$lecturerID}");
    
    }


}
