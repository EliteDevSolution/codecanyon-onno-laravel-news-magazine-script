@extends('common::layouts.master')
@section('appearance')
    active
@endsection
@section('appearance-aria-expanded')
    aria-expanded=true
@endsection
@section('theme_option')
    active
@endsection
@section('appearance-show')
    show
@endsection

@section('content')

<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
        <!-- page info start-->
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
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
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-12">
                            {!!  Form::open(['route'=>'update-theme-option','method' => 'post']) !!}
                                <div class="add-new-page  bg-white p-20 m-b-20">
                                    <div class="block-header">
                                        <h2>{{ __('update_theme') }}</h2>
                                    </div>
                                    <div class="row p-l-15">
                                        <div class="col-12 col-md-12">
                                            <div class="form-title">
                                                <label for="header_style">{{ __('header') }}</label>
                                            </div>
                                        </div>
                                            <div class="col-12 col-md-4">
                                                <div class="section_section_style">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="header_style" id="header_style_1" value="header_1" {{(data_get($activeTheme, 'options.header_style') == "header_1"? 'checked':'')}} class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                    <img src="{{static_asset('default-image/Header/Header_1.png') }}" alt="" class="img-responsive cat-block-img">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="section_section_style">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="header_style" id="header_style_2" value="header_2" {{(data_get($activeTheme, 'options.header_style') == "header_2"? 'checked':'')}} class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                    <img src="{{static_asset('default-image/Header/Header_2.png') }}" alt="" class="img-responsive cat-block-img">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="section_section_style">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="header_style" id="header_style_3" value="header_3"  {{(data_get($activeTheme, 'options.header_style') == "header_3"? 'checked':'')}} class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                    <img src="{{static_asset('default-image/Header/Header_3.png') }}" alt="" class="img-responsive cat-block-img">
                                                </div>
                                            </div>

                                    </div>
                                    <div class="row p-l-15">
                                            <div class="col-12 col-md-12">
                                                <div class="form-title">
                                                    <label for="footer_style">{{ __('footer') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="section_section_style">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="footer_style" id="footer_style_1" value="footer_1" {{(data_get($activeTheme, 'options.footer_style') == "footer_1"? 'checked':'')}} class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                    <img src="{{static_asset('default-image/Footer/Footer_1.png') }}" alt="" class="img-responsive cat-block-img">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="section_section_style">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="footer_style" id="footer_style_2" value="footer_2"  {{(data_get($activeTheme, 'options.footer_style') == "footer_2"? 'checked':'')}} class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                    <img src="{{static_asset('default-image/Footer/Footer_2.png') }}" alt="" class="img-responsive cat-block-img">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="section_section_style">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="footer_style" id="footer_style_3" value="footer_3" {{(data_get($activeTheme, 'options.footer_style') == "footer_3"? 'checked':'')}} class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                    <img src="{{static_asset('default-image/Footer/Footer_3.png') }}" alt="" class="img-responsive cat-block-img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="page-title" class="col-form-label">{{ __('primary_color') }}</label>
                                                    <input id="page-title" value="{{ data_get($activeTheme, 'options.primary_color') }}" name="primary_color" type="color" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="language" class="col-form-label">{{ __('font') }}</label>
                                                    <select class="form-control" name="fonts" id="language">
                                                        @foreach(\Config::get('site.fonts') as $key=>$font)
                                                            <option value="{{$key}}" @if(data_get($activeTheme, 'options.fonts') == $key) selected @endif>
                                                            @php
                                                                $font = explode(',',$font);
                                                            @endphp {{$font[0]}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="language" class="col-form-label">{{ __('default_mode') }}</label>
                                                    <select class="form-control" name="mode" id="mode">
                                                        @foreach(\Config::get('site.modes') as $key=>$mode)
                                                            <option value="{{$mode}}" @if(data_get($activeTheme, 'options.mode') == $mode) selected @endif>{{$key}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_theme') }}</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            {!! Form::close() !!}
                            </div>
                        <!-- Main Content section end -->

                    </div>
                </div>
            </div>
        <!-- page info end-->
    </div>
</div>

@endsection
