<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{trans("main.app_title")}}</title>
    @if(Request::input('print'))
        <link rel="apple-touch-icon" media="all" href="{{url("/mmenu/assets/images/apple-touch-icon.png")}}">
        <link rel="shortcut icon" media="all" href="{{url("/mmenu/assets/images/favicon.ico")}}">
        <!-- Stylesheets -->
        <link rel="stylesheet"  media="all" href="{{url("/global/css/bootstrap.min.css")}}">
        <link rel="stylesheet"  media="all" href="{{url("/global/css/bootstrap-extend.min.css")}}">

        <link rel="stylesheet"  media="all" href="{{url("/global/fonts/material-design/material-design.min.css")}}">
        <link rel="stylesheet"  media="all" href="{{url("/css/font-awesome.min.css")}}">
        <link rel="stylesheet"  media="all" href="{{url("/mmenu/assets/css/site.min.css")}}">
        @endif


    <link rel="stylesheet" media="print" href="{{url("/global/css/bootstrap.min.css")}}">
    <link rel="stylesheet" media="print" href="{{url("/global/css/bootstrap-extend.min.css")}}">

    <link rel="stylesheet" media="print" href="{{url("/global/fonts/material-design/material-design.min.css")}}">
    <link rel="stylesheet" media="print" href="{{url("/css/font-awesome.min.css")}}">
    <link rel="stylesheet" media="print" href="{{url("/mmenu/assets/css/site.min.css")}}">

    <style>
        body { font-family:'Noto Kufi Arabic', sans-serif; }
    </style>
</head>
<body>
<div class="container">
    @yield("content")
</div>
<script src="/global/vendor/jquery/jquery.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
{{--angular Scripts--}}
<script src="/global/js/angular.js"></script>
<script src="/global/js/app.js"></script>
<script src="/js/jquery.print.js"></script>
{{--end angular Scripts--}}
</body>
</html>