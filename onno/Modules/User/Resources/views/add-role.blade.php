@extends('common::layouts.master')
@section('rolePermission_')
    aria-expanded="true"
@endsection
@section('p-show')
    show
@endsection
@section('rolePermission')
    active
@endsection
@section('rolePermissionsub')
    active
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['method' => 'post']) !!}
            @csrf
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-header clearfix m-b-20">
                        <div class="row">
                            <div class="col-6">
                                <div class="block-header">
                                    <h2>{{ __('add_role') }}</h2>
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
                        <div class="col-12 col-lg-4">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('add_role') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">{{ __('name') }}*</label>
                                        <input id="name" name="name" value="{{ old('name') }}" type="text" required
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="role-slug" class="col-form-label"><b>{{ __('slug') }}*</b></label>
                                        <input id="role-slug" value="{{ old('slug') }}" name="slug" required
                                               type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-8">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('permissions')}}</h2>
                                </div>
                                <div class="row">
                                    {{-- @foreach ($allPermission as $permission) --}}
                                    <div class="table-responsive all-pages">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr role="row">
                                                <th>{{ __('module') }}</th>
                                                <th>{{ __('read') }}</th>
                                                <th>{{ __('write') }}</th>
                                                <th>{{ __('delete') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allPermission as $p_item)

                                                    <tr>
                                                        <td>
                                                            <strong>{{ $p_item->name }}</strong>
                                                        </td>

                                                        <td>
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="{{$p_item->name}}_read"
                                                                       class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="{{$p_item->name}}_write"
                                                                       class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="{{$p_item->name}}_delete"
                                                                       class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                        </td>

                                                    </tr>

                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('add_role') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right sidebar end -->
                    </div>
                </div>
            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>
@endsection
