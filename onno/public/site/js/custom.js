jQuery(function ($) {

    'use strict';

	 $(document).scroll(function() {
	    var y = $(this).scrollTop();
	    if (y > $( window ).height()) {
	        $('.scrollToTop').fadeIn();
	    } else {
	        $('.scrollToTop').fadeOut();
	    }
	});

 });