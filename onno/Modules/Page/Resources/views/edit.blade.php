@extends('common::layouts.master')
@section('pages')
    active
@endsection
@section('page-aria-expanded')
    aria-expanded=true
@endsection
@section('pages-list')
    active
@endsection
@section('page-show')
    show
@endsection
@section('modal')
    @include('gallery::image-gallery')
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => ['update_page', $page->id],'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" id="images" value="{{ $countImage }}">
            <input type="hidden" id="imageCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('add_page') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('pages') }}" class="btn btn-primary btn-add-new btn-sm"><i
                                            class="fas fa-arrow-left"></i>
                                        {{ __('back_to_pages') }}
                                    </a>
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

                </div>

                <div class="col-8">
                    <div class="add-new-page  bg-white p-20 m-b-20">

                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('page_content') }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label">{{ __('title') }}</label>
                                <input id="page-title" value="{{ $page->title }}" name="title" type="text"
                                       class="form-control" required>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                    ({{ ('slug_message') }})</label>
                                <input id="page-slug" value="{{ $page->slug }}" name="slug" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="language" class="col-form-label">{{ __('language') }}</label>
                                <select class="form-control" name="language" id="language">
                                    @foreach ($activeLang as  $lang)
                                        <option
                                            @if($page->language==$lang->code) Selected
                                            @endif value="{{$lang->code}}">{{$lang->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page_type" class="col-form-label">{{ __('page_type') }}</label>
                                <select name="page_type" id="page_type" class="form-control">
                                    <option value="1" {{ $page->page_type==1?"selected":"" }}>{{__('default')}}</option>
                                    <option
                                        value="2" {{ $page->page_type==2?"selected":"" }}>{{__('contact_us')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 {{ $page->page_type==1? '':'d-none' }}" id="description">
                            <div class="form-group">
                                <label for="content" class="col-form-label">{{ __('description') }}</label>
                                <textarea name="description" id="content"
                                          class="form-control">{!! html_entity_decode($page->description) !!}</textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-4">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('page_layout') }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="template" class="col-form-label">{{ __('template') }}</label>
                                <select name="template" id="template" class="form-control">
                                    <option
                                        value="1" {{ $page->template==1?"selected":"" }}>{{__('without_sidebar')}}</option>
                                    <option
                                        value="2" {{ $page->template==2?"selected":"" }}>{{__('with_right_sidebar')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label for="template" class="col-form-label">{{ __('feature_image') }}</label>
                            <div class="form-group text-center">
                                {{-- <img src="{{static_asset('default-image/default.jpg') }} " id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">  --}}
                                @if(isFileExist($page->image, @$page->image->thumbnail))
                                    <img src=" {{basePath($page->image)}}/{{ $page->image->thumbnail }} "
                                         id="image_preview" width="200" height="200"
                                         class="img-responsive img-thumbnail" alt="{!! $page->title !!}">
                                @else
                                    <img src="{{static_asset('default-image/default-100x100.png') }} " id="image_preview" width="200"
                                         height="200" class="img-responsive img-thumbnail" alt="{!! $page->title !!}">
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal"
                                        data-id="1" data-toggle="modal" data-target=".image-modal-lg">Add Image
                                </button>
                                <input id="image_id" name="image_id" type="hidden" class="form-control">
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('visibility') }}</h4>
                            </div>
                        </div>
                        <div class="row p-l-15">

                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="visibility">{{ __('visibility') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="visibility" id="visibility_show" value="1"
                                           @if ($page->visibility==1)
                                           checked
                                           @endif class="custom-control-input">
                                    <span class="custom-control-label">{{ __('show') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="visibility" id="visibility_hide"
                                           @if ($page->visibility==0)
                                           checked
                                           @endif
                                           value="0" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('hide') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="show_for_register">{{ __('show_only_to_registered_users') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_for_register"
                                           @if ($page->show_for_register==1)
                                           checked
                                           @endif id="show_only_registerd_user_enable" value="1"
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('yes') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_for_register"
                                           @if ($page->show_for_register==0)
                                           checked
                                           @endif id="show_only_registerd_user_desable" value="0"
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('no') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="show_title">{{ __('show_title') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_title"
                                           @if ($page->show_title==1)
                                           checked
                                           @endif id="show_title_enable" value="1" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('yes') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_title"
                                           @if ($page->show_title==0)
                                           checked
                                           @endif id="show_title_desable" value="0" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('no') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="breadcrumb">{{ __('show_breadcrumb') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_breadcrumb"
                                           @if ($page->show_breadcrumb==1)
                                           checked
                                           @endif id="show_breadcumb_enable" value="1" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('yes') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_breadcrumb"
                                           @if ($page->show_breadcrumb==0)
                                           checked
                                           @endif id="show_breadcumb_desable" value="0" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('no') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="show_right_colmn">{{ __('show_right_column') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_right_column"
                                           @if ($page->show_right_column==1)
                                           checked
                                           @endif id="show_right_column_enable" value="1" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('yes') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="show_right_column"
                                           @if ($page->show_right_column==0)
                                           checked
                                           @endif id="show_right_column_desable" value="0" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('no') }}</span>
                                </label>
                            </div>
                        </div>


                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="location">{{ __('show_on_menu') }}</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="location"
                                           @if ($page->location=='top')
                                           checked
                                           @endif id="menu_location_top" value="top" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('top_menu') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="location"
                                           @if ($page->location=='mainmenu')
                                           checked
                                           @endif id="menu_location_main" value="mainmenu" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('main_menu') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="location"
                                           @if ($page->location=='footer')
                                           checked
                                           @endif id="menu_location_footer" value="footer" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('footer') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="location" @if ($page->location=='none')
                                    checked
                                           @endif id="menu_location_none" value="none" class="custom-control-input">
                                    <span class="custom-control-label">{{ __('do_not_add_to_menu') }}</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('seo') }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="title-meta" class="col-form-label"><b>{{ __('title') }}</b>
                                    ({{ __('meta_tag') }})</label>
                                <input id="title-meta" name="meta_title" value="{{ $page->meta_title }}" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-meta" class="col-form-label"><b>{{ __('description') }}</b>
                                    ({{ __('meta_tag') }})</label>
                                <input id="page-meta" name="meta_description" value="{{ $page->meta_description }}"
                                       type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-keywords" class="col-form-label"><b>{{ __('keywords') }}</b>
                                    ({{ __('meta_tag') }})</label>
                                <input id="page-keywords" name="meta_keywords" value="{{ $page->meta_keywords }}"
                                       type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="m-r-10 mdi mdi-content-save-all"></i> {{ __('update_page') }}
                                    </button>
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
