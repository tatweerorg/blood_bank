<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reminder;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\BloodInventory;
use Illuminate\Support\Carbon;
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
            'RequestDate' => Carbon::createFromFormat('Y-m-d\TH:i', $request->RequestDate)
            ->format('Y-m-d H:i:s'),
            'Status'=>'Pending',
        ]);
        if ($request->center_id == 'all') {
            $bloodcenters = User::where('UserType','BloodCenter')->get();
            foreach($bloodcenters as $center){
                BloodRequestCenter::create([
                    'blood_request_id'=> $bloodrequest->id,
                    'center_id'=> $center->id,
                ]);
                Reminder::create(
                    [
                    'sender_id'=> Auth::id(),
                    'reciever_id'=>$center->id,
                    'Status'=>'unseen',
                    'reminder'=>'request',
                    'reminder_date'=>Carbon::createFromFormat('Y-m-d\TH:i', $request->RequestDate)
                           ->format('Y-m-d H:i:s'),
                    ]
                );
            }
        } else {
            BloodRequestCenter::create([
                'blood_request_id' => $bloodrequest->id,
                'center_id' => $request->center_id,
            ]);
            Reminder::create(
                [
                'sender_id'=> Auth::id(),
                'reciever_id'=>$request->center_id,
                'Status'=>'unseen',
                'reminder'=>'request',
                'reminder_date'=>Carbon::createFromFormat('Y-m-d\TH:i', $request->RequestDate)
                           ->format('Y-m-d H:i:s'),
                ]
            );
        }
        return redirect()->route('dashboarduser.requests');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'Status' => 'required|in:Approved,Cancelled',
        ]);
        
        // Find the blood request by ID
        $bloodRequest = BloodRequest::findOrFail($id); // Using findOrFail to ensure it exists
        $sender = Auth::id(); // The current center's ID (authenticated user)
        
        // Find the corresponding blood inventory for the center and blood type
        $inventory = BloodInventory::where('center_id', $sender)
            ->where('BloodType', $bloodRequest->BloodType)
            ->first();
    
        if ($inventory) {
            if ($request->Status === 'Approved') {
                // Update the quantity in the inventory when approved
                $inventory->Quantity -= $bloodRequest->Quantity;
        
                // Create a reminder for the user who made the blood request
                Reminder::create([
                    'sender_id' => $sender,  // The sender is the current center
                    'reciever_id' => $bloodRequest->user_id,  // The receiver is the user who made the request
                    'Status' => 'unseen',  // The reminder is marked as unseen
                    'reminder' => 'approve',  // The reminder message is "approve"
                    'reminder_date' => now()->format('Y-m-d H:i:s'),  // The reminder's date and time
                ]);
            }
            
            // Save the updated inventory data
            $inventory->save();
        } else {
            // If the inventory doesn't exist, handle the "Cancelled" status
            if ($request->Status === 'Cancelled') {
                // Create a reminder for the user who made the request, if it's cancelled
                Reminder::create([
                    'sender_id' => $sender,  // The sender is the current center
                    'reciever_id' => $bloodRequest->user_id,  // The receiver is the user who made the request
                    'Status' => 'unseen',  // The reminder is marked as unseen
                    'reminder' => 'cancelled',  // The reminder message is "cancelled"
                    'reminder_date' => now()->format('Y-m-d H:i:s'),  // The reminder's date and time
                ]);
            }
        }
    
        // Check if the request status is 'Approved' and return an error message
        if ($request->Status === 'Approved' && !$inventory) {
            // If the inventory does not exist, show an error message and don't proceed
            return redirect()->back()->with('error', 'لا يوجد مخزون كافٍ للموافقة على الطلب');
        }
    
        // Update the blood request status to Approved or Cancelled
        $bloodRequest->Status = $request->Status;
        $bloodRequest->save();
        
        return redirect()->back()->with('success', 'تم تغيير حالة الطلب');
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
