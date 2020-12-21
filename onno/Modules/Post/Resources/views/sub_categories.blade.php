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
            <form action="#" method="post">
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
                                {!!  Form::open(['route'=>'save-new-sub-category','method' => 'post']) !!}
                                <div class="add-new-page  bg-white p-20 m-b-20">
                                    <div class="block-header">
                                        <h2>{{ __('add_sub_category') }}</h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="language">{{ __('select_language') }}*</label>


                                            <select class="form-control dynamic-category" id="language" name="language"
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
                                            <label for="category_id">{{ __('parent_category') }}*</label>
                                            <select class="form-control dynamic" id="category_id" name="category_id" required>
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
                                            <label for="sub_category-name"
                                                   class="col-form-label">{{ __('sub_category_name') }}*</label>
                                            <input id="sub_category-name" name="sub_category_name" type="text"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="sub_category-slug"
                                                   class="col-form-label"><b>{{ __('slug') }}</b>
                                                ({{ __('slug_message') }})</label>
                                            <input id="sub_category-slug" name="slug" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="sub_category-desc"
                                                   class="col-form-label"><b>{{ __('description') }}</b>
                                                ({{ __('meta_tag') }})</label>
                                            <input id="sub_category-desc" name="meta_description" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="sub_category-keywords"
                                                   class="col-form-label"><b>{{ __('keywords') }}</b>
                                                ({{ __('meta_tag') }})</label>
                                            <input id="sub_category-keywords" name="meta_keywords" type="text"
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
                                                <input type="radio" name="show_on_menu" id="show_on_menu_yes" value="1"
                                                       checked="" class="custom-control-input">
                                                <span class="custom-control-label">{{ __('yes') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="show_on_menu" id="show_on_menu_no" value="0"
                                                       checked="" class="custom-control-input">
                                                <span class="custom-control-label">{{ __('no') }}</span>
                                            </label>
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit" name="btnSubmit"
                                                        class="btn btn-primary pull-right"><i
                                                        class="m-r-10 mdi mdi-plus"></i>{{ __('add_sub_category') }}
                                                </button>
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
                                        <h2>{{ __('sub_categories') }}</h2>
                                    </div>
                                    <div class="table-responsive all-pages">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ __('sub_category_name') }}</th>
                                                <th>{{ __('language') }}</th>
                                                <th>{{ __('parent_category') }}</th>
                                                @if(Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                                    <th>{{ __('options') }}</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($subCategories as $subCategory)
                                                <tr role="row" class="odd" id="row_{{ $subCategory->id }}">
                                                    <td class="sorting_1">{{ $subCategory->id }}</td>
                                                    <td>{{ $subCategory->sub_category_name }}</td>
                                                    <td>{{ $subCategory->language }}</td>
                                                    <td> {{ $subCategory->category['category_name'] }} </td>
                                                    @if(Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">...<span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    @if(Sentinel::getUser()->hasAccess(['sub_category_write']))
                                                                        <li>
                                                                            <a href="{{ route('edit-sub-category',['id'=>$subCategory]) }}"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if(Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_item('sub_categories','{{ $subCategory->id }}')"><i
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
                                                <h2>{{ __('showing')}} {{ $subCategories->firstItem()}} {{ __('to') }} {{ $subCategories->lastItem()}}
                                                    of {{ $subCategories->total()}} {{ __('entries') }}</h2>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 text-right">
                                            <div class="table-info-pagination float-right">
                                                <nav aria-label="Page navigation example">
                                                    {!! $subCategories->render() !!}
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
            </form>
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
