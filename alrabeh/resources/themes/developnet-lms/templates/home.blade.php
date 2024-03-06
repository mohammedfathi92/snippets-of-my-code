@extends('layouts.master')
@section('content')

@php

$courses = \LMS::leatestCourses();

$quizzes = \LMS::leatestQuizzes();

@endphp
        @include('templates.sections.home.slider')
        {{-- @include('templates.sections.home.about') --}}
        @include('templates.sections.home.courses')
        @include('templates.sections.home.quizzes')
        @include('templates.sections.home.features')
{{--        @include('templates.sections.home.members')--}}
        @include('templates.sections.home.testimonials')

@endsection

@section('css')

     {!! Theme::css('roots/css/fancybox/jquery.fancybox.min.css') !!}

@endsection

@section('js')
{!! Theme::js('roots/js/owl.carousel.min.js') !!}
<script type="text/javascript">
    $(document).ready(function() {
    var owl = $(".customCarousel");

      owl.owlCarousel({
        responsive:{
            0:{
                items:1
            },
            400:{
                items:2
            },
            800:{
                items:3
            }
        },
         nav    : true,
         rtl: true,
         smartSpeed :800,

         navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
      });


});
</script>
{!! Theme::js('js/jquery.flexslider.js') !!}
    <script type="text/javascript">
        $(window).load(function(){
          $('.flexslider').flexslider({
            animation: "slide",
            rtl: true,
            start: function(slider){
              $('body').removeClass('loading');
            }
          });
        });

    </script>

<!-- Wow Scroll-->
{!! Theme::js('roots/js/wow.min.js') !!}
    <script>
        new WOW().init();
    </script>
    {!! Theme::js('roots/js/fancybox/jquery.fancybox.min.js') !!}
    <script type="text/javascript">
      $(document).ready(function () {
    $(".various").fancybox({
        type: "iframe", //<--added
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });
})
    </script>

@endsection




