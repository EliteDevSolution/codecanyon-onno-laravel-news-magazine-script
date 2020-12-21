<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Setting\Entities\Setting;
use Modules\Tag\Entities\Tag;
use Modules\Widget\Entities\Widget;
use Modules\Widget\Enums\WidgetContentType;
use LaravelLocalization;
use Sentinel;

class WidgetService extends Service
{
    private $widgetViewMap = [
        WidgetContentType::POPULAR_POST         => 'popular_post',
        WidgetContentType::TAGS                 => 'tags',
        WidgetContentType::CUSTOM               => 'custom',
        WidgetContentType::NEWS_LETTER          => 'newsletter',
        WidgetContentType::FOLLOW_US            => 'follow_us',
        WidgetContentType::RECENT_POST          => 'recent_posts',
        WidgetContentType::RECOMMENDED_POSTS    => 'recommended_posts',
        WidgetContentType::VOTING_POLL          => 'voting_poll',
        WidgetContentType::AD                   => 'ad_widget',
        WidgetContentType::CATEGORIES           => 'categories',
        WidgetContentType::EDITORS_PICKS        => 'editor_picks',
        WidgetContentType::FEATURED_POST        => 'featured_posts',
    ];

    private function popularPost()
    {
        return Post::with(['image', 'user'])
                ->orderBy('total_hit', 'DESC')
                ->take(4)
                ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                ->where('visibility', 1)
                ->where('status', 1)
                ->when(Sentinel::check()== false, function ($query) {
                        $query->where('auth_required',0); })
                ->get();
    }

    // private function tags()
    // {
    //     return Widget::where('content_type',2)->select('content')->get();
    // }

    // private function followUs()
    // {
    //     $socialLinkTitle = [
    //         'fb_url',
    //         'twitter_url',
    //         'google_url',
    //         'instagram_url',
    //         'pinterest_url',
    //         'linkedin_url',
    //         'youtube_url',
    //     ];

    //     return Setting::whereIn('title', $socialLinkTitle)->get()->pluck('value', 'title');
    // }

    private function recentPosts()
    {
        return Post::with(['image', 'user'])->orderBy('id', 'desc')
            ->take(4)
            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
            ->where('visibility', 1)
            ->where('status', 1)
            ->when(Sentinel::check()== false, function ($query) {
                $query->where('auth_required',0); })
            ->get();
    }

    private function recommendedPosts()
    {
        return Post::with(['image', 'user'])
            ->where('recommended', 1)
            ->orderBy('recommended_order')
            ->take(4)
            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
            ->where('visibility', 1)
            ->where('status', 1)
            ->when(Sentinel::check()== false, function ($query) {
                $query->where('auth_required',0); })
            ->get();
    }
    private function featuredPosts()
    {
        return Post::with(['image', 'user'])
            ->where('featured', 1)
            ->orderBy('featured_order')
            ->take(4)
            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
            ->where('visibility', 1)
            ->where('status', 1)
            ->when(Sentinel::check()== false, function ($query) {
                $query->where('auth_required',0); })
            ->get();
    }

    private function categories()
    {
        return Category::select('category_name','slug')
            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
            ->orderBy('order', 'asc')
            ->withCount('post')
            ->get();
    }

    private function getContent($method)
    {
        $content        = null;

        $methodName     = Str::camel($method);

        if (method_exists($this, $methodName)) {
            $content    = $this->{$methodName}();
        }

        return $content;
    }

    private function editorPicks()
    {
        return Post::with(['image', 'user'])
            ->where('editor_picks', 1)
            ->orderBy('id','desc')
            ->take(4)
            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
            ->where('visibility', 1)
            ->where('status', 1)
            ->when(Sentinel::check()== false, function ($query) {
                $query->where('auth_required',0); })
            ->get();
    }

    public function getWidgetDetails()
    {
        $widgetContents = [];

        $widgets        = Widget::with('ad')
                        ->where('status', 1)
                        ->orderBy('order', 'asc')
                        ->where('location', \Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR)
                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                        ->get();

        foreach ($widgets as $widget) {

            if (empty($this->widgetViewMap[$widget['content_type']])) :
                continue;
            endif;

            $widgetContents[$widget['location'] ?? 1][$widget->id]['detail']    = $widget;
            $widgetContents[$widget['location'] ?? 1][$widget->id]['view']      = $this->widgetViewMap[$widget['content_type']];
            if($this->widgetViewMap[$widget['content_type']] != $this->widgetViewMap[WidgetContentType::TAGS]):
                $widgetContents[$widget['location'] ?? 1][$widget->id]['content']   = $this->getContent($this->widgetViewMap[$widget['content_type']]);
            endif;
        }

        return $widgetContents;
    }
}
