@extends('common::layouts.master')
@section('settings')
    aria-expanded="true"
@endsection
@section('s-show')
    show
@endsection
@section('settings_active')
    active
@endsection
@section('setting-seo')
    active
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            @if(session('error'))
                <div id="error_m" class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div id="success_m" class="alert alert-success">
                    {{ session('success') }}
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

            {{--  {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!} --}}
            <input type="hidden" name="url" id="url" value="{{url('/')}}">

            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="add-new-page  bg-white p-0 m-b-20">

                                <nav>
                                    <div class="nav m-b-20 setting-tab" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link" id="general-settings"
                                           href="{{ route('setting-general') }}"
                                           role="tab">{{ __('general_settings') }}</a>
                                        <a class="nav-item nav-link" id="contact-settings"
                                           href="{{ route('setting-company') }}"
                                           role="tab">{{ __('company_informations') }}</a>
                                        <a class="nav-item nav-link" id="mail-settings"
                                           href="{{ route('setting-email') }}" role="tab">{{ __('email_settings') }}</a>
                                        <a class="nav-item nav-link" id="storage-settings"
                                           href="{{ route('setting-storage') }}"
                                           role="tab">{{ __('storage_settings') }}</a>
                                        <a class="nav-item nav-link active" id="seo-settings"
                                           href="{{ route('setting-seo') }}" role="tab">{{ __('seo_settings') }}</a>
                                        <a class="nav-item nav-link" id="recaptcha-settings"
                                           href="{{ route('setting-recaptcha') }}"
                                           role="tab">{{ __('recaptcha_settings') }}</a>
                                        <a class="nav-item nav-link" id="setting-url" href="{{ route('settings-url') }}"
                                           role="tab">{{ __('url_settings') }}</a>

                                        <a class="nav-item nav-link" id="setting-ffmpeg"
                                           href="{{ route('settings-ffmpeg') }}" role="tab">{{ __('ffmpeg_settings') }}</a>

                                        <a class="nav-item nav-link" id="setting-custom"
                                           href="{{ route('setting-custom-header-footer') }}">{{ __('custom_header_footer') }}</a>
                                        <a class="nav-item nav-link" id="cron-information"
                                           href="{{ route('cron-information') }}">{{ __('cron_information') }}</a>

                                    </div>
                                </nav>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="tab-content" id="nav-tabContent">

                                    <!-- single tab content start -->
                                    <div class="tab-pane fade show active" id="seo_settings" role="tabpanel">
                                        {!!  Form::open(['route' => 'sitemap', 'method' => 'get', 'enctype' => 'multipart/form-data', 'id' => 'sitemap']) !!}
                                        <div class="row">

                                            <div class="col-12 m-t-20">
                                                <div class="form-group form-float form-group-sm ">
                                                    <a href="{{ url('sitemap.xml') }}" class="btn btn-primary pull-right" target="_blank"> <i
                                                            class="fa fa-link m-r-10" ></i>{{ __('go_to_sitemap') }}</a>
                                                    <button type="submit" name="status"
                                                            class="btn btn-primary pull-right"><i
                                                            class="m-r-10 mdi mdi-content-save-all"></i>{{ __('generate_sitemap') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}


                                        {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="settings_language">{{ __('language') }}</label>
                                                <select class="form-control" name="seo_language" id="seo_language">
                                                    @foreach ($activeLang as  $lang)
                                                        <option
                                                            @if(settingHelper('default_language')==$lang->code) Selected
                                                            @endif value="{{$lang->code}}">{{$lang->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="seo_title"
                                                       class="col-form-label">{{ __('seo_title') }}</label>
                                                <input id="seo_title" class="form-control" name="seo_title"
                                                       value="{{ settingHelper('seo_title') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keywords"
                                                       class="col-form-label">{{ __('seo_keywords') }}</label>
                                                <input id="seo_keywords" class="form-control" name="seo_keywords"
                                                       data-role="tagsinput"
                                                       value="{{ settingHelper('seo_keywords') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_meta_description"
                                                       class="col-form-label">{{ __('seo_meta_description') }}</label>
                                                <textarea id="seo_meta_description" class="form-control"
                                                          name="seo_meta_description">{{ settingHelper('seo_meta_description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="author_name"
                                                       class="col-form-label">{{ __('author_name') }}</label>
                                                <input id="author_name" class="form-control" name="author_name"
                                                       value="{{ settingHelper('author_name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="og_title"
                                                       class="col-form-label">{{ __('og_title') }}</label>
                                                <input id="og_title" class="form-control" name="og_title"
                                                       value="{{ settingHelper('og_title') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="og_description"
                                                       class="col-form-label">{{ __('og_description') }}</label>
                                                <input id="og_description" class="form-control" name="og_description"
                                                       value="{{ settingHelper('og_description') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="og_image" class="upload-file-btn btn btn-primary"><i
                                                        class="fa fa-folder input-file"
                                                        aria-hidden="true"></i> {{ __('og_image')}}</label>
                                                <input id="og_image" name="og_image" onChange="swapImage(this)"
                                                       data-index="2" type="file" class="form-control d-none"
                                                       accept="image/*">
                                            </div>
                                            <div class="form-group text-center">
                                                @if(settingHelper('og_image') != Null)
                                                    <img src="{{ static_asset(settingHelper('og_image')) }}" width="200" data-index="2"
                                                          alt="og_image">
                                                @else
                                                    <img src="{{static_asset('default-image/default-100x100.png') }}" data-index="2" alt="user" class="img-responsive ">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="google_analytics_id"
                                                       class="col-form-label">{{ __('google_analytics_id') }}</label>
                                                <input id="google_analytics_id" class="form-control"
                                                       name="google_analytics_id"
                                                       value="{{ settingHelper('google_analytics_id') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="addthis_public_id"
                                                       class="col-form-label">{{ __('addthis_public_id') }}</label>
                                                <input id="addthis_public_id" class="form-control"
                                                       name="addthis_public_id"
                                                       value="{{ settingHelper('addthis_public_id') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="adthis_option"
                                                       class="col-form-label">{{ __('adthis_option') }}</label>
                                                <select name="adthis_option" id="adthis_option" class="form-control">
                                                    <option @if( settingHelper('adthis_option') =='1') selected
                                                            @endif value="1">{{ __('enable') }}</option>
                                                    <option @if( settingHelper('adthis_option') !='1') selected
                                                            @endif value="0">{{ __('disable') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 m-t-20">
                                                <div class="form-group form-float form-group-sm text-right">
                                                    <button type="submit" name="status"
                                                            class="btn btn-primary pull-right"><i
                                                            class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save_changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                    <!-- single tab content end -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  tab end -->
                </div>
            </div>
            <!-- right sidebar end -->
        </div>
    </div>

@endsection

