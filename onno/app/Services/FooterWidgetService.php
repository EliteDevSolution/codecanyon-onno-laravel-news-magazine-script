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

class FooterWidgetService extends Service
{
    private $widgetViewMap = [
        WidgetContentType::POPULAR_POST         => 'popular_post',
        WidgetContentType::TAGS                 => 'tags',
        WidgetContentType::NEWS_LETTER          => 'newsletter',
        WidgetContentType::FOLLOW_US            => 'follow_us',
        WidgetContentType::AD                   => 'ad_widget',
        WidgetContentType::CATEGORIES           => 'categories',
        WidgetContentType::EDITORS_PICKS        => 'editor_picks',
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
                        ->where('location', \Modules\Widget\Enums\WidgetLocation::FOOTER)
                        ->orderBy('order', 'asc')
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
