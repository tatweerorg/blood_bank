<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BloodCenter;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class BloodCenterController extends Controller
{

    public function dashboard()
    {
        return view("pages.bloodBank.dashbord");
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
        'BloodType' => 'nullable|string|max:255|in:A+,A-,O+,O-,AB+,AB-,B+,B-',
        ],[
            'ContactNumber.regex' => 'رقم الهاتف يجب أن يكون 10 أرقام ويبدأ ب 05',

        ]);
        $user=User::find($id);
        if($request->filled('Username')){
           $user->Username =$validatedData['Username'];
        }
       
        if($request->filled('ContactNumber')){
            $user->ContactNumber =$validatedData['ContactNumber'];
         }
         if($request->filled('Address')){
            $user->Address =$validatedData['Address'];
         }
        
         $user->save();
         return redirect()->route('pages.admin.bloodbanks')->with('success', 'تم تعديل معلومات بنك الدم بنجاح');
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
