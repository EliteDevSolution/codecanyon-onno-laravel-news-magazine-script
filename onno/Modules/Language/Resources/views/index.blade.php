@extends('common::layouts.master')
@section('language-setting')
    active
@endsection
@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            @if(session('error'))
                <div id="error_m" class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div id="success_m" class="alert alert-success">
                    {{ session('success') }}
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

            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-5">
                            {!!  Form::open(['route' => 'set-default-language', 'method' => 'post']) !!}

                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('default_language') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('language') }}</label>
                                        <select class="form-control" name="default_language" id="language">
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if(settingHelper('default_language')==$lang->code) Selected
                                                    @endif value="{{$lang->code}}">{{$lang->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="status" value="1" class="btn btn-primary pull-right">
                                                <i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save_changes')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}

                            @if(Sentinel::getUser()->hasAccess(['language_settings_write']))
                                <div class="add-new-page  bg-white p-20 m-b-20">
                                    <div class="block-header">
                                        <div>
                                        <span class="text-warning">{{ __('please_make_sure_you_have_set_writable_permision_following_folder') }}</span>
                                        </div>
                                        <strong><span>./resources/lang</span></strong>

                                        <h2>{{ __('add_language') }}</h2>
                                    </div>
                                    {!!  Form::open(['route' => 'add-new-language', 'method' => 'post']) !!}

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">{{ __('language_name') }}*</label>
                                            <input id="name" name="name" type="text" value="{{ old('name') }}"
                                                   class="form-control" placeholder="{{ __('language_name') }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="code" class="col-form-label">{{ __('short_form') }}*</label>
                                            <input id="code" name="code" type="text" value="{{ old('code') }}"
                                                   class="form-control" placeholder="en" maxlength='5' minlength='2'
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="icon_class" class="col-form-label">{{ __('flag') }}*</label>
                                            <select name="icon_class" class="form-control selectpicker text-uppercase"
                                                    required>
                                                <option value=""> {{ __('select_option') }}</option>
                                                @foreach ($flagIcons as $icon)
                                                    <option value="{{ $icon->icon_class }}"
                                                            data-icon="{{ $icon->icon_class }}"
                                                            class=""> {{ $icon->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="script" class="col-form-label">{{ __('script') }}</label>
                                            <input id="script" name="script" type="text" value="{{ old('script') }}"
                                                   class="form-control" placeholder="Latn">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="native" class="col-form-label">{{ __('native') }}</label>
                                            <input id="native" name="native" type="text" value="{{ old('native') }}"
                                                   class="form-control" placeholder="English">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="regional" class="col-form-label">{{ __('regional') }}</label>
                                            <input id="regional" name="regional" type="text"
                                                   value="{{ old('regional') }}" class="form-control"
                                                   placeholder="en_GB">
                                        </div>
                                    </div>

                                    <div class="row p-l-15">
                                        <div class="col-12 col-md-4">
                                            <div class="form-title">
                                                <label for="text_direction">{{ __('text_direction') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="text_direction"
                                                       id="text_direction_left_to_right" value="LTR"
                                                       class="custom-control-input" checked="checked">
                                                <span class="custom-control-label">{{ __('ltr') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="text_direction"
                                                       id="text_direction_right_to_left" value="RTL"
                                                       class="custom-control-input">
                                                <span class="custom-control-label">{{ __('rtl') }}</span>
                                            </label>
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
                                                <input type="radio" name="status" id="status_active" value="active"
                                                       class="custom-control-input" checked="checked">
                                                <span class="custom-control-label">{{ __('active') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="status" id="status_inactive" value="inactive"
                                                       class="custom-control-input">
                                                <span class="custom-control-label">{{ __('inactive') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right"><i
                                                        class="m-r-10 mdi mdi-plus"></i>{{ __('add_language') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}

                                </div>
                            @endif
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-7">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header m-b-20">
                                    <h2>{{ __('languages') }}</h2>
                                </div>
                                <div class="table-responsive all-pages m-t-20">
                                    <table class="table table-bordered table-striped dataTable no-footer"
                                           id="cs_datatable" role="grid" aria-describedby="cs_datatable_info">
                                        <thead>
                                            <tr role="row">
                                                <th>{{ __('language_name') }}</th>
                                                <th>{{ __('code') }}</th>
                                                <th>{{ __('status') }}</th>
                                                @if(Sentinel::getUser()->hasAccess(['language_settings_write']) || Sentinel::getUser()->hasAccess(['language_settings_delete']))
                                                    <th>{{ __('options') }}</th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($languages as $lang)
                                                <tr role="row" class="odd" id="row_{{ $lang->id }}">
                                                    <td><i class="{{ $lang->icon_class }}"></i> {{$lang->name}}&nbsp;</td>
                                                    <td>{{$lang->code}}</td>
                                                    <td><label
                                                            class="label @if($lang->status=='active') label-success @else label-danger  @endif lbl-lang-status">{{$lang->status}}</label>
                                                    </td>
                                                    @if(Sentinel::getUser()->hasAccess(['language_settings_write']) || Sentinel::getUser()->hasAccess(['language_settings_delete']))
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-expanded="false">{{ __('...') }} <span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    @if(Sentinel::getUser()->hasAccess(['language_settings_write']))
                                                                        <li>
                                                                            <a href="{{ route('edit-language-info',['id'=>$lang->id]) }}"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('edit-phrase-list',['id'=>$lang->id]) }}"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('edit_phrase') }}
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('edit-default-messages',['id'=>$lang->id]) }}"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('default_messages') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif

                                                                    @if(Sentinel::getUser()->hasAccess(['language_settings_delete']))
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_language('{{ $lang->id }}')"><i
                                                                                    class="fa fa-trash option-icon"></i>{{ __('delete')}}
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
                                            <h2>{{ __('showing')}} {{ $languages->firstItem()}} {{ __('to') }} {{ $languages->lastItem()}}
                                                of {{ $languages->total()}} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <nav aria-label="Page navigation example">
                                                {!! $languages->render() !!}
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
    <script type="text/javascript">
        function delete_language(row_id) {
            var table_row = '#row_' + row_id
            var token = "{{ csrf_token() }}";
            url = "{{ route('language-delete') }}"
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently!",
                icon: "warning",
                buttons: true,
                buttons: ["Cancel", "Delete"],
                dangerMode: true,
                closeOnClickOutside: false
            })
                .then(function (confirmed) {
                    if (confirmed) {
                        $.ajax({
                            url: url,
                            type: 'delete',
                            data: {"_token": token, "id": row_id},
                            dataType: 'json'
                        })
                            .done(function (response) {
                                swal.stopLoading();
                                if (response.status == "success") {
                                    swal("Deleted!", response.message, response.status);
                                    $(table_row).fadeOut(2000);
                                } else {
                                    swal("Error!", response.message, response.status);
                                }
                            })
                            .fail(function () {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            })
                    }
                })
        }
    </script>
@endsection
