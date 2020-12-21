@extends('common::layouts.master')
@section('notification-aria-expanded')
    aria-expanded="true"
@endsection
@section('notification-show')
    show
@endsection
@section('send_custom_notification')
    active
@endsection
@section('notification_active')
    active
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'custom-notification-send', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            <div class="row clearfix">
                <div class="col-12">
                    @if(session('error'))
                        <div id="error_m" class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    @if(session('success'))
                        <div id="success_m" class="alert alert-success">
                            {{session('success')}}
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
                </div>
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">

                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('send_custom_notification') }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="headings" class="col-form-label">{{ __('headings') }}*</label>
                                <input id="headings" name="headings" value="{{ old('headings') }}" required type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="message" class="col-form-label">{{ __('message') }}*</label>
                                <textarea id="message" name="message" class="form-control" required rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="url" class="col-form-label">{{ __('url') }}*</label>
                                <input id="url" name="url" value="{{ old('url') }}" required type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="icon_url" class="col-form-label">{{ __('icon_url') }}*</label>
                                <input id="icon_url" name="icon_url" value="{{ old('icon_url') }}" required type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="image_url" class="col-form-label">{{ __('image_url') }}*</label>
                                <input id="image_url" name="image_url" value="{{ old('image_url') }}" required
                                       type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="fa fa-paper-plane"
                                            aria-hidden="true"></i> {{ __('send_notification') }}</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>

@endsection
