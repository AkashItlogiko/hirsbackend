<?php

use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    // --------------- Register and Login ----------------//
    Route::post('login', 'AuthenticationController@login')->name('login');
    Route::post('register', 'AuthenticationController@register')->name('register');

    // ------------------ Get Data ----------------------//
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'AuthenticationController@logOut')->name('logout');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('employee/list', [EmployeeController::class, 'list']);
        Route::get('attendance/list', [AttendanceController::class, 'list']);
        Route::get('salary/list',[SalaryController::class, 'list']);
    });
});
