<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class adminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function viewusers()
    {
        // Fetch all users with roles
        $users = User::all();
        return view('admin.view-users', compact('users'));
    }
}
