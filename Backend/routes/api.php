<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts/all', [\App\Http\Controllers\PostController::class, 'index']);

Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'GetUserInfo'])->whereNumber('id');

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'GetOnePost'])->whereNumber('id');
Route::get('/post/create', [App\Http\Controllers\PostController::class, 'store'])->middleware('auth:sanctum');
