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
        Route::prefix('language')->group(function () {
            Route::group(['middleware' => ['loginCheck', 'XSS']], function () {

                Route::get('/', 'LanguageController@index')->name('language-settings')->middleware('permissionCheck:language_settings_read');
                Route::post('/set/default-language', 'LanguageController@setDefaultLanguage')->name('set-default-language')->middleware('permissionCheck:language_settings_write');
                Route::post('/create/new-language', 'LanguageController@addNewLanguage')->name('add-new-language')->middleware('permissionCheck:language_settings_write');
                Route::get('/edit/language-info/{id}', 'LanguageController@editLanguageInfo')->name('edit-language-info')->middleware('permissionCheck:language_settings_write');
                Route::post('/update/language-info/{id}', 'LanguageController@updateLanguageInfo')->name('update-language-info')->middleware('permissionCheck:language_settings_write');
                
                Route::delete('/delete/language', 'LanguageController@deleteLanguage')->name('language-delete')->middleware('permissionCheck:language_settings_delete');
                Route::post('/update/phrase/{code}', 'LanguageController@updatePhrase')->name('update-phrase')->middleware('permissionCheck:language_settings_write');
                Route::post('/update/default-messages/{code}', 'LanguageController@updateDefaultMessages')->name('update-default-messages')->middleware('permissionCheck:language_settings_write');

                Route::get('edit/phrase-list/{id}', 'LanguageController@editPhraseList')->name('edit-phrase-list')->middleware('permissionCheck:language_settings_write');
                Route::get('edit/default-messages/{id}', 'LanguageController@editDefaultMessages')->name('edit-default-messages')->middleware('permissionCheck:language_settings_write');
            });
        });
    }
);
