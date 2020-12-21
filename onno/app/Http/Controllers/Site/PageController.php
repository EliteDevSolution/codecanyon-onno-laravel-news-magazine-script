<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Social\Entities\SocialMedia;
use Modules\Page\Entities\Page;
use Validator;
use Modules\Contact\Entities\ContactMessage;

class PageController extends Controller
{
    public function page( $id )
    {
        try{
            $page               = Page::where('slug', $id)->first();
            $socialMedias       = SocialMedia::where('status', 1)->get();

            if($page->page_type == 1):
                return view('site.pages.default_page', compact('page'));
            else:
                return view('site.pages.contact_us', compact('page', 'socialMedias'));
            endif;
        }
        catch (\Exception $e){
            return view('site.pages.404');
        }
    }

    public function sendMessage( Request $request )
    {
        if( settingHelper('captcha_visibility') == 1):
        	$validator                  = Validator::make($request->all(), [
                'name'                  => 'required',
                'email'                 => 'required',
                'message'               => 'required',
                'g-recaptcha-response'  => 'required'
            ]);
        else:
            $validator                  = Validator::make($request->all(), [
                'name'                  => 'required',
                'email'                 => 'required',
                'message'               => 'required'
            ]);
        endif;

        if ($validator->fails()) :
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        endif;

    	 $message                       = new ContactMessage();

    	 $message->name                 = $request->name;
    	 $message->email                = $request->email;
    	 $message->message              = $request->message;

    	 $message->save();

    	 return redirect()->back()->with('success', __('successfully_send'));
    }
}
