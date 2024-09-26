<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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
Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
});

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