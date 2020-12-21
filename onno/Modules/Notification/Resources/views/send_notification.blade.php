@extends('common::layouts.master')
@section('notification-aria-expanded')
    aria-expanded="true"
@endsection
@section('notification-show')
    show
@endsection
@section('send_notification')
    active
@endsection
@section('notification_active')
    active
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route' => 'notification-send', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

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
                                <h4 class="border-bottom">{{ __('send_notification') }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="post_id" class="col-form-label">{{ __('post') }}*</label>
                                <select id="post_id" name="post_id" class="form-control" required> </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="headings" class="col-form-label">{{ __('headings') }}*</label>
                                <input id="headings" name="headings" value="{{ old('headings') }}" required type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="message" class="col-form-label">{{ __('message') }}*</label>
                                <textarea id="message" name="message" class="form-control" required rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="icon_url" class="col-form-label">{{ __('icon_url') }}*</label>
                                <input id="icon_url" name="icon_url" value="{{ old('icon_url') }}" required type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="image_url" class="col-form-label">{{ __('image_url') }}*</label>
                                <input id="image_url" name="image_url" value="{{ old('image_url') }}" required
                                       type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="fa fa-paper-plane"
                                            aria-hidden="true"></i> {{ __('send_notification') }}</button>
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

@section('script')
    <script type="text/javascript">
        var CSRF_TOKEN = "{{ csrf_token() }}";
        $('#post_id').select2({
            placeholder: "{{ __('select_option') }}",
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('get-post') }}',
                type: "post",
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        q: params.term // search term
                    };
                },
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>

    <script>

        $("#post_id").change(function () {

            var post_id = $("#post_id option:selected").val();
            if (post_id != '' && post_id != null) {
                $.ajax({

                    url: "{{ route('get-post-details') }}",
                    type: 'POST',
                    data: {"post_id": post_id, _token: CSRF_TOKEN,},
                    dataType: 'json'
                })
                    .done(function (response) {
                        if (response.post_type == 'article') {
                            @if(settingHelper('default_storage') =='local')
                            $("#icon_url").val('{{ asset("/") }}' + response.image.thumbnail + '');
                            @else
                            $("#icon_url").val('https://s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/' + response.image.thumbnail + '');
                            @endif
                            @if(settingHelper('default_storage') =='local')
                            $("#image_url").val('{{ asset("/") }}' + response.image.thumbnail + '');
                            @else
                            $("#image_url").val('https://s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/' + response.image.thumbnail + '');
                            @endif
                            // $("#icon_url").val({{ asset("/") }}response.image.thumbnail);
                            // $("#image_url").val(response.image.thumbnail);
                        } else if (response.post_type == 'video') {
                            @if(settingHelper('default_storage') =='local')
                            $("#icon_url").val('{{ asset("/") }}' + response.video.video_thumbnail + '');
                            @else
                            $("#icon_url").val('https://s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/' + response.image.thumbnail + '');
                            @endif
                            @if(settingHelper('default_storage') =='local')
                            $("#image_url").val('{{ asset("/") }}' + response.video.video_thumbnail + '');
                            @else
                            $("#image_url").val('https://s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/' + response.image.thumbnail + '');
                            @endif
                        }
                        $("#headings").val(response.title);
                        // $("#message").val(response.description);
                    })
                    .fail(function (response) {
                        swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                    })
            }
        });
    </script>
@endsection
