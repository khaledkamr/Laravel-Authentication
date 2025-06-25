<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(Hash::check($request->password, $user->password) === false) {
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
        
        if(!$user->email_verified_at) {
            return back()->with('error', 'Please verify your account before logging in.');
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('profile')->with('success', 'Welcome back!');
        }
        return back()->with('error', 'Invalid credentials. Please try again.');
    }
}
