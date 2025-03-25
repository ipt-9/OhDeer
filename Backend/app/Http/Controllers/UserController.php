<?php

namespace App\Http\Controllers;

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
        return ['message' => 'User has been removed from database' ];
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());
        $user->save();

        return ['message' => 'User has been updated' ];
    }

}
