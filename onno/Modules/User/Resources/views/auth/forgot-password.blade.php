<!-- layout -->
@extends('common::layouts.auth')
<!-- page title -->
@section('page_title')
    Forgot password -{{__('app_name')}}
@endsection

<!-- content -->
@section('content')
<div class="card ">
    <div class="card-header text-center">
        <a href="#"><img class="logo-img" src="{{asset('images/logo.png')}}" alt="logo"></a>
        <span class="splash-description">{{__('forgot_password')}}</span></div>
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
        {{Form::open(array('route' => 'do-forget-password'))}}
            <div class="form-group">
                <input class="form-control form-control-lg" id="email" value="{{old('email')}}"  name="email" id="email"  required="" maxlength="70" type="email" placeholder="{{__('email')}}" autocomplete="off" required />
            </div>
         
            <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('send_code')}}</button>
        {{Form::close()}}
    </div>
    
</div>
@endsection


