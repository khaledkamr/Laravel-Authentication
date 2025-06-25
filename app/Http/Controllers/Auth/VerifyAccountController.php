<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyAccountRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if($user->otp != implode('', $request->otp)) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Account verified successfully, you can now login.');
    }
}
