<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\WidgetService;
use Modules\User\Entities\User;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Activation;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Modules\Setting\Entities\EmailTemplate;
use Modules\User\Entities\Role;
use Reminder;
use Validator;

class UserController extends Controller
{
    public function showLoginForm()
    {
        $widgetService          = new WidgetService();
        $widgets                = $widgetService->getWidgetDetails();

        return view('site.auth.login', compact('widgets'));
    }

    public function login(Request $request)
    {
        if( settingHelper('captcha_visibility') == 1):
        $request->validate([
            'email'         => ['required', 'string', 'email', 'max:255'],
            'password'      => ['required', 'string'],
            'g-recaptcha-response'      => ['required', 'string'],
        ]);
        else:

            $request->validate([
                'email'         => ['required', 'string', 'email', 'max:255'],
                'password'      => ['required', 'string'],
            ]);

        endif;

        $user = User::where('email', $request->email)->first();

        if (blank($user)) {
            return redirect()->back()->with(['error' => __('your_email_is_invalid')]);
        } elseif($user->is_user_banned == 0) {
            return redirect()->back()->with(['error' => __('your_account_is_banned')]);
        }

        try {

            if (!Hash::check($request->get('password'), $user->password)) {
                return redirect()->back()->with(['error' => 'Invalid Credentials !']);
            }

            Sentinel::authenticate($request->all());

            return redirect()->route('home');

        } catch (NotActivatedException $e) {

            return redirect()->back()->with(['error' => __('your_account_is_not_activated')]);
        }
    }

    public function showRegistrationForm()
    {
        return view('site.auth.register');
    }

    public function register(Request $request)
    {
        if( settingHelper('captcha_visibility') == 1):

            $request->validate([
                'first_name'    => ['required', 'string', 'max:255'],
                'last_name'     => ['required', 'string', 'max:255'],
                'email'         => ['required', 'string', 'email', 'max:255'],
                'password'      => ['required', 'string', 'min:6'],
                'g-recaptcha-response'      => ['required', 'string'],
            ]);

        else:
            $request->validate([
                'first_name'    => ['required', 'string', 'max:255'],
                'last_name'     => ['required', 'string', 'max:255'],
                'email'         => ['required', 'string', 'email', 'max:255'],
                'password'      => ['required', 'string', 'min:6'],
            ]);

        endif;


        try {

            $user = User::where('email', $request->email)->first();

            if(!blank($user)){
                if($user->withActivation == ""){

                    $user->password             = bcrypt($request->password);
                    $user->first_name           = $request->first_name;
                    $user->last_name            = $request->last_name;
                    $user->save();
     
                    $activation         = Activation::create($user);

                    sendMail($user, $activation->code, 'activate_account', $request->password);

                    return redirect()->route('site.login.form')->with('success', __('check_user_mail_for_active_this_account'));

                }else{
                    return redirect()->back()->with('error', __('the_email_has_already_been_taken'));
                }
            }

            $user               = Sentinel::register($request->all());
            $role               = Sentinel::findRoleBySlug('user');

            $role->users()->attach($user);

            $activation         = Activation::create($user);

            sendMail($user, $activation->code, 'activate_account', $request->password);

            return redirect()->route('site.login.form')->with('success', __('check_user_mail_for_active_this_account'));



        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }


    }

    public function logout()
    {
        Sentinel::logout();

        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('site.auth.forgot_password');
    }

    public function postForgotPassword(Request $request)
    {
        try {

            $user                   = User::whereEmail($request->email)->first();

            if(blank($user)){
                return redirect()->back()->with('error', __('your_email_is_invalid'));
            }

            if(Reminder::exists($user)):
                $remainder          = Reminder::where('user_id',$user->id)->first();
            else:
                $remainder          = Reminder::create($user);
            endif;
            //send a mail to user
            sendMail($user, $remainder->code, 'forgot_password', '');

            return redirect()->back()->with([
                'success'           => __('reset_code_is_send_to_mail'),
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

    public function resetPassword($email, $resetCode)
    {
        $user                   = User::byEmail($email);

        if ($reminder           = Reminder::exists($user, $resetCode)) :
            return view('site.auth.reset_password',['email'=>$email,'resetCode'=>$resetCode]);
        else :
            return redirect('login');
        endif;
    }

    public function PostResetPassword(Request $request, $email, $resetCode)
    {
        Validator::make($request->all(), [
            'password'              => 'confirmed|required|min:5|max:10',
            'password_confirmation' => 'required|min:5|max:10'
        ])->validate();

        try {

            $user = User::byEmail($email);

            if ($reminder = Reminder::exists($user, $resetCode)) :
                Reminder::complete($user, $resetCode, $request->password);
                sendMail($user, '', 'reset_password', $request->password);

                return redirect()->route('site.login.form')->with('success', __('you_can_login_with_new_password'));
            else :
                return redirect()->route('site.login.form');
            endif;

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

     public function activation($email, $activationCode)
    {
        $user       = User::whereEmail($email)->first();

        if (Activation::complete($user, $activationCode)) :

            sendMail($user, '', 'registration', '');

            return redirect()->route('site.login.form')->with('success', __('your_account_activation_successfully'));
        endif;

        return redirect('/');
    }
}
