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
@section('setting-custom')
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
                                           href="{{ route('setting-general') }}">{{ __('general_settings') }}</a>
                                        <a class="nav-item nav-link" id="contact-settings"
                                           href="{{ route('setting-company') }}">{{ __('company_informations') }}</a>
                                        <a class="nav-item nav-link" id="mail-settings"
                                           href="{{ route('setting-email') }}">{{ __('email_settings') }}</a>
                                        <a class="nav-item nav-link" id="storage-settings"
                                           href="{{ route('setting-storage') }}">{{ __('storage_settings') }}</a>
                                        <a class="nav-item nav-link" id="seo-settings"
                                           href="{{ route('setting-seo') }}">{{ __('seo_settings') }}</a>
                                        <a class="nav-item nav-link" id="recaptcha-settings"
                                           href="{{ route('setting-recaptcha') }}">{{ __('recaptcha_settings') }}</a>
                                        <a class="nav-item nav-link" id="setting-url" href="{{ route('settings-url') }}"
                                           role="tab">{{ __('url_settings') }}</a>

                                        <a class="nav-item nav-link" id="setting-ffmpeg"
                                           href="{{ route('settings-ffmpeg') }}" role="tab">{{ __('ffmpeg_settings') }}</a>

                                        <a class="nav-item nav-link active" id="setting-custom"
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
                                    <div class="tab-pane fade show active" id="recaptcha_settings" role="tabpanel">
                                        {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!}

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="predefined_header"
                                                       class="col-form-label">{{ __('predefined_header') }}</label>
                                                <textarea name="predefined_header" id="predefined_header"
                                                          class="form-control">{{ settingHelper('predefined_header') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="custom_header_style"
                                                       class="col-form-label">{{ __('custom_css') }}</label>
                                                <textarea name="custom_header_style" id="custom_header_style"
                                                          class="form-control">{{ settingHelper('custom_header_style') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="custom_footer_js"
                                                       class="col-form-label">{{ __('custom_js') }}</label>
                                                <textarea name="custom_footer_js" id="custom_footer_js"
                                                          class="form-control">{{ base64_decode(settingHelper('custom_footer_js')) }}</textarea>
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
                                        {{-- {{ Form::close() }} --}}
                                    </div>
                                    <!-- single tab content end -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  tab end -->
                </div>
            </div>
            <!-- Main Content Section End -->
        </div>
    </div>
@endsection

