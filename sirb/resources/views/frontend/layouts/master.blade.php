<!DOCTYPE html >
<!--[if IE 8]>
<html class="ie ie8" data-ng-app="frontendApp" lang="{{LaravelLocalization::getCurrentLocaleRegional()}}"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9" data-ng-app="frontendApp" lang="{{LaravelLocalization::getCurrentLocaleRegional()}}"> <![endif]-->
<!--[if gt IE 9]><!-->
<html data-ng-app="frontendApp" lang="{{LaravelLocalization::getCurrentLocaleRegional()}}"> <!--<![endif]-->
<head>
    <!-- Page Title -->
    <title>{{$title}}</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">

    <meta name="author" content="mohammedfathi1113[at]gmail.com">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="description" content="{{$meta_description}}">

    <!-- favicon, cards, tiles, icons -->
    <meta name="application-name" content="{{$application_name}}"/>
    <meta name="msapplication-TileImage"
          content="{{Storage::url(settings('favicon'))?:"/images/logo.png"}}"/>
    <meta name="msapplication-TileColor" content="#01b7f2"/>
    <meta name="msapplication-square70x70logo"
          content="{{Storage::url(settings('favicon')."?size=70,70&encode=png")?:"/images/logo.png"}}"/>
    <meta name="msapplication-square150x150logo"
          content="{{Storage::url(settings('favicon')."?size=150,150&encode=png")?:"/images/logo.png"}}"/>
    <meta name="msapplication-wide310x150logo"
          content="{{Storage::url(settings('favicon')."?size=350,150&encode=png")?:"/images/logo.png"}}"/>
    <meta name="msapplication-square310x310logo"
          content="{{Storage::url(settings('favicon')."?size=310,310&encode=png")?:"/images/logo.png"}}"/>
    @yield('meta')
    <link rel="apple-touch-icon-precomposed"
          href="{{Storage::url(settings('favicon')."?size=70,70&encode=png")?:"/images/logo.png"}}">
    <link rel="icon" href="{{Storage::url(settings('favicon')."?size=70,70&encode=png")?:"/images/logo.png"}}"
          sizes="16x16 32x32 48x48 64x64"
          type="image/vnd.microsoft.icon">
    <!-- end favicon -->


    <!-- facebook open graph -->
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="{{$application_name}}"/>
    <meta property="og:locale" content="{{$locale}}"/>
    <meta property="og:locale:alternate" content="{{$locale."_".strtoupper($locale)}}"/>
    <meta property="og:url" content="{{settings("url")}}"/>
    <meta property="og:title" content="{{settings("{$locale}_title")}}"/>
    <meta property="og:description"
          content="{{settings("{$locale}_title")}} | {{settings("{$locale}_meta_description")}}"/>
    <meta property="og:image" content="{{Storage::url(settings('logo')."?size=256,256")?:"/images/logo.png"}}"/>
    <meta property="og:image:width" content="256"/>
    <meta property="og:image:height" content="256"/>
    <!-- end facebook open graph -->

    <!-- Schema MicroData (Google+,Google, Yahoo, Bing,) -->
    {{--<meta itemprop="name" content="{{$application_name}}"/>--}}
    {{--<meta itemprop="url" content="{{settings("url")}}"/>--}}
    {{--<meta itemprop="author" content="developnet.net"/>--}}
    {{--<meta itemprop="image" content="{{Storage::url(settings('logo')."?size=256,256")?:"/images/logo.png"}}">--}}
    {{--<meta itemprop="description" content="{{settings("{$locale}_meta_description")}}"/>--}}
<!-- End Schema MicroData -->

    <!-- twitter cards -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@shawate">
    <meta name="twitter:creator" content="@shawate">
    <meta name="twitter:title"
          content="{{settings("{$locale}_title")}} | {{settings("{$locale}_meta_description")}}">
    <meta name="twitter:image:src"
          content="{{Storage::url(settings('logo')."?size=256,256")?:"/images/logo.png"}}">
    <meta name="twitter:description" content="{{settings("{$locale}_meta_description")}}">
    <!-- end twitter cards -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{Storage::url(settings("favicon"))}}"
          type="image/x-icon">
    @yield('css')
<!-- Theme Styles -->
    @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
        <link type="text/css" rel="stylesheet" href="/assets/css/bootstrap-rtl.min.css">
    @else
        <link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.min.css">
    @endif
    <link type="text/css" rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="/assets/css/animate.min.css">

    <!-- Current Page Styles -->
    <link rel="stylesheet" type="text/css" href="/assets/components/revolution_slider/css/settings.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/assets/components/revolution_slider/css/style.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/assets/components/jquery.bxslider/jquery.bxslider.css"
          media="screen"/>
    <link rel="stylesheet" type="text/css" href="/assets/components/flexslider/flexslider.css" media="screen"/>

    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="/assets/css/style.css">
    {{--<link id="main-style" rel="stylesheet" href="/assets/css/style-light-blue.css">--}}

<!-- Updated Styles -->
    <link type="text/css" rel="stylesheet" href="/assets/css/updates.css">

    <!-- Custom Styles -->
    <link type="text/css" rel="stylesheet" href="/assets/css/custom.css">

    <!-- Responsive Styles -->
    <link type="text/css" rel="stylesheet" href="/assets/css/responsive.css">

    <!-- CSS for IE -->
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="/assets/css/ie.css"/>

    <![endif]-->
    <link rel="stylesheet" href="/assets/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="{{elixir("css/app-styles.css")}}" type="text/css">
    @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
        <link id="main-rtl-style" type="text/css" rel="stylesheet" href="/assets/css/rtl.css">

        <style type="text/css">

            .text-rtl {
                text-align: right;

            }

            .remember-rtl {
                margin: 20px;

            }

            /****** Style Star Rating Widget *****/

            .rating {
                border: none;
                float: right;
            }

            .rating > input {
                display: none;
            }

            .rating > label:before {
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before {
                content: "\f089";
                position: absolute;
            }

            .rating > label {
                color: #ddd;
                float: left;
            }

            /***** CSS Magic to Highlight Stars on Hover *****/

            .rating > input:checked ~ label, /* show gold star when clicked */
            .rating:not(:checked) > label:hover, /* hover current star */
            .rating:not(:checked) > label:hover ~ label {
                color: #FFD700;
            }

            /* hover previous stars in list */

            .rating > input:checked + label:hover, /* hover current star when changing rating */
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
            .rating > input:checked ~ label:hover ~ label {
                color: #FFED85;
            }


        </style>
    @else
        <style type="text/css">

            /****** Style Star Rating Widget *****/

            .rating {
                border: none;
                float: left;
            }

            .rating > input {
                display: none;
            }

            .rating > label:before {
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before {
                content: "\f089";
                position: absolute;
            }

            .rating > label {
                color: #ddd;
                float: right;
            }

            /***** CSS Magic to Highlight Stars on Hover *****/

            .rating > input:checked ~ label, /* show gold star when clicked */
            .rating:not(:checked) > label:hover, /* hover current star */
            .rating:not(:checked) > label:hover ~ label {
                color: #FFD700;
            }

            /* hover previous stars in list */

            .rating > input:checked + label:hover, /* hover current star when changing rating */
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
            .rating > input:checked ~ label:hover ~ label {
                color: #FFED85;
            }

        </style>
    @endif

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type='text/javascript' src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
    <?php
    $locale = LaravelLocalization::getCurrentLocale();
    ?>

    {!! isset($googleSchema)?$googleSchema:null !!}
</head>
<body>
<div id="page-wrapper">
    <header id="header" class="navbar-static-top">
        <div class="topnav hidden-xs">
            <div class="container">

                <div class="quick-menu pull-right">
                    <ul class="social-icons style2">
                        @if($social=settings("twitter"))
                            <li class="twitter"><a title="twitter" href="{{$social}}" data-toggle="tooltip"
                                                   data-placement="bottom" target="_blank"><i
                                            class="soap-icon-twitter"></i></a></li>
                        @endif
                        @if($social=settings("googleplus"))
                            <li class="googleplus"><a title="googleplus" href="{{$social}}" data-toggle="tooltip"
                                                      data-placement="bottom" target="_blank"><i
                                            class="soap-icon-googleplus"></i></a></li>
                        @endif
                        @if($social=settings("youtube"))
                            <li class="youtube"><a title="youtube" href="{{$social}}" data-toggle="tooltip"
                                                   data-placement="bottom" target="_blank"><i
                                            class="soap-icon-youtube"></i></a></li>
                        @endif
                        @if($social=settings("instagram"))
                            <li class="instagram"><a title="instagram" href="{{$social}}" data-toggle="tooltip"
                                                     data-placement="bottom" target="_blank"><i
                                            class="soap-icon-instagram"></i></a></li>
                        @endif
                        @if($social=settings("facebook"))
                            <li class="facebook"><a title="facebook" href="{{$social}}" data-toggle="tooltip"
                                                    data-placement="bottom" target="_blank"><i
                                            class="soap-icon-facebook"></i></a></li>
                        @endif
                        @if($social=settings("linkedin"))
                            <li class="linkedin"><a title="linkedin" href="{{$social}}" data-toggle="tooltip"
                                                    data-placement="bottom" target="_blank"><i
                                            class="soap-icon-linkedin"></i></a></li>
                        @endif
                        @if($social=settings("vimeo"))
                            <li class="vimeo"><a title="vimeo" href="{{$social}}" data-toggle="tooltip"
                                                 data-placement="bottom" target="_blank"><i
                                            class="soap-icon-vimeo"></i></a></li>
                        @endif
                        @if($social=settings("dribble"))
                            <li class="dribble"><a title="dribble" href="{{$social}}" data-toggle="tooltip"
                                                   data-placement="bottom" target="_blank"><i
                                            class="soap-icon-dribble"></i></a></li>
                        @endif
                        @if($social=settings("flickr"))
                            <li class="flickr"><a title="flickr" href="{{$social}}" data-toggle="tooltip"
                                                  data-placement="bottom" target="_blank"><i
                                            class="soap-icon-flickr"></i></a></li>
                        @endif
                        @if($social=settings("tumblr"))
                            <li class="tumblr"><a title="Tumblr" href="{{$social}}" data-toggle="tooltip"
                                                  data-placement="bottom" target="_blank"><i
                                            class="soap-icon-tumblr"></i></a></li>
                        @endif
                        @if($social=settings("wordpress"))
                            <li class="wordpress"><a title="Wordpress" href="{{$social}}" data-toggle="tooltip"
                                                     data-placement="bottom" target="_blank"><i
                                            class="fa fa-wordpress"></i></a></li>
                        @endif
                        @if($social=settings("reddit"))
                            <li class="reddit"><a title="Reddit" href="{{$social}}" data-toggle="tooltip"
                                                  data-placement="bottom" target="_blank"><i
                                            class="fa fa-reddit-alien"></i></a></li>
                        @endif
                        @if($social=settings("pinterest"))
                            <li class="pinterest"><a title="Pinterest" href="{{$social}}" data-toggle="tooltip"
                                                     data-placement="bottom" target="_blank"><i
                                            class="fa fa-pinterest-p"></i></a></li>
                        @endif
                    </ul>
                </div>
                <ul class="quick-menu pull-left">
                    @if(Auth::check())
                        <li><a href="{{route('profile')}}">{{trans('auth.my_account')}}</a></li>
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{trans('auth.logout')}}</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">{{ csrf_field() }}</form>


                    @else
                        <li><a href="{{route('login')}}">{{trans('auth.login')}}</a></li>
                        <li><a href="{{route('register')}}">{{trans('auth.register')}}</a></li>
                    @endif
                    @if(count(LaravelLocalization::getSupportedLocales()) >1)
                        <li class="ribbon">

                            <a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                            <ul class="menu mini">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li class="@if($localeCode ==LaravelLocalization::getCurrentLocale()) active @endif">
                                        <a hreflang="{{$localeCode}}"
                                           href="{{LaravelLocalization::getLocalizedURL($localeCode) }}"
                                           title="{{ $properties['native']}}">{{ $properties['native']}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if(settings("whatsapp_number"))
                        @php $whatsappNumbers=explode(",",settings("whatsapp_number")) @endphp
                        @if($whatsappNumbers && is_array($whatsappNumbers))
                            @foreach($whatsappNumbers as $number)
                                <li class="call-number"><a href="#"><i class="icon-squares circle"></i> {{$number}}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="call-number"><a href="#"><i
                                            class="icon-squares circle"></i> {{settings("whatsapp_number")}}</a>
                            </li>
                        @endif

                    @endif
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="main-header">
            <div class="clearfix"></div>
            <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
                {{-- Mobile Menu Toggle--}}
            </a>

            <div class="container">
                <h1 class="logo navbar-brand">
                    <a href="/" title="{{settings("{$locale}_title")}}">
                        <img src="{{Storage::url(settings("logo")."?size=200,60&encode=png")}}"
                             alt="{{settings("{$locale}_title")}}"/>
                    </a>
                </h1>

                <nav id="main-menu" role="navigation">
                    {!! menu('main_menu',['class'=>'menu']) !!}
                </nav>
            </div>
            <nav id="mobile-menu-01" class="mobile-menu collapse" aria-expanded="false" style="height: 0;">
                {!! menu("main_menu",['class'=>'menu']) !!}
                <ul id="mobile-primary-menu" class="menu" style="background-color: #61c523;">
                    <li class="menu-item-has-children">
                        <a href="#">{{trans('auth.my_account')}}</a>
                        <ul>

                            @if(Auth::check())
                                <li><a href="{{route('profile')}}">{{trans('auth.view_account')}}</a></li>
                                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{trans('auth.logout')}}</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">{{ csrf_field() }}</form>


                            @else
                                <li><a href="{{route('login')}}">{{trans('auth.login')}}</a></li>
                                <li><a href="{{route('register')}}">{{trans('auth.register')}}</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
                <ul class="mobile-topnav style2">
                    @if($social=settings("twitter"))
                        <li class="twitter"><a title="twitter" href="{{$social}}" data-toggle="tooltip"
                                               data-placement="bottom" target="_blank"><i
                                        class="soap-icon-twitter"></i></a></li>
                    @endif
                    @if($social=settings("googleplus"))
                        <li class="googleplus"><a title="googleplus" href="{{$social}}" data-toggle="tooltip"
                                                  data-placement="bottom" target="_blank"><i
                                        class="soap-icon-googleplus"></i></a></li>
                    @endif
                    @if($social=settings("youtube"))
                        <li class="youtube"><a title="youtube" href="{{$social}}" data-toggle="tooltip"
                                               data-placement="bottom" target="_blank"><i
                                        class="soap-icon-youtube"></i></a></li>
                    @endif
                    @if($social=settings("instagram"))
                        <li class="instagram"><a title="instagram" href="{{$social}}" data-toggle="tooltip"
                                                 data-placement="bottom" target="_blank"><i
                                        class="soap-icon-instagram"></i></a></li>
                    @endif
                    @if($social=settings("facebook"))
                        <li class="facebook"><a title="facebook" href="{{$social}}" data-toggle="tooltip"
                                                data-placement="bottom" target="_blank"><i
                                        class="soap-icon-facebook"></i></a></li>
                    @endif
                    @if($social=settings("linkedin"))
                        <li class="linkedin"><a title="linkedin" href="{{$social}}" data-toggle="tooltip"
                                                data-placement="bottom" target="_blank"><i
                                        class="soap-icon-linkedin"></i></a></li>
                    @endif
                    @if($social=settings("vimeo"))
                        <li class="vimeo"><a title="vimeo" href="{{$social}}" data-toggle="tooltip"
                                             data-placement="bottom" target="_blank"><i
                                        class="soap-icon-vimeo"></i></a></li>
                    @endif
                    @if($social=settings("dribble"))
                        <li class="dribble"><a title="dribble" href="{{$social}}" data-toggle="tooltip"
                                               data-placement="bottom" target="_blank"><i
                                        class="soap-icon-dribble"></i></a></li>
                    @endif
                    @if($social=settings("flickr"))
                        <li class="flickr"><a title="flickr" href="{{$social}}" data-toggle="tooltip"
                                              data-placement="bottom" target="_blank"><i
                                        class="soap-icon-flickr"></i></a></li>
                    @endif
                    @if($social=settings("tumblr"))
                        <li class="tumblr"><a title="Tumblr" href="{{$social}}" data-toggle="tooltip"
                                              data-placement="bottom" target="_blank"><i
                                        class="soap-icon-tumblr"></i></a></li>
                    @endif
                    @if($social=settings("wordpress"))
                        <li class="wordpress"><a title="Wordpress" href="{{$social}}" data-toggle="tooltip"
                                                 data-placement="bottom" target="_blank"><i
                                        class="fa fa-wordpress"></i></a></li>
                    @endif
                    @if($social=settings("reddit"))
                        <li class="reddit"><a title="Reddit" href="{{$social}}" data-toggle="tooltip"
                                              data-placement="bottom" target="_blank"><i
                                        class="fa fa-reddit-alien"></i></a></li>
                    @endif
                    @if($social=settings("pinterest"))
                        <li class="pinterest"><a title="Pinterest" href="{{$social}}" data-toggle="tooltip"
                                                 data-placement="bottom" target="_blank"><i
                                        class="fa fa-pinterest-p"></i></a></li>
                    @endif

                </ul>
                <ul class="quick-menu pull-left">
                    {{--<li class="ribbon"><a href="#">My Account</a></li>--}}
                    <li class="ribbon">

                        <a>{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                        <ul class="menu mini">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="@if($localeCode ==LaravelLocalization::getCurrentLocale()) active @endif">
                                    <a hreflang="{{$localeCode}}"
                                       href="{{LaravelLocalization::getLocalizedURL($localeCode) }}"
                                       title="{{ $properties['native']}}">{{ $properties['native']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @if(settings("whatsapp_number"))
                        @php $whatsappNumbers=explode(",",settings("whatsapp_number")) @endphp
                        @if($whatsappNumbers && is_array($whatsappNumbers))
                            @foreach($whatsappNumbers as $number)
                                <li class="call-number"><a href="#"><i class="icon-squares circle"></i> {{$number}}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="call-number"><a href="#"><i
                                            class="icon-squares circle"></i> {{settings("whatsapp_number")}}</a>
                            </li>
                        @endif

                    @endif
                </ul>
                <div class="clearfix"></div>
            </nav>

        </div>
        <div id="travelo-signup" class="travelo-signup-box travelo-box">
            <div class="login-social">
                <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
                <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
            </div>
            <div class="seperator"><label>OR</label></div>
            <div class="simple-signup">
                <div class="text-center signup-email-section">
                    <a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
                </div>
                <p class="description"></p>
            </div>
            <div class="email-signup">
                <form>
                    <div class="form-group">
                        <input type="text" class="input-text full-width" placeholder="first name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="input-text full-width" placeholder="last name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="input-text full-width" placeholder="email address">
                    </div>
                    <div class="form-group">
                        <input type="password" class="input-text full-width" placeholder="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="input-text full-width" placeholder="confirm password">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Tell me about Travelo news
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy,
                            Guest Refund Policy, and Host Guarantee Terms.</p>
                    </div>
                    <button type="submit" class="full-width btn-medium">SIGNUP</button>
                </form>
            </div>
            <div class="seperator"></div>
            <p>Already a Travelo member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a></p>
        </div>
        <div id="travelo-login" class="travelo-login-box travelo-box">
            <div class="login-social">
                <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
                <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
            </div>
            <div class="seperator"><label>OR</label></div>
            <form>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="email address">
                </div>
                <div class="form-group">
                    <input type="password" class="input-text full-width" placeholder="password">
                </div>
                <div class="form-group">
                    <a href="#" class="forgot-password pull-right">Forgot password?</a>
                    <div class="checkbox checkbox-inline">
                        <label>
                            <input type="checkbox"> Remember me
                        </label>
                    </div>
                </div>
            </form>
            <div class="seperator"></div>
            <p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
        </div>
        <div class="clearfix"></div>
    </header>
    @yield("page_title")

    <section id="content">
        <div>
            <div class="row">
                <div id="main">
                    @yield("content")
                    @include('frontend.home.components.modals')
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="footer-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-8">
                        {!! menu('footer',['block_class'=>'col-md-4 col-sm-4 col-xs-12']) !!}
                        {!! menu('footer1',['block_class'=>'col-md-4 col-sm-4 col-xs-12']) !!}
                        {!! menu('footer2',['block_class'=>'col-md-4 col-sm-4 col-xs-12']) !!}
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-sm-4 col-md-4">

                        <address class="contact-details">
                            @if(settings("help_phone"))
                                @php $whatsappNumbers=explode(",",settings("help_phone")) @endphp
                                @if($whatsappNumbers && is_array($whatsappNumbers))
                                    @foreach($whatsappNumbers as $number)
                                        <span class="call-number"><i
                                                    class="icon-squares circle"></i> {{$number}}</span>
                                    @endforeach
                                @else
                                    <span class="call-number"><i
                                                class="icon-squares circle"></i> {{settings("help_phone")}}</span>
                                @endif

                            @endif
                            <br/>
                            @if(settings('help_email'))
                                <a href="mailto:{{settings('help_email')}}"
                                   class="contact-email">{{settings('help_email')}}</a>
                            @endif
                        </address>
                        <ul class="social-icons clearfix">
                            @if($social=settings("twitter"))
                                <li class="twitter"><a title="twitter" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-twitter"></i></a></li>
                            @endif
                            @if($social=settings("googleplus"))
                                <li class="googleplus"><a title="googleplus" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-googleplus"></i></a></li>
                            @endif
                            @if($social=settings("youtube"))
                                <li class="youtube"><a title="youtube" href="{{$social}}" data-toggle="tooltip"
                                                       data-placement="bottom" target="_blank"><i
                                                class="soap-icon-youtube"></i></a></li>
                            @endif
                            @if($social=settings("instagram"))
                                <li class="instagram"><a title="instagram" href="{{$social}}" data-toggle="tooltip"
                                                         data-placement="bottom" target="_blank"><i
                                                class="soap-icon-instagram"></i></a></li>
                            @endif
                            @if($social=settings("facebook"))
                                <li class="facebook"><a title="facebook" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-facebook"></i></a></li>
                            @endif
                            @if($social=settings("linkedin"))
                                <li class="linkedin"><a title="linkedin" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-linkedin"></i></a></li>
                            @endif
                            @if($social=settings("vimeo"))
                                <li class="vimeo"><a title="vimeo" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-vimeo"></i></a></li>
                            @endif
                            @if($social=settings("dribble"))
                                <li class="dribble"><a title="dribble" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-dribble"></i></a></li>
                            @endif
                            @if($social=settings("flickr"))
                                <li class="flickr"><a title="flickr" href="{{$social}}" data-toggle="tooltip"><i
                                                class="soap-icon-flickr"></i></a></li>
                            @endif
                            @if($social=settings("tumblr"))
                                <li class="tumblr"><a title="Tumblr" href="{{$social}}" data-toggle="tooltip"
                                                      data-placement="bottom" target="_blank"><i
                                                class="soap-icon-tumblr"></i></a></li>
                            @endif
                            @if($social=settings("wordpress"))
                                <li class="wordpress"><a title="Wordpress" href="{{$social}}" data-toggle="tooltip"
                                                         data-placement="bottom" target="_blank"><i
                                                class="fa fa-wordpress"></i></a></li>
                            @endif
                            @if($social=settings("reddit"))
                                <li class="reddit"><a title="Reddit" href="{{$social}}" data-toggle="tooltip"
                                                      data-placement="bottom" target="_blank"><i
                                                class="fa fa-reddit-alien"></i></a></li>
                            @endif
                            @if($social=settings("pinterest"))
                                <li class="pinterest"><a title="Pinterest" href="{{$social}}" data-toggle="tooltip"
                                                         data-placement="bottom" target="_blank"><i
                                                class="fa fa-pinterest-p"></i></a></li>
                            @endif


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom gray-area">
            <div class="container">
                <div class="logo pull-left">
                    <a href="/" title="{{settings("{$locale}_title")}}">
                        <img src="{{Storage::url(settings("logo")."?size=200,60&encode=png")}}"
                             alt="{{settings("{$locale}_title")}}"/>
                    </a>
                </div>
                <div class="pull-right">
                    <a id="back-to-top" href="#" class="animated" data-animation-type="bounce"><i
                                class="soap-icon-longarrow-up circle"></i></a>
                </div>
                <div class="copyright pull-right">
                    <p dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
                        &copy; {{date("Y")}} {!! Html::link(\LaravelLocalization::localizeURL('/'),settings("{$locale}_title")) !!}{{--{!! Html::link("http://developnet.net",trans("main.author_copyrights")) !!}--}}</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Javascript -->
<script type="text/javascript" src="/assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript" src="/assets/js/jquery.noconflict.js"></script>
<script type="text/javascript" src="/assets/js/modernizr.2.7.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.1.10.4.min.js"></script>

<!-- Twitter Bootstrap -->
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>

<!-- load revolution slider scripts -->
<script type="text/javascript" src="/assets/components/revolution_slider/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript"
        src="/assets/components/revolution_slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- load BXSlider scripts -->
<script type="text/javascript" src="/assets/components/jquery.bxslider/jquery.bxslider.min.js"></script>

<!-- Flex Slider -->
<script type="text/javascript" src="/assets/components/flexslider/jquery.flexslider-min.js"></script>

<!-- parallax -->
<script type="text/javascript" src="/assets/js/jquery.stellar.min.js"></script>


<!-- waypoint -->
<script type="text/javascript" src="/assets/js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="/assets/js/masonry.min.js"></script>
<script type="text/javascript" src="/assets/js/theme-scripts.js"></script>
<script type="text/javascript" src="/assets/js/scripts.js"></script>
<script type="text/javascript" src="{{elixir("/js/angular.js")}}"></script>
<script type="text/javascript" src="{{elixir("/js/ng-dependencies.js")}}"></script>
<script type="text/javascript" src="{{elixir("/js/ng-app.js")}}"></script>
@if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
    {!! settings("addthis_code") !!}
@endif



<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/58d0f1215b89e2149e1c8635/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-94083465-1', 'auto');
    ga('send', 'pageview');

</script>
<!--End of Tawk.to Script-->
<style>
    .grid-item {
        margin-bottom: 20px;
    }
</style>
<script>
    (function ($) {
        $(".long-description img,article img,.travelo-box img").removeClass("img-responsive").addClass("img-responsive");
        $(".long-description  iframe, .long-description object, .long-description embed").wrap("<div class='embed-container'></div>");
        $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        $(window).load(function () {
            $(".listing-style1").masonry({
                horizontalOrder: true,
            });
        });

    })(jQuery);
</script>
<script type="text/javascript">
    (function ($) {
        var selectAncor = $('.long-description').find('a');
        $(selectAncor).on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.open(url, '_blank');
        });
    })(jQuery);
</script>


<script type='text/javascript'>
    (function ($) {
        $("a").filter(function () {
            return this.hostname && this.hostname !== location.hostname
        }).attr('rel', 'nofollow').attr('target', '_blank');
    })(jQuery);
</script>

<script type="text/javascript">
    (function ($) {

        $('input[type=radio]').on('change', function () {
            $(this).closest("#form_review").submit();
        });
    })(jQuery);

</script>

@yield('scripts')

@if(Settings::get('active_modal_offer_'.$locale))

@if(!empty(Settings::get('show_modal_offer_image_'.$locale)) || !empty(Settings::get('show_modal_offer_text_'.$locale)))



@php


if(session()->has('showed_offer_modal')){
 
  $showed_offer_modal = false;
}else{
 session()->put('showed_offer_modal', true);
    
$showed_offer_modal = true;
}


@endphp

@if($showed_offer_modal)

<script type="text/javascript">
    (function ($) {

        $(window).load(function(){
  $('#myOfferBannerModal').modal({show:true});
});
 
  
 

})(jQuery);


</script>

 @endif 

@endif

@endif

</body>
</html>

