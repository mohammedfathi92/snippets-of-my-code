@extends('frontend.layouts.master')
@section("content")

@php
$currency = Session::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{url('/')}}">{{trans('users.home_page')}}</a></li>
                <li>{{trans('users.my_favorites')}}</li>
            </ul>
        </div>
    </div><!-- End Position -->
    @if(Session::has("message"))
        @if(Session::get("alert-type")=="error")
            <div class="alert alert-danger">{!! Session::get("message") !!}</div>
        @endif

        @if(Session::get("alert-type")=="success")
            <div class="alert alert-success">{!! Session::get("message") !!}</div>
        @endif
    @endif
    <main data-ng-controller="favoriteCtrl">
        <div class="margin_60 container">
            <aside class="col-md-2" id="sidebar">
        <div class="theiaStickySidebar">
        <div class="box_style_cat">
           @include('frontend.users.side_menu')
            </div>
        </div><!--End sticky -->
        </aside>
        <div class="col-md-10 margin_60 container">
      <div id="tabs" class="tabs">
        <nav>
          <ul>
            <li><a href="#section-1" class="icon-booking"><span>{{trans('main.tab_favorite_courses')}}</span></a>
            </li>
            <li><a href="#section-2" class="icon-wishlist"><span>{{trans('main.tab_favorite_institutes')}}</span></a>
            </li>
          </ul>
        </nav>
        <div class="content">

          <section id="section-1" data-ng-init="getFavoritesCourses()">
            
         

           <!--  Content here -->
                      @if($courses->count())
            
                          
                   @foreach($courses as $course)

                   
                           <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s" ng-if="favoritesCourses.indexOf({{$course->id}}) > -1">

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
                                           @if($course->institute->logo)
                                            <a href="javascript:void(0);" style="margin: 0px 5px 2px 5px;  z-index: 10;"  target="_blanck"><i> <img id="img_not_zoom" src="{{url("files/{$course->institute->logo}?size=27,27")}}"
                                             width="27" height="27" class="logo-grid-circle"
                                             alt="{{$course->institute->name}}" style="height: 27px; width: 27px;"></i></a>

                                             @else
                                            <a href="javascript:void(0);" style="color: #fff; z-index: 10;"  target="_blanck">
                                                <i class="icon_set_1_icon-1"  style="font-size: 20px; border: solid #fff 1px; border-radius: 50%; padding: 4px 1px 1px 1px; z-index: 10; "></i>
                                            </a>
                                            @endif
                                             
                                            
                                             <strong>{{$course->institute->name}}</strong>
                                                
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
                   
                          
                @endif
                <!--End  Releated Courses-->

          </section>
          <!-- End section 1 -->

          <section id="section-2" data-ng-init="getFavoritesInstitutes()">
             @foreach($institutes as $institute)
            <div class="row">
                  <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s" ng-if="favoritesInstitutes.indexOf({{$institute->id}}) > -1">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                @if($institute->fetured)
                        <div class="ribbon_3"><span>{{trans("courses.featured_word")}}</span></div>
                    @endif
                               <div class="my_wishlist" ng-if="'{{Auth::check()}}' && favoritesInstitutes.indexOf({{$institute->id}}) < 0">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href href ng-click="favorite('institutes', {{$institute->id}})">+<span
                                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                                        </div>

                                                          <div class="my_wishlist_remove" ng-if="'{{Auth::check()}}' && favoritesInstitutes.indexOf({{$institute->id}}) > -1">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href href ng-click="unfavorite('institutes', {{$institute->id}})">-<span
                                                                        class="tooltip-content-flip"><span
                                                                            class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                                                        </div>

                                                        <div class="my_wishlist" ng-if="'{{Auth::check()}}' < 1">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href="#checkLoginModal" data-toggle="modal">+<span
                                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                                        </div>

                                                         <div class="my_logo">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href="{{route("institute.details",['slug'=>str_slug($institute->{"name:en"}),"id"=>$institute->id])}}">
                                                              <img id="img_not_zoom" class="logo-grid-circle" src="{{url("files/{$institute->logo}?size=293,220&encode=jpg")}}"
                                                     alt="{{$institute->name}}" width="45" height="45"></a>
                                                        </div>

                                <div class="img_list">
                                    <a href="{{route("institute.details",['slug'=>str_slug($institute->{"name:en"}),"id"=>$institute->id])}}"><img src="{{url("files/{$institute->photo}?size=293,220&encode=jpg")}}" alt="Image">
                                        <div class="short_info"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix visible-xs-block"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="tour_list_desc">
                                
                                    <h3>{!! Html::link(route('institute.details',['slug'=>str_slug($institute->{"name:en"}),'id'=>$institute->id]),$institute->name) !!}</h3>
                                    <p>{!! str_limit(strip_tags($institute->description),200) !!}</p>
                                    <div class="row">
                        <div class="rating col-md-6 col-sm-12" data-toggle="tooltip"
                             title="{{trans("institutes.text_locale_rating")}}">
                             <small>( {{trans("institutes.text_locale_rating")}} )</small>
                            
                            <i class="{{$institute->locale_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                        </div>
                        <div class="rating col-md-6 col-sm-12" data-toggle="tooltip"
                             title="{{trans("institutes.text_international_rating")}}">
                            <small>( {{trans("institutes.text_international_rating")}} )</small>
                            <i class="{{$institute->international_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                        </div>
                    </div>
                    @if($institute->services()->count())
                                    <ul class="add_info" style="margin-top: 10px;">
                            @php
                    $houses_count = $institute->services()->where('type','house')->count();

                    $transport_count = $institute->services()->where('type','transport')->count();

                    $insurance_count = $institute->services()->where('type','insurance')->count();

                    $books_count = $institute->services()->where('type','insurance')->count();

                            @endphp            
                            

                           @if($houses_count >= 1)            
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Housing"><i class="icon-home-outline"></i></a>
                                        </li>
                            @endif
                            @if($insurance_count >= 1)             
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Insurance"><i class="icon_set_1_icon-82"></i></a>
                                        </li>

                             @endif
                            @if($transport_count >= 1)             
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Trasnportation"><i class=" icon_set_1_icon-21"></i></a>
                                        </li>
                           @endif
                            @if($books_count >= 1)               
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="books"><i class="icon-book"></i></a>
                                        </li>
                                 @endif       
                                      
                                    </ul>
@endif
                        
                                </div>
                            </div>
                           
                        </div>

                    </div>
                    <!--End strip -->
                   

            </div>
             @endforeach
            <!-- End row -->
          </section>
          <!-- End section 2 -->


          </div>
          <!-- End content -->
        </div>
        <!-- End tabs -->
      </div>
      <!-- end container -->

        </div><!-- end container -->
    </main>



@stop

@section("styles")

    <!-- CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
    <style type="text/css">
        a .btn_3 {background-color: #e04f67; color: #fff;}
    </style>
    <style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    </style>
    
@stop

@section("scripts")

   
  
    <!-- Date and time pickers -->
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', '');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

 <!-- Fixed sidebar -->
<script src="/assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<!-- Cat nav mobile -->
<script  src="/assets/js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>

<!-- Specific scripts -->
  <script src="/assets/js/tabs.js"></script>
  <script>
    new CBPFWTabs(document.getElementById('tabs'));
  </script>
  


@stop