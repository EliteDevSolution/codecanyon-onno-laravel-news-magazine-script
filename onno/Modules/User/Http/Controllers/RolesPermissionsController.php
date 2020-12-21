<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Validator;
use Sentinel;
use DB;
use Activation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Setting\Entities\EmailTemplate;
use Modules\User\Entities\Permission;

class RolesPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles      = Role::all();

        foreach ($roles as $role) :
            $object = $role->permissions;

            if (!empty($object)) :
                foreach ($object as $key => $value) :
                    $permissionss[$role->slug][] = $key;
                endforeach;
            endif;
        endforeach;

        return view('user::roles', compact('roles', 'permissionss'));
    }

    //edit role and permissions
    public function editRole($id)
    {
        $role           = Sentinel::findRoleById($id);
        $allPermission  = Permission::select('name')->groupBy('name')->orderBy('name', 'ASC')->get();

        $permissions    = $role->permissions;
        if ($permissions == null) :
            $permissions = array();
        endif;

        return view('user::edit-role', compact('role', 'allPermission', 'permissions'));
    }

    //update permission
    public function postEditRole(Request $request, $id)
    {
        $role           = Sentinel::findRoleById($id);
        $role->name     = $request->role_name;
        $req_data       = $request->all();
        $permissions    = array_slice($req_data, 2);

        foreach ($permissions as $key => $value) :
            if ($value == "on") :
                $permissions[$key] = true;
            endif;
        endforeach;

        $role->permissions = $permissions;
        $role->save();

        return redirect()->route('roles')->with('success', __('successfully_updated'));
    }

    //update permissions by module
    public function permissions()
    {
        $roles = Role::withoutSuperadmin()->get();
        $permissions = Permission::select('name')->groupBy('name')->paginate(10);
        $noOfRole = $roles->count();

        return view('user::permissions', compact('permissions', 'roles', 'noOfRole'));
    }

    //change permission by module
    public function changeRolePermissionByModule(Request $request)
    {
        $role = Sentinel::findRoleById($request->role_id);
        $permissions = $role->permissions;
        if (!empty($permissions)) :
            if (array_key_exists($request->permission_name, $permissions)) :
                foreach ($permissions as $key => $value) :
                    if ($key == $request->permission_name) :
                        unset($permissions[$key]);
                    endif;
                endforeach;
            else :
                $permissions[$request->permission_name] = true;
            endif;
        else :
            $permissions[$request->permission_name]     = true;
        endif;

        $role->permissions  = $permissions;

        $role->save();

        $data['status']     = "success";
        $data['message']    = __('successfully_updated');

        echo json_encode($data);
    }

    //add new role
    public function addRole()
    {
        $allPermission = Permission::select('name')->groupBy('name')->orderBy('name', 'ASC')->get();
        // $allPermission=Permission::allPermission();
        return view('user::add-role', compact('allPermission'));
    }

    public function postAddRole(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:2|max:30',
            'slug' => 'required|unique:roles|min:2|max:30|regex:/^\S*$/u',
        ])->validate();

        $role           = new Role();

        $role->name     = $request->name;
        $role->slug     = $request->slug;

        $req_data       = $request->all();
        $permissions    = array_slice($req_data, 3);

        foreach ($permissions as $key => $value) :
            if ($value == "on") :
                $permissions[$key]  = true;
            endif;
        endforeach;

        if (!empty($permissions)):
            $role->permissions      = $permissions;
        endif;

        $role->save();

        return redirect()->route('roles')->with('success', __('new_role_successfully_created'));
    }

    //change user role
    public function changeRole(Request $request, $user_id, $role_id)
    {
        $user       = Sentinel::findUserById($user_id);
        $slug       = $request->slug;
        $role       = Sentinel::findRoleBySlug($slug);

        $oldRole    = DB::table('role_users')->where([['user_id', '=', $user_id], ['role_id', '=', $role_id]]);

        //need to detach from role first
        if (!empty($oldRole)):
            $oldRole->delete();
        endif;

        //attach new role
        $role->users()->attach($user);

        return redirect()->back()->with('success', __('successfully_update_role'));
    }

    public function banUser($user_id)
    {
        User::where('id', $user_id)
          ->update(['is_user_banned' => 0]);

        return redirect()->back()->with('success', __('ban_this_user'));
    }

    public function unBanUser($user_id)
    {
        User::where('id', $user_id)
          ->update(['is_user_banned' => 1]);

        //send a mail with activation code to user
        /*sendMail($user, $activation->code, 'active_account');*/

        return redirect()->back()->with('success', __('successfully_updated'));
    }

    public function permissionsManagement()
    {
        $permissions    = Permission::orderBy('id', 'asc')->paginate(15);

        return view('user::permission-management', compact('permissions'));
    }

    //update permission
    public function updatePermission(Request $request, $id)
    {
        $permission     = Permission::find($id);

        Validator::make($request->all(), [
            'name'      => 'required|min:2|max:30',
            'slug'      => 'required|min:2|max:30|regex:/^\S*$/u',
        ])->validate();

        $permission->update($request->all());

        return redirect()->back()->with('success', __('permission_successfully_updated'));
    }
}
