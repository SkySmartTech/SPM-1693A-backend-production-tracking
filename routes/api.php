<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Color\ColorSettingController;
use App\Http\Controllers\Size\SizeSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserRegisterController::class, 'store']);
Route::get('/all-users', [UserController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::put('/user/{id}/update', [UserController::class, 'update']);


Route::post('/color-create', [ColorSettingController::class, 'store']);
Route::get('/all-colors', [ColorSettingController::class, 'index']);
Route::get('/color/{id}', [ColorSettingController::class, 'show']);
Route::put('/color/{id}/update', [ColorSettingController::class, 'update']);
Route::get('/color/{id}/delete', [ColorSettingController::class, 'destroy']);


Route::post('/size-create', [SizeSettingController::class, 'store']);
Route::get('/all-sizes', [SizeSettingController::class, 'index']);
Route::get('/size/{id}', [SizeSettingController::class, 'show']);
Route::put('/size/{id}/update', [SizeSettingController::class, 'update']);
Route::get('/size/{id}/delete', [SizeSettingController::class, 'destroy']);

//Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

