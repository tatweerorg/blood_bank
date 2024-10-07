<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthController extends Controller
{
    public function index(){
        return view('pages.admin.dashbord');
    }
    public function showLoginForm()
    {
        return view('auth.login.login');  // تأكد من أن ملف blade الخاص بصفحة تسجيل الدخول موجود في resources/views/login.blade.php
    }

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
        
            // If authentication fails, redirect back with an error message
            return back()->with('error', 'Invalid email or password.');
        }
        
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out !');
    }
  
    public function showForgetPasswordForm(){
        return view('auth.passwords.emailPage');
    }
    public function sendResetEmail(Request $request){
        $request->validate(['email' => 'required|email|exists:users,email']);
        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );
        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));
    Mail::to($request->email)->send(new ResetPasswordMail($resetLink));

    return back()->with('message', 'Password reset link sent!');
        }
        public function showResetPasswordForm(Request $request, $token)
        {
            return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
        }
        public function resetPassword(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'token' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);
        
            // Verify the token
            $passwordReset = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();
        
            if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
                return back()->withErrors(['email' => 'Invalid token.']);
            }
        
            // Update password in users table
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password),
            ]);
        
            // Delete the token after successful reset
            DB::table('password_resets')->where('email', $request->email)->delete();
        
            return redirect()->route('login')->with('message', 'Password has been reset!');
        }
        
}
