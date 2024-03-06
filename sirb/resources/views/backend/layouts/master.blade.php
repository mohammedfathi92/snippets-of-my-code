<!DOCTYPE html>
<html ng-app="backendApp">

<head>
    <title>DevelopNet </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= csrf_token() ?>"/>
    <!-- Fonts -->
{{--<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>--}}
{{--<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>--}}
<!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="/backend/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css"
          href="/backend/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/lib/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/css/bootstrap-toggle.min.css"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/backend/js/icheck/icheck.css"
          rel="stylesheet">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="/backend/css/style.css">
    <link rel="stylesheet" type="text/css" href="/backend/css/themes/flat-blue.css">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

    <!-- Developnet CSS -->
    <link rel="stylesheet" href="/backend/css/developnet.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{Storage::url(settings("favicon"))}}"
          type="image/x-icon">
    <link rel="shortcut icon" href="/backend/images/logo-icon.png" type="image/x-icon">

    <!-- CSS Fonts -->
    <link href="/backend/fonts/developnet/styles.css" rel="stylesheet">
    <script type="text/javascript" src="/backend/lib/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

    @yield('css')
    @yield('head')

</head>

<body class="flat-blue">

<div id="page-loader">
    <img src="/backend/images/logo-icon.png" alt="Developnet Loader">
</div>

<?php
$user_avatar = Auth::user()->avatar;
if ((substr(Auth::user()->avatar, 0, 7) == 'http://') || (substr(Auth::user()->avatar, 0, 8) == 'https://')) {
    $user_avatar = Auth::user()->avatar;
}
?>

<div class="app-container ">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="hamburger">
                        <span class="hamburger-inner"></span>
                    </div>

                    <ol class="breadcrumb">
                        @if(count(Request::segments()) == 2)
                            <li class="active"><i class="icon-dot-2"></i> {{trans("main.link_dashboard")}}</li>
                        @else
                            <li class="active">
                                <a href="{{ url(config("settings.backend_uri"))}}"><i class="icon-dot-2"></i>
                                    {{trans("main.link_dashboard")}}</a>
                            </li>
                        @endif
                        @php $breadcrumb_url = ''; @endphp
                        @for($i = 2; $i <= count(Request::segments()); $i++)
                            <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
                            @if(Request::segment($i) != $backend_uri && !is_numeric(Request::segment($i)))

                                @if($i < count(Request::segments()) & $i > 0)
                                    <li class="active"><a
                                                href="{{ $breadcrumb_url }}">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a>
                                    </li>
                                @else
                                    <li>{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</li>
                                @endif

                            @endif
                        @endfor
                    </ol>


                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-th icon"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right ">
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-times icon"></i>
                    </button>

                    <!-- country flags -->
                    <li class="dropdown flags">
                        <a class="dropdown-toggle " data-toggle="dropdown" href="#" aria-expanded="false"
                           data-animation="fade" role="button">
                            @if(LaravelLocalization::getCurrentLocale()=='ar')
                                <img src="/images/flags/Flag_of_Saudi_Arabia.svg"
                                     alt="{{ LaravelLocalization::getCurrentLocaleNative() }}"/>
                            @else
                                <img src="/images/flags/Flag_of_the_United_States.svg"
                                     alt="{{ LaravelLocalization::getCurrentLocaleNative() }}"/>
                            @endif
                            <span class="caret"></span>
                            <i class="icon md-chevron-down" aria-hidden="true"></i></a>

                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @if($localeCode !=LaravelLocalization::getCurrentLocale())
                                    <li role="presentation">
                                        <a rel="alternate" role="menuitem" hreflang="{{$localeCode}}"
                                           href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                            @if($localeCode=='ar')
                                                <img src="/images/flags/Flag_of_Saudi_Arabia.svg"
                                                     alt="{{ $properties['native']}}"/>
                                            @else
                                                <img src="/images/flags/Flag_of_the_United_States.svg"
                                                     alt="{{ $properties['native']}}"/>
                                            @endif
                                            {{ $properties['native']}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <!-- // END country flags -->
                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            @if(Auth::user()->avatar)
                                <img src="{{ url("/files/".Auth::user()->avatar."?size=30,30") }}" class=" profile-img"
                                     alt="{{ Auth::user()->name }} avatar">
                            @else
                                <img src="/images/default-avatar.jpg" class=" profile-img"
                                     alt="{{ Auth::user()->name }} avatar">
                            @endif

                            <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-animated">
                            <li class="profile-img">
                                @if(Auth::user()->avatar)
                                    <img src="{{ url("files/".Auth::user()->avatar."?size=60,60") }}"
                                         class=" profile-img"
                                         alt="{{ Auth::user()->name }} avatar">
                                @else
                                    <img src="/images/default-avatar.jpg" class=" profile-img"
                                         alt="{{ Auth::user()->name }} avatar">
                                @endif
                                <div class="profile-body">
                                    <h5>{{ Auth::user()->name }}</h5>
                                    <h6>{{ Auth::user()->email }}</h6>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/{{$backend_uri}}/account"><i
                                            class="icon-person"></i> {{trans("users.link_my_account")}}</a>
                            </li>
                            <li>
                                <a href="/{{$backend_uri}}/logout"><i
                                            class="icon-power"></i> {{trans("users.link_logout")}}</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>


        <div class="side-menu sidebar-inverse">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <div class="icon icon-helm"></div>
                            <div class="title">{{settings('admin_title')}}</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                    </div>

                    <div class="panel widget center bgimage"
                         style="background-image:url('/backend/images/bg.jpg')">
                        <div class="dimmer"></div>
                        <div class="panel-content">
                            @if(Auth::user()->avatar)
                                <img src="{{ url("files/".Auth::user()->avatar."?size=40,40") }}" class="avatar"
                                     alt="{{ Auth::user()->name }} avatar">
                            @else
                                <img src="/images/default-avatar.jpg" class="avatar"
                                     alt="{{ Auth::user()->name }} avatar">
                            @endif
                            <h4>{{ ucwords(Auth::user()->name) }}</h4>
                            <p>{{ Auth::user()->email }}</p>

                            <a href="/{{$backend_uri}}/account"
                               class="btn btn-primary">{{trans("users.link_my_account")}}</a>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav scrollbar">

                        <li class="@if(!Request::segment(3)) active @endif">
                            <a href="{{ url("/$backend_uri") }}">
                                <span class="icon icon-dot-2"></span>
                                <span class="title">{{trans("main.link_dashboard")}}</span>
                            </a></li>
                        @can('show countries')
                            <li class="@if(Request::segment(3)=="countries") active @endif">
                                <a href="{{ url("/$backend_uri/countries") }}">
                                    <span class="fa fa-map"></span>
                                    <span class="title">{{trans("countries.link_backend_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show hotels')
                            <li class="dropdown @if(Request::segment(3)=="hotels") active @endif">
                                <a href="#hotels-dropdown-list" data-toggle="collapse">
                                    <span class="fa fa-h-square"></span>
                                    <span class="title">{{trans("hotels.link_in_admin_menu")}}</span>
                                </a>
                                <div id="hotels-dropdown-list"
                                     class="panel-collapse collapse @if(Request::segment(3)=="hotels") in @endif"
                                     aria-expanded="true">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li class="@if(Request::segment(3)=="hotels" && Request::segment(4)!="services"  && Request::segment(5)!="services") active @endif">
                                                <a href="{{ url("/$backend_uri/hotels") }}">
                                                    <span class="fa fa-h-square"></span>
                                                    <span class="title">{{trans("hotels.link_in_admin_menu")}}</span>
                                                </a>
                                            </li>
                                            @can('show hotels services')
                                                <li class="@if(Request::segment(4)=="services") active @endif">
                                                    <a href="{{ url("/$backend_uri/hotels/services") }}">
                                                        <span class="fa fa-birthday-cake"></span>
                                                        <span class="title">{{trans("hotels_services.link_in_admin_menu")}}</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('show rooms services')
                                                <li class="@if(Request::segment(5)=="services") active @endif">
                                                    <a href="{{ url("/$backend_uri/hotels/rooms/services") }}">
                                                        <span class="fa fa-bed"></span>
                                                        <span class="title">{{trans("rooms_services.link_in_admin_menu")}}</span>
                                                    </a>

                                                    </a>


                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endcan

                        @can('show bookings')
                            <li class="@if(Request::segment(3)=="bookings") active @endif">
                                <a href="{{ url("/$backend_uri/bookings") }}">
                                    <span class="icon icon-calendar"></span>
                                    <span class="title">{{trans("bookings.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan

                           @can('show payments')
                            <li class="@if(Request::segment(3)=="payments") active @endif">
                                <a href="{{ url("/$backend_uri/payments") }}">
                                    <span class="fa fa-money"></span>
                                    <span class="title">{{trans("bookings.link_in_admin_menu_payments")}}</span>
                                </a>
                            </li>
                        @endcan

                         @can('show comments')
                            <li class="@if(Request::segment(3)=="comments") active @endif">
                                <a href="{{ url("/$backend_uri/comments") }}">
                                    <span class="fa fa-comments-o"></span>
                                    <span class="title">{{trans("main.link_in_admin_menu_comment")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show places')
                            <li class="@if(Request::segment(3)=="places") active @endif">
                                <a href="{{ url("/$backend_uri/places") }}">
                                    <span class="fa fa-fort-awesome"></span>
                                    <span class="title">{{trans("places.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show categories')
                            <li class="dropdown @if(Request::segment(3)=="categories" || Request::segment(3)=="articles") active @endif">
                                <a href="#categories-dropdown-list"
                                   data-toggle="collapse">
                                    <span class="fa fa-clone"></span>
                                    <span class="title">{{trans("categories.link_in_admin_menu")}}</span>
                                </a>
                                <div id="categories-dropdown-list"
                                     class="panel-collapse collapse @if(Request::segment(3)=="categories" || Request::segment(3)=="articles") in @endif"
                                     aria-expanded="true">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            @can('show categories')
                                                <li class="@if(Request::segment(3)=="categories") active @endif">
                                                    <a href="{{ url("/$backend_uri/categories") }}">
                                                        <span class="fa fa-clone"></span>
                                                        <span class="title">{{trans("categories.link_in_admin_menu")}}</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('show articles')
                                                <li class="@if(Request::segment(3)=="articles") active @endif">
                                                    <a href="{{ url("/$backend_uri/articles") }}">
                                                        <span class="fa fa-dedent"></span>
                                                        <span class="title">{{trans("articles.link_in_admin_menu")}}</span>
                                                    </a>
                                                </li>
                                            @endcan

                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endcan

                        @can('show news')
                            <li class="@if(Request::segment(3)=="news") active @endif">
                                <a href="{{ url("/$backend_uri/news") }}">
                                    <span class="fa fa-newspaper-o"></span>
                                    <span class="title">{{trans("news.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show pages')
                            <li class="@if(Request::segment(3)=="pages") active @endif">
                                <a href="{{ url("/$backend_uri/pages") }}">
                                    <span class="fa fa-file-code-o"></span>
                                    <span class="title">{{trans("pages.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show builder')
                            <li class="@if(Request::segment(3)=="landing-pages") active @endif">
                                <a href="{{ url("/$backend_uri/landing-pages") }}">
                                    <span class="fa fa-columns"></span>
                                    <span class="title">{{trans("pages.link_in_admin_menu_landing")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show slides')
                            <li class="@if(Request::segment(3)=="slides") active @endif">
                                <a href="{{ url("/$backend_uri/slides") }}">
                                    <span class="fa fa-image"></span>
                                    <span class="title">{{trans("slides.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show transports')
                            <li class="@if(Request::segment(3)=="transports") active @endif">
                                <a href="{{ url("/$backend_uri/transports") }}">
                                    <span class="fa fa-plane"></span>
                                    <span class="title">{{trans("transports.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('show packages')
                            <li class="dropdown @if(Request::segment(3)=="packages" || Request::segment(3)=="packages_types") active @endif">
                                <a href="#packages-dropdown-list"
                                   data-toggle="collapse">
                                    <span class="icon icon-group"></span>
                                    <span class="title">{{trans('packages.link_in_admin_menu')}}</span>
                                </a>
                                <div id="packages-dropdown-list"
                                     class="panel-collapse collapse @if(Request::segment(3)=="packages" || Request::segment(3)=="packages_types") in @endif"
                                     aria-expanded="true">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li class="@if(Request::segment(3)=="packages") active @endif">
                                                <a href="{{url("/$backend_uri/packages")}}">
                                                    <span class="icon icon-group"></span>
                                                    <span class="title">{{trans('packages.link_in_admin_menu')}}</span>
                                                </a>
                                            </li>
                                            @can('show packages types')
                                                <li class="@if(Request::segment(3)=="packages_types") active @endif">
                                                    <a href="{{ url("/$backend_uri/packages_types") }}">
                                                        <span class="fa fa-th-large "></span>
                                                        <span class="title">{{trans("packages_types.link_in_admin_menu")}}</span>
                                                    </a>


                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>

                            </li>
                        @endcan
                        @can('show faq')
                            <li class="@if(Request::segment(3)=="faq") active @endif">
                                <a href="{{ url("/$backend_uri/faq") }}">
                                    <span class="fa fa-question-circle-o"></span>
                                    <span class="title">{{trans("faq.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show faq')
                            <li class="@if(Request::segment(3)=="testimonials") active @endif">
                                <a href="{{ url("/$backend_uri/testimonials") }}">
                                    <span class="icon icon-chat"></span>
                                    <span class="title">{{trans("testimonials.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show messages')
                            <li class="@if(Request::segment(3)=="messages") active @endif">
                                <a href="{{ url("/$backend_uri/messages") }}">
                                    <span class="icon icon-mail"></span>
                                    <span class="title">{{trans("messages.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan


                        @can('edit menus')
                            <li class="@if(Request::segment(3)=="menus") active @endif">
                                <a href="{{ url("/$backend_uri/menus") }}">
                                    <span class="fa fa-list-alt"></span>
                                    <span class="title">{{trans("menus.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show users')
                            <li class="@if(Request::segment(3)=="users") active @endif">
                                <a href="{{ url("/$backend_uri/users") }}">
                                    <span class="icon icon-group"></span>
                                    <span class="title">{{trans("users.link_users")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('show permissions')
                            <li class="@if(Request::segment(3)=="permissions") active @endif">
                                <a href="{{ url("/$backend_uri/permissions") }}">
                                    <span class="icon icon-lock"></span>
                                    <span class="title">{{trans("permissions.link_in_admin_menu")}}</span>
                                </a>
                            </li>
                        @endcan
                        @can('edit settings')
                            <li class="@if(Request::segment(3)=="settings") active @endif">
                                <a href="{{ url("/$backend_uri/settings") }}">
                                    <span class="icon icon-settings"></span>
                                    <span class="title">{{trans("main.link_settings")}}</span>
                                </a>
                            </li>
                        @endcan


                    </ul>
                    <!-- /.navbar-collapse -->
                </div>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('page_header')
                @yield('content')
            </div>
        </div>
    </div>
</div>
<footer class="app-footer">
    <div class="site-footer-right">
        Made with <i class="icon-heart"></i> by <a href="http://developnet.net" target="_blank">DevelopNet</a>
    </div>
</footer>
<!-- Javascript Libs -->

<script type="text/javascript" src="{{elixir("js/angular.js")}}"></script>

<script type="text/javascript" src="/backend/lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/backend/lib/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/backend/lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="/backend/lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/backend/lib/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/backend/lib/js/select2.full.min.js"></script>
<script type="text/javascript" src="/backend/lib/js/niceScroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="/backend/js/bootstrap-toggle.min.js"></script>
<!-- Javascript -->

<script type="text/javascript" src="/backend/lib/js/tinymce/tinymce.min.js"></script>
<script src="/backend/js/developnet_tinymce.js"></script>
<script type="text/javascript" src="/backend/js/readmore.min.js"></script>
<script type="text/javascript" src="/backend/js/app.js"></script>
<script type="text/javascript" src="/backend/lib/js/toastr.min.js"></script>
<script type="text/javascript" src="{{elixir("backend/js/ng-dependencies.js")}}"></script>
<script type="text/javascript" src="{{elixir("backend/js/ng-app.js")}}"></script>

<script>

            @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
$(".scrollbar").niceScroll();

</script>

@yield('javascript')
</body>
</html>
