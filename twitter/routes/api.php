<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tweets', [TweetController::class, 'index']);
Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users/{id}/tweets', [UserController::class, 'tweets']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/auth', [LoginController::class, 'checkAuth'])->middleware('auth:sanctum');
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::put('/me', [UserController::class, 'updateMe'])->middleware('auth:sanctum');
Route::delete('/me', [UserController::class, 'deleteMe'])->middleware('auth:sanctum');
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
