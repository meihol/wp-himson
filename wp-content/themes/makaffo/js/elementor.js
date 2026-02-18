( function( $ ) {
    'use strict';

    /* rtl check */
	function rtl_owl(){
	if ($('body').hasClass("rtl")) {
		return true;
	} else {
		return false;
	}};

    /* rtl for Isotop */
    function rtl_isotop(){
        if ($('body').hasClass("rtl")) {
            return false;
        } else {
            return true;
        }
    };

    /* OT Custom Nav Arrow Slider */
    var otNavText1 = [
        '<i class="ot-flaticon-right-arrows"></i>',
        '<i class="ot-flaticon-right-arrows"></i>'
    ];
    var otNavText2 = [
        '<i class="ot-flaticon-left"></i>',
        '<i class="ot-flaticon-right"></i>'
    ];
    var otNavText3 = [
        '<i class="ot-flaticon-right-arrow"></i>',
        '<i class="ot-flaticon-right-arrow"></i>'
    ];
	/* --------------------------------------------------
    * video popup
    * --------------------------------------------------*/
    var videoPopup = function ($scope, $) {
        $scope.find('.ot-button-wrapper').each( function(){
            var selector = $(this),
                videoItem = selector.find('>.octf-btn-play');
            selector.lightGallery({
                selector: videoItem,
            });
        });
    };
    /* --------------------------------------------------
     * Progress bar
     * --------------------------------------------------*/
    function lineProgress() {
        $('.ot-progress-line:not([data-processed])').each(function() {
            var bar = $(this),
                line = bar.find(".ot-progress-bar"),
                progressEnd = bar.data('percent'),
                percent = bar.find('.ot-progress-percent');
            var scrollTop = $(document).scrollTop() + $(window).height();

            if ( scrollTop >  bar.offset().top +  bar.height() ) {
                bar.attr("data-processed", "true");
                line.css("width", (bar.outerWidth() * (progressEnd / 100)) + "px");

                for (var i = 0; i <= 50; i++) {
                    (function (count) {
                        setTimeout(function () {
                            percent.html(Math.round((progressEnd / 50) * count) + "%");
                        }, 30 * count);
                    })(i);
                }
            }
        });
    };

    /* Progress bar size */
    function lineProgressSize() {
        $('.ot-progress-line[data-processed]').each(function () {
            var bar = $(this);
            var line = bar.find(".ot-progress-bar");
            var progressEnd = parseInt(bar.data('percent'));

            line.css("width", (bar.outerWidth() * (progressEnd / 100)) + "px");
        });
    }

    /* ------------------------------------------
     * Circle Progress
     * ----------------------------------------*/

    function circleProgress() {
        $('.ot-progress-circle:not([data-processed])').each(function() {
            var circle    = $(this),
                bar_color = circle.data('color'),
                bar_hei   = circle.data('height'),
                bar_size  = circle.data('size');
            var scrollTop = $(document).scrollTop() + $(window).height();
            if ( scrollTop >  circle.offset().top +  circle.height() ) {
                circle.attr("data-processed", "true");
                circle.find('.ot-progress-circle__inner').easyPieChart({
                    barColor: bar_color,
                    trackColor: false,
                    scaleColor: false,
                    lineCap: 'square',
                    lineWidth: bar_hei,
                    size: bar_size,
                    animate: 1000,
                    onStart: $.noop,
                    onStop: $.noop,
                    /*easing: 'easeInOut',*/
                    onStep: function(from, to, percent) {
                        $(this.el).find('.ot-progress-percent').text(Math.round(percent) + '%');
                    }
                });
            }
        });
    };
    
    var progressBar = function () {
        lineProgress();
        circleProgress();
    };

    /* --------------------------------------------------
    * Accordions
    * --------------------------------------------------*/
    var customAccordions = function ($scope, $) {
        $scope.find('.ot-accordions-wrapper').each( function () {
            var selector = $(this),
                content = selector.find('.ot-acc-item__content'),
                header  = selector.find('.ot-acc-item__title');

            header.off("click");

            header.each(function(){
                if ($(this).data('default') == 'yes') {
                    $(this).next().addClass('active').slideDown(300);
                    $(this).parent().addClass('current');
                }
            });

            header.on('click', function(e){
                e.preventDefault();
                var $this = $(this);

                $this.next().toggleClass('active').slideToggle(300);
                $this.parent().toggleClass('current');
                content.not($this.next()).slideUp(300);
                header.not($this).parent().removeClass('current');
            });
        });
    };

    /* --------------------------------------------------
    * Tabs
    * --------------------------------------------------*/
    var customTabs = function ($scope, $) {

        $scope.find('.ot-tabs').each(function() {
            var selector = $(this),
                tabs     = selector.find('.ot-tabs__heading .ot-tabs__item'),
                content  = selector.find('.ot-tabs__content');
            
            tabs.first().addClass('current');
            content.first().addClass('current').show();
            
            tabs.on( 'click', function(e){
                e.preventDefault();
                if( $(this).hasClass('current') ) return false;
                var tab_id = $(this).attr('data-tab');
                $(this).siblings().removeClass('current');
                $(this).parents('.ot-tabs').find('.ot-tabs__content').removeClass('current').hide();
                $(this).addClass('current');
                $("#"+tab_id).addClass('current').fadeIn(500);
            });
        });
    };

    /* --------------------------------------------------
    * Big Tabs
    * --------------------------------------------------*/
    var otBigTabs = function ($scope, $) {
        $scope.find('.ot-tabs.tabs-justified').each( function () {
            var selector    = $(this),
                tabItem     = selector.find('.ot-tabs__heading .ot-tabs__item');

            tabItem.each(function() {
                var tab_id_each = $(this).attr('data-tab');
                $("#"+tab_id_each).hide();
            });
            tabItem.first().addClass('current');
            $("#"+tabItem.first().attr('data-tab')).show();

            tabItem.on( 'click', function(e){
                e.preventDefault();
                if( $(this).hasClass('current') ) return false;

                var tab_id_current = $(this).attr('data-tab');
                $(this).siblings().removeClass('current');
                tabItem.each(function() {
                    var tab_id_each = $(this).attr('data-tab');
                    $("#"+tab_id_each).hide();
                });
                $(this).addClass('current');
                $("#"+tab_id_current).fadeIn(500);
            });
        });
    }

    /**
    * Counter Up
    * Counts up to a targeted number when the number becomes visible
    * Requires assets/js/vendor/counterup.min.js
    * Requires assets/js/vendor/noframework.waypoints.min.js
    */
    function otCounter() {
        var counterUp = window.counterUp["default"];
        const counters = document.querySelectorAll(".counter");
        counters.forEach(el => {
            var duration = el.getAttribute('data-duration');
            new Waypoint({
                element: el,
                handler: function() {
                    counterUp(el, {
                        duration: duration,
                        delay: 50
                    })
                    this.destroy()
                },
                offset: 'bottom-in-view',
            })
        });
    }

    /* --------------------------------------------------
    * Countdown for coming soon
    * --------------------------------------------------*/
    var countDown = function($scope, $){
        $scope.find('.ot-countdown').each( function(){
            var selector = $(this),
                date     = selector.data('date'),
                zone     = selector.data('zone'),
                day      = selector.data('day'),
                days     = selector.data('days'),
                hour     = selector.data('hour'),
                hours    = selector.data('hours'),
                min      = selector.data('min'),
                mins     = selector.data('mins'),
                second   = selector.data('second'),
                seconds  = selector.data('seconds');
            selector.countdown({
                date: date,
                offset: zone,
                day: day,
                days: days,
                hour: hour,
                hours: hours,
                minute: min,
                minutes: mins,
                second: second,
                seconds: seconds
            }, function () {
                alert('Done!');
            });
        });
    };

    /* --------------------------------------------------
     * Clients Slider
     * --------------------------------------------------*/
    var clientsSlider = function ($scope, $) {
        $scope.find('.ot-clients-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
                
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dotsClass: 'owl-dots ot-dots-classic',
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText1,
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    1025 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
     * Testimonial Slider
     * --------------------------------------------------*/
    var testimonialSlider = function ($scope, $) {
        $scope.find('.ot-testimonials-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
                
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dotsClass: 'owl-dots ot-dots-classic',
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText2,
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    1025 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * Projects Slider
    * --------------------------------------------------*/
    var projectsSlider = function ($scope, $) {
        $scope.find('.ot-project-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');

            selector.find('.owl-carousel').on('initialized.owl.carousel changed.owl.carousel', function(e) {
                if (!e.namespace)  {
                    return;
                }
                var carousel = e.relatedTarget;
                $('.slider-counter').html('<span>0'+(carousel.relative(carousel.current()) + 1) + '</span>' + '/0' + carousel.items().length);
            });

            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dotsClass: 'owl-dots ot-dots-classic',
                dots: sliderSettings.dots && 'yes' !== sliderSettings.nav_custom,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: 'yes' === sliderSettings.nav_custom ? otNavText3 : otNavText1,
                smartSpeed: 500,
                dotsSpeed: 350,
                autoWidth: 'yes' === sliderSettings.auto_width,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    1025 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        }); 
    };

    /* --------------------------------------------------
    * Latest Post Slider
    * --------------------------------------------------*/
    var otPostSlider = function ($scope, $) {
        $scope.find('.ot-post-carousel').each( function () {
            var selector     = $(this),
                sliderSettings = selector.data('slider_options');
            selector.find('.owl-carousel').owlCarousel({
                rtl: rtl_owl(),
                autoplay: 'yes' === sliderSettings.autoplay,
                autoplayTimeout: parseInt(sliderSettings.autoplay_time_out),
                loop: 'yes' === sliderSettings.loop,
                responsiveClass:true,
                dots: sliderSettings.dots,
                nav: sliderSettings.arrows,
                autoplayHoverPause: true,
                navText: otNavText1,
                navContainerClass: 'owl-nav nav-outside',
                smartSpeed: 500,
                dotsSpeed: 350,
                responsive : {
                    0 : {
                        items: parseInt(sliderSettings.slides_show_mobile),
                        margin: parseInt(sliderSettings.margin_mobile),
                    },
                    576 : {
                        items: parseInt(sliderSettings.slides_show_mobile_extra),
                        margin: parseInt(sliderSettings.margin_mobile_extra),
                    },
                    768 : {
                        items: parseInt(sliderSettings.slides_show_tablet),
                        margin: parseInt(sliderSettings.margin_tablet),
                    },
                    992 : {
                        items: parseInt(sliderSettings.slides_show_tablet_extra),
                        margin: parseInt(sliderSettings.margin_tablet_extra),
                    },
                    1200 : {
                        items: parseInt(sliderSettings.slides_show_laptop),
                        margin: parseInt(sliderSettings.margin_laptop),
                    },
                    1400 : {
                        items: parseInt(sliderSettings.slides_show_desktop),
                        margin: parseInt(sliderSettings.margin_desktop),
                    }
                }
            });
        });
    };

    /* --------------------------------------------------
    * Portfolio filter isotope
    * --------------------------------------------------*/

    function otIsotope() {
        $('.projects-masonry').each(function () {
            var $isotopeWrap = $(this);
            var properties = {
                itemSelector : '.project-item',
                animationEngine : 'css',
                layoutMode: 'masonry',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                },
                isOriginLeft: rtl_isotop(),
                transitionDuration: '0.5s'
            };
            $isotopeWrap.imagesLoaded(function() {
                $isotopeWrap.isotope(properties);
                $isotopeWrap.isotope("layout");
            });
            otIsotopeFilterHandler(this);
        });
    }

    function otIsotopeFilterHandler(self){
        var filterBtn = $(self).closest('.projects-filter-wrapper').find('.isotope-filter .filter-item');

        /* Filter Handler */
        filterBtn.on('click', function (e) {
            e.preventDefault();

            var $this = $(this);
            if ( $this.hasClass('active') ) {
                return;
            }
            $this.addClass('active').parent().siblings().find('a').removeClass('active');

            var dataFilter  = $this.attr('data-filter'),
                isotopeWrap = $this.closest('.projects-filter-wrapper').find('.projects-masonry');
            isotopeWrap.isotope({ 
                filter: dataFilter 
            });
        });
    }

    /* --------------------------------------------------
    * handle after scroll/load/resize
    * --------------------------------------------------*/
    $(window).on('scroll', function() {
        lineProgress();
        circleProgress();
    });
    $(window).on('load', function () {
        lineProgress();
        circleProgress();
        otIsotope();
    });
    $(window).on('resize', function () {
        lineProgressSize();
    });

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function () {

        if ( window.elementorFrontend.isEditMode() ) {
            /* Portfolio filter isotop */
            window.elementorFrontend.hooks.addAction(
                "frontend/element_ready/ot-portfolio-filter.default",
                function () {
                    otIsotope();
                }
            );
        }

        /* Progress bar */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-progress.default",
            progressBar
        );
        
    	/*video popup*/
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-btn-play.default",
            videoPopup
        );
        /* Custom accordions */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-accordions.default",
            customAccordions
        );
        /* Custom tabs */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-tabs.default",
            customTabs
        );
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-big-tabs.default",
            otBigTabs
        );
        /* Counter */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-counter.default",
            function () {
                otCounter();
            }
        );
        /* Countdown */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-countdown.default",
            countDown
        );
        /* Clients carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-clients-slider.default",
            clientsSlider
        );
        /* Testimonial carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-testimonials-slider.default",
            testimonialSlider
        );
        /* Project carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-portfolio-carousel.default",
            projectsSlider
        );
        /* Post carousel */
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/ot-posts-carousel.default",
            otPostSlider
        );
    });

} )( jQuery );