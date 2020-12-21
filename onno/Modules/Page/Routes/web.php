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

    Route::prefix('admin/page')->group(function() {
        Route::group(['middleware' => ['loginCheck']], function () {
            Route::group(['middleware' => ['XSS']], function () {

                Route::get('/', 'PageController@index')->name('pages')->middleware('permissionCheck:pages_read');
                Route::get('/add', 'PageController@create')->name('add-page')->middleware('permissionCheck:pages_write');
                Route::get('/edit/{id}', 'PageController@edit')->name('edit-pages')->middleware('permissionCheck:pages_write');
            });
            Route::post('/store', 'PageController@store')->name('create_new_page')->middleware('permissionCheck:pages_write');
            Route::post('/update/{id}', 'PageController@update')->name('update_page')->middleware('permissionCheck:pages_write');
        });
    });
});
