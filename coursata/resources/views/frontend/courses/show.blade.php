@extends('frontend.layouts.master')
@section("content")


@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp


    <div class="clearfix"></div>
    <!-- main content -->
    <main data-ng-controller="courseDetailsCtrl" data-ng-init="courseId='{{$course->id}}'">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("courses")}}">{{trans("courses.link_courses")}}</a></li>
                    <li>
                        <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}">{{$institute->name}}</a>
                    </li>
                    <li>{{$course->name}}</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->
        <!-- End Map -->
        <div class="container margin_60" data-ng-controller="favoriteCtrl"
             data-ng-init="courseId='{{$course->id}}'">
        <input type="hidden" value="{{$currencyRate}}" data-ng-init="changeCurrencyRate({{$currencyRate}})"/>
        <div data-ng-init="getFavoritesCourses()"></div>

            <div class="row">
                <div class="col-md-8" id="single_tour_desc">

                    <div class="row" data-ng-if="course">

                        <!-- Map button for tablets/mobiles -->

                        <!--Start Course details -->
                        @if($course->gallery()->count())

                            <div id="Img_carousel" class="slider-pro">

                                <div class="sp-slides">
                                    @foreach($course->gallery as $photo)
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
                                    @foreach($course->gallery as $photo)
                                        <img alt="Image" class="sp-thumbnail"
                                             src="{{url("files/{$photo->name}?size=166,104&encode=jpg")}}">
                                    @endforeach
                                </div>
                            </div>

                            <br>
                        @endif
                        <div class="course_details wow fadeIn" data-wow-delay="0.1s">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <div class="col-md-7">
                                            <h3><% course.name %></h3>
                                        <h4> 
                                          <a href="{{url("institutes/{$course->institute->id}-".str_slug($course->institute->{"name:en"}))}}">{{$course->institute->name}}</a> 
                                        </h4>


                                        </div>

                                        <div class="col-md-5">

                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <p ng-bind-html="course.description |html"></p>
                                    </div>


                                </div>
                            </div>
                            <hr>
                               <div class="row">
                                                    <div class="col-md-6">
                                                        
                                                         <table>
                                                            <tbody class="course_featured">
                                                                
                                                            <tr><td><i class="icon-clock-5" style="color: #88b60b; font-size: 18px;"></i> {{trans("courses.label_hours")}}
                                                                : {{trans("courses.hours_count",['count'=>$course->hours])}}</td></tr>
                                                           <tr> <td> <i class="icon-book" style="color: #88b60b; font-size: 18px;"></i> {{trans("courses.label_lessons")}}
                                                                : {{trans("courses.lessons_count",['count'=>$course->num_lessons])}}</td></tr>
                                                           <tr> <td><i class="icon-user-add" style="color: #88b60b; font-size: 18px;"></i> {{trans("courses.details_min_age", ['year'=>$course->min_age])}}
                                                               </td></tr>


                                                         
                                                            </tbody>
                                                            </table>
                                                                
                                                    </div>

                                                    <div class="col-md-6">
                                                        <table>
                                                            <tbody class="course_featured">
                                                                
                                                            
                                                            <tr><td><i  class="icon-calendar" style="color: #88b60b; font-size: 18px;"></i> {{trans("courses.details_start_day")}}
                                                                : {{trans("courses.start_day_every",['day'=>trans("courses.week_days_options.{$course->start_day}")])}}
                                                            </td></tr>
                                                            </tr><td><i  class="icon-users-3" style="color: #88b60b; font-size: 18px;"></i> {{trans("courses.details_avg_students")}}
                                                                : {{trans("courses.students_count",['count'=>$course->avg_students])}}</td></tr>
                                                        </tbody>
                                                        </table>
                                                        
                                                    </div>

                                               
                                           
                                        </div>
                                        <br>


                            <p class="all_course_price" ng-if="course.offer_price > 0"><span
                                        class="price_course_text">{{trans("courses.text_price")}}</span><span
                                        class="price_course"><% (currencyRate * course.offer_price).toFixed() %></span>
                                        <span class="price_course_currency">{{$currencyName}} </span>
                                <strike class="old_course_price">{{$currencyCode}} <% (currencyRate * course.price).toFixed() %></strike>
                                {{--<span class="price_course_currency">$</span>--}}
                            </p>

                            <p class="all_course_price" ng-if="course.offer_price < 0">
                                <span
                                        class="price_course_text">{{trans("courses.text_price")}}</span><span
                                        class="price_course"><% (currencyRate * course.price).toFixed() %></span>
                                        <span class="price_course_currency">{{$currencyName}} </span>
                                
                                {{--<span class="price_course_currency">$</span>--}}
                            </p>

                        </div>


                        <!-- End row  -->

                    </div>

                    <!-- Services Courses  -->
                    <!-- Housing -->
<br>
                <div class="row course_services_list wow fadeIn" data-ng-if="bookingData.housing=='y' && course.institute.housing_services.length">
                  <div class="col-md-12">
                  <h3>{{trans('courses.frontend_housing_title')}}</h3>
                  <div  class="panel-group" id="housing-accordion">
                  <div class="panel panel-default" data-ng-repeat="service in course.institute.housing_services track by service.id">

                    <div class="panel-heading" style="<% bookingData.housingType==service.id?'background-color:#449d44': 'background-color:#565a5c' %>">
                      <h4 class="panel-title">

                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#housing-accordion" href="#<%service.id%>-housing" style="color: #fff" > <i class=" icon-home-outline"></i>   <%service.name%></a>
                        
                      </h4>
                    </div>
                    <div id="<%service.id%>-housing" class="panel-collapse collapse" ng-class="{'panel-collapse collapse in':service.id==course.institute.housing_services[0].id,'panel-collapse collapse':service.id!=course.institute.housing_services[0].id}">
                      <div class="panel-body">
                        <div class="row" data-ng-if="service.description">
                          <center>

                             <p><%service.shortDescription%> </p>
                          </center>
                          
                          
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                                    <ul style="list-style-type:none">
                                                        <li>
                                                            <i class="icon-home" style="color: #e04f67;"></i>  {{trans("services.service_housing_type")}}
                                                            :
                                                            <span data-ng-if="service.house_type=='family'">
                                                            {{trans("services.service_house_type_options.family")}}
                                                            </span>
                                                            <span data-ng-if="service.house_type=='students'">
                                                                {{trans("services.service_house_type_options.students")}}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="icon_set_3_restaurant-8" style="color: #e04f67;"></i> {{trans("services.meals_description")}}
                                                            : <%
                                                            service.meals|| "--"%>
                                                        </li>

                                                        

                                                    </ul>
                                                </div>

                                                <div class="col-md-6">
                                                    <ul style="list-style-type:none">
                                                      <li>
                                                          <i class="icon_set_2_icon-115" style="color: #e04f67;"></i> 
                                                          {{trans("services.service_room_type")}}: <%
                                                            service.room_type || "--"%>


                                                            </li>
                                                        <li><i class="icon_set_1_icon-94" style="color: #e04f67;"></i> 
                                                          {{trans("services.service_min_age")}}: <%
                                                            service.min_age || "--"%>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <center>
                                               
                                                 <span
                                        class="price_course_text">{{trans("courses.text_price")}}</span><span
                                        class="price_course"><sup>{{$currencyCode}}</sup><%(currencyRate * service.price).toFixed()%></span>
                                <small class="old_course_price">{{trans("courses.per_week")}}</small> 
                                                    <button class='btn' ng-click="bookingData.housingType !=service.id ? bookingData.housingType =service.id : bookingData.housingType = ''" ng-class="{'btn-success':bookingData.housingType==service.id,'btn-default':bookingData.housingType!=service.id}" ><% bookingData.housingType !=service.id ?"{{trans('bookings.btn_select')}}":"{{trans('bookings.btn_selected')}}"%></button>
                                                </center>
                                            </div>
                      </div>
                    </div>
                  </div>
            
              
               
                </div>
                  
                </div><!-- End col-md-12-->
               </div><!-- End row-->  

                    <br>
                    @if($releated->count())
              <div class="row">
                  <div class="col-md-12">
                  <h3>{{trans('courses.frontend_releated_courses')}}</h3>
                  <div class="panel-group" id="accordion">
                    @foreach($releated as $releatedCourse)
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="{{'#'.$releatedCourse->id}}">{{$releatedCourse->name}}<i class="indicator {{$releated{0}->id==$releatedCourse->id? 'icon-minus' : 'icon-plus'}} pull-right"></i> </a>
                      </h4>
                    </div>
                    <div id="{{$releatedCourse->id}}" class="panel-collapse collapse {{$releated{0}->id==$releatedCourse->id? 'in' : ''}}">
                        <div class="panel-body panal-no-padding">
                                               <div class="wow fadeIn" data-wow-delay="0.1s">

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        @if($releatedCourse->featured)
                                                            <div class="ribbon_3 featured">
                                                                <span>{{trans("courses.featured")}}</span>
                                                            </div>
                                                        @endif 
 @if(Auth::check())                    
             <div class="my_list_wishlist" ng-if="favoritesCourses.indexOf({{$releatedCourse->id}}) < 0" >
                                            <a class="tooltip_flip tooltip-effect-1"  href ng-click="favorite('courses', {{$releatedCourse->id}})">+<span
                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                        </div>

                                        <div class="my_list_wishlist_remove" ng-if="favoritesCourses.indexOf({{$releatedCourse->id}}) > -1" >
                                            <a class="tooltip_flip tooltip-effect-1"  href ng-click="unfavorite('courses', {{$releatedCourse->id}})">-<span
                                                        class="tooltip-content-flip"><span
                                                            class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                                        </div>
@else
                                         <div class="my_list_wishlist" >
                                            <a class="tooltip_flip tooltip-effect-1"  href="#checkLoginModal" data-toggle="modal" >+<span
                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                            class="tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                        </div>

                                        @endif
                                                       
                                                        <div class="img_list"><a href="{{route("course.details",['id'=>$releatedCourse->id,'slug'=>$releatedCourse->{"name:en"}])}}">
                        <img src="{{url("files/{$releatedCourse->photo}")}}" alt="{{$releatedCourse->name}}">

                        @if($releatedCourse->offer_price > 0)
                         <div class="badge_save">{{trans('main.icon_offer_save')}}<strong>
                                         {{ round(($releatedCourse->offer_price / $releatedCourse->price) * 100) }} %</strong></div>

                         @endif                

                          <div class="short_info">
                                            <div class="short_info_content">
                                           @if($releatedCourse->institute->logo)
                                            <a href="{{url("institutes/{$releatedCourse->institute->id}-".str_slug($releatedCourse->institute->{"name:en"}))}}" style="margin: 0px 5px 2px 5px;  z-index: 10;"  target="_blanck"><i> <img id="img_not_zoom" src="{{url("files/{$releatedCourse->logo}?size=27,27")}}"
                                             width="27" height="27" class="logo-grid-circle"
                                             alt="{{$releatedCourse->institute->name}}" style="height: 27px; width: 27px;"></i></a>

                                             @else
                                            <a href="{{url("institutes/{$releatedCourse->institute->id}-".str_slug($releatedCourse->institute->{"name:en"}))}}" style="color: #fff; z-index: 10;"  target="_blanck">
                                                <i class="icon_set_1_icon-1"  style="font-size: 20px; border: solid #fff 1px; border-radius: 50%; padding: 4px 1px 1px 1px; z-index: 10; "></i>
                                            </a>
                                            @endif
                                             
                                            
                                             <strong>{{$releatedCourse->institute->name}}</strong>
                                                
</div>
                                        </div>
                        </a>
                        </div>
                                                    </div>
                                                    <div class="clearfix visible-xs-block"></div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="tour_list_desc">
                                                          <h3>
                                                                <a href="{{route("course.details",['id'=>$releatedCourse->id,'slug'=>$releatedCourse->{"name:en"}])}}">{{$releatedCourse->name}}</a> 
                                                            </h3>

                                                            <p>{{str_limit(strip_tags($releatedCourse->description),500)}}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <div class="price_list">
                                                            @if($releatedCourse->offer_price)
                                                            <div><sup style="font-size: 12px">{{$currencyCode}}</sup>{{round($currencyRate * $releatedCourse->offer_price)}}<span
                                                                        class="normal_price_list">
                                        {{round($currencyRate *  $releatedCourse->price)}}</span>
                                                                <small>*{{trans("courses.price_per_week")}}</small>
                                                                <p>
                                                                    <a href="{{route("course.details",['id'=>$releatedCourse->id,'slug'=>$releatedCourse->{"name:en"}])}}"
                                                                       class="btn_1">
                                                                           {{trans("courses.btn_read_more")}}
                                                                       </a>
                                                                </p>
                                                            </div>
@else
                                                             <div><sup style="font-size: 12px">{{$currencyCode}}</sup>{{round($currencyRate * $releatedCourse->price)}}
                                 <small>*{{trans("courses.price_per_week")}}</small>
                                                       <p>
                                                                    <a href="{{route("course.details",['id'=>$releatedCourse->id,'slug'=>$releatedCourse->{"name:en"}])}}"
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
                                                                : {{trans("courses.hours_count",['count'=>$releatedCourse->hours])}}</td></tr>
                                                           <tr> <td> <i class="icon-book" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.label_lessons")}}
                                                                : {{trans("courses.lessons_count",['count'=>$releatedCourse->num_lessons])}}</td></tr>
                                                           <tr> <td><i class="icon-user-add" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.details_min_age", ['year'=>$releatedCourse->min_age])}}
                                                               </td></tr>


                                                         
                                                            </tbody>
                                                            </table>
                                                                
                                                    </div>

                                                    <div class="col-md-6">
                                                        <table>
                                                            <tbody class="course_featured">
                                                                
                                                            
                                                            <tr><td><i  class="icon-calendar" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.details_start_day")}}
                                                                : {{trans("courses.start_day_every",['day'=>trans("courses.week_days_options.{$releatedCourse->start_day}")])}}
                                                            </td></tr>
                                                            </tr><td><i  class="icon-users-3" style="color: #88b60b; font-size: 18px;"></i>{{trans("courses.details_avg_students")}}
                                                                : {{trans("courses.students_count",['count'=>$releatedCourse->avg_students])}}</td></tr>
                                                        </tbody>
                                                        </table>
                                                        
                                                    </div>

                                               
                                           
                                        </div>
                                        <br>
                    </div> <!--End strip -->
                           

                                            <!--End strip -->
                                        </div>
                    </div>
                  </div>
                  @endforeach
                 
                </div>
                  
                </div><!-- End col-md-12-->
               </div><!-- End row-->
                @endif
                <!--End  Releated Courses-->


                </div>


                <!--End  single_tour_desc-->


                <aside class="col-md-4" id="sidebar" style="z-index:999">

                    <div class="theiaStickySidebar">
                      {!! Form::open(['route'=>["checkout",'id'=>$course->id,'slug'=>str_slug($course->{"name:en"})], 'method' => 'get']) !!}  
                        <div class="box_style_1 expose" id="booking_box">
                            <h3 class="inner">{{trans("bookings.booking_box_title")}}</h3>
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <strong>{{$course->name}}</strong>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label><i class="icon-calendar-7"></i> {{trans("courses.label_start_date")}}
                                        </label>
                                        <input class="date-pick form-control" data-date-format="yyyy M d, D" type="text"
                                               data-ng-model="bookingData.startDate"
                                               data-ng-value="bookingData.startDate">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>{{trans("courses.label_duration")}}</label>
                                        <div class="numbers-row">
                                            <input type="text"
                                                   data-ng-model=" bookingData.weeks"
                                                   data-ng-change=" bookingData.hWeeks=parseInt('{{Request::input("hWeeks")}}')>0?'{{Request::input("hWeeks")}}': bookingData.weeks"
                                                   data-ng-init=" bookingData.weeks='{{Request::input("weeks")?:"1"}}'"
                                                   min="1"
                                                   max="40"
                                                   required
                                                   value="1" id="weeks" class="qty2 form-control"
                                                   name="weeks"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>{{trans("main.filter_option_housing")}}</label>
                                        <select class="form-control" name="housing" id="top_filters_housing"
                                                data-ng-model="bookingData.housing"
                                                data-ng-init="bookingData.housing='{{Request::input("housing")?:"y"}}'">
                                            <option value="y">{{trans("main.filter_yes_need")}}</option>
                                            <option value="n">{{trans("main.filter_no_need")}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group" data-ng-show=" bookingData.housing=='y'">
                                        <label>{{trans("main.filter_housing_duration")}}</label>
                                        <div class="numbers-row">
                                            <input type="text" min="1"
                                                   data-ng-model=" bookingData.hWeeks"
                                                   data-ng-init=" bookingData.hWeeks='{{Request::input("hWeeks")?:"1"}}'"
                                                   max="40" maxlength="40" minlength="1"
                                                   value="1" id="hWeeks" class="qty2 form-control"
                                                   name="hWeeks">
                                        </div>
                                        <span class="help-block">{{trans("main.filter_hint_duration")}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group" data-ng-show=" bookingData.housing=='y'">
                                        <label for="hType">{{trans("courses.label_housing_type")}}</label>

                                        <select name="hType" id="hType" data-ng-model="bookingData.housingType"
                                                data-ng-init="bookingData.housingType='{{Request::get("housingType")}}'"
                                                class="form-control">
                                            <option value=""></option>
                                            <option data-ng-repeat="hservice in course.institute.housing_services"

                                                    value="<%hservice.id%>"><%hservice.name%>
                                            </option>
                                        </select>
                                    </div>
                                </div>

                          <!--       <div class="col-md-12 col-sm-12">
                                    <div class="form-group">

                                        <label>{{trans("services.option_transporting")}}</label>
                                        <select class="form-control" name="transporting" id="transporting"
                                                data-ng-model="bookingData.transporting">
                                            <option value="y">{{trans("services.option_need_transporting")}}</option>
                                            <option value="n">{{trans("services.option_no_transporting")}}</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>{{trans("services.option_insurance")}}</label>
                                        <select class="form-control" name="insurance" id="top_filters_insurance"
                                                data-ng-model=" bookingData.insurance"
                                        >
                                            <option value="y">{{trans("services.option_need_insurance")}}</option>
                                            <option value="n">{{trans("services.option_no_insurance")}}</option>


                                        </select>

                                    </div>
                                </div> -->

                                       <table class="table table-striped options_booking">
        <thead>
        <tr>
          <th colspan="3">
            {{trans('bookings.label_additional_services')}}
          </th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td width="6%">
            <i class="icon_set_1_icon-16"></i> 
          </td>
          <td width="59%">
 {{trans('bookings.label_transporting_services')}}          </td>
          <td width="35%">
            <label class="switch-light switch-ios pull-right">
           
             <input type="checkbox" name="transporting" id="transporting"
                                                data-ng-model="bookingData.transporting" data-ng-true-value="'y'" data-ng-false-value="'n'" ng-checked="bookingData.transporting=='y'">                                   
            <span>
            <span>{{trans('bookings.input_no')}}</span>
            <span>{{trans('bookings.input_yes')}}</span>
            </span>
            <a></a>
            </label>
          </td>
        </tr>
        <tr>
          <td>
            <i class="icon_set_1_icon-94"></i> 
          </td>
          <td>
            {{trans('bookings.label_insurance_services')}}
           
          </td>
          <td>
            <label class="switch-light switch-ios pull-right">
            <input type="checkbox" name="insurance" data-ng-model="bookingData.insurance" data-ng-true-value="'y'" data-ng-false-value="'n'" ng-checked="bookingData.insurance=='y'">
            <span>
            <span>{{trans('bookings.input_no')}}</span>
            <span>{{trans('bookings.input_yes')}}</span>
            </span>
            <a></a>
            </label>
          </td>
        </tr>
        </tbody>
        </table>

                            </div>
                            <br>
                            <table class="table table_summary">
                                <thead data-ng-if="fees.length">
                                <tr>
                                    <th colspan="2">{{trans("bookings.title_fees")}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr data-ng-repeat="fee in fees">
                                    <td>
                                        <%fee.name%>
                                    </td>
                                    <td class="text-right">
                                        <%(currencyRate * fee.fees).toFixed()%>
                                    </td>
                                </tr>
                                <tr class="total">
                                    <td>
                                        {{trans('bookings.total_cost')}}
                                    </td>
                                    <td class="text-right">
                                        <%(currencyRate * subTotal).toFixed()%> <sup> {{$currencyCode}} </sup>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="container">
 
  

  
  
</div>

  @if (Auth::check())
                                <div class="row" ng-if="favoritesInstitutes.indexOf({{$institute->id}}) > -1"><a href ng-click="unfavorite('courses', {{$course->id}})" class="btn_full_outline">{!! trans("main.btn_remove_favorite") !!} <i class=" icon_heart"></i></a></div>
                                <br>

                                <div class="row" ng-if="favoritesInstitutes.indexOf({{$institute->id}}) < 0"><a href ng-click="favorite('courses', {{$course->id}})" class="btn_full_outline"> {!! trans("main.btn_add_favorite") !!} <i class=" icon_heart"></i></a></div>
                                <br>
<div class="row">
                                <button type="submit" class="btn_full">{{trans("bookings.btn_confirm_booking")}}</button>
</div>
                                @else

                                <div class="row"><a href="#checkLoginModal" data-toggle="modal" class="btn_full_outline"><i class=" icon_heart"></i> {!! trans("main.btn_add_favorite") !!} </a></div>
                                <br>
<div class="row">
                                <button type="button" class="btn_full" data-toggle="modal" data-target="#checkLoginModal">{{trans("bookings.btn_confirm_booking")}}</button>

</div>
                                 @endif

                          {{--  <button type="button" ng-click="goCheckout()" prevented-click
                               class="btn_full">{{trans("bookings.btn_confirm_booking")}}</button>  --}} 
                            {{-- <a href="#"
                               ng-click="goCheckout()" prevented-click
                               class="btn_full">{{trans("bookings.btn_confirm_booking")}}</a> --}}


                                          
                        <!--/end booking form -->

                   

                        </div><!--/box_style_1 -->
 {!! Form::close() !!}

                    </div><!--/end sticky -->

                </aside>
            </div>
            <!--End row -->
        </div>
        <!--End container -->



        <div id="overlay"></div>
        <!-- Mask on input focus -->

    </main>

@endsection
@section("styles")


    <link href="/assets/css/slider-pro.min.css" rel="stylesheet">
    @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
    <link href="/assets/css-rtl/date_time_picker.css" rel="stylesheet">
    @else
<link href="/assets/css/date_time_picker.css" rel="stylesheet">
    @endif
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <style>
    .panal-no-padding {
     padding: 0px !important; 
    line-height: 1.6 !important;
}
    </style>

@stop
@section("scripts")
    <!-- Specific scripts -->
 {{--   <script src="/assets/js/icheck.js"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });
    </script> --}}
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
        })
        ;
    </script>
 @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
    <!-- Date and time pickers -->
    <script src="/assets/js-rtl/bootstrap-datepicker.js"></script>
    <script src="/assets/js-rtl/bootstrap-timepicker.js"></script>
    @else
 <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    @endif
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

    <!--Review modal validation -->
    <script src="/assets/validate.js"></script>

    {{--
      <!-- Fixed sidebar -->
      <script src="/assets/js/theia-sticky-sidebar.js"></script>
      <script>
          jQuery('#sidebar').theiaStickySidebar({
              additionalMarginTop: 80
          });
      </script>
  --}}



@stop




