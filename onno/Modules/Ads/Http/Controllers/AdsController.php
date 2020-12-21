<?php

namespace Modules\Ads\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ads\Entities\Ad;
use Modules\Ads\Entities\AdLocation;
use Validator;
use Sentinel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception as S3;
use Modules\Gallery\Entities\Image as galleryImage;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $ads=Ad::with('adImage')->paginate(10);
        return view('ads::index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $countImage     = galleryImage::count();
        return view('ads::ads_create', compact('countImage'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'ad_name'   => 'required|min:2|max:100',
            'ad_type'   => 'required',
            'ad_size'   => 'required'
        ])->validate();

        $ad             = new Ad();
        $ad->ad_name    = $request->ad_name;
        $ad->ad_size    = $request->ad_size;
        $ad->ad_type    = $request->ad_type;
        $ad->ad_url     = $request->ad_url;

        if($request-> ad_type  == 'code'):
            Validator::make($request->all(), ['ad_code' => 'required' ])->validate();
            $ad->ad_code=base64_encode($request->ad_code);
        elseif($request->ad_type   == 'image'):
             Validator::make($request->all(), ['ad_image_id' => 'required' ])->validate();
            $ad->ad_image_id=$request->ad_image_id;
        elseif($request->ad_type   == 'text'):
            Validator::make($request->all(), ['ad_text' => 'required' ])->validate();
            $ad->ad_text=e($request->ad_text);
        endif;

        $ad->save();

        return redirect()->back()->with('success',__('successfully_added'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $ad     = Ad::where('id',$id)->with('adImage')->first();
        $countImage     = galleryImage::count();
        return view('ads::ads_edit',compact('ad', 'countImage'));
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
            'ad_name' => 'required|min:2|max:100',
            'ad_type' => 'required',
            'ad_size' => 'required'
        ])->validate();

        $ad             = Ad::find($id);
        $ad->ad_name    = $request->ad_name;
        $ad->ad_size    = $request->ad_size;
        $ad->ad_type    = $request->ad_type;
        $ad->ad_url     = $request->ad_url;

        if($request->ad_type=='code'):
            Validator::make($request->all(), ['ad_code' => 'required' ])->validate();
            $ad->ad_code=base64_encode($request->ad_code);
        elseif($request->ad_type=='image'):
            Validator::make($request->all(), ['ad_image_id' => 'required' ])->validate();
            $ad->ad_image_id=$request->ad_image_id;
        elseif($request->ad_type=='text'):
            Validator::make($request->all(), ['ad_text' => 'required' ])->validate();
            $ad->ad_text=e($request->ad_text);
        endif;

        $ad->save();

        return redirect()->back()->with('success',__('successfully_updated'));
    }

    public function assignAds(){

        $adLocations=AdLocation::with('ad')->get();
        // return $adLocations;
        $ads=Ad::with('adImage')->get();
        return view('ads::ad_location',compact('adLocations','ads'));
    }

    public function updateLocation(Request $request){
        // return $request;
        $total_item     = count($request->ad_location_id);
        for($i=0;$i<$total_item;$i++){
            AdLocation::where('id', $request->ad_location_id[$i])->update(['ad_id' => $request->ad_id[$i], 'status' => $request->status[$i]]);
        }
        return redirect()->back()->with('success',__('successfully_updated'));
    }

}
