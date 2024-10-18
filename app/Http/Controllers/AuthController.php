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
        return view('auth.login.login');  
    }

        public function login(Request $request)
        {

            
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            
        
            if (Auth::attempt(['email' => $request->email, 'password' =>  $request->password]))
             {
                
            $request->session()->regenerate();

            $user = Auth::user();
            
            if ($user->UserType === 'Admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Login successful! Welcome Admin.');
            } elseif ($user->UserType === 'User') {
                return redirect()->route('dashboard.user')->with('success', 'Login successful! Welcome User.');
            }
            elseif ($user->UserType === 'BloodCenter') {
                return redirect()->route('dashboard.bloodcenter')->with('success', 'Login successful! Welcome User.');
            } else {
                return redirect()->route('home')->with('error', 'Invalid user type.');
            }
            }
        
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
        $request->validate(['email' => 'required|email|exists:users,Email']);
        $token=Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'create_at' => now()]
        );
        $resetLink = url('/reset-password/' . $token . '?email='. urlencode($request->email));
        Mail::to($request->email)->send(new ResetPasswordMail($resetLink));
        return back()->with('message','Password reset link sent!');
        }
        public function showResetPasswordForm(Request $request, $token)
        {
            return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
        }
        public function resetPassword(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users,Email',
                'token' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);
        
            $passwordReset = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();
        
            if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
                return back()->withErrors(['email' => 'Invalid token.']);
            }
        
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password),
            ]);
        
            DB::table('password_resets')->where('email', $request->email)->delete();
        
            return redirect()->route('login')->with('message', 'Password has been reset!');
        }
        
}
