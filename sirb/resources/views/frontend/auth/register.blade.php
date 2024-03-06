<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8" lang="{{LaravelLocalization::getCurrentLocaleRegional()}}"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9" lang="{{LaravelLocalization::getCurrentLocaleRegional()}}"> <![endif]-->
<!--[if gt IE 9]><!-->  
<html  lang="{{LaravelLocalization::getCurrentLocaleRegional()}}"> <!--<![endif]-->
<head>
    <!-- Page Title -->
    <title>{{$title}}</title>
    
    <!-- Meta Tags -->
    <meta charset="utf-8">
     <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="description" content="{{$meta_description}}">
    <meta name="author" content="mohammedfathi1113[at]gmail.com">
    <meta name="_token" content="{{csrf_token()}}"/>

     <meta name="application-name" content="{{$application_name}}"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    
    <!-- Theme Styles -->
   @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
        <link type="text/css" rel="stylesheet" href="/assets/css/bootstrap-rtl.min.css">
    @else
        <link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.min.css">
    @endif
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,200,300,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    
    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="/assets/css/style.css">
    
    <!-- Updated Styles -->
    <link rel="stylesheet" href="/assets/css/updates.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/assets/css/custom.css">
    
    <!-- Responsive Styles -->
    <link rel="stylesheet" href="/assets/css/responsive.css">
   @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
        <link id="main-rtl-style" type="text/css" rel="stylesheet" href="/assets/css/rtl.css">

        <style type="text/css">
            .text-rtl{
                text-align: right;

            }

            .remember-rtl{
                margin: 20px;

            }
        </style>
@endif
    
    <!-- CSS for IE -->
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="/assets/css/ie.css" />
    <![endif]-->
    
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="/assets/http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script type='text/javascript' src="/assets/http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>
<body class="soap-login-page style3 body-blank">
    <div id="page-wrapper" class="wrapper-blank">
        <header id="header" class="navbar-static-top">
            <a href="/assets/#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle blue-bg">Mobile Menu Toggle</a>
            <div class="container">
                <h1 class="logo">
                    
                </h1>
            </div>
            <nav id="mobile-menu-01" class="mobile-menu collapse menu-color-blue">
               {!! menu("main_menu",['class'=>'menu']) !!}
                
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

            </nav>
            {{-- <div id="travelo-signup" class="travelo-signup-box travelo-box">
                <div class="login-social">
                    <a href="/assets/#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
                    <a href="/assets/#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
                </div>
                <div class="seperator"><label>OR</label></div>
                <div class="simple-signup">
                    <div class="text-center signup-email-section">
                        <a href="/assets/#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
                    </div>
                    <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund olicy, and Host Guarantee Terms.</p>
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
                            <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
                        </div>
                        <button type="submit" class="full-width btn-medium">SIGNUP</button>
                    </form>
                </div>
                <div class="seperator"></div>
                <p>Already a Travelo member? <a href="/assets/#travelo-login" class="goto-login soap-popupbox">Login</a></p>
            </div> 
            <div id="travelo-login" class="travelo-login-box travelo-box">
                <div class="login-social">
                    <a href="/assets/#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
                    <a href="/assets/#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
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
                        <a href="/assets/#" class="forgot-password pull-right">Forgot password?</a>
                        <div class="checkbox checkbox-inline">
                            <label>
                                <input type="checkbox"> تذكرني
                            </label>
                        </div>
                    </div>
                </form>
                <div class="seperator"></div>
                <p>Don't have an account? <a href="/assets/#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
            </div> --}}
        </header>
        <section id="content">
            <div class="container">
                <div id="main">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="logo block">
                        <a href="{{\LaravelLocalization::localizeURL('/')}}" title="Travelo - home">
                            <img src="{{Storage::url(settings("logo")."?size=242,90&encode=png")}}"
                         alt="{{settings("{$locale}_title")}}"/>
                        </a>
                    </h1>
                    <div class="text-center yellow-color box" style="font-size: 4em; font-weight: 300; line-height: 1em;">{{trans('auth.text_welcome')}}</div>
                    <p class="light-blue-color block" style="font-size: 1.3333em;">{{trans('auth.please_signup')}}</p>
                    <div class="col-sm-8 col-md-6 col-lg-5 no-float no-padding center-block">
                         <form class="login-form" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                         <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" id="name" type="text" name="name" value="{{ old('name') }}" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.name")}}" required style="background-color: transparent; color: #fff;">
                                @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                            </div>

                       
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" id="email" type="email" name="email" value="{{ old('email') }}" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.email")}}" required style="background-color: transparent; color: #fff;">
                                @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password"  name="password" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.password")}}" required style="background-color: transparent; color: #fff;">

                                 @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="confirm_password" type="password"  name="password_confirmation" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.confirm_password")}}" required style="background-color: transparent; color: #fff;">

                                 @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif

                            </div>
                            
                     
                            <button type="submit" class="btn-large full-width sky-blue1">{{trans("auth.btn_front_signup")}}</button>

                           

                        </form>
                         <a href="{{\LaravelLocalization::localizeURL('login')}}" class="button btn-large full-width green" style="margin-top: 10px;">{{trans("auth.have_account")}}</a>
                    </div>
                </div>
            </div>
        </section>
        <footer id="footer">
            <div class="footer-wrapper">
                <div class="container">
                    <nav id="main-menu" role="navigation" class="inline-block hidden-mobile">
                        {!! menu('main_menu',['class'=>'menu']) !!}
                    </nav>
                    <div class="copyright">
                        <p dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
                        &copy; {{date("Y")}} {!! Html::link(\LaravelLocalization::localizeURL('/'),settings("{$locale}_title")) !!}{{--{!! Html::link("http://developnet.net",trans("main.author_copyrights")) !!}--}}</p>                    </div>
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
    <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
    
    <script type="text/javascript">
        var enableChaser = 0;
    </script>
    <!-- parallax -->
    <script type="text/javascript" src="/assets/js/jquery.stellar.min.js"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="/assets/js/waypoints.min.js"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="/assets/js/theme-scripts.js"></script>
    <script type="text/javascript" src="/assets/js/scripts.js"></script>
    
</body>
</html>

