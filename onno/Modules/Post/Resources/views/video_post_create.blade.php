@extends('common::layouts.master')
@section('post-aria-expanded')
    aria-expanded="true"
@endsection
@section('post-show')
    show
@endsection
@section('post')
    active
@endsection
@section('create_video')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
    @include('gallery::video-gallery')
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => ['save-new-post','video'],'method' => 'post','enctype'=>'multipart/form-data']) !!}
            <input type="hidden" id="images" value="{{ $countImage }}">
            <input type="hidden" id="videos" value="{{ $countVideo }}">
            <input type="hidden" id="imageCount" value="1">
            <input type="hidden" id="videoCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-header clearfix m-b-20">
                        <div class="row">
                            <div class="col-6">
                                <div class="block-header">
                                    <h2>{{ __('add_post') }}</h2>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('post') }}" class="btn btn-primary btn-add-new"><i
                                        class="fas fa-list"></i> {{ __('posts') }}
                                </a>
                            </div>
                        </div>
                    </div>
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
                        <div class="col-12 col-lg-8">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('posts_details') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_title" class="col-form-label">{{ __('title') }}*</label>
                                        <input id="post_title" onkeyup="metaTitleSet()" name="title"
                                               value="{{ old('title') }}" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="post-slug" name="slug" value="{{ old('slug') }}" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <!-- tinemcey start -->
                                <div class="row p-l-15">
                                    <div class="col-12">
                                        <label for="post_content" class="col-form-label">{{ __('content') }}*</label>
                                        <textarea name="content" value="{{ old('content') }}" id="post_content"
                                                  cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- tinemcey end -->
                            </div>
                            <!-- visibility section start -->
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('visibility') }}</h2>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-12 col-md-4">
                                        <div class="form-title">
                                            <label for="visibility">{{ __('visibility') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="visibility" id="visibility_show" checked value="1"
                                                   class="custom-control-input">
                                            <span class="custom-control-label">{{ __('show') }}</span>
                                        </label>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="visibility" id="visibility_hide" value="0"
                                                   class="custom-control-input">
                                            <span class="custom-control-label">{{ __('hide') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="featured_post">{{ __('add_to_featured') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="featured_post" name="featured"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="add_to_breaking">{{ __('add_to_breaking') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="add_to_breaking" name="breaking"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="add_to_slide">{{ __('add_to_slider') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="add_to_slide" name="slider"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="recommended">{{ __('add_to_recommended') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="recommended" name="recommended"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="editor_picks">{{ __('add_to_editor_picks') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="editor_picks" name="editor_picks"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="auth_required">{{ __('show_only_to_authenticate_users') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="auth_required" name="auth_required"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- visibility section end -->
                            <!-- SEO section start -->
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('seo_details') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="meta_title"><b>{{ __('title') }}</b> ({{ __('meta_tag') }})</label>
                                        <input class="form-control" value="{{ old('meta_title') }}" id="meta_title"
                                               name="meta_title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post-keywords" class="col-form-label"><b>{{ __('keywords') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="post-keywords" name="meta_keywords"
                                               value="{{ old('meta_keywords') }}" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_tags" class="col-form-label">{{ __('tags') }}</label>
                                        <input id="post_tags" name="tags" type="text" value="{{ old('tags') }}"
                                               data-role="tagsinput" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_desc"><b>{{ __('description') }}</b> ({{ __('meta_tag') }}
                                            )</label>
                                        <textarea class="form-control" id="meta_description"
                                                  value="{{ old('meta_description') }}" name="meta_description"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- SEO section end -->
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-4">

                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <!-- Upload video tab start -->
                                <div class="add-video-tab">
                                    <nav>
                                        <div class="nav nav-tabs m-b-20" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="upload-video-file" data-toggle="tab"
                                               href="#upload-video" role="tab">{{ __('upload_video') }}</a>
                                            <a class="nav-item nav-link" id="video-link" data-toggle="tab"
                                               href="#video_by_link" role="tab">{{ __('remove_video') }}</a>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="upload-video" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="button" id="btnVideoModal" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target=".video-modal-lg">{{ __('add_video') }}</button>
                                                        <input id="video_id" name="video_id" type="hidden"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    {{-- <label>{{ __('video_preview') }}</label> --}}
                                                    <div class="form-group">
                                                        <div class="form-group text-center">
                                                            <img src="{{static_asset('default-image/default-video-100x100.png') }} "
                                                                 id="video_thumb" width="200"
                                                                 height="200" alt="image"
                                                                 class="img-responsive img-thumbnail">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="video_by_link" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="video_url_type"
                                                               class="col-form-label">{{ __('video_url_type') }}</label>
                                                        <select id="video_url_type" name="video_url_type"
                                                                class="form-control">
                                                            <option value="">{{ __('select_option') }}</option>
                                                            <option value="mp4_url">MP4 url</option>
                                                            <option value="youtube_url">Youtube url</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="video_url"
                                                               class="col-form-label">{{ __('video_url') }}</label>
                                                        <input id="video_url" name="video_url" type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload video tab end -->
                                <div class="form-group">
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-primary btn-image-modal" data-id="2"
                                            data-toggle="modal"
                                            data-target=".image-modal-lg">{{ __('add_video_thumbnail') }}</button>
                                    <input id="video_thumbnail_id" name="video_thumbnail_id" type="hidden"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="form-group text-center">
                                        <img src="{{static_asset('default-image/default-100x100.png') }} " id="video_thumb_preview"
                                             width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                    </div>
                                </div>
                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('post_thumbnail') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- Large modal -->
                                        <div id="image_library_selection">
                                            <button type="button" id="btn_image_modal"
                                                    class="btn btn-primary btn-image-modal" data-id="1"
                                                    data-toggle="modal"
                                                    data-target=".image-modal-lg">{{ __('add_image') }}</button>
                                            <input id="image_id" name="image_id" type="hidden" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group text-center">
                                            <img src="{{static_asset('default-image/default-100x100.png') }} " image-data-id='img1'
                                                 id="image_preview" width="200" height="200" alt="image"
                                                 class="img-responsive img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_language">{{ __('select_language') }}*</label>
                                        <select class="form-control dynamic-category" id="post_language" name="language"
                                        data-dependent="category_id" required>
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if(App::getLocale()==$lang->code) Selected
                                                    @endif value="{{ $lang->code }}">{{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category_id">{{ __('category') }}*</label>
                                       {{--  <select class="form-control dynamic" id="category_id" name="category_id"
                                               data-dependent="sub_category_id" required>
                                            <option value="">{{ __('select_category') }}</option>
                                        </select> --}}

                                        <select class="form-control dynamic" id="category_id" name="category_id"
                                                data-dependent="sub_category_id" required>
                                            <option value="">{{ __('select_category') }}</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category_id">{{ __('sub_category') }}*</label>
                                        <select class="form-control dynamic" id="sub_category_id" name="sub_category_id"
                                                required>
                                            <option value="">{{ __('select_sub_category') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('publish') }}*</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select class="form-control" id="post_status" name="status" required>
                                            <option value="1">{{ __('published') }}</option>
                                            <option value="0">{{ __('draft') }}</option>
                                            <option value="2">{{ __('scheduled') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 divScheduleDate">
                                    <label for="scheduled_date">{{ __('schedule_date') }}</label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="scheduled_date"><i
                                                class="fa fa-calendar-alt"></i></label>
                                        <input type="text" class="form-control date" id="scheduled_date"
                                               name="scheduled_date"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="custom-control" for="btnSubmit"></label>
                                        <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                                class="m-r-10 mdi mdi-plus"></i>{{ __('create_post') }}</button>
                                        <label class="" for="btnSubmit"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right sidebar end -->
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- page info end-->
        </div>
    </div>





@endsection
@section('script')


    <script>
        $(document).ready(function () {

           $('.dynamic-category').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ route('category-fetch') }}",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });


            $('#post_language').change(function () {
                $('#category_id').val('');
                $('#sub_category_id').val('');
            });

            $('.dynamic').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ route('subcategory-fetch') }}",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });


            $('#category').change(function () {
                $('#sub_category_id').val('');
            });
        });
    </script>

    <script type="text/javascript" src="{{static_asset('js/post.js') }}"></script>
    <script src="{{static_asset('js/tagsinput.js')}}"></script>
@endsection
