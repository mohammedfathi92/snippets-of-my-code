@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{$data->name}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li><a href="{{url("/places")}}">{{trans("places.link_places")}}</a></li>
                <li class="active">{{$data->name}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")

    <div class="col-md-9">

        <div class="tab-container style1" id="hotel-main-content">
            <ul class="tabs">
                @if($data->gallery()->count())
                    <li class="active"><a data-toggle="tab"
                                          href="#photos-tab">{{trans('main.tab_photos')}}</a>
                    </li>
                @endif
                <li><a data-toggle="tab" href="#"
                       data-target="#map-tab">{{trans('main.tab_map')}}</a>
                </li>
                @if($data->embed_video)
                    <li class=""><a data-toggle="tab"
                                    data-target="#video-tab" href="#">{{trans('countries.tab_video')}}</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                @if($data->gallery()->count())
                    <div id="photos-tab" class="tab-pane fade in active">
                        <div class="photo-gallery style1" data-animation="slide"
                             data-sync="#photos-tab .image-carousel">
                            <ul class="slides">
                                @foreach($data->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".$photo->name))
                                        <li><img class="img-responsive lazy"
                                                 src="{{url("/files/{$photo->name}?size=870,578&encode=jpg")}}"
                                                 alt="{{$data->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70"
                             data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                            <ul class="slides">
                                @foreach($data->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".config("settings.thumbnails_dir")."/".$photo->name))
                                        <li>
                                            <img class="img-responsive lazy"
                                                 src="{{url("/files/{$photo->name}?size=93,70&encode=jpg")}}"
                                                 alt="{{$data->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div id="map-tab" class="tab-pane fade"></div>
                @if($data->embed_video)
                    <div id="video-tab" class="tab-pane fade">
                        <div class='embed-container'>
                            {!! $data->embed_video !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div id="hotel-features" class="tab-container">
            <ul class="tabs">
                <li class="active">
                    <a href="#" data-target="#place-description" data-toggle="tab">
                        {{trans("main.tab_description")}}</a></li>
                @if($data->notes)
                    <li class="">
                        <a href="#" data-target="#place-notes" data-toggle="tab">
                            {{trans("places.tab_notes")}}
                        </a>
                    </li>

                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="place-description">
                    <div class="long-description">
                        {!! $data->description !!}
                    </div>
                    <div class="clearfix"></div>
                    @if($data->tabs()->count())
                        <div class="large-block image-box style6">
                            @php
                                $right=true;
                            @endphp
                            @foreach($data->tabs as $tab)

                                <article class="box">
                                    <figure class="@if($right) col-md-5 pull-right middle-block @else col-md-5 @endif">
                                        @if($tab->photo)
                                            <a href="#" title="" class=" middle-block">
                                                <img class="img-thumbnail middle-item lazy"
                                                     src="{{url("files/{$tab->photo}?size=476,318&encode=jpg")}}"
                                                     alt="{{$tab->title}}"
                                                     width="476" height="318"/></a>
                                        @endif()
                                    </figure>
                                    <div class="@if($right)details col-md-7 @else details col-md-offset-5 @endif">
                                        <h4 class="box-title">{{$tab->title}}</h4>
                                        <p>{!! $tab->description !!}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </article>
                                @if($right)@php $right=false @endphp @else @php $right=true @endphp @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @if($data->notes)
                    <div class="tab-pane fade" id="place-notes">
                        <div class="long-description">
                            {!! $data->notes !!}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <div class="sidebar col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
            <div class="addthis_inline_share_toolbox"></div> @endif

        @php
            $city=$data->city;

        @endphp
        <div class="travelo-box">
            <h4>{{trans("places.city_places_title",['city'=>$city->name])}}</h4>
            <div class="image-box style14">
                @foreach($related->get() as $place)
                    <article class="box">
                        <figure>

                            <a href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}">
                                @if(isset($place->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$place->photo))
                                    <img class="img-responsive lazy"
                                         src="{{url("files/{$place->photo}?size=63,47&encode=jpg")}}"
                                         alt="{{$place->name}}"/></a>
                            @endif
                        </figure>
                        <div class="details">
                            <h5 class="box-title"><a
                                        href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}">{{$place->name}}</a>
                            </h5>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        @if(Settings::get('show_help_box'))
            <div class="travelo-box contact-box">
                <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
            </div>
        @endif
    </div>

@endsection
@section("scripts")
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-pZGejiZpnxwuELxEB52gSv_t96kPgio"></script>
    <script>
        (function ($) {
            $("#map-tab").height($("#hotel-main-content").width() * 0.6);
            $('a[data-target="#map-tab"]').on('shown.bs.tab', function (e) {
                initMap();
            });
            function initMap() {

                var map = new google.maps.Map(document.getElementById('map-tab'), {
                    zoom: 18,
                    center: {lat: -34.397, lng: 150.644}
                });
                        @if($data->map)
                var latlngString = "{{$data->map}}".split(",");
                var latlng = {lat: parseFloat(latlngString[0]), lng: parseFloat(latlngString[1])};
                map.setCenter(latlng);
                var marker = new google.maps.Marker({
                    map: map,
                    position: latlng
                });
                        @else

                var geocoder = new google.maps.Geocoder();
                geocodeAddress(geocoder, map);
                @endif
            }

            function geocodeAddress(geocoder, resultsMap) {
                var address = "{{$data->address}}";
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status === 'OK') {
                        resultsMap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location
                        });
                    }
                });
            }
        })(jQuery);

    </script>
@stop