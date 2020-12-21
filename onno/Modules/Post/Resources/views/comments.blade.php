@extends('common::layouts.master')

@section('comments-show')
    show
@endsection

@section('comments')
    active
@endsection

@section('comments_active')
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
                                                <h2>{{ __('comments') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>{{ __('name') }}</th>
                                            <th>{{ __('email') }}</th>
                                            <th>{{ __('post') }}</th>
                                            <th>{{ __('comment') }}</th>
                                            <th>{{ __('comment_at') }}</th>
                                            @if(Sentinel::getUser()->hasAccess(['comments_delete']))
                                                <th>{{ __('options') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($comments as $comment)
                                            <tr role="row" id="row_{{ $comment->id }}" class="odd">
                                                <td class="sorting_1">{{ $comment->id }}</td>
                                                <td>{{ $comment->user->first_name }}</td>
                                                <td>{{ $comment->user->email }}</td>
                                                <td>{{ $comment->post->title }}</td>
                                                <td> {{ $comment->comment }} </td>
                                                <td>
                                                    @if($comment->created_at != null)
                                                        {{ Carbon\Carbon::parse($comment->created_at)->toDayDateTimeString() }}
                                                    @endif
                                                </td>

                                                @if(Sentinel::getUser()->hasAccess(['comments_delete']))
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                           onclick="delete_item('comments','{{ $comment->id }}')"><i
                                                                class="fa fa-trash"></i>
                                                            {{ __('delete') }}
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
                                            <h2>{{ __('Showing') }} {{ $comments->firstItem()}} {{  __('to') }} {{ $comments->lastItem()}} {{ __('of') }} {{ $comments->total()}} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            {!! $comments->render() !!}
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
