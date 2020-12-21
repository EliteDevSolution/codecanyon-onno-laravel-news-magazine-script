<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Modules\Post\Entities\Comment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;

class CommentController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'comment'       => 'required|string',
            'post_id'       => 'required|integer',
        ]);

        $data               = $request->except('_token');
        $data['user_id']    = Sentinel::getUser()->id;

        $comment            = new Comment();
        $comment->fill($data);
        $comment->save();

        return redirect()->back();
    }

    public function saveReply(Request $request)
    {
        $request->validate([
            'comment'       => 'required|string',
            'post_id'       => 'required|integer',
            'comment_id'    => 'required|integer',
        ]);

        $data               = $request->except('_token');
        $data['user_id']    = Sentinel::getUser()->id;

        $comment            = new Comment();

        $comment->fill($data);
        $comment->save();

        return redirect()->back();
    }

    public function switchLanguage(Request $request)
    {
        $lang               = $request->lang;

        App::setLocale($lang);
        Session::put('locale', $lang);
        LaravelLocalization::setLocale($lang);

        $url                = \LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());

        return response()->json($url);
    }

    public function modeChange()
    {
        $mode               = Session::get('mode');

        if($mode == 'sg-dark'):
            Session::put('mode', 'sg-light');
        else:
            Session::put('mode', 'sg-dark');
        endif;

        return response()->json('success');
    }
}
