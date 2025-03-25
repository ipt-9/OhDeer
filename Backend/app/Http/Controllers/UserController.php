<?php

namespace App\Http\Controllers;

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


}
