@extends('common::layouts.master')

@section('contact_message')
    active
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <form action="#" method="post">
                <div class="admin-section">
                    <div class="row clearfix m-t-30">
                        <div class="col-12">
                            <div class="navigation-list bg-white p-20">
                                <div class="add-new-header clearfix m-b-20">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="block-header">
                                                <h2>{{ __('contact_messages') }}</h2>
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
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ __('name') }}</th>
                                                <th>{{ __('email') }}</th>
                                                <th>{{ __('message') }}</th>
                                                <th>{{ __('send_date') }}</th>
                                                <th>{{ __('status') }}</th>
                                                @if(Sentinel::getUser()->hasAccess(['contact_message_delete']) || Sentinel::getUser()->hasAccess(['contact_message_write'])
                                                    || Sentinel::getUser()->hasAccess(['contact_message_read']))
                                                    <th>{{ __('options') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactMessages as $contactMessage)
                                                <tr role="row" id="row_{{ $contactMessage->id }}" class="odd">
                                                    <td class="sorting_1">{{ $contactMessage->id }}</td>
                                                    <td>{{ $contactMessage->name }}</td>
                                                    <td>{{ $contactMessage->email }}</td>
                                                    <td> {{ $contactMessage->message }} </td>
                                                    <td>{{ $contactMessage->created_at->toDayDateTimeString() }}</td>
                                                    <td>@if($contactMessage->message_seen == 0) {{ __('unseen') }} @else {{ __('seen') }}@endif</td>

                                                    @if(Sentinel::getUser()->hasAccess(['contact_message_delete']) || Sentinel::getUser()->hasAccess(['contact_message_write'])
                                                        || Sentinel::getUser()->hasAccess(['contact_message_read']))
                                                    <td>
                                                        @if(Sentinel::getUser()->hasAccess(['contact_message_read']))
                                                            <a href="javascript:void(0)" class="modal-menu btn btn-light active btn-xs"
                                                                data-title="View Mesage"
                                                                data-url="{{route('edit-info',['page_name'=>'view-message','param1'=>$contactMessage->id])}}"
                                                                data-toggle="modal"
                                                                data-target="#common-modal"><i
                                                                class="fa fa-eye"></i>
                                                                {{ __('view') }}
                                                            </a>
                                                        @endif

                                                        @if(Sentinel::getUser()->hasAccess(['contact_message_write']))
                                                            <a href="javascript:void(0)" class="modal-menu btn btn-light active btn-xs"
                                                                data-title="Reply Message"
                                                                data-url="{{route('edit-info',['page_name'=>'replay-contact-message','param1'=>$contactMessage->id])}}"
                                                                data-toggle="modal"
                                                                data-target="#common-modal">
                                                                <i class="fas fa-reply"></i>
                                                                {{ __('replay') }}
                                                            </a>
                                                        @endif

                                                        @if(Sentinel::getUser()->hasAccess(['contact_message_delete']))
                                                            <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                                onclick="delete_item('contact_messages','{{ $contactMessage->id }}')"><i
                                                                class="fa fa-trash"></i>
                                                                {{ __('delete') }}
                                                            </a>
                                                        @endif
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
                                            <h2>{{ __('Showing') }} {{ $contactMessages->firstItem()}} {{  __('to') }} {{ $contactMessages->lastItem()}} {{ __('of') }}
                                                {{ $contactMessages->total()}} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            {!! $contactMessages->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- page info end-->
        </div>
    </div>

@endsection
