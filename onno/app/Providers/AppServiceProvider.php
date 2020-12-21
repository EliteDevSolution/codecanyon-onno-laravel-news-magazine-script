<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Modules\Language\Entities\LanguageConfig;
use Modules\Language\Entities\Language;
use Modules\Setting\Entities\Setting;
use Session;
use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        try {

            DB::connection()->getPdo(); 
             
          } catch (\Exception $e) {

            $supportedLocales               = ['en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB']];

            Config::set('app.locale', 'en');
            Config::set('laravellocalization.supportedLocales', $supportedLocales);

            return redirect('install');
          }


         if (Schema::hasTable('settings') && Schema::hasTable('languages') ) :

            $default_lang           = Setting::where('title', 'default_language')->first();

            $setting                = Setting::select('title', 'value')->where('lang', @$default_lang->value)->get()->toArray();
            
            $session_array          = array();

            foreach($setting as $row):
                $session_array[$row['title']] = $row['value'];
            endforeach;

            Config::set('site.settings', $session_array);

            if (!empty($default_lang)) :
                Config::set('app.locale', $default_lang->value);
            else :
                Config::set('app.locale', 'en');
            endif;

            $timezone       = settingHelper('timezone');

            if (!empty($timezone)) :
                date_default_timezone_set($timezone);
            else :
                date_default_timezone_set('America/New_York');
            endif;

            $appName        = settingHelper('application_name');

            if (!empty($appName)) :
                Config::set('app.name', $appName);
            endif;

            $captcha_sitekey        = settingHelper('captcha_sitekey');

            if (!empty($captcha_sitekey)) :
                Config::set('captcha.sitekey', $captcha_sitekey);
            endif;

            $captcha_secret        = settingHelper('captcha_secret');

            if (!empty($captcha_secret)) :
                Config::set('captcha.secret', $captcha_secret);
            endif;

            $default_storage = settingHelper('default_storage');



            \Log::info($default_storage);

            if(!empty($default_storage)):
                Config::set('filesystems.default', $default_storage);
                // if( $default_storage->value=='s3'):
                    $aws_access_key_id      = settingHelper('aws_access_key_id');
                    $aws_secret_access_key  = settingHelper('aws_secret_access_key');
                    $aws_default_region     = settingHelper('aws_default_region');
                    $aws_bucket             = settingHelper('aws_bucket');
                    $aws_url                ="http://$aws_bucket.s3.$aws_default_region.amazonaws.com";

                    Config::set('filesystems.disks.s3.key', $aws_access_key_id);
                    Config::set('filesystems.disks.s3.secret', $aws_secret_access_key);
                    Config::set('filesystems.disks.s3.region', $aws_default_region);
                    Config::set('filesystems.disks.s3.bucket', $aws_bucket);
                    Config::set('filesystems.disks.s3.url', $aws_url);
                // endif;
            endif;

            if (Schema::hasTable('settings')) {
                $mail_driver = Setting::where('title', 'mail_driver')->first();
                $mail_host = Setting::where('title', 'mail_host')->first();
                $mail_port = Setting::where('title', 'mail_port')->first();
                $mail_address = Setting::where('title', 'mail_address')->first();
                $mail_name = Setting::where('title', 'mail_name')->first();
                $mail_username = Setting::where('title', 'mail_username')->first();
                $mail_password = Setting::where('title', 'mail_password')->first();
                $mail_encryption = Setting::where('title', 'mail_encryption')->first();
                $sendmail_path = Setting::where('title', 'sendmail_path')->first();


                //checking if table is not empty
                if ($mail_driver !=null && $mail_host !=null && $mail_port !=null && $mail_address !=null && $mail_name !=null && $mail_username !=null && $mail_password !=null && $mail_encryption !=null && $sendmail_path != null) 
                {
                    $config = array(
                        'driver'     => $mail_driver->value,
                        'host'       => $mail_host->value,
                        'port'       => $mail_port->value,
                        'from' => [
                            'address' => $mail_address->value,
                            'name' => $mail_name->value,
                        ],
                        'encryption' => $mail_encryption->value,
                        'username'   => $mail_username->value,
                        'password'   => $mail_password->value,
                        'sendmail'   => $sendmail_path->value,
                        'pretend'    => false,
                    );
                    Config::set('mail', $config);
                }
            }  

            $supportedLocales               = array();
            $languageList                   = Language::where('status', 'active')->get();

            if ($languageList->count() > 0) :
                foreach ($languageList as $lang) :
                    $langConfigs            = LanguageConfig::select('name', 'script', 'native', 'regional')
                                                ->where('language_id', $lang->id)
                                                ->get();

                    foreach ($langConfigs as $langConfig) :
                        // return $langConfig;
                        $supportedLocales[$lang->code] = $langConfig;
                    endforeach;
                endforeach;

                Config::set('laravellocalization.supportedLocales', $supportedLocales);
            else :
                $supportedLocales           = ['en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB']];
                Config::set('laravellocalization.supportedLocales', $supportedLocales);
            endif;

        else :
            $supportedLocales               = ['en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB']];

            Config::set('app.locale', 'en');
            Config::set('laravellocalization.supportedLocales', $supportedLocales);
        endif;

        

    }
}
