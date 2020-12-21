 (function ($) {
  "use strict";

    $('#post_status').on('change',function(){
        if( $(this).val()==="2"){
            $(".divScheduleDate").show();
        }else{
            $(".divScheduleDate").hide();
        }
    });

    
    $('#default_storage').on('change',function(){

        if( $(this).val()==="s3"){
            $("#s3Div").show();
        } else{
            $("#s3Div").hide();
        }
    });
})(window.jQuery);

function metaTitleSet() {
    var keyValue = document.getElementById("post_title").value;

    document.getElementById("meta_title").value = keyValue;
}
