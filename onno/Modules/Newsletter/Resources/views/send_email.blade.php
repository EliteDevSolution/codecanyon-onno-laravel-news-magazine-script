@extends('common::layouts.master')
@section('newsletter-aria-expanded')
    aria-expanded="true"
@endsection
@section('newsletter-show')
    show
@endsection
@section('send_newsletter')
    active
@endsection
@section('newsletter_active')
    active
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'save-to-cron', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            <div class="row clearfix">
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
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">

                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('send_email_to_subscribers') }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="subject" class="col-form-label">{{ __('subject') }}*</label>
                                <input id="subject" name="subject" value="{{ old('subject') }}" required type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="language">{{ __('type') }}</label>
                                <select class="form-control" name="content_type" id="send_email_type">
                                    @foreach (__('newsletter::send_email.send_email_type') as $value => $item)
                                        <option value="{{$value}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12" id="bulk_email_type_container">
                            <div class="form-group">
                                <label for="language">{{ __('Bulk Email Type') }}</label>
                                <select class="form-control" name="bulk_email_type" id="bulk_email_type">
                                    @foreach (__('newsletter::send_email.bulk_email_type') as $value => $item)
                                        <option value="{{$value}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 d-none" id="newsletter_post_container">
                            <div class="form-group">
                                <label for="language">{{ __('post') }}</label>
                                <select class="form-control" name="single_content_type" id="newsletter_post">
                                    <option></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 d-none" id="custom_message_container">
                            <div class="form-group">
                                <label for="message" class="col-form-label">{{ __('message') }}</label>
                                <textarea id="content" name="custom_message" class="form-control" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="fa fa-paper-plane" aria-hidden="true"></i> {{ __('send_email') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>

@endsection

@push('include_js')
    <script>
        $(document).ready(function () {
            $('#send_email_type').on('change', function () {
                let sendEMailType = $(this).val();
                $('#bulk_email_type_container').addClass('d-none');
                $('#newsletter_post_container').addClass('d-none');
                $('#custom_message_container').addClass('d-none');

                if (sendEMailType == {{ \Modules\Newsletter\Enums\SendEmailType::MULTIPLE }}) {
                    $('#bulk_email_type_container').removeClass('d-none');
                }

                if (sendEMailType == {{ \Modules\Newsletter\Enums\SendEmailType::SINGLE }}) {
                    $('#newsletter_post_container').removeClass('d-none');

                    $('#newsletter_post').select2({
                        ajax: {
                            method: "GET",
                            delay: 250,
                            url: '{{ route('newsletter.search.post') }}',
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    search: params.term
                                }
                            },
                            processResults: function (data) {
                                return {
                                    results: data
                                }
                            }
                        }
                    });
                }

                if (sendEMailType == {{ \Modules\Newsletter\Enums\SendEmailType::CUSTOM }}) {
                    $('#custom_message_container').removeClass('d-none');
                }
            })
        });
    </script>
@endpush
