<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->
<head>
    <!-- Page Title -->
    <title>{{trans("main.title_page_not_found")}}</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Travelo - Travel, Tour Booking HTML5 Template">
    <meta name="author" content="SoapTheme">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Theme Styles -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/animate.min.css">

    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="/assets/css/style.css">

    <!-- Updated Styles -->
    <link rel="stylesheet" href="/assets/css/updates.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/assets/css/custom.css">

    <!-- Responsive Styles -->
    <link rel="stylesheet" href="/assets/css/responsive.css">

    <!-- CSS for IE -->
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="/assets/css/ie.css"/>
    <![endif]-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>
<body class="post-404page style1">
<div id="page-wrapper">
    <header id="header" class="navbar-static-top">
        <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle blue-bg">Mobile Menu Toggle</a>
        <div class="container">
            @php
                $locale=\Illuminate\Support\Facades\Lang::getLocale();
            @endphp
            <h1 class="logo">
                <a href="/" title="{{settings("{$locale}_title")}}">
                    <img src="{{Storage::url(settings("logo")."?size=242,90&encode=png")}}"
                         alt="{{settings("{$locale}_title")}}"/>
                </a>
            </h1>
        </div>
        <nav id="mobile-menu-01" class="mobile-menu collapse menu-color-blue">
            {!! menu('main_menu') !!}

            {!! menu('main_menu') !!}
        </nav>
    </header>

    <section id="content">
        <div class="container">
            <div id="main">
                <div class="col-md-6 col-sm-9 no-float no-padding center-block">
                    <div class="error-message">{{trans("main.404_page_description")}}</div>
                </div>
                <div class="error-message-404">
                    404
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="footer-wrapper">
            <div class="container">
                <nav id="main-menu" role="navigation" class="inline-block hidden-mobile">
                    {!! menu('main_menu') !!}
                </nav>
                <div class="copyright">
                    <p>&copy; {{--2014 Travelo--}}</p>
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
<script type="text/javascript" src="/assets/js/bootstrap.js"></script>

<!-- parallax -->
<script type="text/javascript" src="/assets/js/jquery.stellar.min.js"></script>

<!-- waypoint -->
<script type="text/javascript" src="/assets/js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="/assets/js/theme-scripts.js"></script>
<script type="text/javascript" src="/assets/js/scripts.js"></script>

</body>
</html>