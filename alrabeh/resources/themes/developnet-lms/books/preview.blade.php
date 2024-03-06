<!DOCTYPE html>
<html lang="{{ \Language::getCode() }}" dir="{{ \Language::getDirection() }}">
<head>   
     {!! \SEO::generate() !!}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>educational</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 4 -->
     {!! Theme::css('roots/css/bootstrap.rtl.min.css') !!}

    <!-- Font Awesome -->
    {!! Theme::css('roots/css/font-awesome.min.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> 
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font --> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Theme style--> 
    {!! Theme::css('css/style.css') !!}
    {!! Theme::css('css/pages.css') !!}
    @yield('css')

    {!! Theme::css('css/style.rtl.css') !!}
    {!! Theme::css('css/responsive.css') !!}
    {!! Theme::css('roots/css/animate.min.css') !!}


   

        @if(\Settings::get('google_analytics_id'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id={{ \Settings::get('google_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', "{{ \Settings::get('google_analytics_id') }}");
        </script>
    @endif

        <style>
        .grade-statics  li{
            margin-bottom: 10px;
        }
        .grade-statics  li span{
            font-size: 17px;
            display: inline-block;
            margin-left: 10px;
            width: 180px;
            text-align: right;
        }
        .course-grades-content{
            border: transparent;
            align-items: initial;
        }
        .course-grades {
            background: #fcfcfc;
            border: 1px solid #ddd;
            padding-bottom: 10px
        }
        .grades {
            margin-top: 10px
        } 
    </style>

</head>

<body>
  
    <div class="main-content-wrapper">

  


    <div class="main-content">

		<div class="container-fluid">
			

			<div class="row course-leeson-section">
				<iframe src='{{'/ViewerJS/#..'.$book->file}}' style="max-width: 100%; width: 100%; max-height: 100%; min-height: 100vh;"></iframe>
					{{-- <style>.embed-container { height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='{{'/ViewerJS/#..'.$book->file}}'></iframe></div> --}}	
				
			</div>

		</div>

    
	</div>



@stack('child_content')
@yield('after_content')

</div><!--End of Main Wrapper-->


<!-- jQuery JS-->
{!! Theme::js('roots/js/jquery.min.js') !!}

<!-- Bootstrap JS -->
{!! Theme::js('roots/js/bootstrap.min.js') !!}
 <!-- Page JS -->
{!! Theme::js('js/functions.js') !!} 

@include('components.alert_message')  

<script async src="https://static.addtoany.com/menu/page.js"></script>

    <script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>  
{!! Theme::js('js/jquery.simple.timer.js') !!}

@yield('js')
@stack('child_scripts')


</body>
</html>