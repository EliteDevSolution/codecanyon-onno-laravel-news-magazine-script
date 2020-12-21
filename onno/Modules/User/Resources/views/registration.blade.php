<!-- layout -->
@extends('common::layouts.auth')
<!-- page title -->
@section('page_title')
    Registration -{{__('app_name')}}
@endsection

<!-- content -->
@section('content')
    <div class="card ">
        <div class="card-header text-center">
            <a href="#"><img class="logo-img" src="{{asset('images/logo.png')}}" alt="logo"></a>
            <span class="splash-description">{{__('please_enter_your_user_information')}}</span>
        </div>
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
            {{Form::open(array('route' => 'do-registration'))}}
            <div class="form-group">
                <input class="form-control form-control-lg" name="first_name" type="text"
                       placeholder="{{__('first_name')}}" required/>
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" name="last_name" type="text"
                       placeholder="{{__('last_name')}}" required/>
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" name="email" type="email" placeholder="{{__('email')}}"
                       autocomplete="off" required/>
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="password" name="password" data-parsley-minlength="4"
                       type="password" placeholder="{{__('password')}}" required/>
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" name="password_confirmation"
                       data-parsley-equalto="#password" data-parsley-minlength="4" type="password"
                       placeholder="{{__('password_confirmation')}}" required/>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('registration')}}</button>
            {{Form::close()}}
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="{{ URL::to('/') }}" class="footer-link">{{__('back_to').' '.__('app_name')}}</a></div>
            <div class="card-footer-item card-footer-item-bordered">
                <a href="{{ route('login') }}" class="footer-link">{{__('login')}}</a>
            </div>
        </div>
    </div>
@endsection
