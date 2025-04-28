<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Color\ColorSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserRegisterController::class, 'store']);
Route::get('/all-users', [UserController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::put('/users/{id}', [UserController::class, 'update']);

Route::post('/color-create', [ColorSettingController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

