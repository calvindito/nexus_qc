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

            Route::prefix('group_size')->group(function() {
                Route::get('/', 'GroupSizeController@index');
                Route::get('datatable', 'GroupSizeController@datatable');
                Route::post('create', 'GroupSizeController@create');
                Route::post('update', 'GroupSizeController@update');
            });

            Route::prefix('type_product')->group(function() {
                Route::get('/', 'TypeProductController@index');
                Route::get('datatable', 'TypeProductController@datatable');
                Route::post('create', 'TypeProductController@create');
                Route::post('update', 'TypeProductController@update');
            });

            Route::prefix('buyer')->group(function() {
                Route::get('/', 'BuyerController@index');
                Route::get('datatable', 'BuyerController@datatable');
                Route::post('create', 'BuyerController@create');
                Route::post('update', 'BuyerController@update');
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

    Route::prefix('location')->group(function() {
        Route::prefix('country')->group(function() {
            Route::get('/', 'CountryController@index');
            Route::get('datatable', 'CountryController@datatable');
            Route::post('create', 'CountryController@create');
            Route::get('show', 'CountryController@show');
            Route::post('update/{id}', 'CountryController@update');
            Route::post('destroy', 'CountryController@destroy');
        });

        Route::prefix('province')->group(function() {
            Route::get('/', 'ProvinceController@index');
            Route::get('datatable', 'ProvinceController@datatable');
            Route::post('create', 'ProvinceController@create');
            Route::get('show', 'ProvinceController@show');
            Route::post('update/{id}', 'ProvinceController@update');
            Route::post('destroy', 'ProvinceController@destroy');
        });

        Route::prefix('city')->group(function() {
            Route::get('/', 'CityController@index');
            Route::get('datatable', 'CityController@datatable');
            Route::post('create', 'CityController@create');
            Route::get('show', 'CityController@show');
            Route::post('update/{id}', 'CityController@update');
            Route::post('destroy', 'CityController@destroy');
        });
    });
});
