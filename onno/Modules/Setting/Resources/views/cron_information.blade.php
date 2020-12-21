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
@section('cron-information')
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

                                        <a class="nav-item nav-link active" id="cron-information"
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

                                        <div class="col-sm-12 ">
                                            <div class="m-b-20">
                                                <span><strong>{{ __('cron') }}:</strong> * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1 <a href="https://laravel.com/docs/6.x/scheduling" target="_blank"><strong>{{__('read_more')}}</strong></a></span>

                                            </div>


                                     {{--        <div class="m-b-20">
                                                <span><strong>{{ __('for_all')}} {{ __('cPanel_cron_command') }} :</strong> /usr/local/bin/php /home/username/project_path/artisan schedule:run >> /dev/null/ 2>&1</span>

                                            </div> --}}


                                            {{-- <div class="">
                                                <strong> News Letter CRON URL:</strong> {{ route('schedule-run', ['slug' => 'newsletter']) }}
                                            </div> --}}
                                            <div class="mb-2">
                                                <span><strong>{{ __('video_convert') }} {{ __('cPanel_cron_command') }} :</strong> * * * * * /usr/local/bin/php /home/username/project_path/artisan videoConverter:cron >> /dev/null/ 2>&1</span>

                                            </div>

                                            <div class="m-b-20">
                                                <strong> {{__('video_convert_cron')}} : </strong>  <a href="{{ route('schedule-run', ['slug' => 'video-convert']) }}" class="btn-info btn-xs"> {{ __('run_manually')}} </a>
                                            </div>

                                            <div class="mb-2">
                                                <span><strong>{{ __('schedule_post') }} {{ __('cPanel_cron_command') }} :</strong> * * * * * /usr/local/bin/php /home/username/project_path/artisan schedulepost:cron >> /dev/null/ 2>&1</span>

                                            </div>

                                            <div class="m-b-20">
                                                <strong> {{__('schedule_post_cron')}}:</strong> 
                                                <a href="{{ route('schedule-run', ['slug' => 'schedule']) }}" class=" btn-info btn-xs" > {{ __('run_manually')}} </a>
                                            </div>

                                            <div class="mb-2">
                                                <span><strong>{{ __('newsletter') }} {{ __('cPanel_cron_command') }} :</strong> * * * * * /usr/local/bin/php /home/username/project_path/artisan queue:cron >> /dev/null/ 2>&1</span>

                                            </div>

                                            <div class="m-b-20">
                                                <strong> {{__('newsletter_cron')}}:</strong> 
                                                <a href="{{ route('schedule-run', ['slug' => 'newsletter']) }}" class=" btn-info btn-xs" > {{ __('run_manually')}} </a>
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

