<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Sentinel;
use Activation;
use Illuminate\Support\Facades\Mail;
use Modules\Setting\Entities\EmailTemplate;
// use Mail;
use Modules\User\Entities\User;
use Validator;

class RegistrationController extends Controller
{

    public function index()
    {
        return view('user::registration');
    }

    public function postReg(Request $request)
    {
        Validator::make($request->all(), [
            'first_name'            => 'required',
            'email'                 => 'required|unique:users|max:255',
            'last_name'             => 'required|min:2|max:30',
            'password'              => 'confirmed|required|min:5|max:30',
            'password_confirmation' => 'required|min:5|max:30'
        ])->validate();

        $user       = Sentinel::register($request->all());
        // $user= Sentinel::registerAndActivate($request->all());
        $activation = Activation::create($user);

        $role       = Sentinel::findRoleBySlug('user');

        $role->users()->attach($user);
        //send activation code to user
        sendMail($user, $activation->code, 'activate_account', $request->password);

        return \redirect()->route('login')->with('success', __('check_your_mail_for_active'));
    }

    public function activation($email, $activationCode)
    {
        $user       = User::whereEmail($email)->first();

        if (Activation::complete($user, $activationCode)) :

            sendMail($user, '', 'registration', '');

            return redirect()->route('login');
        endif;
    }
}
