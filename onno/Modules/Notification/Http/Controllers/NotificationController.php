<?php

namespace Modules\Notification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\Entities\Post;
use Illuminate\Routing\Controller;
use Validator;
use Modules\Language\Entities\Language;

class NotificationController extends Controller
{
    public function sendNotification(){

        return view('notification::send_notification');
    }

    public function notificationSetting()
    {
        $activeLang = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        return view('notification::notification_setting', compact('activeLang'));
    }

    function notificationSend(Request $request)
    {
        Validator::make($request->all(), [
            'post_id'   => 'required',
            'message'   => 'required|min:5',
            'headings'  => 'required',
            'icon_url'  => 'required',
            'image_url' => 'required',
        ])->validate();

        $post           = Post::find($request->post_id);
        $article        = settingHelper('article_detail_prefix') ?? 'article';

        $post_url       = url('/').'/'.$article.'/'.$post->slug;


        $data['message']    = $request->message;
        $data['url']        = $post_url;
        $data['headings']   = $request->headings;
        $data['icon']       = $request->icon_url;
        $data['img']        = $request->image_url;
        $data['id']         = $request->post_id;
        $data['vtype']      = 'post';
        $data['open_with']  = 'app';

        $this->send_notification($data);

        return redirect()->back()->with('success', __('successfully_send'));
    }

    protected function send_notification($data)
    {

        $onesignal_appid    = settingHelper('onesignal_app_id');
        $onesignal_api_keys = settingHelper('onesignal_api_key');

        $content  = array(
            "en"  => $data['message']
        );
        $headings = array(
            "en"  => $data['headings']
        );

        $fields   = array(
            'app_id'            => $onesignal_appid,
            'included_segments' => array('All'),
            'url'               => $data['url'],
            'contents'          => $content,
            'chrome_web_icon'   => $data['icon'],
            'chrome_web_image'  => $data['img'],
            'big_picture'       => $data['img'], // for android
            'small_icon'        => $data['icon'], // for android
            'large_icon'        => $data['icon'], // for android
            'headings'          => $headings,
            // vtype: for movie=movie, for tvseries= tvseries, for live tv=tv
            // open_with: for webview=web, for app=app
            'data' => array('id' => $data['id'], 'vtype' => $data['vtype'], 'open' => $data['open_with'], 'url' => $data['url'])
        );

        $fields         = json_encode($fields);
        $ch             = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                        'Authorization: Basic ' . $onesignal_api_keys));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response       = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public function sendCustomNotificationView()
    {
        return view('notification::send_custom_notification');
    }

    public function sendCustomNotification(Request $request)
    {
        Validator::make($request->all(), [
            'message'       => 'required|min:5',
            'headings'      => 'required',
            'icon_url'      => 'required',
            'image_url'     => 'required',
            'url'           => 'required',
        ])->validate();

        $data['message']    = $request->message;
        $data['url']        = $request->url;
        $data['headings']   = $request->headings;
        $data['icon']       = $request->icon_url;
        $data['img']        = $request->image_url;
        $data['id']         = '';
        $data['vtype']      = '';
        $data['open_with']  = 'app';

        $this->send_notification($data);

        return redirect()->back()->with('success', __('successfully_send'));
    }

    public function getPost(Request $request)
    {
        $term           = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $posts              = post::where('title', 'LIKE', '%' . $term . '%')->limit(50)->get();

        $formatted_posts    = [];

        foreach ($posts as $post) {
            $formatted_posts[] = ['id' => $post->id, 'text' => $post->title];
        }

        return \Response::json($formatted_posts);
    }

    public function getPostDetails(Request $request)
    {

        if (empty($request->post_id)) {
            return \Response::json([]);
        }
        $posts      = post::where('id', $request->post_id)->with('image', 'video')->first();

        return \Response::json($posts);
    }
}
