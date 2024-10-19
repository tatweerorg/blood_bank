<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\BloodCenter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function dashboard(){
                return view("pages.user.dashboard");

    }
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'Email' => 'required|string|email|unique:users,Email',
            'Password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'UserType' => 'required|in:Admin,User,BloodCenter',
        ],[
            'Email.email' => 'Please enter a valid email address.',
            'Password.min' => 'The password must be at least 8 characters long.',
            'Password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one number.',

        ]);

        // Create the user
        $user=User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => $request->Password,// Hashing handled by the model
            'UserType' => 'User',
        ]);

        // Redirect after successful registration
        return redirect()->route('profile.view.step1',['user_id'=>$user->id]);
    }
   
    public function registerBloodBank(Request $request){
        $validatedData = $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'Email' => 'required|string|email|unique:users,Email',
            'Password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'UserType' => 'required|in:Admin,User,BloodCenter',
        ],[
            'Email.email' => 'Please enter a valid email address.',
            'Password.min' => 'The password must be at least 8 characters long.',
            'Password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one number.',

        ]);
        $user=User::create(
            [
                'Username'=> $request->Username,
                'Email' => $request->Email,
                'Password' => $request->Password,
                'UserType' => 'BloodCenter',

            ]
        );
        return redirect()->route('profile.view.step1',['user_id'=>$user->id]);

    }
    public function create1($user_id){
        return view('pages.profile.step1',['user_id'=>$user_id]);
    }
    public function store1(Request $request){
        $validatedData= $request->validate(
            [
                'profile_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]
            );
        $path= $request -> file('profile_image')->store('profile_images','public');
        $request->session()->put('profile_image',$path);
        $user_id = $request->route('user_id');
        return redirect()->route('profile.view.step2',['user_id'=>$user_id]);

    }
    public function create2($user_id) {
        $user = User::find($user_id);
    
        if (!$user) {
            return redirect()->back()->withErrors(['user_id' => 'User not found.']);
        }
    
        return view('pages.profile.step2', [
            'user_id' => $user_id,
            'user' => $user 
        ]);
    }
    
    public function store2(Request $request, $user_id)
    {
        $user = User::find($user_id);
    
        if (!$user) {
            return redirect()->back()->withErrors(['user_id' => 'User not found.']);
        }
    
        if ($user->UserType === 'User') {
            $request->validate([
                'BloodType' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            ]);
    
            session(['BloodType' => $request->BloodType]);
    
            return redirect()->route('profile.view.step3', ['user_id' => $user_id]);
        } elseif ($user->UserType === 'BloodCenter') {
            $request->validate([
                'ContactNumber' => 'required|regex:/^05\d{8}$/',
                'Address' => 'required',
            ],[
                'ContactNumber.regex' => 'The contact number must start with "05" and be exactly 10 digits long.',

            ]);

    
            session(['ContactNumber' => $request->ContactNumber]);
            session(['Address' => $request->Address]);
            $profileData = [
                'user_id' => $user->id,
                'profile_image' => $request->session()->get('profile_image', null),
                'BloodType' => $request->session()->get('BloodType', null),
                'DateOfBirth' => $request->session()->get('DateOfBirth', null),
                'ContactNumber' => $request->session()->get('ContactNumber', null),
                'Address' => $request->session()->get('Address', null),
                'last_donation_date' => null, // You can update this field later if needed
            ];
             
            UserProfile::create($profileData);
        
            $request->session()->forget(['profile_image', 'BloodType', 'DateOfBirth', 'ContactNumber', 'Address']);
        
            return redirect()->route('dashboard.bloodcenter')->with('success', 'Account created successfully!');
        }
    }
    
    
    
    
    
    
    public function create3($user_id){
        $user=User::find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        return view('pages.profile.step3',[
            'user_id' => $user_id,
            'user' => $user 
        ]);
    }
    public function store3(Request $request ,$user_id){
        $user=User::find($user_id);
        if($user->UserType === 'User'){
            $validatedData=$request->validate(
                [
                    'DateOfBirth' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                ],[
                    'DateOfBirth.date' => 'Please enter a valid date of birth.',
                    'DateOfBirth.before_or_equal' => 'You must be at least 18 years old.',

                ]
                );
                $request->session()->put('DateOfBirth',$request->DateOfBirth);
        }
      
            return redirect()->route('profile.view.step4', ['user_id' => $user_id]);


    }
    public function create4($user_id){
        $user=User::find($user_id);
        if(!$user){
            return redirect()->back()->with('error', 'User not found.');
        }
        return view('pages.profile.step4',[
            'user_id'=>$user_id,
            'user'=>$user,
        ]
        );
    }
    public function store4(Request $request ,$user_id){
        $user=User::find($user_id);
            $validatedData=$request->validate(
                [
                    'Address'=>'required',
                    'ContactNumber' => 'required|regex:/^05\d{8}$/',
                ]
                );
                $request->session()->put('Address',$request->Address);
                $request->session()->put('ContactNumber',$request->ContactNumber);
                $profileData = [
                    'user_id' => $user->id,
                    'profile_image' => $request->session()->get('profile_image', null),
                    'BloodType' => $request->session()->get('BloodType', null),
                    'DateOfBirth' => $request->session()->get('DateOfBirth', null),
                    'ContactNumber' => $request->session()->get('ContactNumber', null),
                    'Address' => $request->session()->get('Address', null),
                    'last_donation_date' => null, // You can update this field later if needed
                ];
            
                // Store the collected data in the user_profiles table
                UserProfile::create($profileData);
            
                // Clear the session data after saving
                $request->session()->forget(['profile_image', 'BloodType', 'DateOfBirth', 'ContactNumber', 'Address']);
            
            return redirect()->route('dashboard.user')->with('success', 'Account created successfully!');


    }
}
