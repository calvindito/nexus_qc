<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'AuthController@index');

Route::middleware('auth.login')->group(function() {
    Route::get('dashboard', 'DashboardController@index');

    Route::prefix('auth')->group(function() {
        Route::get('logout', 'AuthController@logout');
    });

    Route::prefix('master_data')->group(function() {
        Route::prefix('general')->group(function() {
            Route::prefix('gender')->group(function() {
                Route::get('/', 'GenderController@index');
                Route::get('datatable', 'GenderController@datatable');
                Route::post('create', 'GenderController@create');
                Route::post('update', 'GenderController@update');
            });

            Route::prefix('class_product')->group(function() {
                Route::get('/', 'ClassProductController@index');
                Route::get('datatable', 'ClassProductController@datatable');
                Route::post('create', 'ClassProductController@create');
                Route::post('update', 'ClassProductController@update');
            });
        });
    });

    Route::prefix('group_defect')->group(function() {
        Route::prefix('group')->group(function() {
            Route::get('/', 'GroupController@index');
            Route::get('datatable', 'GroupController@datatable');
            Route::post('create', 'GroupController@create');
            Route::post('update', 'GroupController@update');
        });

        Route::prefix('sub_group')->group(function() {
            Route::get('/', 'SubGroupController@index');
            Route::get('datatable', 'SubGroupController@datatable');
            Route::post('create', 'SubGroupController@create');
            Route::post('update', 'SubGroupController@update');
        });

        Route::prefix('defect_list')->group(function() {
            Route::get('/', 'DefectListController@index');
            Route::get('datatable', 'DefectListController@datatable');
            Route::post('create', 'DefectListController@create');
            Route::post('update', 'DefectListController@update');
        });

        Route::prefix('reject_list')->group(function() {
            Route::get('/', 'RejectListController@index');
            Route::get('datatable', 'RejectListController@datatable');
            Route::post('create', 'RejectListController@create');
            Route::post('update', 'RejectListController@update');
        });

        Route::prefix('major_defect_list')->group(function() {
            Route::get('/', 'MajorDefectListController@index');
            Route::get('datatable', 'MajorDefectListController@datatable');
            Route::post('create', 'MajorDefectListController@create');
            Route::post('update', 'MajorDefectListController@update');
        });

        Route::prefix('critical_defect_list')->group(function() {
            Route::get('/', 'CriticalDefectListController@index');
            Route::get('datatable', 'CriticalDefectListController@datatable');
            Route::post('create', 'CriticalDefectListController@create');
            Route::post('update', 'CriticalDefectListController@update');
        });
    });
});
