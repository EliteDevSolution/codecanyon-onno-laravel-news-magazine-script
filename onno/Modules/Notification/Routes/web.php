<?php

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],
    function () {
        Route::prefix('notification')->group(function() {
            Route::group(['middleware' => ['loginCheck', 'XSS']], function () {

                Route::get('/', 'NotificationController@sendNotification')->name('send-notification')->middleware('permissionCheck:notification_write');

                Route::get('/setting', 'NotificationController@notificationSetting')->name('notification-setting')->middleware('permissionCheck:notification_write');
                Route::post('/send', 'NotificationController@notificationSend')->name('notification-send')->middleware('permissionCheck:notification_write');

                Route::get('/send/custom', 'NotificationController@sendCustomNotificationView')->name('send-custom-notification')->middleware('permissionCheck:notification_write');
                Route::post('/send/custom/post', 'NotificationController@sendCustomNotification')->name('custom-notification-send')->middleware('permissionCheck:notification_write');

                Route::post('/get-post', 'NotificationController@getPost')->name('get-post')->middleware('permissionCheck:notification_read');
                Route::post('/get-post-details', 'NotificationController@getPostDetails')->name('get-post-details')->middleware('permissionCheck:notification_read');


            });
        });
    }
);

