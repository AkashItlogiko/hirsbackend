<?php

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    // --------------- Register and Login ----------------//
    Route::post('login', 'AuthenticationController@login')->name('login');
    Route::post('register', 'AuthenticationController@register')->name('register');

    // ------------------ Get Data ----------------------//
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('get-user', 'AuthenticationController@userInfo')->name('get-user');
        Route::post('logout', 'AuthenticationController@logOut')->name('logout');
        Route::get('employees', [EmployeeController::class,'index']);
    });
});
