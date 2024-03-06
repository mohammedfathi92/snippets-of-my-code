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

@yield('styles')
    
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

@yield('content')


  <footer id="footer">
            <div class="footer-wrapper">
                <div class="container">
                    <nav id="main-menu" role="navigation" class="inline-block hidden-mobile">
                        {!! menu('main_menu',['class'=>'menu']) !!}
                    </nav>
                    <div class="copyright">
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

    @yield('scripts')
    
</body>
</html>

