@extends('common::layouts.master')
@section('ads-aria-expanded')
    aria-expanded="true"
@endsection
@section('ads-show')
    show
@endsection
@section('ad_location')
    active
@endsection
@section('ads_active')
    active
@endsection

@section('content')


    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'location-update','method' => 'put', 'enctype'=>'multipart/form-data']) !!}
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2>{{ __('ads_location') }}</h2>
                                        </div>
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
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>{{ __('title') }}</th>
                                        <th>{{ __('unique_name') }}</th>
                                        <th>{{ __('ads') }}</th>
                                        <th>{{ __('status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($adLocations as $adLocation)
                                        <tr role="row" id="row_{{ $adLocation->id }}" class="odd">
                                            <td class="sorting_1">{{ $adLocation->id }}</td>
                                            <td>{{ $adLocation->title }}</td>
                                            <td>{{ $adLocation->unique_name }}</td>
                                            <td>
                                                <input name="ad_location_id[]" type="hidden" value="{{ $adLocation->id }}">
                                                <select class="form-control" name="ad_id[]">
                                                    <option value="">{{ __('select_option') }}</option>
                                                    @foreach ($ads as $ad)
                                                        <option @if($ad->id==$adLocation->ad_id) selected @endif value="{{ $ad->id }}">{{ $ad->ad_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="status[]">
                                                    <option @if($adLocation->status==1) selected @endif value="1">{{ __('enable') }}</option>
                                                    <option @if($adLocation->status==0) selected @endif value="0">{{ __('disable') }}</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-right p-t-10">
                                    <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>

@endsection
