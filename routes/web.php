<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\facebookAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GithubAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdateProfileController;
use App\Http\Controllers\Auth\VerifyAccountController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::get('/auth/{driver}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{driver}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');

Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::view('/reset-password/{token}', 'auth.reset-password')->name('reset.password');

Route::post('forgot-password', ForgotPasswordController::class)->name('password.email');
Route::post('/reset-password', ResetPasswordController::class)->name('password.update');

Route::view('/verify-account/{identifier}', 'auth.verify-account')->name('account.verify');
Route::post('/verify-account', [VerifyAccountController::class, 'verifyOtp'])->name('account.verify.post');
Route::post('send-verification-otp', [VerifyAccountController::class, 'sendOtp'])->name('account.send.verification.otp');



Route::middleware('auth', 'auth.session')->group(function(){
  Route::view('/profile', 'auth.profile')->name('profile');
  Route::put('/profile', UpdateProfileController::class)->name('update.profile');
  Route::post('/change-password', ChangePasswordController::class)->name('change.password');
  Route::post('/logout', LogoutController::class)->name('logout');
});