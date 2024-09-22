<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
      // عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('views.login');  // تأكد من أن ملف blade الخاص بصفحة تسجيل الدخول موجود في resources/views/login.blade.php
    }

    // معالجة بيانات تسجيل الدخول
    public function login(Request $request)
    {
            return view("views.admin.dashbord");
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
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');  // إعادة التوجيه إلى صفحة تسجيل الدخول بعد تسجيل الخروج
    }
}
