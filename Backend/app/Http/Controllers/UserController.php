<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function GetUserInfo($id)
    {
        return User::findOrFail($id);
    }

    public function delete(request $request)
    {
        $user = $request->user();
        $user->delete();
        return response()->json(['message' => 'User has been removed from database', 'user' => $user ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());
        $user->save();

        return response()->json(['message' => 'User has been updated', 'user' => $user ]);
    }

    public function register(RegisterUserRequest $request)
    {
        $request->validated();
        $user = new User();

        $user->fill($request->validated());
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type_id = 1;
        $user->language_id = 1;
        $user->subscription_id = 1;
        $user->save();

        return response()->json(['message' => 'User has been registered', 'user' => $user ]);
    }

}
