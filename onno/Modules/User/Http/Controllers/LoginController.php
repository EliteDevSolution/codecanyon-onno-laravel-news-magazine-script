<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Sentinel;
use Validator;

class LoginController extends Controller
{

    public function index()
    {
        return view('user::login');
    }

    public function postLogin(Request $request)
    {
        Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|min:6|max:30',
        ])->validate();

        try {
            $rememberMe     = false;
            if (isset($request->remamber_me)):
                $rememberMe = true;
            endif;
            if (Sentinel::authenticate($request->all(), $rememberMe)):
                return redirect()->route('dashboard');
            else:
                return redirect()->back()->with(['error' => __('email_password_mismatch')]);
            endif;
        } catch (ThrottlingException $e) {
            $delay  = $e->getDelay();
            return redirect()->back()->with(['error' => __('you_are_banned')]);
        } catch (NotActivatedException $e) {
            return redirect()->back()->with(['error' => __('your_account_is_not_activated')]);
        }
    }

    public function logout()
    {
        Sentinel::logout();
        return redirect()->route('login');
    }
}
