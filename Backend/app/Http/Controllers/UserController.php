<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
       return User::with('userType', 'language', 'subscription')->get();
    }
    public function GetUserInfo($id)
    {
        return User::with('userType', 'language', 'subscription')->where('id', $id)->first();
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
        $user->repair_rating = 0.0;
        $user->general_rating = 0.0;
        $user->user_type_id = 1;
        $user->language_id = 1;
        $user->subscription_id = 1;
        $user->save();

        return response()->json(['message' => 'User has been registered', 'user' => $user ]);
    }

    public function getAllPosts($id){
        $user = User::with('posts')->find($id);
        return $user->posts;
    }
    public function getAllRatings($id){
        $user = User::with(['purchases' => function($query) {
            $query->select('general_rating', 'repair_rating', 'rating_comment', 'user_id' ,'id');
        }])->find($id);
        return $user->purchases;
    }
}
