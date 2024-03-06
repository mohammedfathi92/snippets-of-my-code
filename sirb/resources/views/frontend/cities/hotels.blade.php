@extends('frontend.layouts.master')
@section("__meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{route("city.hotels",[$city->id,make_slug($city->name)])}}"/>
        @endif
    @endforeach
    @if($hotels->nextPageUrl())
        <link rel="next" href="{{$hotels->nextPageUrl()}}">
    @endif
    @if($hotels->previousPageUrl())
        <link rel="prev" href="{{$hotels->previousPageUrl()}}">
    @endif
@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("hotels.page_title_city_hotels",['city'=>$city->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{route("country.details",[$city->country->id,make_slug($city->country->name)])}}">{{$city->country->name}}</a>
                </li>
                <li class="active">{{trans("countries.destination_page_title",['name'=>$city->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-md-9">
            @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="hotel-list">
                @if($hotels)
                    <div class="row image-box hotel listing-style1">
                        @foreach($hotels as $hotel)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a rel='nofollow'
                                           href="{{\LaravelLocalization::localizeURL("$locale/hotels/ajax/{$hotel->id}/gallery")}}"
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
                                                    href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>make_slug($hotel->name)])}}">{{$hotel->name}}</a>
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
                                               href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>make_slug($hotel->name)])}}">{{trans("hotels.btn_details")}}</a>
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

            <!-- Country Cieties -->

            @if($country->cities()->count())
                <div class="travelo-box">
                    <h4>{{trans("hotels.country_cities_hotels_title",['country'=>$country->name])}}</h4>
                    <div class="image-box style14">
                        @foreach($country->cities()->get() as $city)
                            <article class="box">
                                <figure>

                                    <a href="{{route("city.hotels",[$city->id,make_slug($country->name)])}}">
                                        @if(isset($city->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$city->photo))
                                            <img class="img-responsive lazy"
                                                 src="{{url("files/{$city->photo}?size=63,47&encode=jpg")}}"
                                                 alt="{{$city->name}}"/></a>
                                    @endif
                                </figure>
                                <div class="details">
                                    <h5 class="box-title"><a
                                                href="{{route("city.hotels",[$city->id,make_slug($country->name)])}}">{{trans("hotels.country_cities_hotels_item",['city'=>$city->name])}}</a>
                                    </h5>
                                </div>
                            </article>
                            @if($loop->iteration >5)
                                @php break @endphp
                            @endif
                        @endforeach
                        <a href="{{route("country.hotels",[$country->id,make_slug($country->name)])}}"
                           class="button btn-small full-width">{{trans("cities.btn_show_more")}}</a>
                    </div>
                </div>

            @endif

        <!-- End Country Cieties -->

            @if($city->generalCategories()->count())

                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("cities.city_guide_box_title",['city'=>$city->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($city->generalCategories as $item)
                            <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                <a href="{{\LaravelLocalization::localizeURL("guide/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
                                @if($item->subCategories()->count())
                                    <ul class="list-group">
                                        @foreach($item->subCategories as $subItem)
                                            <li class="list-group-item {{($subItem->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                                <a href="{{\LaravelLocalization::localizeURL("guide/{$subItem->id}/".make_slug($subItem->name))}}">{{$subItem->name}}</a>
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
                                <a href="{{\LaravelLocalization::localizeURL("guide/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            @endif
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>

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