<?php


/*
|--------------------------------------------------------------------------
| dashboard Routes
|--------------------------------------------------------------------------

*/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

            Route::get('/index', 'DashboardController@index')->name('index');

            Route::resource('users', 'UserController')->except(['show']);
            Route::get('users-data', 'UserController@data')->name('users.data');


        });//end of dashboard Routes
    });
