<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Language\Entities\LanguageConfig;
use Modules\Language\Entities\Language;
use Modules\Setting\Entities\Setting;
use Modules\Language\Entities\FlagIcon;
use Illuminate\Support\Facades\Config;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\SubCategory;
use Validator;
use Modules\User\Entities\User;
use DB;
use Modules\Post\Entities\Post;
use Sentinel;
use Carbon\Carbon;
use URL;
use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception as S3;
use App\Traits\ApiReturnFormat;
use Modules\Appearance\Entities\Menu;
use Modules\Appearance\Entities\MenuItem;
use Modules\Appearance\Entities\MenuLocation;
use Modules\Ads\Entities\Ad;
use Modules\Ads\Entities\AdLocation;
use Modules\Appearance\Entities\Theme;
use Modules\Widget\Entities\Widget;
use Modules\Post\Entities\Poll;
use Modules\Post\Entities\Vote;
use Modules\Tag\Entities\Tag;

class SettingsController extends Controller
{
    use ApiReturnFormat;

    public function settings()
    {
        $default_language                           = Setting::where('title', 'default_language')->first();
        $language                                   = Config::get('app.locale');

        $timezone                                   =Setting::where('title', 'timezone')->first();

        $logo                                       = Setting::where('title', 'logo')->first();
        $favicon                                    = Setting::where('title', 'favicon')->first();
        $application_name                           = Setting::where('title', 'application_name')->first();
        $address                                    = Setting::where('title', 'address')->first();
        $email                                      = Setting::where('title', 'email')->first();
        $phone                                      = Setting::where('title', 'phone')->first();
        $zip_code                                   = Setting::where('title', 'zip_code')->first();
        $state                                      = Setting::where('title', 'state')->first();
        $country                                    = Setting::where('title', 'country')->first();
        $website                                    = Setting::where('title', 'website')->first();
        $company_registration                       = Setting::where('title', 'company_registration')->first();

        $branding['logo']                           = asset($logo->value);
        $branding['favicon']                        = $favicon->value;
        $branding['application_name']               = $application_name->value;
        $branding['address']                        = $address->value;
        $branding['email']                          = $email->value;
        $branding['phone']                          = $phone->value;
        $branding['zip_code']                       = $zip_code->value;
        $branding['state']                          = $state->value;
        $branding['country']                        = $country->value;
        $branding['website']                        = $website->value;
        $branding['company_registration']           = $company_registration->value;

        $seo_title                                  = Setting::where('title', 'seo_title')->first();
        $seo_keywords                               = Setting::where('title', 'seo_keywords')->first();
        $seo_meta_description                       = Setting::where('title', 'seo_keywords')->first();
        $author_name                                = Setting::where('title', 'author_name')->first();
        $google_analytics_id                        = Setting::where('title', 'google_analytics_id')->first();
        $og_title                                   = Setting::where('title', 'og_title')->first();
        $og_description                             = Setting::where('title', 'og_description')->first();
        $og_image                                   = Setting::where('title', 'og_image')->first();

        $seo['seo_title']                           = $seo_title->value;
        $seo['seo_keywords']                        = $seo_keywords->value;
        $seo['seo_meta_description']                = $seo_meta_description->value;
        $seo['author_name']                         = $author_name->value;
        $seo['google_analytics_id']                 = $google_analytics_id->value;
        $seo['og_title']                            = $og_title->value;
        $seo['og_description']                      = $og_description->value;
        $seo['og_image']                            = $og_image->value;

        $notification_status                        = Setting::where('title', 'notification_status')->first();
        $onesignal_app_id                           = Setting::where('title', 'onesignal_app_id')->first();
        $onesignal_action_message                   = Setting::where('title', 'onesignal_action_message')->first();
        $onesignal_accept_button                    = Setting::where('title', 'onesignal_accept_button')->first();
        $onesignal_cancel_button                    = Setting::where('title', 'onesignal_cancel_button')->first();

        $notification['notification_status']        = $notification_status->value;
        $notification['onesignal_app_id']           = $onesignal_app_id->value;
        $notification['onesignal_action_message']   = $onesignal_action_message->value;
        $notification['onesignal_accept_button']    = $onesignal_accept_button->value;
        $notification['onesignal_cancel_button']    = $onesignal_cancel_button->value;

        $fb_url                                     = Setting::where('title', 'fb_url')->first();
        $twitter_url                                = Setting::where('title', 'twitter_url')->first();
        $google_url                                 = Setting::where('title', 'google_url')->first();
        $instagram_url                              = Setting::where('title', 'instagram_url')->first();
        $pinterest_url                              = Setting::where('title', 'pinterest_url')->first();
        $linkedin_url                               = Setting::where('title', 'linkedin_url')->first();
        $youtube_url                                = Setting::where('title', 'youtube_url')->first();
        
        $social_media['fb_url']                     = $fb_url->value;
        $social_media['twitter_url']                = $twitter_url->value;
        $social_media['google_url']                 = $google_url->value;
        $social_media['instagram_url']              = $instagram_url->value;
        $social_media['pinterest_url']              = $pinterest_url->value;
        $social_media['linkedin_url']               = $linkedin_url->value;
        $social_media['youtube_url']                = $youtube_url->value;


        $categories = Category::select('id','category_name','slug')
                    ->where('language',$language)
                    ->orderBy('id','ASC')
                    ->withCount('post')
                    ->get();

        $ads = AdLocation::with('ad:id,ad_name,ad_size,ad_type,ad_url,ad_image_id,ad_code,ad_text','ad.adImage')
            ->select('id','title','unique_name','ad_id','status')
            ->get();

        $active_theme = Theme::where('status',1)
                    ->where('currtent',1)
                    ->select('id','title','header_style','footer_style','primary_section_style')
                    ->first();
        
        $activeLang = Language::orderBy('name', 'ASC')
                    ->where('status','active')
                    ->select('id','name','code','icon_class','text_direction')
                    ->get();



        $settings['default_language']               = $default_language->value;
        $settings['timezone']                       = $timezone->value;
        $settings['languages']                      = $activeLang;
        $settings['menu']                           = $this->getMenuLocation($language);
        $settings['branding']                       = $branding;
        $settings['seo']                            = $seo;
        $settings['notification']                   = $notification;
        $settings['social_media']                   = $social_media;
        $settings['ads']                            = $ads;
        $settings['theme']                          = $active_theme;
        $settings['categories']                     = $categories;
        $settings['widgets']                        = $this->getWidgets($language,$categories,$social_media);

        return $this->responseWithSuccess('Successfully data found', $settings);
    }

    protected function getMenuLocation($language){
        $menuLocations = MenuLocation::select('title','unique_name','menu_id')->get(); 

        foreach ($menuLocations as $menuLocation) {
            $menuItems = MenuItem::with([
                        'children','page:id,title,slug',
                        'category'=> function($q) use ($language){
                                    $q->where('language',$language);
                                },
                        'category.subcategory' => function($q) use ($language){
                                    $q->where('language',$language);
                                    $q->limit(5);
                                }
                    ])
                    ->where('parent', null)
                    ->where('language', $language)
                    ->where('menu_id', $menuLocation->menu_id)
                    ->orderBy('order','ASC')
                    ->select('id','label','language','menu_id','order','parent','source','url','page_id','category_id','post_id','status','new_teb')
                    ->get();

                    foreach ($menuItems as $menuItem) {
                        if($menuItem->category_id != null){
                            
                            foreach ($menuItem->category->subcategory as $subcategory) {
                                $posts = Post::with('image','video')
                                            ->where('sub_category_id',$subcategory->id)
                                            ->where('language',$language)
                                            ->orderBy('id','DESC')
                                            ->take(4)
                                            ->get();
                                            
                                $subcategory['post']=$this->imageUrlset($posts);
                            }
                        }
                    }
                $menuLocation['menu_item'] = $menuItems;
                
        }
        return $menuLocations;
    }

    protected function getWidgets($language, $categories, $social_media){
        $widgets=Widget::orderBy('order','ASC')
                ->where('language',$language)
                ->select('id','title','content','short_code','order','is_custom')
                ->get();

        $recommendeddNews = Post::where('recommended',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('status',1)
                ->where('language',$language)
                ->orderBy('recommended_order')
                ->take(5)
                ->get();
        $recommendeddNews=$this->imageUrlset($recommendeddNews);

        $latestPost = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->orderBy('created_at','DESC')
                ->where('language',$language)
                ->take(4)
                ->get();

        $latestPost=$this->imageUrlset($latestPost);

        $popularPostWeekly = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('language',$language)
                ->where('created_at', '>=', Carbon::today()->subDays(7))
                ->select('id','category_id','image_id','video_id','title','slug','content','created_at')
                ->orderBy('total_hit','DESC')
                ->take(4)
                ->get();

        $popularPostWeekly=$this->imageUrlset($popularPostWeekly);

        $popularPostDaily = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('language',$language)
                ->where('created_at', '>=', Carbon::today())
                ->select('id','category_id','image_id','video_id','title','slug','content','created_at')
                ->orderBy('total_hit','DESC')
                ->take(4)
                ->get();

        $popularPostDaily=$this->imageUrlset($popularPostDaily);

        $popularPostMonthly = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('language',$language)
                ->where('created_at', '>=', Carbon::today()->subDays(30))
                ->select('id','category_id','image_id','video_id','title','slug','content','created_at')
                ->orderBy('total_hit','DESC')
                ->take(4)
                ->get();
        $popularPostMonthly=$this->imageUrlset($popularPostMonthly);

        $popularPost['daily']   = $popularPostDaily;
        $popularPost['weekly']  = $popularPostWeekly;
        $popularPost['monthly'] = $popularPostMonthly;

        $tags = Tag::select('id','title','total_hit')
                ->where('total_hit', '>', 0)
                ->orderBy('total_hit','DESC')
                ->take(15)
                ->get();

        foreach ($widgets as $widget) {
            if($widget->short_code === 'popular_posts'){
                
                $widget['popular_posts'] = $popularPost;

            }elseif($widget->short_code === 'follow_us'){
               
                $widget['follow_us'] = $social_media;

            }elseif($widget->short_code === 'newletter'){
            }elseif($widget->short_code === 'recent_posts'){

                 $widget['recent_posts'] = $latestPost;

            }elseif($widget->short_code === 'categories'){

                $widget['categories'] = $categories;

            }elseif($widget->short_code === 'recommended_posts'){

                $widget['recommended_posts'] = $recommendeddNews;

            }elseif($widget->short_code === 'tags'){

                $widget['tags'] = $tags;

            }elseif($widget->short_code === 'voting_poll'){

                $widget['polls'] = $this->getPoll();

            }elseif($widget->short_code === 'weather'){
            }
        }
        return $widgets;
    }

    
    protected function getPoll(){
        $polls=Poll::orderBy('id','desc')->where('status',1)->get();
        foreach ($polls as $poll) {

            // $poll=Poll::find($value->id);
            $total_vote=Vote::where('poll_id',$poll->id)->count();

            if($total_vote != 0){
                $result=[];

                if($poll->option_1 != null){
                    $result['option_1'] = (100*Vote::where('answer',$poll->option_1)->count())/$total_vote;
                }
                if ($poll->option_2 != null) {

                    $result['option_2'] = (100*Vote::where('answer',$poll->option_2)->count())/$total_vote;

                }if ($poll->option_3 != null) {

                    $result['option_3'] = (100*Vote::where('answer',$poll->option_3)->count())/$total_vote;

                }if ($poll->option_4 != null) {

                    $result['option_4'] = (100*Vote::where('answer',$poll->option_4)->count())/$total_vote;

                }if ($poll->option_5 != null) {

                    $result['option_5'] = (100*Vote::where('answer',$poll->option_5)->count())/$total_vote;

                }if ($poll->option_6 != null) {

                    $result['option_6']=(100*Vote::where('answer',$poll->option_6)->count())/$total_vote;

                }if ($poll->option_7 != null) {

                    $result['option_7'] = (100*Vote::where('answer',$poll->option_7)->count())/$total_vote;

                }if ($poll->option_8 != null) {

                    $result['option_8'] = (100*Vote::where('answer',$poll->option_8)->count())/$total_vote;

                }if ($poll->option_9 != null) {

                    $result['option_9'] = (100*Vote::where('answer',$poll->option_9)->count())/$total_vote;

                }if ($poll->option_10 != null) {

                    $result['option_10'] = (100*Vote::where('answer',$poll->option_10)->count())/$total_vote;

                }
            }
            $poll['result'] = $result;
        }
        return $polls;
    }

    protected function imageUrlset($posts){

        foreach ($posts as $post) {
                if(isset($post->image)){
                        if($post->image->disk=='s3'){
                                $s3Link = "https://s3.".Config::get('filesystems.disks.s3.region').".amazonaws.com/".Config::get('filesystems.disks.s3.bucket')."/";

                                $post->image->original_image     = $s3Link.$post->image->original_image;
                                $post->image->thumbnail          = $s3Link.$post->image->thumbnail;
                                $post->image->big_image          = $s3Link.$post->image->big_image;
                                $post->image->big_image_two      = $s3Link.$post->image->big_image_two;
                                $post->image->medium_image       = $s3Link.$post->image->medium_image;
                                $post->image->medium_image_two   = $s3Link.$post->image->medium_image_two;
                                $post->image->medium_image_three = $s3Link.$post->image->medium_image_three;
                                $post->image->small_image        = $s3Link.$post->image->small_image;
                                
                        }else{
                                $post->image->original_image     = asset($post->image->original_image);
                                $post->image->thumbnail          = asset($post->image->thumbnail);
                                $post->image->big_image          = asset($post->image->big_image);
                                $post->image->big_imageTwo       = asset($post->image->big_image_two);
                                $post->image->medium_image       = asset($post->image->medium_image);
                                $post->image->medium_image_two   = asset($post->image->medium_image_two);
                                $post->image->medium_image_three = asset($post->image->medium_image_three);
                                $post->image->small_image        = asset($post->image->small_image);
                        }
                }
        }
        return $posts;
    }

}
