<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
            if (Auth::attempt(['Email' => $request->Email, 'Password' =>  $request->Password]))
             {
                // If authentication was successful, redirect to the dashboard or another protected route
                return redirect()->route('dashboard')->with('success', 'Login successful!');
            }
        
            // // If authentication fails, redirect back with an error message
            return back()->with('error', 'Invalid email or password.');
        }
        
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out !');
    }
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email'); // The view where user enters email
    }

    // Send the reset link to the user
    public function sendResetEmail(Request $request) 
    {
       
        // Validate email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
       
        try {
            
            \DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => \Str::random(60),
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Error inserting into password_resets:', ['error' => $e->getMessage()]);
        }
    
        // Attempt to send the reset link
        $status = Password::sendResetLink(['email' => $request->email]);
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Please check your email to reset your password.')
            : back()->withErrors(['email' => 'Failed to send reset email.']);
    }
    
    

    // Show the form to reset password
    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Reset the user's password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Attempt to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password has been reset!')
            : back()->withErrors(['email' => 'Failed to reset password.']);
    }
    
}
