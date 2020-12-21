<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Social\Entities\SocialMedia;

class SocialComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $socialMedias = SocialMedia::where('status', 1)->get();

        $view->with('socialMedias', $socialMedias);
    }
}
