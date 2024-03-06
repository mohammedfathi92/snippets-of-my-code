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
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Amiri|Lato:300,400|Montserrat:400,400i,700,700i"
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
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
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



 .my-layer-img {
    background-color: rgba(0, 0, 0, 0.45);
    top: 0;
    left: 0;
    width: 100%;
   /*height: 100%;*/
    
}

.logo-grid-circle {
  border-radius: 50%;
  border: solid #fff 1px;
}



#img_not_zoom:hover{
    -webkit-transform:scale(1.2);
    transform:scale(1.2);
}
#img_not_zoom{
    -webkit-transform:scale(1.2);
    transform:scale(1.2);
    -webkit-transition: all 0s ease;
    transition: all 0s ease;
}

.title-header-link:link {
    color: #fff;
}

.title-header-link:visited {
    color: #fff;
}
.title-header-link:hover {
    color: #51bce6;
}

.title-header-link:active {
    color: #fff;
}

.modal-backdrop {
  z-index: -1;
}

/* logo home with h1 */
#logo_home h1 {
    margin: 10px 0 0 0;
    padding: 0;
}

#logo_home h1 a, header.sticky #logo_home h1 a, header#plain #logo_home h1 a, header#colored #logo_home h1 a {
    width: 200px;
    height: 50px;
    display: block;
    background-image: url({{Storage::url(Settings::get("logo")."?size=200,50")}});
    background-repeat: no-repeat;
    background-position: left top;
    background-size: 200px 50px;
    text-indent: -9999px;
}

header.sticky #logo_home h1 {
    margin: 0 0 10px 0;
    padding: 0;
}

header.sticky #logo_home h1 a {
    background-image: url({{Storage::url(Settings::get("sticky_logo")."?size=200,50")}});
}

header#plain #logo_home h1 a {
    background-image: url({{Storage::url(Settings::get("sticky_logo")."?size=200,50")}});
}

header.sticky#colored #logo_home h1 a {
    background-image: url({{Storage::url(Settings::get("sticky_logo")."?size=200,50")}});
}

@media only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
    #logo_home h1 a, header#colored #logo_home h1 a {
        background-image: url({{Storage::url(Settings::get("logo")."?size=200,50")}});
        background-size: 200px 50px;
    }

    header.sticky #logo_home h1 a, header#plain #logo_home h1 a {
        background-image: url({{Storage::url(Settings::get("sticky_logo")."?size=200,50")}});
        background-size: 200px 50px;
    }

    header.sticky#colored #logo_home h1 a {
        background-image: url({{Storage::url(Settings::get("sticky_logo")."?size=200,50")}});
        background-size: 200px 50px;
    }
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

@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp

<div id="preloader" style="display:block; ">
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
<header >
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">@if(Settings::get("help_phone"))<i class="icon-phone-circled"></i><strong>{{Settings::get("help_phone")}}</strong>@endif</div>

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


                                            <a href="{{url('account/bookings')}}" id="Profile"
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
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    
                                                        <input type="checkbox"
                                                               name="remember" {{ old('remember') ? 'checked' : '' }} > <label style="color: #111; margin: 0px 3px 0px 3px">{{trans("auth.remember_me" )}}</label>
                                                  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <a id="forgot_pw"
                                                       href="{{ url('password/reset') }}">{{trans("auth.forgot_pass")}}</a>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                            <input type="submit" name="Sign_in" value="{{trans("auth.login")}}"
                                                   id="Sign_in"
                                                   class="button_drop">
                                            <a href="{{ url('/register') }}" id="Sign_up"
                                               class="button_drop outline"> {{trans("auth.register" )}}</a>
                                               </div>


                                        </form>
                                    </div>
                                </div><!-- End Dropdown access -->
                            </li>

                        @endif

                        <li><a href="{{url("/account/favorites")}}" id="wishlist_link">{{trans('main.link_favorite')}}</a></li>

                            <li>
                                <div class="dropdown dropdown-mini">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="lang_link"> {{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                                    <div class="dropdown-menu">
                                        <ul id="lang_menu">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if($localeCode !=LaravelLocalization::getCurrentLocale())
                                            <li><a rel="alternate" role="menuitem" hreflang="{{$localeCode}}"
                                               href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">{{ $properties['native']}}</a>
                                            </li>
                                @endif
                                @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Dropdown access -->
                            </li>

                            <li>
                               
                                <div class="dropdown dropdown-mini">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="currency_link">{{$currencyName}}</a>
                                    <div class="dropdown-menu">
                                        <ul id="lang_menu">
                                            @foreach(\Corsata\Currency::all() as $currency)
                                            <li><a href="{{url('/setCurrency/'.$currency->code)}}">{{$currency->name}}</a>
                                            </li>
                                            @endforeach                                        </ul>
                                    </div>
                                </div>
                                <!-- End Dropdown access -->
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
                           >
                            </a></h1>
                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{Storage::url(Settings::get("sticky_logo"))."?size=200,50"}}" width="200" height="50" alt="{{Settings::get("title")}}" data-retina="true">
                       
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
                <h3>{{trans('main.footer_need_help')}}</h3>
                <a href="tel://"{{Settings::get("help_phone")?:"123456789"}} id="phone">{{Settings::get("help_phone")?:"123456789"}}</a>
                <a href="mailto:{{Settings::get("help_email")?:"info@example.com"}}" id="email_footer">{{Settings::get("help_email")?:"info@example.com"}}</a>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>{{\Corsata\Menu::where('position','footer1')->first()->title}}</h3>
                <ul>
                    <li> {!! menu("footer1") !!}</li>
                   
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>{{\Corsata\Menu::where('position','footer2')->first()->title}}</h3>
                <ul>
                    <li> {!! menu("footer2") !!}</li>
                </ul>
            </div>



            <div class="col-md-2 col-sm-3">
                <h3>{{trans('main.footer_settings')}}</h3>
                <div class="styled-select">
                    <select class="form-control" name="lang" id="lang" onchange="if (this.value) window.location.href=this.value">
                        @php
                        $currentLocal = LaravelLocalization::getCurrentLocale();
                        @endphp
                         @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                         <option value="{{LaravelLocalization::getLocalizedURL($localeCode) }}" {{$localeCode == $currentLocal? 'selected':''}}>
                           {{ $properties['native']}}</option>  

                         @endforeach
                        
                    </select>
                </div>


                <div class="styled-select">
                    <select class="form-control" name="currency" id="currency" onchange="if (this.value) window.location.href=this.value">
                        @if(\Corsata\Currency::all())
                        @foreach(\Corsata\Currency::all() as $currency)
                        <option value="{{url('/setCurrency/'.$currency->code)}}"  {{$currency->code == $currencyCode? 'selected' :''}} >{{$currency->name}}</option>
                        @endforeach
                        @endif
                        
                    </select>
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="{{Settings::get("facebook")?:'#'}}"><i class="icon-facebook"></i></a></li>
                        <li><a href="{{Settings::get("twitter")?:'#'}}"><i class="icon-twitter"></i></a></li>
                        {{-- <li><a href="{{Settings::get("googleplus")?:'#'}}"><i class="icon-google"></i></a></li> --}}
                        <li><a href="{{Settings::get("instagram")?:'#'}}"><i class="icon-instagram"></i></a></li>
                       {{-- <li><a href="{{Settings::get("pinterest")?:'#'}}"><i class="icon-pinterest"></i></a></li>
                        <li><a href="{{Settings::get("vimeo")?:'#'}}"><i class="icon-vimeo"></i></a></li> --}}
                        <li><a href="{{Settings::get("youtube")?:'#'}}"><i class="icon-youtube-play"></i></a></li>
                        <li><a href="{{Settings::get("linkedin")?:'#'}}"><i class="icon-linkedin"></i></a></li>
                        {{-- <li><a href="{{Settings::get("snapchat")?:'#'}}"><i class="icon-youtube-play"></i></a></li> --}}
                    </ul>
                    <p>© Coursata.com 2018</p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

        <!-- Modal -->
  <div class="modal fade" id="checkLoginModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="icon-warning-1" style="color: #f90"></i>{{trans('auth.msg_login_to_countinue')}}</h4>
        </div>
        <div class="modal-body">
<center><a href="{{ route('login') }}" class="btn_1 medium green" style="margin: 10px">{{trans('auth.login')}}</a>
          <a href="{{ route('register') }}" style="margin: 10px" class="btn_1 medium">{{trans('auth.register')}}</a></center>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('main.btn_close')}}</button>
        </div>
      </div>
      
    </div>
  </div>


<!-- Modal Single room-->
<div class="modal fade" id="advancedSearchModal" tabindex="-1" role="dialog" aria-labelledby="modal_single_room" aria-hidden="true" style="z-index:20000">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="advancedSearchModal" style="text-align: center; color: #e04f67; font-weight: bold;">{{trans('main.title_advanced_search')}}</h4>
      </div>
      <div class="modal-body">
      <div data-ng-controller="coursesFilterCtrl">

             
                       

     <!--  <div class="row">
          <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>اختر نوع البحث</label>
                                    <select class="form-control" name="searchType" id="top_filter_search_type"

                                            data-ng-model="searchType"
                                           >
                                        <option value="institutes" selected>
                                            Search in institutes 

                                        </option>
                                        <option value="courses">
                                            search in Courses
                                        </option>
                                        

                                    </select>
                                </div>
                            </div>
      </div> -->
        <div class="row">
    <div class="col-xs12">

      <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
        <a href="#courses" class="btn btn-default active" data-toggle="tab">
          <input type="radio" />{{trans('main.tap_search_courses')}}
        </a>
        <a href="#institutes" class="btn btn-default" data-toggle="tab">
          <input type="radio" />{{trans('main.tap_search_institutes')}}
        </a>
        
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="courses">

         {!! Form::open(['route'=>'courses.index','method'=>"get",'id'=>"coursesFiltersForm",'name'=>'coursesFiltersForm']) !!}

      <div class="row">

                            <div class="col-md-6">
                                <div class="form-group" data-ng-init="getCountriesList()">
                                    <label>{{trans("courses.label_country")}}</label>
                                    <select class="form-control" name="country" id="top_filter_country"

                                            data-ng-model="filterData.country"
                                            data-ng-init="filterData.country='{{Request::input("country")}}'">
                                        <option value="" disabled>{{trans("main.filters_select_country")}}</option>
                                        <option data-ng-repeat="item in countriesList" value="<%item.code%>"
                                                data-ng-selected="item.code=='{{Request::input("country")}}'">
                                            <%item.name%>
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>{{trans("courses.label_city")}}</label>
                                <select class="form-control" name="city" id="top_filter_city"
                                        data-ng-model="filterData.city"
                                        data-ng-init="filterData.city='{{Request::input("city")}}' ">
                                    <option value="">{{trans("main.filters_select_city")}}</option>
                               
                                    <optgroup  label="<%state.name%>" data-ng-repeat="state in citiesList | where:{is_state: 1} ">

                                    <option value="<%state.id%>" style="background-color: #9bf39b"> <%state.name%>
                                    </option>
                    
                                    <option data-ng-repeat="city in citiesList | where:{state_id: state.id}" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{Request::input("city")}}'">  - <%city.name%>
                                    </option>
                                </optgroup>
                                <option data-ng-repeat="city in citiesList | where:{state_id: null}" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{Request::input("city")}}'" style="font-weight: bold;"><%city.name%>
                                    </option>
                                </select>
                            </div>


                        </div><!-- End row -->
                     <!-- End row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" data-ng-init="getCoursesCategories()">
                                    <label>{{trans("main.filter_course_type")}}</label>
                                    <select class="form-control" name="category" id="top_filters_course_category"
                                            data-ng-model="filterData.category"
                                            data-ng-init="filterData.category='{{Request::input("category")}}'">
                                       <option value="">{{trans("main.filters_select_course_category")}}</option>
                                    <option data-ng-repeat="category in coursesCategories" value="<%category.id%>"
                                            data-ng-selected="category.id=='{{Request::input("category")}}'"> <%category.name%>
                                    </option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <center>
                                    <div class="form-group">
                                        <label>{{trans("courses.label_duration")}}</label>
                                        <div class="numbers-row">
                                            <input type="text"
                                                   data-ng-model="filterData.weeks"
                                                   data-ng-change="filterData.hWeeks=parseInt('{{Request::input("hWeeks")}}')>0?'{{Request::input("hWeeks")}}':filterData.weeks"
                                                   data-ng-init="filterData.weeks='{{Request::input("weeks")?:"1"}}'"
                                                   min="1"
                                                   max="40"
                                                   required
                                                   value="1" id="weeks" class="qty2 form-control"
                                                   name="weeks" style="right: 1px">
                                        </div>
                                        <span class="help-block">{{trans("main.filter_hint_duration")}}</span>
                                    </div>
                                    </center>
                                </div>

                           
                        </div>
                            <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_housing")}}</label>
                                    <select class="form-control" name="housing" id="top_filters_housing"
                                            data-ng-model="filterData.housing"
                                            data-ng-init="filterData.housing='{{Request::input("housing")?:"y"}}'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>
                                    </select>
                                </div>
                            </div>
                              
                                <div class="col-md-6">
                                   <center>
                                    <div class="form-group" data-ng-show="filterData.housing=='y'">
                                        
                                        <label>{{trans("main.filter_housing_duration")}}</label>
                                        <div class="numbers-row">
                                            <input type="text" min="1"
                                                   data-ng-model="filterData.hWeeks"
                                                   data-ng-init="filterData.hWeeks='{{Request::input("hWeeks")?:"1"}}'"
                                                   max="40" maxlength="40" minlength="1"
                                                   value="1" id="hWeeks" class="qty2 form-control"
                                                   name="hWeeks" style="right: 1px">
                                        </div>
                                        <span class="help-block">{{trans("main.filter_hint_duration")}}</span>
                                        
                                    </div>
                                    </center>

                                </div>
                            

                            
                        </div> <!-- End row -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>{{trans("main.filter_option_transporting")}}</label>
                                <select class="form-control" name="transporting" id="transporting"
                                        data-ng-model="filterData.transporting"
                                        data-ng-init="filterData.transporting='{{Request::input("transporting")?:"n"}}'">
                                    <option value="y">{{trans("main.filter_yes_need")}}</option>
                                    <option value="n">{{trans("main.filter_no_need")}}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_insurance")}}</label>
                                    <select class="form-control" name="i" id="top_filters_insurance"
                                            data-ng-model="filterData.insurance"
                                            data-ng-init="filterData.insurance='{{Request::input("insurance")}}'||'y'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>


                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <input type="hidden" name="scroll" value="true">
                       <center> <button class="btn_1 green" type="submit"><i class="icon-search"></i>{{trans('main.btn_search_now')}}</button> </center>
                         {!! Form::close() !!}
    </div>
        <div class="tab-pane" id="institutes">
            
            {!! Form::open(['route'=>'institutes.index','method'=>"get",'id'=>"institutesFiltersForm",'name'=>'institutesFiltersForm']) !!}

                    <div class="row">

                            <div class="col-md-6">
                                <div class="form-group" data-ng-init="getCountriesList()">
                                    <label>{{trans("courses.label_country")}}</label>
                                    <select class="form-control" name="country" id="top_filter_country_inst"

                                            data-ng-model="filterData.country"
                                            data-ng-init="filterData.country='{{Request::input("country")}}'">
                                        <option value="" disabled>{{trans("main.filters_select_country")}}</option>
                                        <option data-ng-repeat="item in countriesList" value="<%item.code%>"
                                                data-ng-selected="item.code=='{{Request::input("country")}}'">
                                            <%item.name%>
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>{{trans("courses.label_city")}}</label>
                                <select class="form-control" name="city" id="top_filter_city_inst"
                                        data-ng-model="filterData.city"
                                        data-ng-init="filterData.city='{{Request::input("city")}}' ">
                                    <option value="">{{trans("main.filters_select_city")}}</option>
                                       <optgroup  label="<%state.name%>" data-ng-repeat="state in citiesList | where:{is_state: 1} ">

                                    <option value="<%state.id%>" style="background-color: #9bf39b"> <%state.name%>
                                    </option>
                    
                                    <option data-ng-repeat="city in citiesList | where:{state_id: state.id}" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{Request::input("city")}}'">  - <%city.name%>
                                    </option>
                                </optgroup>
                                <option data-ng-repeat="city in citiesList | where:{state_id: null}" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{Request::input("city")}}'" style="font-weight: bold;"><%city.name%>
                                    </option>
                                </select>
                            </div>


                        </div><!-- End row -->
                  <br>
                            <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_housing")}}</label>
                                    <select class="form-control" name="housing" id="top_filters_housing_inst"
                                            data-ng-model="filterData.housing"
                                            data-ng-init="filterData.housing='{{Request::input("housing")?:"y"}}'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>
                                    </select>
                                </div>
                            </div>
                              
                                 <div class="col-md-6">
                                <label>{{trans("main.filter_option_transporting")}}</label>
                                <select class="form-control" name="transporting" id="transporting_inst"
                                        data-ng-model="filterData.transporting"
                                        data-ng-init="filterData.transporting='{{Request::input("transporting")?:"n"}}'">
                                    <option value="y">{{trans("main.filter_yes_need")}}</option>
                                    <option value="n">{{trans("main.filter_no_need")}}</option>
                                </select>
                            </div>
                            

                            
                        </div> <!-- End row -->
<center>
   <br>
                        <div class="row">
                          
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_insurance")}}</label>
                                    <select class="form-control" name="i" id="top_filters_insurance_inst"
                                            data-ng-model="filterData.insurance"
                                            data-ng-init="filterData.insurance='{{Request::input("insurance")}}'||'y'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>


                                    </select>
                                </div>
                            </div>

                        </div>
                        </center>
                        <hr>
                        <input type="hidden" name="scroll" value="true">
                        <center> <button class="btn_1 green" type="submit"><i class="icon-search"></i>{{trans('main.btn_search_now')}}</button> </center>
            {!! Form::close() !!}


        </div>
        
      </div>
    </div>
  </div>
      
                    </div>
      </div>
    </div>
  </div>
</div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.17/angular-filter.js"></script>

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
