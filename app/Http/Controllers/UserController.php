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
        $bloodbankscount=DB::table('users')
        ->where('UserType','BloodCenter')->count();
        $donorcount=DB::table('donations')
        ->where('user_id',$userId)->distinct('user_id')->count('user_id');
        $pendingrequests=Db::table('blood_requests')
        ->where('user_id',$userId)->where('status','Pending')->count();

        $quantity=DB::table('blood_inventories')
        ->sum('Quantity');

            $user = Auth::user();
             $userProfile = $user->profile;


                return view("pages.user.dashboard",compact('bloodrequests','donationcount','donorcount','pendingrequests','quantity','user','userProfile','bloodbankscount'));

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
            'Username.required' => 'يجب إدخال اسم المستخدم',
            'Username.string'=>'يجب أن يكون الاسم نصاً',
            'Username.unique'=>'يوجد حساب بالفعل بنفس هذا الاسم',
            'Email.required'=>'يجب إدخال الإيميل',
            'Email.email'=>'يجب أن يكون الإيميل حقيقي',
            'Password.min' => 'يجب أن تكون كلمة السر على الأقل 8 أحرف',
            'Password.regex' => 'يجب أن تحتوي كلمة السر على حرف صغير وحرف كبير ورموز وأرقام',
            'UserType.in'=>'يجب أن يكون المستخدم إما من نوع مستخدم عادي أو أدمن أو بنك دم'

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
            'Username.required' => 'يجب إدخال اسم المستخدم',
            'Username.string'=>'يجب أن يكون الاسم نصاً',
            'Username.unique'=>'يوجد حساب بالفعل بنفس هذا الاسم',
            'Email.required'=>'يجب إدخال الإيميل',
            'Email.email'=>'يجب أن يكون الإيميل حقيقي',
            'Password.min' => 'يجب أن تكون كلمة السر على الأقل 8 أحرف',
            'Password.regex' => 'يجب أن تحتوي كلمة السر على حرف صغير وحرف كبير ورموز وأرقام',
            'UserType.in'=>'يجب أن يكون المستخدم إما من نوع مستخدم عادي أو أدمن أو بنك دم'

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
            ],[
                'BloodType.required'=>'فصيلة الدم مطلوبة',
                'BloodType.in'=>'يجب أن تكون فصيلة الدم أحد الخيارات المتاحة',
            ]);
    
            session(['BloodType' => $request->BloodType]);
    
            return redirect()->route('profile.view.step3', ['user_id' => $user_id]);
        } elseif ($user->UserType === 'BloodCenter') {
            $request->validate([
                'ContactNumber' => 'required|regex:/^05\d{8}$/',
                'Address' => 'required',
            ],[
                'ContactNumber.required' => 'رقم الهاتف مطلوب',
                'ContactNumber.regex' => 'رقم الهاتف يجب أن يكون 10 أرقام ويبدأ ب 05',
                'Address.required' => 'العنوان مطلوب',

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
                    'DateOfBirth.date' => 'رجاءً أدخل تاريخ ميلاد صحيح',
                    'DateOfBirth.before_or_equal' => 'يجب أن تكون على الأقل بعمر 18 عام',

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
                ],[
                    'ContactNumber.required' => 'رقم الهاتف مطلوب',
                    'ContactNumber.regex' => 'رقم الهاتف يجب أن يكون 10 أرقام ويبدأ ب 05',
                    'Address.required' => 'العنوان مطلوب',
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
    public function donations()
    {
        $userId = Auth::id();
    
        $donations = Donation::join('users AS donors', 'donations.user_id', '=', 'donors.id') // Join for donor user
            ->join('users AS centers', 'donations.center_id', '=', 'centers.id') 
            ->where('donations.user_id', $userId) 
            ->select(
                'donations.id',
                'donors.Username AS donor_name',
                'centers.Username AS center_name',
                'donations.blood_type',
                'donations.quantity',
                'donations.last_donation_date',
                'donations.Status',

            )
            ->get();
    
        return view("pages.user.donations", compact('donations'));
    }
    
    public function inventory(){
        $inventores=BloodInventory::join('users','blood_inventories.center_id','=','users.id')
                    ->select('blood_inventories.id','users.Username','blood_inventories.BloodType','blood_inventories.Quantity','blood_inventories.ExpirationDate')
                    ->get();
        return view("pages.user.bloodInventory",compact('inventores'));
    }
    public function requests(){
        $userId= Auth::id();

        $requests=BloodRequest::join('users as requests','blood_requests.user_id','=','requests.id')
         ->join('blood_request_centers', 'blood_requests.id', '=', 'blood_request_centers.blood_request_id') 
        ->join('users as centers', 'blood_request_centers.center_id', '=', 'centers.id')
         ->where('blood_requests.user_id', $userId)
        ->select('blood_requests.id','requests.Username as Username','blood_requests.BloodType','blood_requests.Quantity','blood_requests.RequestDate','blood_requests.Status','centers.Username as Centername')
        ->get();
        return view("pages.user.requests",compact('requests'));
    }
    public function reports(){
        return view("pages.user.reports");
    }
    public function settings(){
 $user = Auth::user();
        $id= Auth::id();
        $profile = DB::table('user_profiles')->where('user_id',$id)->first();
        return view("pages.user.settings.personalInfo",compact('user','profile'));
        }
    public function personalInfo(){
        $user = Auth::user();
        $id= Auth::id();
        $profile = DB::table('user_profiles')->where('user_id',$id)->first();
        return view("pages.user.settings.personalInfo",compact('user','profile'));
    }
    public function donationInfo() {
        $user = Auth::user();
        $donations = DB::table('donations')
                         ->join('users as centers','donations.center_id','=','centers.id');
        return view("pages.user.settings.donationInfo",compact('user','donations'));
    } 
     public function status() {
        return view("pages.user.settings.status");
    } 
    public function updatePersonalInfo(Request $request){
        $user = Auth::user();
        $profile= $user->profile;
        $request->validate([
            'Username' => 'required|string|max:50|unique:users,Username',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'DateOfBirth' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'ContactNumber' => 'required|regex:/^05\d{8}$/',
            'Address' => 'required|string|max:255',
        ],[
            'Username.required' => 'يجب إدخال اسم المستخدم',
            'Username.string'=>'يجب أن يكون الاسم نصاً',
            'Username.unique'=>'يوجد حساب بالفعل بنفس هذا الاسم',
            'DateOfBirth.date' => 'رجاءً أدخل تاريخ ميلاد صحيح',
            'DateOfBirth.before_or_equal' => 'يجب أن تكون على الأقل بعمر 18 عام',
            'ContactNumber.required' => 'رقم الهاتف مطلوب',
            'ContactNumber.regex' => 'رقم الهاتف يجب أن يكون 10 أرقام ويبدأ ب 05',
            'Address.required' => 'العنوان مطلوب'
            
        ]);
        $user->Username = $request->input('Username');
        $user->save();
        if (!$profile) {
            $profile = new UserProfile();
            $profile->user_id = $user->id;
        }
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $path = $file->store('profile_images', 'public');
            $profile->profile_image = $path;
        }
        $profile->DateOfBirth = $request->input('DateOfBirth');
        $profile->ContactNumber = $request->input('ContactNumber');
        $profile->Address = $request->input('Address');
        $profile->save();
        return redirect()->back()->with('success', 'Personal information updated successfully.');

    }
}
