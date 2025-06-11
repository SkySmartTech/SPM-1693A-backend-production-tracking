<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\CheckPoint\CheckPointController;
use App\Http\Controllers\Color\ColorSettingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DayPlan\DayPlanController;
use App\Http\Controllers\Defect\DefectController;
use App\Http\Controllers\Operation\OperationController;
use App\Http\Controllers\ProductionUpdate\ProductionUpdateController;
use App\Http\Controllers\Size\SizeSettingController;
use App\Http\Controllers\Style\StyleSettingController;
use App\Http\Controllers\Summary\SummaryController;
use App\Http\Controllers\User\UserAccessController;
use App\Http\Controllers\User\UserRoleController;
use Illuminate\Support\Facades\Route;


Route::get('user-role', [UserRoleController::class, 'allUserType']);
Route::post('user-register', [UserRegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('user-logout', [LogoutController::class, 'logout']);


    Route::get('all-users', [UserController::class, 'index']);
    Route::get('user', [UserController::class, 'show']);
    Route::post('user/{id}/profile-update', [UserController::class, 'profileUpdate']);
    Route::post('user/{id}/update', [UserController::class, 'update']);

    Route::post('user-access-create', [UserAccessController::class, 'store']);
    Route::get('user-accesses', [UserAccessController::class, 'index']);
    Route::get('user-access/{id}/show', [UserAccessController::class, 'show']);
    Route::post('user-access/{id}/update', [UserAccessController::class, 'update']);
    Route::delete('user-access/{id}/delete', [UserAccessController::class, 'destroy']);

    Route::post('user-role-create', [UserRoleController::class, 'store']);
    Route::get('user-roles', [UserRoleController::class, 'index']);
    Route::get('user-role/{id}/show', [UserRoleController::class, 'show']);
    Route::post('user-role/{id}/update', [UserRoleController::class, 'update']);
    Route::delete('user-role/{id}/delete', [UserRoleController::class, 'destroy']);

    Route::post('color-create', [ColorSettingController::class, 'store']);
    Route::get('all-colors', [ColorSettingController::class, 'index']);
    Route::get('color/{id}/show', [ColorSettingController::class, 'show']);
    Route::post('color/{id}/update', [ColorSettingController::class, 'update']);
    Route::delete('color/{id}/delete', [ColorSettingController::class, 'destroy']);

    Route::post('size-create', [SizeSettingController::class, 'store']);
    Route::get('all-sizes', [SizeSettingController::class, 'index']);
    Route::get('size/{id}/show', [SizeSettingController::class, 'show']);
    Route::post('size/{id}/update', [SizeSettingController::class, 'update']);
    Route::delete('size/{id}/delete', [SizeSettingController::class, 'destroy']);

    Route::post('style-create', [StyleSettingController::class, 'store']);
    Route::get('all-styles', [StyleSettingController::class, 'index']);
    Route::get('style/{id}/show', [StyleSettingController::class, 'show']);
    Route::post('style/{id}/update', [StyleSettingController::class, 'update']);
    Route::delete('style/{id}/delete', [StyleSettingController::class, 'destroy']);

    Route::post('operation-create', [OperationController::class, 'store']);
    Route::get('all-operations', [OperationController::class, 'index']);
    Route::get('operation/{id}/show', [OperationController::class, 'show']);
    Route::post('operation/{id}/update', [OperationController::class, 'update']);
    Route::delete('operation/{id}/delete', [OperationController::class, 'destroy']);

    Route::post('defect-create', [DefectController::class, 'store']);
    Route::get('all-defects', [DefectController::class, 'index']);
    Route::get('defect/{id}/show', [DefectController::class, 'show']);
    Route::post('defect/{id}/update', [DefectController::class, 'update']);
    Route::delete('defect/{id}/delete', [DefectController::class, 'destroy']);

    Route::post('check-point-create', [CheckPointController::class, 'store']);
    Route::get('all-check-points', [CheckPointController::class, 'index']);
    Route::get('check-point/{id}/show', [CheckPointController::class, 'show']);
    Route::post('check-point/{id}/update', [CheckPointController::class, 'update']);
    Route::delete('check-point/{id}/delete', [CheckPointController::class, 'destroy']);

    Route::post('day-plan-create', [DayPlanController::class, 'store']);
    Route::get('all-day-plans', [DayPlanController::class, 'index']);
    Route::get('team-no', [DayPlanController::class, 'index']);

    Route::post('production-update', [ProductionUpdateController::class, 'store']);
    Route::get('production-success', [ProductionUpdateController::class, 'countSuccess']);
    Route::get('production-rework', [ProductionUpdateController::class, 'countRework']);
    Route::get('production-defect', [ProductionUpdateController::class, 'countDefect']);
    Route::get('hourly-success', [ProductionUpdateController::class, 'countSuccessPerHour']);

    Route::get('hourly-target', [DashboardController::class, 'countHourlyTarget']);
    Route::get('upto-now-target-archive', [DashboardController::class, 'countUptoNowTargetArchive']);
    Route::get('total-check-qty', [DashboardController::class, 'countTotalCheckQty']);
    Route::get('line-efi', [DashboardController::class, 'countLineEFI']);

    Route::post('summary', [SummaryController::class, 'getSummary']);

});
