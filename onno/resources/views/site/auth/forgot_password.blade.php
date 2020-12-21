@extends('site.layouts.app') @section('content')
    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1>{{__('forgot_password')}}</h1> {{-- @include('site.partials.error') --}}
                <form class="ragister-form" name="ragister-form" method="post" action="{{route('do-forget-password')}}">
                    @csrf
                    <div class="form-group text-left mb-0">
                        <input name="email" type="email" value="{{old('email')}}" class="form-control" required="required" placeholder="{{__('email')}}" autocomplete="off">
                    </div>
                    <button type="submit">{{ __('send_code') }}</button>
                </form>
                {{--            <!-- /.contact-form -->--}}
            </div>
            {{--        <!-- /.account-content -->--}}
        </div>
        {{--    <!-- /.container -->--}}
    </div>
    {{--<!-- /.ragister-account -->--}}
@endsection
