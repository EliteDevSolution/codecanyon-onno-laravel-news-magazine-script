<?php

namespace Modules\Widget\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Tag\Entities\Tag;
use Modules\Widget\Entities\Widget;
use Modules\Widget\Enums\WidgetLocation;
use Modules\Widget\Enums\WidgetContentType;
use Modules\Language\Entities\Language;
use Validator;
use Modules\Ads\Entities\Ad;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function widgets()
    {
        $widgets    = Widget::orderBy('id', 'desc')->paginate(15);

        return view('widget::widgets', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $ads            = Ad::orderBy('id', 'desc')->get();

        $tags           = Tag::orderby('id')->get();

        return view('widget::create', compact('activeLang', 'ads','tags'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title'     => 'required',
        ])->validate();


        $widget             = new Widget();

        $widget->title      = $request->title;
        $widget->language   = $request->language;

        $widget->location   = $request->location;

        if ($request->location == WidgetLocation::RIGHT_SIDEBAR) :

            $widget->content_type   = $request->content_type;

        elseif ($request->location  == WidgetLocation::HEADER) :

            $widget->content_type   = $request->content_type_header;

        else :

            $widget->content_type   = $request->content_type_footer;

         endif;

        if ($widget->content_type   == WidgetContentType::AD) :
            $widget->ad_id          = $request->ad;
        endif;

        if ($widget->content_type   == WidgetContentType::TAGS) :
            Validator::make($request->all(), [
                'tags'          => 'required',
            ])->validate();
            $widget->content    = $request->tags;
        else:
            $widget->content        = $request->content;
        endif;

        $widget->order          = $request->order;
        $widget->status         = $request->status;

        $widget->save();

        return redirect()->back()->with('success', __('successfully_added'));
    }

//    public function tagsAdd(Request $request){
////        dd($request->tag);
//
//        Validator::make($request->all(), [
//            'tag'     => 'required',
//        ])->validate();
//
//        if ($request->tag != null) :
//            $tag = new Tag();
//            $tag->title     = $request->tag;
//
////          $tag->slug      = \Str::slug($request->get('tag'), '-');
//
//            $tag->save();
//            return redirect()->back()->with('success', __('successfully_added'));
//        endif;
//    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $widget         = Widget::findOrFail($id);

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $ads            = Ad::orderBy('id', 'desc')->get();

        $tags           = Tag::orderBy('id')->get();

        return view('widget::edit', compact('widget', 'activeLang', 'ads','tags'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'title'     => 'required',
        ])->validate();

        $widget             = Widget::findOrFail($id);
        $widget->title      = $request->title;
        $widget->language   = $request->language;
        $widget->location   = $request->location;

        if ($request->location == WidgetLocation::RIGHT_SIDEBAR) :
            $widget->content_type   = $request->content_type;
        elseif ($request->location  == WidgetLocation::HEADER) :
            $widget->content_type   = $request->content_type_header;
        else :
            $widget->content_type   = $request->content_type_footer;
        endif;

        if ($widget->content_type   == WidgetContentType::AD) :
            $widget->ad_id          = $request->ad;
        else :
            $widget->ad_id          = NULL;
        endif;

        if ($widget->content_type   == WidgetContentType::TAGS) :
            Validator::make($request->all(), [
                'tags'          => 'required',
            ])->validate();
            $widget->content    = $request->tags;
        else:
            $widget->content        = $request->content;
        endif;

        $widget->order              = $request->order;
        $widget->status             = $request->status;

        $widget->save();

        return redirect()->route('widgets')->with('success', __('successfully_added'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
