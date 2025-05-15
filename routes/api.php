<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\User\UserAccessController;
use App\Http\Controllers\User\UserRoleController;
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

    Route::post('user-access-create', [UserAccessController::class, 'store']);
    Route::get('user-accesses', [UserAccessController::class, 'index']);
    Route::get('user-access/{id}/show', [UserAccessController::class, 'show']);
    Route::post('user-access/{id}/update', [UserAccessController::class, 'update']);
    Route::get('user-access/{id}/delete', [UserAccessController::class, 'destroy']);

    Route::post('user-role-create', [UserRoleController::class, 'store']);
    Route::get('user-roles', [UserRoleController::class, 'index']);
    Route::post('user-role/{id}/update', [UserRoleController::class, 'update']);
    Route::get('user-role/{id}/delete', [UserRoleController::class, 'destroy']);

});
