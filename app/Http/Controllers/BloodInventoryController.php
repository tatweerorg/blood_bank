<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BloodInventory;

class BloodInventoryController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodInventory  $bloodInventory
     * @return \Illuminate\Http\Response
     */
    public function show(BloodInventory $bloodInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodInventory  $bloodInventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $inventroy=BloodInventory::find($id);
        $center=User::find($inventroy->center_id);
        return view ('pages.admin.bloodInventoryedit',compact('inventroy','center'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BloodInventory  $bloodInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $reques,$id){
        $validatedData = $request->validate([
            'center_name' => 'nullable|string|max:255',
            'BloodType' => 'nullable|in:A+,A-,O+,O-,AB+,AB-,B+,B-',
            'Quantity' => 'nullable|integer|min:1',
            'ExpirationDate' => 'nullable|date',
        ],[
            'BloodType.in' => 'يجب أن يكون نوع الدم أحد الخيارات الصحيحة.',
            'ExpirationDate.date'=>'يجب أن يكون التاريخ صحيح',
        ]);
        $inventory=BloodInventory::find($id);
        if($request->filled('center_name')){
            $donor= User::where('Username',$validatedData['center_name'])->first();
            if($donor){
                $inventory->center_id=$inventory->id;
            }else{
                return redirect()->back()->with('error', 'المركز غير موجود.');
    
            }
        }
      
        if ($request->filled('BloodType')) {
            $inventory->BloodType = $validatedData['BloodType'];
        }
    
        if ($request->filled('Quantity')) {
            $inventory->Quantity = $validatedData['Quantity'];
        }
    
        if ($request->filled('ExpirationDate')) {
            $inventory->ExpirationDate = $validatedData['ExpirationDate'];
        }
    
        // Save the updated donation
        $inventory->save();
             return redirect()->route('pages.admin.bloodInventory')->with('success', 'تم تعديل معلومات مخزون الدم بنجاح');
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
            $inventory=BloodInventory::find($id);
            if($inventory){
                $inventory->delete();
                return redirect()->route('dashboard.inventory')->with('success', 'تم حذف مخزون الدم هذا بنجاح.');
            }else{
                return redirect()->route('dashboard.inventory')->with('error', ' مخزون الدم غير موجود ');
            }
        }
    

}
