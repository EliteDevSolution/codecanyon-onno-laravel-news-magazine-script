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
                            <div class="col-12 col-lg-5">
                                {!!  Form::open(['route'=>'save-new-section','method' => 'post', 'id' => 'save-new-section']) !!}
                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                        <div class="block-header">
                                            <h2>{{ __('add_section') }}</h2>
                                        </div>


                                        {{-- <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="section_label" class="col-form-label">{{ __('section_label') }}</label>
                                                <input id="section_label" name="label" type="text" class="form-control" required>
                                            </div>
                                        </div> --}}

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="type">{{ __('type') }}</label>
                                                <select class="form-control" name="type" id="type" required>
                                                    
                                                        <option value="{{\Modules\Appearance\Enums\ThemeSectionType::CATEGORY}}" selected>{{ __('category') }}</option>
                                                        <option value="{{\Modules\Appearance\Enums\ThemeSectionType::VIDEO}}">{{ __('videos') }}</option>
                                                        <option value="{{\Modules\Appearance\Enums\ThemeSectionType::LATEST_POST}}">{{ __('latest_post') }}</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12" id="category-area">
                                            <div class="form-group">
                                                <label for="category_id">{{ __('category') }}</label>
                                                <select class="form-control" name="category_id" id="category_id" required>
                                                    <option value="">{{ __('select_category') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="category-order" class="col-form-label">{{ __('order') }}</label>
                                                <input id="category-order" value="1" name="order" type="number" class="form-control">
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
                                                    <input type="radio" name="status" id="status_yes" value="1" checked class="custom-control-input">
                                                    <span class="custom-control-label">{{ __('active') }}</span>
                                                </label>
                                            </div>
                                            <div class="col-3 col-md-2">
                                                <label class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" name="status" id="status_no" value="0" class="custom-control-input">
                                                    <span class="custom-control-label">{{ __('inactive') }}</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row p-l-15" id="section-style">
                                            <div class="col-12 col-md-12">
                                                <div class="form-title">
                                                    <label for="section_style">{{ __('section_style') }}</label>
                                                </div>
                                            </div>
                                            <div class="row p-l-15">
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_1" value="style_1" checked class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="{{static_asset('default-image/Section/Section_1.png') }}" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_2" value="style_2" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="{{static_asset('default-image/Section/Section_2.png') }}" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_3" value="style_3" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="{{static_asset('default-image/Section/Section_3.png') }}" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_4" value="style_4" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="{{static_asset('default-image/Section/Section_4.png') }}" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_5" value="style_5" class="custom-control-input">
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
                                                            <option value="{{$ad->id}}">{{$ad->ad_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 m-t-20">
                                                <div class="form-group form-float form-group-sm text-right">
                                                    <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-plus"></i>{{ __('add_section') }}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                {!! Form::close() !!}
                                </div>
                            <!-- Main Content section end -->

                            <!-- right sidebar start -->
                            <div class="col-12 col-lg-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="add-new-page  bg-white p-20 m-b-20">
                                            <div class="block-header m-b-20">
                                                <h2>{{ __('primary_section') }}</h2>
                                            </div>
                                            {!!  Form::open(['route'=>'update-primary-section','method' => 'post']) !!}
                                                <div class="row p-l-15">

                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_1" value="style_1" @if($primarySection->section_style == "style_1") checked="" @endif class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <img src="{{static_asset('default-image/primary_section/Style_1.png') }}" alt="image" class="img-responsive cat-block-img">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_2" value="style_2" @if($primarySection->section_style == "style_2") checked="" @endif class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <img src="{{static_asset('default-image/primary_section/Style_2.png') }}" alt="image" class="img-responsive cat-block-img">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_3" value="style_3" @if($primarySection->section_style == "style_3") checked="" @endif class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <img src="{{static_asset('default-image/primary_section/Style_3.png') }}" alt="image" class="img-responsive cat-block-img">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_none" value="" @if($primarySection->section_style == null) checked="" @endif class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <span>{{ __('none') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 m-t-20">
                                                        <div class="form-group form-float form-group-sm text-right">
                                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_section') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="add-new-page  bg-white p-20 m-b-20">
                                            <div class="block-header m-b-20">
                                            <h2>{{ __('sections') }}</h2>
                                            </div>
                                            <div class="table-responsive all-pages">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>{{ __('section_label') }}</th>
                                                            <th>{{ __('status') }}</th>
                                                            <th>{{ __('show_ad_in_bottom') }}</th>
                                                            <th>{{ __('order') }}</th>
                                                            <th>{{ __('section_style') }}</th>
                                                            @if(Sentinel::getUser()->hasAccess(['theme_section_write']) || Sentinel::getUser()->hasAccess(['theme_section_delete']))
                                                            <th>{{ __('options') }}</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <form action="{{route('update-section-order')}}" method="post">
                                                        @csrf
                                                        @foreach ($sections as $section)
                                                        <input type="hidden" name="sections[]" value="{{$section->id}}">
                                                            <tr role="row" class="odd" id="row_{{ $section->id }}">
                                                                <td>{{ $section->type == 1? $section->label: __($section->label) }}</td>
                                                                <td>
                                                                    @if($section->status == 1)
                                                                        <label class="label label-success label-table">{{ __('active') }}</label>
                                                                    @else
                                                                        <label class="label label-default label-table">{{ __('inactive') }}</i></label>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $section->ad->ad_name ?? __('none') }}</td>
                                                                <td><input type="number" name="orders[{{$section->id}}]" class="form-control" value="{{ $section->order }}"></td>
                                                                <td>{{ $section->section_style }}</td>
                                                                @if(Sentinel::getUser()->hasAccess(['theme_section_write']) || Sentinel::getUser()->hasAccess(['theme_section_delete']))
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-primary dropdown-toggle btn-select-option" type="button" data-toggle="dropdown">...
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                @if(Sentinel::getUser()->hasAccess(['theme_section_write']))
                                                                                    <li>
                                                                                        <a href="{{ route('edit-theme-section',['id'=>$section->id]) }}"><i class="fa fa-edit option-icon"></i>{{ __('edit') }}</a>
                                                                                    </li>
                                                                                @endif
                                                                                @if(Sentinel::getUser()->hasAccess(['theme_section_delete']))
                                                                                    <li>
                                                                                        <a href="javascript:void(0)" onclick="delete_item('theme_sections','{{ $section->id }}')"><i class="fa fa-trash option-icon"></i>{{ __('delete') }}</a>
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
                                                <div class="row mb-3">
                                                    <div class="col-12 m-t-20">
                                                        <div class="form-group form-float form-group-sm text-right">
                                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="block-header">
                                                        <h2>{{ __('showing')}} {{ $sections->firstItem()}} {{ __('to') }} {{ $sections->lastItem()}}
                                                            of {{ $sections->total()}} {{ __('entries') }}</h2>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 text-right">
                                                    <div class="table-info-pagination float-right">
                                                        <nav aria-label="Page navigation example">
                                                            {!! $sections->render() !!}
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
