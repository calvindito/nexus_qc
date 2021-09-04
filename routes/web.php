<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', 'DashboardController@index');

Route::prefix('master_data')->group(function() {
    Route::prefix('general')->group(function() {
        Route::prefix('group_defect')->group(function() {
            Route::get('/', 'GroupDefectController@index');
            Route::get('datatable', 'GroupDefectController@datatable');
        });
    });
});
