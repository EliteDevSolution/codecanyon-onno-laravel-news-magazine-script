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

class HeaderWidgetService extends Service
{
    private $widgetViewMap = [
        WidgetContentType::AD                   => 'ad_widget',
    ];

    public function getWidgetDetails()
    {
        $widgetContents = [];

        $widgets        = Widget::with('ad')
                        ->where('status', 1)
                        ->where('location', \Modules\Widget\Enums\WidgetLocation::HEADER)
                        ->orderBy('order', 'asc')
                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                        ->get();


        foreach ($widgets as $widget) {

            if (empty($this->widgetViewMap[$widget['content_type']])) :
                continue;
            endif;

            $widgetContents[$widget['location'] ?? 1][$widget->id]['detail']    = $widget;
            $widgetContents[$widget['location'] ?? 1][$widget->id]['view']      = $this->widgetViewMap[$widget['content_type']];
            
        }

        return $widgetContents;
    }
}
