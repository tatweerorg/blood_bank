<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BloodCenter;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\BloodInventory;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use App\Models\BloodRequest;




class BloodCenterController extends Controller
{

    public function dashboard()
    {
        return view("pages.bloodBank.home");
    }
    public function search(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'BloodType' => 'required|string|in:A+,A-,AB+,AB-,B+,B-,O+,O-',
            'units' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
        ]);
    
        $results = BloodInventory::where('BloodType', $validatedData['BloodType'])
        ->where('Quantity', '>=', $validatedData['units'])
        ->whereHas('center.profile', function ($query) use ($validatedData) {
            $query->where('Address', 'LIKE', '%' . $validatedData['location'] . '%');
        })
        ->with(['center.profile']) 
        ->with('center')
        ->get();
        
    
        // Handle no results found
     if ($results->isEmpty()) {
    return back()->with('error', 'عذرًا، لا توجد مراكز تحتوي على الكمية المطلوبة في الموقع المحدد.');
}
        // Pass results to the view
        return view('results', compact('results'));
    }
    


    public function edit($id)
    {
        $user= User::find($id);
        $profile= UserProfile::where('user_id',$user->id)->first();
        return view('pages.admin.bloodcenteredit',compact('user','profile'));

    }
    public function update(Request $request,$id){
        $validatedData= $request->validate([
              'Username' => 'nullable|string|max:255',
        'ContactNumber' => 'nullable|string|max:255|regex:/^05\d{8}$/',
        'Address'=>'nullable|string|max:255'
        ],[
            'ContactNumber.regex' => 'رقم الهاتف يجب أن يكون 10 أرقام ويبدأ ب 05',

        ]);
        $user=User::find($id);
        if($request->filled('Username')){
           $user->Username =$validatedData['Username'];
        }
       $profile=UserProfile::where('user_id',$user->id)->first();
        if($request->filled('ContactNumber')){
            $profile->ContactNumber =$validatedData['ContactNumber'];
         }
         if($request->filled('Address')){
            $profile->Address =$validatedData['Address'];
         }
        
         $user->save();
         $profile->save();
         return redirect()->route('dashboard.bloodbanks')->with('success', 'تم تعديل معلومات بنك الدم بنجاح');
    }

    public function donations(){
       $loggedInCenter = Auth::user()->Username; // اسم بنك الدم المسجل دخوله

$donations = Donation::join('users AS donors', 'donations.user_id', '=', 'donors.id') // Join for donor user
    ->join('users AS centers', 'donations.center_id', '=', 'centers.id') // Join for blood center
    ->where('centers.Username', $loggedInCenter) // التحقق من تطابق اسم بنك الدم المسجل دخوله
    ->select(
        'donations.id',
        'donors.Username AS donor_name', 
        'centers.Username AS center_name',
        'donations.blood_type', 
        'donations.quantity', 
        'donations.last_donation_date'
    )
    ->get();

return view("pages.bloodBank.donors", compact('donations'));

    }
  public function requests(){
    $centerId= Auth::id();

        $requests=BloodRequest::join('blood_request_centers', 'blood_requests.id', '=', 'blood_request_centers.blood_request_id')
        ->join('users','blood_requests.user_id','=','users.id')
        ->where('blood_request_centers.center_id', $centerId)
        ->where('blood_requests.Status', 'Pending')
        ->select('blood_requests.id','users.Username','blood_requests.BloodType','blood_requests.Quantity','blood_requests.RequestDate','blood_requests.Status')
        ->get();
        return view("pages.bloodBank.donationRequests",compact('requests'));
    }
   public function inventory(){
     $loggedInCenterId = Auth::id(); 

$inventores = BloodInventory::join('users', 'blood_inventories.center_id', '=', 'users.id')
    ->where('blood_inventories.center_id', $loggedInCenterId) 
    ->select(
        'blood_inventories.id',
        'users.Username',
        'blood_inventories.BloodType',
        'blood_inventories.Quantity',
    )
    ->get();

return view("pages.bloodBank.bloodStock", compact('inventores'));

    }
    
    public function donateBlood(){
        return view("pages.bloodBank.donate");
    }
    public function addBlood(Request $request){
        $request->validate([
            'BloodType' => 'required|string',
            'Quantity' => 'required|integer|min:1',
        ]);
        $centerId = Auth::id(); 
        $bloodType = $request->BloodType;
        $quantity = $request->Quantity;
        $bloodRecord = BloodInventory::where('center_id', $centerId)
        ->where('BloodType', $bloodType)
        ->first();
        if($bloodRecord){
            $bloodRecord->Quantity += $quantity;
            $bloodRecord->save();
        }else {
            BloodInventory::create([
                'center_id' => $centerId,
                'BloodType' => $bloodType,
                'Quantity' => $quantity,]);
        }
        return redirect()->route('dashboardblood.bloodstock')->with('success', 'تم إضافة الدم بنجاح.');

    }
    public function setting(Request $request){


        $loggedInCenterId = Auth::id();

    // Fetch the user's data and associated profile
    $user = User::with('profile')->find($loggedInCenterId);

    // Fetch the inventory related to the blood bank
    $inventory = BloodInventory::where('center_id', $loggedInCenterId)->get();

    // Pass the data to the view
    return view("pages.bloodBank.setting", compact('user', 'inventory'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodCenter  $bloodCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        if($user){
            $user->delete();
            return redirect()->route('dashboard.bloodbanks')->with('success', 'تم حذف المستخدم بنجاح.');
        }else{
            return redirect()->route('dashboard.bloodbanks')->with('error', 'المستخدم غير موجود');
        }
    }
}
