//SHOWROV var
var SHOWROV = {};

(function($) {

    /*************************
    Predefined Variables
    *************************/
    var $window = $(window),
        $document = $(document);

    //Check if function exists
    $.fn.exists = function() {
        return this.length > 0;
    };

    /*************************
    Window load functions
    *************************/
    //Preloader
    $window.on("load", function() {
        SHOWROV.preloader = function() {
            $("#load").fadeOut();
            $('#loading').delay(0).fadeOut('slow');
        };
        SHOWROV.preloader();
    });


    /*************************
    Document ready functions
    *************************/
    $document.ready(function() {
        // active menu
        var currentmenu = $('.sms-focus');
        currentmenu.on('click', function() {
            $(this).addClass('current').siblings().removeClass('current');
        });

        // click  dropdown menu
        var carkhanadrop = $('.carkhana-drop > a');
        carkhanadrop.on('click', function(e) {
            event.preventDefault();
            $(this).parent('li').find('ul').toggleClass('carkhana-drop-active');
            $(this).parent('li').siblings().find('ul').removeClass('carkhana-drop-active');
        });

        // click  Seller-profile-dropdown menu
        var sellerdrop = $('.sms-dropdown');
        sellerdrop.on('click', function() {
            $(this).parent().find('ul').toggleClass('drop-active').siblings('ul').removeClass('drop-active');
        });

        // Toggle menu
        var smsToggle = $('.sms-menu-toggle');
        smsToggle.on('click', function() {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $(this).siblings('.sms-main-menu').removeClass('open');
            } else {
                $(this).addClass('open');
                $(this).siblings('.sms-main-menu').addClass('open');
            }
        });

        // Filter Search toggle

        var smsfilterToggle = $('.sms-advance');
        smsfilterToggle.on('click', function() {
            $(this).parents('.tab-pane').find('.sms-toggle-content').slideToggle(300);
        });

        // Insurance-check toggle

        var insuranceToggle = $('.quick-details');
        insuranceToggle.on('click', function() {
            $(this).parents('.insurance-area').find('.card-features').slideToggle(300);
        });


        /*************************
        Compare-car Filter-Form
        *************************/

        var compareToggle = $('#filter_toggle');
        compareToggle.on('click', function() {
            $("#filter_form").slideToggle(400);
        });

        /*************************
        Cart-dropdown menu
        *************************/

        var cartmenuToggle = $('#cart');
        cartmenuToggle.on('click', function() {
            $(".shopping-cart").toggleClass("active");
        });

        /*--- showlogin toggle function ----*/
        $('#showlogin').on('click', function() {
            $('#checkout-login').slideToggle(500);
        });

        /*--- showlogin toggle function ----*/
        $('#showcoupon').on('click', function() {
            $('#checkout_coupon').slideToggle(500);
        });

        /*--- showlogin toggle function ----*/
        $('#ship-box').on('click', function() {
            $('#ship-box-info').slideToggle(700);
        });


        /*************************
        Chat-box
        *************************/

        hideChat(0);

        $('#prime').click(function() {
            toggleFab();
        });


        //Toggle chat and links
        function toggleFab() {
            $('.prime').toggleClass('zmdi-comment-outline');
            $('.prime').toggleClass('zmdi-close');
            $('.prime').toggleClass('is-active');
            $('.prime').toggleClass('is-visible');
            $('#prime').toggleClass('is-float');
            $('.chat').toggleClass('is-visible');
            $('.fab').toggleClass('is-visible');

        }

        $('#chat_first_screen').click(function(e) {
            hideChat(1);
        });

        $('#chat_second_screen').click(function(e) {
            hideChat(2);
        });

        $('#chat_third_screen').click(function(e) {
            hideChat(3);
        });

        $('#chat_fourth_screen').click(function(e) {
            hideChat(4);
        });

        $('#chat_fullscreen_loader').click(function(e) {
            $('.fullscreen').toggleClass('zmdi-window-maximize');
            $('.fullscreen').toggleClass('zmdi-window-restore');
            $('.chat').toggleClass('chat_fullscreen');
            $('.fab').toggleClass('is-hide');
            $('.header_img').toggleClass('change_img');
            $('.img_container').toggleClass('change_img');
            $('.chat_header').toggleClass('chat_header2');
            $('.fab_field').toggleClass('fab_field2');
            $('.chat_converse').toggleClass('chat_converse2');
            //$('#chat_converse').css('display', 'none');
            // $('#chat_body').css('display', 'none');
            // $('#chat_form').css('display', 'none');
            // $('.chat_login').css('display', 'none');
            // $('#chat_fullscreen').css('display', 'block');
        });

        function hideChat(hide) {
            switch (hide) {
                case 0:
                    $('#chat_converse').css('display', 'none');
                    $('#chat_body').css('display', 'none');
                    $('#chat_form').css('display', 'none');
                    $('.chat_login').css('display', 'block');
                    $('.chat_fullscreen_loader').css('display', 'none');
                    $('#chat_fullscreen').css('display', 'none');
                    break;
                case 1:
                    $('#chat_converse').css('display', 'block');
                    $('#chat_body').css('display', 'none');
                    $('#chat_form').css('display', 'none');
                    $('.chat_login').css('display', 'none');
                    $('.chat_fullscreen_loader').css('display', 'block');
                    break;
                case 2:
                    $('#chat_converse').css('display', 'none');
                    $('#chat_body').css('display', 'block');
                    $('#chat_form').css('display', 'none');
                    $('.chat_login').css('display', 'none');
                    $('.chat_fullscreen_loader').css('display', 'block');
                    break;
                case 3:
                    $('#chat_converse').css('display', 'none');
                    $('#chat_body').css('display', 'none');
                    $('#chat_form').css('display', 'block');
                    $('.chat_login').css('display', 'none');
                    $('.chat_fullscreen_loader').css('display', 'block');
                    break;
                case 4:
                    $('#chat_converse').css('display', 'none');
                    $('#chat_body').css('display', 'none');
                    $('#chat_form').css('display', 'none');
                    $('.chat_login').css('display', 'none');
                    $('.chat_fullscreen_loader').css('display', 'block');
                    $('#chat_fullscreen').css('display', 'block');
                    break;
            }
        }


        /*************************
                  Accordion
        *************************/
        var accordionToggle = $('.smstoggle');
        accordionToggle.on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            if ($this.next().hasClass('show')) {
                $this.next().removeClass('show');
                $this.next().slideUp(350);
            } else {
                $this.parent().parent().find('li .smsinner').removeClass('show');
                $this.parent().parent().find('li .smsinner').slideUp(350);
                $this.next().toggleClass('show');
                $this.next().slideToggle(350);
            }
        });

        SHOWROV.carousel(),
            SHOWROV.scrolltotop(),
            SHOWROV.slickslider(),
            SHOWROV.tabs(),
            SHOWROV.featurelist();

        $('.inner-intro').ripples({
            resolution: 200,
            dropRadius: 15,
            perturbance: 0.01
        });

    });




    /*************************
           Sticky menu
    *************************/

    $(function() {
        var shrinkHeader = 100;
        $window.scroll(function() {
            var scroll = getCurrentScroll();
            if (scroll >= shrinkHeader) {
                $('.sms-menu').addClass('shrink');
            } else {
                $('.sms-menu').removeClass('shrink');
            }
        });

        function getCurrentScroll() {
            return window.pageYOffset || document.documentElement.scrollTop;
        }
    });
    // /*----------------------------
    // 	Cart Plus Minus Button
    // ------------------------------ */

    $('.inc.qtybutton').click(function() {
        if ($(this).prev().val() < 20000) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.dec.qtybutton').click(function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

    /*************************
    Featured Cars  owl carousel 
    *************************/
    SHOWROV.carousel = function() {
        $(".owl-carousel").each(function() {
            var $this = $(this),
                $items = ($this.data('items')) ? $this.data('items') : 1,
                $loop = ($this.data('loop')) ? $this.data('loop') : true,
                $navdots = ($this.data('nav-dots')) ? $this.data('nav-dots') : true,
                $navarrow = ($this.data('nav-arrow')) ? $this.data('nav-arrow') : false,
                $autoplay = ($this.attr('data-autoplay')) ? $this.data('autoplay') : true,
                $space = ($this.attr('data-space')) ? $this.data('space') : 30;
            $(this).owlCarousel({
                loop: $loop,
                items: $items,
                responsive: {
                    0: {
                        items: $this.data('xx-items') ? $this.data('xx-items') : 1
                    },
                    480: {
                        items: $this.data('xs-items') ? $this.data('xs-items') : 1
                    },
                    768: {
                        items: $this.data('sm-items') ? $this.data('sm-items') : 2
                    },
                    980: {
                        items: $this.data('md-items') ? $this.data('md-items') : 3
                    },
                    1200: {
                        items: $this.data('md-items') ? $this.data('md-items') : 3
                    }
                },
                dots: $navdots,
                margin: $space,
                nav: $navarrow,
                navText: ["<i class='fa fa-angle-left fa-2x'></i>", "<i class='fa fa-angle-right fa-2x'></i>"],
                autoplay: $autoplay,
                autoplayHoverPause: true
            });

        });
    };


    /* -------------------------------------
    			Compare SLIDER
    	-------------------------------------- */
    var swiper = new Swiper('#tg-compare-slider', {
        grabCursor: false,
        paginationClickable: true,
        autoplay: 4000,
        slidesPerView: 1,
        effect: 'fade',
        loop: true,
        prevButton: '.tg-prev',
        nextButton: '.tg-next',
        pagination: '.tg-pagination',

    });

    /*************************
          Slick slider  
    *************************/
    SHOWROV.slickslider = function() {
        if ($(".slider-slick").exists()) {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: true,
                focusOnSelect: true
            });
        }
    };

    /*************************
              Tabs
    *************************/
    SHOWROV.tabs = function() {
        var $tabsdata = $("#tabs li[data-tabs]"),
            $tabscontent = $(".tabcontent"),
            $tabsnav = $(".tabs li");

        $tabsdata.on('click', function() {
            $(this).parent().parent().find('.active').removeClass('active');
            $(this).parent().parent().find('.tabcontent').hide();
            var tab = $(this).data('tabs');
            $(this).addClass('active');
            $('#' + tab).fadeIn().show();
        });

        $tabsnav.on('click', function() {
            var cur = $tabsnav.index(this);
            var elm = $(this).parent().parent().find('.tabcontent:eq(' + cur + ')');
            elm.addClass("pulse");
            setTimeout(function() {
                elm.removeClass("pulse");
            }, 220);
        });
        $("li[data-tabs]").each(function() {
            $(this).parent().parent().find('.tabcontent').hide().filter(':first').show();
        });
    };

    /*************************
          List group item
     *************************/
    SHOWROV.featurelist = function() {
        var $featurenav = $(".list-group-item a");
        $featurenav.on('click', function() {
            if (!($(this).hasClass("current"))) {
                $featurenav.removeClass("current").next("ul").slideUp();
            }
            $(this).toggleClass("current");
            $(this).next("ul").slideToggle("slow");
            return false;
        });
    };


    /*************************
          Scroll to Top
    *************************/
    SHOWROV.scrolltotop = function() {
        var $scrolltop = $('.car-top');

        $scrolltop.on('click', function() {
            $('html,body').animate({
                scrollTop: 0
            }, 800);
            $(this).addClass("car-run");
            setTimeout(function() {
                $scrolltop.removeClass('car-run');
            }, 1000);
            return false;
        });
        $window.on('scroll', function() {
            if ($window.scrollTop() >= 200) {
                $scrolltop.addClass("show");
                $scrolltop.addClass("car-down");
            } else {
                $scrolltop.removeClass("show");
                setTimeout(function() {
                    $scrolltop.removeClass('car-down');
                }, 300);
            }
        });
    };

    /*************************
          Scroll to Top
    *************************/
    SHOWROV.sidebarfixed = function() {
        if ($(".listing-sidebar").exists()) {
            (function() {
                var reset_scroll;

                $(function() {
                    return $("[data-sticky_column]").stick_in_parent({
                        parent: "[data-sticky_parent]"
                    });
                });

                reset_scroll = function() {
                    var scroller;
                    scroller = $("body,html");
                    scroller.stop(true);
                    if ($window.scrollTop() !== 0) {
                        scroller.animate({
                            scrollTop: 0
                        }, "fast");
                    }
                    return scroller;
                };

                window.scroll_it = function() {
                    var max;
                    max = $document.height() - $window.height();
                    return reset_scroll().animate({
                        scrollTop: max
                    }, max * 3).delay(100).animate({
                        scrollTop: 0
                    }, max * 3);
                };
                window.scroll_it_wobble = function() {
                    var max, third;
                    max = $document.height() - $window.height();
                    third = Math.floor(max / 3);
                    return reset_scroll().animate({
                        scrollTop: third * 2
                    }, max * 3).delay(100).animate({
                        scrollTop: third
                    }, max * 3).delay(100).animate({
                        scrollTop: max
                    }, max * 3).delay(100).animate({
                        scrollTop: 0
                    }, max * 3);
                };

                $window.on("resize", (function(_this) {
                    return function(e) {
                        return $(document.body).trigger("sticky_kit:recalc");
                    };
                })(this));

            }).call(this);

            (function() {
                var sticky;
                if (window.matchMedia('(min-width: 768px)').matches) {
                    $(".listing-sidebar").sticky({
                        topSpacing: 0
                    });
                }
            });
        }
    };
})
(jQuery);