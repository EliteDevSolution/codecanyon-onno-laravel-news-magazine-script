<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Language\Entities\Language;
use Illuminate\Support\Facades\Config;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\SubCategory;
use Validator;
use Modules\User\Entities\User;
use DB;
use Illuminate\Support\Facades\Mail;
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
use Modules\Setting\Entities\Setting;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Post\Entities\Poll;
use Modules\Post\Entities\Vote;
use Modules\Appearance\Entities\Theme;


class HomeController extends Controller
{
    use ApiReturnFormat;

    public function homeContent(Request $request){
        
        $language = Config::get('app.locale');

        $sliderNews = Post::where('slider',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('status',1)
                ->where('language',$language)
                ->select('id','category_id','user_id','image_id','video_id','title','slug','content','created_at')
                ->orderBy('slider_order')
                ->get();

        $sliderNews=$this->imageUrlset($sliderNews);

        $featuredNews = Post::where('featured',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('status',1)
                ->where('language',$language)
                ->select('id','category_id','user_id','image_id','video_id','title','slug','content','created_at')
                ->orderBy('featured_order')
                ->take(5)
                ->get();

        $featuredNews=$this->imageUrlset($featuredNews);

        $breakingNews = Post::where('breaking',1)
                ->with('category:id,category_name')
                ->where('status',1)
                ->where('language',$language)
                ->select('id','category_id','title','slug','content','created_at')
                ->orderBy('breaking_order')
                // ->take(5)
                ->get();

        $populerdNews = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->orderBy('total_hit','DESC')
                ->where('language',$language)
                ->take(4)
                ->get();
        
        $populerdNews=$this->imageUrlset($populerdNews);

        $latestPost = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->orderBy('created_at','DESC')
                ->where('language',$language)
                // ->where('post_type','article')
                ->take(12)
                ->get();
        
        $latestPost=$this->imageUrlset($latestPost);

        $videos = Post::where('status',1)
                ->with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->orderBy('created_at','DESC')
                ->where('language',$language)
                ->where('post_type','video')
                ->take(5)
                ->get();
        $videos=$this->imageUrlset($videos);

        $sections = ThemeSection::orderBy('id',"ASC")
                ->where('status',1)
                ->select('id','label','order','category_id','post_amount','section_style','status')
                ->get();

        
        $active_theme = Theme::where('status',1)
                ->where('currtent',1)
                ->select('id','primary_section_style')
                ->first();

        foreach ($sections as $section) {
            $posts = Post::with('image','video','category:id,category_name','user:id,first_name,last_name,email')
                ->where('category_id', $section->category_id)
                ->where('language',$language)
                ->orderBy('id','DESC')
                ->take($section->post_amount)
                ->get();

            $posts=$this->imageUrlset($posts);

            $section['post']=$posts;
        }

        $primary_section['slider_news']         = $sliderNews;
        $primary_section['featured_news']       = $featuredNews;
        $primary_section['breaking_news']       = $breakingNews;

        if($active_theme->primary_section_style != null){

            $active_theme['news']  = $primary_section;
        }else{
            $active_theme['news'] = [];
        }

        $homeContent['primary_section']         = $active_theme;
        $homeContent['dynamic_section']         = $sections;
        $homeContent['videos']                  = $videos;
        $homeContent['latest_post']             = $latestPost;

        // return $primary_section;

        return $this->responseWithSuccess('Successfully data found',$homeContent);
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
