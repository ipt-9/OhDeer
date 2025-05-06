<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(LoginUserRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['token' => $request->user()
                ->createToken('auth_token', ['*'], now()->addHours(2)
                )->plainTextToken]);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ['message' => 'Logged out'];
    }
}
