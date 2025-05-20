<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use Illuminate\Support\Facades\Route;


Route::post('user-register', [UserRegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);




Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('all-users', [UserController::class, 'index']);
    Route::get('user', [UserController::class, 'show']);
    Route::put('user/{id}/update', [UserController::class, 'update']);
    Route::post('user/{id}/profile-update', [UserController::class, 'profile_update']);

});

