<?php

if (!function_exists('get_youtube_video_id')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function get_youtube_video_id($url = "")
    {
        $yt_video_id    = "";
        if(strpos($url,'v') !== false):
            parse_str( parse_url( $url, PHP_URL_QUERY ), $yt_video_id );
            $yt_video_id    = $yt_video_id['v'];
        else:
            $yt_video_id    = parse_url($url, PHP_URL_PATH);
            $yt_video_id    = str_replace("/","",$yt_video_id);
        endif;

        return $yt_video_id;
    }


}

if (!function_exists('get_id_youtube')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function get_id_youtube($url = ""){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id     = $match[1];

        return $youtube_id;
    }
}
