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

        <div class="content">
            @if(Settings::get("show_share_buttons")) <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="institute-list">
                @if($institutes)
                    <div class="row image-box institute listing-style1">
                        @foreach($institutes as $institute)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("$locale/institutes/ajax/{$institute->id}/gallery")}}"
                                           class="hover-effect popup-gallery"><img
                                                    width="270" height="160" alt=""
                                                    src="{{url("files/{$institute->photo}?size=270,160&encode=jpg")}}"></a>
                                    </figure>
                                    <div class="details">
                                        @if($institute->price)
                                            <span class="price">
                                                    <small>avg/night</small>
                                                {{$institute->price}}
                                                </span>
                                        @endif
                                        <h4 class="box-title">{{$institute->name}}
                                            <small>{{$institute->city->name}}</small>
                                        </h4>
                                        <div class="feedback">
                                            <div data-placement="bottom" data-toggle="tooltip"
                                                 class="five-stars-container" title="4 stars"><span
                                                        style="width: {{$institute->stars*20}}%;"
                                                        class="five-stars"></span>
                                            </div>

                                        </div>
                                        <p class="description">
                                            {!! str_limit(strip_tags($institute->description),200) !!}
                                        </p>
                                        <div class="action">
                                            <a class="button btn-small"
                                               href="{{url("institutes/$institute->id/".str_slug($institute->name))}}">{{trans("institutes.btn_details")}}</a>
                                            @if($institute->map)
                                                <a class="button btn-small yellow popup-map" href="#"
                                                   data-box="{{$institute->map}}">{{trans("institutes.btn_show_in_map")}}</a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">{{trans("institutes.no_results_found")}}</div>
                @endif
            </div>
            {{ $institutes->links() }}
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