@extends('common::layouts.master')
@section('notification-aria-expanded')
    aria-expanded="true"
@endsection
@section('notification-show')
    show
@endsection
@section('notify_setting')
    active
@endsection
@section('notification_active')
    active
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'onesignal-update']) !!}

            <input type="hidden" name="default_language" value="{{ settingHelper('default_language') }}">
            <input type="hidden" name="url" id="url" value="{{ url('') }}">

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
                                <h4 class="border-bottom">{{ __('notification_setting_details') }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="onesignal_api_key"
                                       class="col-form-label">{{ __('onesignal_api_key') }}</label>
                                <input id="onesignal_api_key" value="{{ settingHelper('onesignal_api_key') }}"
                                       name="onesignal_api_key" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="onesignal_app_id"
                                       class="col-form-label">{{ __('onesignal_app_id') }}</label>
                                <input id="onesignal_app_id" name="onesignal_app_id"
                                       value="{{ settingHelper('onesignal_app_id') }}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row p-l-15 p-t-20">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="notification">{{ __('notification') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="notification_status" value="1"
                                           @if(settingHelper('notification_status')==1) checked
                                           @endif class="custom-control-input">
                                    <span class="custom-control-label">{{ __('enable') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="notification_status" value="0"
                                           @if(settingHelper('notification_status')==0) checked
                                           @endif class="custom-control-input">
                                    <span class="custom-control-label">{{ __('disable') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="settings_language">{{ __('select_language_for_below_fields') }}</label>
                                <select class="form-control" name="onesignal_language" id="onesignal_language">
                                    @foreach ($activeLang as  $lang)
                                        <option
                                            @if(settingHelper('default_language')==$lang->code) Selected
                                            @endif value="{{$lang->code}}">{{$lang->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="onesignal_action_message"
                                       class="col-form-label">{{ __('onesignal_action_message') }}</label>
                                <input id="onesignal_action_message" name="onesignal_action_message"
                                       value="{{ settingHelper('onesignal_action_message') }}" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="onesignal_accept_button"
                                       class="col-form-label">{{ __('onesignal_accept_button') }}</label>
                                <input id="onesignal_accept_button" name="onesignal_accept_button"
                                       value="{{ settingHelper('onesignal_accept_button') }}" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="onesignal_cancel_button"
                                       class="col-form-label">{{ __('onesignal_cancel_button') }}</label>
                                <input id="onesignal_cancel_button" name="onesignal_cancel_button"
                                       value="{{ settingHelper('onesignal_cancel_button') }}" type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="mdi mdi-plus"></i> {{ __('update') }}</button>
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
