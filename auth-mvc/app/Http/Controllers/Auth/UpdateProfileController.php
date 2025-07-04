<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UpdateProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::id());

        $data = $request->validated();
        $data['logout_other_devices'] = $request->has('logout_other_devices') ? true : false;
        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}
