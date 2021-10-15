<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'AuthController@index');

Route::middleware('auth.login')->group(function() {
    Route::get('dashboard', 'DashboardController@index');

    Route::prefix('auth')->group(function() {
        Route::get('logout', 'AuthController@logout');
    });

    Route::prefix('load_data')->group(function() {
        Route::post('country', 'LoadDataController@country');
        Route::post('province', 'LoadDataController@province');
        Route::post('city', 'LoadDataController@city');
    });

    Route::prefix('download')->group(function() {
        Route::get('pdf/{param}', 'DownloadController@pdf');
        Route::get('excel/{param}', 'DownloadController@excel');
        Route::get('excel_template/{param}', 'DownloadController@excelTemplate');
    });

    Route::prefix('global')->group(function() {
        Route::prefix('rank')->group(function() {
            Route::get('/', 'RankController@index');
            Route::get('datatable', 'RankController@datatable');
        });

        Route::prefix('departement')->group(function() {
            Route::get('/', 'DepartementController@index');
            Route::get('datatable', 'DepartementController@datatable');
        });

        Route::prefix('allowance_smv')->group(function() {
            Route::get('/', 'AllowanceSmvController@index');
            Route::get('datatable', 'AllowanceSmvController@datatable');
            Route::post('create', 'AllowanceSmvController@create');
            Route::post('show', 'AllowanceSmvController@show');
            Route::post('update/{id}', 'AllowanceSmvController@update');
        });
    });

    Route::prefix('general')->group(function() {
        Route::prefix('gender')->group(function() {
            Route::get('/', 'GenderController@index');
            Route::get('datatable', 'GenderController@datatable');
            Route::post('create', 'GenderController@create');
            Route::post('show', 'GenderController@show');
            Route::post('update/{id}', 'GenderController@update');
            Route::post('change_status', 'GenderController@changeStatus');
        });

        Route::prefix('group_size')->group(function() {
            Route::get('/', 'GroupSizeController@index');
            Route::get('datatable', 'GroupSizeController@datatable');
            Route::post('create', 'GroupSizeController@create');
            Route::post('show', 'GroupSizeController@show');
            Route::post('update/{id}', 'GroupSizeController@update');
            Route::post('change_status', 'GroupSizeController@changeStatus');
        });

        Route::prefix('buyer')->group(function() {
            Route::get('/', 'BuyerController@index');
            Route::get('datatable', 'BuyerController@datatable');
            Route::post('row_detail', 'BuyerController@rowDetail');
            Route::post('get_gender', 'BuyerController@getGender');
            Route::match(['get', 'post'], 'bulk', 'BuyerController@bulk');
            Route::post('create', 'BuyerController@create');
            Route::post('show', 'BuyerController@show');
            Route::post('update/{id}', 'BuyerController@update');
            Route::post('change_status', 'BuyerController@changeStatus');
        });

        Route::prefix('brand')->group(function() {
            Route::get('/', 'BrandController@index');
            Route::get('datatable', 'BrandController@datatable');
            Route::post('create', 'BrandController@create');
            Route::post('show', 'BrandController@show');
            Route::post('update/{id}', 'BrandController@update');
            Route::post('change_status', 'BrandController@changeStatus');
        });

        Route::prefix('fabric')->group(function() {
            Route::get('/', 'FabricController@index');
            Route::get('datatable', 'FabricController@datatable');
            Route::post('create', 'FabricController@create');
            Route::post('show', 'FabricController@show');
            Route::post('update/{id}', 'FabricController@update');
            Route::post('change_status', 'FabricController@changeStatus');
        });

        Route::prefix('color')->group(function() {
            Route::get('/', 'ColorController@index');
            Route::get('datatable', 'ColorController@datatable');
            Route::post('create', 'ColorController@create');
            Route::post('show', 'ColorController@show');
            Route::post('update/{id}', 'ColorController@update');
            Route::post('change_status', 'ColorController@changeStatus');
        });

        Route::prefix('check_point')->group(function() {
            Route::get('/', 'CheckPointController@index');
            Route::get('datatable', 'CheckPointController@datatable');
            Route::post('create', 'CheckPointController@create');
            Route::post('show', 'CheckPointController@show');
            Route::post('update/{id}', 'CheckPointController@update');
            Route::post('change_status', 'CheckPointController@changeStatus');
        });
    });

    Route::prefix('working_hours')->group(function() {
        Route::prefix('type')->group(function() {
            Route::get('/', 'WorkingHoursTypeController@index');
            Route::get('datatable', 'WorkingHoursTypeController@datatable');
            Route::post('detail', 'WorkingHoursTypeController@detail');
            Route::match(['get', 'post'], 'create', 'WorkingHoursTypeController@create');
            Route::match(['get', 'post'], 'update/{id}', 'WorkingHoursTypeController@update');
            Route::post('change_status', 'WorkingHoursTypeController@changeStatus');
        });
    });

    Route::prefix('group_defect')->group(function() {
        Route::prefix('group')->group(function() {
            Route::get('/', 'GroupController@index');
            Route::get('datatable', 'GroupController@datatable');
            Route::post('create', 'GroupController@create');
            Route::post('show', 'GroupController@show');
            Route::post('update/{id}', 'GroupController@update');
            Route::post('change_status', 'GroupController@changeStatus');
        });

        Route::prefix('sub_group')->group(function() {
            Route::get('/', 'SubGroupController@index');
            Route::get('datatable', 'SubGroupController@datatable');
            Route::post('create', 'SubGroupController@create');
            Route::post('show', 'SubGroupController@show');
            Route::post('update/{id}', 'SubGroupController@update');
            Route::post('change_status', 'SubGroupController@changeStatus');
        });

        Route::prefix('defect_list')->group(function() {
            Route::get('/', 'DefectListController@index');
            Route::get('datatable', 'DefectListController@datatable');
            Route::post('create', 'DefectListController@create');
            Route::post('show', 'DefectListController@show');
            Route::post('update/{id}', 'DefectListController@update');
            Route::post('change_status', 'DefectListController@changeStatus');
        });

        Route::prefix('reject_list')->group(function() {
            Route::get('/', 'RejectListController@index');
            Route::get('datatable', 'RejectListController@datatable');
            Route::post('create', 'RejectListController@create');
            Route::post('show', 'RejectListController@show');
            Route::post('update/{id}', 'RejectListController@update');
            Route::post('change_status', 'RejectListController@changeStatus');
        });

        Route::prefix('major_defect_list')->group(function() {
            Route::get('/', 'MajorDefectListController@index');
            Route::get('datatable', 'MajorDefectListController@datatable');
            Route::post('create', 'MajorDefectListController@create');
            Route::post('show', 'MajorDefectListController@show');
            Route::post('update/{id}', 'MajorDefectListController@update');
            Route::post('change_status', 'MajorDefectListController@changeStatus');
        });

        Route::prefix('critical_defect_list')->group(function() {
            Route::get('/', 'CriticalDefectListController@index');
            Route::get('datatable', 'CriticalDefectListController@datatable');
            Route::post('create', 'CriticalDefectListController@create');
            Route::post('show', 'CriticalDefectListController@show');
            Route::post('update/{id}', 'CriticalDefectListController@update');
            Route::post('change_status', 'CriticalDefectListController@changeStatus');
        });
    });

    Route::prefix('location')->group(function() {
        Route::prefix('country')->group(function() {
            Route::get('/', 'CountryController@index');
            Route::get('datatable', 'CountryController@datatable');
            Route::post('create', 'CountryController@create');
            Route::get('show', 'CountryController@show');
            Route::post('update/{id}', 'CountryController@update');
        });

        Route::prefix('province')->group(function() {
            Route::get('/', 'ProvinceController@index');
            Route::get('datatable', 'ProvinceController@datatable');
            Route::post('create', 'ProvinceController@create');
            Route::get('show', 'ProvinceController@show');
            Route::post('update/{id}', 'ProvinceController@update');
        });

        Route::prefix('city')->group(function() {
            Route::get('/', 'CityController@index');
            Route::get('datatable', 'CityController@datatable');
            Route::post('create', 'CityController@create');
            Route::get('show', 'CityController@show');
            Route::post('update/{id}', 'CityController@update');
        });
    });

    Route::prefix('product')->group(function() {
        Route::prefix('class')->group(function() {
            Route::get('/', 'ClassProductController@index');
            Route::get('datatable', 'ClassProductController@datatable');
            Route::post('create', 'ClassProductController@create');
            Route::post('show', 'ClassProductController@show');
            Route::post('update/{id}', 'ClassProductController@update');
            Route::post('change_status', 'ClassProductController@changeStatus');
        });

        Route::prefix('type')->group(function() {
            Route::get('/', 'TypeProductController@index');
            Route::get('datatable', 'TypeProductController@datatable');
            Route::post('get_gender', 'TypeProductController@getGender');
            Route::match(['get', 'post'], 'check_point/{id}', 'TypeProductController@checkPoint');
            Route::match(['get', 'post'], 'bulk', 'TypeProductController@bulk');
            Route::post('create', 'TypeProductController@create');
            Route::post('show', 'TypeProductController@show');
            Route::post('update/{id}', 'TypeProductController@update');
            Route::post('change_status', 'TypeProductController@changeStatus');
        });
    });
});
