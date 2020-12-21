<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Image as galleryImage;
use Modules\Gallery\Entities\Video;
use DB;
use File;
use Image;
use Validator;
use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception as S3;
use Modules\Common\Entities\Cron;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery::index');
    }

    public function imageGallery(){

        try {
            $url        = 'https://s3.' . config('filesystems.disks.s3.region') . '.amazonaws.com/' . config('filesystems.disks.s3.bucket') . '/';
            $images     = [];
            $files      = Storage::disk('s3')->files('images');

            foreach ($files as $file) {
                $images[] = [
                    'name' => str_replace('images/', '', $file),
                    'src' => $url . $file
                ];
            }

            return $images;
        } catch(S3 $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return view('gallery::media_gallery');
    }

    public function imageUpload(Request $request){
        if ($request->file('image')) :
            $validation = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,png|max:5120',
            ])->validate();

            $image                  = new galleryImage();

            $requestImage           = $request->file('image');
            $fileType               = $requestImage->getClientOriginalExtension();

            $originalImageName      = date('YmdHis') . "_original_" . rand(1, 50) . '.' . 'webp';
            $ogImageName = date('YmdHis') . "_ogImage_" . rand(1, 50) . '.' . $fileType;
            $thumbnailImageName     = date('YmdHis') . "_thumbnail_100x100_" . rand(1, 50) . '.' . 'webp';
            $bigImageName           = date('YmdHis') . "_big_1080x1000_" . rand(1, 50) . '.' . 'webp';
            $bigImageNameTwo        = date('YmdHis') . "_big_730x400_" . rand(1, 50) . '.' . 'webp';
            $mediumImageName        = date('YmdHis') . "_medium_258x215_" . rand(1, 50) . '.' . 'webp';
            $mediumImageNameTwo     = date('YmdHis') . "_medium_350x190_" . rand(1, 50) . '.' . 'webp';
            $mediumImageNameThree   = date('YmdHis') . "_medium_460x350_" . rand(1, 50) . '.' . 'webp';
            $smallImageName         = date('YmdHis') . "_small_240x160_" . rand(1, 50) . '.' . 'webp';

            // image upload directory
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

            if(settingHelper('default_storage') =='s3') :
                //ogImage
                $imgOg = Image::make($requestImage)->fit(730, 400)->stream();

                //ogImage
                $imgOg = Image::make($requestImage)->fit(730, 400)->stream();

                //jpg. jpeg, JPEG, JPG compression
                if ($fileType == 'jpeg' or $fileType == 'jpg' or $fileType == 'JPEG' or $fileType == 'JPG'):
                    $imgOriginal    = Image::make(imagecreatefromjpeg($requestImage))->encode('webp', 70);
                    $imgThumbnail   = Image::make(imagecreatefromjpeg($requestImage))->fit(100, 100)->encode('webp', 70);
                    $imgBig         = Image::make(imagecreatefromjpeg($requestImage))->fit(1080, 1000)->encode('webp', 70);
                    $imgBigTwo      = Image::make(imagecreatefromjpeg($requestImage))->fit(730, 400)->encode('webp', 70);
                    $imgMedium      = Image::make(imagecreatefromjpeg($requestImage))->fit(358, 215)->encode('webp', 70);
                    $imgMediumTwo   = Image::make(imagecreatefromjpeg($requestImage))->fit(350, 190)->encode('webp', 70);
                    $imgMediumThree = Image::make(imagecreatefromjpeg($requestImage))->fit(460, 350)->encode('webp', 70);
                    $imgSmall       = Image::make(imagecreatefromjpeg($requestImage))->fit(240, 160)->encode('webp', 70);

                 //png compression
                elseif ($fileType == 'PNG' or $fileType == 'png'):

                    $imgOriginal    = Image::make(imagecreatefrompng($requestImage))->encode('webp', 70);
                    $imgThumbnail   = Image::make(imagecreatefrompng($requestImage))->fit(100, 100)->encode('webp', 70);
                    $imgBig         = Image::make(imagecreatefrompng($requestImage))->fit(1080, 1000)->encode('webp', 70);
                    $imgBigTwo      = Image::make(imagecreatefrompng($requestImage))->fit(730, 400)->encode('webp', 70);
                    $imgMedium      = Image::make(imagecreatefrompng($requestImage))->fit(358, 215)->encode('webp', 70);
                    $imgMediumTwo   = Image::make(imagecreatefrompng($requestImage))->fit(350, 190)->encode('webp', 70);
                    $imgMediumThree = Image::make(imagecreatefrompng($requestImage))->fit(460, 350)->encode('webp', 70);
                    $imgSmall       = Image::make(imagecreatefrompng($requestImage))->fit(240, 160)->encode('webp', 70);

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
                } catch(S3 $e) {
                    $data['status']     = 'error';
                    $data['message']    = $e->getMessage();

                    return Response()->json($data);
                }

            elseif(settingHelper('default_storage') =='local'):

                Image::make($requestImage)->fit(730, 400)->save($ogImageUrl);
                //jpg. jpeg, JPEG, JPG compression
                if ($fileType == 'jpeg' or $fileType == 'jpg' or $fileType == 'JPEG' or $fileType == 'JPG'):
                    Image::make(imagecreatefromjpeg($requestImage))->save($originalImageUrl, 70);

                    Image::make(imagecreatefromjpeg($requestImage))->fit(100, 100)->save($thumbnailImageUrl, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(1080, 1000)->save($bigImageUrl, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(730, 400)->save($bigImageUrlTwo, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(358, 215)->save($mediumImageUrl, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(350, 190)->save($mediumImageUrlTwo, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(460, 350)->save($mediumImageUrlThree, 70);
                    Image::make(imagecreatefromjpeg($requestImage))->fit(240, 160)->save($smallImageUrl, 70);

                //PNG, png compression
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

            $data['status']             =  'success';
            $data['data']               = $image;

            if($image->thumbnail == ''){
                if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                    $thumbnail = 'default-image/default-100x100.png';
                else:
                    $thumbnail = 'public/default-image/default-100x100.png';
                endif;
            }else{
                if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                    $thumbnail = $image->thumbnail;
                else:
                    $thumbnail = 'public'.'/'.$image->thumbnail;
                endif;
            }
            return Response()->json([$data, $thumbnail]);

        else :
            $data['status']                 = 'error';
            $data['message']                = __('upload_failed');

            return Response()->json($data);
        endif;
    }

    public function deleteImage(Request $request){

        $image=galleryImage::find($request->row_id);



        if($image->disk =='s3') :

            if (Storage::disk('s3')->exists($image->original_image) && !blank($image->original_image)) :
                Storage::disk('s3')->delete($image->original_image);
            endif;
            if (Storage::disk('s3')->exists($image->og_image) && !blank($image->og_image)) :
                Storage::disk('s3')->delete($image->og_image);
            endif;
            if (Storage::disk('s3')->exists($image->thumbnail) && !blank($image->thumbnail)) :
                Storage::disk('s3')->delete($image->thumbnail);
            endif;
            if (Storage::disk('s3')->exists($image->big_image) && !blank($image->big_image)) :
                Storage::disk('s3')->delete($image->big_image);
            endif;
            if (Storage::disk('s3')->exists($image->big_image_two) && !blank($image->big_image_two)) :
                Storage::disk('s3')->delete($image->big_image_two);
            endif;
            if (Storage::disk('s3')->exists($image->medium_image) && !blank($image->medium_image)) :
                Storage::disk('s3')->delete($image->medium_image);
            endif;
            if (Storage::disk('s3')->exists($image->medium_image_two) && !blank($image->medium_image_two)) :
                Storage::disk('s3')->delete($image->medium_image_two);
            endif;
            if (Storage::disk('s3')->exists($image->medium_image_three) && !blank($image->medium_image_three)) :
                Storage::disk('s3')->delete($image->medium_image_three);
            endif;
            if (Storage::disk('s3')->exists($image->small_image) && !blank($image->small_image)) :
                Storage::disk('s3')->delete($image->small_image);
            endif;

            $image->delete();

            $data['status']         = "success";
            $data['message']        =  __('successfully_deleted');

        elseif($image->disk =='local'):
            if ($image->count() > 0) :

                //public path 
                if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) {
                    $path = '';
                }else{
                    $path = 'public/';
                }

                if (File::exists($path.$image->original_image) && !blank($image->original_image)) :
                    unlink($path.$image->original_image);
                endif;
                if (File::exists($path.$image->og_image) && !blank($image->og_image)) :
                    unlink($path.$image->og_image);
                endif;
                if (File::exists($path.$image->thumbnail) && !blank($image->thumbnail)) :
                    unlink($path.$image->thumbnail);
                endif;
                if (File::exists($path.$image->big_image) && !blank($image->big_image)) :
                    unlink($path.$image->big_image);
                endif;
                if (File::exists($path.$image->big_image_two) && !blank($image->big_image_two)) :
                    unlink($path.$image->big_image_two);
                endif;
                if (File::exists($path.$image->medium_image) && !blank($image->medium_image)) :
                    unlink($path.$image->medium_image);
                endif;
                if (File::exists($path.$image->medium_image_two) && !blank($image->medium_image_two)) :
                    unlink($path.$image->medium_image_two);
                endif;
                if (File::exists($path.$image->medium_image_three) && !blank($image->medium_image_three)) :
                    unlink($path.$image->medium_image_three);
                endif;
                if (File::exists($path.$image->small_image)) :
                    unlink($path.$image->small_image);
                endif;
                $image->delete();

                $data['status']     = "success";
                $data['message']    =  __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;

        endif;

        echo json_encode($data);
    }

    public function videoUpload(Request $request){

        $requestVideo           = $request->file('video');
        $fileType               = $requestVideo->getClientOriginalExtension();
        $videoName_original     = date('YmdHis') . "_original_" . rand(1, 50);


        if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
            $directory              = 'videos/';
        else:
            $directory              = 'public/videos/';
        endif;

        $originalThumbUrl       = $directory . 'thumbnail/' . $videoName_original. '.jpg';
        $originalVideoUrl       = $directory . $videoName_original. '.' . $fileType;

        $video                  = new Video();
        $video->video_name      = $videoName_original;
        $video->video_thumbnail = str_replace("public/","", $originalThumbUrl);
        $video->video_type      = $fileType;
        $video->original        = str_replace("public/","",$originalVideoUrl);

        try {
            $saveOriginal           = $requestVideo->move($directory, $originalVideoUrl);
            if(settingHelper('ffmpeg_status') == 1){
                $cmdForThumbnail        = "ffmpeg -i $requestVideo -ss 00:00:03.000 -vframes 1 $originalThumbUrl";
                exec($cmdForThumbnail);
                // save to public/video directory
                $video->video_thumbnail = str_replace("public/","", $originalThumbUrl);
            } else {
                $video->video_thumbnail = '';
            }

            $video->disk            = settingHelper('default_storage');
            $video->save();

            $video = Video::latest()->first();

            if(settingHelper('ffmpeg_status') == 1):

                if(settingHelper('default_storage') =='local') :
                    if (File::exists($video->video_thumbnail)) :

                        $contents   = \File::get($video->video_thumbnail);
                        return Response()->json([$video, $video_thumbnail]);
                        $videoThumb = Image::make($contents)->fit(200, 200)->save($originalThumbUrl);

                    endif;
                endif;

                if(settingHelper('default_storage') =='s3') :
                    if (File::exists($video->video_thumbnail)) :

                        $contents   = \File::get($video->video_thumbnail);
                        $videoThumb = Image::make($contents)->fit(200, 200)->stream();
                        Storage::disk('s3')->put($originalThumbUrl, $videoThumb);
                        unlink($video->video_thumbnail);

                    endif;
                endif;

            endif;

            $cron               = new Cron();
            $cron->cron_for     ='video_convert';
            $cron->video_id     = $video->id;
            $cron->save();

            if($video->video_thumbnail == '' || !file_exists($video->video_thumbnail)){
                if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                    $video_thumbnail = 'default-image/default-video-100x100.png';
                else:
                    $video_thumbnail = 'public/default-image/default-video-100x100.png';
                endif;
            }else{
                if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                    $video_thumbnail = $video->video_thumbnail;
                else:
                    $video_thumbnail = 'public'.'/'.$video->video_thumbnail;
                endif;
            }

            return Response()->json([$video, $video_thumbnail]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteVideo(Request $request){
        $video          = Video::find($request->row_id);
        if($video->disk =='s3') :

            Storage::disk('s3')->delete($video->original);
            Storage::disk('s3')->delete($video->p_144);
            Storage::disk('s3')->delete($video->p_240);
            Storage::disk('s3')->delete($video->p_360);
            Storage::disk('s3')->delete($video->p_480);

            Storage::disk('s3')->delete($video->video_thumbnail);

            $video->delete();
            $data['status']     = "success";
            $data['message']    =  __('successfully_deleted');


        elseif($video->disk =='local'):

            //public path 
                if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) {
                    $path = '';
                }else{
                    $path = 'public/';
                }

            if ($video->count() > 0) :
                if (File::exists($path.$video->original) && $video->original != "") :
                    unlink($path.$video->original);
                endif;
                if (File::exists($path.$video->p_144) && $video->p_144 != "") :
                    unlink($path.$video->p_144);
                endif;
                if (File::exists($path.$video->p_240) && $video->p_240 != "") :
                    unlink($path.$video->p_240);
                endif;
                if (File::exists($path.$video->p_360) && $video->p_360 != "") :
                    unlink($path.$video->p_360);
                endif;
                if (File::exists($path.$video->p_480) && $video->p_480 != "") :
                    unlink($path.$video->p_480);
                endif;
                if (File::exists($path.$video->video_thumbnail) && $video->video_thumbnail != "") :
                    unlink($path.$video->video_thumbnail);
                endif;
                $video->delete();

                $data['status']     = "success";
                $data['message']    =  __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;
        endif;

        echo json_encode($data);
    }

    public function fetchImage(Request $request){

        $images         = galleryImage::orderBy('id','DESC')->paginate(24);

        //return response()->json($images);

        return view('gallery::ajax-images', compact('images'));
    }

    public function fetchVideo(){
        $videos         = Video::orderBy('id','DESC')->paginate(24);

        return view('gallery::ajax-videos',compact('videos'));

    }
}
