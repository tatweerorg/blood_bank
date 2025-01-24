<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Donation;
use App\Models\Reminder;
use App\Models\BloodCenter;
use Illuminate\Http\Request;
use App\Models\BloodInventory;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
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
    
    public function create()
    {
        $centers = User::where('UserType', 'BloodCenter')->get();

            return view('pages.user.giveDonation',compact('centers'));
    
    }

   
    public function store(Request $request){
        $request->validate([
            'center_id' => 'required', 
            'blood_type' => 'required|string|max:3', 
            'quantity' => 'required|integer|min:1', 
            'last_donation_date' => 'required|date',
        ]);
        
        Donation::create([
            'user_id'=> Auth::id(),
            'center_id'=>$request->center_id,
            'blood_type' => $request->input('blood_type'),
            'quantity' => $request->input('quantity'),
            'last_donation_date' => Carbon::createFromFormat('Y-m-d\TH:i', $request->last_donation_date)
            ->format('Y-m-d H:i:s'),
            'Status'=>'Pending'
        ]);

        Reminder::create(
            [
            'sender_id'=> Auth::id(),
            'reciever_id'=>$request->center_id,
            'Status'=>'unseen',
            'reminder'=>'donate',
            'reminder_date'=> Carbon::createFromFormat('Y-m-d\TH:i', $request->last_donation_date)
            ->format('Y-m-d H:i:s'),
            ]
        );
        return redirect()->route('dashboarduser.donations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $donation=Donation::find($id);
        $donor=User::find($donation->user_id);
        $center=User::find($donation->center_id);
        return view('pages.admin.donationsedit',compact('donation','donor','center'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
   public function update(Request $reques,$id){
    $validatedData = $request->validate([
        'donor_name' => 'nullable|string|max:255',
        'center_name' => 'nullable|string|max:255',
        'blood_type' => 'nullable|in:A+,A-,O+,O-,AB+,AB-,B+,B-',
        'quantity' => 'nullable|integer|min:1',
        'last_donation_date' => 'nullable|date',
    ],[
        'blood_type.in' => 'يجب أن يكون نوع الدم أحد الخيارات الصحيحة.',
        'last_donation_date.date'=>'يجب أن يكون التاريخ صحيح',
    ]);
    $donation=Donation::find($id);
    if($request->filled('donor_name')){
        $donor= User::where('id',$donation->user_id)->first();
        if($donor){
            $donor->Username = $validatedData['donor_name'];
            $donor->save();
        }else{
            return redirect()->back()->with('error', 'المتبرع غير موجود.');

        }
    }
    if($request->filled('center_name')){
        $center= User::where('id',$donation->center_id)->first();
        if($center){
            $center->Username = $validatedData['center_name'];
            $center->save();
        }else{
            return redirect()->back()->with('error', '.المركز غير موجود');

        }
    }
    if ($request->filled('blood_type')) {
        $donation->blood_type = $validatedData['blood_type'];
    }

    if ($request->filled('quantity')) {
        $donation->quantity = $validatedData['quantity'];
    }

    if ($request->filled('last_donation_date')) {
        $donation->last_donation_date = $validatedData['last_donation_date'];
    }

    // Save the updated donation
    $donation->save();
         return redirect()->route('dashboard.donations')->with('success', 'تم تعديل معلومات المتبرع بنجاح');
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
        $donation=Donation::find($id);
        if($donation){
            $donation->delete();
            return redirect()->route('dashboard.donations')->with('success', 'تم حذف عملية التبرع بنجاح.');
        }else{
            return redirect()->route('dashboard.donations')->with('error', ' عملية التبرع غير موجودة');
        }
    }
    


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'Status' => 'required|in:Approved,Cancelled',
        ]);
        
        // Find the blood request by ID
        $donation = Donation::findOrFail($id); // Using findOrFail to ensure it exists
        $sender = Auth::id(); // The current center's ID (authenticated user)
        
        // Find the corresponding blood inventory for the center and blood type
        $inventory = BloodInventory::where('center_id', $sender)
            ->where('BloodType', $donation->blood_type)
            ->first();
    
        if ($inventory) {
            if ($request->Status === 'Approved') {
                // Update the quantity in the inventory when approved
                $inventory->quantity += $donation->quantity;
        
                // Create a reminder for the user who made the blood request
                Reminder::create([
                    'sender_id' => $sender,  // The sender is the current center
                    'reciever_id' => $donation->user_id,  // The receiver is the user who made the request
                    'Status' => 'unseen',  // The reminder is marked as unseen
                    'reminder' => 'approve',  // The reminder message is "approve"
                    'reminder_date' => now()->format('Y-m-d H:i:s'),  // The reminder's date and time
                ]);
            }
            
            // Save the updated inventory data
            $inventory->save();
            if ($request->Status === 'Cancelled') {
                // Create a reminder for the user who made the request, if it's cancelled
                Reminder::create([
                    'sender_id' => $sender,  // The sender is the current center
                    'reciever_id' => $donation->user_id,  // The receiver is the user who made the request
                    'Status' => 'unseen',  // The reminder is marked as unseen
                    'reminder' => 'cancelled',  // The reminder message is "cancelled"
                    'reminder_date' => now()->format('Y-m-d H:i:s'),  // The reminder's date and time
                ]);
            }
        } else {
            if ($request->Status === 'Approved') {
                // Update the quantity in the inventory when approved
                BloodInventory::create([
                    'center_id' => $sender,
                    'BloodType' => $donation->blood_type,
                    'Quantity' => $donation->quantity,]);
                   
                // Create a reminder for the user who made the blood request
                Reminder::create([
                    'sender_id' => $sender,  // The sender is the current center
                    'reciever_id' => $donation->user_id,  // The receiver is the user who made the request
                    'Status' => 'unseen',  // The reminder is marked as unseen
                    'reminder' => 'approve',  // The reminder message is "approve"
                    'reminder_date' => now()->format('Y-m-d H:i:s'),  // The reminder's date and time
                ]);
            }else if($request->Status === 'Cancelled') {
                // Create a reminder for the user who made the request, if it's cancelled
                Reminder::create([
                    'sender_id' => $sender,  // The sender is the current center
                    'reciever_id' => $donation->user_id,  // The receiver is the user who made the request
                    'Status' => 'unseen',  // The reminder is marked as unseen
                    'reminder' => 'cancelled',  // The reminder message is "cancelled"
                    'reminder_date' => now()->format('Y-m-d H:i:s'),  // The reminder's date and time
                ]);
            }
        }
     
    
        // Update the blood request status to Approved or Cancelled
        $donation->Status = $request->Status;
        $donation->save();
        
        return redirect()->back()->with('success', 'تم تغيير حالة الطلب');
    }
    
}
