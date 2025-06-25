<?php

use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    // --------------- Register and Login ----------------//
    Route::post('login', 'AuthenticationController@login')->name('login');
    Route::post('register', 'AuthenticationController@register')->name('register');

    // ------------------ Get Data ----------------------//
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'AuthenticationController@logOut')->name('logout');
    });

    Route::middleware('auth:sanctum')->group(function () {
        // Dashboard routes
        Route::get('all-employees', [DashboardController::class, 'allEmployeeCount']);

        Route::get('employee/list', [EmployeeController::class, 'list']);
        Route::post('employee/create', [EmployeeController::class, 'create']);
        Route::put('employee/{id}/update', [EmployeeController::class, 'update']);
        Route::get('employee/{id}/show', [EmployeeController::class, 'show']);
        Route::delete('employee/{id}/delete', [EmployeeController::class, 'delete']);


        Route::get('attendance/list', [AttendanceController::class, 'list']);
        Route::post('attendance/create', [AttendanceController::class, 'create']);
        Route::put('attendance/{id}/update', [AttendanceController::class, 'update']);
        Route::get('attendance/{id}/show', [AttendanceController::class, 'show']);
        Route::delete('attendance/{id}/delete', [AttendanceController::class, 'delete']);
        Route::get('attendance/total', [DashboardController::class, 'totalAttendance']);

        Route::get('salary/list',[SalaryController::class, 'list']);
        Route::post('salary/create',[SalaryController::class, 'create']);
        Route::put('salary/{id}/update', [SalaryController::class, 'update']);
        Route::get('salary/{id}/show', [SalaryController::class, 'show']);
        Route::delete('salary/{id}/delete', [SalaryController::class, 'delete']);

        Route::get('total-salary', [DashboardController::class, 'totalSalary']);

    });
});
