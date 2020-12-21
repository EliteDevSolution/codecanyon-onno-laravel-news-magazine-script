<?php

namespace App\Http\View\Composers;

use App\Services\FooterWidgetService;
use Illuminate\View\View;

class FooterWidgetComposer
{
    protected $widgetService;

    public function __construct(FooterWidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    public function compose(View $view)
    {
        $view->with('widgets', $this->widgetService->getWidgetDetails());
    }
}
