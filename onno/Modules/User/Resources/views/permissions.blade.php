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
@section('permissions')
    active
@endsection
@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="block-header col-6">
                                                <h2>{{ __('roles_&_permissions') }}</h2>
                                            </div>
                                            @if(Sentinel::getUser()->hasAccess(['role_write']))
                                                <div class="col-6 text-right">
                                                    <a href="{{ route('new-role-add') }}" class="btn btn-primary btn-sm">
                                                        <i class="m-r-10 mdi mdi-plus"></i>{{ __('add_role') }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-12 pt-1" id="success_m">
                                        @if(session('error'))
                                            <div id="error_m" class="alert alert-danger">
                                                {{session('error')}}
                                            </div>
                                        @endif
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{session('success')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>{{ __('module') }}</th>
                                        <th>{{ __('role') }}</th>
                                        <th>{{ __('read') }}</th>
                                        <th>{{ __('write') }}</th>
                                        <th>{{ __('delete') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissions as $permission)
                                        @php
                                            $i=0;
                                        @endphp
                                        <tr>
                                            <td rowspan="{{$noOfRole}}">
                                                <strong>{{ $permission->name }}</strong>
                                            </td>
                                            @foreach ($roles as $role)
                                                <td>{{$role->name}}</td>
                                                <td>
                                                    @php
                                                        ++$i;

                                                        $rolePermissions    = $role->permissions;
                                                        if($rolePermissions == null){
                                                            $rolePermissions = array();
                                                        }
                                                    @endphp

                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               onclick="change_item('{{$permission->name}}_read','{{ $role->id }}')"
                                                               @if(array_key_exists($permission->name.'_read',$rolePermissions)) checked
                                                               @endif
                                                               name="post" class="custom-control-input">

                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               onclick="change_item('{{$permission->name}}_write','{{ $role->id }}')"
                                                               @if(array_key_exists($permission->name.'_write',$rolePermissions)) checked
                                                               @endif  name="post" class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               onclick="change_item('{{$permission->name}}_delete','{{ $role->id }}')"
                                                               @if(array_key_exists($permission->name.'_delete',$rolePermissions)) checked
                                                               @endif  name="post" class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </td>

                                        </tr>
                                        @if($noOfRole>$i)
                                            <tr>
                                        @endif
                                    @endforeach
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2>{{ __('Showing') }} {{ $permissions->firstItem()}} {{  __('to') }} {{ $permissions->lastItem()}} {{ __('of') }} {{ $permissions->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        {!! $permissions->render() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>

    <script>

        function change_item(permission_name, role_id) {
            var token = "{{ csrf_token() }}";
            url = "{{ route('change-role-permission-by-module') }}"
            $.ajax({
                url: url,
                type: 'POST',
                data: {"_token": token, "permission_name": permission_name, "role_id": role_id},
                dataType: 'json'
            })
                .done(function (response) {
                    console.log(response);

                    if (response.status == "success") {
                        $.notify(response.message, response.status);
                    } else {
                        $.notify(response.message, "danger");
                    }
                })
                .fail(function () {
                    $.notify('Something went wrong with ajax !', "danger");
                })
        }
    </script>
@endsection
