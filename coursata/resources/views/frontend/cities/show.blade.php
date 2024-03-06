@extends('frontend.layouts.master')

@section("content")
    <!-- End section -->
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li><a href="/cities">{{trans("cities.link_cities")}}</a></li>
                    <li>{{$city->name}}</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="collapse row" id="collapseMap">
            <div id="map" class="map"></div>
        </div><!-- End Map -->

        <div class="container margin_60">

            <div class="row">
                <aside class="col-lg-4 col-md-4" id="sidebar" style="z-index:999">
        <p class="hidden-sm hidden-xs">
            <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
        </p>
        <div class="theiaStickySidebar">
        <div class="box_style_1 expose" id="booking_box">
            <h3 class="inner">{!! trans("cities.label_city",['city'=>$city->name]) !!} </h3>
            <div class="row">
                            <div class="">
                                @if($city->photo)
                                <img class="img-thumbnail img-responsive center-block" height="200"  width="250" 
                                     src="{{url("/files/$city->photo")}}"
                                     alt="{{$city->name}}">

                                     @else

                                 <img class="img-thumbnail img-responsive center-block" height="200"  width="250"
                                     src="/images/no_image.png"
                                     alt="{{$city->name}}">

                                     @endif

                             
                                <table class="table table_summary">
                                    <tbody>
                                         <tr>
                                        <td>
                                           
                                        </td>
                        
                                    </tr>
                                    <tr>
                                        <td>
                                            {{trans("institutes.label_country")}}
                                        </td>
                                        <td class="text-left">
                                            {{$city->country->name}}
                                        </td>
                                    </tr>
                                   
                                  
                                 
                                    </tbody>
                                </table>
                            </div><!--/box_style_1 -->
                        </div><!--/sticky -->
        </div><!--/box_style_1 -->
      </div><!--/end sticky -->
        </aside>
                <!--End aside -->

                <div class="col-lg-8 col-md-8">
               @if($city->gallery()->count())

                            <div id="Img_carousel" class="slider-pro">

                                <div class="sp-slides">
                                    @foreach($city->gallery as $photo)
                                        <div class="sp-slide">
                                    <img alt="Image" class="sp-image" src="/images/blank.gif"
                                        data-src="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-src="{{url("files/{$photo->name}?size=500,333")}}"
                                         data-small="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-medium="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-large="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-retina="{{url("files/{$photo->name}?size=1000,667")}}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="sp-thumbnails">
                                    @foreach($city->gallery as $photo)
                                        <img alt="Image" class="sp-thumbnail"
                                             src="{{url("files/{$photo->name}?size=166,104&encode=jpg")}}">
                                    @endforeach
                                </div>
                            </div>

                            <br>
                            <hr>
                        @endif
                        <div class="row">

                    <div class="col-md-12">
                       
                        <p>{!! $city->description !!}</p>
                        <hr>

                    </div>
                </div><!-- End row  -->

                <div id="tools">
                        <div class="row" style="margin: 0px 10px 0px 10px">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3><strong>{{trans('countries.city_institute_title', ['name' => $city->name])}}</strong></h3>
                            </div>

                        </div>
                    </div>

                  {{--   <div id="tools">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <h3 class="sorted">الترتيب حسب</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="styled-select-filters">
                                    <select name="sort_rating" id="sort_rating">
                                        <option value="" selected>Sort by ranking</option>
                                        <option value="lower">Lowest ranking</option>
                                        <option value="higher">Highest ranking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="text-center cpmarebtn">
                                    <a href="#" class="btn_1 medium">مقارنة</a>
                                </p>
                            </div>

                        </div>
                    </div> --}}
                    <!--/tools -->
                    @if($institutes->count())
                        @foreach($institutes as $institute)
                            <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                    @if($institute->featured)
                         <div class="ribbon_3"><span>{{trans("courses.featured_word")}}</span></div>
                                @endif
                    <div class="tour_container">
                        <div class="img_container">
                             <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}">
                                        <img src="{{url("files/{$institute->photo}?size=358,239&encode=jpg")}}"
                                             class="img-responsive" alt="{{$institute->name}}">

                                    </a>
                        </div>
                        <div class="tour_title">
                            <span>
                                        <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}"><strong>{{$institute->name}}</strong></a>
                                    </span>
                                     <div class="rating" data-toggle="tooltip"
                                         title="{{trans("courses.text_locale_rating")}}">
                                        <i class="{{$institute->locale_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->locale_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->locale_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->locale_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->locale_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                                        <small>({{trans("courses.text_locale_rating")}})</small>
                                    </div>
                                    <div class="rating" data-toggle="tooltip"
                                         title="{{trans("courses.text_international_rating")}}">
                                        <i class="{{$institute->international_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->international_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->international_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->international_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$institute->international_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                                        <small>({{trans("courses.text_international_rating")}})</small>
                                    </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                    @endforeach
                @endif

                <!--End strip -->
                    <hr>

                    <div class="text-center">
                        {!! $institutes->links() !!}
                    </div>
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>

@endsection
@section("styles")

<style type="text/css">
    .no-section header:not(.sticky) {
    background: rgb(82, 78, 78);
}

.no-section main {
    margin-top: 108px;
    position: inherit !important;
} 

</style>

    <!-- CSS -->
      <link href="/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/css/slider-pro.min.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
  
@stop
@section("scripts")
 <!-- Date and time pickers -->
    <script src="/assets/js/jquery.sliderPro.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('#Img_carousel').sliderPro({
                width: 960,
                height: 500,
                fade: true,
                arrows: true,
                buttons: false,
                fullScreen: false,
                smallSize: 500,
                startSlide: 0,
                mediumSize: 1000,
                largeSize: 3000,
                thumbnailArrows: true,
                autoplay: false
            });
        });
    </script>

    <script src="/assets/js/owl.carousel.min.js"></script>
<script>
        $(document).ready(function () {
            $(".carousel").owlCarousel({
                items: 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]
            });
        });
    </script>
   {{-- <script src="/assets/js/modernizr.js"></script>
    <script src="/assets/js/video_header.js"></script>
    <script>

        $(document).ready(function () {

            HeaderVideo.init({
                container: $('.header-video'),
                header: $('.header-video--media'),
                videoTrigger: $("#video-trigger"),
                autoPlayVideo: false
            });

        });
    </script>--}}

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA-pZGejiZpnxwuELxEB52gSv_t96kPgio"></script>

<script>
    
    $('#collapseMap').on('shown.bs.collapse', function(e){
    (function(A) {

    if (!Array.prototype.forEach)
        A.forEach = A.forEach || function(action, that) {
            for (var i = 0, l = this.length; i < l; i++)
                if (i in this)
                    action.call(that, this[i], i, this);
            };

        })(Array.prototype);

        var
        mapObject,
        markers = [],
        markersData = {
            'city': [
            {
                name: "{{$city->name}}",
                location_latitude: {{$city->map_lat}}, 
                location_longitude: {{$city->map_lng}},
                map_image_url: '{{url("files/{$city->photo}?size=280,140")}}',
                name_point: "{{$city->name}}",
                description_point: "{{str_limit(strip_tags($city->description),100)}}",
                get_directions_start_address: "{{$city->map_address}}",
                phone: "",
                url_point: "{{url("/city/{$city->id}-".str_slug($city->{"name:en"}))}}"
            }
            ],
            @if($institutes->count())
            

            'institutes': [
            @foreach($institutes as $institute)
            {

                name: "{{$institute->name}}",
                location_latitude: {{$institute->map_lat}}, 
                location_longitude: {{$institute->map_lng}},
                map_image_url: '{{url("files/{$institute->photo}?size=280,140")}}',
                name_point: "{{$institute->name}}",
                description_point: "{{str_limit(strip_tags($institute->description),100)}}",
                get_directions_start_address: "{{$institute->map_address}}",
                phone: "",
                url_point: "{{route('institute.details',['id'=>$institute->id,'slug'=>$institute->{'name:en'}])}}"
            }
            @endforeach
            ],

            
            @endif
        };


            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng({{$city->map_lat}}, {{$city->map_lng}}),
                mapTypeId: google.maps.MapTypeId.ROADMAP,

                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                    position: google.maps.ControlPosition.LEFT_CENTER
                },
                panControl: false,
                panControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE,
                    position: google.maps.ControlPosition.TOP_LEFT
                },
                scrollwheel: false,
                scaleControl: false,
                scaleControlOptions: {
                    position: google.maps.ControlPosition.TOP_LEFT
                },
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                styles: [
                             {
                    "featureType": "landscape",
                    "stylers": [
                        {
                            "hue": "#FFBB00"
                        },
                        {
                            "saturation": 43.400000000000006
                        },
                        {
                            "lightness": 37.599999999999994
                        },
                        {
                            "gamma": 1
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "stylers": [
                        {
                            "hue": "#FFC200"
                        },
                        {
                            "saturation": -61.8
                        },
                        {
                            "lightness": 45.599999999999994
                        },
                        {
                            "gamma": 1
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "stylers": [
                        {
                            "hue": "#FF0300"
                        },
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 51.19999999999999
                        },
                        {
                            "gamma": 1
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "stylers": [
                        {
                            "hue": "#FF0300"
                        },
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 52
                        },
                        {
                            "gamma": 1
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "stylers": [
                        {
                            "hue": "#0078FF"
                        },
                        {
                            "saturation": -13.200000000000003
                        },
                        {
                            "lightness": 2.4000000000000057
                        },
                        {
                            "gamma": 1
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                        {
                            "hue": "#00FF6A"
                        },
                        {
                            "saturation": -1.0989010989011234
                        },
                        {
                            "lightness": 11.200000000000017
                        },
                        {
                            "gamma": 1
                        }
                    ]
                }
                ]
            };
            var
            marker;
            mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
            for (var key in markersData)
                markersData[key].forEach(function (item) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                        map: mapObject,
                        icon: '/assets/img/pins/' + key + '.png',
                    });

                    if ('undefined' === typeof markers[key])
                        markers[key] = [];
                    markers[key].push(marker);
                    google.maps.event.addListener(marker, 'click', (function () {
      closeInfoBox();
      getInfoBox(item).open(mapObject, this);
      mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
     }));

    });
    
        function hideAllMarkers () {
            for (var key in markers)
                markers[key].forEach(function (marker) {
                    marker.setMap(null);
                });
        };

        function closeInfoBox() {
            $('div.infoBox').remove();
        };

        function getInfoBox(item) {
            return new InfoBox({
                content:
                '<div class="marker_info" id="marker_info">' +
                '<img src="' + item.map_image_url + '" alt="Image"/>' +
                '<h3>'+ item.name_point +'</h3>' +
                '<span>'+ item.description_point +'</span>' +
                '<div class="marker_tools">' +
                '<form action="http://maps.google.com/maps" method="get" target="_blank" style="display:inline-block""><input name="saddr" value="'+ item.get_directions_start_address +'" type="hidden"><input type="hidden" name="daddr" value="'+ item.location_latitude +',' +item.location_longitude +'"><button type="submit" value="Get directions" class="btn_infobox_get_directions">Directions</button></form>' +
                    '<a href="tel://'+ item.phone +'" class="btn_infobox_phone">'+ item.phone +'</a>' +
                    '</div>' +
                    '<a href="'+ item.url_point + '" class="btn_infobox">Details</a>' +
                '</div>',
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(10, 125),
                closeBoxMargin: '5px -20px 2px 2px',
                closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                isHidden: false,
                alignBottom: true,
                pane: 'floatPane',
                enableEventPropagation: true
            });


        };

    });
</script>

<script src="/assets/js/infobox.js"></script>

<!-- Fixed sidebar -->
<script src="/assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
@stop