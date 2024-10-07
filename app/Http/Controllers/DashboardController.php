<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        return view("pages.admin.dashbord");
    }
    public function bloodbanks(){
        return view("pages.admin.bloodbanks");
    }
    public function donations(){
        return view("pages.admin.donations");
    }
    public function inventory(){
        return view("pages.admin.bloodInventory");
    }
    public function requests(){
        return view("pages.admin.requests");
    }
    public function reports(){
        return view("pages.admin.reports");
    }
    public function settings(){
        return view("pages.admin.settings");
    }
} 
