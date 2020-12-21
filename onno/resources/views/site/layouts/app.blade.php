<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('site.partials.seo_og')

    <title>{{settingHelper('seo_title')}}</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ static_asset('site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/slick.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/structure.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/main.css') }}">
    @if($language->text_direction == "RTL")
        <link rel="stylesheet" href="{{static_asset('site/css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{static_asset('site/css/custom.css') }}">
    <link rel="stylesheet" href="{{static_asset('site/css/responsive.css') }}">

    @yield('style')


    <link href="https://fonts.googleapis.com/css2?family={{data_get(activeTheme(), 'options.fonts')}}:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- icons --}}
    <link rel="icon" href="{{static_asset(''.settingHelper('favicon')) }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{static_asset('site/images/ico/apple-touch-icon-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{static_asset('site/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{static_asset('site/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{static_asset('site/images/ico/apple-touch-icon-57-precomposed.png') }}">

    @if(settingHelper('predefined_header')!=null)
        {!! settingHelper('predefined_header') !!}
    @endif
    @if(settingHelper('custom_header_style')!=null)
        <style>
            {!! settingHelper('custom_header_style') !!}
        </style>
    @endif

    @include('feed::links')

    {{-- icons --}}

    <!-- Template Developed By  -->
    @stack('style')

    <style type="text/css">
      :root {
          --primary-color: {{data_get(activeTheme(), 'options.primary_color')}};
          --primary-font: {{\Config::get('site.fonts.'.data_get(activeTheme(), 'options.fonts').'')}};
          --plyr-color-main:{{data_get(activeTheme(), 'options.primary_color')}};
      }
    </style>

    <script async src="https://www.googletagmanager.com/gtag/js?id={{ settingHelper('google_analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ settingHelper('google_analytics_id') }}');
    </script>
</head>
{{-- dark class="sg-dark" --}}
<body class="{{defaultModeCheck()}}">
    <div id="switch-mode" class="{{defaultModeCheck() == 'sg-dark'? 'active':''}}">
        <div class="sm-text">{{__('dark_mode')}}</div>
        <div class="sm-button">
            <input type="hidden" id="url" value="{{url('/')}}">
          <span></span>
        </div>
    </div>

@include('site.layouts.header')
{{-- /.sg-header --}}

@yield('content')

    <div class="scrollToTop" id="display-nothing">
        <a href="#"><i class="fa fa-angle-up"></i></a>
    </div>
@include('site.layouts.footer')
{{-- /.footer --}}

{{-- JS --}}

<script src="{{static_asset('site/js/jquery.min.js') }}"></script>
<script src="{{static_asset('site/js/popper.min.js') }}"></script>
<script src="{{static_asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{static_asset('site/js/slick.min.js') }}"></script>
<script src="{{static_asset('site/js/theia-sticky-sidebar.min.js') }}"></script>
<script src="{{static_asset('site/js/magnific-popup.min.js') }}"></script>
<script src="{{static_asset('site/js/carouFredSel.js') }}"></script>
@stack('script')
<script src="{{static_asset('site/js/main.js') }}"></script>
<script src="{{static_asset('js/custom.js') }}"></script>

<script type="text/javascript" src="{{static_asset('site/js') }}/jquery.cookie.min.js"></script>

    @php
        if(settingHelper('notification_status') == '1'){
            $onesignal_appid                    =   settingHelper('onesignal_app_id');
            $onesignal_actionmessage            =   settingHelper('onesignal_action_message');
            $onesignal_acceptbuttontext         =   settingHelper('onesignal_accept_button');
            $onesignal_cancelbuttontext         =   settingHelper('onesignal_cancel_button');
        }
    @endphp
    <script src="{{static_asset('site/js') }}/bootstrap-tagsinput.min.js" async></script>

    @if(settingHelper('notification_status') == '1')
    <!-- oneSignal -->
    <script src="{{static_asset('site/js') }}/OneSignalSDK.js" async=""></script>

    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
            appId: "{{ $onesignal_appid ?? '' }}",
            subdomainName: 'push',
            autoRegister: false,
            promptOptions: {
                /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
                /* actionMessage limited to 90 characters */
                actionMessage: "{{ $onesignal_actionmessage ?? '' }}",
                /* acceptButtonText limited to 15 characters */
                acceptButtonText: "{{ $onesignal_acceptbuttontext ?? '' }}",
                /* cancelButtonText limited to 15 characters */
                cancelButtonText: "{{ $onesignal_cancelbuttontext ?? '' }}"
            }
        }]);
    </script>

    <script src="{{static_asset('site/js/onesignal_notification.js')}}"> </script>

    @endif


    @if(!blank(\Request::route()))

        @if(\Request::route()->getName() == "article.detail")
            @if(settingHelper('adthis_option')==1 and settingHelper('addthis_public_id')!=null and \Request::route()->getName() == "article.detail")
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid={{ settingHelper('addthis_public_id') }}"></script>
            @endif

            @if(settingHelper('facebook_comment')==1)
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/{{ settingHelper('default_language') }}/sdk.js#xfbml=1&version=v8.0&appId={{ settingHelper('facebook_app_id') }}&autoLogAppEvents=1" nonce="JOvaLAFF"></script>
            @endif
        @endif
    @endif

    @yield('script')

    @isset($post)
    @if(!blank(\Request::route()))
    @if(settingHelper('adthis_option')==1 and settingHelper('addthis_public_id')!=null and \Request::route()->getName() == "article.detail")
        <script type="text/javascript">
            (function($) {
                "use strict";
                var addthis_share = {
                    url: "{{ url()->current() }}",
                    title: "{{ $post->title }}",
                    description: "{{ strip_tags(\Illuminate\Support\Str::limit($post->content, 130)) }}",
                    media: "{{basePath(@$post->image)}}/{{ @$post->image->big_image_two }}"
                }
            })(jQuery);
        </script>
    @endif
    @endif
    @endisset

    @if(settingHelper('custom_footer_js')!=null)
        <script>
            {!! base64_decode(settingHelper('custom_footer_js')) !!}
        </script>
    @endif

    <script src="{{ static_asset('site/js/custom.js')}}" type="text/javascript"></script>
</body>
</html>
