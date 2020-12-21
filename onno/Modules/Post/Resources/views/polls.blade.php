@extends('common::layouts.master')
@section('poll')
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
                                                <h2>{{ __('polls') }}</h2>
                                            </div>
                                        </div>
                                        @if(Sentinel::getUser()->hasAccess(['polls_write']))
                                            <div class="col-6 text-right">
                                                <a href="{{ route('create-poll') }}"
                                                   class="btn btn-primary btn-sm btn-add-new"><i
                                                        class="mdi mdi-plus"></i>
                                                    {{ __('create_poll') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped" role="grid">
                                        <thead>
                                        <tr role="row">
                                            <th width="20">#</th>
                                            <th>{{ __('question') }}</th>
                                            <th>{{ __('auth_required') }}</th>
                                            <th>{{ __('status') }}</th>
                                            <th>{{ __('start_date') }}</th>
                                            <th>{{ __('end_date') }}</th>
                                            <th>{{ __('added_date') }}</th>
                                            @if(Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete']))
                                                <th>{{ __('options') }}</th>
                                            @endif

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($polls as $poll)
                                            <tr id="row_{{ $poll->id }}">
                                                <td>{{ $poll->id }}</td>
                                                <td>{{ $poll->question }}</td>
                                                <td>@if($poll->auth_required==1) {{ __('yes') }} @else {{ __('no') }} @endif</td>
                                                <td>@if($poll->status==1) {{ __('active') }} @else {{ __('inactive') }} @endif</td>
                                                <td>{{ Carbon\Carbon::parse($poll->start_date)->format('F d, Y g:i A') }}</td>
                                                <td>{{ Carbon\Carbon::parse($poll->end_date)->format('F d, Y g:i A') }}</td>
                                                <td>{{ $poll->created_at->toDayDateTimeString() }}</td>
                                                @if(Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete']))
                                                    <td>
                                                        @if(Sentinel::getUser()->hasAccess(['polls_write']))
                                                            <a class="btn btn-light active btn-xs"
                                                               href="{{ route('poll-edit',['id'=>$poll->id]) }}"><i
                                                                    class="fa fa-edit"></i>
                                                                {{ __('edit') }}
                                                            </a>
                                                        @endif
                                                        @if(Sentinel::getUser()->hasAccess(['polls_delete']))
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-light active btn-xs"
                                                               onclick="delete_item('polls','{{ $poll->id }}')"><i
                                                                    class="fa fa-trash"></i>
                                                                {{ __('delete') }}
                                                            </a>
                                                        @endif
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-light active btn-xs modal-menu"
                                                           data-title="{{ $poll->question }}"
                                                           data-url="{{route('edit-info',['page_name'=>'vote-result','param1'=>$poll->id])}}"
                                                           data-toggle="modal"
                                                           data-target="#common-modal"><i
                                                                class="mdi mdi-poll"></i>{{ __('result') }}
                                                        </a>
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
                                            <h2>{{ __('Showing') }} {{ $polls->firstItem()}} {{  __('to') }} {{ $polls->lastItem()}} {{ __('of') }} {{ $polls->total()}} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            {!! $polls->render() !!}

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
