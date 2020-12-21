@extends('common::layouts.master')
@section('appearance')
    active
@endsection
@section('appearance-aria-expanded')
    aria-expanded=true
@endsection
@section('theme')
    active
@endsection
@section('appearance-show')
    show
@endsection

@section('content')

     <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                       <div class="navigation-list bg-white p-20">
                           <div class="block-header">
                                <h2>{{ __('select_current_theme') }}</h2>
                            </div>
                            {!!  Form::open(['route'=>'update-current-theme','method' => 'post']) !!}
                           <div class="row p-l-15">
                            {{-- @foreach ($themes as $theme) --}}
                                <div class="col-12 col-md-4">
                                    <div class="category-block-box">
                                        <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="block_style" id="theme_{{ $themes[0]->id }}" value="{{ $themes[0]->id}}" @if($themes[0]->currtent===1) checked @endif class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    <img src="{{static_asset('default-image/theme/theme_1.png') }}" alt="" class="img-responsive cat-block-img">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="category-block-box">
                                        <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="block_style" id="theme_{{ $themes[0]->id }}" value="{{ $themes[0]->id}}" @if($themes[0]->currtent===1) checked @endif class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                        <img src="{{static_asset('default-image/theme/theme_2.png') }}" alt="" class="img-responsive cat-block-img">
                                    </div>
                                </div>
                            {{-- @endforeach --}}
                        </div>
                        <div class="row">
                            <div class="col-12 m-t-20">
                                <div class="form-group form-float form-group-sm text-right">
                                    <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update') }}</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
