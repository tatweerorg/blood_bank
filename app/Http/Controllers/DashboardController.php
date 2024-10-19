<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donation;
use App\Models\BloodCenter;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\BloodInventory;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        return view("pages.admin.main");
    }
      public function main(){
        return view("pages.admin.main");
    }
    public function bloodbanks(){

        $centers = User::join('user_profiles','users.id','=','user_profiles.user_id')  
                        ->where('UserType','BloodCenter')
                        ->select('users.Username', 'user_profiles.Address', 'user_profiles.ContactNumber')
                        ->get();
        return view("pages.admin.bloodbanks",compact('centers'));
    }
    public function donations(){
        $donations = Donation::join('users AS donors', 'donations.user_id', '=', 'donors.id') // Join for donor user
        ->join('users AS centers', 'donations.center_id', '=', 'centers.id') // Join for blood center
        ->select(
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
                    ->select('users.Username','blood_inventories.BloodType','blood_inventories.Quantity','blood_inventories.ExpirationDate')
                    ->get();
        return view("pages.admin.bloodInventory",compact('inventores'));
    }
    public function requests(){
        $requests=BloodRequest::all();
        return view("pages.admin.requests",compact('requests'));
    }
    public function reports(){
        return view("pages.admin.reports");
    }
    public function settings(){
        return view("pages.admin.settings");
    }
} 
