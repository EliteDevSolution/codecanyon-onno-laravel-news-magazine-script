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

    Route::prefix('contact')->group(function() {
        Route::group(['middleware' => ['loginCheck', 'XSS']], function () {
            Route::get('/', 'ContactController@index')->name('contact')->middleware('permissionCheck:contact_message_read');
            Route::get('/view/{id}', 'ContactController@show')->name('contact-view')->middleware('permissionCheck:contact_message_read');
            Route::post('/replay-email/{id}', 'ContactController@replayMail')->name('send-replay-email')->middleware('permissionCheck:contact_message_write');

        });
    });
});
