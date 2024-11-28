<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Donation;
use App\Models\BloodCenter;
use App\Models\UserProfile;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\BloodInventory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function dashboard(){
        $today=Carbon::today();
        $userId= Auth::id();
        $bloodrequests= DB::table('blood_requests')
        ->join('users','blood_requests.user_id','=','users.id')
        ->where('blood_requests.user_id',$userId)
        ->whereBetween('RequestDate',[$today,$today->copy()->addDays(30)])
        ->select('blood_requests.*', 'users.Username')
        ->get();
        $donationcount=DB::table('donations')
        ->where('user_id',$userId)->count();
        $donorcount=DB::table('donations')
        ->where('user_id',$userId)->distinct('user_id')->count('user_id');
        $pendingrequests=Db::table('blood_requests')
        ->where('user_id',$userId)->where('status','Pending')->count();

        $quantity=DB::table('blood_inventories')
        ->sum('Quantity');

            $user = Auth::user();
             $userProfile = $user->profile;


                return view("pages.user.dashboard",compact('bloodrequests','donationcount','donorcount','pendingrequests','quantity','user','userProfile'));

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
    public function bloodbanks(){

        $centers = User::join('user_profiles','users.id','=','user_profiles.user_id')  
                        ->where('UserType','BloodCenter')
                        ->select('users.id','users.Username', 'user_profiles.Address', 'user_profiles.ContactNumber')
                        ->get();
        return view("pages.user.bloodbanks",compact('centers'));
    }
    public function donations(){
        $donations = Donation::join('users AS donors', 'donations.user_id', '=', 'donors.id') // Join for donor user
        ->join('users AS centers', 'donations.center_id', '=', 'centers.id') // Join for blood center
        ->select(
            'donations.id',
            'donors.Username AS donor_name', 
            'centers.Username AS center_name',
            'donations.blood_type', 
            'donations.quantity', 
            'donations.last_donation_date'
        )
        ->get();
        return view("pages.user.donations",compact('donations'));
    }
    public function inventory(){
        $inventores=BloodInventory::join('users','blood_inventories.center_id','=','users.id')
                    ->select('blood_inventories.id','users.Username','blood_inventories.BloodType','blood_inventories.Quantity','blood_inventories.ExpirationDate')
                    ->get();
        return view("pages.user.bloodInventory",compact('inventores'));
    }
    public function requests(){
        $userId= Auth::id();

        $requests=BloodRequest::join('users','blood_requests.user_id','=','users.id')
        ->where('blood_requests.user_id', $userId)
        ->select('blood_requests.id','users.Username','blood_requests.BloodType','blood_requests.Quantity','blood_requests.RequestDate','blood_requests.Status')
        ->get();
        return view("pages.user.requests",compact('requests'));
    }
    public function reports(){
        return view("pages.user.reports");
    }
    public function settings(){
        return view("pages.user.settings");
    }
}
