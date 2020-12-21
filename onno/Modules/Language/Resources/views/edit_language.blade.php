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
                    {{ session('error') }}
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
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-12">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('update_language') }}</h2>
                                </div>

                                {!!  Form::open(['route' => ['update-language-info',$langInfo->id], 'method' => 'post']) !!}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">{{ __('language_name')}}*</label>
                                            <input id="name" name="name" type="text" value="{{ $langInfo->name }}"
                                                   class="form-control" placeholder="Language Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="code" class="col-form-label">{{ __('short_form')}}*</label>
                                            <input id="code" name="code" type="text" value="{{ $langInfo->code }}"
                                                   class="form-control" placeholder="en" maxlength='5' minlength='2'
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="icon_class" class="col-form-label">{{ __('flag') }}*</label>
                                            <select name="icon_class" class="form-control selectpicker" required>
                                                <option value=""> {{ __('select_option') }}</option>
                                                @foreach ($flagIcons as $icon)
                                                    <option value="{{ $icon->icon_class }}"
                                                            data-icon="{{ $icon->icon_class }}"
                                                            @if($icon->icon_class===$langInfo->icon_class) selected
                                                            @endif class=""> {{ $icon->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="script" class="col-form-label">{{ __('script')}}</label>
                                            <input id="script" name="script" type="text"
                                                   value="{{ $langConfig->script }}" class="form-control"
                                                   placeholder="Latn">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="native" class="col-form-label">{{ __('native')}}</label>
                                            <input id="native" name="native" type="text"
                                                   value="{{ $langConfig->native }}" class="form-control"
                                                   placeholder="English">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="regional" class="col-form-label">{{ __('regional')}}</label>
                                            <input id="regional" name="regional" type="text"
                                                   value="{{ $langConfig->regional }}" class="form-control"
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
                                                       class="custom-control-input"
                                                       @if ($langInfo->text_direction=='LTR')
                                                       checked="checked"
                                                    @endif
                                                >
                                                <span class="custom-control-label">{{ __('ltr') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="text_direction"
                                                       id="text_direction_right_to_left" value="RTL"
                                                       class="custom-control-input"
                                                       @if ($langInfo->text_direction=='RTL')
                                                       checked="checked"
                                                    @endif
                                                >
                                                <span class="custom-control-label">{{ __('rtl')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row p-l-15">
                                        <div class="col-12 col-md-4">
                                            <div class="form-title">
                                                <label for="status">{{ __('status')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="status" id="status_active" value="active"
                                                       class="custom-control-input"

                                                       @if ($langInfo->status=='active')
                                                       checked="checked"
                                                    @endif
                                                >
                                                <span class="custom-control-label">{{ __('active')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="status" id="status_inactive" value="inactive"
                                                       class="custom-control-input"
                                                       @if ($langInfo->status=='inactive')
                                                       checked="checked"
                                                    @endif
                                                >
                                                <span class="custom-control-label">{{ __('inactive')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right"><i
                                                        class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_language')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}

                            </div>
                        </div>
                        <!-- Main Content section end -->
                    </div>
                </div>
            </div>

            <!-- page info end-->
        </div>
    </div>

@endsection
