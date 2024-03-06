@extends('frontend.layouts.master')

@section("content")

<section class="single-page-header" style="background-image: url({{$data->photo?url("files/{$data->photo}?size=1000,667"):'/images/page-backgrpund.jpg'}})">
        <div class="parallax-content-1">
            <div class="logo_content">
                <div class="animated fadeInDown">

                    <h1>{!! $data->name !!}</h1>
       
                </div>
            </div>
        </div>

    </section><!-- End section -->


<div id="position">
        <div class="container">
                    <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li>{{$data->name}}</li>
                    </ul>
        </div>
    </div><!-- End Position -->

    <div class="container margin_60">
        <center>
                @if($data->gallery()->count())
                    <div id="Img_carousel" class="slider-pro">


                        <div class="sp-slides">

                            @foreach($data->gallery as $photo)
                                <div class="sp-slide">
                                    <img alt="{{$data->name}}" class="sp-image"
                                         data-src="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-src="{{url("files/{$photo->name}?size=500,333")}}"
                                         data-small="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-medium="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-large="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-retina="{{url("files/{$photo->name}?size=1000,667")}}">
                                </div>
                            @endforeach
                          
                        </div>
                        <div class="sp-thumbnails">
                            

                            @foreach($data->gallery as $photo)
                                <img alt="Image" class="sp-thumbnail" src="{{url("files/{$photo->name}?size=120,80")}}">

                            @endforeach
                           
                        </div>
                    </div>

                    <hr>
                @endif
        </center>
    
    <div class="row">
    {!! $data->content !!}
    </div>
</div>

@stop

@section("styles")

<link href="/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/css/slider-pro.min.css" rel="stylesheet">

@stop

@section("scripts")

    <!-- Date and time pickers -->
    <script src="/assets/js/jquery.sliderPro.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('#Img_carousel').sliderPro({
                width: 960,
                height: 500,
                fade: true,
                arrows: true,
                buttons: false,
                fullScreen: false,
                smallSize: 500,
                startSlide: 0,
                mediumSize: 1000,
                largeSize: 3000,
                thumbnailArrows: true,
                autoplay: false
            });
        });
    </script>

    <script src="/assets/js/owl.carousel.min.js"></script>
<script>
        $(document).ready(function () {
            $(".carousel").owlCarousel({
                items: 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]
            });
        });
    </script>

    @stop