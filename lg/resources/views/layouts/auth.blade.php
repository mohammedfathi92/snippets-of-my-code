<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 7/21/16
 * Time: 5:20 PM
 */
?>
        <!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>LG | Digital Signature</title>
    <link rel="apple-touch-icon" href="/mmenu/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="/mmenu/assets/images/favicon.ico">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="/mmenu/assets/css/site.min.css">
    <!-- Plugins -->
    <link rel="stylesheet" href="/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="/global/vendor/jquery-/mmenu/jquery-/mmenu.css">
    <link rel="stylesheet" href="/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="/global/vendor/waves/waves.css">
    <link rel="stylesheet" href="/mmenu/assets/examples/css/pages/login.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.min.css">
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
    <script>
        Breakpoints();
    </script>
</head>
<body class="page-login layout-full page-dark">

<div class="page animsition vertical-align text-center " data-animsition-in="fade-in"
     data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle whitebg">
        @yield('content')

    </div>
</div>
<!-- End Page -->
<!-- Core  -->
<script src="/global/vendor/jquery/jquery.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/global/vendor/animsition/animsition.js"></script>
<script src="/global/vendor/asscroll/jquery-asScroll.js"></script>
<script src="/global/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="/global/vendor/asscrollable/jquery.asScrollable.all.js"></script>
<script src="/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
<script src="/global/vendor/waves/waves.js"></script>
<!-- Plugins -->
<script src="/global/vendor/jquery-/mmenu/jquery./mmenu.min.all.js"></script>
<script src="/global/vendor/switchery/switchery.min.js"></script>
<script src="/global/vendor/intro-js/intro.js"></script>
<script src="/global/vendor/screenfull/screenfull.js"></script>
<script src="/global/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<!-- Scripts -->
<script src="/global/js/core.js"></script>
<script src="/mmenu/assets/js/site.js"></script>
<script src="/mmenu/assets/js/sections/menu.js"></script>
<script src="/mmenu/assets/js/sections/menubar.js"></script>
<script src="/mmenu/assets/js/sections/gridmenu.js"></script>
<script src="/mmenu/assets/js/sections/sidebar.js"></script>
<script src="/global/js/configs/config-colors.js"></script>
<script src="/mmenu/assets/js/configs/config-tour.js"></script>
<script src="/global/js/components/asscrollable.js"></script>
<script src="/global/js/components/animsition.js"></script>
<script src="/global/js/components/slidepanel.js"></script>
<script src="/global/js/components/switchery.js"></script>
<script src="/global/js/components/tabs.js"></script>
<script src="/global/js/components/jquery-placeholder.js"></script>
<script src="/global/js/components/material.js"></script>
<script>
    (function (document, window, $) {
        'use strict';
        var Site = window.Site;
        $(document).ready(function () {
            Site.run();
        });
    })(document, window, jQuery);
</script>
</body>
</html>