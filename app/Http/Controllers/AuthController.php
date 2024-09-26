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

    // معالجة بيانات تسجيل الدخول
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate(
    //         [
    //             'Email'=>'required|email',
    //             'Password'=>'required|string|min:8'
    //         ]
    //         );
    //         if(Auth::attempt($credentials)){
    //             $request->session()->regenerate();
    //             return redirect()->intended('/dashboard')->with('success','Logged in Successfully');
    //         }
    //         return back()->withErrors([
    //             'email' => 'The provided credentials do not match our records.',
    //         ]);
/* 
        // تحقق من صحة البيانات المدخلة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // الحصول على بيانات الاعتماد (البريد وكلمة المرور)
        $credentials = $request->only('email', 'password');

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials, $request->remember)) {
            // إذا تم تسجيل الدخول بنجاح، يعيد التوجيه إلى الصفحة الرئيسية أو لوحة التحكم
            return redirect()->intended('dashboard');
        }

        // إذا فشل تسجيل الدخول، يعيد التوجيه إلى الصفحة السابقة مع رسالة خطأ
        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->withInput($request->only('email')); */
    // }
    
 
        // Log the validated input data for debugging purposes
        public function login(Request $request)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'Email' => 'required|email',
                'Password' => 'required|min:8',
            ]);
        
            // Log the validated input data for debugging purposes
        
            // Retrieve the user by email
            $user = User::where('Email', $validatedData['Email'])->first();
        
            // Check if user exists and verify password
            if ($user && Hash::check($request->Password, $user->Password)) {
                // Regenerate session to prevent fixation attacks
                $request->session()->regenerate();
        
                // Redirect to the intended page or home
                return redirect()->intended('/dashboard')->with('success', 'Logged in successfully!');
            }
        
            // If login fails, redirect back with an error
            return back()->with('error', 'Invalid email or password.')->withInput();
        }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out !');
    }
 
}
