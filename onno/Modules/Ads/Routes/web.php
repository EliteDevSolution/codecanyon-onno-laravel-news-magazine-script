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
        Route::prefix('ads')->group(function() {
            Route::group(['middleware'=>['loginCheck', 'XSS']],function(){

                Route::get('/', 'AdsController@index')->name('ads')->middleware('permissionCheck:ads_read');
                Route::get('/create', 'AdsController@create')->name('create-ad')->middleware('permissionCheck:ads_write');
                Route::post('/store', 'AdsController@store')->name('store-ad')->middleware('permissionCheck:ads_write');

                Route::get('/edit/{id}', 'AdsController@edit')->name('edit-ad')->middleware('permissionCheck:ads_write');
                Route::post('/update/{id}', 'AdsController@update')->name('update-ad')->middleware('permissionCheck:ads_write');

                Route::get('/assign', 'AdsController@assignAds')->name('assign-ads')->middleware('permissionCheck:ads_write');

                Route::put('/update/location', 'AdsController@updateLocation')->name('location-update')->middleware('permissionCheck:ads_write');
            });
        });
    });
