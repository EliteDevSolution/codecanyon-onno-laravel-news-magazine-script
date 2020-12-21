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

// Route::get('sendmail', function(){
//     $data[] = 'dcfs';
//     Mail::send('newsletter::send_email_test', compact('data'), function ($message) {

//         $Schoolname = 'fdgfdg';
//         $message->to('', $Schoolname)->subject('Login Credentials');
//         $message->from('', $Schoolname);
//     });
//      return 'success';
// });



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],
    function () {
        Route::prefix('newsletter')->group(function() {
            Route::group(['middleware' => ['loginCheck', 'XSS']], function () {

                Route::get('/send-email/subscriber', 'NewsletterController@sendEmailToSubscriber')->name('send-email-to-subscriber')->middleware('permissionCheck:newsletter_read');
                Route::post('/save/cron', 'NewsletterController@saveToCron')->name('save-to-cron')->middleware('permissionCheck:newsletter_write');

                Route::get('/subscriber-list', 'NewsletterController@subscriberList')->name('subscriber-list')->middleware('permissionCheck:newsletter_read');

                Route::get('/ban-subscribe/{user_id}', 'NewsletterController@banSubscribe')->name('ban-subscribe')->middleware('permissionCheck:newsletter_write');
                Route::get('/unban-subscribe/{user_id}', 'NewsletterController@unBanSubscribe')->name('unban-subscribe')->middleware('permissionCheck:newsletter_write');

                Route::post('/send-email/to/{id}', 'NewsletterController@sendMalToSelected')->name('send-email-to')->middleware('permissionCheck:newsletter_write');
                Route::get('/search/post', 'NewsletterController@searchPost')->name('newsletter.search.post')->middleware('permissionCheck:newsletter_read');

            });
            Route::post('subscribe', 'NewsletterController@subscribe')->name('subscribe.newsletter');
            Route::get('unsubscribe/{id}', 'NewsletterController@unsubscribe')->name('newsletter.unsubscribe');
        });
    }
);
