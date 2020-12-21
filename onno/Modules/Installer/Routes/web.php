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


Route::group(['middleware' => ['IsNotInstalledCheck', 'XSS']], function () {

    Route::get('install/', 'InstallerController@index')->name('install');
 

   // Route::get('check-environment', 'InstallerController@checkEnvironment')->name('check_environment');
   // Route::post('check-environment', 'InstallerController@checkEnvironmentPost')->name('check_environment');

   // Route::get('purchase-code-database', 'InstallerController@purchaseCodeVerification')->name('purchase_code_database');
   // Route::post('purchase-code-database', 'InstallerController@purchaseCodeVerificationPost')->name('purchase_code_database');

   // Route::get('system-setup-info', 'InstallerController@systemSetupInfo')->name('system-setup-info');

   // Route::post('confirm-installing', 'InstallerController@confirmInstalling')->name('confirm-installing');
});

Route::group(['middleware' => ['XSS']], function () {

   Route::post('install', 'InstallerController@do_install')->name('install');
   Route::get('final',  'InstallerController@finish')->name('final');

 }); 

