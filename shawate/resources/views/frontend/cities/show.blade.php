@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("cities.frontend_city_page_title",['city'=>$city->name])}}</h2>
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

    <div class="col-md-9">

        <div class="tab-container style1" id="hotel-main-content">
            <ul class="tabs">
                @if($city->gallery()->count())
                    <li class="active"><a data-toggle="tab"
                                          data-target="#photos-tab" href="#">{{trans('main.tab_photos')}}</a>
                    </li>
                @endif
                {{--@if($city->map)--}}
                <li class=""><a data-toggle="tab" id="show-map"
                                data-target="#map-tab" href="#">{{trans('main.tab_map')}}</a>
                </li>
                {{-- @endif--}}
                @if($city->embed_video)
                    <li class=""><a data-toggle="tab"
                                    data-target="#video-tab" href="#">{{trans('countries.tab_video')}}</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                @if($city->gallery()->count())
                    <div id="photos-tab" class="tab-pane fade in active">
                        <div class="photo-gallery style1" data-animation="slide"
                             data-sync="#photos-tab .image-carousel">
                            <ul class="slides">
                                @foreach($city->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".$photo->name))
                                        <li><img class="img-responsive lazy"
                                                 src="{{url("/files/{$photo->name}?size=870,489&encode=jpg")}}"
                                                 style="width: 100%;"
                                                 alt="{{$city->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70"
                             data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                            <ul class="slides">
                                @foreach($city->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".config("settings.thumbnails_dir")."/".$photo->name))
                                        <li><img class="lazy"
                                                 src="{{url("/files/{$photo->name}?size=93,70&encode=jpg")}}"
                                                 alt="{{$city->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                {{-- @if($city->map)--}}
                <div id="map-tab" class="tab-pane">
                    <div id="map-container" style="width: 100%;height: 489px;"></div>
                </div>
                {{--@endif--}}
                @if($city->embed_video)
                    <div id="video-tab" class="tab-pane fade">
                        <div class='embed-container'>
                            {!! $city->embed_video !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div id="hotel-features" class="tab-container">
            <ul class="tabs">
                <li class="active"><a href="javascript:;" data-target="#hotel-description"
                                      data-toggle="tab">{{trans("main.tab_description")}}</a></li>
                @php
                    $hotels=$city->hotels()->published()->get();
                    $places=$city->places()->published()->get();
                    $cities=$city->country->cities()->published($city->id)->get();
                @endphp
                @if($hotels->count() && (int)Settings::get('country_hotels_count'))

                    <li><a href="javascript:;" data-target="#country-hotels"
                           data-toggle="tab">{{trans("main.tab_hotels")}}</a></li>
                @endif
                @if($places->count() && (int)Settings::get('country_places_count'))
                    <li><a href="javascript:;" data-target="#city-places"
                           data-toggle="tab">{{trans("main.tab_places")}}</a></li>
                @endif
                @if($city->generalCategories()->count())
                    @foreach($city->generalCategories as $item)
                        <li><a href="javascript:;" data-target="#city-guide-{{$loop->index}}"
                               data-toggle="tab">{{$item->name}}</a></li>
                    @endforeach
                @endif


            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="hotel-description">
                    <div class="long-description">
                        {!! $city->description !!}
                    </div>
                    @if($city->tabs()->count())
                        <div class="large-block image-box style6">
                            @php
                                $right=true;
                            @endphp
                            @foreach($city->tabs as $tab)

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
                @if($hotels->count() && (int)Settings::get('country_hotels_count'))
                    <div class="tab-pane fade" id="country-hotels">
                        <div class="room-list listing-style3 hotel">

                            @foreach($hotels as $hotel)
                                <article class="box">
                                    <figure class="col-sm-4 col-md-3">
                                        <a class="hover-effect"
                                           href="{{url("/hotels/{$hotel->id}/".str_slug($hotel->{"name:en"}))}}"
                                           title="">
                                            @if($hotel->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$hotel->photo))
                                                <img width="230" height="160"
                                                     class="lazy" src="{{url("files/small/$hotel->photo")}}"
                                                     alt="{{$hotel->name}}">
                                            @else
                                                <img width="230" height="160"
                                                     class="lazy" src="https://placehold.it/230x160"
                                                     alt="">
                                            @endif
                                        </a>
                                    </figure>
                                    <div class="details col-xs-12 col-sm-8 col-md-9">
                                        <div>
                                            <div>
                                                <div class="box-title">
                                                    <h4 class="title">{!! Html::link("/hotels/$hotel->id/".str_slug($hotel->{"name:en"}),$hotel->name) !!}</h4>
                                                </div>
                                                {{--<div class="amenities">
                                                    @foreach($hotel->services as $service)
                                                        <i class="{{$service->icon_class}} {{strpos('fa-',$service->icon_class)!==false ?"fa":""}} circle"
                                                           data-toggle="tooltip"
                                                           title="{{$service->name}}"></i>
                                                    @endforeach
                                                </div>--}}
                                            </div>
                                            @if($hotel->price)
                                                <div class="price-section">
                                                    <span class="price"><small>PER/NIGHT</small>{{$hotel->price}}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            {!! str_limit(strip_tags($hotel->description),200) !!}
                                            <div class="action-section">
                                                <a href="{{url("booking/hotel/$hotel->id/".str_slug($hotel->{"name:en"}))}}?rel=book_now"
                                                   title=""
                                                   class="button btn-small text-center">{{trans("hotels.btn_book_now")}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                @if((int)Settings::get('country_hotels_count') <= $loop->iteration)
                                    @php break @endphp
                                @endif

                            @endforeach
                        </div>
                        <a href="{{url("city/$city->id/".str_slug($city->{"name:en"})."/hotels")}}"
                           class="button full-width  btn-large">{{trans("hotels.btn_show_more_hotels")}}</a>
                    </div>
                @endif
                @if($places->count() && (int)Settings::get('country_places_count'))
                    <div class="tab-pane fade" id="city-places">
                        <div class="cruise-list row image-box listing-style2 add-clearfix">
                            @foreach($places as $place)
                                <div class="col-sms-6 col-sm-6 col-md-4">
                                    <article class="box">
                                        <figure>
                                            <a href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}"
                                               class="hover-effect {{--popup-gallery--}}">
                                                @if($place->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$place->photo))
                                                    <img class="lazy"
                                                         src="{{url("files/$place->photo?size=270,160&encode=jpg")}}"
                                                         alt="{{$place->name}}"
                                                         width="270"
                                                         height="160"/></a>
                                            @else
                                                <img class="lazy" src="https://placehold.it/270x160" alt="" width="270"
                                                     height="160"/></a>
                                            @endif
                                        </figure>
                                        <div class="details">
                                            <a href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}"
                                               class="pull-right button btn-mini uppercase">{{trans("places.btn_show")}}</a>
                                            <h4 class="box-title">{{$place->name}}</h4>

                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{url("/city/$city->id/".str_slug($city->{"name:en"})."/places")}}"
                           class="uppercase full-width button btn-large">{{trans("countries.btn_load_more_places")}}</a>
                    </div>
                @endif
                @if($city->generalCategories()->count())
                    @foreach($city->generalCategories as $item)
                        <div class="tab-pane fade" id="city-guide-{{$loop->index}}">
                            @if($item->articles()->count())
                                @foreach($item->articles as $topic)
                                    <div class="col-sms-6 col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="{{url("guide/$item->id/topic/{$topic->id}/".str_slug($topic->{"name:en"}))}}"
                                                   class="hover-effect {{--popup-gallery--}}">
                                                    @if($topic->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$topic->photo))
                                                        <img class="lazy img-responsive"
                                                             src="{{url("files/$topic->photo?size=270,160&encode=jpg")}}"
                                                             alt="{{$topic->name}}"
                                                             width="270"
                                                             height="160"/></a>
                                                @else
                                                    <img class="lazy img-responsive" src="https://placehold.it/270x160"
                                                         alt=""
                                                         width="270"
                                                         height="160"/></a>
                                                @endif
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title"><a
                                                            href="{{url("guide/$item->id/topic/{$topic->id}/".str_slug($topic->{"name:en"}))}}">{{$topic->name}}</a>
                                                </h4>

                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
    <div class="sidebar col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
            <div class="addthis_inline_share_toolbox"></div> @endif
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
        @if($cities->count())
            <div class="travelo-box">
                <h4>{{trans("countries.country_cities_title",['country'=>$city->country->name])}}</h4>
                <div class="image-box style14">
                    @foreach($cities as $item)
                        <article class="box">
                            <figure>

                                <a href="{{url("city/$item->id/".str_slug($item->{"name:en"}))}}">
                                    @if(isset($item->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$item->photo))
                                        <img class="lazy img-responsive"
                                             src="{{url("files/{$item->photo}?size=63,42&encode=jpg")}}"
                                             alt="{{$item->name}}"/></a>
                                @endif
                            </figure>
                            <div class="details">
                                <h5 class="box-title"><a
                                            href="{{url("city/$item->id/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                </h5>
                            </div>
                        </article>
                        @if($loop->iteration >6)
                            @php break @endphp
                        @endif
                    @endforeach
                    <a href="{{url("country/{$city->country->id}/".str_slug($city->country->{"name:en"})."/cities")}}"
                       class="button btn-small full-width">{{trans("cities.load_more_cities")}}</a>
                </div>
            </div>
        @endif
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
                    zoom: 8,
                    center: {lat: -34.397, lng: 150.644}
                });
                        @if($city->map)
                var latlngString = "{{$city->map}}".split(",");
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
                var address = "{{$city->name}}";
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