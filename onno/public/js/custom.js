

// student section select sction for sibling
    $(document).ready(function () {
        $(".select-options li").on("click",function(){
            var url = $('#url').val();
            var formData = {
                lang: $(this).attr('rel'),
            };

             $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'site-switch-langauge',
                success: function (data) {
                    
                    $(location).attr('href', data);

                    
                },
                error: function (data) {
                   // console.log('Error:', data);
                }
            });
            
        })

        $("form#update-settings #company_language").on('change', function () {
            var url = $('#url').val();

            var formData = {
                lang: $(this).val(),
                type: 'company'
            };
            // get section for student
            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'setting/get-company-information',
                success: function (data) {

                    $('#application_name').val(data['application_name']);

                    $('#address').val(data['address']);
                    $('#email').val(data['email']);
                    $('#phone').val(data['phone']);
                    $('#zip_code').val(data['zip_code']);
                    $('#city').val(data['city']);
                    $('#state').val(data['state']);
                    $('#website').val(data['website']);
                    $('#company_registration').val(data['company_registration']);
                    $('#tax_number').val(data['tax_number']);
                    $('#about_us_description').val(data['about_us_description']);


                    var options = '';
                    $('#country option').each(function(index,element){
                        // console.log(index);
                        // console.log(element.value);
                        // console.log(element.text);
                        if ( data['country'] == element.value ) {
                            options += "<option value='"+element.value+"' selected>"+element.text+"</option>";
                        } else {
                            options += "<option value='"+element.value+"'>"+element.text+"</option>";
                        }

                    });

                    console.log(options);

                    $('#country').empty();
                    $('#country').append(options);
                },
                error: function (data) {
                   // console.log('Error:', data);
                }
            });
        });

    });


     // student section select sction for sibling
    $(document).ready(function () {

        $("form#update-settings #seo_language").on('change', function () {
            var url = $('#url').val();



            var formData = {
                lang: $(this).val(),
                type: 'seo'
            };
            // get section for student
            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'setting/get-company-information',
                success: function (data) {

                    console.log(data);


                    $('#seo_title').val(data['seo_title']);

                    $('#seo_keywords').val(data['seo_keywords']);
                    $('#seo_meta_description').val(data['seo_meta_description']);
                    $('#author_name').val(data['author_name']);
                    $('#og_title').val(data['og_title']);
                    $('#og_description').val(data['og_description']);

                },
                error: function (data) {
                   // console.log('Error:', data);
                }
            });
        });

    });


         // student section select sction for sibling
    $(document).ready(function () {

        $("form#onesignal-update #onesignal_language").on('change', function () {
            var url = $('#url').val();



            var formData = {
                lang: $(this).val(),
                type: 'one_signal'
            };
            // get section for student
            $.ajax({
                type: "GET",
                data: formData,
                dataType: 'json',
                url: url + '/' + 'setting/get-company-information',
                success: function (data) {

                    console.log(data);


                    $('#onesignal_action_message').val(data['onesignal_action_message']);

                    $('#onesignal_accept_button').val(data['onesignal_accept_button']);
                    $('#onesignal_cancel_button').val(data['onesignal_cancel_button']);

                },
                error: function (data) {
                   // console.log('Error:', data);
                }
            });
        });

    });


    //frontend poll result hide/show


    $(document).ready(function () {

        $("#show-result").on('click', function (event) {
            event.preventDefault();
            var poll = $(this).parents(".sg-widget").attr("id");
            console.log("#poll-result-"+poll);

           $("#poll-result-"+poll).toggleClass('d-none');

        });

    });

    // page type select
     $(document).ready(function () {

        $("#page_type").on('change', function (event) {
            event.preventDefault();
            var value = $(this).val();
            if(value == 2){
                $('#description').addClass('d-none');
            }else{
                $('#description').removeClass('d-none');
            }

        });

    });


    $(document).ready(function () {

        $('#switch-mode').on('click', function () {
            var url = $('#url').val();
            var url = $('#url').val();

            $.ajax({
                type: "GET",
                dataType: 'json',
                url: url + '/' + 'mode-change',
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                   // console.log('Error:', data);
                }
            });
        });

    });

    //messages
     $(document).ready(function () {

         setTimeout(function() {
             $('#error_m').slideUp("slow");
         }, 5000);

         setTimeout(function() {
             $('#success_m').slideUp("slow");
         }, 3000);
     });
    // ads adding on changing options
     $('#ad_type').on('change',function(){
         if( $(this).val()==="code"){
             $("#div_ad_image").addClass('d-none');
             $("#div_ad_text").addClass('d-none');
             $("#div_ad_code").removeClass('d-none');
         }
         else if($(this).val()==="image"){
             $("#div_ad_image").removeClass('d-none');
             $("#div_ad_code").addClass('d-none');
             $("#div_ad_text").addClass('d-none');
         }
         else if($(this).val()==="text"){
             $("#div_ad_text").removeClass('d-none');
             $("#div_ad_image").addClass('d-none');
             $("#div_ad_code").addClass('d-none');
         }
     });
     $(document).ready(function () {
         setTimeout(function(){
             $('#success_m').fadeOut('slow');
         },3000);
     });

     // $('#mySelect').selectpicker();

     $(document).ready(function() {
         $('#mail_driver').on('change', function () {

             if ($(this).val() === "smtp") {
                 $("#sendMailDiv").hide();
                 $("#smtpDiv").show();
             } else if ($(this).val() === "sendmail") {
                 $("#sendMailDiv").show();
                 $("#smtpDiv").hide();
             }
         });
     });

     function metaTitleSet() {
         var keyValue = document.getElementById("page-title").value;

         document.getElementById("title-meta").value = keyValue;
     }

     $('#default_storage').on('change', function(){

         if( $(this).val()==="s3"){
             $("#s3Div").show();
         } else{
             $("#s3Div").hide();
         }
     });

    $(document).ready(function() {
        $('form#save-new-section #type').on('change', function () {

            if($(this).val() == 1){
                $('#category-area').removeClass('d-none');
                $('#section-style').removeClass('d-none');
                $('#category_id').attr('required');
            }else if($(this).val() == 2){
                $('#category-area').addClass('d-none');
                $('#category_id').removeAttr('required');
                $('#section-style').removeClass('d-none');
            }else if($(this).val() == 3){
                $('#category-area').addClass('d-none');
                $('#category_id').removeAttr('required');
                $('#section-style').addClass('d-none');

            }
            
         });
    });

     $(document).ready(function () {

        $('#btn-load-more').on('click', function (e) {
            $("#btn-load-more").prop("disabled", true);
            e.preventDefault();
            var url = $('#url').val();
            $("#latest-preloader-area").removeClass('d-none');

            var formData = {
                last_id: $('#last_id').val()
            };

            $.ajax({
                type: "GET",
                dataType: 'json',
                data: formData,
                url: url + '/' + 'get-read-more-post',
                success: function (data) {

                    $.each( data[0], function( key, value ) {
                      $(".latest-post-area").append(value);
                    });

                    if(data[1] == 1){
                        $("#btn-load-more").hide();
                        $("#no-more-data").removeClass('d-none');
                    }

                    last_id = parseInt($('#last_id').val());
                    $('#last_id').val(last_id + 1);
                    $("#btn-load-more").prop("disabled", false);

                    $("#latest-preloader-area").addClass('d-none');
                },
                error: function (data) {
                   // console.log('Error:', data);
                }
            });

            
        });

    });

     $(document).ready(function () {
        var $preInstallationTab = $("#pre-installation-tab"),
                $configurationTab = $("#configuration-tab");

        $(".form-next").on('click', function () {
            if ($preInstallationTab.hasClass("active")) {
                $preInstallationTab.removeClass("active");
                $configurationTab.addClass("active");
                $("#pre-installation").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
                $("#configuration").addClass("active");
                $("#host").focus();
            }
        });

    });

    $('#default_storage').on('change', function () {

        if ($(this).val() === "s3") {
            $("#s3Div").show();
        } else {
            $("#s3Div").hide();
        }
    });


 // showing upload button for video upload   

function videoUploadBtn() {
    video_name = $('#video').val();
    $("#video_name").text(video_name);
    $("#divVideoUploadBtn").show();
}


//installer step change

var onFormSubmit = function ($form) {
    $form.find('[type="submit"]').attr('disabled', 'disabled').find(".loader").removeClass("hide");
    $form.find('[type="submit"]').find(".button-text").addClass("hide");
    $("#alert-container").html("");
};
var onSubmitSussess = function ($form) {
    $form.find('[type="submit"]').removeAttr('disabled').find(".loader").addClass("hide");
    $form.find('[type="submit"]').find(".button-text").removeClass("hide");
};


