<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show the registration form.
    public function showRegistrationForm() {
        return view("register");
    }

    public function register(Request $request){
        // Validate the form data.
        $request -> validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user.
        User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login page.
        return redirect()->route('login')->with('success','User registered! Please login to continue.');
    }
}
