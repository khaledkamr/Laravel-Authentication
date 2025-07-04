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
        $user = User::where('email', $request->identifier)
            ->orWhere('phone', $request->identifier)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
        
        if(!$user->account_verified_at) {
            return back()->with('error', 'Please verify your account before logging in.');
        }

        Auth::login($user);
        if($user->logout_other_devices) {
            Auth::logoutOtherDevices($request->password);
        }

        $urls = [
            'student' => '/student',
            'teacher' => '/teacher',
            'admin' => '/admin',
        ];
        return redirect()->intended($urls[$user->role] ?? '/profile')->with('success', 'Welcome back!');
    }
}
