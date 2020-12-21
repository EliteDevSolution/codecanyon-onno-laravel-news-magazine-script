<?php

namespace App\Http\View\Composers;

use App\Services\WidgetService;
use Illuminate\View\View;

class WidgetComposer
{
    protected $widgetService;

    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    public function compose(View $view)
    {
        $view->with('widgets', $this->widgetService->getWidgetDetails());
    }
}
