<div data-items="1" data-dots="true" data-height="100%" data-draggable="true"
     data-arrows="false"
     class="ct-js-slick ct-u-displayTable ct-dots--type1 ct-dots--positionBottom">
    @if($homeSlides) @foreach($homeSlides as $slide)
        <div data-background="{{$slide->slide_background}}"
             class="item text-center">
            <div class="item-inner">
                <div class="container containersize">
                    <div class="row">

                        <div class="col-lg-7 col-md-7 col-sm-12 text-right col-xs-12 ">
                            @if($slide->slide_photo)
                                <img src="{{url($slide->slide_photo)}}" alt="{{$slide->name}}"
                                     class="ct-animationFloating--vertical ssp">
                            @endif
                        </div>
                        <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-0 col-sm-12 ct-u-padding-top-50 col-xs-12">
                            <div class="ct-pageHeader ct-pageHeader--type1 text-center-sm">
                                <img src=""/>
                                <h1 class="ct-pageHeader-title text-left engfirst">{{$slide->name}}</h1>
                                <h1 class="ct-pageHeader-title tittle01 text-left">{{$slide->slide_description}} </h1>
                                <div class="btn-group btn-group--alignLeft ct-u-margin-top-30">
                                    <a href="#/product/{{$slide->id}}"
                                       class="btn btn-transparent btn--withIcon btn--motiveColor spes1"
                                       translate="know_more">{{trans('main.know_more')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>
<script>
    $(".spes1").click(function () {
        $(".productinfo").addClass('bounceInRight-duration bounceInRight');
        $(".productinfo").removeClass('bounceOutRight');
    });
    (function(t) {
        t(document).ready(function () {
            var e = 1200, n = 992, i = 768, o = 480, s = t(".ct-js-slick");
            t(".ct-js-slick").each(function () {
                var e = t(this).find(".item").first().height();
                t(this).css("height", e + "px")
            }), t().slick && s.length > 0 && s.each(function () {
                var s = t(this), r = parseInt(validatedata(s.attr("data-items"), 1), 10), a = parseInt(validatedata(s.attr("data-items-xs"), r), 10), l = parseInt(validatedata(s.attr("data-items-sm"), a), 10), c = parseInt(validatedata(s.attr("data-items-md"), l), 10), d = parseInt(validatedata(s.attr("data-items-lg"), c), 10), u = parseBoolean(s.attr("data-accessibility"), !0), p = parseBoolean(s.attr("data-adaptiveHeight"), !1), f = parseBoolean(s.attr("data-autoplay"), !1), h = parseBoolean(s.attr("data-arrows"), !0), g = parseBoolean(s.attr("data-centerMode"), !1), v = parseBoolean(s.attr("data-dots"), !1), m = parseBoolean(s.attr("data-draggable"), !0), y = parseBoolean(s.attr("data-fade"), !1), b = parseBoolean(s.attr("data-focusOnSelect"), !1), w = parseBoolean(s.attr("data-infinite"), !0), x = parseBoolean(s.attr("data-mobileFirst"), !0), T = parseBoolean(s.attr("data-pauseOnHover"), !0), k = parseBoolean(s.attr("data-pauseOnDotsHover"), !1), C = parseBoolean(s.attr("data-swipe"), !0), S = parseBoolean(s.attr("data-swipeToSlide"), !0), $ = parseBoolean(s.attr("data-touchMove"), !0), _ = parseBoolean(s.attr("data-useCSS"), !0), A = parseBoolean(s.attr("data-variableWidth"), !1), E = parseBoolean(s.attr("data-vertical"), !1), O = parseBoolean(s.attr("data-rtl"), !1), N = validatedata(s.attr("data-asNavFor")), D = validatedata(s.attr("data-appendArrows")), I = validatedata(s.attr("data-prevArrow"), '<button type="button" class="slick-nav slick-prev"></button>'), j = validatedata(s.attr("data-nextArrow"), '<button type="button" class="slick-nav slick-next"></button>'), P = validatedata(s.attr("data-centerPadding"), "50px"), L = validatedata(s.attr("data-cssEase"), "ease"), H = validatedata(s.attr("data-easing"), "linear"), F = validatedata(s.attr("data-lazyLoad"), "ondemand"), q = validatedata(s.attr("data-respondTo"), "window"), z = validatedata(s.attr("data-slide")), M = (validatedata(s.attr("data-animations"), !0), parseInt(validatedata(s.attr("data-edgeFriction"), .15), 10)), R = parseInt(validatedata(s.attr("data-initialSlide"), 0), 10), B = parseInt(validatedata(s.attr("data-autoplaySpeed"), 5e3), 10), W = parseInt(validatedata(s.attr("data-slidesToScroll"), 1), 10), U = parseInt(validatedata(s.attr("data-speed"), 300), 10), V = parseInt(validatedata(s.attr("data-touchThreshold"), 5), 10);
                if (s.attr("data-height")) {
                    var X = s.attr("data-height") + "px";
                    X.indexOf("%") > -1 ? (s.css("min-height", device_height * (parseInt(device_height, 10) / 100)), s.find(".slick-list").css("min-height", device_height * (parseInt(X, 10) / 100)), s.find(".slick-track").css("min-height", device_height * (parseInt(X, 10) / 100)), s.find(".item").each(function () {
                        t(this).css("min-height", device_height * (parseInt(X, 10) / 100))
                    })) : (s.css("min-height", parseInt(X, 10) + "px"), s.find(".slick-list").css("min-height", parseInt(X, 10) + "px"), s.find(".slick-track").css("min-height", parseInt(X, 10) + "px"), s.find(".item").each(function () {
                        t(this).css("min-height", parseInt(X, 10) + "px")
                    }))
                }
                s.slick({
                    slidesToShow: r,
                    accessibility: u,
                    adaptiveHeight: p,
                    autoplay: f,
                    autoplaySpeed: B,
                    arrows: h,
                    asNavFor: N,
                    appendArrows: D,
                    prevArrow: I,
                    nextArrow: j,
                    centerMode: g,
                    centerPadding: P,
                    cssEase: L,
                    dots: v,
                    draggable: m,
                    fade: y,
                    focusOnSelect: b,
                    easing: H,
                    edgeFriction: M,
                    infinite: w,
                    initialSlide: R,
                    lazyLoad: F,
                    mobileFirst: x,
                    pauseOnHover: T,
                    pauseOnDotsHover: k,
                    respondTo: q,
                    slide: z,
                    slidesToScroll: W,
                    speed: U,
                    swipe: C,
                    swipeToSlide: S,
                    touchMove: $,
                    touchThreshold: V,
                    useCSS: _,
                    variableWidth: A,
                    vertical: E,
                    rtl: O
                }), s.hasClass("ct-slick--parallaxMode") && (s.on("beforeChange", function () {
                    s.find(".item").css("background-attachment", "scroll")
                }), s.on("afterChange", function () {
                    s.find(".item").css("background-attachment", "fixed")
                })), s.slick("setOption", "responsive", [{
                    breakpoint: e,
                    settings: {slidesToShow: d}
                }], !0), s.slick("setOption", "responsive", [{
                    breakpoint: n,
                    settings: {slidesToShow: c}
                }], !0), s.slick("setOption", "responsive", [{
                    breakpoint: i,
                    settings: {slidesToShow: l}
                }], !0), s.slick("setOption", "responsive", [{
                    breakpoint: o,
                    settings: {slidesToShow: a}
                }], !0), s.on("setPosition", function () {
                    set_text_color(), set_font_size(), set_background(), set_height()
                })
            })
        })
    })(jQuery)
</script>