<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('{id}', 'GetUserInfo')->whereNumber('id');
    Route::delete('delete', 'delete')->middleware('auth:sanctum');
    Route::put('update', 'update')->middleware('auth:sanctum');
    Route::post('register', 'register');
});

Route::prefix('posts')->controller(PostController::class)->group(function () {
    Route::get('all', 'index');
    Route::get('{id}', 'GetOnePost')->whereNumber('id');
    Route::put('update/{id}', 'update')->whereNumber('id')->middleware('auth:sanctum');
    Route::post('create', 'store')->middleware('auth:sanctum');
    Route::delete('delete/{id}', 'delete')->whereNumber('id')->middleware('auth:sanctum');
    Route::get('category/{id}', 'getCategoryPosts')->whereNumber('id');
});

Route::prefix('auth')->controller(LoginController::class)->group(function () {
   Route::post('login', 'authenticate');
   Route::post('hashsample', 'hashsample');
   Route::get('testauth', 'testauth')->middleware('auth:sanctum');
});

Route::prefix('purchases')->controller(PurchaseController::class)->group(function () {
    Route::get('all', 'index')->middleware('auth:sanctum');
    Route::get('{id}', 'show')->whereNumber('id')->middleware('auth:sanctum');
    Route::post('saveTransactions', 'store')->middleware('auth:sanctum');
    Route::get('totals', 'GetTotal')->middleware('auth:sanctum');
});
