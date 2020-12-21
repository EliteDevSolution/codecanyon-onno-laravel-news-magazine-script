@extends('common::layouts.master')
@section('poll')
    active
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'store-poll','method' => 'post','enctype'=>'multipart/form-data']) !!}
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('add_poll') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('polls') }}" class="btn btn-primary btn-add-new btn-sm"><i
                                            class="fas fa-arrow-left"></i>
                                        {{ __('back_to_polls') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="poll-question" class="col-form-label">{{ __('question') }}*</label>
                                <textarea name="question" required id="poll-question" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="start_date">{{ __('start_date') }}*</label>
                            <div class="input-group">
                                <label class="input-group-text" for="start_date"><i
                                        class="fa fa-calendar-alt"></i></label>
                                <input type="text" class="form-control date" id="start_date" name="start_date"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="end_date">{{ __('end_date') }}*</label>
                            <div class="input-group">
                                <label class="input-group-text" for="end_date"><i
                                        class="fa fa-calendar-alt"></i></label>
                                <input type="text" class="form-control date" id="end_date" name="end_date"/>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-sm-12" id="poll-option-area">
                            </div>

                            <div class="col-sm-12">
                                <div class="row poll-option-1" id="1">
                                    <div class="col-11">
                                        <div class="form-group">
                                            <label for="option" class="col-form-label">{{ __('option') }}*</label>
                                            <input id="option" name="option[]" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary float-right m-t-35"
                                                onclick="addRowFeature(1);">
                                            <i class="m-r-0 mdi mdi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="auth_required">{{ __('auth_required') }}*</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="auth_required" id="for_all_user" value="1" checked=""
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('yes') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="auth_required" id="only_register_user" value="0"
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('no') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="status">{{ __('status') }}*</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" id="poll_status_actvie" value="1" checked=""
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('active') }}</span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" id="poll_status_inactvie" value="0"
                                           class="custom-control-input">
                                    <span class="custom-control-label">{{ __('inactive') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="m-r-10 mdi mdi-plus"></i>{{ __('add_poll') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- page info end-->
        </div>
    </div>
@endsection

@push('include_js')
    <script src="{{static_asset('vendor')}}/jquery/jquery-ui-1.12.1.js"></script>
    <script type="text/javascript">
        addRowFeature = () => {

            let value = $('#option').val().trim();
            if (value == undefined || value == '') {
                return;
            }

            var current = parseInt($('#poll-option-area .row:first').attr('id')) + 1;
            // console.log(current);

            if (isNaN(current)) {
                var last_id = 1;
            } else {
                var last_id = current + 1
            }


            var newRow = "<div class='row poll-option-" + last_id + "' id='" + last_id + "'>";


            newRow += "<div class='col-11'>";
            newRow += "<div class='form-group'>";
            newRow += "<label for='option_1' class='col-form-label'>{{ __('option') }}</label>";
            newRow += "<i class='fa fa-bars' aria-hidden='true'></i><input id='option_1' name='option[]' type='text' class='form-control' value='" + value + "'>";
            newRow += "</div>";
            newRow += "</div>";
            newRow += "<div class='col-1'>";
            newRow += "<button type='button' class='btn btn-danger float-right m-t-35 row_remove'><i class='m-r-0 mdi mdi-delete'></i></button>";
            newRow += "</div>";
            newRow += "</div>";

            $("#poll-option-area").append(newRow);
            $('#option').val('');

        };

        $('#option').keypress(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                addRowFeature();
            }

        })

        $(document).on("click", ".row_remove", function () {
            let element = $(this).parents('.row');
            let id = element.attr("id");
            $('#' + id).remove();
        });

        $("#poll-option-area").sortable();

    </script>
@endpush
