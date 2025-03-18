<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'GetUserInfo'])->whereNumber('id');
