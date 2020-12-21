<?php

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],
    function () {

    Route::prefix('tag')->group(function() {
        Route::group(['middleware' => ['loginCheck']], function () {
            Route::get('/', 'TagController@index')->name('tags');
        });
    });
});