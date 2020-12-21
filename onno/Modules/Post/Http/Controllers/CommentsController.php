<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Comment;
use Modules\Setting\Entities\Setting;
use function GuzzleHttp\Promise\all;

class CommentsController extends Controller
{
    public function index()
    {
        return view('post::comment_settings');
    }

    public function Comments()
    {
        $comments   = Comment::orderBy('id', 'desc')->with(['user', 'post'])->paginate(15);
        //    $comments=Comment::with(['replay','user','post'])
        //         ->where('comment_id', null)
        //         ->paginate(15);
        return view('post::comments', compact('comments'));
    }

    public function updateCommentSettings(Request $request)
    {
        $default_language       = $request->default_language ?? settingHelper('default_language');

        foreach ($request->except('_token') as $key => $value) :

            $setting            = Setting::where('title', $key)->where('lang', $default_language)->first();

            if ($setting == ""):
                $setting            = new Setting();
                $setting->title     = $key;
                $setting->value     = $value;
                $setting->lang      = $default_language;

                $setting->save();
            else:
                $setting->value     = $value;
                $setting->lang      = $default_language;

                $setting->save();
            endif;

        endforeach;

        return redirect()->back()->with('success', __('successfully_updated'));
    }
}
