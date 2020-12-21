<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Activation;
use Sentinel;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Traits\ApiReturnFormat;

class UserController extends Controller
{
    use ApiReturnFormat;
  
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login','authenticate']]);
    }

    public function authenticate(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'email' => 'required|max:255',
                'password' => 'required|min:5|max:30',
            ]);
            
           if($validator->fails()){
               return $this->responseWithError('Invalid Credentials', $validator->errors(), 422);
                // return response()->json($validator->errors(), 422);
            }

            $credentials = $request->only('email', 'password');
            
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return $this->responseWithError('Invalid Credentials');
                }
            } catch (JWTException $e) {
                return $this->responseWithError('could_not_create_token');
            
            } catch (ThrottlingException $e) {
                return $this->responseWithError("Suspicious activity has occured on your IP address and you have been denied access for another ". $e->getDelay() ." second(s)",[], 500);

            } catch (NotActivatedException $e) {
                return $this->responseWithError('You account is not active yet. Please check your mail');
            
            } catch (Exception $e) {
                return $this->responseWithError('Something want wrong',[], 500);
            }

            return $this->responseWithSuccess('Successfully Login',$token);
    }

    public function register(Request $request)
    {
        // return $request;
        // return Config::get('app.locale');
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required|min:2|max:30',
                'email' => 'required|unique:users|max:255',
                // 'user_role' => 'required|min:2|max:30',
                'password' => 'confirmed|required|min:5|max:30',
                'password_confirmation' => 'required|min:5|max:30'
            ]);

            if($validator->fails()){
                // return $validator->getMessageBag()->all();
                
                return $this->responseWithError('Invalid Credentials', $validator->errors(), 422);
            }
            $request['user_role']='admin';

            $user = Sentinel::register($request->all());
            $role = Sentinel::findRoleBySlug($request->user_role);
            $role->users()->attach($user);
            $activation = Activation::create($user);
            sendMail($user, $activation->code, 'active_account');

            return $this->responseWithSuccess( __('check_user_mail_for_active_this_account'),$user);

    }

    public function getAuthenticatedUser()
    {
                try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['user_not_found'], 404);
                    }

                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
                }
                return $this->responseWithSuccess('Success',$user);
    }

    public function logout()
    {  
            try {
                Sentinel::logout();
                JWTAuth::invalidate(JWTAuth::getToken());
                return $this->responseWithSuccess('Logout Successfully');
            } catch (JWTException $e) {
                JWTAuth::unsetToken();
                // something went wrong tries to validate a invalid token
                return $this->responseWithError(__('Error','Failed to logout, please try again.'));
                // return response()->json(['message' => 'Failed to logout, please try again.']);
            }
    }

    public function updateUserInfo(Request $request, $id)
    {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required|min:2|max:30'
            ]);

            if($validator->fails()){
                return $this->responseWithError('Invalid Credentials', $validator->errors(), 422);
            }

            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->image_id = $request->image_id;
            $user->newsletter_enable = $request->newsletter_enable;
            $user->save();

            return $this->responseWithSuccess(__('successfully_updated'),$user);

    }

    public function changePassword(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|min:2|max:30'
            ]);

            if($validator->fails()){
                return $this->responseWithError('Invalid Credentials', $validator->errors(), 422);
            }

            $hasher = Sentinel::getHasher();

            $oldPassword = $request->old_password;
            $password = $request->password;
            $passwordConf = $request->password_confirmation;

            $user = Sentinel::getUser();

            if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
                
                // return $this->responseWithError(__('please_check_again'),$user);
                return $this->responseWithError(__('please_check_again'), $user, 422);
            }

            Sentinel::update($user, array('password' => $password));

            return $this->responseWithSuccess(__('successfully_updated'),$user);
        }




    public function test(Request $request){
        return Config::get('app.locale');
    }

}
