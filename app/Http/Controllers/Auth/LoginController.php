<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('profile')->with('success', 'Welcome back!');
        }
        return back()->with('error', 'Invalid credentials. Please try again.');
    }
}
