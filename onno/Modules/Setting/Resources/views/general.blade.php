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
@section('setting-general')
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

                                        <a class="nav-item nav-link active" id="general-settings"
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
                                        <a class="nav-item nav-link" id="seo-settings" href="{{ route('setting-seo') }}"
                                           role="tab">{{ __('seo_settings') }}</a>
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
                                    <div class="tab-pane fade show active" id="general_settings" role="tabpanel">
                                        {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="settings_language">{{ __('default_language') }}</label>
                                                <select class="form-control" name="default_language"
                                                        id="settings_language">
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
                                                <label for="timezone"
                                                       class="col-form-label">{{ __('timezone') }}</label>
                                                @php
                                                    $selected = settingHelper('timezone');
                                                    $placeholder = 'Select a timezone';
                                                    $formAttributes = array('class' => 'form-control', 'name' => 'timezone');
                                                    $optionAttributes = array('customValue' => 'true');
                                                @endphp
                                                {!! Timezone::selectForm($selected, $placeholder, $formAttributes, $optionAttributes) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="logo" class="upload-file-btn btn btn-primary"><i
                                                        class="fa fa-folder input-file"
                                                        aria-hidden="true"></i> {{ __('add_logo')}}</label>
                                                <input id="logo" name="logo" onChange="swapImage(this)" data-index="0"
                                                       type="file" class="form-control d-none" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group text-center">
                                                @if(settingHelper('logo') != Null)
                                                    <img src="{{ static_asset(settingHelper('logo')) }}" data-index="0"
                                                         height="64" width="auto" alt="img">
                                                @else
                                                    <img src="{{static_asset('default-image/default-100x100.png') }}" height="64"
                                                         width="auto" data-index="0" alt="user" class="img-responsive ">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="favicon" class="upload-file-btn btn btn-primary"><i
                                                        class="fa fa-folder input-file"
                                                        aria-hidden="true"></i> {{ __('add_favicon')}}</label>

                                                <input id="favicon" name="favicon" onChange="swapImage(this)"
                                                       data-index="1" type="file" class="form-control d-none"
                                                       accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group text-center">
                                                @if(settingHelper('favicon') != Null)
                                                    <img src="{{ static_asset(settingHelper('favicon')) }}" data-index="1"
                                                         height="64" width="auto" alt="img">
                                                @else
                                                    <img src="{{static_asset('default-image/default-100x100.png') }}" height="64"
                                                         width="auto" data-index="1" alt="user" class="img-responsive ">
                                                @endif
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

 
