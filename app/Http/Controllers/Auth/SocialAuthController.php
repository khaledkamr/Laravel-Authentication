<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirect(string $driver) {
        if(!in_array($driver, ['github', 'google', 'facebook'])) {
            return redirect()->route('login')->withErrors(['error' => 'Unsupported social driver.']);
        }
        return Socialite::driver($driver)->redirect();
    }

    public function callback(string $driver) {
        if(!in_array($driver, ['github', 'google', 'facebook'])) {
            return redirect()->route('login')->withErrors(['error' => 'Unsupported social driver.']);
        }

        try {
            $socialUser = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Failed to authenticate with ' . ucfirst($driver) . '.']);
        }

        $user = User::firstOrCreate([
            'email' => $socialUser->getEmail(),
        ], [
            'name' => $socialUser->getName(),
            'password' => Hash::make(Str::random(16)),
            'email' => $socialUser->getEmail(),
            'email_verified_at' => now(),
            'otp' => random_int(100000, 999999),
        ]);

        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'You have successfully logged in with GitHub!');
    }
}
