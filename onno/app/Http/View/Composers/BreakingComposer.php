<?php

namespace App\Http\View\Composers;

use Sentinel;
use Illuminate\View\View;
use Modules\Post\Entities\Post;
use LaravelLocalization;

class BreakingComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
//        $breakingNewss  = Post::when(Sentinel::check(), function ($query){
//                            $query->orderBy('id','desc')
//                                ->where('breaking',1)
//                                ->where('visibility', 1)
//                                ->where('status', 1);
//                            })->
//                            when(Sentinel::check() == false, function ($query){
//                                $query->orderBy('id','desc')
//                                    ->where('breaking',1)
//                                    ->where('visibility', 1)
//                                    ->where('auth_required',0)
//                                    ->where('status', 1);
//                            })->get();
        $breakingNewss           = Post::orderBy('id','desc')
                                    ->where('breaking',1)
                                    ->where('visibility', 1)
                                    ->where('status', 1)
                                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                    ->when(Sentinel::check()== false, function ($query) {
                                        $query->where('auth_required',0);
                                    })->get();


        $view->with('breakingNewss', $breakingNewss);
    }
}
