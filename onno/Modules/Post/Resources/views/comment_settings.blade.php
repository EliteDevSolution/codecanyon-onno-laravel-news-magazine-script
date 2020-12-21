@extends('common::layouts.master')

@section('comments-show')
    show
@endsection

@section('comments_active')
    active
@endsection

@section('comments-setting')
    active
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'update-comment-settings','method' => 'post']) !!}
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('comment_settings') }}</h2>
                                    </div>
                                </div>
                            </div>
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

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="in_build" class="col-form-label">{{ __('in_build') }}</label>
                                <select name="inbuild_comment" id="in_build" class="form-control">
                                    <option @if( settingHelper('inbuild_comment') =='1') selected
                                            @endif value="1">{{ __('enable') }}</option>
                                    <option @if( settingHelper('inbuild_comment') !='1') selected
                                            @endif value="0">{{ __('disable') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="disqus_comment" class="col-form-label">{{ __('disqus_comment') }}</label>
                                <select name="disqus_comment" id="disqus_comment" class="form-control">
                                    <option @if( settingHelper('disqus_comment') =='1') selected
                                            @endif value="1">{{ __('enable') }}</option>
                                    <option @if( settingHelper('disqus_comment') !='1') selected
                                            @endif value="0">{{ __('disable') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="disqus_short_name" class="col-form-label">{{ __('disqus_short') }}</label>
                                <input value="{{ settingHelper('disqus_short_name') }}" id="disqus_short_name"
                                       name="disqus_short_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="facebook_comment"
                                       class="col-form-label">{{ __('facebook_comment') }}</label>
                                <select name="facebook_comment" id="facebook_comment" class="form-control">
                                    <option @if( settingHelper('facebook_comment') =='1') selected
                                            @endif value="1">{{ __('enable') }}</option>
                                    <option @if( settingHelper('facebook_comment') !='1') selected
                                            @endif value="0">{{ __('disable') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="facebook_app_id" class="col-form-label">{{ __('facebook_app_id') }}</label>
                                <input value="{{ settingHelper('facebook_app_id') }}" id="facebook_app_id"
                                       name="facebook_app_id" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save_changes') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- page info end-->
        </div>
    </div>
    <!-- page info end-->
    </div>
    </div>
    </div>
    {{-- </div> --}}


@endsection

