<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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
Route::middleware('auth')->group(function () {
    // Protected routes here
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});
// Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
// });

Route::get('/roles', function () {
    return view('views.roles');
})->name('roles');
Route::get('/register/user', function () {
    return view('views.registeruser');
})->name('register.user');

Route::post('/register/user', [UserController::class, 'register'])->name('register.user.post');
Route::get('/register/bloodbank',function () {
    return view('views.registerbloodbank');
})->name('register.bloodbank');
Route::post('/register/bloodbank',[UserController::class, 'registerBloodBank'])->name('register.bloodbank.post');

Route::get('/about', function () {
    return view('views.about');
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

