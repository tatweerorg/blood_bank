<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BloodCenterController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\BloodInventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');
// Route::middleware('auth')->group(function () {
//     // Protected routes here
//     Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
// });
 Route::middleware('auth')->group(function(){
    Route::get('/dashboard/admin',[DashboardController::class,'dashboard'])->middleware('checkUserType:Admin')->name('dashboard.admin');

    Route::get('/dashboard/user',[UserController::class,'dashboard'])->middleware('checkUserType:User')->name('dashboard.user');
    
    Route::get('/dashboard/bloodcenter',[BloodCenterController::class,'dashboard'])->middleware('checkUserType:BloodCenter')->name('dashboard.bloodcenter');
    
});
Route::middleware('checkUserType:Admin')->group(function(){
    Route::get('/bloodcenter/{id}/edit',[BloodCenterController::class,'edit'])->name('bloodCenter.edit');
    Route::post('/bloodcenter/{id}',[BloodCenterController::class,'update'])->name('bloodCenter.update');
    Route::post('/bloodcenter/delete/{id}',[BloodCenterController::class,'destroy'])->name('bloodCenter.destroy');
    Route::get('/donations/{id}/edit',[DonationController::class,'edit'])->name('donation.edit');
    Route::post('/donations/{id}',[DonationController::class,'update'])->name('donation.update');
    Route::post('/donations/delete/{id}',[DonationController::class,'destroy'])->name('donation.destroy');
    Route::get('/bloodinventories/{id}/edit',[BloodInventoryController::class,'edit'])->name('bloodInventory.edit');
    Route::post('/bloodinventories/{id}',[BloodInventoryController::class,'update'])->name('bloodInventory.update');
    Route::post('/bloodinventories/delete/{id}',[BloodInventoryController::class,'destroy'])->name('bloodInventory.destroy');
    Route::get('/bloodrequests/{id}/edit',[BloodRequestController::class,'edit'])->name('bloodRequest.edit');
    Route::post('/bloodrequests/{id}',[BloodRequestController::class,'update'])->name('bloodRequest.update');
    Route::post('/bloodrequests/delete/{id}',[BloodRequestController::class,'destroy'])->name('bloodRequest.destroy');
});

Route::get('/dashboard/main',[DashboardController::class,'main'])->name('dashboard.main');
 
Route::get('/dashboard/bloodbanks',[DashboardController::class,'bloodbanks'])->name('dashboard.bloodbanks');

Route::get('/dashboard/donations',[DashboardController::class,'donations'])->name('dashboard.donations');
Route::get('/dashboard/inventory',[DashboardController::class,'inventory'])->name('dashboard.inventory');
Route::get('/dashboard/requests',[DashboardController::class,'requests'])->name('dashboard.requests');
Route::get('/dashboard/reports',[DashboardController::class,'reports'])->name('dashboard.reports');
Route::get('/dashboard/settings',[DashboardController::class,'settings'])->name('dashboard.settings');
Route::get('/roles', function () {
    return view('auth.register.roles');
     
})->name('roles');
Route::get('/register/user', function () {
    return view('auth.register.registeruser');
})->name('register.user');

Route::post('/register/user', [UserController::class, 'register'])->name('register.user.post');
Route::get('/register/bloodbank',function () {
    return view('auth.register.registerbloodbank');
})->name('register.bloodbank');
Route::post('/register/bloodbank',[UserController::class, 'registerBloodBank'])->name('register.bloodbank.post');

Route::get('/about', function () {
    return view('pages.about&contact.about');
})->name('views.about');
Route::get('/profile/create/step1/{user_id}',[UserController::class,'create1'])->name('profile.view.step1');
Route::post('/profile/store/step1/{user_id}',[UserController::class,'store1'])->name('profile.post.step1');
Route::get('/profile/create/step2/{user_id}',[UserController::class,'create2'])->name('profile.view.step2');
Route::post('/profile/store/step2/{user_id}', [UserController::class, 'store2'])->name('profile.post.step2');
Route::get('/profile/create/step3/{user_id}',[UserController::class,'create3'])->name('profile.view.step3');
Route::post('/profile/store/step3/{user_id}',[UserController::class,'store3'])->name('profile.post.step3');
Route::get('/profile/create/step4/{user_id}',[UserController::class,'create4'])->name('profile.view.step4');
Route::post('/profile/store/step4/{user_id}',[UserController::class,'store4'])->name('profile.post.step4');
Route::get('/profile/create/step5/{user_id}',[UserController::class,'create5'])->name('profile.view.step5');
Route::post('/profile/store/step5/{user_id}',[UserController::class,'store5'])->name('profile.post.step5');
Route::get('/profile/create/step6/{user_id}',[UserController::class,'create6'])->name('profile.view.step6');
Route::post('/profile/store/step6/{user_id}',[UserController::class,'store6'])->name('profile.post.step6');
Route::get('/forgot-password',[AuthController::class,'showForgetPasswordForm'])->name('password.request');
Route::post('/forgot-password-link',[AuthController::class,'sendResetEmail'])->name('password.email');
Route::get('/reset-password/{token}',[AuthController::class,'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('password.update');


