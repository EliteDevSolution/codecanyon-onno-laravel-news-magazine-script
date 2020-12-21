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
@section('category-active')
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
                            {!!  Form::open(['route'=>'update-category','method' => 'post']) !!}
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('update_category') }}</h2>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('select_language') }}*</label>
                                        <select class="form-control" name="language" id="language">
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if($category->language==$lang->code) Selected
                                                    @endif value="{{$lang->code}}">{{$lang->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-name" class="col-form-label">{{ __('category_name') }}
                                            *</label>
                                        <input id="category-name" name="category_name"
                                               value="{{ $category->category_name }}" type="text" class="form-control">
                                        <input name="category_id" value="{{ $category->id }}" type="hidden">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="category-slug" name="slug" value="{{ $category->slug }}" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-desc" class="col-form-label"><b>{{ __('description') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="category-desc" name="meta_description"
                                               value="{{ $category->meta_description }}" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-keywords"
                                               class="col-form-label"><b>{{ __('keywords') }}</b> ({{ __('meta_tag') }})</label>
                                        <input id="category-keywords" name="meta_keywords"
                                               value="{{ $category->meta_keywords }}" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-order" class="col-form-label">{{ __('order') }}</label>
                                        <input id="category-order" value="1" value="{{ $category->order }}" name="order"
                                               type="number" class="form-control">
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_category') }}
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

@endsection
