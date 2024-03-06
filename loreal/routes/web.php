<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Start frontend routes

Route::group([
    'prefix'    => "admin",
    'namespace' => "Backend",
], function () {

    //loreal Sio Reports
    Route::group(['prefix' => "io-reports", 'as' => 'io_reports.'], function () {

        Route::get('/{id}/destroy', 'IoReportsController@destroy')->name('destroy');

        Route::get('/', 'IoReportsController@index')->name('index');

        Route::get('ajax/{id}/show', 'IoReportsController@ajax_show');

    });

    //loreal Incident Reports
    Route::group(['prefix' => "incident-reports", 'as' => 'incident_reports.'], function () {

        Route::get('/{id}/destroy', 'IncidentReportsController@destroy')->name('destroy');

        Route::get('/', 'IncidentReportsController@index')->name('index');

        Route::get('ajax/{id}/show', 'IncidentReportsController@ajax_show');

    });

//loreal Mesur Reports
    Route::group(['prefix' => "mesur-reports", 'as' => 'mesur_reports.'], function () {

        Route::get('/{id}/destroy', 'MesurReportsController@destroy')->name('destroy');

        Route::get('/', 'MesurReportsController@index')->name('index');

        Route::get('ajax/{id}/show', 'MesurReportsController@ajax_show');

    });




});

// Start frontend routes
Route::get('/', "HomeController@index")->name("frontend.home");
Route::group(['prefix' => 'frontend', 'as' => 'frontend.'], function () {
    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
        Route::post("employee/validate-id", "AjaxHomeController@validateEmpId")->name('validateEmpId');
        Route::get("area/locations", "AjaxHomeController@getAreaLocations")->name('get-area-locations');
        Route::get("risks/{type}", "AjaxHomeController@getRisksByType")->name('get-risks-by-type');

    });

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::post("io/store", "ReportsController@storeIo")->name('io.store');
        Route::post("mesur/store", "ReportsController@storeMesur")->name('mesur.store');
        Route::post("incident/store", "ReportsController@storeIncident")->name('incident.store');
    });

});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
