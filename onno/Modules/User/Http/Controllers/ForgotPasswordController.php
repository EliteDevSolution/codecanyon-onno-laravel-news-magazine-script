<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Sentinel;
use Validator;
use Mail;
use Modules\Setting\Entities\EmailTemplate;
use Modules\User\Entities\User;
use Reminder;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('user::auth.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        $user       = User::whereEmail($request->email)->first();

        if (Reminder::exists($user)) :
            $remainder = Reminder::where('user_id', $user->id)->first();
        else :
            $remainder = Reminder::create($user);
        endif;
        //send a mail to user
        sendMail($user, $remainder->code, 'forgot_password', '');

        return redirect()->back()->with([
            'success' => __('reset_code_is_send_to_mail'),
        ]);
    }

    public function resetPassword($email, $resetCode)
    {
        $user       = User::byEmail($email);

        if ($reminder = Reminder::exists($user, $resetCode)) :
            return view('user::auth.reset-password', ['email' => $email, 'resetCode' => $resetCode]);
        else :
            return redirect()->route('login');
        endif;
    }

    public function PostResetPassword(Request $request, $email, $resetCode)
    {
        Validator::make($request->all(), [
            'password'              => 'confirmed|required|min:5|max:10',
            'password_confirmation' => 'required|min:5|max:10'
        ])->validate();

        $user       = User::byEmail($email);

        if ($reminder = Reminder::exists($user, $resetCode)) {

            Reminder::complete($user, $resetCode, $request->password);

            sendMail($user, '', 'reset_password', $request->password);

            return redirect()->route('login')->with('success', __('you_can_login_with_new_password'));
        } else {
            return redirect()->route('login');
        }

    }
}
