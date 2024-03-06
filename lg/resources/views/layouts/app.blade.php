<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>{{$page_title}} | {{trans("main.app_title")}}</title>
    <link rel="apple-touch-icon" href="/mmenu/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="/mmenu/assets/images/favicon.ico">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="/global/css/bootstrap-extend.min.css">
    {{--<link rel="stylesheet" href="/mmenu/assets/css/site.min.css">--}}
    <link rel="stylesheet" href="/css/app.css">
    <!-- Plugins -->
    <link rel="stylesheet" href="/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="/global/vendor/switchery/switchery.css">
    {{--<link rel="stylesheet" href="/global/vendor/intro-js/introjs.css">--}}
    <link rel="stylesheet" href="/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="/global/vendor/jquery-mmenu/jquery-mmenu.css">
    <link rel="stylesheet" href="/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="/global/vendor/waves/waves.css">
    <link rel="stylesheet" href="/global/vendor/select2/select2.css">
    {{--<link rel="stylesheet" href="/global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">--}}
    <link rel="stylesheet" href="/global/vendor/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="/global/vendor/icheck/icheck.css">
    <link rel="stylesheet" href="/global/vendor/switchery/switchery.css">
    {{--<link rel="stylesheet" href="/global/vendor/asrange/asRange.css">--}}
    <link rel="stylesheet" href="/global/vendor/asspinner/asSpinner.css">
    {{--<link rel="stylesheet" href="/global/vendor/clockpicker/clockpicker.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/ascolorpicker/asColorPicker.css">--}}
    <link rel="stylesheet" href="/global/vendor/bootstrap-touchspin/bootstrap-touchspin.css">
    {{--<link rel="stylesheet" href="/global/vendor/card/card.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/jquery-labelauty/jquery-labelauty.css">--}}
    <link rel="stylesheet" href="/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    {{--<link rel="stylesheet" href="/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/jt-timepicker/jquery-timepicker.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/jquery-strength/jquery-strength.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/multi-select/multi-select.css">--}}
    {{--<link rel="stylesheet" href="/global/vendor/typeahead-js/typeahead.css">--}}
    <link rel="stylesheet" href="/global/vendor/filament-tablesaw/tablesaw.css">
    <link rel="stylesheet" href="/assets/plugins/lightbox/css/lightbox.min.css">

    @yield("header-links")
    {{--<link rel="stylesheet" href="/mmenu/assets/examples/css/forms/advanced.css">--}}
<!-- Fonts -->
    <link rel="stylesheet" href="/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    {{--<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.min.css">--}}
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <!--[if lt IE 9]>
    <script src="/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="/global/vendor/media-match/media.match.min.js"></script>
    <script src="/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="/global/vendor/modernizr/modernizr.js"></script>
    <script src="/global/vendor/breakpoints/breakpoints.js"></script>
    <script src="/assets/plugins/ckeditor/ckeditor.js"></script>
    <script>
        Breakpoints();
    </script>
    @yield('header-scripts')
</head>
</head>
<body class="site-navbar-small" data-ng-app="LGPortalApp">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="site-navbar navbar navbar-inverse navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <img class="navbar-brand-logo" src="/mmenu/assets/images/logo.png" title="LG">
            <span class="navbar-brand-text hidden-xs"> LG</span>
        </div>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon md-search" aria-hidden="true"></i>
        </button>
    </div>
    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="hidden-float" id="toggleMenubar">
                    <a data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="hidden-xs" id="toggleFullscreen">
                    <a class="icon icon-fullscreen active" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <li class="hidden-float">
                    <a class="icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>

            </ul>
            <!-- End Navbar Toolbar -->
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                {{--<li class="dropdown">
                    <a class="dropdown-toggle arabic " data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="fade" role="button">{{ LaravelLocalization::getCurrentLocaleNative() }} <i
                                class="icon md-chevron-down" aria-hidden="true"></i></a>

                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode !=LaravelLocalization::getCurrentLocale())
                                <li role="presentation">
                                    <a rel="alternate" role="menuitem" hreflang="{{$localeCode}}"
                                       href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                        <span class="flag-icon flag-icon-{{$localeCode=="ar"?"eg":"gb"}}"></span> {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>--}}
                <li class="dropdown">
                    @php
                        $target=Auth::user()->target();
                        $level=Auth::user()->level();
                    @endphp
                    @if($level)
                        <a>
                            <span class="col-md-3">
                                @if($level->photo && Storage::disk("uploads")->has($level->photo))
                                    <img src="{{url("/images/sm/{$level->photo}")}}" alt="{{$level->name}} photo" class="img-thumbnail img-circle">
                                @endif
                            </span>
                            <span class="col-md-9">
                                {{$level->name}}
                                @if($level->parent)
                                    /{{$level->parent->name}}
                                @endif
                                    ({{$target->total_target}}/{{$level->target}})
                            </span>

                        </a>
                    @endif
                </li>
                <li class="dropdown">
                    @php($notifications=Auth::user()->notifications)
                    <a class="notif" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                       aria-expanded="false"
                       data-animation="scale-up" role="button">
                        <i class="icon md-notifications" aria-hidden="true"></i>
                        @if(count($notifications))
                            <span class="badge badge-danger up">{{count($notifications)}}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <li class="dropdown-menu-header" role="presentation">
                            <h5>{{trans("notifications.panel_title")}}</h5>
                            @if(count($notifications))
                                <span class="label label-round label-danger">{{trans("notifications.count_new",['count'=>count($notifications)])}}</span>
                            @endif
                        </li>
                        @if(count($notifications))
                            <li class="list-group" role="presentation">
                                <div data-role="container">
                                    <div data-role="content">

                                        @foreach($notifications as $item)
                                            <a class="list-group-item"
                                               href="{{$item->url?url($item->url):"javascript:;"}}" role="menuitem"
                                               data-dismiss-notification="{{$item->id}}">
                                                <div class="media">
                                                    <div class="media-left padding-right-10">
                                                        <i class="icon md-receipt bg-green-600 white icon-circle"
                                                           aria-hidden="true"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">{{trans($item->message,($item->params)?unserialize($item->params):[])}}</h6>
                                                        <time class="media-meta"
                                                              datetime="{{$item->created_at}}">{{\Carbon\Carbon::instance($item->created_at)->diffForHumans()}}</time>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach


                                    </div>
                                </div>
                            </li>
                        @else
                            <li>
                                <p class="text-center alert alert-warning">{{trans("notifications.no_notifications")}}</p>
                            </li>
                        @endif
                        {{--<li class="dropdown-menu-footer" role="presentation">
                            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                                <i class="icon md-settings" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0)" role="menuitem">
                                All notifications
                            </a>
                        </li>--}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle notifprofile" data-toggle="dropdown" href="#"
                       aria-expanded="false"
                       data-animation="scale-up" role="button">
                            <span class="avatar avatar-online">
                                @if(Auth::user()->avatar)
                                    <img src="{{url("images/sm/".Auth::user()->avatar)}}" alt="{{Auth::user()->name}}"
                                         title="{{Auth::user()->name}}">
                                @else
                                    <img src="{{asset("assets/images/default_avatar.jpg")}}"
                                         alt="{{Auth::user()->name}}" title="{{Auth::user()->name}}">
                                @endif

                                <i></i>
                            </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation">
                            <a href="{{url("account")}}" role="menuitem">
                                <i class="icon md-settings" aria-hidden="true"></i>
                                {{trans('users.link_account')}}</a>
                        </li>
                        <li role="presentation">
                            <a href="{{url("/$locale/opportunities")}}" role="menuitem">
                                <i class="icon md-card" aria-hidden="true"></i> {{trans('main.link_opportunities')}}</a>
                        </li>
                        <li role="presentation">
                            <a href="{{url("profile")}}" role="menuitem">
                                <i class="icon md-account" aria-hidden="true"></i> {{trans('users.link_profile')}}</a>
                        </li>
                        {{--<li role="presentation">
                            <a href="javascript:void(0)" role="menuitem"><i class="icon md-receipt"
                                                                            aria-hidden="true"></i> Partner Leads</a>
                        </li>--}}
                        <li class="divider" role="presentation"></li>
                        <li role="presentation">
                            <a href="/logout" role="menuitem"><i class="icon md-power" aria-hidden="true"></i>
                                {{trans("main.btn_logout")}}</a>
                        </li>
                    </ul>
                </li>


            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap {{Request::input('q')?"in":""}}" id="site-navbar-search">
            <form role="search" method="get" action="" name="mainSearchForm">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon md-search" aria-hidden="true"></i>
                        <input type="search" class="form-control" id="mainSearchInput" name="q" placeholder="Search..."
                               value="{{Request::input('q')}}">
                        <button type="button" class="input-search-close icon md-close"
                                data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close">
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
<div class="site-menubar">
    <ul class="site-menu">
        <li class="site-menu-item">
            <a class="animsition-link" href="{{url("/")}}">
                <i class="site-menu-icon md-home"
                   aria-hidden="true"></i><span class="site-menu-title">{{trans("main.link_home")}}</span>
            </a>
        </li>


        @if(Auth::user()->permission < 2)
            <li class="site-menu-item has-sub">
                <a href="javascript:;">
                    <i class="site-menu-icon md-alert-polygon"
                       aria-hidden="true"></i><span
                            class="site-menu-title">{{trans('main.menu_item_management')}} </span>
                    <span class="site-menu-arrow">
                    </span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url("manage/about")}}">
                            <span class="site-menu-title">{{trans('about.link_about')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url("manage/club")}}">
                            <span class="site-menu-title">{{trans('levels.link_club')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/categories')}}">
                            <span class="site-menu-title">{{trans('categories.link_list_all')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/products')}}">
                            <span class="site-menu-title">{{trans('products.link_list_all')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/opportunities')}}">
                            <span class="site-menu-title">{{trans('opportunities.link_list_all')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/users')}}">
                            <span class="site-menu-title">{{trans('users.link_list_all')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/reports/products')}}">
                            <span class="site-menu-title">{{trans('reports.link_products_reports')}}</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/reports/opportunities')}}">
                            <span class="site-menu-title">{{trans('reports.link_opportunities_reports')}}</span>
                        </a>
                    </li>

                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{url('manage/contacts')}}">
                            <span class="site-menu-title">{{trans('main.link_contact_us')}}</span>
                        </a>
                    </li>


                </ul>
            </li>
        @endif
        <li class="site-menu-item">
            <a class="animsition-link" href="{{url("/about")}}">
                <i class="site-menu-icon md-file"
                   aria-hidden="true"></i><span class="site-menu-title">{{trans("about.link_about")}}</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
                <i class="site-menu-icon md-tv"
                   aria-hidden="true"></i><span class="site-menu-title">{{trans("main.link_products")}} </span> <span
                        class="site-menu-arrow">
                    </span>
            </a>
            <ul class="site-menu-sub">
                @if($menuCategories)
                    @foreach($menuCategories as $category)
                        <li class="site-menu-item">
                            <a class="animsition-link" href="{{url("products/category/{$category->id}")}}">
                                <span class="site-menu-title">{{$category->name}}</span>
                            </a>
                        </li>
                    @endforeach
                @endif


            </ul>
        </li>
        <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
                <i class="site-menu-icon md-edit"
                   aria-hidden="true"></i><span class="site-menu-title">{{trans("main.link_opportunities")}} </span>
                <span
                        class="site-menu-arrow">
                    </span>
            </a>
            <ul class="site-menu-sub">

                <li class="site-menu-item">
                    <a class="animsition-link" href="{{url("opportunities")}}">
                        <span class="site-menu-title">{{trans("opportunities.link_list_all")}}</span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{url("opportunities/create")}}">
                        <span class="site-menu-title">{{trans("opportunities.link_create")}}</span>
                    </a>
                </li>
                {{--<li class="site-menu-item">
                    <a class="animsition-link" href="{{url("opportunities/leads")}}">
                        <span class="site-menu-title">{{trans("opportunities.link_leads")}}</span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{url("opportunities/losses")}}">
                        <span class="site-menu-title">{{trans("opportunities.link_losses")}}</span>
                    </a>
                </li>--}}


            </ul>
        </li>
        @if(Auth::user()->permission>1)
            <li class="site-menu-item">
                <a class="animsition-link" href="{{url("/contact_us")}}">
                    <i class="site-menu-icon md-email"
                       aria-hidden="true"></i><span class="site-menu-title">{{trans("main.link_contact_us")}}</span>
                </a>
            </li>
        @endif

    </ul>
</div>
<!-- Page -->
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">
            {{$page_header}}
        </h1>
    </div>
    <div class="page-content">

        @include('flash::message')
        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</div>
<!-- End Page -->
<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-legal">© 2016 <a href="">LG</a></div>
    <div class="site-footer-right">
        Designed and Developed by <a href="http://www.ati.amcoeg.com/">amco</a>
    </div>
</footer>
<!-- Core  -->

<script src="/global/vendor/jquery/jquery.js"></script>
<script src="/js/jquery.print.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/global/vendor/animsition/animsition.js"></script>
<script src="/global/vendor/asscroll/jquery-asScroll.js"></script>
<script src="/global/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="/global/vendor/asscrollable/jquery.asScrollable.all.js"></script>
<script src="/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
<script src="/global/vendor/multi-select/jquery.multi-select.js"></script>
<script src="/global/vendor/waves/waves.js"></script>
<!-- Plugins -->
<script src="/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
<script src="/global/vendor/switchery/switchery.min.js"></script>
<script src="/global/vendor/intro-js/intro.js"></script>
<script src="/global/vendor/screenfull/screenfull.js"></script>
<script src="/global/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="/global/vendor/select2/select2.min.js"></script>
<script src="/global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
<script src="/global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="/global/vendor/bootstrap-select/bootstrap-select.js"></script>
<script src="/global/vendor/icheck/icheck.min.js"></script>
<script src="/global/vendor/switchery/switchery.min.js"></script>
<script src="/global/vendor/asrange/jquery-asRange.min.js"></script>
<script src="/global/vendor/asspinner/jquery-asSpinner.min.js"></script>
{{--<script src="/global/vendor/clockpicker/bootstrap-clockpicker.min.js"></script>--}}
<script src="/global/vendor/ascolor/jquery-asColor.min.js"></script>
<script src="/global/vendor/asgradient/jquery-asGradient.min.js"></script>
{{--<script src="/global/vendor/ascolorpicker/jquery-asColorPicker.min.js"></script>--}}
{{--<script src="/global/vendor/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>--}}
<script src="/global/vendor/jquery-knob/jquery.knob.js"></script>
<script src="/global/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/global/vendor/card/jquery.card.js"></script>
<script src="/global/vendor/jquery-labelauty/jquery-labelauty.js"></script>
<script src="/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="/global/vendor/jt-timepicker/jquery.timepicker.min.js"></script>
<script src="/global/vendor/datepair-js/datepair.min.js"></script>
<script src="/global/vendor/datepair-js/jquery.datepair.min.js"></script>
<script src="/global/vendor/jquery-strength/jquery-strength.min.js"></script>
<script src="/global/vendor/multi-select/jquery.multi-select.js"></script>
<script src="/global/vendor/typeahead-js/bloodhound.min.js"></script>
<script src="/global/vendor/typeahead-js/typeahead.jquery.min.js"></script>
<script src="/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="/global/vendor/filament-tablesaw/tablesaw.js"></script>
<script src="/global/vendor/filament-tablesaw/tablesaw-init.js"></script>
<!-- Scripts -->
<script src="/global/js/core.js"></script>
<script src="/mmenu/assets/js/site.js"></script>
<script src="/mmenu/assets/js/sections/menu.js"></script>
<script src="/mmenu/assets/js/sections/menubar.js"></script>
<script src="/mmenu/assets/js/sections/gridmenu.js"></script>
<script src="/mmenu/assets/js/sections/sidebar.js"></script>
{{--<script src="/global/js/configs/config-colors.js"></script>--}}
<script src="/mmenu/assets/js/configs/config-tour.js"></script>
<script src="/global/js/components/asscrollable.js"></script>
<script src="/global/js/components/animsition.js"></script>
<script src="/global/js/components/slidepanel.js"></script>

<script src="/global/js/components/tabs.js"></script>
<script src="/global/js/components/select2.js"></script>
<script src="/global/js/components/bootstrap-tokenfield.js"></script>
<script src="/global/js/components/bootstrap-tagsinput.js"></script>
<script src="/global/js/components/bootstrap-select.js"></script>
<script src="/global/js/components/icheck.js"></script>
<script src="/global/js/components/switchery.js"></script>
<script src="/global/js/components/asrange.js"></script>
{{--<script src="/global/js/components/asspinner.js"></script>--}}
{{--<script src="/global/js/components/clockpicker.js"></script>--}}
<script src="/global/js/components/ascolorpicker.js"></script>
{{--<script src="/global/js/components/bootstrap-maxlength.js"></script>--}}
<script src="/global/js/components/jquery-knob.js"></script>
<script src="/global/js/components/bootstrap-touchspin.js"></script>
<script src="/global/js/components/card.js"></script>
<script src="/global/js/components/jquery-labelauty.js"></script>
<script src="/global/js/components/bootstrap-datepicker.js"></script>
<script src="/global/js/components/jt-timepicker.js"></script>
<script src="/global/js/components/datepair-js.js"></script>
<script src="/global/js/components/jquery-strength.js"></script>
<script src="/global/js/components/multi-select.js"></script>
<script src="/global/js/components/jquery-placeholder.js"></script>
<script src="/assets/plugins/lightbox/js/lightbox.min.js"></script>


{{--angular Scripts--}}
<script src="/global/js/angular.js"></script>
<script src="/global/js/app.js"></script>
{{--end angular Scripts--}}

{{--<script src="/mmenu/assets/examples/js/forms/advanced.js"></script>--}}
<script>
    var Site = window.Site;
    $(document).ready(function ($) {
        Site.run();
        $(".select2").select2();
        $(".datepicker").datepicker({
            format: "d-m-yyyy"
        });
        $("[data-toggle='tooletip']").tooltip();
    });
</script>

@yield('footer-scripts')
</body>
</html>
