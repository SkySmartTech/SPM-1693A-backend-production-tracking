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

    Route::post('color-create', [ColorSettingController::class, 'store']);
    Route::get('all-colors', [ColorSettingController::class, 'index']);
    Route::get('color/{id}/show', [ColorSettingController::class, 'show']);
    Route::post('color/{id}/update', [ColorSettingController::class, 'update']);
    Route::get('color/{id}/delete', [ColorSettingController::class, 'destroy']);


    Route::post('size-create', [SizeSettingController::class, 'store']);
    Route::get('all-sizes', [SizeSettingController::class, 'index']);
    Route::get('size/{id}/show', [SizeSettingController::class, 'show']);
    Route::post('size/{id}/update', [SizeSettingController::class, 'update']);
    Route::get('size/{id}/delete', [SizeSettingController::class, 'destroy']);


    Route::post('style-create', [StyleSettingController::class, 'store']);
    Route::get('all-styles', [StyleSettingController::class, 'index']);
    Route::get('style/{id}/show', [StyleSettingController::class, 'show']);
    Route::post('style/{id}/update', [StyleSettingController::class, 'update']);
    Route::get('style/{id}/delete', [StyleSettingController::class, 'destroy']);


    Route::post('operation-create', [OperationController::class, 'store']);
    Route::get('all-operations', [OperationController::class, 'index']);
    Route::get('operation/{id}/show', [OperationController::class, 'show']);
    Route::post('operation/{id}/update', [OperationController::class, 'update']);
    Route::get('operation/{id}/delete', [OperationController::class, 'destroy']);


    Route::post('defect-create', [DefectController::class, 'store']);
    Route::get('all-defects', [DefectController::class, 'index']);
    Route::get('defect/{id}/show', [DefectController::class, 'show']);
    Route::post('defect/{id}/update', [DefectController::class, 'update']);
    Route::get('defect/{id}/delete', [DefectController::class, 'destroy']);

});
