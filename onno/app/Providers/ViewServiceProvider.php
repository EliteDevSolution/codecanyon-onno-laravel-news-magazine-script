<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Common;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer(
            ['site.partials.right_sidebar_widgets'],
            'App\Http\View\Composers\WidgetComposer'
        );

        View::composer(
            ['site.partials.footer_widgets', 'site.layouts.footer'],
            'App\Http\View\Composers\FooterWidgetComposer'
        );

        View::composer(
            ['site.layouts.header'],
            'App\Http\View\Composers\HeaderWidgetComposer'
        );

        // View::composer(
        //     ['site.layouts.header'],
        //     'App\Http\View\Composers\MenuComposer'
        // );

        View::composer(
            ['site.partials.home.category_section', 'site.pages.home', 'site.widgets.ad_widget', 'site.layouts.header'],
            'App\Http\View\Composers\AdComposer'
        );

        View::composer(
            ['site.layouts.header'],
            'App\Http\View\Composers\PrimaryMenuComposer'
        );

        View::composer(
            ['site.layouts.header', 'site.layouts.footer', 'site.partials.right_sidebar_widgets'],
            'App\Http\View\Composers\SocialComposer'
        );

        View::composer(
            ['site.layouts.header'],
            'App\Http\View\Composers\LastpostComposer'
        );

        View::composer(
            ['site.layouts.header', 'common::layouts.header'],
            'App\Http\View\Composers\ActiveLangComposer'
        );


        View::composer(
            ['site.partials.right_sidebar_widgets'],
            'App\Http\View\Composers\PollComposer'
        );

        View::composer(
            ['site.partials.home.primary_section'],
            'App\Http\View\Composers\BreakingComposer'
        );

        View::composer(
            ['site.layouts.app', 'site.partials.home.primary_section'],
            'App\Http\View\Composers\LanguageComposer'
        );

    }
}
