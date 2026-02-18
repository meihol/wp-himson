( function( $ ) {
    'use strict';

    /* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};

	/* --------------------------------------------------
    * preloader
    * --------------------------------------------------*/
	if ( $('#royal_preloader').length ) {
		var $selector       = $('#royal_preloader'),
			$width          = $selector.data('width'),
			$height         = $selector.data('height'),
			$color          = $selector.data('color'),
			$bgcolor        = $selector.data('bgcolor'),
			$logourl        = $selector.data('url');
		
		Royal_Preloader.config({
			mode           : 'logo',
			logo           : $logourl,
			logo_size      : [$width, $height],
			showProgress   : true,
			showPercentage : true,
			text_colour: $color,
			background:  $bgcolor,
		});        
	};

	$(document).ready( function() {
		/* --------------------------------------------------
	    * sticky header
	    * --------------------------------------------------*/
	 	var fixed  = $('#site-header .sticky-header');
	  	$(window).on("scroll", function(){
		    var site_header = $('#site-header').outerHeight() + 200;  
		      
		    if ($(window).scrollTop() >= site_header) {
		      	fixed.addClass('is-stuck');
		      	fixed.find('.main-navigation').addClass('scrolled');
		    }else{
		      	fixed.removeClass('is-stuck');                  
		      	fixed.find('.main-navigation').removeClass('scrolled');
		    }
		});

	    /* --------------------------------------------------
	    * mobile menu
	    * --------------------------------------------------*/
	    $('.mmenu_wrapper li:has(ul)').prepend('<span class="arrow"><i class="ot-flaticon-plus"></i></span>');
	    $(".mmenu_wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
	        $(this).parent().find("> ul").stop(true, true).slideToggle()
	        $(this).toggleClass( "active" ); 
	    });
		
		$( "#mmenu_toggle" ).on('click', function() {
			$(this).toggleClass( "active" );
			$(this).parents('.header_mobile').toggleClass( "open" );
			if ($(this).hasClass( "active" )) {
				$('.mobile_nav').stop(true, true).slideDown(300);
			}else{
				$('.mobile_nav').stop(true, true).slideUp(300);
			}
		});

		/* --------------------------------------------------
	    * gallery post
	    * --------------------------------------------------*/
	    var galleryPost = $('.gallery-post');
		if (galleryPost.length > 0 ) {
			galleryPost.each( function () {
				var selector = $(this).find('.owl-carousel');
				selector.owlCarousel({
					rtl: rtl_owl(),
					autoplay:true,
					autoplayTimeout: 7000,
					loop:true,
					margin:0,
					responsiveClass:true,
					dotsClass: 'owl-dots ot-dots-classic',
					dots:false,
					nav:true,
	            	navText: ['<i class="ot-flaticon-right-arrows"></i>','<i class="ot-flaticon-right-arrows"></i>'],
					responsive : {
	                    0 : {
	                        items: 1,
	                    },
	                    768 : {
	                        items: 1,
	                    },
	                    1024 : {
	                        items: 1,
	                    }
	                }
				});
			});
		}

		/* --------------------------------------------------
	    * related projects
	    * --------------------------------------------------*/
	    $('.project-related-posts').each( function () {
	        var selector = $(this);
	        selector.find('.owl-carousel').owlCarousel({
	            rtl: rtl_owl(),
	            autoplay: true,
	            loop: false,
	            dotsClass: 'owl-dots ot-dots-classic',
	            dots: false,
	            nav: false,
	            responsive : {
	                0 : {
	                    items: 1,
	                    margin: 0,
	                },
	                768 : {
	                    items: 2,
	                    margin: 30,
	                },
	                1024 : {
	                    items: 3,
	                    margin: 30,
	                }
	            }
	        });
	    });
	});

	$(window).on('load', function () {
		/* --------------------------------------------------
	    * popup video
	    * --------------------------------------------------*/
	  	var video_popup = $('.video-popup');
	   	if (video_popup.length > 0 ) {
		   	video_popup.each( function(){
			   	$(this).lightGallery({
				   selector: '.video-popup > .octf-btn-play',
			   	});
		   	});
	   	};
   	});

    /* --------------------------------------------------
    * back to top
    * --------------------------------------------------*/
    if ($('#back-to-top').length) {
	    var scrollTrigger = 500, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('#back-to-top').addClass('show');
	            } else {
	                $('#back-to-top').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	    $('#back-to-top').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });	
	}

} )( jQuery );
