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
@section('breaking-post-active')
    active
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route'=>'update-breaking-order','method' => 'post','enctype'=>'multipart/form-data']) !!}
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2>{{ __('breaking_posts') }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                              
                            <!-- Table Filter -->
                                <table class="table table-bordered table-striped" role="grid">
                                    <thead>
                                    <tr role="row">
                                        {{-- <th width="20">
                                            <input type="checkbox" class="checkbox-table" id="checkAll">
                                        </th> --}}
                                        <th width="20">#</th>
                                        <th>{{ __('post') }}</th>
                                        <th>{{ __('language') }}</th>
                                        <th>{{ __('post_type') }}</th>
                                        <th>{{ __('category') }}</th>
                                        <th>{{ __('post_by') }}</th>
                                        <th>{{ __('visibility') }}</th>
                                        <th>{{ __('order') }}</th>
                                        <th>{{ __('view') }}</th>
                                        <th>{{ __('added_date') }}</th>
                                        @if(Sentinel::getUser()->hasAccess(['post_write']))
                                            <th>{{ __('options') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($posts as $post)
                                        <tr id="row_{{ $post->id }}">
                                            {{-- <td>
                                                <input type="checkbox" id="table-checkbox" name="checkbox-table" class="filled-in chk-col-deep-purple" value="{{ $post->id }}">
                                                <label for="table-checkbox"></label>
                                            </td> --}}
                                            <td>{{ $post->id }}</td>
                                            <td>
                                                <div class="post-image">
                                                    @if(isFileExist(@$post->image, @$post->image->thumbnail))
                                                        <img
                                                            src=" {{basePath($post->image)}}/{{ $post->image->thumbnail }} "
                                                            data-src="{{basePath($post->image)}}/{{ $post->image->thumbnail }}"
                                                            alt="image" class="img-responsive img-thumbnail lazyloaded">

                                                    @else
                                                        <img src="{{static_asset('default-image/default-100x100.png') }} " width="200"
                                                             height="200" alt="image"
                                                             class="img-responsive img-thumbnail">
                                                    @endif
                                                </div> {{ $post->title }} </td>
                                            <td>{{ $post->language }} </td>
                                            <td class="td-post-type">{{ $post->post_type }}</td>
                                            <td>
                                                <label class="category-label m-r-5 label-table" id="breaking-post-bgc">
                                                    {{ $post->category['category_name'] }} </label>

                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="table-user-link">
                                                    <strong>
                                                        @php
                                                            $roles=Sentinel::findById($post->user_id)->roles->first();
                                                        @endphp
                                                        {{ $roles->name }}
                                                    </strong>
                                                </a>
                                            </td>
                                            <td class="td-post-sp">
                                                @if($post->visibility==1)
                                                    <label class="label label-success label-table"><i
                                                            class="fa fa-eye"></i></label>
                                                @else
                                                    <label class="label label-default label-table"><i
                                                            class="fa fa-eye-slash"></i></label>
                                                @endif
                                                @if($post->breaking==1)
                                                    <label class="label bg-red label-table">{{ __('breaking') }}</label>
                                                @endif
                                                @if($post->featured==1)
                                                    <label
                                                        class="label bg-warning label-table">{{ __('featured') }}</label>
                                                @endif
                                                @if($post->recommended==1)
                                                    <label
                                                        class="label bg-aqua label-table">{{ __('recommended') }}</label>
                                                @endif
                                                @if($post->editor_picks==1)
                                                    <label class="label bg-teal label-table">{{ __('editor_picks') }}</label>
                                                @endif
                                                @if($post->slider==1)
                                                    <label class="label bg-teal label-table">{{ __('slider') }}</label>
                                                @endif
                                            </td>
                                            <td width="10%">
                                                <input type="number" class="form-control btn btn-light" name="order[]"
                                                       value="{{ $post->breaking_order }}">
                                                <input type="hidden" class="btn btn-light" name="post_id[]"
                                                       value="{{ $post->id }}">
                                            </td>
                                            <td>{{ $post->total_hit }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            @if(Sentinel::getUser()->hasAccess(['post_write']))
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       onclick="remove_post_form('other','breaking','{{ $post->id }}')"
                                                       name="option" class="btn btn-light active btn-xs">
                                                        <i class="fa fa-minus option-icon"></i>{{ __('remove') }} </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2>{{ __('Showing') }} {{ $posts->firstItem()}} {{  __('to') }} {{ $posts->lastItem()}} {{ __('of') }} {{ $posts->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        {!! $posts->render() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Sentinel::getUser()->hasAccess(['post_write']))
                            <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_order') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- page info end-->
        </div>
    </div>

@endsection
