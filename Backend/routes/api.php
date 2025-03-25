<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('{id}', 'GetUserInfo')->whereNumber('id');
});

Route::prefix('posts')->controller(PostController::class)->group(function () {
    Route::get('all', 'index');
    Route::get('{id}', 'GetOnePost')->whereNumber('id');
    Route::put('update/{id}', 'update')->whereNumber('id');//->middleware('auth:sanctum');
    Route::post('create', 'store');//->middleware('auth:sanctum');
});

