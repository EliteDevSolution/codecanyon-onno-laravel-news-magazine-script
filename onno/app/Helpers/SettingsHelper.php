<?php

use Modules\Setting\Entities\Setting;

if (!function_exists('settingHelper')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function settingHelper($title= "")
    {
        if($title == "about_us_description" || $title == "copyright_text" || $title == "address" || $title == "phone"){
            if(LaravelLocalization::setLocale() == ""){
                $default = Setting::where('title', 'default_language')->first();
                $lang = $default->value;
            }else{
                $lang = LaravelLocalization::setLocale();
            }
            
            $data = Setting::where('title', $title)->where('lang', $lang)->first();
            return @$data->value;

        }
        if(isset(Config::get('site.settings')[$title])):

            $value = Config::get('site.settings')[$title];

            if(!empty($value)) :
                return $value;
            endif;
        endif;
    }
}
