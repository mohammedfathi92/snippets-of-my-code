@extends('frontend.layouts.master')
@section("content")

@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp

<main data-ng-controller="favoriteCtrl">

    <section class="single-page-header" style="background-image: url('{{url("/files/$institute->photo")}}'); background-repeat: no-repeat;
    background-size: 1400px 470px;">
        <div class="parallax-content-1 my-layer-img">
            <div class="logo_content">
                <div class="animated fadeInDown">

                    <h1>
                        <a class="title-header-link" href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}">{{$institute->name}}</a>
                    </h1>
                    <p>{!! str_limit(strip_tags($institute->description)) !!}</p>
                </div>
            </div>
        </div>

    </section><!-- End section -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="/">{{trans("main.link_home")}}</a></li>
                <li><a href="{{url("institutes")}}">{{trans("institutes.link_institutes")}}</a></li>
                <li>{{$institute->name}}</li>
            </ul>
        </div>
    </div><!-- End Position -->

    <div class="container margin_60">
        <div class="collapse row" id="collapseMap">
            <div id="map" class="map"></div>
        </div><!-- End Map -->
         
        <div class="row">
            
            <div class="col-md-8" id="single_tour_desc">

                @if($institute->gallery()->count())
                    <div id="Img_carousel" class="slider-pro">


                        <div class="sp-slides">
                             @if($institute->video_youtube)
                          <div class="sp-slide">
                                
                             
                                    @php
                                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $institute->video_youtube, $matches);
                                    @endphp
                                    @if(isset($matches[0]))
                                       
                                            <a href="{{$institute->video_youtube}}">
                                                <div class='embed-container'>
                                                    <iframe src="https://www.youtube.com/embed/{{$matches[0]}}?rel=0&amp;controls=0&amp;showinfo=0?ecver=1"
                                                            frameborder="0" allowfullscreen></iframe>
                                                </div>
                                            </a>
                                            

                                        
                                    @endif
                                    <br>
                               
                            </div>
                             @endif

                            @foreach($institute->gallery as $photo)
                                <div class="sp-slide">
                                    <img alt="{{$institute->name}}" class="sp-image"
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
                            @if($institute->video_youtube)
                             <img alt="Image" class="sp-thumbnail" src="/images/youtube-icon.png">
                             @endif

                            @foreach($institute->gallery as $photo)
                                <img alt="Image" class="sp-thumbnail" src="{{url("files/{$photo->name}?size=120,80")}}">

                            @endforeach
                           
                        </div>
                    </div>

                    <hr>
                @endif
               
                <div class="row">

                    <div class="col-md-12">
                        <h2>{{$institute->name}}</h2>
                        <p>{!! $institute->description !!}</p>


                    </div>
                </div><!-- End row  -->

               @if($institute->brochures)
                  <div class="row">

                    <div class="col-md-12 attached-row">
                        
                        <a href="{{route('institute.download.brochures', ['id' => $institute->id, 'file_name' => $institute->brochures])}}"><img src="/images/icons-download.png" width="20" height="20">   <strong>{{trans('institutes.download_brochures')}}</strong></a>
                        
                       


                    </div>
                  </div><!-- End row  -->
                 @endif
@if($city)
                  <div class=" city-row">
                    <div class="row">
                                 


                    <div class="col-md-8">
                        
                        <h3>{{$city->name}} - {{$city->country->name}}</h3>
                        <hr>
                        
                       <div class="">
                        {!! \Illuminate\Support\Str::words($city->description, 100,'... .')?: trans('main.description_not_found')  !!}
                       </div>
                       
                       

                    </div>
                    <div class="col-md-4">
                        @if($city->photo)
                       <img src="{{url("files/{$city->photo}?size=300,220&encode=jpg")}}" width="300" height="220" class= "img-responsive">
                        @else
                        <img src="/images/no_image.png" width="300" height="150" class= "img-responsive">
                         @endif
                       <center><a class="btn_full" target="_blank" href="{{url("/city/{$city->id}-".str_slug($city->{"name:en"}))}}"  style="margin-top: 5px" >{{trans('institutes.btn_view_city')}}</a></center>      

                    </div>
                    </div>
                  </div><!-- End row  -->
                
                 <hr>
                 @endif
                <!-- Courses List  -->
                <div class="row">

                    @if($courses->count())
                        <div class="col-lg-12 col-md-12" data-ng-init="getFavoritesCourses()">

                            {{-- <div id="tools">
                                 <div class="row">
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                         <div class="styled-select-filters">
                                             <select name="sort_price" id="sort_price">
                                                 <option value="" selected>Sort by price</option>
                                                 <option value="lower">Lowest price</option>
                                                 <option value="higher">Highest price</option>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-6">
                                         <div class="styled-select-filters">
                                             <select name="sort_rating" id="sort_rating">
                                                 <option value="" selected>Sort by ranking</option>
                                                 <option value="lower">Lowest ranking</option>
                                                 <option value="higher">Highest ranking</option>
                                             </select>
                                         </div>
                                     </div>


                                 </div>
                             </div><!--/tools -->
 --}}

     <h3 class="label-h3-title" style="background-color: #524e4e; color: #fff;  padding: 10px;  ">{{trans('institutes.title_institute_releated_course')}}</h3>



                            @foreach($courses as $course)

                   
                           <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        @if($course->featured)
                                                            <div class="ribbon_3 featured">
                                                                <span>{{trans("courses.featured")}}</span>
                                                            </div>
                                                        @endif 
 @if(Auth::check())                    
             <div class="my_wishlist" ng-if="favoritesCourses.indexOf({{$course->id}}) < 0" >
                                            <a class="tooltip_flip tooltip-effect-1"  href ng-click="favorite('courses', {{$course->id}})">+<span
                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                        </div>

                                        <div class="my_wishlist_remove" ng-if="favoritesCourses.indexOf({{$course->id}}) > -1" >
                                            <a class="tooltip_flip tooltip-effect-1"  href ng-click="unfavorite('courses', {{$course->id}})">-<span
                                                        class="tooltip-content-flip"><span
                                                            class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                                        </div>
@else
                                         <div class="my_wishlist" >
                                            <a class="tooltip_flip tooltip-effect-1"  href="#checkLoginModal" data-toggle="modal" >+<span
                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                            class="tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                        </div>

                                        @endif
                                                       
                                                        <div class="img_list"><a href="{{route("course.details",['id'=>$course->id,'slug'=>$course->{"name:en"}])}}">
                        <img src="{{url("files/{$course->photo}")}}" alt="{{$course->name}}">

                        @if($course->offer_price > 0)
                         <div class="badge_save">{{trans('main.icon_offer_save')}}<strong>
                                         {{ round(($course->offer_price / $course->price) * 100) }} %</strong></div>

                         @endif                

                          <div class="short_info">
                                            <div class="short_info_content">
                                           @if($institute->logo)
                                            <a href="javascript:void(0);" style="margin: 0px 5px 2px 5px;  z-index: 10;"  target="_blanck"><i> <img id="img_not_zoom" src="{{url("files/{$course->logo}?size=27,27")}}"
                                             width="27" height="27" class="logo-grid-circle"
                                             alt="{{$institute->name}}" style="height: 27px; width: 27px;"></i></a>

                                             @else
                                            <a href="javascript:void(0);" style="color: #fff; z-index: 10;"  target="_blanck">
                                                <i class="icon_set_1_icon-1"  style="font-size: 20px; border: solid #fff 1px; border-radius: 50%; padding: 4px 1px 1px 1px; z-index: 10; "></i>
                                            </a>
                                            @endif
                                             
                                            
                                             <strong>{{$institute->name}}</strong>
                                                
</div>
                                        </div>
                        </a>
                        </div>
                                                    </div>
                                                    <div class="clearfix visible-xs-block"></div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="tour_list_desc">
                                                          <h3>
                                                                <a href="{{route("course.details",['id'=>$course->id,'slug'=>$course->{"name:en"}])}}">{{$course->name}}</a> 
                                                            </h3>

                                                            <p>{{str_limit(strip_tags($course->description),500)}}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <div class="price_list">
                                                            @if($course->offer_price)
                                                            <div><sup style="font-size: 12px">{{$currencyCode}}</sup>{{round($currencyRate * $course->offer_price)}}<span
                                                                        class="normal_price_list">
                                        {{round($currencyRate *  $course->price)}}</span>
                                                                <small>*{{trans("courses.price_per_week")}}</small>
                                                                <p>
                                                                    <a href="{{route("course.details",['id'=>$course->id,'slug'=>$course->{"name:en"}])}}"
                                                                       class="btn_1">
                                                                           {{trans("courses.btn_read_more")}}
                                                                       </a>
                                                                </p>
                                                            </div>
@else
                                                             <div><sup style="font-size: 12px">{{$currencyCode}}</sup>{{round($currencyRate * $course->price)}}
                                 <small>*{{trans("courses.price_per_week")}}</small>
                                                       <p>
                                                                    <a href="{{route("course.details",['id'=>$course->id,'slug'=>$course->{"name:en"}])}}"
                                                                       class="btn_1">{{trans("courses.btn_read_more")}}</a>
                                                                </p>
                                                            </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        
                                                         <table>
                                                            <tbody class="course_featured">
                                                                
                                                            <tr><td><i class="icon-clock-5" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.label_hours")}}
                                                                : {{trans("courses.hours_count",['count'=>$course->hours])}}</td></tr>
                                                           <tr> <td> <i class="icon-book" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.label_lessons")}}
                                                                : {{trans("courses.lessons_count",['count'=>$course->num_lessons])}}</td></tr>
                                                           <tr> <td><i class="icon-user-add" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.details_min_age", ['year'=>$course->min_age])}}
                                                               </td></tr>


                                                         
                                                            </tbody>
                                                            </table>
                                                                
                                                    </div>

                                                    <div class="col-md-6">
                                                        <table>
                                                            <tbody class="course_featured">
                                                                
                                                            
                                                            <tr><td><i  class="icon-calendar" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.details_start_day")}}
                                                                : {{trans("courses.start_day_every",['day'=>trans("courses.week_days_options.{$course->start_day}")])}}
                                                            </td></tr>
                                                            </tr><td><i  class="icon-users-3" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.details_avg_students")}}
                                                                : {{trans("courses.students_count",['count'=>$course->avg_students])}}</td></tr>
                                                        </tbody>
                                                        </table>
                                                        
                                                    </div>

                                               
                                           
                                        </div>
                                        <br>
                    </div> <!--End strip -->
                           
                            @endforeach



                            <hr>

                            <div class="text-center">
                                {!! $courses->links() !!}
                            </div><!-- end pagination-->

                        </div><!-- End col lg-9 -->

                    @endif
                </div>



            </div><!--End  single_tour_desc-->



            <aside class="col-md-4" id="sidebar">
                        
                          <p class="hidden-sm hidden-xs">
            <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="{{trans('main.tab_hide_map')}}" data-text-original="{{trans('main.tab_view_map')}}">{{trans('main.tab_view_map')}}</a>
        </p>
                <div class="theiaStickySidebar" data-ng-init="getFavoritesInstitutes()">
                    <div class="box_style_1 expose" id="booking_box">
                        <h3 class="inner">- {{trans("institutes.title_about_institute")}} -</h3>
                        <div class="row">
                            <div class="">
                                @if($institute->logo)
                                <img class="img-circle img-thumbnail img-responsive center-block" style="width: 100px;height: 100px"
                                     src="{{url("/files/$institute->logo")}}"
                                     alt="{{$institute->name}}">

                                     @else
                                   <img class="img-circle img-thumbnail img-responsive center-block" style="width: 100px;height: 100px"
                                     src="{{url("/files/$institute->photo")}}"
                                     alt="{{$institute->name}}">
                                     
                                     @endif  


                             
                                <table class="table table_summary">
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{trans("institutes.label_address")}}
                                        </td>
                                        <td class="text-left">
                                            {{$institute->address}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{trans("institutes.label_country")}}
                                        </td>
                                        <td class="text-left">

                                            <a target="_blank" href="{{url("/countries/".$country->code."-".str_slug($country->{"name:en"})."/cities")}}">{{$institute->country->name}}</a>
                                            
                                        </td>
                                    </tr>
                                    @if($institute->city)
                                        <tr>
                                            <td>
                                                {{trans("institutes.label_city")}}
                                            </td>
                                            <td class="text-left">
                                                <a target="_blank" href="{{url("/countries/".$city->id."-".str_slug($city->{"name:en"}))}}">{{$institute->city->name}}</a>
                                                
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            {{trans("institutes.label_courses_num")}}
                                        </td>
                                        <td class="text-left">
                                            <strong>{{$institute->courses()->count()}}</strong>
                                            
      
                                            {{-- trans("institutes.courses_count",['count'=>$institute->courses()->count()]) --}}
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                                 @if (Auth::check())
                                <div ng-if="favoritesInstitutes.indexOf({{$institute->id}}) > -1"><a href ng-click="unfavorite('institutes', {{$institute->id}})" class="btn_full_outline">{!! trans("main.btn_remove_favorite") !!} <i class=" icon_heart"></i></a></div>

                                <div ng-if="favoritesInstitutes.indexOf({{$institute->id}}) < 0"><a href ng-click="favorite('institutes', {{$institute->id}})" class="btn_full_outline"> {!! trans("main.btn_add_favorite") !!} <i class=" icon_heart"></i></a></div>

                                @else

                                <div><a href="#checkLoginModal" data-toggle="modal" class="btn_full_outline"><i class=" icon_heart"></i> {!! trans("main.btn_add_favorite") !!} </a></div>

                                 @endif


                            </div><!--/box_style_1 -->
                        </div><!--/sticky -->
                   
                    </div>
                </div>
            </aside>
        </div><!--End row -->
    </div><!--End container -->
</main>

@stop
@section("styles")

<style type="text/css">

    .attached-row{
    border-radius: 20px;
    border: 1px solid #565a5c;
    padding: 10px; 
    width: auto;
    
        background-color: #FFFFFF;


    }
    .city-row{

    border: 1px solid #9b9a9a;
    background-color: #fff; 
    padding: 10px; 
    margin-top: 15px;
    margin-bottom: 15px;
    
     
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

    <!-- Date and time pickers -->
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

     <!-- Carousel -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-77kYo4BTGlTqBqMjdOQndoi-pQ9VFus"></script>
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
            'Single_institute': [
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
            ]
        };


            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng({{$institute->map_lat}}, {{$institute->map_lng}}),
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