<!-- layout -->
@extends('common::layouts.auth')
<!-- page title -->
@section('page_title')
    Login -{{ __('app_name')}}
@endsection

<!-- content -->
@section('content')
<div class="card ">
    <div class="card-header text-center">
        <a href="#"><img class="logo-img" src="{{asset('images/logo.png')}}" alt="logo"></a>
        <span class="splash-description">{{ __('reset_password')}}</span></div>
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
        {{-- {{Form::open([['route' => 'reset-password',$email, $resetCode],'method' => 'post'])}} --}}
        {{Form::open(['route' => ['reset-password',$email, $resetCode], 'method' => 'post'])}}
            
            <div class="form-group">
                <input class="form-control form-control-lg" id="password" value="{{old('password')}}" name="password" data-parsley-minlength="4" type="password" placeholder="{{ __('password')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="password_confirmation" value="{{old('password_confirmation')}}" name="password_confirmation" data-parsley-minlength="4" type="password" placeholder="{{ __('confirm_password')}}" required />
            </div>
           
            <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('change_password')}}</button>
        {{Form::close()}}
    </div>

</div>
@endsection