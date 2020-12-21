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
    Route::prefix('social')->group(function() {
        Route::group(['middleware'=>['loginCheck', 'XSS']],function(){

            //poll
            Route::get('/socials', 'SocialController@socials')->name('socials')->middleware('permissionCheck:socials_read');
            Route::get('/social/create', 'SocialController@create')->name('create-social')->middleware('permissionCheck:socials_write');
            Route::post('/social/store', 'SocialController@store')->name('store-social')->middleware('permissionCheck:socials_write');
            Route::get('/social/edit/{id}', 'SocialController@edit')->name('social-edit')->middleware('permissionCheck:socials_write');
            Route::put('/social/update/{id}', 'SocialController@update')->name('update-social')->middleware('permissionCheck:socials_write');

        });
    });
});

