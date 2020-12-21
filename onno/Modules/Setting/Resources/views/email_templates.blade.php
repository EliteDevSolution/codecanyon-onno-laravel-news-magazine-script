@extends('common::layouts.master')

@section('settings')
    aria-expanded="true"
@endsection
@section('s-show')
    show
@endsection
@section('email_temp')
    active
@endsection
@section('settings_active')
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
                                        <h2>{{ __('templates') }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>{{ __('language') }}</th>
                                        <th>{{ __('email_group') }}</th>
                                        <th>{{ __('subject') }}</th>
                                        <th>{{ __('options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($emailTemplates as $template)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $template->id }}</td>
                                                <td class="sorting_1">{{ $template->lang }}</td>
                                                <td>{{ $template->email_group }}</td>
                                                <td>{{ $template->subject }}</td>
                                                <td>
                                                    <a href="{{ route('edit-email-template',['id'=>$template->id]) }}"
                                                       class="btn btn-primary btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
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
