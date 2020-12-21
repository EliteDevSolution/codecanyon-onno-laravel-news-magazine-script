<?php

namespace App\Http\View\Composers;

use App\Services\HeaderWidgetService;
use Illuminate\View\View;

class HeaderWidgetComposer
{
    protected $widgetService;

    public function __construct(HeaderWidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    public function compose(View $view)
    {
        $view->with('widgets', $this->widgetService->getWidgetDetails());
    }
}
