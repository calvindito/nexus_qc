<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'AuthController@index');

Route::middleware('auth.login')->group(function() {
    Route::get('dashboard', 'DashboardController@index');

    Route::prefix('auth')->group(function() {
        Route::get('logout', 'AuthController@logout');
    });

    // Route::prefix('master_data')->group(function() {
    //     Route::prefix('general')->group(function() {
    //         Route::prefix('group_defect')->group(function() {
    //             Route::get('/', 'GroupDefectController@index');
    //             Route::get('datatable', 'GroupDefectController@datatable');
    //             Route::post('create', 'GroupDefectController@create');
    //             Route::get('show', 'GroupDefectController@show');
    //             Route::post('update/{id}', 'GroupDefectController@update');
    //         });
    //     });
    // });

    Route::prefix('group_defect')->group(function() {
        Route::prefix('group')->group(function() {
            Route::get('/', 'GroupController@index');
            Route::get('datatable', 'GroupController@datatable');
            Route::post('create', 'GroupController@create');
            Route::post('update', 'GroupController@update');
        });
    });
});
