<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Generate a 4-digit random code
        $code = rand(1000, 9999);
        $user->two_factor_code = $code;
        $user->save();

        // Send email with the code
        Mail::raw("Your two-factor code is $code", function ($message) use ($user) {
            $message->to($user->email)->subject('Two-Factor Code');
        });

        return view('auth.two-factor');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);

        $user = Auth::user();

        if ($request->code == $user->two_factor_code) {
            // Mark as authenticated and clear the code
            session(['two_factor_authenticated' => true]);
            $user->two_factor_code = null;
            $user->save();


            if (Auth::user()->usertype == 'lecturer') {

                return redirect()->intended('/lecturer/dashboard');

            } elseif (Auth::user()->usertype == 'admin') {

                return redirect()->intended('/admin/dashboard');

            } elseif (Auth::user()->usertype == 'student') {

                return redirect()->intended('/dashboard');

            }

        }

        return redirect()->route('two-factor.index')->withErrors(['code' => 'The provided code is incorrect.']);
    }
}
