<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\WidgetService;
use Aws\S3\Exception\S3Exception as S3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Gallery\Entities\Image as galleryImage;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Setting\Entities\Setting;
use File;
use Image;
use LaravelLocalization;
use App\VisitorTracker;
use Sentinel;

class ArticleController extends Controller
{
    public function show($id)
    {
        $post               = Post::with(['image','comments'=> function ($query) {
                                              return $query->whereNull('comment_id');
                                            }, 'comments.reply.user', 'comments.user'])
                                        ->where('slug', $id)->first();

        if(!blank($post)){

            $post->total_hit = $post->total_hit+1;
            $post->save();

            if($post->auth_required == 1 && Sentinel::check() == false){
                return view('site.pages.403');
            }
        }else{
            return view('site.pages.404');
        }


        $widgetService      = new WidgetService();
        $widgets            = $widgetService->getWidgetDetails();
        $socialLinks        = $this->socialLinks();


        $categoryWithPost   = Category::with(['post'=> function ($query) use($post) {
                                        return $query->limit(8)->orderBy('id', 'desc')->where('id', '!=', $post->id);
                                    }])->find($post->category_id);
            $relatedPost         = data_get($categoryWithPost, 'post');

        //dd($relatedPost);
        $tracker                 = new VisitorTracker();
        $tracker->page_type      = \App\Enums\VisitorPageType::PostDetailPage;
        $tracker->slug           = $id;
        $tracker->url            = \Request::url();
        $tracker->source_url     = \url()->previous();
        $tracker->ip             = \Request()->ip();
        $tracker->date           = date('Y-m-d');
        $tracker->agent_browser  = UserAgentBrowser(\Request()->header('User-Agent'));
        $tracker->save();

        return view('site.pages.article_detail', compact('post', 'widgets', 'socialLinks', 'relatedPost'));
    }

    private function socialLinks()
    {
        $socialLinkTitle    = [
                                'fb_url',
                                'twitter_url',
                                'google_url',
                                'instagram_url',
                                'pinterest_url',
                                'linkedin_url',
                                'youtube_url',
                            ];

        return Setting::whereIn('title', $socialLinkTitle)->get()->pluck('value', 'title');
    }

    public function submitNewsForm()
    {
        if (!Sentinel::check()):
            return redirect()->route('site.login.form');
        endif;

        $widgetService      = new WidgetService();
        $widgets            = $widgetService->getWidgetDetails();

        return view('site.pages.submit_news', compact('widgets'));
    }
    //compressing image to and making webp
    public function compressImage($image,$type){
        if($type):
            $newImage = imagecreatefromjpeg($image);
            imagepalettetotruecolor($newImage);
            imagealphablending($newImage,true);
            imagesavealpha($newImage,true);
            imagewebp($newImage,$image,70);
            return $newImage;
            imagedestroy($newImage);
         endif;
    }

    public function imageUpload($request)
    {
            $validation = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,png|max:5120',
        ])->validate();


        try {
            $image                  = new galleryImage();
            $requestImage           = $request->file('image');
            $fileType               = $requestImage->getClientOriginalExtension();

            $originalImageName      = date('YmdHis') . "_original_" . rand(1, 50) . '.' . 'webp';

            $ogImageName            = date('YmdHis') . "_ogImage_" . rand(1, 50) . '.' . $fileType;

            $thumbnailImageName     = date('YmdHis') . "_thumbnail_100x100_" . rand(1, 50) . '.' . 'webp';
            $bigImageName           = date('YmdHis') . "_big_1080x1000_" . rand(1, 50) . '.' . 'webp';
            $bigImageNameTwo        = date('YmdHis') . "_big_730x400_" . rand(1, 50) . '.' . 'webp';
            $mediumImageName        = date('YmdHis') . "_medium_258x215_" . rand(1, 50) . '.' . 'webp';
            $mediumImageNameTwo     = date('YmdHis') . "_medium_350x190_" . rand(1, 50) . '.' . 'webp';
            $mediumImageNameThree   = date('YmdHis') . "_medium_460x350_" . rand(1, 50) . '.' . 'webp';
            $smallImageName         = date('YmdHis') . "_small_240x160_" . rand(1, 50) . '.' . 'webp';

            if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                $directory              = 'images/';
            else:
                $directory              = 'public/images/';
            endif;

            $originalImageUrl       = $directory . $originalImageName;
            $ogImageUrl             = $directory . $ogImageName;
            $thumbnailImageUrl      = $directory . $thumbnailImageName;
            $bigImageUrl            = $directory . $bigImageName;
            $bigImageUrlTwo         = $directory . $bigImageNameTwo;
            $mediumImageUrl         = $directory . $mediumImageName;
            $mediumImageUrlTwo      = $directory . $mediumImageNameTwo;
            $mediumImageUrlThree    = $directory . $mediumImageNameThree;
            $smallImageUrl          = $directory . $smallImageName;

            if (settingHelper('default_storage') == 's3'):

                //ogImage
                $imgOg = Image::make($requestImage)->fit(730, 400)->stream();

                //jpg. jpeg, JPEG, JPG compression
                if ($fileType == 'jpeg' or $fileType == 'jpg' or $fileType == 'JPEG' or $fileType == 'JPG'):
                    $imgOriginal=Image::make(imagecreatefromjpeg($requestImage))->encode('webp', 70);
                    $imgThumbnail=Image::make(imagecreatefromjpeg($requestImage))->fit(100, 100)->encode('webp', 70);
                    $imgBig=Image::make(imagecreatefromjpeg($requestImage))->fit(1080, 1000)->encode('webp', 70);
                    $imgBigTwo=Image::make(imagecreatefromjpeg($requestImage))->fit(730, 400)->encode('webp', 70);
                    $imgMedium=Image::make(imagecreatefromjpeg($requestImage))->fit(358, 215)->encode('webp', 70);
                    $imgMediumTwo=Image::make(imagecreatefromjpeg($requestImage))->fit(350, 190)->encode('webp', 70);
                    $imgMediumThree=Image::make(imagecreatefromjpeg($requestImage))->fit(460, 350)->encode('webp', 70);
                    $imgSmall=Image::make(imagecreatefromjpeg($requestImage))->fit(240, 160)->encode('webp', 70);

                //png compression
                elseif ($fileType == 'PNG' or $fileType == 'png'):

                    $imgOriginal=Image::make(imagecreatefrompng($requestImage))->encode('webp', 70);
                    $imgThumbnail=Image::make(imagecreatefrompng($requestImage))->fit(100, 100)->encode('webp', 70);
                    $imgBig=Image::make(imagecreatefrompng($requestImage))->fit(1080, 1000)->encode('webp', 70);
                    $imgBigTwo=Image::make(imagecreatefrompng($requestImage))->fit(730, 400)->encode('webp', 70);
                    $imgMedium=Image::make(imagecreatefrompng($requestImage))->fit(358, 215)->encode('webp', 70);
                    $imgMediumTwo=Image::make(imagecreatefrompng($requestImage))->fit(350, 190)->encode('webp', 70);
                    $imgMediumThree=Image::make(imagecreatefrompng($requestImage))->fit(460, 350)->encode('webp', 70);
                    $imgSmall=Image::make(imagecreatefrompng($requestImage))->fit(240, 160)->encode('webp', 70);

                endif;

                try {
                    Storage::disk('s3')->put($originalImageUrl, $imgOriginal);
                    Storage::disk('s3')->put($ogImageUrl, $imgOg);
                    Storage::disk('s3')->put($thumbnailImageUrl, $imgThumbnail);
                    Storage::disk('s3')->put($bigImageUrl, $imgBig);
                    Storage::disk('s3')->put($bigImageUrlTwo, $imgBigTwo);
                    Storage::disk('s3')->put($mediumImageUrl, $imgMedium);
                    Storage::disk('s3')->put($mediumImageUrlTwo, $imgMediumTwo);
                    Storage::disk('s3')->put($mediumImageUrlThree, $imgMediumThree);
                    Storage::disk('s3')->put($smallImageUrl, $imgSmall);
                } catch (S3 $e) {
                    $data['status'] = 'error';
                    $data['message']= $e->getMessage();
                    return Response()->json($data);
                }
            elseif (settingHelper('default_storage') == 'local'):
                Image::make($requestImage)->fit(730, 400)->save($ogImageUrl);

                Image::make($requestImage)->fit(730, 400)->save($ogImageUrl);

                if ($fileType == 'jpeg' or $fileType == 'jpg' or $fileType == 'JPEG' or $fileType == 'JPG'):
                    Image::make(imagecreatefromjpeg($requestImage))->save($originalImageUrl, 70);

                    Image::make(imagecreatefromjpeg($requestImage))->fit(100, 100)->save($thumbnailImageUrl, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(1080, 1000)->save($bigImageUrl, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(730, 400)->save($bigImageUrlTwo, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(358, 215)->save($mediumImageUrl, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(350, 190)->save($mediumImageUrlTwo, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(460, 350)->save($mediumImageUrlThree, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(240, 160)->save($smallImageUrl, 70);

                elseif ($fileType == 'PNG' or $fileType == 'png'):
                    Image::make(imagecreatefrompng($requestImage))->save($originalImageUrl, 70);

                    Image::make(imagecreatefrompng($requestImage))->fit(100, 100)->save($thumbnailImageUrl, 70);
                    Image::make(imagecreatefrompng($requestImage))->fit(1080, 1000)->save($bigImageUrl, 70);
                    Image::make(imagecreatefrompng($requestImage))->fit(730, 400)->save($bigImageUrlTwo, 70);
                    Image::make(imagecreatefrompng($requestImage))->fit(358, 215)->save($mediumImageUrl, 70);
                    Image::make(imagecreatefrompng($requestImage))->fit(350, 190)->save($mediumImageUrlTwo, 70);
                    Image::make(imagecreatefrompng($requestImage))->fit(460, 350)->save($mediumImageUrlThree, 70);
                    Image::make(imagecreatefrompng($requestImage))->fit(240, 160)->save($smallImageUrl, 70);
                endif;
            endif;

            $image->original_image      = str_replace("public/","",$originalImageUrl);
            $image->og_image            = str_replace("public/","",$ogImageUrl);
            $image->thumbnail           = str_replace("public/","",$thumbnailImageUrl);
            $image->big_image           = str_replace("public/","",$bigImageUrl);
            $image->big_image_two       = str_replace("public/","",$bigImageUrlTwo);
            $image->medium_image        = str_replace("public/","",$mediumImageUrl);
            $image->medium_image_two    = str_replace("public/","",$mediumImageUrlTwo);
            $image->medium_image_three  = str_replace("public/","",$mediumImageUrlThree);
            $image->small_image         = str_replace("public/","",$smallImageUrl);
            $image->disk                = settingHelper('default_storage');
            $image->save();
            $image                      = galleryImage::latest()->first();

            return $image->id;
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function saveNews(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|min:2|unique:posts',
            'content' => 'required',
            'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,png|max:5120'
        ])->validate();

        try {

            DB::beginTransaction();

            $post               = new Post();
            $post->title        = $request->get('title');
            $post->slug         = $this->make_slug($request->title);
            $post->user_id      = Sentinel::getUser()->id;
            $post->content      = $request->get('content');
            $post->submitted    = 1;
            $post->language     = app()->getLocale();

            if ($request->hasFile('image')):
                $post->image_id = $this->imageUpload($request);
            endif;

            $post->save();

            DB::commit();

            return redirect()->back()->with('success', __('successfully_added'));
        }
        catch(\Exception $e) {
            dd($e->getMessage());
            Log::error($e->getMessage(), $e->getTrace());
            DB::rollBack();

            throw ValidationException::withMessages(["submit" => __('Failed to submit news !!!')]);
        }
    }

    public function search(Request $request)
    {
        $posts              = Post::where(DB::raw('LOWER(title)'), 'like', '%'.strtolower($request->get('search')).'%')
                                ->when(Sentinel::check()== false, function ($query) {
                                $query->where('auth_required',0); })
                                ->simplePaginate(7);

        return view('site.pages.search', compact('posts'));
    }

    //post by category
    public function postByCategory($slug){
        try{
            $id         = Category::where('slug',$slug)->first()->id;
            $posts      = Post::with(['image', 'user'])->where('category_id',$id)->where('visibility', 1)
                            ->where('status', 1)
                            ->when(Sentinel::check()== false, function ($query) {
                                $query->where('auth_required',0); })
                            ->orderBy('id', 'desc')
                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->paginate(10);

            $widgetService      = new WidgetService();
            $widgets            = $widgetService->getWidgetDetails();

            //dd($relatedPost);

            $tracker                 = new VisitorTracker();
            $tracker->page_type      = \App\Enums\VisitorPageType::PostDetailPage;
            $tracker->url            = \Request::url();
            $tracker->source_url     = \url()->previous();
            $tracker->ip             = \Request()->ip();
            $tracker->agent_browser  = UserAgentBrowser(\Request()->header('User-Agent'));
            $tracker->save();

            return view('site.pages.category_posts', compact('posts', 'widgets'));
        }
        catch (\Exception $e){
            return view('site.pages.404');
        }
    }

    //post by tags
    public function postByTags($slug){
        try{
            $posts      =  Post::with(['image', 'user'])->whereRaw("FIND_IN_SET('$slug',tags)")->where('visibility', 1)
                            ->where('status', 1)
                            ->when(Sentinel::check()== false, function ($query) {
                                $query->where('auth_required',0); })
                            ->orderBy('id', 'desc')
                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->paginate(10);

            $widgetService      = new WidgetService();
            $widgets            = $widgetService->getWidgetDetails();

            //dd($relatedPost);

            $tracker                 = new VisitorTracker();
            $tracker->page_type      = \App\Enums\VisitorPageType::PostDetailPage;
            $tracker->url            = \Request::url();
            $tracker->source_url     = \url()->previous();
            $tracker->ip             = \Request()->ip();
            $tracker->agent_browser  = UserAgentBrowser(\Request()->header('User-Agent'));
            $tracker->save();

            return view('site.pages.category_posts', compact('posts', 'widgets'));
        }
        catch (\Exception $e){
            return view('site.pages.404');
        }
    }

    public function getReadMorePost(Request $request)
    {
        $skip            = $request->last_id * 6;
        $postCount       = Post::where('visibility', 1)
                            ->where('status', 1)
                            ->when(Sentinel::check()== false, function ($query) {
                                $query->where('auth_required',0);
                            })
                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();
        $hideReadMore     = 0;
        if($skip >= $postCount) {
            $hideReadMore = 1;
        }
        $posts            = Post::with(['image', 'user', 'category'])->where('visibility', 1)
                            ->where('status', 1)
                            ->when(Sentinel::check()== false, function ($query) {
                                $query->where('auth_required',0); })
                            ->orderBy('id', 'desc')
                            ->limit(6)
                            ->skip($skip)
                            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();



        $allPosts  = [];
        foreach($posts as $post){
            $appendRow                   = '';
            $appendRow                  .= "<div class='sg-post medium-post-style-1'>";
               $appendRow               .=  "<div class='entry-header'>";
                 $appendRow             .=    "<div class='entry-thumbnail'>";
                    $appendRow          .=   "<a href=' ".route('article.detail', ['id' => $post->slug]) ."'>";

                      if(isFileExist($post->image, @$post->image->small_image)){

                        $appendRow      .= "<img src=' ".basePath($post->image).'/'.$post->image->small_image ." ' class='img-fluid'   alt='". $post->title ."  '>";
                    }else{
                       $appendRow        .= "<img src='".static_asset('default-image/default-240x160.png') ." '  class='img-fluid'   alt='". $post->title ."' >";
                    }

                    $appendRow           .= " </a>";
                   $appendRow            .=  "</div>";
                  $appendRow             .=   "<div class='category'>";
                    $appendRow           .=     "<ul class='global-list'>";
                    if ($post->category != "") :
                    $appendRow           .=         "<li><a href='#'> ".$post->category->category_name ."</a></li>";
                    endif;
                    $appendRow           .=     "</ul>";
                   $appendRow            .=  "</div>";
                $appendRow               .= "</div>";
                $appendRow               .= "<div class='entry-content align-self-center'>";

                 $appendRow              .=    "<h3 class='entry-title'>";
                 $appendRow              .=  "<a href=' ".route('article.detail', ['id' => $post->slug])." '> ". \Illuminate\Support\Str::limit($post->title, 60)." ";
                 $appendRow              .=  "</a>";
                 $appendRow              .=  "</h3>";

                   $appendRow            .=  "<div class='entry-meta mb-2'>";
                      $appendRow         .=   "<ul class='global-list'>";
                          $appendRow     .=   "<li> ".__('post_by') ." <a href='#'> ".data_get($post, 'user.first_name')." </a></li>";
                           $appendRow    .=  "<li><a href='#'> ". $post->updated_at->format('F j, Y') ."</a></li>";
                       $appendRow        .=  "</ul>";
                   $appendRow            .=  "</div> " ;
                   $appendRow            .=  "<p>". \Illuminate\Support\Str::limit($post->content, 150) ."</p>";
               $appendRow                .=  "</div>";
           $appendRow                    .=  "</div>";

           $allPosts[] =  $appendRow;
        }
        return response()->json([$allPosts, $hideReadMore]);
    }

    private function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

//    public function tags(){
////        $posts = Post:: whereRaw("FIND_IN_SET('bangladesh',tags)")->get();
////        dd($posts);
////    }

}
