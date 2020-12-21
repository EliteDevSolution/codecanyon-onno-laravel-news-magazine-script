<!-- layout -->
@extends('common::layouts.auth')
<!-- page title -->
@section('page_title')
    Login -{{__('app_name')}}
@endsection

<!-- content -->
@section('content')
    <div class="card ">
        <div class="card-header text-center">
            <a href="#"><img class="logo-img" src="{{asset('images/logo.png')}}" alt="logo"></a>
            <span class="splash-description">{{__('please_enter_your_user_information')}}</span></div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            {{Form::open(array('route' => 'do-login'))}}
            <div class="form-group">
                <input class="form-control form-control-lg" id="username" value="{{old('email')}}" name="email"
                       type="email" placeholder="{{__('email')}}" autocomplete="off" required/>
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="password" value="{{old('password')}}" name="password"
                       data-parsley-minlength="4" type="password" placeholder="{{__('password')}}" required/>
            </div>
            <div class="form-group">
                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remamber_me"><span
                        class="custom-control-label">{{__('remember_me')}}</span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('login')}}</button>
            {{Form::close()}}
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="{{ route('registration') }}" class="footer-link">{{__('create_an_account')}}</a></div>
            <div class="card-footer-item card-footer-item-bordered">
                <a href="{{ route('forget-password') }}" class="footer-link">{{__('forgot_password')}}</a>
            </div>
        </div>
    </div>
@endsection