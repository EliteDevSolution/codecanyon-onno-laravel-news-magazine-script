@extends('site.layouts.app') @section('content')
    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1>{{__('reset_password')}}</h1> {{-- @include('site.partials.error') --}}
                <form class="ragister-form" name="ragister-form" method="post" action="{{route('reset-password', [$email, $resetCode])}}">
                    @csrf
                    <div class="form-group">
                <input class="form-control" id="password" value="{{old('password')}}" name="password" data-parsley-minlength="4" type="password" placeholder="{{ __('password')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}" name="password_confirmation" data-parsley-minlength="4" type="password" placeholder="{{ __('confirm_password')}}" required />
            </div>
                    <button type="submit">{{ __('change_password') }}</button>
                </form>
                {{--            <!-- /.contact-form -->--}}
            </div>
            {{--        <!-- /.account-content -->--}}
        </div>
        {{--    <!-- /.container -->--}}
    </div>
    {{--<!-- /.ragister-account -->--}}
@endsection
