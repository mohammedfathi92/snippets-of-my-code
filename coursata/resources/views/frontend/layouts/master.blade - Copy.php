<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" data-ng-app="frontendApp">

<head>
    <meta charset="utf-8">
    @yield('meta')
    <meta name="author" content="php.Mohammedfathi@gmail.com">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#e04f67">
    <meta name="description" content="{{$meta_description}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="author" content="Mohammed Zidan">
    <title>{{$title}}</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{Storage::url(Settings::get("favicon"))}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{Storage::url(Settings::get("favicon"))}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="{{Storage::url(Settings::get("favicon"))."?size=72,72"}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{Storage::url(Settings::get("favicon"))."?size=114,114"}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{Storage::url(Settings::get("favicon"))."?size=114,114"}}">

    <!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i"
          rel="stylesheet">
   

    <!-- BASE CSS -->
    @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
        <link href="/assets/css-rtl/base.css" rel="stylesheet">
        <!-- Radio and check inputs -->
        <link href="/assets/css-rtl/skins/square/grey.css" rel="stylesheet">

        <!-- Range slider -->
        <link href="/assets/css-rtl/ion.rangeSlider.css" rel="stylesheet">
        <link href="/assets/css-rtl/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    @else
        <link href="/assets/css/base.css" rel="stylesheet">
        <!-- Radio and check inputs -->
        <link href="/assets/css/skins/square/grey.css" rel="stylesheet">

        <!-- Range slider -->
        <link href="/assets/css/ion.rangeSlider.css" rel="stylesheet">
        <link href="/assets/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    @endif

<!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css"
          href="/assets/rev-slider-files/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/css/settings.css">
    <link rel="stylesheet" type="text/css" href="/assets/css-rtl/follow-btn.css">

    <!-- REVOLUTION LAYERS STYLES -->
    <style>
        .tp-caption.NotGeneric-Title,
        .NotGeneric-Title {
            color: rgba(255, 255, 255, 1.00);
            font-size: 70px;
            line-height: 70px;
            font-weight: 800;
            font-style: normal;
            text-decoration: none;
            background-color: transparent;
            border-color: transparent;
            border-style: none;
            border-width: 0px;
            border-radius: 0 0 0 0px
        }

        .tp-caption.NotGeneric-SubTitle,
        .NotGeneric-SubTitle {
            color: rgba(255, 255, 255, 1.00);
            font-size: 13px;
            line-height: 20px;
            font-weight: 500;
            font-style: normal;
            text-decoration: none;
            background-color: transparent;
            border-color: transparent;
            border-style: none;
            border-width: 0px;
            border-radius: 0 0 0 0px;
            letter-spacing: 4px
        }

        .tp-caption.NotGeneric-Icon,
        .NotGeneric-Icon {
            color: rgba(255, 255, 255, 1.00);
            font-size: 30px;
            line-height: 30px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0);
            border-color: rgba(255, 255, 255, 0);
            border-style: solid;
            border-width: 0px;
            border-radius: 0px 0px 0px 0px;
            letter-spacing: 3px
        }

        .tp-caption.NotGeneric-Button,
        .NotGeneric-Button {
            color: rgba(255, 255, 255, 1.00);
            font-size: 14px;
            line-height: 14px;
            font-weight: 500;
            font-style: normal;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0);
            border-color: rgba(255, 255, 255, 0.50);
            border-style: solid;
            border-width: 1px;
            border-radius: 0px 0px 0px 0px;
            letter-spacing: 3px
        }

        .tp-caption.NotGeneric-Button:hover,
        .NotGeneric-Button:hover {
            color: rgba(255, 255, 255, 1.00);
            text-decoration: none;
            background-color: transparent;
            border-color: rgba(255, 255, 255, 1.00);
            border-style: solid;
            border-width: 1px;
            border-radius: 0px 0px 0px 0px;
            cursor: pointer
        }
    </style>

    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
    @yield("styles")
</head>

<body>

<!--[if lte IE 8]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a>.</p>
<![endif]-->

<div id="preloader">
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div>
<!-- End Preload -->

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<!-- Header================================================== -->
<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong>0045 043204434</strong></div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul id="top_links">
                        @if (Auth::check())
                            <li>
                                <div class="dropdown dropdown-access">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                       id="access_link">{{Auth::user()->name}}</a>
                                    <div class="dropdown-menu" id="log_out">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ url("/files/".Auth::user()->avatar."?size=70,70")}}"
                                                 alt="{{ Auth::user()->name }} avatar" class="img-circle" width="70" height="70>

                                        @else
                                            <img src="/images/default-avatar.jpg" alt="{{ Auth::user()->name }} avatar"
                                                 class="img-circle" width="70" height="70">

                                        @endif

                                        <h4>{{Auth::user()->name}}</h4>


                                        <form role="form" id="logout-form" action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}


                                            <a href="{{url('account')}}" id="Profile"
                                               class="button_drop outline">{{trans('auth.my_account')}}</a>

                                            <button type="submit" class="button_drop outline">
                                                {{trans('auth.logout')}}
                                            </button>
                                        </form>


                                    </div>
                                </div><!-- End Dropdown access -->
                            </li>

                        @else

                            <li>

                                <div class="dropdown dropdown-access">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                       id="access_link">{{trans('auth.login')}}</a>
                                    <div class="dropdown-menu">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <a href="#" class="bt_facebook">
                                                    <i class="icon-facebook"></i>Facebook </a>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <a href="#" class="bt_paypal">
                                                    <i class="icon-paypal"></i>Paypal </a>
                                            </div>
                                        </div>
                                        <div class="login-or">
                                            <hr class="hr-or">
                                            <span class="span-or">{{trans("auth.or_wo")}}</span>
                                        </div>

                                        <form role="form" method="POST" action="{{ route('login') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <input type="email" class="form-control" id="inputUsernameEmail"
                                                       value="{{ old('email') }}" name="email"
                                                       placeholder="{{trans("auth.email")}}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif

                                            </div>
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input type="password" name="password" class="form-control"
                                                       id="inputPassword"
                                                       placeholder="{{trans("auth.password")}}" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6 col-sm-6 ">
                                                    <a id="forgot_pw"
                                                       href="{{ url('password/reset') }}">{{trans("auth.forgot_pass")}}</a>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label style="color: #999; font-weight: normal; font-size: 8px;">
                                                        <input type="checkbox"
                                                               name="remember" {{ old('remember') ? 'checked' : '' }} > {{trans("auth.remember_me" )}}
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="submit" name="Sign_in" value="{{trans("auth.login")}}"
                                                   id="Sign_in"
                                                   class="button_drop">
                                            <a href="{{ url('/register') }}" id="Sign_up"
                                               class="button_drop outline"> {{trans("auth.register" )}}</a>


                                        </form>
                                    </div>
                                </div><!-- End Dropdown access -->
                            </li>

                        @endif

                        <li><a href="{{route("wishlist.index")}}" id="wishlist_link">Wishlist</a></li>

                        <li class="dropdown flags">
                            <a class="dropdown-toggle " data-toggle="dropdown" href="#" aria-expanded="false"
                               id="language_switcher_link"
                               data-animation="fade" role="button">
                                <i class="icon icon-language icon-th-large"></i>
                                {{ LaravelLocalization::getCurrentLocaleNative() }}
                                <span class="caret"></span>
                                <i class="icon md-chevron-down" aria-hidden="true"></i></a>

                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if($localeCode !=LaravelLocalization::getCurrentLocale())
                                        <li role="presentation">
                                            <a rel="alternate" role="menuitem" hreflang="{{$localeCode}}"
                                               href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                                {{ $properties['native']}}

                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- End row -->
        </div><!-- End container-->
    </div><!-- End top line-->

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div id="logo_home">
                    <h1><a href="/" title="{{Settings::get("title")}}"
                           style="background-image: url('{{Storage::url(Settings::get("logo")).'?size=160,34'}}')">
                            <img src="{{Storage::url(Settings::get("logo"))."?size=160,34"}}" alt=""></a></h1>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{Storage::url(Settings::get("logo"))."?size=160,160"}}" width="160" height="34"
                             alt="{{Settings::get("title")}}"
                             data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    {!! menu("main_menu",['block_class'=>'main-menu']) !!}
                </div><!-- End main-menu -->

            </nav>
        </div>
    </div><!-- container -->
</header><!-- End Header -->

@yield("content")


<footer class="">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <h3>Need help?</h3>
                <a href="tel://004542344599" id="phone">+45 423 445 99</a>
                <a href="mailto:help@citytours.com" id="email_footer">help@citytours.com</a>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>About</h3>
                <ul>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Terms and condition</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>Discover</h3>
                <ul>
                    <li><a href="#">Community blog</a></li>
                    <li><a href="#">Tour guide</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Gallery</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-3">
                <h3>Settings</h3>
                <div class="styled-select">
                    <select class="form-control" name="lang" id="lang">
                        <option value="English" selected>English</option>
                        <option value="French">French</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Russian">Russian</option>
                    </select>
                </div>
                <div class="styled-select">
                    <select class="form-control" name="currency" id="currency">
                        <option value="USD" selected>USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="RUB">RUB</option>
                    </select>
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-google"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon-vimeo"></i></a></li>
                        <li><a href="#"><i class="icon-youtube-play"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                    </ul>
                    <p>© Citytours 2015</p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

<!-- Search Menu -->
<div class="search-overlay-menu">
    <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
    <form role="search" id="searchform" method="get">
        <input value="" name="q" type="search" placeholder="Search..."/>
        <button type="submit"><i class="icon_set_1_icon-78"></i>
        </button>
    </form>
</div><!-- End Search Menu -->

<!-- Common scripts -->
<script src="/assets/js/jquery-2.2.4.min.js"></script>
<script src="/assets/js/common_scripts_min.js"></script>
<script src="/assets/js/functions.js"></script>

<script src="{{elixir("js/angular.js")}}"></script>
<script src="{{elixir("js/ng-dependencies.js")}}"></script>

{{--
<!-- SLIDER REVOLUTION SCRIPTS  -->
<script type="text/javascript" src="/assets/rev-slider-files/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="/assets/rev-slider-files/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript"
        src="/assets/rev-slider-files/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="/assets/rev-slider-files/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.query-object.js"></script>

<script type="text/javascript">
    var tpj = jQuery;

    var revapi54;
    tpj(document).ready(function () {
        if (tpj("#rev_slider_54_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_54_1");
        } else {
            revapi54 = tpj("#rev_slider_54_1").show().revolution({
                sliderType: "standard",
                jsFileLocation: "rev-slider-files/js/",
                sliderLayout: "fullwidth",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    mouseScrollReverse: "default",
                    onHoverStop: "off",
                    touch: {
                        touchenabled: "on",
                        touchOnDesktop: "off",
                        swipe_threshold: 75,
                        swipe_min_touches: 50,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                    ,
                    arrows: {
                        style: "uranus",
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 778,
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        tmp: '',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 20,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 20,
                            v_offset: 0
                        }
                    }
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1240, 1024, 778, 480],
                gridheight: [700, 550, 860, 480],
                lazyType: "none",
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2000,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 47, 48, 49, 50, 51, 55],
                    disable_onmobile: "on"
                },
                shadow: 0,
                spinner: "off",
                stopLoop: "on",
                stopAfterLoops: 0,
                stopAtSlide: 1,
                shuffle: "off",
                autoHeight: "off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    });
    /*ready*/
</script>
--}}


<script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

</script>
<script src="{{elixir('js/ng-app.js')}}"></script>
<script>
    $("[data-toggle=tooltip]").tooltip();
</script>
<script src="/assets/js/icheck.js"></script>
<!-- <script>
    $('input[type=checkbox],input[type=radio]').not(".unstyle").iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey',
    }).on('ifChanged', function (event) {
        $(event.target).trigger('change');
    });
</script> -->


 <script> $(".check_styled").iCheck({ checkboxClass: "icheckbox_square-grey", "radioClass": "iradio_square-grey" }); </script>
<script>

    if (!($("section.header-video").length || $("section.parallax-window").length )) {
        $('body').addClass('no-section');
    }
    var updateQueryString = function (key, value) {
        window.location.search = jQuery.query.set(key, value);
    }

    var submitFilters = function () {
        var formData = $("#filterForm").serialize();
        window.location.search = formData;

    }

    $("#sort_rating").change(function (e) {
//            updateQueryString("sort", $(this).val());
        submitFilters();
    });
</script>



@yield("scripts")
</body>

</html>
