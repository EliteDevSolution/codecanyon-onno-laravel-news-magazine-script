<?php

namespace Modules\Newsletter\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Newsletter\Enums\SendEmailType;
use Modules\Newsletter\Enums\BulkEmailType;
use Modules\Newsletter\Mail\Newsletter;
use Modules\Post\Entities\Post;
use Validator;
use DB;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;
use LaravelLocalization;

class NewsletterController extends Controller
{
    public function sendEmailToSubscriber()
    {
        return view('newsletter::send_email');
    }

    public function saveToCron(Request $request)
    {

        try {

            $posts              = [];
            $contentType        = $request->get('content_type');
            $bulk_email_type    = '';
            $base_url           = url('/');


            if ($contentType == SendEmailType::MULTIPLE) :
                $bulk_email_type = $request->bulk_email_type;

                if ($request->bulk_email_type == BulkEmailType::POPULAR_POST) :

                    $posts  = Post::with(['image', 'user'])->orderBy('total_hit')
                                ->take(11)
                                ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                ->get();

                elseif ($request->bulk_email_type == BulkEmailType::LATEST_POST) :

                    $posts  = Post::with(['image', 'user'])->orderBy('id', 'desc')
                                ->take(11)
                                ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                ->get();

                else :

                    $posts  = Post::with(['image', 'user'])
                                ->where('recommended', 1)
                                ->orderBy('recommended_order')
                                ->take(11)
                                ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                ->get();
                endif;

            endif;

            if ($contentType == SendEmailType::SINGLE) :
                $posts          = Post::where('id', $request->get('single_content_type'))->get();
            endif;

            $customMessage      = '';

            if ($contentType == SendEmailType::CUSTOM) :
                $customMessage = $request->get('custom_message');
            endif;

            User::where('newsletter_enable', 1)->chunk(100, function ($users) use ($posts, $customMessage, $contentType, $bulk_email_type, $base_url) {
                foreach ($users as $user) :

                    Mail::to($user->email)->queue(new Newsletter($posts, $customMessage, $contentType, $bulk_email_type, $base_url, $user->id));

                endforeach;
            });

            // $users = User::where('newsletter_enable', 1)->get();
            //     foreach ($users as $user) {

            //         return view('email.newsletter', [
            //                 'posts'           => $posts,
            //                 'customMessage'   => $customMessage,
            //                 'contentType'     => $contentType,
            //                 'bulk_email_type' => $bulk_email_type,
            //                 'base_url'        => $base_url,
            //                 'user'            => $user,
            //             ]);
            //     }

            return redirect()->back()->with('success', __('successfully_send'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

    public function subscriberList()
    {
        $users  = User::where('newsletter_enable', 1)->paginate(10);

        return view('newsletter::subscribers', compact('users'));
    }

    public function sendMalToSelected(Request $request, $id)
    {
        try{

            Validator::make($request->all(), [
                'message'   => 'required',
                'subject'   => 'required|min:2',
            ])->validate();

            $user           = User::find($id);


            sendMailTo($user->email, $request);

            return \redirect()->back()->with('success', __('successfully_send'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

    public function searchPost(Request $request)
    {
        $post       = Post::select('id', 'title as text');

        if ($search = $request->get('search')) :
            $post->where('title', 'like', '%' . $search . '%');
        endif;

        $posts      = $post->take(10)->get()->toArray();

        return response()->json($posts);
    }

    public function subscribe(Request $request)
    {
        $user       = User::where('email', $request->get('email'))->first();

        if (!blank($user)) :
            $user->newsletter_enable = 1;
            $user->save();
        else :
            $data = [
                'email'             => $request->get('email'),
                'password'          => 123456,
                'newsletter_enable' => 1,
            ];

            $user   = Sentinel::register($data);
            //$user   = Sentinel::registerAndActivate($data);
            $role   = Sentinel::findRoleBySlug('subscriber');

            $role->users()->attach($user);
        endif;

        //TODO: Send subscription confirmation email
//        sendMail($user, 'subscription_confirmation');
        return redirect()->route('home')->with('success', __('successfully_added'));
    }

    public function unsubscribe($id)
    {
        $user = User::where('id', $id)->first();
        if ($user != "") {
            $user->newsletter_enable = 0;
            $user->save();

            return redirect()->route('home')->with('success', __('successfully_unsubscribed'));
        }

        return redirect()->route('home');
    }

    public function banSubscribe($user_id)
    {
        User::where('id', $user_id)
          ->update(['is_subscribe_banned' => 0]);

        return redirect()->back()->with('success', __('successfully_updated'));
    }

    public function unBanSubscribe($user_id)
    {
        User::where('id', $user_id)
          ->update(['is_subscribe_banned' => 1]);

        //send a mail with activation code to user
        /*sendMail($user, $activation->code, 'active_account');*/

        return redirect()->back()->with('success', __('successfully_updated'));
    }


}
