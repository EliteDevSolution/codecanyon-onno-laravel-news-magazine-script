<?php

namespace Modules\Appearance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Appearance\Entities\Menu;
use Modules\Appearance\Entities\MenuLocation;
use Modules\Language\Entities\Language;
use Validator;

class MenuController extends Controller
{
    public function addMenu(Request $request){
        Validator::make($request->all(), [
            'title'     => 'required|min:2|max:30'
        ])->validate();

        $menu=new Menu();

        $menu->title    = $request->title;
        $menu->remark   = $request->remark;

        $menu->save();

        return redirect()->back()->with('success',__('successfully_added'));
    }

    public function updateMenu(Request $request){
        Validator::make($request->all(), [
            'title'     => 'required|min:2|max:30',
            'menu_id'   => 'required'
        ])->validate();

        $menu           = Menu::find($request->menu_id);

        $menu->title    = $request->title;
        $menu->remark   = $request->remark;

        $menu->save();

        return redirect()->back()->with('success', __('successfully_added'));
    }

    public function updateMenuLocation(Request $request){
        $total_item=count($request->menu_location_id);

        for($i=0;$i<$total_item;$i++):
            MenuLocation::where('id', $request->menu_location_id[$i])
                         ->update(array('menu_id' => $request->menu_id[$i]));
                        endfor;

        return redirect()->back()->with('success',__('successfully_updated'));
    }

}
