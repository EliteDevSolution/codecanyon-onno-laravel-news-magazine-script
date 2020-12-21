<?php

namespace App\Http\View\Composers;

use App\Services\MenuService;
use App\Services\WidgetService;
use Illuminate\View\View;

class PrimaryMenuComposer
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function compose(View $view)
    {
    	$view->with('primaryMenu', $this->menuService->primaryMenu());
    }
}
