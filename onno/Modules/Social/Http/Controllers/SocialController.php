<?php

namespace Modules\Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Poll;
use Modules\Social\Entities\SocialMedia;
use Paginate;
use Validator;
use DB;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('social::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('social::social_create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name'  => 'required|min:2',
            'url'   => 'required|min:2',
            'icon'  => 'required',
        ])->validate();

        DB::beginTransaction();

        try {

            $social                 = new SocialMedia();

            $social->name           = $request->name;
            $social->url            = $request->url;
            $social->icon           = $request->icon;
            $social->icon_bg_color  = $request->icon_bg_color;
            $social->text_bg_color  = $request->text_bg_color;
            $social->status         = $request->status;

            $social->save();


            DB::commit();
            return redirect()->back()->with('success', __('successfully_added'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('social::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $socialMedia = SocialMedia::find($id);
        return view('social::social_edit', compact('socialMedia'));
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
            'name'      => 'required|min:2',
            'url'       => 'required|min:2',
            'icon'      => 'required',
        ])->validate();

        DB::beginTransaction();
        try {

            $social                 = SocialMedia::find($id);

            $social->name           = $request->name;
            $social->url            = $request->url;
            $social->icon           = $request->icon;
            $social->icon_bg_color  = $request->icon_bg_color;
            $social->text_bg_color  = $request->text_bg_color;
            $social->status         = $request->status;

            $social->save();


            DB::commit();

            return redirect('social/socials')->with('success', __('successfully_updated'));

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
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

    public function socials()
    {
        $socialMedias   = SocialMedia::orderBy('id', 'desc')->paginate(15);

        return view('social::socials', compact('socialMedias'));
    }
}
