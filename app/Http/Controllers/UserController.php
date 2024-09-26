<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'Email' => 'required|string|email|max:100|unique:users,Email',
            'Password' => 'required|string|min:8',
            'UserType' => 'required|in:Admin,User,BloodCenter',
        ]);

        // Create the user
        User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),// Hashing handled by the model
            'UserType' => 'User',
        ]);

        // Redirect after successful registration
        return redirect()->route('login')->with('success', 'Account created successfully!');
    }
   
    public function registerBloodBank(Request $request){
        $validatedData = $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'Email' => 'required|string|email|max:100|unique:users,Email',
            'Password' => 'required|string|min:8',
            'UserType' => 'required|in:Admin,User,BloodCenter',
        ]);
        User::create(
            [
                'Username'=> $request->Username,
                'Email' => $request->Email,
                'Password' => Hash::make($request->Password),
                'UserType' => 'BloodCenter',

            ]
        );
        return redirect()->route('login')->with('success','Account created successfully!');

    }
}
