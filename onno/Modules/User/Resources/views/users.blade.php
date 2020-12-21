<!-- msater layout -->
@extends('common::layouts.master')
<!-- active menu -->
@section('users_management')
    active
@endsection
<!--  -->
@section('users_management_')
    aria-expanded="true"
@endsection
@section('u-show')
    show
@endsection
@section('user-list')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
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
                                <div class="row">
                                    <div class="block-header col-6">
                                        <h2>{{ __('users') }}</h2>
                                    </div>
                                    @if(Sentinel::getUser()->hasAccess(['users_write']))
                                        <div class="col-6 text-right">
                                            <a href="{{route('user-create')}}" class="btn btn-primary btn-sm"><i
                                                    class="m-r-10 mdi mdi-account-plus"></i>{{__('add_user')}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>{{ __('avatar') }}</th>
                                            <th>{{ __('name') }}</th>
                                            <th>{{ __('email') }}</th>
                                            <th>{{ __('role') }}</th>
                                            <th>{{ __('status') }}</th>
                                            <th>{{ __('join_date') }}</th>
                                            @if(Sentinel::getUser()->hasAccess(['users_read']) || Sentinel::getUser()->hasAccess(['users_write']))
                                                <th>{{ __('options') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)

                                        @if($user->withActivation != null)

                                            <tr role="row" id="row_{{ $user->id }}" class="odd">
                                                <td class="sorting_1">{{ $user->id}}</td>
                                                <td>
                                                    @if(isFileExist(@$user->image, @$user->image->thumbnail))
                                                        <img
                                                            src=" {{basePath($user->image)}}/{{ $user->image->thumbnail }} "
                                                            data-src="{{basePath($user->image)}}/{{ $user->image->thumbnail }}"
                                                            height="64" width="64" alt="{{$user->first_name}}"
                                                            class="img-responsive rounded-circle user-image">
                                                    @else
                                                        <img src="{{static_asset('default-image/user.jpg') }}" height="64"
                                                             width="64" alt="{{$user->first_name}}" class="img-responsive rounded-circle">
                                                    @endif
                                                </td>
                                                <td>{{ $user->first_name}} {{$user->last_name}}</td>
                                                <td>
                                                    {{$user->email}}
                                                    @if($user->withActivation->completed==0)
                                                        <small class="text-warning">({{ __('unconfirmed') }})</small>
                                                    @else
                                                        <small class="text-success">({{ __('confirmed') }})</small>
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    @foreach ($user->withRoles as $role)
                                                        <label class="label label-default">{{$role->name}}</label>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if($user->withActivation->completed==0)
                                                        <label class="label btn-warning">{{ __('inactive') }}</label>
                                                    @else
                                                        @if($user->is_user_banned == 0)
                                                            <label class="label label-danger">{{ __('banned') }}</label>
                                                        @else
                                                            <label class="label label-success">{{ __('active') }}</label>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{$user->created_at->toDayDateTimeString()}}</td>
                                                @if(Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_delete']))
                                                    <td>
                                                        @if($user->id != 1)
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">... <span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    @if(Sentinel::getUser()->hasAccess(['users_write']))
                                                                        @if(Sentinel::getUser()->id != $user->id)
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               class="btn-list-button modal-menu"
                                                                               data-title="Change User Role"
                                                                               data-url="{{route('edit-info',['page_name'=>'role-change','param1'=>$user->id,'param2'=> $user->withRoles[0]->id])}}"
                                                                               data-toggle="modal"
                                                                               data-target="#common-modal">
                                                                                <i class="fa fa-user option-icon"></i>
                                                                                {{ __('change_role') }}
                                                                            </a>
                                                                        </li>
                                                                        <li>

                                                                            @if($user->withActivation->completed==1)
                                                                            
                                                                                @if($user->is_user_banned == 1)
                                                                                    <a href="{{ route('ban-user',['user_id'=> $user->id]) }}"><i
                                                                                            class="fa fa-stop-circle option-icon"></i>{{ __('ban_user') }}
                                                                                    </a>
                                                                                @else
                                                                                    <a href="{{ route('unban-user',['user_id'=> $user->id]) }}"><i
                                                                                            class="fa fa-stop-circle option-icon"></i>{{ __('unban_user') }}
                                                                                    </a>
                                                                                @endif

                                                                            @endif
                                                                            
                                                                        </li>
                                                                        @endif
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="modal-menu"
                                                                               data-title="Edit User Info"
                                                                               data-url="{{route('edit-info',['page_name'=>'edit-user','param1'=>$user->id,'param2'=> $user->withRoles[0]->id])}}"
                                                                               data-toggle="modal"
                                                                               data-target="#common-modal"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if(Sentinel::getUser()->hasAccess(['users_delete']))
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_item('users','{{ $user->id }}')"><i
                                                                                    class="fa fa-trash option-icon"></i>{{ __('delete') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        @endif

                                                    </td>
                                                @endif
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2>{{ __('Showing') }} {{ $users->firstItem()}} {{  __('to') }} {{ $users->lastItem()}} {{ __('of') }} {{ $users->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        {!! $users->render() !!}

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
@endsection
