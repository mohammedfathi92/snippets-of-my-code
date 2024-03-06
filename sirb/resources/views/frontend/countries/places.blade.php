@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name)."/places",$localeCode)}}"/>
        @endif
    @endforeach
    <!--next and prev meta-->
    @if($cities->nextPageUrl())
        <link rel="next" href="{{$cities->nextPageUrl()}}">
    @endif
    @if($cities->previousPageUrl())
        <link rel="prev" href="{{$cities->previousPageUrl()}}">
    @endif
@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("cities.page_title_country_places",['country'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{\LaravelLocalization::localizeURL("/country/{$country->id}/".make_slug($country->name))}}">{{$country->name}}</a>
                </li>
                <li class="active">{{trans("cities.page_title_country_cities",['country'=>$country->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">

        <div class="content">
            <div class="col-md-9 col-sm-12">
                @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                    <div class="addthis_inline_share_toolbox"></div> @endif
                <div class="hotel-list">
                    @if($cities)
                        <div class="row image-box hotel listing-style1">
                            @foreach($cities as $city)
                                <div class="col-sm-6 col-md-4">
                                    <article class="box" style="min-height: 100px">
                                      

                                           <figure>

                            <a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name)."/places")}}">
                                @if(isset($city->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$city->photo))
                                    <img width="270" height="160" alt="" class="lazy"
                                         src="{{url("files/{$city->photo}?size=270,160&encode=jpg")}}"
                                         alt="{{$city->name}}"/></a>
                            @endif
                        </figure>

                                        <div class="details">
                                            @if($city->price)
                                                <span class="price">
                                                    <small>avg/night</small>
                                                    {{$city->price}}
                                                </span>
                                            @endif
                                            <h4 class="box-title"><a
                                                        href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name)."/places")}}">{{trans("places.country_cities_places_item",['city'=>$city->name])}}</a>
                                                <small>
                                                    <a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name))}}">{{$city->name}}</a>
                                                </small>
                                            </h4>
                                            
                                            <div class="action">
                                                <a class="button btn-small"
                                                   href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($country->name)."/places")}}">{{trans("cities.btn_show_places")}}</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">{{trans("cities.no_results_found")}}</div>
                    @endif
                </div>
                    <!--cities here-->
                {{ $cities->links() }}
            </div>
            <div class="sidebar col-md-3">

                @if($country->generalCategories()->count())
                    <div class="travelo-box filters-container faq-topics">
                        <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                        <ul class="triangle filters-option">

                            <li class="">
                                <a href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name)."/guide")}}">{{trans("countries.link_country_main_guide",['country'=>$country->name])}}</a>
                            </li>

                            @foreach($country->generalCategories as $item)
                                <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                    <a href="{{\LaravelLocalization::localizeURL("guide/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
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
                                    <a href="{{\LaravelLocalization::localizeURL("packages/type/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
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
                @if(settings('show_help_box'))
                    <div class="travelo-box contact-box">
                        <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                        <p> {!! settings("{$locale}_help_box_details") !!}</p>
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