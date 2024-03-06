@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{$data->name}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li><a href="{{url("/hotels")}}">{{trans("hotels.link_hotels")}}</a></li>
                <li class="active">{{$data->name}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")

    <div class="col-md-9">
        @if($data->gallery()->count())
            <div class="tab-container style1" id="hotel-main-content">
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab"
                                          href="#photos-tab">{{trans('main.tab_photos')}}</a>
                    </li>
                    <li><a data-toggle="tab" href="#"
                           data-target="#map-tab">{{trans('main.tab_map')}}</a>
                    </li>
                    @if($data->embed_video)
                        <li class=""><a data-toggle="tab"
                                        data-target="#video-tab" href="#">{{trans('countries.tab_video')}}</a>
                        </li>
                    @endif
                    {{--<li class="pull-right"><a class="button btn-small yellow-bg white-color"
                                              href="{{url("/booking/hotel/{$data->id}/".str_slug($data->name))}}">{{trans("hotels.btn_book_now")}}</a>
                    </li>--}}
                </ul>
                <div class="tab-content">
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
                        {{--<ul class="tabs">
                            <li class="pull-right"><a class="button btn-small yellow-bg white-color"
                                                      href="{{url("/booking/hotel/{$data->id}/".str_slug($data->name))}}">{{trans("hotels.btn_book_now")}}</a>
                            </li>
                        </ul>--}}
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70"
                             data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                            <ul class="slides">
                                @foreach($data->gallery as $photo)
                                    @if($photo->name && Storage::disk('public')->exists(config('settings.upload_dir')."/".config("settings.thumbnails_dir")."/".$photo->name))
                                        <li><img class="img-responsive lazy"
                                                 src="{{url("/files/{$photo->name}?size=93,70&encode=jpg")}}"
                                                 alt="{{$data->name}}"/>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div id="map-tab" class="tab-pane fade"></div>
                    @if($data->embed_video)
                        <div id="video-tab" class="tab-pane fade">
                            <div class="embed-container">
                                {!! $data->embed_video !!}
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        @endif
        <div id="hotel-features" class="tab-container">
            @php
                $faq=$data->faq()->get();
            @endphp
            <ul class="tabs">
                <li class="active">
                    <a href="#" data-target="#hotel-description" data-toggle="tab">
                        {{trans("main.tab_description")}}</a></li>
                @if($data->services->count())
                    <li><a href="#" data-target="#hotel-services" data-toggle="tab">
                            {{trans("hotels.tab_services")}}</a></li>
                @endif
                @if($data->rooms->count())

                    <li><a href="#" data-target="#hotel_rooms" data-toggle="tab">{{trans("hotels.tab_rooms")}}</a></li>
                @endif
                @if($faq->count())

                    <li><a href="#" data-target="#tab-faq" data-toggle="tab">{{trans("hotels.tab_faq")}}</a></li>
                @endif
                @if($data->notes)

                    <li><a href="#" data-target="#tab-notes" data-toggle="tab">{{trans("hotels.tab_notes")}}</a></li>
                @endif

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="hotel-description">
                    <div class="long-description" ng-cloak >
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
                                                <img class="img-responsive img-thumbnail middle-item lazy"
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
                @if($data->services->count())
                    <div class="tab-pane fade" id="hotel-services">
                        <ul class="amenities clearfix style2">
                            @foreach($data->services as $service)
                                <li class="col-md-4 col-sm-6">
                                    <div class="icon-box style2"><i
                                                class="{{$service->icon_class}} circle"></i> {{$service->name}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                @if($rooms->count())
                    <div class="tab-pane fade" id="hotel_rooms">
                        <div class="room-list listing-style3 hotel">

                            @foreach($rooms as $room)
                                <article class="box">
                                    <figure class="col-sm-4 col-md-3">
                                        <a class="hover-effect popup-gallery"
                                           href="javascript:;"
                                           data-url="{{url("/hotels/ajax/$data->id/rooms/$room->id/gallery")}}"
                                           data-view-slider-modal="{{url("/hotels/{$room->id}/".str_slug($room->name))}}"
                                           data-slider-modal-title="{{$data->name}}"
                                           title="{{$room->name}}">
                                            @if($room->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$room->photo))
                                                <img width="230" height="160"
                                                     class="img-responsive lazy"
                                                     src="{{url("files/$room->photo?size=208,156&encode=jpg")}}"
                                                     alt="{{$room->name}}">

                                            @else
                                                <img width="230" height="160"
                                                     class="img-responsive lazy" src="https://placehold.it/230x160"
                                                     alt="">
                                            @endif
                                        </a>
                                        <a class="popup-gallery btn btn-primary"
                                           href="javascript:;"
                                           data-url="{{url("/hotels/ajax/$data->id/rooms/$room->id/gallery")}}"
                                           data-view-slider-modal="{{url("/hotels/{$room->id}/".str_slug($room->name))}}"
                                           data-slider-modal-title="{{$data->name}}"
                                           title="{{$room->name}}"
                                        >{{trans("hotels.btn_show_image_slider")}}</a>
                                    </figure>
                                    <div class="details col-xs-12 col-sm-8 col-md-9">
                                        <div>
                                            <div>
                                                <div class="box-title">
                                                    {{--                                                    <h4 class="title">{!! Html::link("/hotels/$room->id/".str_slug($room->name),$room->name) !!}</h4>--}}
                                                    <h4 class="title"><a href="#" modal>{{$room->name}}</a></h4>
                                                </div>
                                                <div class="amenities">
                                                    @foreach($room->services as $service)
                                                        <i class="{{$service->icon_class}} {{strpos('fa-',$service->icon_class)!==false ?"fa":""}} circle"
                                                           data-toggle="tooltip"
                                                           title="{{$service->name}}"></i>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @if($room->price)
                                                <div class="price-section">
                                                    <span class="price"><small>{{trans('hotels.price_per_night')}}</small>{{$room->price}}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            {!! $room->description !!}
                                            <div class="action-section">
                                                <a href="{{route('booking.room',['id'=>$room->id,'slug'=>str_slug($room->{"name:en"})])}}?rel=book_now"
                                                   title=""
                                                   class="button btn-small text-center">{{trans("hotels.btn_book_now")}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                            {!! $rooms->links() !!}
                        </div>
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

                @if($data->notes)
                    <div class="tab-pane fade" id="tab-notes">
                        <div class="long-description">
                            {!! $data->notes !!}
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
    <div class="sidebar col-md-3 ">
        <article class="detailed-logo">
            <figure>
                @if($data->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$data->photo))
                    <img class="img-responsive lazy" src="{{url("files/$data->photo?size=200,150&encode=jpg")}}"
                         alt="{{$data->name}}">
                @endif
            </figure>
            <div class="details">
                <h2 class="box-title">{{$data->name}}
                    @if($data->address)
                        <small><i class="soap-icon-departure yellow-color"></i>
                            <span class="fourty-space">{{$data->address}}</span>
                        </small>
                    @endif
                </h2>
                <span class="price clearfix">
                                    <small class="pull-left">{{trans("hotels.price_avg_night")}}</small>
                                    <span class="pull-right">${{$data->price}}</span>
                                </span>
                <div class="feedback clearfix">
                    <div title="{{trans_choice("hotels.hotel_stars_option",$data->stars)}}" class="five-stars-container"
                         data-toggle="tooltip" data-placement="bottom">
                        <span class="five-stars" style="width: {{$data->stars*20}}%;"></span></div>

                </div>

            </div>
            @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
        </article>

        @php
            $city=$data->city;

        @endphp
        <div class="travelo-box">
            <h4>{{trans("hotels.city_hotels_title",['city'=>$city->name])}}</h4>
            <div class="image-box style14">
                @foreach($related->get() as $hotel)
                    <article class="box">
                        <figure>

                            <a href="{{url("hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}">
                                @if(isset($hotel->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$hotel->photo))
                                    <img class="img-responsive lazy"
                                         src="{{url("files/{$hotel->photo}?size=63,47&encode=jpg")}}"
                                         alt="{{$hotel->name}}"/></a>
                            @endif
                        </figure>
                        <div class="details">
                            <h5 class="box-title"><a
                                        href="{{url("hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}">{{$hotel->name}}</a>
                            </h5>
                        </div>
                    </article>
                    @if($loop->iteration >5)
                        @php break @endphp
                    @endif
                @endforeach
                <a href="{{url("city/{$city->id}/".str_slug($city->{"name:en"})."/hotels")}}"
                   class="button btn-small full-width">{{trans("cities.load_more_cities")}}</a>
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
                var geocoder = new google.maps.Geocoder();
                geocodeAddress(geocoder, map);
                @endif
            }

            function geocodeAddress(geocoder, resultsMap) {
                var address = "{{$data->map}}";
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