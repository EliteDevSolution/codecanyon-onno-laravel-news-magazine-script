@extends('common::layouts.master')

@section('settings')
    aria-expanded="true"
@endsection
@section('s-show')
    show
@endsection
@section('email_temp')
    active
@endsection
@section('settings_active')
    active
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route'=>'update-email-template','method' => 'post']) !!}
            @csrf
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-header clearfix m-b-20">
                        <div class="row">
                            <div class="col-6">
                                <div class="block-header">
                                    <h2>{{ __('email_template') }}</h2>
                                </div>
                            </div>
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

                        </div>
                    </div>
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-12">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('email_template') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email_group" class="col-form-label">{{ __('email_group') }}</label>
                                        <input id="email_group" name="email_group"
                                               value="{{ $emailTemplate->email_group }}" type="text" required
                                               class="form-control" readonly data-toggle="tooltip" data-placement="top"
                                               title="You cannot update email group.">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="subject" class="col-form-label">{{ __('subject') }}</label>
                                        <input id="subject" name="subject" value="{{ $emailTemplate->subject }}"
                                               type="text" required
                                               class="form-control">
                                        <input name="template_id" value="{{ $emailTemplate->id }}" type="hidden"
                                               required>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-4">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label for="role-slug"
                                                       class="col-form-label"><b>{{ __('template_body') }}</b></label>
                                                <textarea name="template_body" name="contact-text" id="post_content"
                                                          cols="40" rows="7">
                                                        {!! $emailTemplate->template_body !!}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="role-slug"
                                                       class="col-form-label"><b>{{ __('available_merge_fields') }}</b></label>
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('site_logo') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {SITE_LOGO}
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('username') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {USERNAME}
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('site_name') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {SITE_NAME}
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('site_url') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {SITE_URL}
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('user_email') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {USER_EMAIL}
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('password') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {PASSWORD}
                                                    </div>
                                                </div>
                                                @if($emailTemplate->email_group == 'activate_account')
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            {{ __('activate_url') }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {ACTIVATE_URL}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($emailTemplate->email_group == 'forgot_password')
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            {{ __('password_reset_url') }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {PASS_KEY_URL}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($emailTemplate->email_group == 'reset_password')
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            {{ __('new_password') }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {NEW_PASSWORD}
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row mb-1">
                                                    <div class="col-md-6">
                                                        {{ __('signature') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {SIGNATURE}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btn" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_template') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main Content section end -->
                    </div>
                </div>
            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>

@endsection
