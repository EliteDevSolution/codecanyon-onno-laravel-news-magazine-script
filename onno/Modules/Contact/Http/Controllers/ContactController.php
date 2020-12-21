<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contact\Entities\ContactMessage;
use Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contactMessages=ContactMessage::paginate(20);

        return view('contact::index',compact('contactMessages'));
    }

    public function show($id)
    {
        $contactMessage=ContactMessage::findOrFail($id);

        return view('contact::show',compact('contactMessage'));
    }

    public function replayMail(Request $request,$id){
        Validator::make($request->all(), [
            'message'   => 'required',
            'subject'   => 'required|min:2',
        ])->validate();

        try{

            $message=ContactMessage::findOrFail($id);
            sendMailTo($message->email,$request);

            return \redirect()->back()->with('success',__('successfully_send'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

}
