<div id="media-gallery" class="modal fade image-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('image_gallery') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        {!!  Form::open(['id'=>'imageUploadForm','method' => 'post','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="image" class="upload-file-btn btn btn-primary  btn-block"><i
                                        class="fa fa-folder input-file" aria-hidden="true"></i> {{ __('add_image') }}
                                </label>
                                <input id="image" name="image" type="file" class="form-control d-none" required
                                       onChange="swapImage(this);uploadBtn()" data-index="0">
                            </div>
                            <div class="form-group">
                                <div class="form-group text-center">
                                    <img src="{{static_asset('default-image/default-100x100.png') }} " id="perview_current_image"
                                         data-index="0" width="200" height="200" alt="image"
                                         class="img-responsive img-thumbnail">
                                </div>
                            </div>
                            <div class="form-group" id="divUploadBtn">
                                <div class="form-group text-center">
                                    <button type="submit" name="btn_image_upload" id="media-upload-btn"
                                            class="btn btn-primary btn-block"><i
                                            class="fas fa-cloud-upload-alt"></i> {{ __('upload') }}</button>
                                </div>
                            </div>
                        </div>
                        {!!  Form::close() !!}
                    </div>

                    <div class="col-md-8">
                        <div class="row" id="media-library"></div>
                        <input type="hidden" id="count" value="1">

                        <div class="ajax-loading" id="ajax-image-loading"><img src="{{static_asset('site/images/preloader-2.gif') }}"/>
                        </div>

                        <div class="load-more" id="load-more-image"><a href="javascript:void(0)"
                                                                       class="">{{ __('load_more') }}</a></div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="selectImage" class="btn btn-primary"
                        data-dismiss="modal">{{ __('select_image') }}</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('close') }}</button>
                @if(Sentinel::getUser()->roles[0]->id != 4 && Sentinel::getUser()->roles[0]->id != 5)
                <div class="delete-image-btn">
                    <button type="button" class='btn btn-danger'>{{ __('delete') }}</button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function (e) {
        var image_page_no = 1;
        url = "{{ route('fetch-image') }}";

        $(document).on('click', '.btn-image-modal', function () {
            window.value = $(this).attr('data-id');
            var formData = {
                count: $('#count').val()
            };

            console.log(formData);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                beforeSend: function () {
                    $('#ajax-image-loading').show();
                },
                success: function (data) {
                    console.log(data);

                    if(parseInt($("#imageCount").val()) * 24 >= parseInt($("#images").val())){
                        $('#load-more-image').hide();
                        $('#ajax-image-loading').html('{{ __('no_more_records') }}');
                    }else{
                        $('#ajax-image-loading').hide();
                        $('#load-more-image').show();
                    }

                    $("#media-library").html(data);
                    $("#imageCount").val(parseInt($("#imageCount").val()) + 1);
                }
            })
                .fail(function () {
                    $('#ajax-image-loading').hide();
                    swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                })
        });

        // $("#media-library").scroll(function(){
        $(document).on('click', '#load-more-image', function () {

            // var ele = document.getElementById('media-library');
            // if(Math.round(ele.scrollHeight - ele.scrollTop) === ele.clientHeight){
            image_page_no++;
            let next_url = url + '?page=' + image_page_no;

            $.ajax({
                url: next_url,
                type: 'get',
                beforeSend: function () {
                    $('#ajax-image-loading').show();
                },
                dataType: 'html',
                success: function (data) {

                    if(parseInt($("#imageCount").val()) * 24 >= parseInt($("#images").val())){
                        $('#load-more-image').hide();
                        $('#ajax-image-loading').html('{{ __('no_more_records') }}');
                    }else{
                        $('#ajax-image-loading').hide();
                        $('#load-more-image').show();

                    }

                    $("#media-library").append(data);
                    $("#imageCount").val(parseInt($("#imageCount").val()) + 1);
                }
            })
                .fail(function () {
                    $('#ajax-image-loading').hide();
                    swal('Oops...', '{{ __('something_went_wrong_with_ajax') }}', 'error');
                })
            // }
        });

        $('#imageUploadForm').on('submit', (function (e) {
            e.preventDefault();
            $("#media-upload-btn").prop('disabled', true);
            $("#media-upload-btn").html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only"></span> Loading...');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });


            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('image-upload')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if (data[0].status == 'success') {
                        $("#media-library").prepend(
                            @if(settingHelper('default_storage') =='local')
                                '<div class="col-md-2" id="row_' + data[0].data.id + '"><img id="' + data[0].data.id + '" src="{{ asset("/") }}' + data[1] + '" alt="image" class="image img-responsive img-thumbnail"></div>'
                        @else
                            '<div class="col-md-2" id="row_' + data[0].data.id + '"><img id="' + data[0].data.id + '" src="https://s3.{{ config('filesystems.disks.s3.region') }}.amazonaws.com/{{ config('filesystems.disks.s3.bucket') }}/' + data[1] + '" alt="image" class="image img-responsive img-thumbnail"></div>'
                        @endif);
                        $('#perview_current_image').attr('src', "{{static_asset('default-image/default-100x100.png') }}");
                        $.notify('successfully image uploaded to gallery', "success");
                        $("#image").val('');
                        $("#media-upload-btn").html('<i class="fas fa-cloud-upload-alt"></i> Upload');
                        $("#media-upload-btn").prop('disabled', false);
                        $("#divUploadBtn").show();
                    } else {
                        $("#media-upload-btn").html('<i class="fas fa-cloud-upload-alt"></i> Upload');
                        $("#media-upload-btn").prop('disabled', false);
                        $("#divUploadBtn").show();
                        $.notify(data[1].message, "error");
                    }
                },

                error: function (data) {
                    $.notify(data.responseJSON.message, "danger");
                    $("#media-upload-btn").html('<i class="fas fa-cloud-upload-alt"></i> Upload');
                    $("#media-upload-btn").prop('disabled', false);
                    // $('#error_msg').append(data.responseJSON.message);
                    // console.log(data.responseJSON.message);
                }
            });
        }));

        var selected_image_id = '';

        $(document).on('click', '.image', function () {
            $('.image').removeClass('selected');
            $('.delete-image-btn').css('display', 'block');
            $('#selectImage').css('display', 'block');
            selected_image_id = $(this).attr('id');
            selected_image_src = $(this).attr('src');
            $(this).addClass('selected');
        });

        $("#selectImage").on('click', function () {
            // alert(window.value);
            if (window.value == 1) {
                $('#image_id').val(selected_image_id);
                $('#image_preview').attr('src', selected_image_src);
            } else if (window.value == 2) {
                $('#video_thumbnail_id').val(selected_image_id);
                $('#video_thumb_preview').attr('src', selected_image_src);
            }
        });

        $(".delete-image-btn").on('click', function () {
            var div_row = '#row_' + selected_image_id
            var token = "{{ csrf_token() }}";
            deleteurl = "{{ route('delete-image') }}"

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
                            url: deleteurl,
                            type: 'delete',
                            data: 'row_id=' + selected_image_id + '&_token=' + token,
                            dataType: 'json'
                        })
                            .done(function (response) {
                                swal.stopLoading();
                                if (response.status == "success") {
                                    console.log(response);
                                    swal("{{ __('deleted') }}!", response.message, response.status);
                                    $(div_row).fadeOut(2000);

                                    console.log($('#image_id').val());

                                    if($('#video_thumbnail_id').val() == selected_image_id){
                                        $('#video_thumbnail_id').removeAttr('value');
                                        $('#video_thumb_preview').attr('src', '{{static_asset('default-image/default-100x100.png') }}');
                                    }

                                    if($('#image_id').val() == selected_image_id){
                                        $('#image_id').removeAttr('value');
                                        $('#image_preview').attr('src', '{{static_asset('default-image/default-100x100.png') }}');
                                    }
                                    console.log($('#image_id').val(''));



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

    });


</script>


