<?php

namespace Modules\Appearance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Appearance\Entities\Theme;
use Modules\Appearance\Entities\ThemeSection;
use Validator;
use Modules\Appearance\Enums\ThemeVisivilityStatus;

class ThemeController extends Controller
{
    public function themes()
    {
        $themes=Theme::where('status', 1)->get();

        return view('appearance::themes',[
            'themes'    => $themes
        ]);
    }

    public function updateCurrentTheme(Request $request)
    {
        $themes=Theme::all();
        foreach ($themes as $theme) :
            if($theme->id != $request->block_style):
                $theme->currtent=0;
                $theme->save();
            else:
                $theme->currtent=1;
                $theme->save();
            endif;
        endforeach;

        return redirect()->back();

    }

    public function updatePrimarySection(Request $request)
    {

        // Validator::make($request->all(), [
        //     'primary_section_style' => 'required'
        // ])->validate();

        $theme = Theme::where('status', 1)->first();

        $data = [
            'theme_id'      => $theme->id,
            'label'         => 'Primary Section',
            'order'         => 1,
            'post_amount'   => 10,
            'section_style' => $request->get('primary_section_style', 'style_1'),
            'is_primary'    => 1,
            'status'        => 1
        ];

        ThemeSection::updateOrCreate([
            'theme_id'      => $theme->id,
            'is_primary'    => 1,
        ], $data);

        return redirect()->back()->with('success', __('successfully_updated'));
    }

    public function themeOption()
    {
        $activeTheme = Theme::where('status', 1)->first();

        return view('appearance::theme_option', compact('activeTheme'));
    }

    public function updateThemeOption(Request $request)
    {
        Validator::make($request->all(), [
            'header_style' => 'required',
            'footer_style' => 'required'
        ])->validate();

        $inputs             = $request->except(['_token']);

        $theme              = Theme::where('status', ThemeVisivilityStatus::ACTIVE)->where('name', 'theme_one')->first();

        $theme->options     = $inputs;
        $theme->save();

        return redirect()->back()->with('success', __('successfully_updated'));
    }
}
