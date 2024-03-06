@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.destination_page_title",['name'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("countries.destination_page_title",['name'=>$country->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="col-md-9">

        <div class="tab-container style1" id="hotel-main-content">
            <ul class="tabs">
                @if($country->gallery()->count())
                    <li class="active"><a data-toggle="tab"
                                          data-target="#photos-tab" href="#">{{trans('main.tab_photos')}}</a>
                    </li>
                @endif
                {{--@if($country->map)--}}
                <li class=""><a data-toggle="tab" id="show-map"
                                data-target="#map-tab" href="#">{{trans('main.tab_map')}}</a>
                </li>
                {{-- @endif--}}
                @if($country->embed_video)
                    <li class=""><a data-toggle="tab"
                                    data-target="#video-tab" href="#">{{trans('countries.tab_video')}}</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                @if($country->gallery()->count())
                    <div id="photos-tab" class="tab-pane fade in active">
                        <div class="photo-gallery style1" data-animation="slide"
                             data-sync="#photos-tab .image-carousel">
                            <ul class="slides">
                                @foreach($country->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".$photo->name))
                                        <li><img class="img-responsive lazy"
                                                 src="{{url("/files/{$photo->name}?size=870,489&encode=jpg")}}"
                                                 style="width: 100%;"
                                                 alt="{{$country->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70"
                             data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                            <ul class="slides">
                                @foreach($country->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".config("settings.thumbnails_dir")."/".$photo->name))
                                        <li><img class="lazy img-responsive"
                                                 src="{{url("/files/{$photo->name}?size=93,70&encode=jpg")}}"
                                                 alt="{{$country->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                {{-- @if($country->map)--}}
                <div id="map-tab" class="tab-pane">
                    <div id="map-container" style="width: 100%;height: 489px;"></div>
                </div>
                {{--@endif--}}
                @if($country->embed_video)
                    <div id="video-tab" class="tab-pane fade">
                        <div class='embed-container'>
                            {!! $country->embed_video !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div id="hotel-features" class="tab-container">
            @php
                $faq=$country->faq()->get();
            @endphp
            <ul class="tabs">
                <li class="active">
                    <a href="#" data-target="#country-description"
                       data-toggle="tab">{{trans("countries.tab_description")}}</a>
                </li>
                @if($country->notels)
                    <li class="active">
                        <a href="#" data-target="#country-notes"
                           data-toggle="tab">{{trans("countries.tab_notes")}}</a>
                    </li>
                @endif

                @if($country->hotels->count() && (int)Settings::get('country_hotels_count'))

                    <li><a href="#" data-target="#country-hotels"
                           data-toggle="tab">{{trans("countries.tab_hotels")}}</a>
                    </li>
                @endif
                @if($country->places->count() && (int)Settings::get('country_places_count'))
                    <li><a href="#" data-target="#country-places"
                           data-toggle="tab">{{trans("countries.tab_places")}}</a></li>
                @endif
                @if($country->packages->count() && (int)Settings::get('country_packages_count'))
                    <li><a href="#" data-target="#country-packages"
                           data-toggle="tab">{{trans("countries.tab_packages")}}</a></li>
                @endif
                @if($faq->count())

                    <li><a href="#" data-target="#tab-faq" data-toggle="tab">{{trans("hotels.tab_faq")}}</a></li>
                @endif

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="country-description">
                    <div class="long-description">
                        {!! $country->description !!}
                    </div>
                    <div class="clearfix"></div>
                    @if($country->tabs()->count())
                        <div class="large-block image-box style6">
                            @php
                                $right=true;
                            @endphp
                            @foreach($country->tabs as $tab)

                                <article class="box">
                                    <figure class="@if($right) col-md-5 pull-right middle-block @else col-md-5 @endif">
                                        @if($tab->photo)
                                            <a href="#" title="" class=" middle-block">
                                                <img class="img-thumbnail middle-item lazy img-responsive"
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
                @if($country->notes)
                    <div class="tab-pane fade" id="country-notes">
                        {!! $country->notes !!}
                    </div>
                @endif

                @if($country->hotels()->count() && (int)Settings::get('country_hotels_count'))
                    <div class="tab-pane fade" id="country-hotels">
                        <div class="room-list listing-style3 hotel">

                            @foreach($country->hotels as $hotel)
                                <article class="box">
                                    <figure class="col-sm-4 col-md-3">
                                        <a class="hover-effect"
                                           href="{{url("/hotels/{$hotel->id}/".str_slug($hotel->{"name:en"}))}}"
                                           title="">
                                            @if($hotel->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$hotel->photo))
                                                <img width="230" height="160"
                                                     class="lazy img-responsive" src="{{url("files/small/$hotel->photo")}}"
                                                     alt="{{$hotel->name}}">
                                            @else
                                                <img width="230" height="160"
                                                     class="lazy img-responsive" src="https://placehold.it/230x160"
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
                                                    <span class="price"><small>{{trans("hotels.price_per_night")}}</small>
                                                        {{((int)Settings::get('currency_on_right ')==1?"":Settings::get("{$locale}_currency"))}}
                                                        {{$hotel->offer_price?:$hotel->price}}
                                                        {{((int)Settings::get('currency_on_right ')==1?Settings::get("{$locale}_currency"):"")}}
                                                    </span>
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
                        <a href="{{url("country/$country->id/".str_slug($country->{"name:en"})."/hotels")}}"
                           class="button full-width  btn-large">{{trans("hotels.btn_show_more_hotels")}}</a>
                    </div>
                @endif
                @if($country->places->count() && (int)Settings::get('country_places_count'))
                    <div class="tab-pane fade" id="country-places">
                        <div class="cruise-list row image-box listing-style2 add-clearfix">
                            @foreach($country->places as $place)
                                <div class="col-sms-6 col-sm-6 col-md-4">
                                    <article class="box">
                                        <figure>
                                            <a href="#" data-url="{{url("places/ajax/$place->id/gallery")}}"
                                               class="hover-effect popup-gallery">
                                                @if($place->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$place->photo))
                                                    <img class="lazy img-responsive"
                                                         src="{{url("files/$place->photo?size=270,160&encode=jpg")}}"
                                                         alt="" width="270"
                                                         height="160"/></a>
                                            @else
                                                <img class="lazy img-responsive" src="https://placehold.it/270x160" alt=""
                                                     width="270"
                                                     height="160"/></a>
                                            @endif
                                        </figure>
                                        <div class="details">
                                            <a href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}"
                                               class="pull-right button btn-mini uppercase">{{trans("places.btn_show")}}</a>
                                            <h4 class="box-title"><a
                                                        href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}">{{$place->name}}</a>
                                            </h4>

                                        </div>
                                    </article>
                                </div>
                                @if((int)Settings::get('country_places_count') <= $loop->iteration)
                                    @php break @endphp
                                @endif
                            @endforeach
                        </div>
                        <a href="{{url("/country/$country->id/".str_slug($country->{"name:en"})."/places")}}"
                           class="uppercase full-width button btn-large">{{trans("countries.btn_load_more_places")}}</a>
                    </div>
                @endif

                @if($country->packages->count() && (int)Settings::get('country_packages_count'))
                    <div class="tab-pane fade" id="country-packages">
                        <div class="cruise-list row image-box listing-style2 add-clearfix">
                            @foreach($country->packages as $package)
                                <div class="col-sms-6 col-sm-6 col-md-4">
                                    <article class="box">
                                        <figure>
                                            <a href="#" data-url="{{url("packages/ajax/$package->id/gallery")}}"
                                               class="hover-effect popup-gallery">
                                                @if($package->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$package->photo))
                                                    <img class="lazy img-responsive"
                                                         src="{{url("files/$package->photo?size=270,160&encode=jpg")}}"
                                                         alt="" width="270"
                                                         height="160"/></a>
                                            @else
                                                <img class="lazy img-responsive" src="https://placehold.it/270x160" alt=""
                                                     width="270"
                                                     height="160"/></a>
                                            @endif
                                        </figure>
                                        <div class="details">
                                            <a href="{{url("packages/$package->id/".str_slug($package->{"name:en"}))}}"
                                               class="pull-right button btn-mini uppercase">{{trans("packages.btn_show")}}</a>
                                            <h4 class="box-title"><a
                                                        href="{{url("packages/$package->id/".str_slug($package->{"name:en"}))}}">{{$package->name}}</a>
                                            </h4>

                                        </div>
                                    </article>
                                </div>
                                @if((int)Settings::get('country_packages_count') <= $loop->iteration)
                                    @php break @endphp
                                @endif
                            @endforeach
                        </div>
                        <a href="{{url("/country/$country->id/".str_slug($country->{"name:en"})."/packages")}}"
                           class="uppercase full-width button btn-large">{{trans("countries.btn_load_more_packages")}}</a>
                    </div>
                @endif
                @if($faq->count())
                    <div class="tab-pane fade" id="tab-faq">
                        <div class="travelo-box question-list">
                            <div class="toggle-container">
                                @foreach($faq as $faqCategory)
                                    @foreach($faqCategory->questions as $q)
                                        <div class="panel style1">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#question{{$loop->index}}"
                                                   aria-expanded="{{ $loop->index==0?"true":"false" }}"
                                                   class="collapsed">{{$q->question}}</a>
                                            </h4>
                                            <div id="question{{$loop->index}}"
                                                 class="panel-collapse collapse {{ $loop->index==0?"in":"" }}">
                                                <div class="panel-content">
                                                    {!! $q->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <div class="sidebar col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
            <div class="addthis_inline_share_toolbox"></div> @endif
        @if($country->cities->count())
            <div class="travelo-box">
                <h4>{{trans("countries.country_cities_title",['country'=>$country->name])}}</h4>
                <div class="image-box style14">
                    @foreach($country->cities as $city)
                        <article class="box">
                            <figure>

                                <a href="{{url("city/$city->id/".str_slug($city->{"name:en"}))}}">
                                    @if(isset($city->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$city->photo))
                                        <img class="lazy img-responsive"
                                             src="{{url("files/{$city->photo}?size=63,42&encode=jpg")}}"
                                             alt="{{$city->name}}"/></a>
                                @endif
                            </figure>
                            <div class="details">
                                <h5 class="box-title"><a
                                            href="{{url("city/$city->id/".str_slug($city->{"name:en"}))}}">{{$city->name}}</a>
                                </h5>
                            </div>
                        </article>
                        @if($loop->iteration >6)
                            @php break @endphp
                        @endif
                    @endforeach
                    <a href="{{url("country/{$country->id}/".str_slug($country->{"name:en"})."/cities")}}"
                       class="button btn-small full-width">{{trans("cities.load_more_cities")}}</a>
                </div>
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
                    @endforeach

                </ul>
            </div>
        @endif
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
                        @if($country->map)
                var latlngString = "{{$country->map}}".split(",");
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
                var address = "{{$country->name}}";
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