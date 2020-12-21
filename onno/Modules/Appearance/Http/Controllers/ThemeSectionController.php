<?php

namespace Modules\Appearance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Post\Entities\Category;
use Modules\Ads\Entities\Ad;
use Modules\Appearance\Entities\Theme;
use Validator;

class ThemeSectionController extends Controller
{
    public function sections(){
        $sections                   =ThemeSection::with('ad')->orderBy('order',"ASC")->where('is_primary','<>',1)->where(function($query) {
                                                        $query->where('language', \LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                                                    })->paginate(10);

        $categories                 =Category::orderBy('id','ASC')->where('language', \LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();
        $primarySection             =ThemeSection::where('is_primary',1)->first();

        $ads                        = Ad::orderBy('id','desc')->get();

        return view('appearance::theme_section',[
            'sections'      =>$sections,
            'primarySection'=> $primarySection,
            'categories'    =>$categories,
            'ads'           =>$ads,
            ]);
    }

    public function saveNewSection(Request $request){

        if($request->type == \Modules\Appearance\Enums\ThemeSectionType::CATEGORY):

        Validator::make($request->all(), [
            'category_id'   => 'required',
            'order'         => 'required',
            'section_style' => 'required',
            'status'        => 'required'
        ])->validate();

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::VIDEO):

        Validator::make($request->all(), [
            'order'         => 'required',
            'section_style' => 'required',
            'status'        => 'required'
        ])->validate();

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::LATEST_POST):

        Validator::make($request->all(), [
            'order'         => 'required',
            'status'        => 'required'
        ])->validate();

        endif;

        $section                = new ThemeSection();
        $section->theme_id      = 1;
        $section->type          = $request->type;

        if($request->type == \Modules\Appearance\Enums\ThemeSectionType::CATEGORY):

        $category               = Category::findOrFail($request->category_id);

        $section->label         = $category->category_name;
        $section->category_id   = $request->category_id;
        $section->section_style = $request->section_style;
        $section->language      = \LaravelLocalization::setLocale() ?? settingHelper('default_language');

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::VIDEO):

        $section->section_style = $request->section_style;  
        $section->label         = 'videos'; 

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::LATEST_POST):

        $section->label         = 'latest_post';

        endif;


        $section->order         = $request->order;
        
        $section->status        = $request->status;
        if($request->ad != ""){
             $section->ad_id         = $request->ad;
        }
       

        $section->save();

        return redirect()->back()->with('success',__('successfully_added'));
    }

    public function editThemeSection($id){
        $section            = ThemeSection::findOrFail($id);
        $categories         = Category::orderBy('id','ASC')->where('language', \LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();
        $ads                = Ad::orderBy('id','desc')->get();

        return view('appearance::edit_theme_section',['section'=>$section,'categories'=>$categories, 'ads'=>$ads]);

    }

    public function updateThemeSection(Request $request){

        if($request->type == \Modules\Appearance\Enums\ThemeSectionType::CATEGORY):

        Validator::make($request->all(), [
            'category_id'   => 'required',
            'order'         => 'required',
            'section_style' => 'required',
            'status'        => 'required'
        ])->validate();

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::VIDEO):

        Validator::make($request->all(), [
            'order'         => 'required',
            'section_style' => 'required',
            'status'        => 'required'
        ])->validate();

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::LATEST_POST):

        Validator::make($request->all(), [
            'order'         => 'required',
            'status'        => 'required'
        ])->validate();

        endif;


        $section                =   ThemeSection::findOrFail($request->theme_section_id);

        $section->type          = $request->type;

        if($request->type == \Modules\Appearance\Enums\ThemeSectionType::CATEGORY):

        $category               = Category::findOrFail($request->category_id);

        $section->label         = $category->category_name;
        $section->category_id   = $request->category_id;
        $section->section_style = $request->section_style;

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::VIDEO):

        $section->section_style = $request->section_style;  
        $section->label         = 'videos'; 

        elseif($request->type == \Modules\Appearance\Enums\ThemeSectionType::LATEST_POST):

        $section->label         = 'latest_post';

        endif;


        $section->order         = $request->order;
        $section->status        = $request->status;
        $section->status        = $request->status;
        if($request->ad != ""){
             $section->ad_id    = $request->ad;
        }

        $section->save();

        return redirect()->route('sections')->with('success',__('successfully_updated'));
    }

    public function updateSectionOrder(Request $request)
    {

        foreach($request->sections as $section){

            $theme_section = ThemeSection::find($section);
            $theme_section->order = $request->orders[$section];
            $theme_section->update();

        }

        return redirect()->route('sections')->with('success',__('successfully_updated'));


    }
}
