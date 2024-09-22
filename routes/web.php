<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/roles', function () {
    return view('views.roles');
})->name('roles');
Route::get('/register/user', function () {
    return view('views.registeruser');
})->name('register.user');

Route::post('/register/user', [UserController::class, 'register'])->name('register.user.post');

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/about', function () {
    return view('views.about');
})->name('views.about');