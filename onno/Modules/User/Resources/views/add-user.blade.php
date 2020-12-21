@extends('common::layouts.master')

@section('users_management')
    active
@endsection
@section('users_management_')
    aria-expanded="true"
@endsection
@section('u-show')
    show
@endsection
@section('user-create')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'user-store','method' => 'post', 'enctype'=>'multipart/form-data']) !!}

            @csrf
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-12">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('add_user') }}</h2>
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
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name"
                                                   class="col-form-label">{{ __('first_name') }}</label>
                                            <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                                   type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name" class="col-form-label">{{ __('last_name') }}</label>
                                            <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                                   type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">{{ __('email') }}</label>
                                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_role">{{ __('role') }}</label>
                                            <select class="form-control" id="user_role" name="user_role" required>
                                                @foreach ($roles as $role)

                                                    <option value="{{ $role->slug }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">{{ __('password') }}</label>
                                            <input id="password" name="password" value="{{ old('password') }}"
                                                   type="password" class="form-control"
                                                   data-parsley-minlength="6"
                                                   data-parsley-required
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password_confirmation"
                                                   class="col-form-label">{{ __('password_confirmation') }}</label>
                                            <input id="password_confirmation" name="password_confirmation"
                                                   value="{{ old('password_confirmation') }}" type="password"
                                                   class="form-control"
                                                   data-parsley-equalto="#password"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button type="button" id="btn_image_modal"
                                                    class="btn btn-primary btn-image-modal" data-id="1"
                                                    data-toggle="modal"
                                                    data-target=".image-modal-lg">{{ __('add_image') }}</button>
                                            <input id="image_id" name="image_id" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group text-center">
                                                <img src="{{static_asset('default-image/user.jpg') }} " id="image_preview"
                                                     width="200" height="200" alt="image"
                                                     class="img-responsive img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="status" value="1"
                                                    class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-account-plus"></i>{{ __('add_user') }}
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
