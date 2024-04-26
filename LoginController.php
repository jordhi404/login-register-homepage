<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form.
    public function showLoginForm(Request $request){
        return view("login");
    }

    public function login(Request $request){
        // Validate the form data.
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed, redirect to homepage
            return redirect()->route('home')->with('success', 'Login successful!');
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->withErrors([
            'email' => 'User not found!',
        ]);
    }

    // Log the user out.
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
