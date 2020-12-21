<div id="video-gallery" class="modal fade video-modal-lg" tabindex="-1" role="dialog" aria-labelledby="videoGallery"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('video_gallery') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        {!!  Form::open(['id'=>'videoUploadForm','method' => 'post','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="video" class="upload-file-btn btn btn-primary  btn-block"><i
                                        class="fa fa-folder input-file" aria-hidden="true"></i> {{ __('add_video') }}
                                </label>
                                <input id="video" name="video" type="file" class="form-control d-none" required
                                       onChange="videoUploadBtn()" data-index="0">
                            </div>
                            <div class="form-group">
                                <div class="form-group text-center">
                                    <div id="video_name"></div>
                                </div>
                            </div>
                            <div class="form-group" id="divVideoUploadBtn">
                                <div class="form-group text-center">
                                    <button type="submit" name="btn_video_upload" id="video-upload-btn"
                                            class="btn btn-primary btn-block"><i
                                            class="fas fa-cloud-upload-alt"></i> {{ __('upload') }}</button>
                                </div>
                            </div>
                        </div>
                        {!!  Form::close() !!}
                    </div>
                    <div class="col-md-8">
                        <div class="row" id="video-library">


                        </div>
                        <div class="ajax-loading" id="ajax-video-loading"><img src="{{static_asset('site/images/preloader-2.gif') }}"/>
                        </div>
                        <div class="load-more" id="load-more-video"><a href="javascript:void(0)"
                                                                       class="">{{ __('load_more') }}</a></div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="selectVideo" class="btn btn-primary"
                        data-dismiss="modal">{{ __('select_video') }}</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('close') }}</button>
                <div class="delete-video-btn">
                    <button type="button" class='btn btn-danger'>{{ __('delete') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>

    $(document).ready(function (e) {

        var video_page_no = 1;
        fetch_video_url = "{{ route('fetch-video') }}";

        $(document).on('click', '#btnVideoModal', function () {
            $.ajax({
                url: fetch_video_url,
                type: 'get',
                dataType: 'html',
                beforeSend: function () {
                    $('#ajax-video-loading').show();
                },
                success: function (data) {

                    if(parseInt($("#videoCount").val()) * 24 >= parseInt($("#videos").val())){
                        $('#load-more-video').hide();
                        $('#ajax-video-loading').html('{{ __('no_more_records') }}');
                    }else{
                        $('#ajax-video-loading').hide();
                        $('#load-more-video').show();
                    }

                    $("#video-library").html(data);
                    $("#videoCount").val(parseInt($("#videoCount").val()) + 1);
                }
            })
                .fail(function () {
                    $('#ajax-video-loading').hide();
                    swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                })
        });
        $(document).on('click', '#load-more-video', function () {
            // $("#video-library").scroll(function(){

            // var ele = document.getElementById('video-library');
            // if(Math.round(ele.scrollHeight - ele.scrollTop) === ele.clientHeight){
            video_page_no++;
            let next_url = fetch_video_url + '?page=' + video_page_no;

            $.ajax({
                url: next_url,
                type: 'get',
                beforeSend: function () {
                    $('#ajax-video-loading').show();
                },
                dataType: 'html',
                success: function (data) {

                    if(parseInt($("#videoCount").val()) * 24 >= parseInt($("#videos").val())){
                        $('#load-more-video').hide();
                        $('#ajax-video-loading').html('{{ __('no_more_records') }}');
                    }else{
                        $('#ajax-video-loading').hide();
                        $('#load-more-video').show();
                    }

                    $("#video-library").append(data);
                    $("#videoCount").val(parseInt($("#videoCount").val()) + 1);
                }
            })
                .fail(function () {
                    $('#ajax-video-loading').hide();
                    swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                })
            // }
        });


        $('#videoUploadForm').on('submit', (function (e) {
            e.preventDefault();
            $("#video-upload-btn").prop('disabled', true);
            $("#video-upload-btn").html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only"></span> Loading...');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('video-upload')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    $("#video-library").prepend(
                        @if(settingHelper('default_storage') =='local')
                            '<div class="col-md-2" id="row_' + data[0].id + '"><img id="' + data[0].id + '" src="{{ asset("/") }}' + data[1] + '" alt="video" class="video img-responsive img-thumbnail"><label class="video_lvl" for="' + data[0].id + '">' + data[0].video_name + '</label> </div>');
                    @else
                        '<div class="col-md-2" id="row_' + data[0].id + '"><img id="' + data[0].id + '" src="https://s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/' + data[1] + '" alt="video" class="video img-responsive img-thumbnail"><label class="video_lvl" for="' + data[0].id + '">' + data[0].video_name + '</label> </div>'
                        );
            @endif
            // $('#perview_current_video').attr('src', "{{static_asset('default-image/default-video-100x100.png') }}");
            $.notify('successfully video uploaded to gallery', "success");
            $("#video").val('');
            $("#video-upload-btn").html('<i class="fas fa-cloud-upload-alt"></i> Upload');
            $("#video-upload-btn").prop('disabled', false);
            $("#video_name").text(' ');
            $("#divVideoUploadBtn").hide();
        },

            error
    :

        function (data) {
            $.notify(data.responseJSON.message, "danger");
            $("#video").val('');
            $("#video-upload-btn").html('<i class="fas fa-cloud-upload-alt"></i> Upload');
            $("#video-upload-btn").prop('disabled', false);
            $("#video_name").text(' ');
            $("#divVideoUploadBtn").hide();
            // $('#error_msg').append(data.responseJSON.message);
            // console.log(data.responseJSON.message);
        }
    });
    }))
    ;
    })
    ;
</script>

<script>
    var selected_video_id = '';

    $(document).on('click', '.video', function () {
        $('.video').removeClass('selected');
        $('.delete-video-btn').css('display', 'block');
        $('#selectVideo').css('display', 'block');
        selected_video_id = $(this).attr('id');
        selected_video_src = $(this).attr('src');
        $(this).addClass('selected');
    });
    $("#selectVideo").on('click', function () {
        $('#selected_video_name').text(selected_video_src);
        $('#video_id').val(selected_video_id);
        $('#video_thumb').show();
        $('#video_thumb').attr('src', selected_video_src);
    });

    $(".delete-video-btn").on('click', function () {
        var div_row = '#row_' + selected_video_id
        var token = "{{ csrf_token() }}";
        deleteUrl = "{{ route('delete-video') }}";

        swal({
            title: "{{ __('are_you_sure?') }}",
            text: "{{ __('it_will_be_deleted_permanently') }}",
            icon: "warning",
            buttons: true,
            buttons: ["{{ __('cancel') }}", "{{ __('delete') }}"],
            dangerMode: true,
            closeOnClickOutside: false
        })
            .then(function (confirmed) {
                if (confirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'delete',
                        data: 'row_id=' + selected_video_id + '&_token=' + token,
                        dataType: 'json'
                    })
                        .done(function (response) {
                            swal.stopLoading();
                            if (response.status == "success") {
                                console.log(response);
                                swal("{{ __('deleted') }}!", response.message, response.status);
                                $(div_row).fadeOut(2000);

                            } else {
                                swal("Error!", response.message, response.status);
                            }
                        })
                        .fail(function () {
                            swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                        })
                }
            })
    });
</script>

