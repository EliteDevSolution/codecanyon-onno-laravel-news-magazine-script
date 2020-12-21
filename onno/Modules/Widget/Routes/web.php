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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],
    function () {
        Route::prefix('widget')->group(function () {
            Route::group(['middleware' => ['loginCheck']], function () {

                Route::group(['middleware' => ['XSS']], function () {

                    Route::get('/', 'WidgetController@widgets')->name('widgets')->middleware('permissionCheck:widget_read');
                    Route::get('/create', 'WidgetController@create')->name('create-widget')->middleware('permissionCheck:widget_write');
                    Route::post('/store', 'WidgetController@store')->name('store-widget')->middleware('permissionCheck:widget_write');


                    Route::get('/edit/{id}', 'WidgetController@edit')->name('edit-widget')->middleware('permissionCheck:widget_write');
                    Route::put('/update/{id}', 'WidgetController@update')->name('update-widget')->middleware('permissionCheck:widget_write');
                });
            });
        });
    });
