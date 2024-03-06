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
                    <a href="{{url("/country/{$country->id}/".str_slug($country->{"name:en"}))}}">{{$country->name}}</a>
                </li>
                <li class="active">{{trans("places.page_title_country_places",['country'=>$country->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="content">
            <div class="col-md-9 col-sm-12">
                @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                    <div class="addthis_inline_share_toolbox"></div> @endif
                <div class="hotel-list">
                    @if($places->count())
                        <div class="row image-box hotel listing-style1">
                            @foreach($places as $place)
                                <div class="col-sm-6 col-md-4">
                                    <article class="box">
                                        <figure>
                                            <a href="{{url("$locale/places/ajax/{$place->id}/gallery")}}"
                                               class="hover-effect popup-gallery"><img
                                                        width="270" height="160" alt=""
                                                        class="lazy"
                                                        src="{{url("files/{$place->photo}?size=270,160&encode=jpg")}}"></a>
                                        </figure>
                                        <div class="details">
                                            <h4 class="box-title"><a
                                                        href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}">{{$place->name}}</a>
                                                <small>
                                                    <a href="{{url("city/{$place->city->id}/".str_slug($place->city->{"name:en"} ))}}">{{$place->city->name}}</a>
                                                </small>
                                            </h4>
                                            <p class="description">
                                                {!! str_limit(strip_tags($place->description),200) !!}
                                            </p>
                                            <div class="action">
                                                <a class="button btn-small"
                                                   href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}">{{trans("places.btn_show")}}</a>
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
                {!! $places->links() !!}
            </div>
            <div class="sidebar col-md-3">

                @if($country->generalCategories()->count())
                    <div class="travelo-box filters-container faq-topics">
                        <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                        <ul class="triangle filters-option">

                            <li class="">
                                <a href="{{url("country/{$country->id}/".str_slug($country->{"name:en"})."/guide")}}">{{trans("countries.link_country_main_guide",['country'=>$country->name])}}</a>
                            </li>

                            @foreach($country->generalCategories as $item)
                                <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                    <a href="{{url("guide/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                @endif
                @if($country->package_types()->count())
                    <div class="travelo-box filters-container faq-topics">
                        <h4 class="box-title">{!! trans("countries.country_packages_types_box_title",['country'=>$country->name]) !!}</h4>
                        <ul class="triangle filters-option">

                            @foreach($country->package_types as $item)
                                <li>
                                    <a href="{{url("packages/type/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                </li>
                                @if($loop->index>=10)
                                    @php
                                        break;
                                    @endphp
                                @endif
                            @endforeach

                        </ul>
                    </div>
                @endif
                @if(Settings::get('show_help_box'))
                    <div class="travelo-box contact-box">
                        <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                        <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection
@section("scripts")
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-pZGejiZpnxwuELxEB52gSv_t96kPgio"></script>
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
                        icon: 'https://maps.google.com/mapfiles/marker_green.png'
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