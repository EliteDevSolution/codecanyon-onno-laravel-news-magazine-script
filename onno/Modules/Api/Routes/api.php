<?php

use Illuminate\Http\Request;
// use Modules\User\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1.0')->group(function() {

    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
 
    Route::group(['middleware' => ['jwt.verify','loginCheck','api.localization']], function() {
        
        //UserControler
        Route::prefix('user')->group(function() {

            Route::get('me', 'UserController@getAuthenticatedUser');
            Route::get('logout', 'UserController@logout');
            Route::post('change-password', 'UserController@changePassword');

            Route::post('update/{id}', 'UserController@updateUserInfo')->middleware('permissionCheck:users_read');

            Route::get('test', 'UserController@test');
        });

    });
    
    Route::group(['middleware' => ['api.localization']], function() {
        //HomeController
        Route::prefix('home')->group(function() {
            Route::get('/content', 'HomeController@homeContent');
        });
        //SettingsController
        Route::get('/settings', 'SettingsController@settings');

        //PostController
        Route::post('/search', 'PostController@searchPost');
        Route::get('/details/{slug}', 'PostController@postDetails');
    });

});
