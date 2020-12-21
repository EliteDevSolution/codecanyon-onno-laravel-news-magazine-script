<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Ads\Entities\AdLocation;

class AdComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $adLocations    = AdLocation::with('ad.adImage')
                                ->where('status', 1)
                                ->get()
                                ->keyBy('unique_name');

        $view->with('adLocations', $adLocations);
    }
}
