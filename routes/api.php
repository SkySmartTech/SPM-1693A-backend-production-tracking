<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Color\ColorSettingController;
use App\Http\Controllers\Defect\DefectController;
use App\Http\Controllers\Operation\OperationController;
use App\Http\Controllers\Size\SizeSettingController;
use App\Http\Controllers\Style\StyleSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('user-register', [UserRegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);
Route::put('users/{id}/update', [UserController::class, 'update']);



Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('all-users', [UserController::class, 'index']);


});

