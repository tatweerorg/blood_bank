<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\BloodCenter;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\BloodInventory;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        return view("pages.admin.dashbord");
    }
    public function bloodbanks(){
        $centers= BloodCenter::all();
        return view("pages.admin.bloodbanks",compact('centers'));
    }
    public function donations(){
        $donations=Donation::all();
        return view("pages.admin.donations",compact('donations'));
    }
    public function inventory(){
        $inventores=BloodInventory::all();
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
