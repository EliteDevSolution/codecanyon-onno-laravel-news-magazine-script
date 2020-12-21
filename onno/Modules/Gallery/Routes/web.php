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
        Route::prefix('gallery')->group(function() {
            Route::group(['middleware' => ['loginCheck']], function () {
                 
                Route::get('/', 'GalleryController@imageGallery')->name('image-gallery');
                Route::post('image-upload', 'GalleryController@imageUpload')->name('image-upload');
                Route::delete('delete-image', 'GalleryController@deleteImage')->name('delete-image');

                Route::post('video-upload', 'GalleryController@videoUpload')->name('video-upload');
                Route::delete('delete-video', 'GalleryController@deleteVideo')->name('delete-video');

                Route::get('fetch-image', 'GalleryController@fetchImage')->name('fetch-image');
                Route::get('fetch-video', 'GalleryController@fetchVideo')->name('fetch-video');
                // Route::post('fetch-image', 'GalleryController@fetchImage')->name('fetch-image');

            });
        });
});

Route::get('delete_image', 'GalleryController@delete_image');
