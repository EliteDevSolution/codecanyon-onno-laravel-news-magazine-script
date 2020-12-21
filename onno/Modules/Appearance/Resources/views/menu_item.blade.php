@extends('common::layouts.master')
@section('appearance')
    active
@endsection
@section('appearance-aria-expanded')
    aria-expanded=true
@endsection
@section('menu')
    active
@endsection
@section('appearance-show')
    show
@endsection
@section('style')
    <link rel="stylesheet" href="{{static_asset('nestable/nestable.css')}}">
@endsection
@section('content')

     <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row clearfix">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#edit-menu" role="tab" aria-controls="nav-home" aria-selected="true">{{__('edit_menu')}}</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#manage-menu" role="tab" aria-controls="nav-profile" aria-selected="false">{{__('menu_location')}}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="edit-menu" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-white p-20 m-b-20">
                                        {!!  Form::open(['route' => 'search-menu-item','method' => 'get','class' => 'form-inline']) !!}
                                            <div class="form-group menu-select">
                                                <label for="menu_id" class="col-form-label">{{ __('menu') }}</label>
                                                <select name="menu_id" id="menu_id" class="form-control">
                                                    @foreach ($menus as $menu)
                                                        <option @if($selectedMenus->id==$menu->id) selected @endif  value="{{ $menu->id }}">{{ $menu->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group menu-select">
                                                <label for="selecttedLanguage" class="col-form-label language">{{ __('language') }}</label>
                                                <select class="form-control" name="language" id="selecttedLanguage">
                                                    @foreach ($activeLang as  $lang)
                                                    <option
                                                        @if($selectedLanguage==$lang->code) Selected
                                                        @endif value="{{$lang->code}}">{{$lang->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group ml-3">
                                                <button  class="btn btn-primary" type="submit">{{__('select_menu')}}</button>
                                            </div>
                                            <a href="javascript:void(0)" class="modal-menu"data-title="{{ __('add_menu') }}"
                                                   data-url="{{ route('edit-info',['page_name'=>'add-menu']) }}"
                                                   data-toggle="modal" data-target="#common-modal"> {{ __('create_new_menu') }}</a>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="add-new-page  bg-white p-20 m-b-20" id=div_menu_create>
                                    {!!  Form::open(['route' => 'add-menu', 'method' => 'post']) !!}
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="title" class="col-form-label">{{ __('title') }}</label>
                                                    <input type="text" class="form-control" name="title" id="title">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="language" class="col-form-label">{{ __('language') }}</label>
                                                    <select class="form-control" name="language" id="language">
                                                        @foreach ($activeLang as  $lang)
                                                        <option
                                                            @if(settingHelper('default_language')==$lang->code) Selected
                                                            @endif value="{{$lang->code}}">{{$lang->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="btnSubmit" class="col-form-label"> &nbsp;</label>
                                                    <button type="submit" id="btnSubmit" class="form-control btn btn-light " >{{ __('create') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                    </div>
                                </div>

                                <div class="col-md-12">
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
                                <div class="col-4">
                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                        <div class="accrodion-regular">
                                            <div id="accordion3">
                                                <div class="card mb-2">
                                                    <div class="card-header" id="headingSeven">
                                                        <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                                            <span class="fas fa-angle-down mr-3"></span>{{ __('custom') }}
                                                        </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion3">
                                                        <div class="card-body">
                                                            {!!  Form::open(['route' => 'save-menu-item','method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                                                                @csrf
                                                                <div class="row clearfix">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <!-- Main Content section start -->
                                                                            <div class="col-12 col-lg-12">
                                                                                <div class="add-new-page  bg-white p-20 m-b-20">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group">
                                                                                                <label for="label" class="col-form-label">{{ __('label') }}*</label>
                                                                                                <input id="label" name="label" value="{{ old('label') }}"
                                                                                                    type="text" class="form-control" required>
                                                                                                <input type="hidden" name="menu_id" value="{{ $selectedMenus->id }}">
                                                                                                <input id="source" name="source" type="hidden" value="custom" class="form-control" required>
                                                                                                <input id="language" name="language" type="hidden" value="{{ $selectedLanguage }}" class="form-control" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group">
                                                                                                <label for="url" class="col-form-label">{{ __('url') }}</label>
                                                                                                <input id="url" name="url" value="{{ old('url') }}"
                                                                                                    type="text" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-12 m-t-20">
                                                                                            <div class="form-group form-float form-group-sm text-right">
                                                                                                <button type="submit" name="btn" class="btn btn-primary pull-right">
                                                                                                    <i class="m-r-10 fa fa-plus"></i>{{ __('add_menu_item') }}
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Main Content section end -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-2">
                                                    <div class="card-header" id="headingEight">
                                                        <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                            <span class="fas fa-angle-down mr-3"></span>{{ __('pages') }}
                                                        </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion3">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                {!!  Form::open(['route' => 'save-menu-item','method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                                                                    @csrf
                                                                    <div class="row clearfix">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <!-- Main Content section start -->
                                                                                <div class="col-12 col-lg-12">
                                                                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                                                                        @if($pages->count() > 0)
                                                                                            <div class="row page-area">
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="form-group">
                                                                                                        <input id="source" name="source"
                                                                                                            type="hidden" value="page" class="form-control" required>
                                                                                                        <input type="hidden" name="menu_id" value="{{ $selectedMenus->id }}">
                                                                                                        <input type="hidden" name="language" value="{{ $selectedLanguage }}">
                                                                                                         <span>{{ __('must_select') }}*</span>
                                                                                                        @foreach ($pages as $page)
                                                                                                            <label class="custom-control custom-checkbox">
                                                                                                                <input type="checkbox" name="page_id[]" value="{{ $page->id }}" class="custom-control-input">
                                                                                                                <span class="custom-control-label">{{ $page->title }}</span>
                                                                                                            </label>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-12 m-t-20">
                                                                                                    <div class="form-group form-float form-group-sm text-right">
                                                                                                        <button type="submit" name="btn" class="btn btn-primary pull-right">
                                                                                                            <i class="m-r-10 fa fa-plus"></i>{{ __('add_menu_item') }}
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            {{ __('no_page_available') }}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Main Content section end -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-2">
                                                    <div class="card-header" id="headingNine">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                            <span class="fas fa-angle-down mr-3"></span>{{ __('posts') }} </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion3">
                                                        <div class="card-body">
                                                            {!!  Form::open(['route' => 'save-menu-item','method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                                                                @csrf
                                                                <div class="row clearfix">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <!-- Main Content section start -->
                                                                                <div class="col-12 col-lg-12">
                                                                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                                                                        @if($posts->count() > 0)
                                                                                            <div class="row post-area">
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="form-group">
                                                                                                        <input id="source" name="source" value="post" type="hidden" class="form-control" required>
                                                                                                        <input type="hidden" name="menu_id" value="{{ $selectedMenus->id }}">
                                                                                                        <input type="hidden" name="languale" value="{{ $selectedLanguage }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="form-group">
                                                                                                        <span>{{ __('must_select') }}*</span>
                                                                                                        @foreach ($posts as $post)
                                                                                                            <label class="custom-control custom-checkbox">
                                                                                                                <input type="checkbox" name="post_id[]" value="{{ $post->id }}" class="custom-control-input">
                                                                                                                <span class="custom-control-label">{{ Str::limit($post->title, 40) }}</span>
                                                                                                            </label>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                            <div class="col-12 m-t-20">
                                                                                                <div class="form-group form-float form-group-sm text-right">
                                                                                                    <button type="submit" name="btn" class="btn btn-primary pull-right">
                                                                                                        <i class="m-r-10 fa fa-plus"></i>{{ __('add_menu_item') }}
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @else
                                                                                            {{ __('no_post_available') }}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Main Content section end -->
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mb-2">
                                                    <div class="card-header" id="headingTen">
                                                        <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                                            <span class="fas fa-angle-down mr-3"></span>{{ __('categories') }}
                                                        </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion3">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                {!!  Form::open(['route' => 'save-menu-item','method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                                                                    @csrf
                                                                    <div class="row clearfix">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <!-- Main Content section start -->
                                                                                <div class="col-12 col-lg-12">
                                                                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                                                                        @if($categories->count() > 0)
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="form-group">
                                                                                                        <span>{{ __('must_select') }}*</span>
                                                                                                        <input id="source" name="source" type="hidden" value="category" class="form-control" required>
                                                                                                        <input type="hidden" name="menu_id" value="{{ $selectedMenus->id }}">
                                                                                                        <input type="hidden" name="language" value="{{ $selectedLanguage }}">

                                                                                                            @foreach ($categories as $category)
                                                                                                                <label class="custom-control custom-checkbox">
                                                                                                                    <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="custom-control-input">
                                                                                                                    <span class="custom-control-label">{{ $category->category_name }}</span>
                                                                                                                </label>
                                                                                                            @endforeach
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row">
                                                                                            <div class="col-12 m-t-20">
                                                                                                <div class="form-group form-float form-group-sm text-right">
                                                                                                    <button type="submit" name="btn"  class="btn btn-primary pull-right">
                                                                                                        <i class="m-r-10 fa fa-plus"></i>{{ __('add_menu_item') }}
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @else
                                                                                            {{__('no_category_available')}}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Main Content section end -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    {!!  Form::open(['route' => 'update-menu-item','method' => 'post', 'enctype'=>'multipart/form-data', 'id' => 'update-menu-item']) !!}
                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="cf nestable-lists">
                                                    <label for="menu_id" class="col-form-label">{{ __('menu_item') }}({{ __('drag_drop_menu_item_for_rearrange') }})</label>
                                                    <div class="dd" id="nestable3">
                                                        <ol class="dd-list">
                                                            @foreach ($menuItems as $item)
                                                                @if(count($item->children)==0)
                                                                    <li class="dd-item dd3-item" id="{{ $item->id }}" data-id="{{ $item->id }}">
                                                                        {{-- define category --}}
                                                                        <input type="hidden" name="source" id="source" value="{{@$item->source}}">
                                                                        <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
                                                                        <div class="dd-handle dd3-handle"></div>
                                                                        <div class="dd3-content">{{ $item->label }}
                                                                            <!-- expand menu item start -->
                                                                            <div id="" class="expend-icon pull-right">
                                                                                <i class="fa fa-fw fa-sort-down"></i>
                                                                            </div>
                                                                            <div class="expended-menu-item hide-menu-item">
                                                                                <div class="form-group">
                                                                                    <label for="label-{{ $item->id }}" class="col-form-label">{{ __('label') }}</label>
                                                                                    <input id="label-{{ $item->id }}" name="label[]" value="{{ $item->label }}" type="text" class="form-control" required>
                                                                                    <input name="menu_item_id[]" value="{{ $item->id }}" type="hidden" class="form-control">
                                                                                </div>
                                                                                @if($item->source == 'custom')
                                                                                    <div class="form-group">
                                                                                        <label for="order" class="col-form-label">{{ __('url') }}</label>
                                                                                        <input id="order" name="url[]" value="{{ $item->url }}" type="text" class="form-control">
                                                                                    </div>
                                                                                @endif
                                                                                <div class="form-group">
                                                                                    <label class="custom-control custom-checkbox">
                                                                                        <input type="hidden" name="new_teb[]" value="{{ $item->new_teb }}"><input type="checkbox" class="custom-control-input" @if($item->new_teb==1) checked @endif onclick="this.previousSibling.value=1-this.previousSibling.value">
                                                                                        <span class="custom-control-label">{{ __('open_in_new_teb') }}</span>
                                                                                    </label>
                                                                                </div>

                                                                                <div class="form-group" id="mega-menu-area">
                                                                                    <label for="is_mega_menu" class="col-form-label">{{ __('is_mega_menu') }}</label>
                                                                                    <select name="is_mega_menu[]" id="is_mega_menu" class="form-control">
                                                                                        <option value="no" {{$item->is_mega_menu == 'no'?'selected':''}}>{{ __('no') }}</option>
                                                                                        <option value="tab" {{$item->is_mega_menu == 'tab'?'selected':''}}>{{ __('tab_type') }}</option>
                                                                                        <option value="category" {{$item->is_mega_menu == 'category'?'selected':''}}>{{ __('category_type') }}</option>

                                                                                    </select>
                                                                                </div>
                                                                                @if(Sentinel::getUser()->hasAccess(['menu_delete']))
                                                                                <div class="form-group">
                                                                                    <a href="javascript:void(0)" onclick="delete_menu_item('{{ $item->id }}')"
                                                                                       class="text-danger"> {{ __('delete_menu_item') }}</a>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                            <!-- expand menu item end -->
                                                                        </div>
                                                                    </li>
                                                                @else
                                                                    <li class="dd-item dd3-item" id="{{ $item->id }}" data-id="{{ $item->id }}">
                                                                         {{-- define category --}}
                                                                        <input type="hidden" name="source" id="source" value="{{@$item->source}}">
                                                                        <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="1">
                                                                        <div class="dd-handle dd3-handle"></div>
                                                                        <div class="dd3-content">{{ $item->label }}
                                                                        <!-- expand menu item start -->
                                                                            <div id="" class="expend-icon pull-right">
                                                                                <i class="fa fa-fw fa-sort-down"></i>
                                                                            </div>
                                                                            <div class="expended-menu-item hide-menu-item">
                                                                                <div class="form-group">
                                                                                    <label for="label-{{ $item->id }}" class="col-form-label">{{ __('label') }}</label>
                                                                                    <input id="label-{{ $item->id }}" name="label[]" value="{{ $item->label }}" type="text" class="form-control" required>
                                                                                    <input name="menu_item_id[]" value="{{ $item->id }}" type="hidden" class="form-control">
                                                                                </div>
                                                                                @if($item->source == 'custom')
                                                                                    <div class="form-group">
                                                                                        <label for="order" class="col-form-label">{{ __('url') }}</label>
                                                                                        <input id="order" name="url[]" value="{{ $item->url }}" type="text" class="form-control">
                                                                                    </div>
                                                                                @endif
                                                                                <div class="form-group">
                                                                                    <label class="custom-control custom-checkbox">
                                                                                        <input type="hidden" name="new_teb[]" value="{{ $item->new_teb }}"><input type="checkbox" class="custom-control-input" @if($item->new_teb==1) checked @endif onclick="this.previousSibling.value=1-this.previousSibling.value">
                                                                                        <span class="custom-control-label">{{ __('open_in_new_teb') }}</span>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-group" id="mega-menu-area" >
                                                                                    <label for="menu_id" class="col-form-label" >{{ __('is_mega_menu') }}</label>
                                                                                    <select name="is_mega_menu[]" id="is_mega_menu" class="form-control">
                                                                                            <option value="no" {{$item->is_mega_menu == 'no'?'selected':''}}>{{ __('no') }}</option>
                                                                                            <option value="tab" {{$item->is_mega_menu == 'tab'?'selected':''}}>{{ __('tab_type') }}</option>
                                                                                            <option value="category" {{$item->is_mega_menu == 'category'?'selected':''}}>{{ __('category_type') }}</option>
                                                                                    </select>
                                                                                </div>
                                                                                @if(Sentinel::getUser()->hasAccess(['menu_delete']))
                                                                                <div class="form-group">
                                                                                    <a href="javascript:void(0)" onclick="delete_menu_item('{{ $item->id }}')"
                                                                                    class="text-danger"> {{ __('delete_menu_item') }}</a>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        <!-- expand menu item end -->
                                                                        </div>
                                                                        <ol class="dd-list">
                                                                            @foreach ($item->children as $child)
                                                                                @if(count($child->children)==0)
                                                                                    <li class="dd-item dd3-item" id="{{ $child->id }}" data-id="{{ $child->id }}">
                                                                                         {{-- define category --}}
                                                                                        <input type="hidden" name="source" id="source" value="{{@$item->source}}">

                                                                                        <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="2">

                                                                                        <div class="dd-handle dd3-handle"></div>
                                                                                        <div class="dd3-content">{{ $child->label }}
                                                                                        <!-- expand menu item start -->
                                                                                            <div id="" class="expend-icon pull-right"><i class="fa fa-fw fa-sort-down"></i></div>
                                                                                            <div class="expended-menu-item hide-menu-item">

                                                                                                <div class="form-group">
                                                                                                    <label for="label-{{ $child->id }}" class="col-form-label">{{ __('label') }}</label>
                                                                                                    <input id="label-{{ $child->id }}" name="label[]" value="{{ $child->label }}" type="text" class="form-control" required>
                                                                                                    <input name="menu_item_id[]" value="{{ $child->id }}" type="hidden" class="form-control">
                                                                                                </div>
                                                                                                @if($child->source == 'custom')
                                                                                                    <div class="form-group">
                                                                                                        <label for="order" class="col-form-label">{{ __('url') }}</label>
                                                                                                        <input id="order" name="url[]" value="{{ $child->url }}" type="text" class="form-control">
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div class="form-group">
                                                                                                    <label class="custom-control custom-checkbox">
                                                                                                        <input type="hidden" name="new_teb[]" value="{{ $child->new_teb }}"><input type="checkbox" class="custom-control-input" @if($child->new_teb==1) checked @endif onclick="this.previousSibling.value=1-this.previousSibling.value">
                                                                                                        <span class="custom-control-label">{{ __('open_in_new_teb') }}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-group" id="mega-menu-area" >
                                                                                                    <label for="menu_id" class="col-form-label" >{{ __('is_mega_menu') }}</label>
                                                                                                    <select name="is_mega_menu[]" id="is_mega_menu" class="form-control">
                                                                                                            <option value="no">{{ __('no') }}</option>
                                                                                                            <option value="tab">{{ __('tab_type') }}</option>
                                                                                                            <option value="category">{{ __('category_type') }}</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                @if(Sentinel::getUser()->hasAccess(['menu_delete']))
                                                                                                <div class="form-group">
                                                                                                    <a href="javascript:void(0)" onclick="delete_menu_item('{{ $child->id }}')"
                                                                                                    class="text-danger"> {{ __('delete_menu_item') }}</a>
                                                                                                </div>
                                                                                                @endif
                                                                                            </div>
                                                                                            <!-- expand menu item end -->
                                                                                        </div>
                                                                                    </li>
                                                                                @else
                                                                                <li class="dd-item dd3-item" id="{{ $child->id }}" data-id="{{ $child->id }}">
                                                                                     {{-- define category --}}
                                                                                    <input type="hidden" name="source" id="source" value="{{@$item->source}}">
                                                                                    <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="2">
                                                                                        <div class="dd-handle dd3-handle"></div><div class="dd3-content">{{ $child->label }}
                                                                                        <!-- expand menu item start -->
                                                                                            <div id="" class="expend-icon pull-right"><i class="fa fa-fw fa-sort-down"></i></div>
                                                                                            <div class="expended-menu-item hide-menu-item">
                                                                                                <div class="form-group">
                                                                                                    <label for="label-{{ $child->id }}" class="col-form-label">{{ __('label') }}</label>
                                                                                                    <input id="label-{{ $child->id }}" name="label[]" value="{{ $child->label }}" type="text" class="form-control" required>
                                                                                                    <input name="menu_item_id[]" value="{{ $child->id }}" type="hidden" class="form-control">
                                                                                                </div>
                                                                                                @if($child->source == 'custom')
                                                                                                    <div class="form-group">
                                                                                                        <label for="order" class="col-form-label">{{ __('url') }}</label>
                                                                                                        <input id="order" name="url[]" value="{{ $child->url }}" type="text" class="form-control">
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div class="form-group">
                                                                                                    <label class="custom-control custom-checkbox">
                                                                                                        <input type="hidden" name="new_teb[]" value="{{ $child->new_teb }}"><input type="checkbox" class="custom-control-input" @if($child->new_teb==1) checked @endif onclick="this.previousSibling.value=1-this.previousSibling.value">
                                                                                                        <span class="custom-control-label">{{ __('open_in_new_teb') }}</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-group" id="mega-menu-area">
                                                                                                    <label for="menu_id" class="col-form-label" >{{ __('is_mega_menu') }}</label>
                                                                                                    <select name="is_mega_menu[]" id="is_mega_menu" class="form-control">
                                                                                                            <option value="no">{{ __('no') }}</option>
                                                                                                            <option value="tab">{{ __('tab_type') }}</option>
                                                                                                            <option value="category">{{ __('category_type') }}</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                @if(Sentinel::getUser()->hasAccess(['menu_delete']))
                                                                                                <div class="form-group">
                                                                                                    <a href="javascript:void(0)" onclick="delete_menu_item('{{ $child->id }}')"
                                                                                                    class="text-danger"> {{ __('delete_menu_item') }}</a>
                                                                                                </div>
                                                                                                @endif
                                                                                            </div>
                                                                                        <!-- expand menu item end -->
                                                                                        </div>
                                                                                        <ol class="dd-list">
                                                                                            @foreach ($child->children as $subChild)
                                                                                                <li class="dd-item dd3-item" id="{{ $subChild->id }}" data-id="{{ $subChild->id }}">
                                                                                                     {{-- define category --}}
                                                                                                    <input type="hidden" name="source" id="source" value="{{@$item->source}}">

                                                                                                    <input type="hidden" name="menu_lenght[]" id="menu_lenght" value="3">

                                                                                                    <div class="dd-handle dd3-handle"></div>
                                                                                                    <div class="dd3-content">{{ $subChild->label }}
                                                                                                        <!-- expand menu item start -->
                                                                                                        <div id="" class="expend-icon pull-right"><i class="fa fa-fw fa-sort-down"></i></div>
                                                                                                        <div class="expended-menu-item hide-menu-item">
                                                                                                            <div class="form-group">
                                                                                                                <label for="label-{{ $subChild->id }}" class="col-form-label">{{ __('label') }}</label>
                                                                                                                <input id="label-{{ $subChild->id }}" name="label[]" value="{{ $subChild->label }}" type="text" class="form-control" required>
                                                                                                                <input name="menu_item_id[]" value="{{ $subChild->id }}" type="hidden" class="form-control">
                                                                                                            </div>
                                                                                                            @if($subChild->source == 'custom')
                                                                                                                <div class="form-group">
                                                                                                                    <label for="order" class="col-form-label">{{ __('url') }}</label>
                                                                                                                    <input id="order" name="url[]" value="{{ $subChild->url }}" type="text" class="form-control">
                                                                                                                </div>
                                                                                                            @endif
                                                                                                             <div class="form-group">
                                                                                                                <label class="custom-control custom-checkbox">
                                                                                                                    <input type="hidden" name="new_teb[]" value="{{ $subChild->new_teb }}"><input type="checkbox" class="custom-control-input" @if($subChild->new_teb==1) checked @endif onclick="this.previousSibling.value=1-this.previousSibling.value">
                                                                                                                    {{-- <input type="checkbox" name="new_teb[]" @if($subChild->new_teb==0) value="0" @else value="1" checked  @endif class="custom-control-input"> --}}
                                                                                                                    <span class="custom-control-label">{{ __('open_in_new_teb') }}</span>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <div class="form-group" id="mega-menu-area" >
                                                                                                                <label for="menu_id" class="col-form-label" >{{ __('is_mega_menu') }}</label>
                                                                                                                <select name="is_mega_menu[]" id="is_mega_menu" class="form-control">
                                                                                                                        <option value="no">{{ __('no') }}</option>
                                                                                                                        <option value="tab">{{ __('tab_type') }}</option>
                                                                                                                        <option value="category">{{ __('category_type') }}</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            @if(Sentinel::getUser()->hasAccess(['menu_delete']))
                                                                                                            <div class="form-group">
                                                                                                                <a href="javascript:void(0)" onclick="delete_menu_item('{{ $subChild->id }}')"
                                                                                                                class="text-danger"> {{ __('delete_menu_item') }}</a>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <!-- expand menu item end -->
                                                                                                    </div>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ol>
                                                                                </li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ol>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @if(Sentinel::getUser()->hasAccess(['menu_delete']))

                                                <div class="">
                                                    <a href="javascript:void(0)"
                                                    onclick="delete_item('menu','{{ $selectedMenus->id }}')" class="text-danger">{{ __('delete_this_menu') }}</a>
                                                </div>
                                                @endif

                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right">
                                                    <button class="btn btn-primary" type="submit">{{ __('update') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="manage-menu" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="add-new-page  bg-white p-20 m-b-20" >
                                        <div class="table-responsive all-pages">
                                            {!!  Form::open(['route' => 'save-menu-locations','method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>{{ __('title') }}</th>
                                                            <th>{{ __('menu') }}</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($menuLocations as $menuLocation)
                                                        <tr role="row" class="odd">
                                                            <td>{{ $menuLocation->title }}</td>
                                                            <td>
                                                                <input name="menu_location_id[]" type="hidden" value="{{ $menuLocation->id }}">
                                                                <select class="form-control" name="menu_id[]">
                                                                    <option value="">{{ __('select_option') }}</option>
                                                                    @foreach ($menus as $menu)
                                                                        <option @if($menu->id==$menuLocation->menu['id']) selected @endif value="{{ $menu->id }}">{{ $menu->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td><a href="javascript:void(0)" class="modal-menu"data-title="{{ __('add_menu') }}"
                                                                data-url="{{ route('edit-info',['page_name'=>'add-menu']) }}"
                                                                data-toggle="modal" data-target="#common-modal"> {{ __('create_new_menu') }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                                                </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="{{static_asset('nestable/jquery.nestable.js') }}"></script>
<script src="{{static_asset('nestable/custom.js') }}"></script>



<script type="text/javascript">


        function delete_menu_item(row_id) {
            var table_row = '#' + row_id
            var token =  "{{ csrf_token() }}";
            url = "{{ route('delete-menu-item') }}"

            swal({
                title: "{{ __('are_you_sure?') }}",
                text: "{{ __('it_will_be_deleted_permanently') }}",
                icon: "warning",
                buttons: true,
                buttons: ["{{ __('cancel') }}", "{{ __('delete') }}"],
                dangerMode: true,
                closeOnClickOutside: false
                })
            .then(function(confirmed){
                if (confirmed){
                     $.ajax({
                        url: url,
                        type: 'delete',
                        data: 'row_id=' + row_id + '&_token='+token,
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal.stopLoading();
                        if(response.status == "success"){
                            swal("{{ __('deleted') }}!", response.message, response.status);
                            $(table_row).fadeOut(2000);
                        }else{
                            swal("Error!", response.message, response.status);
                        }
                     })
                     .fail(function(){
                        swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                     })
                }
            })
        }
    </script>

@endsection
