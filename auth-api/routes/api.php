<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enums\TokenAbilities;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return 'TEST API';
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum')
    ->middleware('ability:'.TokenAbilities::ISSUE_ACCESS_TOKEN->value);