<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdateProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::middleware('auth')->group(function(){
  Route::view('/profile', 'auth.profile')->name('profile');
  Route::put('/profile', UpdateProfileController::class)->name('update.profile');
  Route::post('/change-password', ChangePasswordController::class)->name('change.password');
  Route::post('/logout', LogoutController::class)->name('logout');
});