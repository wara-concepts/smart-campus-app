<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\department;


class adminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function viewusers()
    {
        // Fetch all users with roles
        $adminUsers = User::where('usertype', 'admin')->get();
        return view('admin.view-admin-users', compact('adminUsers'));
    }

    public function viewstudents()
    {
        $students = User::where('usertype', 'student')->with('student')->get();
        return view('admin.view-students', compact('students'));
    }

    public function viewlecturers()
    {
        $lecturers = User::where('usertype', 'lecturer')->with('lecturer')->get();
        return view('admin.view-lecturers', compact('lecturers'));
    }


    public function edit(User $user)
    {
        
        return view('admin.edit-admin', compact('user'));
    }

    public function editstudent($id)
    {
        $courses = Course::all();
        $user = User::with('student')->findOrFail($id);
        return view('admin.edit-student', compact('user', 'courses'));
    }

    public function editlecturer($id)
    {
        $departments = department::all();
        $user = User::with('lecturer')->findOrFail($id);
        return view('admin.edit-lecturer', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return redirect()->route('view.users')->with('success', 'User updated successfully');
    }

    public function updatestudent(Request $request, User $user)
{

    

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'address' => 'required|string|max:191',
        'phone_number' => 'required|string|max:20',
        'dob' => 'required|date',
        'course_id' => 'required|string|max:255',
        'full_name' => 'required|string|max:191',
        'nic' => 'required|string|max:12',
    ]);

    // Update User Table
    $user->update($request->only(['first_name', 'last_name', 'email']));

    // Update Student Table
    if ($user->student) {
        
        $user->student->update($request->only(['full_name', 'nic', 'dob', 'course_id', 'address', 'phone_number']));
        
    }

    return redirect()->route('view.students')->with('success', 'User updated successfully');
}

public function updatelecturer(Request $request, User $user)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'address' => 'required|string|max:191',
        'phone_number' => 'required|string|max:20',
        'dob' => 'required|date',
        'department_id' => 'required|string|max:255',
        'full_name' => 'required|string|max:191',
        'nic' => 'required|string|max:12',
    ]);

    // Update User Table
    $user->update($request->only(['first_name', 'last_name', 'email']));

    // Update Lecturer Table
    if ($user->lecturer) {
        $user->lecturer->update($request->only(['full_name', 'nic', 'dob', 'department_id', 'address', 'phone_number']));
    }

    return redirect()->route('view.lecturers')->with('success', 'User updated successfully');
}



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('view.users')->with('success', 'User deleted successfully');
    }


    public function destroystudent($id)
    {
        $user = User::findOrFail($id);
        if ($user->student) {
            $user->student->delete(); // Delete student record
        }
        $user->delete(); // Delete user record

        return redirect()->route('view.students')->with('success', 'User deleted successfully');
    }

    public function destroylecturer($id)
    {
        $user = User::findOrFail($id);
        if ($user->lecturer) {
            $user->lecturer->delete(); // Delete lecturer record
        }
        $user->delete(); // Delete user record

        return redirect()->route('view.lecturers')->with('success', 'User deleted successfully');
    }
}
