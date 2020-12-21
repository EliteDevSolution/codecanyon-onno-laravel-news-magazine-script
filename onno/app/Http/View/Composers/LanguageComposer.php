<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Language\Entities\Language;
use LaravelLocalization;

class LanguageComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $language   = Language::where('code', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->first();

        $view->with('language', $language);
    }
}
