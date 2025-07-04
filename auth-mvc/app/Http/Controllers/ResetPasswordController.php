<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $result = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('email', $request->email)
            ->firstOrFail();

        if(!$result) {
            return back()->with('error', 'Invalid token or email.');
        }

        DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('email', $request->email)
            ->delete();

        $user = User::where('email', $request->email)->firstOrFail();
        $user->update([ 'password' => bcrypt($request->password) ]);

        return redirect()->route('login')->with('success', 'Password reset successfully, try to login now.');
    }
}
