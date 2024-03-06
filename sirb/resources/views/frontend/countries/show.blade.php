@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL(route("country.details",[$country->id,make_slug($country->name)]),$localeCode)}}"/>
        @endif
    @endforeach

@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.destination_page_title",['name'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("countries.destination_page_title",['name'=>$country->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-md-9">
            @if($errors->count())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if($alert_type=Session::get("alert-type"))
                <div class="alert alert-{{$alert_type=="success"?"success":"danger"}}">
                    <p>{{Session::get("message")}}</p>
                </div>
            @endif

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

                    @if($country->hotels->count() && (int)settings('country_hotels_count'))

                        <li><a href="#" data-target="#country-hotels"
                               data-toggle="tab">{{trans("countries.tab_hotels")}}</a>
                        </li>
                    @endif
                    @if($country->places->count() && (int)settings('country_places_count'))
                        <li><a href="#" data-target="#country-places"
                               data-toggle="tab">{{trans("countries.tab_places")}}</a></li>
                    @endif
                    @if($country->packages->count() && (int)settings('country_packages_count'))
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


                    @if($country->cities()->count() && (int) settings('country_hotels_count'))
                        <div class="tab-pane fade" id="country-hotels">
                            <div class="cruise-list row image-box listing-style2 add-clearfix">

                                @foreach($country->cities()->has('hotels')->get() as $hotel)
                                    <div class="col-sms-6 col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="{{\LaravelLocalization::localizeURL("city/$hotel->id/".make_slug($hotel->name)."/hotels")}}"
                                                   class="hover-effect">
                                                    @if($hotel->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$hotel->photo))
                                                        <img class="lazy img-responsive"
                                                             src="{{url("files/$hotel->photo?size=270,160&encode=jpg")}}"
                                                             alt="{{$hotel->name}}" width="270"
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
                                                            href="{{\LaravelLocalization::localizeURL("city/$hotel->id/".make_slug($hotel->name)."/hotels")}}">{{trans("cities.title_hotels_in_city",['city'=>$hotel->name])}}</a>
                                                </h4>

                                            </div>
                                        </article>
                                    </div>
                                    @if((int)settings('country_hotels_count') <= $loop->iteration)
                                        @php break @endphp
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{\LaravelLocalization::localizeURL("country/$country->id/".make_slug($country->name)."/hotels")}}"
                               class="button full-width  btn-large">{{trans("hotels.btn_show_more_hotels")}}</a>
                        </div>
                    @endif
                    @if($country->places->count() && (int) settings('country_places_count'))
                        <div class="tab-pane fade" id="country-places">
                            <div class="cruise-list row image-box listing-style2 add-clearfix">
                                @foreach($country->cities()->has('places')->get() as $place)
                                    <div class="col-sms-6 col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="{{\LaravelLocalization::localizeURL("city/$place->id/".make_slug($place->name)."/places")}}"
                                                   class="hover-effect">
                                                    @if($place->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$place->photo))
                                                        <img class="lazy img-responsive"
                                                             src="{{url("files/$place->photo?size=270,160&encode=jpg")}}"
                                                             alt="{{$place->name}}" width="270"
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
                                                            href="{{\LaravelLocalization::localizeURL("city/$place->id/".make_slug($place->name)."/places")}}">{{trans("cities.title_places_in_city",['city'=>$place->name])}}</a>
                                                </h4>

                                            </div>
                                        </article>
                                    </div>

                                    @if($loop->iteration >=(int)settings('country_places_count') )
                                        @php break @endphp
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{\LaravelLocalization::localizeURL("/country/$country->id/".make_slug($country->name)."/places")}}"
                               class="uppercase full-width button btn-large">{{trans("countries.btn_load_more_places")}}</a>
                        </div>
                    @endif

                    @if($country->packages->count() && (int) settings('country_packages_count'))
                        <div class="tab-pane fade" id="country-packages">
                            <div class="cruise-list row image-box listing-style2 add-clearfix">
                                @foreach($country->packages as $package)
                                    <div class="col-sms-6 col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="#" rel="nofollow"
                                                   data-url="{{\LaravelLocalization::localizeURL("packages/ajax/$package->id/gallery")}}"
                                                   class="hover-effect popup-gallery">
                                                    @if($package->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$package->photo))
                                                        <img class="lazy img-responsive"
                                                             src="{{url("files/$package->photo?size=270,160&encode=jpg")}}"
                                                             alt="{{$package->name}}" width="270"
                                                             height="160"/></a>
                                                @else
                                                    <img class="lazy img-responsive" src="https://placehold.it/270x160"
                                                         alt=""
                                                         width="270"
                                                         height="160"/></a>
                                                @endif
                                            </figure>
                                            <div class="details">
                                                <a href="{{\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name))}}"
                                                   class="pull-right button btn-mini uppercase">{{trans("packages.btn_show")}}</a>
                                                <h4 class="box-title"><a
                                                            href="{{\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name))}}">{{$package->name}}</a>
                                                </h4>

                                            </div>
                                        </article>
                                    </div>
                                    @if((int)settings('country_packages_count') <= $loop->iteration)
                                        @php break @endphp
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{\LaravelLocalization::localizeURL("/country/$country->id/".make_slug($country->name)."/packages")}}"
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


            <!-- Comments $ reviews-->
            @include('frontend.parts.comments_reviews', ['module' => "countries", 'module_data'=>$country])


        </div>
        <div class="sidebar col-md-3">
            @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
            @if($country->cities->count())
                <div class="travelo-box">
                    <h4>{{trans("countries.country_cities_title",['country'=>$country->name])}}</h4>
                    <div class="image-box style14">
                        @foreach($country->cities as $city)
                            <article class="box">
                                <figure>

                                    <a href="{{route("city.details",[$city->id,make_slug($city->name)])}}">
                                        @if(isset($city->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$city->photo))
                                            <img class="lazy img-responsive"
                                                 src="{{url("files/{$city->photo}?size=63,42&encode=jpg")}}"
                                                 alt="{{$city->name}}"/></a>
                                    @endif
                                </figure>
                                <div class="details">
                                    <h5 class="box-title"><a
                                                href="{{route("city.details",[$city->id,make_slug($city->name)])}}">{{$city->name}}</a>
                                    </h5>
                                </div>
                            </article>
                            @if($loop->iteration >6)
                                @php break @endphp
                            @endif
                        @endforeach
                        <a href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name)."/cities")}}"
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
                                <a href="{{\LaravelLocalization::localizeURL("packages/type/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
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