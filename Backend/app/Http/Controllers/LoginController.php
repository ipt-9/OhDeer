<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(LoginUserRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['token' => $request->user()->createToken('auth_token')->plainTextToken]);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
