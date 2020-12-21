@extends('common::layouts.master')
@section('ads-aria-expanded')
    aria-expanded="true"
@endsection
@section('ads-show')
    show
@endsection
@section('ads')
    active
@endsection
@section('ads_active')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route'=>['update-ad',$ad->id],'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" id="images" value="{{ $countImage }}">
            <input type="hidden" id="imageCount" value="1">
            <div class="row clearfix">

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('edit_ad') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('ads') }}" class="btn btn-primary btn-add-new btn-sm"><i class="fas fa-arrow-left"></i>
                                        {{ __('back_to_ads') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session('error'))
                        <div id="error_m" class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    @if(session('success'))
                        <div id="success_m" class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('ads_details') }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="ad_name" class="col-form-label">{{ __('ad_name') }}*</label>
                                <input id="ad_name" value="{{ $ad->ad_name }}" name="ad_name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="ad_size" class="col-form-label">{{ __('ad_size') }}*</label>
                                <input id="ad_size" value="{{ $ad->ad_size }}" name="ad_size" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="ad_type" class="col-form-label">{{ __('ad_type') }}*</label>
                                <select id="ad_type" name="ad_type" class="form-control" required>
                                    <option value=""> {{ __('select_option') }}</option>
                                    <option value="code" @if($ad->ad_type=='code') selected @endif> {{ __('code') }}</option>
                                    <option value="image" @if($ad->ad_type=='image') selected @endif> {{ __('image') }}</option>
                                    <option value="text" @if($ad->ad_type=='text') selected @endif> {{ __('text') }}</option>
                                </select>
                            </div>
                        </div>
                        <div id="div_ad_text" @if($ad->ad_text == null) class="col-sm-12 d-none" @else class="col-sm-12" @endif>
                            <div class="form-group">
                                <label for="ad_text" class="col-form-label">{{ __('ad_text') }}*</label>
                                <textarea  name="ad_text" id="content" class="form-control" rows="6"> {!! html_entity_decode($ad->ad_text) !!}</textarea>
                            </div>
                        </div>
                        <div id="div_ad_code" @if($ad->ad_code == null) class="col-sm-12 d-none" @else class="col-sm-12" @endif>
                            <div class="form-group">
                                <label for="ad_code" class="col-form-label">{{ __('ad_code') }}*</label>
                                <textarea  name="ad_code" class="form-control" rows="6">{{ base64_decode($ad->ad_code) }}</textarea>
                            </div>
                        </div>
                        <div id="div_ad_image" @if($ad->ad_image_id == null) class="d-none" @endif>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal" data-target=".image-modal-lg">{{ __('update_ad_image') }}*</button>
                                    <input id="image_id" value="{{ $ad->ad_image_id }}" name="ad_image_id" type="hidden" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    @if(@$ad->ad_type == 'image')
                                        @if(isFileExist(@$ad->adImage, @$ad->adImage->thumbnail))
                                            <img src="{{basePath($ad->adImage)}}/{{ $ad->adImage->thumbnail }}" data-src="{{basePath($ad->adImage)}}/{{ $ad->adImage->thumbnail }}" alt="{{ $ad->ad_name }}" id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                        @else
                                            <img src="{{static_asset('default-image/default-image/default-100x100.png') }} "  id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                        @endif
                                    @else
                                        <img src="{{static_asset('default-image/default-image/default-100x100.png') }} "  id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ad_url" class="col-form-label">{{ __('ad_url') }}</label>
                                    <input id="ad_url" name="ad_url"  value="{{ $ad->ad_url }}" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i class="mdi mdi-plus"></i> {{ __('update_ad') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>
@endsection
