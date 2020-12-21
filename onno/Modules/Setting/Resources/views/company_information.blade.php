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
@section('setting-company')
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
                                        <a class="nav-item nav-link active" id="contact-settings"
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
                                    <!--  another tab content -->
                                    <div class="tab-pane fade show active" id="contact-settings" role="tabpanel">
                                        {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="settings_language">{{ __('language') }}</label>
                                                <select class="form-control" name="company_language"
                                                        id="company_language">
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
                                                <label for="application_name"
                                                       class="col-form-label">{{ __('application_name') }}</label>
                                                <input id="application_name" name="application_name"
                                                       value="{{ settingHelper('application_name') }}" type="text"
                                                       class="form-control" placeholder="Spagreen">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="address" class="col-form-label">{{ __('address') }}</label>
                                                <input id="address" name="address"
                                                       value="{{ settingHelper('address') }}" type="text"
                                                       class="form-control"
                                                       placeholder="Lower Pacific Heights San Francisco">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">{{ __('email') }}</label>
                                                <input id="email" name="email" type="email"
                                                       value="{{ settingHelper('email') }}" class="form-control"
                                                       placeholder="edward_test@domain.com">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="phone" class="col-form-label">{{ __('phone') }}</label>
                                                <input id="phone" name="phone" value="{{ settingHelper('phone') }}"
                                                       type="text" class="form-control" placeholder="(541) 754-3010">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="zip_code"
                                                       class="col-form-label">{{ __('zip_code') }}</label>
                                                <input id="zip_code" name="zip_code"
                                                       value="{{ settingHelper('zip_code') }}" type="text"
                                                       class="form-control" placeholder="1207">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="city" class="col-form-label">{{ __('city') }}</label>
                                                <input id="city" name="city" value="{{ settingHelper('city') }}"
                                                       type="text" class="form-control" placeholder="1207">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="state" class="col-form-label">{{ __('state') }}</label>
                                                <input id="state" name="state" value="{{ settingHelper('state') }}"
                                                       type="text" class="form-control" placeholder="State">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="country" class="col-form-label">{{ __('country') }}</label>
                                                <select class="form-control" name="country" id="country">
                                                    @foreach($countries as $country)
                                                        <option
                                                            @if(settingHelper('country')==$country->name->common) Selected
                                                            @endif
                                                            value="{{  $country->name->common }}">
                                                            {{ $country->name->common }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="website" class="col-form-label">{{ __('website') }}</label>
                                                <input id="website" name="website"
                                                       value="{{ settingHelper('website') }}" type="text"
                                                       class="form-control" placeholder="Website">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="company_registration"
                                                       class="col-form-label">{{ __('company_registration') }}</label>
                                                <input id="company_registration" name="company_registration"
                                                       value="{{ settingHelper('company_registration') }}" type="text"
                                                       class="form-control" placeholder="Company Registration">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="tax_number"
                                                       class="col-form-label">{{ __('tax_number') }}</label>
                                                <input id="tax_number" name="tax_number"
                                                       value="{{ settingHelper('tax_number') }}" type="text"
                                                       class="form-control" placeholder="Tax Number">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="seo_meta_description"
                                                       class="col-form-label">{{ __('about_site') }}</label>
                                                <textarea id="about_us_description" class="form-control"
                                                          name="about_us_description">{{ settingHelper('about_us_description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="copyright_text"
                                                       class="col-form-label">{{ __('copyright_text') }}</label>
                                                <input id="copyright_text" name="copyright_text"
                                                       value="{{ settingHelper('copyright_text') }}" type="text"
                                                       class="form-control" placeholder="{{ __('copyright_text') }}">
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
            <!-- Main Content Section End -->
        </div>
    </div>

    {{-- </div> --}}

@endsection