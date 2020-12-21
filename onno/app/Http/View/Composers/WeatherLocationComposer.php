<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Social\Entities\SocialMedia;

class WeatherLocationComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $weatherInfo['cityName']    = 'Dhaka';
        $weatherInfo['Celsius']     = 30;

        $view->with('weatherInfo', $weatherInfo);

    }
}
