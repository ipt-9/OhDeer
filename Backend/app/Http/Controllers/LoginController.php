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
            return response()->json(['token' => $request->user()->createToken('auth_token')->plainTextToken]);
        }
        else {
            return response()->json(['error' => 'Unauthorized', 'mail' => $request->input('email'), 'pass' => $request->input('password'), \App\Models\User::all()->first()->getAuthPassword()], 401);
        }
    }

    public function hashsample(Request $request){
        return Hash::make($request->input('password'));
    }
    public function testauth(){
        return 'success';
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ['message' => 'Logged out'];
    }
}
