<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,Email|max:100',
            'username' => 'required|string|unique:users,Username|max:50',
            'password' => 'required|string|min:6',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'dob' => 'required|date',
        ]);

        $user = User::create([
            'Username' => $request->username,
            'Password' => Hash::make($request->password),
            'Email' => $request->email,
            'UserType' => 'Donor',  
        ]);

        $user->patient()->create([
            'FullName' => $request->username,
            'BloodType' => $request->blood_type,
            'dob' => $request->dob,
            'ContactNumber' => '', 
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully!');
    }
}
