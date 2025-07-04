<?php

namespace App\Http\Controllers\Api;

use App\Enums\TokenAbilities;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => UserResource::make($user),
            ]
        ], 201);
    }
    
    public function login(LoginRequest $request) 
    {
        $user = User::where('email', $request->input('email'))->first();
        if(!$user || !Hash::check($request->input('password'), $user->password))
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        $access_token = $user->createToken('access-token', [TokenAbilities::ACCESS_API->value], Carbon::now()->addMinute(config('sanctum.access_token_expiration')))->plainTextToken;
        $refresh_token = $user->createToken('refresh-token', [TokenAbilities::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinute(config('sanctum.refresh_token_expiration')))->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'data' => [
                'user' => UserResource::make($user),
                'access_token' => $access_token,
                'refresh_token' => $refresh_token,
            ]
        ], 200);
    }

    public function profile() 
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => UserResource::make(Auth::user()),
            ]
        ], 200);
    }

    public function refresh(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $access_token = $user->createToken('access-token', [TokenAbilities::ACCESS_API->value], Carbon::now()->addMinute(config('sanctum.access_token_expiration')))->plainTextToken;
        $refresh_token = $user->createToken('refresh-token', [TokenAbilities::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinute(config('sanctum.refresh_token_expiration')))->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Tokens refreshed successfully',
            'data' => [
                'access_token' => $access_token,
                'refresh_token' => $refresh_token,
            ]
        ], 200);
    }

    public function logout(Request $request) 
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ], 200);
    }
}
