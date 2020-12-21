<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Post\Entities\Post;
use Sentinel;
use LaravelLocalization;

class LastpostComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $lastPost    = Post::with('image')->select('id', 'title', 'slug' , 'image_id', 'category_id')
                        ->orderBy('id', 'desc')
                        ->where('visibility', 1)
                        ->where('status', 1)
                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                        ->when(Sentinel::check()== false, function ($query) {
                            $query->where('auth_required',0);
                        })->first();

        $view->with('lastPost', $lastPost);
    }
}
