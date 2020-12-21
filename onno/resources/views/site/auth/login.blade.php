@extends('site.layouts.app') 
@section('content')
    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1>{{ __('login') }}</h1>
                {{-- @include('site.partials.error') --}}
                <form class="ragister-form" name="ragister-form" method="post" action="#">
                    @csrf
                    <div class="form-group text-left mb-0">
                        <label>{{ __('email') }}</label>
                        <input name="email" type="email" class="form-control" required="required" placeholder="{{ __('input_email') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('password') }}</label>
                        <input name="password" type="password" class="form-control" required="required" placeholder="***********">
                    </div>
                    @if( settingHelper('captcha_visibility') == 1 )
                        <div class="col-lg-12 text-center mb-4">
                            <div class="row">
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display() !!}
                          </div>
                        </div>
                    @endif
                    <button type="submit">{{ __('login') }}</button>
                    <div class="middle-content">
                        <p>{{ __('dont_have_an_account') }} <a href="{{ route('site.register.form') }}">{{ __('sign_up') }}</a></p> <a href="{{ route('forget-password') }}">{{__('forgot_password')}}</a>
                    </div>
                </form>
                {{--<!-- /.contact-form -->--}}
            </div>
            {{--<!-- /.account-content -->--}}
        </div>
        {{--<!-- /.container -->--}}
    </div>
    {{--<!-- /.ragister-account -->--}}
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
