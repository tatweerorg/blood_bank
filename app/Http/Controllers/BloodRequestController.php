<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\BloodInventory;
use App\Models\BloodRequestCenter;
use Illuminate\Support\Facades\Auth;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bloodCenters= User::where('UserType','BloodCenter')->get();
        return view('pages.user.requestDonation',compact('bloodCenters'));
    }
    public function store(Request $request){
        $request->validate([
            'BloodType' => 'required|string|max:3', 
            'Quantity' => 'required|integer|min:1',
            'RequestDate' => 'required|date',
            'center_id'=>'required'
        ]);
        $bloodrequest=BloodRequest::create([
            'user_id'=> Auth::id(),
            'BloodType' => $request->input('BloodType'),
            'Quantity' => $request->input('Quantity'),
            'RequestDate' => $request->input('RequestDate'),
            'Status'=>'Pending',
        ]);
        if ($request->center_id == 'all') {
            $bloodcenters = User::where('UserType','BloodCenter')->get();
            foreach($bloodcenters as $center){
                BloodRequestCenter::create([
                    'blood_request_id'=> $bloodrequest->id,
                    'center_id'=> $center->id,
                ]);
            }
        } else {
            BloodRequestCenter::create([
                'blood_request_id' => $bloodrequest->id,
                'center_id' => $request->center_id,
            ]);
        }
        return redirect()->route('dashboarduser.requests');
    }
    public function updateStatus(Request $request , $id){
        $request->validate([
            'Status' => 'required|in:Approved,Cancelled',
        ]);
       $bloodRequest= BloodRequest::find($id);
       $centerId=Auth::id();

       $inventory = BloodInventory::where('center_id', $centerId)
       ->where('BloodType', $bloodRequest->BloodType)
       ->first();
    if($inventory){
        if ($request->Status === 'Approved') {
            $inventory->Quantity = $inventory->Quantity + $bloodRequest->Quantity;
        } 
    $inventory->save();

}else {
    if ($request->Status === 'Approved') {
        BloodInventory::create([
            'center_id' => $centerId,
            'BloodType' => $bloodRequest->BloodType,
            'Quantity' => $bloodRequest->Quantity,
        ]);
    } elseif ($request->Status === 'Cancelled') {
        return redirect()->back()->with('error', 'لا يمكن إلغاء طلب دون وجود سجل للمخزون.');
    }
}


    $bloodRequest->Status = $request->Status;
    $bloodRequest->save();

    return redirect()->back()->with('success', 'تم تغيير حالة الطلب  ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $request=BloodRequest::find($id);
        $user=User::find($request->id);
        return view('pages.admin.bloodRequestedit',compact('request','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $reques,$id){
        $validatedData = $request->validate([
            'user_name' => 'nullable|string|max:255',
            'BloodType' => 'nullable|in:A+,A-,O+,O-,AB+,AB-,B+,B-',
            'Quantity' => 'nullable|integer|min:1',
            'RequestDate' => 'nullable|date',
            'Status' => 'nullable|in:Pending,Approved,Cancelled',
        ],[
            'BloodType.in' => 'يجب أن يكون نوع الدم أحد الخيارات الصحيحة.',
            'RequestDate.date'=>'يجب أن يكون التاريخ صحيح',
        ]);
        $requestBlood=BloodRequest::find($id);
        if($request->filled('user_name')){
            $donor= User::where('id',$requestBlood->user_id)->first();
            if($donor){
                $donor->Username = $validatedData['user_name'];
                $donor->save();
            }else{
                return redirect()->back()->with('error', 'المتبرع غير موجود.');
    
            }
        }
       
        if ($request->filled('BloodType')) {
            $requestBlood->BloodType = $validatedData['BloodType'];
        }
    
        if ($request->filled('Quantity')) {
            $requestBlood->Quantity = $validatedData['Quantity'];
        }
        if ($request->filled('RequestDate')) {
            $requestBlood->RequestDate = $validatedData['RequestDate'];
        }
    
        if ($request->filled('Status')) {
            $requestBlood->Status = $validatedData['Status'];
        }
    
        // Save the updated donation
        $requestBlood->save();
             return redirect()->route('dashboard.requests')->with('success', 'تم تعديل معلومات الطلب بنجاح');
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Donation  $donation
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
            $request=BloodRequest::find($id);
            if($request){
                $request->delete();
                return redirect()->route('dashboard.requests')->with('success', 'تم حذف طلب الدم هذا بنجاح.');
            }else{
                return redirect()->route('dashboard.requests')->with('error', ' طلب الدم غير موجود ');
            }
        }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */

}
