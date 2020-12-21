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
                        <div class="col-12 col-lg-5">
                            {!!  Form::open(['route'=>'save-new-category','method' => 'post']) !!}
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('add_category') }}</h2>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('select_language') }}*</label>
                                        <select class="form-control" name="language" id="language">
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if(App::getLocale()==$lang->code) Selected
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
                                        <input id="category-name" name="category_name" type="text" class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="category-slug" name="slug" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-desc" class="col-form-label"><b>{{ __('description') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="category-desc" name="meta_description" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-keywords"
                                               class="col-form-label"><b>{{ __('keywords') }}</b> ({{ __('meta_tag') }})</label>
                                        <input id="category-keywords" name="meta_keywords" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category-order" class="col-form-label">{{ __('order') }}</label>
                                        <input id="category-order" value="1" name="order" type="number"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-plus"></i>{{ __('add_category') }}</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-7">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header m-b-20">
                                    <h2>Categories</h2>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>{{ __('category_name') }}</th>
                                            <th>{{ __('language') }}</th>
                                            <th>{{ __('order') }}</th>
                                            @if(Sentinel::getUser()->hasAccess(['category_write']) || Sentinel::getUser()->hasAccess(['category_delete']))
                                                <th>{{ __('options') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($categories as $category)
                                            <tr role="row" class="odd" id="row_{{ $category->id }}">
                                                <td class="sorting_1">{{ $category->id }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->language }}</td>
                                                <td>{{ $category->order }}</td>
                                                @if(Sentinel::getUser()->hasAccess(['category_write']) || Sentinel::getUser()->hasAccess(['category_delete']))
                                                    <td>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">...
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu options-dropdown">
                                                                @if(Sentinel::getUser()->hasAccess(['category_write']))
                                                                    <li>
                                                                        <a href="{{ route('edit-category',['id'=>$category->id]) }}"><i
                                                                                class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if(Sentinel::getUser()->hasAccess(['category_delete']))
                                                                    <li>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="delete_item('categories','{{ $category->id }}')"><i
                                                                                class="fa fa-trash option-icon"></i>{{ __('delete') }}
                                                                        </a>
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
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="block-header">
                                            <h2>{{ __('showing')}} {{ $categories->firstItem()}} {{ __('to') }} {{ $categories->lastItem()}}
                                                of {{ $categories->total()}} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <nav aria-label="Page navigation example">
                                                {!! $categories->render() !!}
                                            </nav>
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
