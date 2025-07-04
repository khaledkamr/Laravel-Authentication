<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetLinkMail;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
            );

        Mail::to($request->email)->send(new SendResetLinkMail($token));

        return back()->with('success', 'Password reset link sent successfully.');
    }
}
