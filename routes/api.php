<?php

use Illuminate\Routing\Route;
use App\Http\Controllers\User\UserController;


Route::post('register', [UserController::class, 'store']);
