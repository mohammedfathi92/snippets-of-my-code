@extends('frontend.auth.layout')
@section('content')
<body class="soap-login-page style1 body-blank">
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
                    <div class="text-center yellow-color box" style="font-size: 4em; font-weight: 300; line-height: 1em;">{{trans('auth.text_welcome_back')}}</div>
                    <p class="light-blue-color block" style="font-size: 1.3333em;">{{trans('auth.please_login')}}</p>
                    <div class="col-sm-8 col-md-6 col-lg-5 no-float no-padding center-block">
                         <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                       
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" id="email" type="email" name="email" value="{{ old('email') }}" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.email")}}" required>
                                @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password"  name="password" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.password")}}" required>

                                 @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                            </div>
                            <div class="form-group">
                                <label class="checkbox">
                                    <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} ><span class="remember-rtl">{{trans("auth.remember_me" )}}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <center><a href="{{\LaravelLocalization::localizeURL('password/reset')}}" style="color: #fdb714;"> {{trans("auth.forgot_pass")}}</a></center>
                                            
                                        
                            </div>
                     
                            <button type="submit" class="btn-large full-width sky-blue1">{{trans("auth.btn_front_login")}}</button>

                           

                        </form>
                         <a href="{{\LaravelLocalization::localizeURL('register')}}" class="button btn-large full-width green" style="margin-top: 10px;">{{trans("auth.btn_front_new_signup")}}</a>
                    </div>
                </div>
            </div>
        </section>
      
      @endsection