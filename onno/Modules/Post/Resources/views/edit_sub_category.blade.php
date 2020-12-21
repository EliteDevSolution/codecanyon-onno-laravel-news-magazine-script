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
@section('sub-category-active')
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
                            {!!  Form::open(['route'=>'update-sub-category','method' => 'post']) !!}
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('update_sub_category') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('select_language') }}*</label>
                                        <select class="form-control  dynamic-category" name="language" id="language" 
                                        data-dependent="category_id" required>
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if($subCategory->language==$lang->code) Selected
                                                    @endif value="{{$lang->code}}">{{$lang->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="parent_cat">{{ __('parent_category') }}*</label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="">{{ __('select_category') }}</option>
                                            @foreach ($categories as $category)
                                                <option @if($subCategory->category_id==$category->id) Selected
                                                        @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category-name"
                                               class="col-form-label">{{ __('sub_category_name') }}*</label>
                                        <input id="sub_category-name" value="{{ $subCategory->sub_category_name }}"
                                               name="sub_category_name" type="text" class="form-control" required>
                                        <input value="{{ $subCategory->id }}" name="sub_category_id" type="hidden"
                                               required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="sub_category-slug" value="{{ $subCategory->slug }}" name="slug"
                                               type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category-desc"
                                               class="col-form-label"><b>{{ __('description') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="sub_category-desc" value="{{ $subCategory->meta_description }}"
                                               name="meta_description" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category-keywords"
                                               class="col-form-label"><b>{{ __('keywords') }}</b> ({{ __('meta_tag') }})</label>
                                        <input id="sub_category-keywords" name="meta_keywords"
                                               value="{{ $subCategory->meta_keywords }}" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="row p-l-15">
                                    <div class="col-12 col-md-4">
                                        <div class="form-title">
                                            <label for="show_on_menu">{{ __('show_on_menu') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="show_on_menu"
                                                   @if($subCategory->show_on_menu==1) checked
                                                   @endif id="show_on_menu_yes" value="1" checked=""
                                                   class="custom-control-input">
                                            <span class="custom-control-label">{{ __('yes') }}</span>
                                        </label>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="show_on_menu" id="show_on_menu_no" value="0"
                                                   @if($subCategory->show_on_menu==0) checked
                                                   @endif class="custom-control-input">
                                            <span class="custom-control-label">{{ __('no') }}</span>
                                        </label>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_sub_category') }}
                                            </button>
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

            $('#language').change(function () {
                $('#category_id').val('');
            });
        });
    </script>
@endsection

@endsection
