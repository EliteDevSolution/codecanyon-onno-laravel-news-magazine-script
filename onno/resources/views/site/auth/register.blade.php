@extends('site.layouts.app') @section('content')
    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1>{{ __('sign_up') }}</h1>
                {{-- @include('site.partials.error') --}}
                <form class="ragister-form" name="ragister-form" method="post" action="{{ route('site.register') }}">
                    @csrf
                    <div class="form-group text-left mb-0">
                        <label>{{ __('first_name') }}</label>
                        <input name="first_name" type="text" class="form-control" required="required" placeholder="{{ __('first_name') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('last_name') }}</label>
                        <input name="last_name" type="text" class="form-control" required="required" placeholder="{{ __('last_name') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('email') }}</label>
                        <input name="email" type="email" class="form-control" required="required" placeholder="{{ __('input_email') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('password') }}</label>
                        <input name="password" type="password" class="form-control" required="required" placeholder="***********">
                    </div>
                    @if( settingHelper('captcha_visibility') == 1 )
                        <div class="col-lg-12 text-center px-0 mb-4">
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display() !!}
                        </div>
                    @endif
                    <button type="submit">{{ __('sign_up') }}</button>
                    <div class="middle-content">
                        <p>{{ __('already_have_an_account') }} <a href="{{route('site.login.form')}}">{{ __('login') }}</a></p> {{-- <a href="#">Forgot your password?</a>--}}
                    </div>
                </form>
                {{--<!-- /.contact-form -->--}}
            </div>
            {{--<!-- /.account-content -->--}}
        </div> {{--<!-- /.container -->--}}
    </div> {{--
<!-- /.ragister-account -->--}}
@endsection
@section('script')
    @if(defaultModeCheck() == 'sg-dark')
        <script type="text/javascript">
            jQuery(function($){
                $('.g-recaptcha').attr('data-theme', 'dark');
            });
        </script>
    @endif
@endsection
