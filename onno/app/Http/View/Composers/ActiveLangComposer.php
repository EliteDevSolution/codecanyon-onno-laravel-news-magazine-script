<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Ads\Entities\AdLocation;
use Modules\Language\Entities\Language;

class ActiveLangComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $activeLang     = Language::orderBy('name', 'ASC')
                             ->where('status','active')->get();

        $view->with('activeLang', $activeLang);
    }
}
