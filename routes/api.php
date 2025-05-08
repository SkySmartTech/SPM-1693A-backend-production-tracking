<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use Illuminate\Support\Facades\Route;


Route::post('user-register', [UserRegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/logout', [LogoutController::class, 'logout']);
    Route::get('all-users', [UserController::class, 'index']);
    Route::get('user/{id}/profile', [UserController::class, 'profile']);
    Route::post('user/{id}/profile-update', [UserController::class, 'profile_update']);
    Route::post('user/{id}/update', [UserController::class, 'update']);

});

