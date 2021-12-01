<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', 'AuthController@login');
Route::match(['get', 'post'], 'verification', 'AuthController@verification');

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
        Route::prefix('departement')->group(function() {
            Route::get('/', 'DepartementController@index');
            Route::get('datatable', 'DepartementController@datatable');
        });

        Route::prefix('rank')->group(function() {
            Route::get('/', 'RankController@index');
            Route::get('datatable', 'RankController@datatable');
        });

        Route::prefix('section')->group(function() {
            Route::get('/', 'SectionController@index');
            Route::get('datatable', 'SectionController@datatable');
            Route::post('create', 'SectionController@create');
            Route::post('show', 'SectionController@show');
            Route::post('update/{id}', 'SectionController@update');
            Route::post('change_status', 'SectionController@changeStatus');
            Route::post('destroy', 'SectionController@destroy');
        });

        Route::prefix('line')->group(function() {
            Route::get('/', 'LineController@index');
            Route::get('datatable', 'LineController@datatable');
            Route::post('create', 'LineController@create');
            Route::post('show', 'LineController@show');
            Route::post('update/{id}', 'LineController@update');
            Route::post('change_status', 'LineController@changeStatus');
            Route::post('destroy', 'LineController@destroy');
        });

        Route::prefix('job_desc')->group(function() {
            Route::get('/', 'JobDescController@index');
            Route::get('datatable', 'JobDescController@datatable');
            Route::post('create', 'JobDescController@create');
            Route::post('show', 'JobDescController@show');
            Route::post('update/{id}', 'JobDescController@update');
            Route::post('change_status', 'JobDescController@changeStatus');
            Route::post('destroy', 'JobDescController@destroy');
        });

        Route::prefix('allowance_smv')->group(function() {
            Route::get('/', 'AllowanceSmvController@index');
            Route::get('datatable', 'AllowanceSmvController@datatable');
            Route::post('create', 'AllowanceSmvController@create');
            Route::post('show', 'AllowanceSmvController@show');
            Route::post('update/{id}', 'AllowanceSmvController@update');
            Route::post('destroy', 'AllowanceSmvController@destroy');
        });
    });

    Route::prefix('material')->group(function() {
        Route::prefix('fabric')->group(function() {
            Route::get('/', 'FabricController@index');
            Route::get('datatable', 'FabricController@datatable');
            Route::post('create', 'FabricController@create');
            Route::post('show', 'FabricController@show');
            Route::post('update/{id}', 'FabricController@update');
            Route::post('change_status', 'FabricController@changeStatus');
            Route::post('destroy', 'FabricController@destroy');
        });

        Route::prefix('color')->group(function() {
            Route::get('/', 'ColorController@index');
            Route::get('datatable', 'ColorController@datatable');
            Route::post('create', 'ColorController@create');
            Route::post('show', 'ColorController@show');
            Route::post('update/{id}', 'ColorController@update');
            Route::post('change_status', 'ColorController@changeStatus');
            Route::post('destroy', 'ColorController@destroy');
        });
    });

    Route::prefix('location')->group(function() {
        Route::prefix('country')->group(function() {
            Route::get('/', 'CountryController@index');
            Route::get('datatable', 'CountryController@datatable');
            Route::post('create', 'CountryController@create');
            Route::post('show', 'CountryController@show');
            Route::post('update/{id}', 'CountryController@update');
            Route::post('destroy', 'CountryController@destroy');
        });

        Route::prefix('province')->group(function() {
            Route::get('/', 'ProvinceController@index');
            Route::get('datatable', 'ProvinceController@datatable');
            Route::post('create', 'ProvinceController@create');
            Route::post('show', 'ProvinceController@show');
            Route::post('update/{id}', 'ProvinceController@update');
            Route::post('destroy', 'ProvinceController@destroy');
        });

        Route::prefix('city')->group(function() {
            Route::get('/', 'CityController@index');
            Route::get('datatable', 'CityController@datatable');
            Route::post('create', 'CityController@create');
            Route::post('show', 'CityController@show');
            Route::post('update/{id}', 'CityController@update');
            Route::post('destroy', 'CityController@destroy');
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
            Route::post('destroy', 'GroupController@destroy');
        });

        Route::prefix('defect_list')->group(function() {
            Route::get('/', 'DefectListController@index');
            Route::get('datatable', 'DefectListController@datatable');
            Route::post('create', 'DefectListController@create');
            Route::post('show', 'DefectListController@show');
            Route::post('update/{id}', 'DefectListController@update');
            Route::post('change_status', 'DefectListController@changeStatus');
            Route::post('destroy', 'DefectListController@destroy');
        });

        Route::prefix('reject_list')->group(function() {
            Route::get('/', 'RejectListController@index');
            Route::get('datatable', 'RejectListController@datatable');
            Route::post('create', 'RejectListController@create');
            Route::post('show', 'RejectListController@show');
            Route::post('update/{id}', 'RejectListController@update');
            Route::post('change_status', 'RejectListController@changeStatus');
            Route::post('destroy', 'RejectListController@destroy');
        });

        Route::prefix('major_issues')->group(function() {
            Route::get('/', 'MajorIssuesController@index');
            Route::get('datatable', 'MajorIssuesController@datatable');
            Route::post('create', 'MajorIssuesController@create');
            Route::post('show', 'MajorIssuesController@show');
            Route::post('update/{id}', 'MajorIssuesController@update');
            Route::post('change_status', 'MajorIssuesController@changeStatus');
            Route::post('destroy', 'MajorIssuesController@destroy');
        });

        Route::prefix('critical_issues')->group(function() {
            Route::get('/', 'CriticalIssuesController@index');
            Route::get('datatable', 'CriticalIssuesController@datatable');
            Route::post('create', 'CriticalIssuesController@create');
            Route::post('show', 'CriticalIssuesController@show');
            Route::post('update/{id}', 'CriticalIssuesController@update');
            Route::post('change_status', 'CriticalIssuesController@changeStatus');
            Route::post('destroy', 'CriticalIssuesController@destroy');
        });

        Route::prefix('position')->group(function() {
            Route::get('/', 'PositionController@index');
            Route::get('datatable', 'PositionController@datatable');
            Route::match(['get', 'post'], 'bulk', 'PositionController@bulk');
            Route::post('create', 'PositionController@create');
            Route::post('show', 'PositionController@show');
            Route::post('update/{id}', 'PositionController@update');
            Route::post('change_status', 'PositionController@changeStatus');
            Route::post('destroy', 'PositionController@destroy');
        });
    });

    Route::prefix('product')->group(function() {
        Route::prefix('gender')->group(function() {
            Route::get('/', 'GenderController@index');
            Route::get('datatable', 'GenderController@datatable');
            Route::post('create', 'GenderController@create');
            Route::post('show', 'GenderController@show');
            Route::post('update/{id}', 'GenderController@update');
            Route::post('change_status', 'GenderController@changeStatus');
            Route::post('destroy', 'GenderController@destroy');
        });

        Route::prefix('size')->group(function() {
            Route::get('/', 'SizeController@index');
            Route::get('datatable', 'SizeController@datatable');
            Route::post('create', 'SizeController@create');
            Route::post('show', 'SizeController@show');
            Route::post('update/{id}', 'SizeController@update');
            Route::post('change_status', 'SizeController@changeStatus');
            Route::post('destroy', 'SizeController@destroy');
        });

        Route::prefix('group')->group(function() {
            Route::get('/', 'GroupProductController@index');
            Route::get('datatable', 'GroupProductController@datatable');
            Route::post('create', 'GroupProductController@create');
            Route::post('show', 'GroupProductController@show');
            Route::post('update/{id}', 'GroupProductController@update');
            Route::post('change_status', 'GroupProductController@changeStatus');
            Route::post('destroy', 'GroupProductController@destroy');
        });

        Route::prefix('brand')->group(function() {
            Route::get('/', 'BrandController@index');
            Route::get('datatable', 'BrandController@datatable');
            Route::post('create', 'BrandController@create');
            Route::post('show', 'BrandController@show');
            Route::post('update/{id}', 'BrandController@update');
            Route::post('change_status', 'BrandController@changeStatus');
            Route::post('destroy', 'BrandController@destroy');
        });

        Route::prefix('class')->group(function() {
            Route::get('/', 'ClassProductController@index');
            Route::get('datatable', 'ClassProductController@datatable');
            Route::post('create', 'ClassProductController@create');
            Route::post('show', 'ClassProductController@show');
            Route::post('update/{id}', 'ClassProductController@update');
            Route::post('change_status', 'ClassProductController@changeStatus');
            Route::post('destroy', 'ClassProductController@destroy');
        });

        Route::prefix('type')->group(function() {
            Route::get('/', 'TypeProductController@index');
            Route::get('datatable', 'TypeProductController@datatable');
            Route::post('get_gender', 'TypeProductController@getGender');
            Route::match(['get', 'post'], 'bulk', 'TypeProductController@bulk');
            Route::post('create', 'TypeProductController@create');
            Route::post('show', 'TypeProductController@show');
            Route::post('update/{id}', 'TypeProductController@update');
            Route::post('change_status', 'TypeProductController@changeStatus');
            Route::post('destroy', 'TypeProductController@destroy');
        });

        Route::prefix('style')->group(function() {
            Route::get('/', 'StyleController@index');
            Route::get('datatable', 'StyleController@datatable');
            Route::post('create', 'StyleController@create');
            Route::post('show', 'StyleController@show');
            Route::post('update/{id}', 'StyleController@update');
            Route::post('change_status', 'StyleController@changeStatus');
            Route::post('destroy', 'StyleController@destroy');
        });

        Route::prefix('manage')->group(function() {
            Route::get('/', 'ManageProductController@index');
            Route::get('datatable', 'ManageProductController@datatable');
            Route::post('load_content', 'ManageProductController@loadContent');
            Route::post('submitable', 'ManageProductController@submitable');
        });
    });

    Route::prefix('contact')->group(function() {
        Route::prefix('buyer')->group(function() {
            Route::get('/', 'BuyerController@index');
            Route::get('datatable', 'BuyerController@datatable');
            Route::post('row_detail', 'BuyerController@rowDetail');
            Route::match(['get', 'post'], 'bulk', 'BuyerController@bulk');
            Route::post('create', 'BuyerController@create');
            Route::post('show', 'BuyerController@show');
            Route::post('update/{id}', 'BuyerController@update');
            Route::post('change_status', 'BuyerController@changeStatus');
            Route::post('destroy', 'BuyerController@destroy');
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
            Route::post('destroy', 'WorkingHoursTypeController@destroy');
        });

        Route::prefix('chart')->group(function() {
            Route::get('/', 'WorkingHoursChartController@index');
        });
    });

    Route::prefix('order')->group(function() {
        Route::prefix('production')->group(function() {
            Route::get('/', 'ProductionController@index');
            Route::get('datatable', 'ProductionController@datatable');
            Route::post('get_size', 'ProductionController@getSize');
            Route::post('create', 'ProductionController@create');
            Route::post('show', 'ProductionController@show');
            Route::post('update/{id}', 'ProductionController@update');
            Route::post('destroy', 'ProductionController@destroy');
        });
    });

    Route::prefix('setting')->group(function() {
        Route::prefix('account')->group(function() {
            Route::get('/', 'SettingController@account');
            Route::post('profile', 'SettingController@profile');
            Route::post('change_password', 'SettingController@changePassword');
            Route::get('load_activity', 'SettingController@loadActivity');
            Route::post('two_factor_authentication', 'SettingController@twoFactorAuthentication');
        });

        Route::prefix('user')->group(function() {
            Route::get('/', 'UserController@index');
            Route::get('datatable', 'UserController@datatable');
            Route::post('create', 'UserController@create');
            Route::post('show', 'UserController@show');
            Route::post('update/{id}', 'UserController@update');
            Route::post('reset_password', 'UserController@resetPassword');
            Route::post('change_status', 'UserController@changeStatus');
            Route::post('destroy', 'UserController@destroy');
        });

        Route::prefix('activity')->group(function() {
            Route::get('/', 'ActivityController@index');
            Route::get('datatable', 'ActivityController@datatable');
        });
    });
});
