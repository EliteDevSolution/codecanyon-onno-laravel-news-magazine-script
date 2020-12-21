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
@section('setting-email')
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
                                        <a class="nav-item nav-link active" id="mail-settings"
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
                                    <!-- single tab content start -->
                                    <div class="tab-pane fade show active" id="mail_settings" role="tabpanel">
                                        {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="mail_driver"
                                                       class="col-form-label">{{ __('mail_driver') }}</label>
                                                <select name="mail_driver" id="mail_driver" class="form-control">
                                                    <option @if( settingHelper('mail_driver') =='smtp') selected
                                                            @endif value="smtp">Smtp(recommended)
                                                    </option>
                                                    <option @if( settingHelper('mail_driver') =='sendmail') selected
                                                            @endif value="sendmail">Sendmail
                                                    </option>
                                                </select>

                                            </div>
                                        </div>
                                        <div @if( settingHelper('mail_driver') =='smtp') id="display-nothing"
                                             @endif class="inputFilds" id="sendMailDiv">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="sendmail_path"
                                                           class="col-form-label">{{ __('path') }}</label>
                                                    <input name="sendmail_path"
                                                           value="{{ settingHelper('sendmail_path') }}"
                                                           id="sendmail_path" class="form-control" type="text"
                                                           placeholder="sendmail path">
                                                </div>
                                            </div>
                                        </div>
                                        <div @if( settingHelper('mail_driver') =='sendmail') id="display-nothing"
                                             @endif class="inputFilds" id="smtpDiv">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_host"
                                                           class="col-form-label">{{ __('mail_host') }}</label>
                                                    <input name="mail_host" value="{{ settingHelper('mail_host') }}"
                                                           id="mail_host" class="form-control" type="text"
                                                           placeholder="smtp.gmail.com">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_port"
                                                           class="col-form-label">{{ __('mail_port') }}</label>
                                                    <input name="mail_port" value="{{ settingHelper('mail_port') }}"
                                                           id="mail_port" class="form-control" type="text"
                                                           placeholder="587">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_address"
                                                           class="col-form-label">{{ __('mail_address') }}</label>
                                                    <input name="mail_address"
                                                           value="" id="mail_address"
                                                           class="form-control" type="text"
                                                           placeholder="hellow@gmail.com">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_name"
                                                           class="col-form-label">{{ __('name') }}</label>
                                                    <input name="mail_name" value="{{ settingHelper('mail_name') }}"
                                                           id="mail_name" class="form-control" type="text"
                                                           placeholder="name">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_username"
                                                           class="col-form-label">{{ __('mail_username') }}</label>
                                                    <input name="mail_username"
                                                           value=""
                                                           id="mail_username" class="form-control" type="text"
                                                           placeholder="username">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_password"
                                                           class="col-form-label">{{ __('mail_password') }}</label>
                                                    <input name="mail_password"
                                                           value=""
                                                           id="mail_password" class="form-control" type="password"
                                                           placeholder="password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="mail_encryption"
                                                           class="col-form-label">{{ __('mail_encryption') }}</label>
                                                    <select name="mail_encryption" id="mail_encryption"
                                                            class="form-control">
                                                        <option value="">Null</option>
                                                        <option @if( settingHelper('mail_encryption') =='tls') selected
                                                                @endif value="tls">Tls
                                                        </option>
                                                        <option @if( settingHelper('mail_encryption') =='ssl') selected
                                                                @endif value="ssl">Ssl
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="signature"
                                                           class="col-form-label">{{ __('signature') }}</label>
                                                    <textarea name="signature" id="post_content" class="form-control"
                                                              rows="3">{{ settingHelper('signature') }}</textarea>
                                                </div>
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

                                        {!!  Form::open(['route' => 'send-test-mail', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']) !!}

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">{{ __('email') }}*</label>
                                                <input name="email" id="email" class="form-control" type="text"
                                                       placeholder="{{ __('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 m-t-20">
                                                <div class="form-group form-float form-group-sm text-right">
                                                    <button type="submit" name="status"
                                                            class="btn btn-primary pull-right"><i
                                                            class="m-r-10 mdi mdi-content-save-all"></i>{{ __('test') }}
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
