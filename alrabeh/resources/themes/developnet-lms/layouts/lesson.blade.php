<!DOCTYPE html>
<html lang="{{ \Language::getCode() }}" dir="{{ \Language::getDirection() }}">
<head>
    {!! \SEO::generate() !!}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{isset($page_title)?$page_title:''}}</title>
    <link rel="shortcut icon" href="{{ \Settings::get('site_favicon') }}" type="image/png">
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
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Theme style-->
    {!! Theme::css('css/style.css') !!}
    {!! Theme::css('css/pages.css') !!}


    {!! Theme::css('css/style.rtl.css') !!}
    {!! Theme::css('css/responsive.css') !!}
    {!! Theme::css('roots/css/animate.min.css') !!}

    @yield('css')
    @stack('child_css')


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
        .grade-statics li {
            margin-bottom: 10px;
        }

        .grade-statics li span {
            font-size: 17px;
            display: inline-block;
            margin-left: 10px;
            width: 180px;
            text-align: right;
        }

        .course-grades-content {
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

@php


    $courseSections = $course->sections();

@endphp

<body>
@php
    $authUser = new \Modules\Components\LMS\Models\UserLMS;
    if(Auth::check()){
    $authUser = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());
    }
@endphp
<div class="main-content-wrapper">

    <!-- search -->
    <div class="main-search-from">
        <form>
            <div class="form-group">
                <input type="text" name="search-text" class="" placeholder="Search here..">
                <button type="submit" name="search" class="fa fa-search"></button>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </form>
    </div>


    <div class="main-content">

        <div class="container-fluid">
            <div class="row">
                <div class="course-nav">
                    <div class="menu-span col-xs-6">
                        <i class="fa fa-bars aria-hidden=" true></i>
                        <a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
                        {{--  <i class="fa fa-search top-search-from"></i>  @deleteSearch --}}
                    </div>
                    <div class="course-nav-meta col-xs-6">
                        <i class="fa fa-expand" aria-hidden="true"></i>
                        <a href="{{isset($closeItemRoute)?$closeItemRoute:'/'}}"><i class="fa fa-close"
                                                                                    aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div class="row course-leeson-section">
                <hr>
                <div class="course-side-menu wrap-breadcrumb">
                    <div class="curriculum-breadcrumb">
                        <div class="container">
                            <div class="row">
                                @if(isset($breadcrumb))
                                    <ol class="breadcrumb" style="background-color: #f5f5f5;">
                                        @foreach($breadcrumb as $row)
                                            @if($row['link'] != false)
                                                <li class="breadcrumb-item"><a
                                                            href="{{$row['link']}}">{{$row['name']}}</a></li>
                                            @else
                                                <li class="breadcrumb-item active">{{$row['name']}}</li>
                                            @endif
                                        @endforeach

                                    </ol>
                                @endif
                            </div>
                        </div>
                    </div>
                    <ul class="curriculum-sections">
                        @foreach($courseSections->orderBy('order','asc')
                                             ->with('lessons')->with('quizzes')->get() as $courseSection)
                            @include('courses.partials.course_menu', ['section' =>  $courseSection, 'courseSections' => $courseSections, 'course'=> $course, 'user' => $authUser])
                        @endforeach
                        @if(\Auth::check())

                            <li class="course-item text-center" style="">

                                <br>
                                <a class="btn btn-dark"
                                   href="{{route('courses.results', ['course_id' => $course->hashed_id ])}}"><i
                                            class="fa fa-list"></i> @lang('developnet-lms::labels.spans.show_results')
                                </a>
                            </li>
                        @endif

                        @include('components.retake_course_btn')

                    </ul>
                </div>
                <div class="course-leeson-content">
                    @yield('content')
                </div>
            </div>

        </div>


    </div>


    @stack('child_content')


    @yield('after_content')
    {{--  @if(Auth::check())
        @include('partials.messanger')
        @endif --}}
</div><!--End of Main Wrapper-->

@stack('child_after_content')

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
