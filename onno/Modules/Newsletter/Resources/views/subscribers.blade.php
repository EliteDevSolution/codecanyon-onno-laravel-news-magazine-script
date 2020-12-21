@extends('common::layouts.master')
@section('newsletter-aria-expanded')
    aria-expanded="true"
@endsection
@section('newsletter-show')
    show
@endsection
@section('subscriber')
    active
@endsection
@section('newsletter_active')
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
                                        <h2>{{ __('subscribers') }}</h2>
                                    </div>
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
                                            @if(Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_write']))
                                                <th>{{ __('options') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)

                                            <tr role="row" id="row_{{ $user->id }}" class="odd">
                                                <td class="sorting_1">{{ $user->id}}</td>
                                                <td>
                                                    @if(isFileExist($user->image, @$user->image->thumbnail))
                                                        <img
                                                            src=" {{basePath($user->image)}}/{{ $user->image->thumbnail }} "
                                                            height="64" width="64" class="img-fluid" alt="user"
                                                            class="img-responsive rounded-circle">
                                                    @else
                                                        <img src="{{static_asset('default-image/user.jpg') }} " height="64"
                                                             width="64" class="img-fluid" alt="user"
                                                             class="img-responsive rounded-circle">
                                                    @endif
                                                </td>
                                                <td>{{ $user->first_name}} {{$user->last_name}}</td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-xs btn-info modal-menu"
                                                       data-title="{{ __('send_email') }}"
                                                       data-url="{{ route('edit-info',['page_name'=>'send-email','param1'=>$user->id]) }}"
                                                       data-toggle="modal"
                                                       data-target="#common-modal">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                        {{ __('send_email') }}
                                                    </a>
                                                </td>
                                                <td>
                                                    
                                                    @if($user->is_subscribe_banned == 0)
                                                        <label class="label btn-warning">{{ __('inactive') }}</label>
                                                    @else
                                                        <label class="label label-success">{{ __('active') }}</label>
                                                    @endif
                                                </td>
                                                <td>{{$user->created_at->toDayDateTimeString()}}</td>
                                                @if(Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_delete']))
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">... <span
                                                                    class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu options-dropdown">
                                                                @if(Sentinel::getUser()->hasAccess(['users_write']))
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
                                                                            
                                                                        @if($user->is_subscribe_banned == 1)
                                                                            <a href="{{ route('ban-subscribe',['user_id'=> $user->id]) }}"><i
                                                                                    class="fa fa-stop-circle option-icon"></i>{{ __('inactive') }}
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route('unban-subscribe',['user_id'=> $user->id]) }}"><i
                                                                                    class="fa fa-stop-circle option-icon"></i>{{ __('active') }}
                                                                            </a>
                                                                        @endif

                                                                            
                                                                        </li>
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
                                                    </td>
                                                @endif
                                            </tr>
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
