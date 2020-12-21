@extends('common::layouts.master')
@section('social')
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
                                                <h2>{{ __('socials') }}</h2>
                                            </div>
                                        </div>
                                        @if(Sentinel::getUser()->hasAccess(['socials_write']))
                                            <div class="col-6 text-right">
                                                <a href="{{ route('create-social') }}"
                                                   class="btn btn-primary btn-sm btn-add-new"><i
                                                        class="mdi mdi-plus"></i>
                                                    {{ __('create_social') }}
                                                </a>
                                            </div>
                                        @endif
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
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped" role="grid">
                                        <thead>
                                        <tr role="row">
                                            <th width="20">#</th>
                                            <th>{{ __('name') }}</th>
                                            <th>{{ __('url') }}</th>
                                            <th>{{ __('icon') }}</th>
                                            <th>{{ __('icon_bg_color') }}</th>
                                            <th>{{ __('text_bg_color') }}</th>
                                            <th>{{ __('status') }}</th>
                                            @if(Sentinel::getUser()->hasAccess(['socials_write']) || Sentinel::getUser()->hasAccess(['socials_delete']))
                                                <th>{{ __('options') }}</th>
                                            @endif

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($socialMedias as $socialMedia)
                                            <tr id="row_{{ $socialMedia->id }}">
                                                <td>{{ $socialMedia->id }}</td>
                                                <td>{{ $socialMedia->name }}</td>
                                                <td>{{ $socialMedia->url }}</td>
                                                <td><i class="{{ $socialMedia->icon }}" aria-hidden="true"></i></td>
                                                <td>{{ $socialMedia->icon_bg_color }}</td>
                                                <td>{{ $socialMedia->text_bg_color }}</td>
                                                <td>@if($socialMedia->status==1) {{ __('active') }} @else {{ __('inactive') }} @endif</td>

                                                @if(Sentinel::getUser()->hasAccess(['socials_write']) || Sentinel::getUser()->hasAccess(['socials_delete']))
                                                    <td>
                                                        @if(Sentinel::getUser()->hasAccess(['socials_write']))
                                                            <a class="btn btn-light active btn-xs"
                                                               href="{{ route('social-edit',['id'=>$socialMedia->id]) }}"><i
                                                                    class="fa fa-edit"></i>
                                                                {{ __('edit') }}
                                                            </a>
                                                        @endif
                                                        @if(Sentinel::getUser()->hasAccess(['socials_delete']))
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-light active btn-xs"
                                                               onclick="delete_item('social_media','{{ $socialMedia->id }}')"><i
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
                                            <h2>{{ __('Showing') }} {{ $socialMedias->firstItem()}} {{  __('to') }} {{ $socialMedias->lastItem()}} {{ __('of') }} {{ $socialMedias->total()}} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            {!! $socialMedias->render() !!}

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
