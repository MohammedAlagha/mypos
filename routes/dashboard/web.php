<?php


/*
|--------------------------------------------------------------------------
| dashboard Routes
|--------------------------------------------------------------------------

*/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');

            // users routes
            Route::resource('users', 'UserController')->except(['show']);
            Route::get('users-data', 'UserController@data')->name('users.data');

             // categories routes
            Route::resource('categories', 'CategoryController')->except(['show']);
            Route::get('categories-data', 'CategoryController@data')->name('categories.data');

             // products routes
            Route::resource('products', 'ProductController');
            Route::get('products-data', 'ProductController@data')->name('products.data');

             //clients  routes
            Route::resource('clients', 'ClientController');
            Route::get('clients-data', 'ClientController@data')->name('clients.data');
            Route::resource('clients.orders', 'Client\OrderController');

            //orders routes
            Route::resource('orders', 'OrderController');
            Route::get('order-data', 'OrderController@data')->name('orders.data');


        });//end of dashboard Routes
    });
