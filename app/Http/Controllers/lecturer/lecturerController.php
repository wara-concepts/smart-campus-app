<?php

namespace App\Http\Controllers\lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class lecturerController extends Controller
{
    public function index(){
        return view('lecturer.dashboard');
    }
}
