@extends('common::layouts.master')
@section('sections')
    active
@endsection

@section('content')

            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- page info start-->
                        <div class="row clearfix">
                            <div class="col-12">
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
                                    <!-- Main Content section start -->
                                    <div class="col-12 col-lg-12">
                                        {!!  Form::open(['route'=>'update-theme-section','method' => 'post', 'id' => 'save-new-section']) !!}
                                            <div class="add-new-page  bg-white p-20 m-b-20">
                                                <div class="block-header">
                                                    <h2>{{ __('update_section') }}</h2>
                                                </div>

                                                {{-- <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="section_label" class="col-form-label">{{ __('section_label') }} *</label>
                                                        <input id="section_label" name="label" value="{{ $section->label }}" type="text" class="form-control" required> --}}
                                                        <input name="theme_section_id" value="{{ $section->id }}" type="hidden" class="form-control" required>
                                                    {{-- </div>
                                                </div> --}}
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="type">{{ __('type') }}</label>
                                                        <select class="form-control" name="type" id="type" required>
                                                            
                                                                <option value="{{\Modules\Appearance\Enums\ThemeSectionType::CATEGORY}}" {{ $section->type == 1? 'selected':'' }}>{{ __('category') }}</option>
                                                                <option value="{{\Modules\Appearance\Enums\ThemeSectionType::VIDEO}}" {{ $section->type == 2? 'selected':'' }}>{{ __('video') }}</option>
                                                                <option value="{{\Modules\Appearance\Enums\ThemeSectionType::LATEST_POST}}" {{ $section->type == 3? 'selected':'' }}>{{ __('latest_post') }}</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 {{ $section->type != 1? 'd-none':'' }}" id="category-area">
                                                    <div class="form-group">
                                                        <label for="category_id">{{ __('category') }}</label>
                                                        <select class="form-control" name="category_id" id="category_id" {{ $section->type == 1? 'required':'' }}>
                                                            <option value="">{{ __('select_category') }}</option>
                                                            @foreach ($categories as $category)
                                                                <option @if($section->category_id==$category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="category-order" class="col-form-label">{{ __('order') }}</label>
                                                        <input id="category-order"  value="{{ $section->order }}" name="order" type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row p-l-15">
                                                    <div class="col-12 col-md-4">
                                                    <div class="form-title">
                                                            <label for="status">{{ __('status') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-md-2">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="status" id="status_yes" @if($section->status===1) checked @endif value="1" class="custom-control-input">
                                                            <span class="custom-control-label">{{ __('active') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-3 col-md-2">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="status" id="status_no" @if($section->status===0) checked @endif value="0" class="custom-control-input">
                                                            <span class="custom-control-label">{{ __('inactive') }}</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row p-l-15 {{ $section->type == 3? 'd-none':'' }}" id="section-style">
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-title">
                                                            <label for="section_style">{{ __('section_style') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row p-l-15">
                                                        <div class="col-12 col-md-4">
                                                            <div class="section_section_style">
                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" name="section_style" id="section_section_style_1" @if($section->section_style=="style_1") checked @endif value="style_1" class="custom-control-input">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                                <img src="{{static_asset('default-image/Section/Section_1.png') }}" alt="" class="img-responsive cat-block-img">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="section_section_style">
                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" name="section_style" id="section_section_style_2" @if($section->section_style=="style_2") checked @endif value="style_2" class="custom-control-input">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                                <img src="{{static_asset('default-image/Section/Section_2.png') }}" alt="" class="img-responsive cat-block-img">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="section_section_style">
                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" name="section_style" id="section_section_style_3" @if($section->section_style=="style_3") checked @endif value="style_3" class="custom-control-input">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                                <img src="{{static_asset('default-image/Section/Section_3.png') }}" alt="" class="img-responsive cat-block-img">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="section_section_style">
                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" name="section_style" id="section_section_style_4" value="style_4" @if($section->section_style=="style_4") checked @endif class="custom-control-input">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                                <img src="{{static_asset('default-image/Section/Section_4.png') }}" alt="" class="img-responsive cat-block-img">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="section_section_style">
                                                                <label class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" name="section_style" id="section_section_style_5" value="style_5" @if($section->section_style=="style_5") checked @endif class="custom-control-input">
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                                <img src="{{static_asset('default-image/Section/Section_5.png') }}" alt="" class="img-responsive cat-block-img">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12" id="ad-area">
                                                        <div class="form-group">
                                                            <label for="language">{{ __('show_ad_in_bottom') }}?</label>
                                                            <select class="form-control" name="ad" id="ad">
                                                                <option value="">{{ __('none') }}</option>
                                                                @foreach ($ads as $value => $ad)
                                                                    <option value="{{$ad->id}}" {{$section->ad_id == $ad->id? 'selected':''}}>{{$ad->ad_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 m-t-20">
                                                        <div class="form-group form-float form-group-sm text-right">
                                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-plus"></i>{{ __('update_section') }}</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        {!! Form::close() !!}
                                        </div>
                                    <!-- Main Content section end -->
                                </div>
                            </div>
                        </div>
                    <!-- page info end-->
                </div>
            </div>

@endsection
