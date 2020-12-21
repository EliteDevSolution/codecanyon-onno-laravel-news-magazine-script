<?php

namespace App\Services;

use Modules\Appearance\Entities\MenuLocation;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use LaravelLocalization;

class MenuService extends Service
{
    private $menuData;
    private $primary;

    private function getCustomPrimaryMenu()
    {
        $data               = [];

        $customMenus        = $this->primary->where('source', 'custom');

        foreach ($customMenus as $menu) {
            if (blank($menu->parent)) {
                $data[$menu->id] = [
                                    'label' => $menu->label,
                                    'url'   => $menu->url,
                                ];
            } else {
                $data[$menu->parent]['list_item'][] = [
                                    'label' => $menu->label,
                                    'url' => $menu->url,
                                ];
            }
        }

        return $data;
    }

    private function getPagePrimaryMenu()
    {
        $data       = [];
        $pageMenus  = $this->primary->where('source', 'page');
        if (!blank($pageMenus)) {
            $pageMenus = $pageMenus->sortBy('order');
        }

        foreach ($pageMenus as $menu) {
            $data[]     = [
                'label' => $menu->label,
                // TODO: Page link route url goes here
                'url' => '#'
            ];
        }

        return $data;
    }

    private function getPostPrimaryMenu()
    {
        $data       = [];
        $pageMenus  = $this->primary->where('source', 'post');

        if (!blank($pageMenus)) {
            $pageMenus = $pageMenus->sortBy('order');
        }

        foreach ($pageMenus as $menu) {
            $data[] = [
                'label' => $menu->label,
                'url'   => route('article.detail', ['id' => $menu->post_id])
            ];
        }

        return $data;
    }

    private function getPrimaryCategoryMenu()
    {
        $data           = [];
        $categoryMenus  = $this->primary->where('source', 'category');

        if (!blank($categoryMenus)) {
            $categoryMenus = $categoryMenus->sortBy('order');
        }

        foreach ($categoryMenus as $item) {
            $posts = Post::where('category_id', $item->category_id)->limit(6)->get();

            foreach ($posts as $post) {
                $data[$item->label][] = [
                    'label' => $post->title,
                    'url'   => route('article.detail', ['id' => $post->id])
                ];
            }
        }

        return $data;
    }


    private function processPrimaryMenuDetails()
    {
        return data_get($this->menuData, 'primary.menu.menu_items');

        return [
            'custom'    => $this->getCustomPrimaryMenu(),
            'page'      => $this->getPagePrimaryMenu(),
            'post'      => $this->getPostPrimaryMenu(),
            'category'  => $this->getPrimaryCategoryMenu(),
        ];
    }

    public function getMenuDetails()
    {
        $this->menuData = MenuLocation::with(['menu.menu_items.children', 'menu.menu_items.post.image', 'menu.menu_items.page'])->get()->keyBy('unique_name');

        return [
            'primary'   => $this->processPrimaryMenuDetails(),
        ];
    }

    public function primaryMenu()
    {
        $primary_menu = MenuLocation::with(['menuItem.children', 'menuItem.page'])->where('title', 'Primary')->first();

        return $primary_menu->menuItem->where('parent','==', '')->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'));
    }
}
