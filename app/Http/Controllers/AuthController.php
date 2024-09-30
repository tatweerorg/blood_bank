<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('views.login');  // تأكد من أن ملف blade الخاص بصفحة تسجيل الدخول موجود في resources/views/login.blade.php
    }

    
 
        // Log the validated input data for debugging purposes
        public function login(Request $request)
        {
            // Validate the input data
            $validatedData = $request->validate([
                'Email' => 'required|email',
                'Password' => 'required|string|min:8',
            ]);
        
            // Attempt to authenticate the user
            if (Auth::attempt(['Email' => $request->Email, 'Password' =>  Hash::make($request->Password)]))
             {
                // If authentication was successful, redirect to the dashboard or another protected route
                return redirect()->intended('dashboard')->with('success', 'Login successful!');
            }
        
            // If authentication fails, redirect back with an error message
            return back()->with('error', 'Invalid email or password.');
        }
        
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out !');
    }
 
}
