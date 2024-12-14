<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Donation;
use App\Models\BloodCenter;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\BloodInventory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        $today=Carbon::today();
        $bloodrequests= DB::table('blood_requests')
        ->join('users','blood_requests.user_id', '=', 'users.id')
        ->whereBetween('RequestDate',[$today,$today->copy()->addDays(30)])
        ->select('blood_requests.*', 'users.Username')
        ->get();
        $donationcount=DB::table('donations')->count();
        $donorcount=DB::table('donations')->distinct('user_id')->count('user_id');
        $pendingrequests=Db::table('blood_requests')->where('status','Pending')->count();
        $quantity=DB::table('blood_inventories')->sum('Quantity');
        return view("pages.admin.main",compact('bloodrequests','donationcount','donorcount','pendingrequests','quantity'));
    }
      public function main(){
        return view("pages.admin.main");
    }
    public function bloodbanks()
{
    $centers = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                    ->where('UserType', 'BloodCenter')
                    ->select('users.id', 'users.Username', 'user_profiles.Address', 'user_profiles.ContactNumber')
                    ->get();

    return view("pages.admin.bloodbanks", compact('centers'));
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
        return view("pages.admin.donations",compact('donations'));
    }
    public function inventory(){
        $inventores=BloodInventory::join('users','blood_inventories.center_id','=','users.id')
                    ->select('blood_inventories.id','users.Username','blood_inventories.BloodType','blood_inventories.Quantity')
                    ->get();
        return view("pages.admin.bloodInventory",compact('inventores'));
    }
    public function requests(){
        $requests=BloodRequest::join('users','blood_requests.user_id','=','users.id')
        ->select('blood_requests.id','users.Username','blood_requests.BloodType','blood_requests.Quantity','blood_requests.RequestDate','blood_requests.Status')
        ->get();
        return view("pages.admin.requests",compact('requests'));
    }
    public function reports(){
        return view("pages.admin.reports");
    }
    public function settings(){
        return view("pages.admin.settings");
    }
} 
