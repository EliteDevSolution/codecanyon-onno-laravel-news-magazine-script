<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Validator;
use Activation;
use Sentinel;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles  = Role::allRole();
        return view('user::add-user', compact('roles'));
    }

    /**
     * user add
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'first_name'            => 'required',
            'email'                 => 'required|unique:users|max:255',
            'last_name'             => 'required|min:2|max:30',
            'user_role'             => 'required|min:2|max:30',
            'password'              => 'confirmed|required|min:5|max:30',
            'password_confirmation' => 'required|min:5|max:30'
        ])->validate();

        try {

            $user       = Sentinel::register($request->all());
            $role       = Sentinel::findRoleBySlug($request->user_role);
            $role->users()->attach($user);
            $activation = Activation::create($user);

            sendMail($user, $activation->code, 'activate_account', $request->password);

            return \redirect()->back()->with('success', __('check_user_mail_for_active_this_account'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    //view user list
    public function userList()
    {
        
        $roles      = Role::allRole();
        $users      = User::with(['withRoles', 'withActivation', 'image'])->paginate(10);

        return view('user::users', compact('users', 'roles'));
    }

    //update user info
    public function updateUserInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required|min:2|max:30'
        ])->validate();

        $user                       = User::find($id);

        $user->first_name           = $request->first_name;
        $user->last_name            = $request->last_name;
        if($request->image_id != ""){
            $user->image_id             = $request->image_id;
        }
        
        $user->newsletter_enable    = $request->newsletter_enable;

        $user->save();

        return redirect()->back()->with('success', __('successfully_updated'));
    }

    public function myProfile()
    {
        return view('user::user-profile');
    }

    public function changePasswordByMe(Request $request)
    {
        Validator::make($request->all(), [
            'old_password'  => 'required|different:password',
            'password'      => 'required|min:6|max:30',
            'password_confirmation'      => 'required|same:password|min:6|max:30'
        ])->validate();

        $hasher         = Sentinel::getHasher();

        $oldPassword    = $request->old_password;
        $password       = $request->password;

        $user           = Sentinel::getUser();

        if (!$hasher->check($oldPassword, $user->password)) {
            return redirect()->back()->with('error', __('please_check_again'));
        }

        Sentinel::update($user, array('password' => $password));

        return redirect()->back()->with('success', __('successfully_updated'));
    }
}
