<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Page\Entities\Page;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Widget\Entities\Widget;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


class SitemapController extends Controller
{
    public function sitemap(){
        $post_slugs = Post::select('slug','updated_at')->where('visibility',1)->where('status',1)->get();
        $page_slugs = Page::select('slug','updated_at')->get();
        $categories_slug = Category::select('slug','updated_at')->get();

        $tags_slug = Widget::where('content_type',2)->where('status',1)->get();

        $sitemap =  Sitemap::create();

        $sitemap->add(Url::create('/')
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0));

        foreach ($post_slugs as $post_slug):
                $sitemap->add(Url::create(settingHelper('article_detail_prefix').'/'.$post_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $post_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        endforeach;

        foreach ($page_slugs as $page_slug):
                $sitemap->add(Url::create(settingHelper('page_detail_prefix').'/'.$page_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $page_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;

        foreach ($categories_slug as $category_slug):
                $sitemap->add(Url::create('category/'.$category_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $category_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
//        dd($tags_slug);
        foreach ($tags_slug as $tag_slug):
            foreach (explode(',',$tag_slug->content) as $t_slug)
//                dd($t_slug);
                $sitemap->add(Url::create('tags/'.$t_slug)
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
                $sitemap->writeToFile('sitemap.xml');

        return redirect()->back()->with('success', __('successfully_generated'));
    }

}
