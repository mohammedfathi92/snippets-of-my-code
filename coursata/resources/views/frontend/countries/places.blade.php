@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.destination_page_title",['name'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{url("/country/{$country->id}/".str_slug($country->name))}}">{{$country->name}}</a>
                </li>
                <li class="active">{{trans("places.page_title_country_places",['country'=>$country->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="content">
            @if(Settings::get("show_share_buttons")) <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="institute-list">
                @if($places)
                    <div class="row image-box institute listing-style1">
                        @foreach($places as $place)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("$locale/places/ajax/{$place->id}/gallery")}}"
                                           class="hover-effect popup-gallery"><img
                                                    width="270" height="160" alt=""
                                                    src="{{url("files/{$place->photo}?size=270,160&encode=jpg")}}"></a>
                                    </figure>
                                    <div class="details">
                                        @if($place->price)
                                            <span class="price">
                                                    <small>avg/night</small>
                                                {{$place->price}}
                                                </span>
                                        @endif
                                        <h4 class="box-title">{{$place->name}}
                                            <small>{{$place->city->name}}</small>
                                        </h4>
                                        <p class="description">
                                            {!! str_limit(strip_tags($place->description),200) !!}
                                        </p>
                                        <div class="action">
                                            <a class="button btn-small"
                                               href="{{url("places/$place->id/".str_slug($place->name))}}">{{trans("places.btn_show")}}</a>
                                            @if($place->map)
                                                <a class="button btn-small yellow popup-map" href="#"
                                                   data-box="{{$place->map}}">{{trans("places.btn_show_in_map")}}</a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">{{trans("places.no_results_found")}}</div>
                @endif
            </div>
            {{ $places->links() }}
        </div>
    </div>

@endsection
@section("scripts")
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyA-pZGejiZpnxwuELxEB52gSv_t96kPgio"></script>
    <script type="text/javascript" src="{{url("/js/gmap3.min.js")}}"></script>
    <script>
        (function ($) {
            function initialize(selector) {
                var center = [];
                @if($country->map)
                        @php
                            $center=explode(",",$country->map)
                        @endphp
                    center = [parseFloat("{{$center[0]}}"), parseFloat("{{$center[1]}}")];
                @endif

        $(selector).gmap3({
                    center: center,
                    address: "{{$country->name}}",
                    zoom: 5,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                })
                    .marker({
                        position: center,
                        address: "{{$country->name}}",
                        icon: 'http://maps.google.com/mapfiles/marker_green.png'
                    });

            }

            $(document).ready(function () {
                $("#show-map").click(function () {
                    initialize("#map-container")
                });

            });
        })(jQuery);

    </script>
@stop