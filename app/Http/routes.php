<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();


Route::get('termsandconditions', function () {
    return view('termsandconditions');
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // Site
    Route::resource('site', 'SiteController', [
        'except' => ['edit', 'update']
    ]);

    // User settings
    Route::get('user', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::post('user', ['as' => 'user.update', 'uses' => 'UserController@update']);

    // Wordpress
    Route::get('wordpress', ['as' => 'wordpress', 'uses' => 'HomeController@wordpress']);

    // Reports
    Route::get('reports', ['as' => 'reports.index', 'uses' => 'ReportsController@index']);
});

// API
Route::group(['middleware' => 'auth:api', 'prefix' => 'api'], function() {
    Route::get('links', ['as' => 'api.links', 'uses' => 'ApiController@links']);
});

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::auth();

    Route::group(['middleware' => 'auth:admin'], function() {
        // Admin
        Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

        // Settings
        Route::get('settings', ['as' => 'admin.settings.edit', 'uses' => 'SettingsController@edit']);
        Route::post('settings', ['as' => 'admin.settings.update', 'uses' => 'SettingsController@update']);

        // Link
        Route::resource('link', 'LinkController', [
            'except' => 'show'
        ]);
        Route::get('link/{link}/confirm-delete', ['as' => 'admin.link.confirm-delete', 'uses' => 'LinkController@confirmDelete']);

        // Price Point
        Route::resource('pricepoint', 'PricePointController', [
            'except' => 'show'
        ]);
        Route::get('pricepoint/{pricepoint}/confirm-delete', ['as' => 'admin.pricepoint.confirm-delete', 'uses' => 'PricePointController@confirmDelete']);

        // User
        Route::resource('user', 'UserController', [
            'except' => ['create', 'store', 'show']
        ]);
        Route::get('user/{user}/confirm-delete', ['as' => 'admin.user.confirm-delete', 'uses' => 'UserController@confirmDelete']);

        // Site
        Route::resource('site', 'SiteController', [
            'except' => ['create', 'store', 'show']
        ]);
        Route::get('site/{site}/confirm-delete', ['as' => 'admin.site.confirm-delete', 'uses' => 'SiteController@confirmDelete']);
        Route::post('site/{site}/new-token', ['as' => 'admin.site.new-token', 'uses' => 'SiteController@newToken']);

        // Reports
        Route::get('report', ['as' => 'admin.report.index', 'uses' => 'ReportController@index']);
        Route::get('report/{report}', ['as' => 'admin.report.show', 'uses' => 'ReportController@show']);
        Route::post('report/{report}/pay', ['as' => 'admin.report.pay', 'uses' => 'ReportController@pay']);
    });
});
