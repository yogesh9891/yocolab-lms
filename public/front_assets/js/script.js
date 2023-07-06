!(function (e) {
    "use strict";
    e(document).on("ready", function () {
        e("#respMenu").aceResponsiveMenu({ resizeWidth: "768", animationSpeed: "fast", accoridonExpAll: !1 });
    }),
        e(".tags-bar > span i").on("click", function () {
            e(this).parent().fadeOut();
        }),
        e(function () {
            e(".btns").on("click", function () {
                e(".content_details").toggleClass("is-full-width");
            });
        }),
        e(window).on("scroll", function () {
            if (e(".scroll-to-top").length) {
                e(window).scrollTop() > 100 ? e(".scroll-to-top").fadeIn(500) : e(this).scrollTop() <= 100 && e(".scroll-to-top").fadeOut(500);
            }
            if (e(".stricky").length) {
                var t = e(".header-navigation").next().offset().top,
                    a = e(".stricky");
                e(window).scrollTop() > t
                    ? (a.removeClass("slideIn animated"), a.addClass("stricky-fixed slideInDown animated"))
                    : e(this).scrollTop() <= t && (a.removeClass("stricky-fixed slideInDown animated"), a.addClass("slideIn animated"));
            }
        }),
        e(".mouse_scroll").on("click", function () {
            e("html, body").animate({ scrollTop: e("#our-courses").offset().top }, 1e3);
        }),
        e(document).on("ready", function () {
            e(".collapse").on("show.bs.collapse", function () {
                e(this).siblings(".card-header").addClass("active");
            }),
                e(".collapse").on("hide.bs.collapse", function () {
                    e(this).siblings(".card-header").removeClass("active");
                }),
                e(function () {
                    e('[data-toggle="tooltip"]').tooltip();
                });
        }),
        e(document).on("ready", function () {
            e(".cart_btn")
                .children("ul.cart")
                .children("li")
                .each(function (t) {
                    e(this)
                        .children("ul.dropdown_content")
                        .children("li")
                        .each(function (t) {
                            var a = 0.1 + 0.03 * t;
                            e(this).css("animation-delay", a + "s");
                        });
                });
        }),
        e(document).on("ready", function () {
            var t = window.innerHeight;
            e("#mk-fullscreen-searchform").css("top", t / 2),
                jQuery(window).resize(function () {
                    (t = window.innerHeight), e("#mk-fullscreen-searchform").css("top", t / 2);
                }),
                e("#search-button, #search-button2").on("click", function () {
                    console.log("Open Search, Search Centeredyuyu"),
                        console.log(e("#mk-fullscreen-search-input").attr("autofocus", "autofocus")),
                        e("div.mk-fullscreen-search-overlay").addClass("mk-fullscreen-search-overlay-show"),
                        e("#mk-fullscreen-search-input").focus();
                }),
                e("a.mk-fullscreen-close").on("click", function () {
                    console.log("Closed Search"), e("div.mk-fullscreen-search-overlay").removeClass("mk-fullscreen-search-overlay-show");
                });
        });
    const t = new Date().getFullYear() + 1;
    e("#countdown").countdown({ year: t }),
        e(".circlechart").circlechart(),
        e(function () {
            e("nav#menu").mmenu();
        }),
        e(function () {
            e("#slider-range").slider({
                range: !0,
                min: 50,
                max: 150,
                values: [50, 120],
                slide: function (t, a) {
                    e("#amount").val("$" + a.values[0] + " - $" + a.values[1]);
                },
            }),
                e("#amount").val("$" + e("#slider-range").slider("values", 0) + " - $" + e("#slider-range").slider("values", 1));
        }),
        e(document).on("ready", function () {
            e(".slider-range").slider({
                range: !0,
                min: 1998,
                max: 2040,
                values: [1998, 2018],
                slide: function (t, a) {
                    e(".amount").val(a.values[0]), e(".amount2").val(a.values[1]);
                },
            }),
                e(".amount").change(function () {
                    e(".slider-range").slider("values", 0, e(this).val());
                }),
                e(".amount2").change(function () {
                    e(".slider-range").slider("values", 1, e(this).val());
                });
        }),
        e(".progress-levels .progress-box .bar-fill").length &&
            e(".progress-box .bar-fill").each(function () {
                var t = e(this).attr("data-percent");
                e(this).css("width", t + "%"),
                    e(this)
                        .children(".percent")
                        .html(t + "%");
            }),
        e(".progressbar1").progressBar({ shadow: !1, percentage: !1, animation: !0, barColor: "#2441e7" }),
        e(".progressbar2").progressBar({ shadow: !1, percentage: !1, animation: !0, barColor: "#2441e7" }),
        e(".progressbar3").progressBar({ shadow: !1, percentage: !1, animation: !0, animateTarget: !0, barColor: "#2441e7" }),
        e(".progressbar4").progressBar({ shadow: !1, percentage: !1, animation: !0, animateTarget: !0, barColor: "#2441e7" }),
        e(".progressbar5").progressBar({ shadow: !1, percentage: !1, animation: !0, animateTarget: !0, barColor: "#2441e7" });
    var a = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        },
    };
    jQuery(document).on("ready", function () {
        jQuery(window).stellar({ horizontalScrolling: !1, hideDistantElements: !0, verticalScrolling: !a.any(), scrollProperty: "scroll", responsive: !0 });
    }),
        (e(".popup-img").length > 0 || e(".popup-iframe").length > 0 || e(".popup-img-single").length > 0) &&
            (e(".popup-img").magnificPopup({ type: "image", gallery: { enabled: !0 } }),
            e(".popup-img-single").magnificPopup({ type: "image", gallery: { enabled: !1 } }),
            e(".popup-iframe").magnificPopup({ disableOn: 700, type: "iframe", preloader: !1, fixedContentPos: !1 }),
            e(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({ disableOn: 700, type: "iframe", mainClass: "mfp-fade", removalDelay: 160, preloader: !1, fixedContentPos: !1 })),
        e("#myTab a").on("click", function (t) {
            t.preventDefault(), e(this).tab("show");
        }),
        e(".datepicker").length && e(".datepicker").datetimepicker(),
        e("#maximage").length &&
            (e("#maximage").maximage({
                cycleOptions: { fx: "fade", speed: 500, timeout: 2e4, prev: "#arrow_left", next: "#arrow_right" },
                onFirstImageLoaded: function () {
                    jQuery("#cycle-loader").hide(), jQuery("#maximage").fadeIn("fast");
                },
            }),
            jQuery("#html5video").maximage("maxcover"),
            jQuery(".in-slide-content").delay(2e3).fadeIn()),
        e("#js-main-slider").length &&
            e("#js-main-slider").pogoSlider({ autoplay: !0, autoplayTimeout: 5e3, displayProgess: !0, generateNav: !1, preserveTargetSize: !0, targetWidth: 1e3, targetHeight: 300, responsive: !0 }).data("plugin_pogoSlider"),
        e(".tes-for").length &&
            (e(".tes-for").slick({ slidesToShow: 1, slidesToScroll: 1, arrows: !1, fade: !1, autoplay: !0, autoplaySpeed: 2e3, asNavFor: ".tes-nav" }),
            e(".tes-nav").slick({ slidesToShow: 3, slidesToScroll: 1, asNavFor: ".tes-for", dots: !1, arrows: !1, centerPadding: "1px", centerMode: !0, focusOnSelect: !0 })),
        e(".home5_slider").length &&
            e(".home5_slider").owlCarousel({
                animateIn: "fadeIn",
                loop: !0,
                margin: 15,
                dots: !0,
                nav: !1,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                smartSpeed: 2e3,
                singleItem: !0,
                navText: ['<i class="flaticon-left-arrow"></i> <span>PR </br> EV</span>', '<span>NE </br> XT</span> <i class="flaticon-right-arrow-1"></i>'],
                responsive: { 320: { items: 1, center: !1 }, 480: { items: 1, center: !1 }, 600: { items: 1, center: !1 }, 768: { items: 1 }, 992: { items: 1 }, 1200: { items: 1 } },
            }),
        e(".blog_slider_home1").length &&
            e(".blog_slider_home1").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                smartSpeed: 2e3,
                singleItem: !0,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: { 320: { items: 1, center: !1 }, 480: { items: 1, center: !1 }, 600: { items: 1, center: !1 }, 768: { items: 1 }, 992: { items: 1 }, 1200: { items: 1 } },
            }),
        e(".popular_course_slider").length &&
            e(".popular_course_slider").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 },
                    1366: { items: 4 },
                    1400: { items: 5 },
                },
            }),
        e(".related-course-slider").length &&
            e(".related-course-slider").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 },
                    1366: { items: 4 },
                    1400: { items: 4 },
                },
            }),
        e(".popular_course_slider_home3").length &&
            e(".popular_course_slider_home3").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 3 },
                    1366: { items: 4 },
                    1400: { items: 4 },
                },
            }),
        e(".instructor_slider_home3").length &&
            e(".instructor_slider_home3").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !0,
                nav: !1,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 },
                    1366: { items: 4 },
                    1400: { items: 5 },
                },
            });
    var o = e(".slider .slick-slide").index(e("#center_on_me"));
    e(".testimonial-slider-nav").slick({
        slidesToShow: 3,
        infinite: !0,
        centerMode: !0,
        slidesToScroll: 1,
        initialSlide: o,
        dots: !0,
        focusOnSelect: !0,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 3, infinite: !0, dots: !0 } },
            { breakpoint: 600, settings: { slidesToShow: 1, slidesToScroll: 1 } },
            { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
        ],
    }),
        e(".testimonial_slider_home2").length &&
            e(".testimonial_slider_home2").owlCarousel({
                center: !0,
                loop: !0,
                margin: 15,
                dots: !0,
                nav: !1,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 2 },
                    992: { items: 2 },
                    1200: { items: 3 },
                    1366: { items: 3 },
                    1400: { items: 3 },
                },
            }),
        e(".banner-style-one").length &&
            (e(".banner-style-one").owlCarousel({ loop: !0, items: 1, margin: 0, dots: !0, nav: !0, animateOut: "fadeOut", animateIn: "fadeIn", active: !0, smartSpeed: 1e3, autoplay: !1 }),
            e(".banner-carousel-btn .left-btn").on("click", function () {
                return e(".banner-style-one").trigger("next.owl.carousel"), !1;
            }),
            e(".banner-carousel-btn .right-btn").on("click", function () {
                return e(".banner-style-one").trigger("prev.owl.carousel"), !1;
            })),
        e(".banner-style-two").length &&
            (e(".banner-style-two").owlCarousel({ loop: !0, items: 1, margin: 0, dots: !0, nav: !0, animateOut: "slideOutDown", animateIn: "fadeIn", active: !0, smartSpeed: 1e3, autoplay: !1 }),
            e(".banner-carousel-btn2 .left-btn").on("click", function () {
                return e(".banner-style-two").trigger("next.owl.carousel"), !1;
            }),
            e(".banner-carousel-btn2 .right-btn").on("click", function () {
                return e(".banner-style-two").trigger("prev.owl.carousel"), !1;
            })),
        e(".blog_post_slider_home4").length &&
            e(".blog_post_slider_home4").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: { 0: { items: 1, center: !1 }, 480: { items: 1, center: !1 }, 600: { items: 1, center: !1 }, 768: { items: 2 }, 992: { items: 3 }, 1200: { items: 3 } },
            }),
        e(".testimonial_slider_home3").length &&
            e(".testimonial_slider_home3").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !0,
                nav: !1,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                smartSpeed: 2e3,
                singleItem: !0,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: { 320: { items: 1, center: !1 }, 480: { items: 1, center: !1 }, 600: { items: 1, center: !1 }, 768: { items: 1 }, 992: { items: 1 }, 1200: { items: 1 } },
            }),
        e(".media_slider_home7").length &&
            e(".media_slider_home7").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 3 },
                    1366: { items: 3 },
                    1400: { items: 3 },
                },
            }),
        e(".team_slider").length &&
            e(".team_slider").owlCarousel({
                loop: !0,
                margin: 30,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 2, center: !1 },
                    600: { items: 2, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 },
                    1366: { items: 5 },
                    1400: { items: 5 },
                },
            }),
        e(".shop_product_slider,.feature_post_slider").length &&
            e(".shop_product_slider,.feature_post_slider").owlCarousel({
                loop: !0,
                margin: 30,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !1,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 2, center: !1 },
                    768: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 3 },
                    1366: { items: 4 },
                    1400: { items: 4 },
                },
            }),
        e(".single_product_slider").length &&
            e(".single_product_slider").owlCarousel({
                animateIn: "fadeIn",
                loop: !0,
                margin: 30,
                dots: !1,
                nav: !0,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: {
                    0: { items: 1, center: !1 },
                    480: { items: 1, center: !1 },
                    520: { items: 1, center: !1 },
                    600: { items: 1, center: !1 },
                    768: { items: 1 },
                    992: { items: 1 },
                    1200: { items: 1 },
                    1366: { items: 1 },
                    1400: { items: 1 },
                },
            }),
        e(".blog_post_slider_home2").length &&
            e(".blog_post_slider_home2").owlCarousel({
                loop: !0,
                margin: 15,
                dots: !0,
                nav: !1,
                rtl: !1,
                autoplayHoverPause: !1,
                autoplay: !0,
                singleItem: !0,
                smartSpeed: 1200,
                navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-1"></i>'],
                responsive: { 0: { items: 1, center: !1 }, 480: { items: 1, center: !1 }, 520: { items: 1, center: !1 }, 600: { items: 1, center: !1 }, 768: { items: 2 }, 992: { items: 3 }, 1200: { items: 3 } },
            }),
        e(document).on("ready", function () {
            !(function () {
                e(".navbar-scrolltofixed").scrollToFixed();
                var t = e(".summary");
                t.each(function (a) {
                    var o = e(t[a]),
                        s = t[a + 1];
                    o.scrollToFixed({
                        marginTop: e(".navbar-scrolltofixed").outerHeight(!0) + 10,
                        limit: function () {
                            return s ? e(s).offset().top - e(this).outerHeight(!0) - 10 : e(".footer").offset().top - e(this).outerHeight(!0) - 10;
                        },
                        zIndex: 999,
                    });
                });
            })(),
                e(window).scroll(function () {
                    e(this).scrollTop() > 600 ? e(".scrollToHome").fadeIn() : e(".scrollToHome").fadeOut();
                }),
                e(".scrollToHome").on("click", function () {
                    return e("html, body").animate({ scrollTop: 0 }, 800), !1;
                }),
                new WOW({ animateClass: "animated", mobile: !0, offset: 0 }).init(),
                e("#main-nav-bar .navbar-nav .sub-menu").length &&
                    (e("#main-nav-bar .navbar-nav .sub-menu")
                        .parent("li")
                        .children("a")
                        .append(function () {
                            return '<button class="sub-nav-toggler"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>';
                        }),
                    e("#main-nav-bar .navbar-nav .sub-nav-toggler").on("click", function () {
                        return e(this).parent().parent().children(".sub-menu").slideToggle(), !1;
                    }));
        }),
        e(window).on("load", function () {
            e("div.timer").counterUp({ delay: 5, time: 2e3 }),
                e(".preloader").length && e(".preloader").delay(200).fadeOut(300),
                e(".preloader_disabler").on("click", function () {
                    e("#preloader").hide();
                });
        }),
        e(window).on("scroll", function () {});







})(window.jQuery);
