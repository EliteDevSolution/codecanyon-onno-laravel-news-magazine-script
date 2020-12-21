<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Gallery\Entities\Video;
use File;
use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception as S3;
use Modules\Common\Entities\Cron;
use DB;

class VideoConverterCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature    = 'videoConverter:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description  = 'Command form video convert';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $crons      = Cron::where('cron_for','video_convert')->get();
        //\Log::info($crons);
        foreach ($crons as $cron) {
            if($cron->video_id != null):
                    $video=Video::findOrFail($cron->video_id);
                    // $requestVideo=\File::get(public_path($video->original));

                    $requestVideo=static_asset($video->original);

                    $size1  = '256x144';
                    $size2  = '320x240';
                    $size3  = '480x360';
                    $size4  = '858x480';
                    $size5  = '1280x720';
                    $size6  = '1920x1080';

                    $fileType = $video->video_type;

                    $videoName_original     = $video->video_name;
                    $videoName_256x144      = date('YmdHis') . "_256x144_" . rand(1, 50);
                    $videoName_320x240      = date('YmdHis') . "_320x240_" . rand(1, 50);
                    $videoName_480x360      = date('YmdHis') . "_480x360_" . rand(1, 50);
                    $videoName_858x480      = date('YmdHis') . "_858x480_" . rand(1, 50);
                    $videoName_1280x720     = date('YmdHis') . "_1280x720_" . rand(1, 50);
                    $videoName_1920x1080    = date('YmdHis') . "_1920x1080_" . rand(1, 50);

                    if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') =='s3' || defined('LARAVEL_START_FROM_PUBLIC')) :
                        $directory              = 'videos/';
                    else:
                        $directory              = 'public/videos/';
                    endif;

                    $originalVideoUrl       = $directory . $videoName_original. '.' . $fileType;
                    $videoUrl_256x144       = $directory . $videoName_256x144. '.' . $fileType;
                    $videoUrl_320x240       = $directory . $videoName_320x240. '.' . $fileType;
                    $videoUrl_480x360       = $directory . $videoName_480x360. '.' . $fileType;
                    $videoUrl_858x480       = $directory . $videoName_858x480. '.' . $fileType;
                    $videoUrl_1280x720      = $directory . $videoName_1280x720. '.' . $fileType;
                    $videoUrl_1920x1080     = $directory . $videoName_1920x1080. '.' . $fileType;

                    $originalVideoUrlWithPublicPath     = public_path($originalVideoUrl);
                    $videoUrl_256x144WithPublicPath     = public_path($videoUrl_256x144);
                    $videoUrl_320x240WithPublicPath     = public_path($videoUrl_320x240);
                    $videoUrl_480x360WithPublicPath     = public_path($videoUrl_480x360);
                    $videoUrl_858x480WithPublicPath     = public_path($videoUrl_858x480);
                    $videoUrl_1280x720WithPublicPath    = public_path($videoUrl_1280x720);
                    $videoUrl_1920x1080WithPublicPath   = public_path($videoUrl_1920x1080);




                    try {

                        if(settingHelper('ffmpeg_status') == 0){

                            if($video->disk =='s3') :
                                if (File::exists($requestVideo)) :
                                  
                                    Storage::disk('s3')->put($originalVideoUrl, fopen($requestVideo, 'r+'), 'public');
                                    unlink($requestVideo);

                                endif;
                            endif;

                        } else {

                            $ffmpegPath      = 'ffmpeg';
                            $ffprobePath     = 'ffprobe';

                            $cmdGetResolution       = "$ffprobePath -v error -select_streams v:0 -show_entries stream=height -of csv=s=x:p=0 $requestVideo";

                        $resolution             = exec($cmdGetResolution);

                        if($resolution >= 1080):
                            $cmd1   = "$ffmpegPath-i $requestVideo -s $size1 -c:a copy $videoUrl_256x144WithPublicPath";
                            $cmd2   = "$ffmpegPath-i $requestVideo -s $size2 -c:a copy $videoUrl_320x240WithPublicPath";
                            $cmd3   = "$ffmpegPath-i $requestVideo -s $size3 -c:a copy $videoUrl_480x360WithPublicPath";
                            $cmd4   = "$ffmpegPath-i $requestVideo -s $size4 -c:a copy $videoUrl_858x480WithPublicPath";
                            $cmd5   = "$ffmpegPath-i $requestVideo -s $size5 -c:a copy $videoUrl_1280x720WithPublicPath";
                            $cmd6   = "$ffmpegPath-i $requestVideo -s $size6 -c:a copy $videoUrl_1920x1080WithPublicPath";

                            exec($cmd1);
                            exec($cmd2);
                            exec($cmd3);
                            exec($cmd4);
                            exec($cmd5);
                            exec($cmd6);

                            $video  -> v_144p   = str_replace("public/","",$videoUrl_256x144);
                            $video  -> v_240p   = str_replace("public/","",$videoUrl_320x240);
                            $video  -> v_360p   = str_replace("public/","",$videoUrl_480x360);
                            $video  -> v_480p   = str_replace("public/","",$videoUrl_858x480);
                            $video  -> v_720p   = str_replace("public/","",$videoUrl_1280x720);
                            $video  -> v_1080p  = str_replace("public/","",$videoUrl_1920x1080);

                        elseif($resolution >= 720):
                            $cmd1   = "$ffmpegPath-i $requestVideo -s $size1 -c:a copy $videoUrl_256x144WithPublicPath";
                            $cmd2   = "$ffmpegPath-i $requestVideo -s $size2 -c:a copy $videoUrl_320x240WithPublicPath";
                            $cmd3   = "$ffmpegPath-i $requestVideo -s $size3 -c:a copy $videoUrl_480x360WithPublicPath";
                            $cmd4   = "$ffmpegPath-i $requestVideo -s $size4 -c:a copy $videoUrl_858x480WithPublicPath";
                            $cmd5   = "$ffmpegPath-i $requestVideo -s $size5 -c:a copy $videoUrl_1280x720WithPublicPath";

                            exec($cmd1);
                            exec($cmd2);
                            exec($cmd3);
                            exec($cmd4);
                            exec($cmd5);

                            $video  -> v_144p= str_replace("public/","",$videoUrl_256x144);
                            $video  -> v_240p= str_replace("public/","",$videoUrl_320x240);
                            $video  -> v_360p= str_replace("public/","",$videoUrl_480x360);
                            $video  -> v_480p= str_replace("public/","",$videoUrl_858x480);
                            $video  -> v_720p= str_replace("public/","",$videoUrl_1280x720);

                        elseif($resolution >= 480):
                            $cmd1   = "$ffmpegPath-i $requestVideo -s $size1 -c:a copy $videoUrl_256x144WithPublicPath";
                            $cmd2   = "$ffmpegPath-i $requestVideo -s $size2 -c:a copy $videoUrl_320x240WithPublicPath";
                            $cmd3   = "$ffmpegPath-i $requestVideo -s $size3 -c:a copy $videoUrl_480x360WithPublicPath";
                            $cmd4   = "$ffmpegPath-i $requestVideo -s $size4 -c:a copy $videoUrl_858x480WithPublicPath";

                            exec($cmd1);
                            exec($cmd2);
                            exec($cmd3);
                            exec($cmd4);

                            $video  -> v_144p= str_replace("public/","",$videoUrl_256x144);
                            $video  -> v_240p= str_replace("public/","",$videoUrl_320x240);
                            $video  -> v_360p= str_replace("public/","",$videoUrl_480x360);
                            $video  -> v_480p= str_replace("public/","",$videoUrl_858x480);

                        elseif($resolution >= 360):
                            $cmd1   = "$ffmpegPath-i $requestVideo -s $size1 -c:a copy $videoUrl_256x144WithPublicPath";
                            $cmd2   = "$ffmpegPath-i $requestVideo -s $size2 -c:a copy $videoUrl_320x240WithPublicPath";
                            $cmd3   = "$ffmpegPath-i $requestVideo -s $size3 -c:a copy $videoUrl_480x360WithPublicPath";

                            exec($cmd1);
                            exec($cmd2);
                            exec($cmd3);

                            $video  -> v_144p= str_replace("public/","",$videoUrl_256x144);
                            $video  -> v_240p= str_replace("public/","",$videoUrl_320x240);
                            $video  -> v_360p= str_replace("public/","",$videoUrl_480x360);

                        elseif($resolution >= 240):
                            $cmd1   = "$ffmpegPath-i $requestVideo -s $size1 -c:a copy $videoUrl_256x144WithPublicPath";
                            $cmd2   = "$ffmpegPath-i $requestVideo -s $size2 -c:a copy $videoUrl_320x240WithPublicPath";

                            exec($cmd1);
                            exec($cmd2);

                            $video  -> v_144p= str_replace("public/","",$videoUrl_256x144);
                            $video  -> v_240p= str_replace("public/","",$videoUrl_320x240);

                        else:
                            $cmd1   = "$ffmpegPath-i $requestVideo -s $size1 -c:a copy $videoUrl_256x144WithPublicPath";
                            exec($cmd1);

                            $video->v_144p= str_replace("public/","",$videoUrl_256x144);
                        endif;

                        // $video->save();

                        $video      = Video::findOrFail($cron->video_id);

                        \Log::info($video);

                        if($video->disk =='s3') :
                            if (File::exists($requestVideo)) :
                              
                                Storage::disk('s3')->put($originalVideoUrl, fopen($requestVideo, 'r+'), 'public');
                                unlink($requestVideo);

                            endif;

                            if (File::exists(public_path($video->v_144p)) && !blank($video->v_144p)) :
                                
                                Storage::disk('s3')->put($videoUrl_256x144, fopen(public_path($video->v_144p), 'r+'), 'public');
                                unlink(public_path($video->v_144p));

                            endif;
                            if (File::exists(public_path($video->v_240p)) && !blank($video->v_240p)) :
                                
                                Storage::disk('s3')->put($videoUrl_320x240, fopen(public_path($video->v_240p), 'r+'), 'public');
                                unlink(public_path($video->v_240p));

                            endif;
                            if (File::exists(public_path($video->v_360p)) && !blank($video->v_360p)) :
                             
                                Storage::disk('s3')->put($videoUrl_480x360, fopen(public_path($video->v_360p), 'r+'), 'public');
                                unlink(public_path($video->v_360p));

                            endif;
                            if (File::exists(public_path($video->v_480p)) && !blank($video->v_480p)) :
                               
                                Storage::disk('s3')->put($videoUrl_858x480, fopen(public_path($video->v_480p), 'r+'), 'public');
                                unlink(public_path($video->v_480p));

                            endif;
                            if (File::exists(public_path($video->v_720p)) && !blank($video->v_720p)) :
                                
                                Storage::disk('s3')->put($videoUrl_1280x720, fopen(public_path($video->v_720p), 'r+'), 'public');
                                unlink(public_path($video->v_720p));

                            endif;
                            if (File::exists(public_path($video->v_1080p)) && !blank($video->v_1080p)) :
                                
                                Storage::disk('s3')->put($videoUrl_1920x1080, fopen(public_path($video->v_1080p), 'r+'), 'public');
                                unlink(public_path($video->v_1080p));

                            endif;

                        endif;

                        }

                        // return Response()->json($video);
                    } catch (\Exception $e) {
                        \Log::info($e);
                        return $e->getMessage();
                    }

                    $cron_id    = $cron->id;

                    //\Log::info($cron_id);

                    // DB::table('crons')->where('id', $cron_id)->delete();
            endif;
        }
    }
}
