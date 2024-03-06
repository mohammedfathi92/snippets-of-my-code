@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.destination_page_title",['name'=>$city->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{url("/country/{$city->country->id}/".str_slug($city->country->name))}}">{{$city->country->name}}</a>
                </li>
                <li class="active">{{trans("countries.destination_page_title",['name'=>$city->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-md-9">
            @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="hotel-list">
                @if($hotels)
                    <div class="row image-box hotel listing-style1">
                        @foreach($hotels as $hotel)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("$locale/hotels/ajax/{$hotel->id}/gallery")}}"
                                           class="hover-effect popup-gallery"><img
                                                    width="270" height="160" alt=""
                                                    class="lazy"
                                                    src="{{url("files/{$hotel->photo}?size=270,160&encode=jpg")}}"></a>
                                    </figure>
                                    <div class="details">
                                        @if($hotel->price)
                                            <span class="price">
                                                    <small>avg/night</small>
                                                {{$hotel->price}}
                                                </span>
                                        @endif
                                        <h4 class="box-title"><a
                                                    href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>str_slug($hotel->{"name:en"})])}}">{{$hotel->name}}</a>
                                            <small>{{$hotel->city->name}}</small>
                                        </h4>
                                        <div class="feedback">
                                            <div data-placement="bottom" data-toggle="tooltip"
                                                 class="five-stars-container" title="4 stars"><span
                                                        style="width: {{$hotel->stars*20}}%;"
                                                        class="five-stars"></span>
                                            </div>

                                        </div>
                                        <p class="description">
                                            {!! str_limit(strip_tags($hotel->description),200) !!}
                                        </p>
                                        <div class="action">
                                            <a class="button btn-small"
                                               href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>str_slug($hotel->{"name:en"})])}}">{{trans("hotels.btn_details")}}</a>
                                            @if($hotel->map)
                                                <a class="button btn-small yellow popup-map" href="#"
                                                   data-box="{{$hotel->map}}">{{trans("hotels.btn_show_in_map")}}</a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">{{trans("hotels.no_results_found")}}</div>
                @endif
            </div>
            {{ $hotels->links() }}
        </div>
        <div class="sidebar col-sms-6 col-sm-4 col-md-3">
            @if($city->generalCategories()->count())

                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("cities.city_guide_box_title",['city'=>$city->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($city->generalCategories as $item)
                            <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                <a href="{{url("guide/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                @if($item->subCategories()->count())
                                    <ul class="list-group">
                                        @foreach($item->subCategories as $subItem)
                                            <li class="list-group-item {{($subItem->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                                <a href="{{url("guide/{$subItem->id}/".str_slug($subItem->name))}}">{{$subItem->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                    </ul>
                </div>
            @endif

            @if($city->country->generalCategories()->count())
                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$city->country->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($city->country->generalCategories as $item)
                            <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                <a href="{{url("guide/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                            </li>
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

@endsection
@section("scripts")
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-pZGejiZpnxwuELxEB52gSv_t96kPgio"></script>
    <script type="text/javascript" src="{{url("/js/gmap3.min.js")}}"></script>
    <script>
        (function ($) {
            function initialize(selector) {
                var center = [];
                @if($city->map)
                        @php
                            $center=explode(",",$city->map)
                        @endphp
                    center = [parseFloat("{{$center[0]}}"), parseFloat("{{$center[1]}}")];
                @endif

        $(selector).gmap3({
                    center: center,
                    address: "{{$city->name}}",
                    zoom: 10,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                })
                    .marker({
                        position: center,
                        address: "{{$city->name}}",
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