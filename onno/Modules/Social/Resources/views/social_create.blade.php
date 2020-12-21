@extends('common::layouts.master')
@section('social')
    active
@endsection

@section('modal')
    @include('gallery::image-gallery')
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route'=>'store-social','method' => 'post', 'enctype'=>'multipart/form-data']) !!}

            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('create_social') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('socials') }}" class="btn btn-primary btn-add-new btn-sm"><i
                                            class="fas fa-arrow-left"></i>
                                        {{ __('back_to_socials') }}
                                    </a>
                                </div>
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
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">

                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('social_details') }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="col-form-label">{{ __('name') }}</label>
                                <input id="name" value="{{ old('name') }}" name="name" type="text" class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="url" class="col-form-label">{{ __('url') }}</label>
                                <input id="url" name="url" value="{{ old('url') }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label">{{ __('icon') }}
                                    ({{__('use_class_of_font_awesome_icon')}}) <a class="text-primary"
                                                                                  href="https://fontawesome.com/">{{__('click_me_to_visit_site')}}</a>
                                </label>
                                <input id="page-title" value="{{ old('icon') }}" name="icon" type="text"
                                       class="form-control" required placeholder="e.g. fa fa-facebook">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label">{{ __('icon_bg_color') }}</label>
                                <input id="page-title" value="{{ old('icon_bg_color') }}" name="icon_bg_color"
                                       type="color" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label">{{ __('text_bg_color') }}</label>
                                <input id="page-title" value="{{ old('text_bg_color') }}" name="text_bg_color"
                                       type="color" class="form-control" required>
                            </div>
                        </div>

                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="status">{{ __('status') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" id="status_yes" value="1" checked
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('active') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" id="status_no" value="0"
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('inactive') }}</span>
                                </label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="mdi mdi-plus"></i> {{ __('create_social') }}</button>
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
