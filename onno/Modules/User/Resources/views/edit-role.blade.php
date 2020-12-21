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
            {!!  Form::open(['method' => 'post']) !!}
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('update_role_and_permission') }} </h2>
                                </div>
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label>{{ __('role_name') }}</label>
                                    <input type="text" class="form-control" name="role_name"
                                           placeholder=" 'role_name') }}"
                                           value="{{ $role->name }}" maxlength="200" required>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr role="row">
                                            <th>{{ __('module') }}</th>
                                            <th>{{ __('read') }}</th>
                                            <th>{{  __('write') }}</th>
                                            <th>{{  __('delete') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allPermission as $p_item)

                                                <tr>
                                                    <td><strong>{{ $p_item->name }}</strong></td>
                                                    <td>
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                   @if(array_key_exists($p_item->name.'_read',$permissions)) checked
                                                                   @endif name="{{$p_item->name}}_read"
                                                                   class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                   @if(array_key_exists($p_item->name.'_write',$permissions)) checked
                                                                   @endif name="{{$p_item->name}}_write"
                                                                   class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                   @if(array_key_exists($p_item->name.'_delete',$permissions)) checked
                                                                   @endif name="{{$p_item->name}}_delete"
                                                                   class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </td>

                                                </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="box-footer m-t-20">
                                        <button type="submit" class="btn btn-primary pull-right"><i
                                                class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save_change') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection
