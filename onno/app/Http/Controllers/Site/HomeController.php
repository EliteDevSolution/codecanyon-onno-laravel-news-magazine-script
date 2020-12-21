<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Modules\Ads\Entities\AdLocation;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Post\Entities\Post;
use LaravelLocalization;
use App\VisitorTracker;
use Illuminate\Support\Facades\Input;
use Sentinel;
use DB;
use Modules\Post\Entities\Category;

class HomeController extends Controller
{
    public function home()
    {

        $primarySection         = ThemeSection::where('is_primary', 1)->first();

        if($primarySection->status == 1):
            $primarySectionPosts    = Post::with(['category', 'image'])
                                        ->where('visibility', 1)
                                        ->where('status', 1)
                                        ->where('slider', '!=', 1)
                                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                        ->orderBY('id', 'desc')
                                        ->when(Sentinel::check()== false, function ($query) {
                                            $query->where('auth_required',0); })
                                        ->limit(10)->get();
        else:

            $primarySectionPosts = [];

        endif;


        $sliderPosts            = Post::with(['category', 'image'])
                                        ->where('visibility', 1)
                                        ->where('slider', 1)
                                        ->where('status', 1)
                                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                        ->when(Sentinel::check()== false, function ($query) {
                                            $query->where('auth_required',0); })
                                        ->orderBY('id', 'desc')
                                        ->limit(5)->get();
        


        // $categorySections       = ThemeSection::with('ad')
        //                                             ->with(['category.post' => function ($query) {
        //                                                     return $query->where('visibility', 1)
        //                                                         ->where('status', 1)
        //                                                         ->when(Sentinel::check()== false, function ($query) {
        //                                                             $query->where('auth_required',0); })
        //                                                         ->orderBy('id', 'desc')
        //                                                         ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
        //                                                         ->limit(10);
        //                                                 }])
        //                                             ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')->get();


        $categorySections       = ThemeSection::with('ad')
                                                    ->with(['category.post.image'])
                                                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                                                    ->where(function($query) {
                                                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                                                    })
                                                    ->get();                                                                                                                                                                                                                      

        $video_posts            = Post::with('category', 'image')
                                            ->where('post_type', 'video')
                                            ->where('visibility', 1)
                                            ->where('status', 1)
                                            ->when(Sentinel::check()== false, function ($query) {
                                                $query->where('auth_required',0); })
                                            ->orderBy('id', 'desc')
                                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                            ->limit(8)
                                            ->get();


        $latest_posts = Post::where('visibility', 1)
                                            ->where('status', 1)
                                            ->when(Sentinel::check()== false, function ($query) {
                                                $query->where('auth_required',0); })
                                            ->orderBy('id', 'desc')
                                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                            ->limit(6)
                                            ->get();
        $totalPostCount = Post::where('visibility', 1)
                                            ->where('status', 1)
                                            ->when(Sentinel::check()== false, function ($query) {
                                                $query->where('auth_required',0); })
                                            ->orderBy('id', 'desc')
                                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                            ->count();                                                                     

        $tracker                 = new VisitorTracker();
        $tracker->page_type      = \App\Enums\VisitorPageType::HomePage;
        $tracker->url            = \Request::url();
        $tracker->source_url     = \url()->previous();
        $tracker->ip             = \Request()->ip();
        $tracker->agent_browser  = UserAgentBrowser(\Request()->header('User-Agent'));

        $tracker->save();


        return view('site.pages.home', compact('primarySection','primarySectionPosts', 'categorySections', 'sliderPosts', 'video_posts', 'latest_posts', 'totalPostCount'));
    }
}
