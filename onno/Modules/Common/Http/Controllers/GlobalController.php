<?php

namespace Modules\Common\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Validator;
use Sentinel;
use DB;
use Modules\User\Entities\Permission;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Modules\Appearance\Entities\Menu;
use Modules\Appearance\Entities\MenuItem;
use Modules\Page\Entities\Page;
use Modules\Widget\Entities\Widget;
use Modules\Social\Entities\SocialMedia;

class GlobalController extends Controller
{
    public function switchLanguage($code)
    {
        $lang   =  $code;
        App::setLocale($lang);
        Session::put('locale', $lang);
        LaravelLocalization::setLocale($lang);
        $url    = \LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());

        return Redirect::to($url);
    }

    public function postDelete(Request $request)
    {
        $tablename      = $request->table_name;
        $id             = $request->row_id;
        if ($tablename == 'users') :
            $query = User::find($id);

            if ($query->count() > 0) :
                $query->delete();
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;

        elseif ($tablename == 'roles'):
            if ($id > 0 && $id < 5) :
                $data['status']     = "error";
                $data['message']    = __('you_can_not_delete_this');
            else :
                $role               = Role::find($id);
                $roleForAttach      = Role::find(3);

                $users              = Role::find($id)->withUsers()->get();

                if ($users->count() > 0) :
                    foreach ($users as $user) :
                        $oldRole    = DB::table('role_users')->where('user_id', '=', $user->id);
                        //need to detect first
                        if (!empty($oldRole)) :
                            $oldRole->delete();
                        endif;
                        $roleForAttach->users()->attach($user);
                    endforeach;
                endif;

                $role->delete();
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            endif;

        elseif ($tablename == 'widgets'):
            $widget                 = Widget::findOrFail($id);
            if ($widget->is_custom == 0) :
                $data['status']     = "error";
                $data['message']    = __('you_can_not_delete_this');
            else :
                $widget->delete();
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            endif;


        elseif ($tablename == 'pages'):
            $query = Page::find($id);
            if ($query->count() > 0) :
                $query->delete();
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;


        elseif ($tablename == 'menu'):
            $query                  = MenuItem::where('menu_id', $id)->get();
            if ($query->count() > 0) :
                $query->each->delete();
                $data['url']        = route('menu-item');
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;

        elseif ($tablename == 'social_media'):
            $query = SocialMedia::find($id);
            if ($query->count() > 0) :
                $query->delete();
                $data['url']        = route('socials');
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;

        elseif ($tablename == 'menu_item'):
            $query                  = MenuItem::find($id);
            $query1                 = MenuItem::where('parent', $id);

            if ($query->count() > 0) :
                $query1->delete();
                $query->delete();
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;

        else:
            $query = DB::table($tablename)->where('id', $id);
            if ($query->count() > 0) :
                $query->delete();
                $data['status']     = "success";
                $data['message']    = __('successfully_deleted');
            else :
                $data['status']     = "error";
                $data['message']    = __('not_found');
            endif;

        endif;

        echo json_encode($data);
    }

    public function editInfo($page_name, $param1 = null)
    {
        $otherLinks         = null;

        if ($param1) :
            $otherLinks     = explode('/', $param1);
        endif;

        $page_name          = $page_name;

        return view("common::modal.$page_name", [
            'param'         => $otherLinks
        ]);
    }

    public function selectImage($media_id, $tableName, $model_id)
    {
        // $user=User::find($model_id);

        $user = DB::table($tableName)->where('id', $model_id)->update(['avatar_id' => $media_id]);

        return redirect()->back();
    }
}
