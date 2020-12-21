@extends('common::layouts.master')
@section('language-setting')
    active
@endsection
@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
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
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header m-b-20">
                                    <h2>{{ __('languages')}}</h2>
                                </div>
                                <div class="table-responsive all-pages m-t-20">
                                    <table class="table table-bordered table-striped dataTable no-footer"
                                           id="cs_datatable" role="grid" aria-describedby="cs_datatable_info">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ __('phrase') }}</th>
                                                <th>{{ __('translated_language') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $i=1; @endphp
                                            {!!  Form::open(['route' => ['update-phrase',$langInfo->code], 'method' => 'post']) !!}
                                                @foreach ($langData as $key=> $value)

                                                    <tr role="row" id="row_{{ $key}}" class="odd">
                                                        <td>{{ $i++}}</td>
                                                        <td><input type="text" class="form-control" value="{{ $key }}" disabled
                                                                   id=""></td>
                                                        <td><input type="text" class="form-control" name="{{ $key }}"
                                                                   value="{{ $value }}"></td>
                                                    </tr>
                                                @endforeach

                                                <tr role="row" class="odd">
                                                    <td colspan="3">
                                                        <button type="submit" class="btn btn-primary pull-right">
                                                            <i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update') }}
                                                        </button>
                                                    </td>
                                                </tr>
                                            {{ Form::close() }}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- right sidebar end -->
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>

@endsection
