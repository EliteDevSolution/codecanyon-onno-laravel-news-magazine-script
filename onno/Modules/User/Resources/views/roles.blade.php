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
                                                    <a href="{{ route('new-role-add') }}"
                                                       class="btn btn-primary btn-sm"><i
                                                            class="m-r-10 mdi mdi-plus"></i>{{ __('add_role') }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 pt-3">
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
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>{{ __('role') }}</th>
                                        <th>{{ __('permissions') }}</th>
                                        @if(Sentinel::getUser()->hasAccess(['role_read']) || Sentinel::getUser()->hasAccess(['role_write']))
                                            <th>{{ __('options') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $role)

                                        <tr role="row" id="row_{{ $role->id }}">
                                            <td><strong>{{ $role->name }}</strong></td>
                                            <td height="50">

                                                @if(!empty($role->permissions))
                                                    @foreach ($permissionss[$role->slug] as $key=>$value)
                                                        <label class="label label-default">{{ $value}}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            @if(Sentinel::getUser()->hasAccess(['role_read']) || Sentinel::getUser()->hasAccess(['role_write']))
                                                <td>
                                                    @if($role->id != 1)
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">... <span
                                                                    class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu options-dropdown">
                                                                @if(Sentinel::getUser()->hasAccess(['users_write']))
                                                                    <li>
                                                                        <a href="{{ route('user.edit-role-and-permissions',['id'=>$role->id]) }}"><i
                                                                                class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if(Sentinel::getUser()->hasAccess(['role_delete']) && Sentinel::getUser()->hasAccess(['permission_write']))
                                                                @if($role->id != 1 && $role->id != 4 && $role->id != 5)
                                                                    <li>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="delete_item('roles','{{ $role->id }}')"><i
                                                                                class="fa fa-trash option-icon"></i>{{ __('delete') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>

@endsection
