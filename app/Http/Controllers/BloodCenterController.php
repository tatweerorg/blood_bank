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

        $requests=BloodRequest::join('users','blood_requests.user_id','=','users.id')
        ->select('blood_requests.id','users.Username','blood_requests.BloodType','blood_requests.Quantity','blood_requests.RequestDate','blood_requests.Status')
        ->get();
        return view("pages.bloodBank.donationRequests",compact('requests'));
    }
   public function inventory(){
     $loggedInCenterId = Auth::id(); // الحصول على معرف المستخدم المسجل دخوله

$inventores = BloodInventory::join('users', 'blood_inventories.center_id', '=', 'users.id')
    ->where('blood_inventories.center_id', $loggedInCenterId) // التحقق من أن البيانات تخص المستخدم المسجل دخوله
    ->select(
        'blood_inventories.id',
        'users.Username',
        'blood_inventories.BloodType',
        'blood_inventories.Quantity',
        'blood_inventories.ExpirationDate'
    )
    ->get();

return view("pages.bloodBank.bloodStock", compact('inventores'));

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
