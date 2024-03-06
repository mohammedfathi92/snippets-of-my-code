@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("courses.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("courses.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")


@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp


    <div data-ng-controller="coursesFilterCtrl" data-ng-init="changeCurrencyRate({{$currencyRate}})">

      

        <section class="header-video" id="search_container">
            <div id="hero_video">
                <div id="search">
                    {!! Form::open(['route'=>'courses.index','method'=>"get",'id'=>"filtersForm",'name'=>'filtersForm']) !!}
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#" data-target="#quickSearch"
                                              data-toggle="tab">{{trans("main.tab_quick_search")}}</a></li>
                        <li><a href="#" data-target="#advancedSearch"
                               data-toggle="tab">{{trans("main.tab_advanced_search")}}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="quickSearch">
                            <h3>{{trans("main.title_quick_search")}}</h3>
                            <div class="row">
                                <div class="input-group">
                                  <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i
                                                class="icon-search"></i> {{trans("main.btn_quick_search")}}</button>
                                  </span>
                                    <input type="text" name="q" class="form-control" value="{{Request::get("q")}}"
                                           placeholder="{{trans("main.holder_quick_search")}}">
                                </div>
                            </div>
                        </div><!-- End rab -->
                        <div class="tab-pane" id="advancedSearch">
                            <h3>{{trans('main.title_advanced_search')}}</h3>
                           <div class="row">

                            <div class="col-md-6">
                                <div class="form-group" data-ng-init="getCountriesList()">
                                    <label>{{trans("courses.label_country")}}</label>
                                    <select class="form-control" name="country" id="top_filter_country"

                                            data-ng-model="filterData.country"
                                            data-ng-init="filterData.country='{{Request::input("country")}}'">
                                        <option value="" disabled>{{trans("main.filters_select_country")}}</option>
                                        <option data-ng-repeat="item in countriesList" value="<%item.code%>"
                                                data-ng-selected="item.code=='{{Request::input("country")}}'">
                                            <%item.name%>
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>{{trans("courses.label_city")}}</label>
                                <select class="form-control" name="city" id="top_filter_city"
                                        data-ng-model="filterData.city"
                                        data-ng-init="filterData.city='{{Request::input("city")}}' ">
                                    <option value="">{{trans("main.filters_select_city")}}</option>
                                    <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{Request::input("city")}}'"> <%city.name%>
                                    </option>
                                </select>
                            </div>


                        </div><!-- End row -->
                     <!-- End row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" data-ng-init="getCoursesCategories()">
                                    <label>{{trans("main.filter_course_type")}}</label>
                                    <select class="form-control" name="category" id="top_filters_course_category"
                                            data-ng-model="filterData.category"
                                            data-ng-init="filterData.category='{{Request::input("category")}}'">
                                       <option value="">{{trans("main.filters_select_course_category")}}</option>
                                    <option data-ng-repeat="category in coursesCategories" value="<%category.id%>"
                                            data-ng-selected="category.id=='{{Request::input("category")}}'"> <%category.name%>
                                    </option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <center>
                                    <div class="form-group">
                                        <label>{{trans("courses.label_duration")}}</label>
                                        <div class="numbers-row">
                                            <input type="text"
                                                   data-ng-model="filterData.weeks"
                                                   data-ng-change="filterData.hWeeks=parseInt('{{Request::input("hWeeks")}}')>0?'{{Request::input("hWeeks")}}':filterData.weeks"
                                                   data-ng-init="filterData.weeks='{{Request::input("weeks")?:"1"}}'"
                                                   min="1"
                                                   max="40"
                                                   required
                                                   value="1" id="weeks" class="qty2 form-control"
                                                   name="weeks" style="right: 1px">
                                        </div>
                                        <span class="help-block">{{trans("main.filter_hint_duration")}}</span>
                                    </div>
                                    </center>
                                </div>

                           
                        </div>
                            <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_housing")}}</label>
                                    <select class="form-control" name="housing" id="top_filters_housing"
                                            data-ng-model="filterData.housing"
                                            data-ng-init="filterData.housing='{{Request::input("housing")?:"y"}}'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>
                                    </select>
                                </div>
                            </div>
                              
                                <div class="col-md-6">
                                   <center>
                                    <div class="form-group" data-ng-show="filterData.housing=='y'">
                                        
                                        <label>{{trans("main.filter_housing_duration")}}</label>
                                        <div class="numbers-row">
                                            <input type="text" min="1"
                                                   data-ng-model="filterData.hWeeks"
                                                   data-ng-init="filterData.hWeeks='{{Request::input("hWeeks")?:"1"}}'"
                                                   max="40" maxlength="40" minlength="1"
                                                   value="1" id="hWeeks" class="qty2 form-control"
                                                   name="hWeeks" style="right: 1px">
                                        </div>
                                        <span class="help-block">{{trans("main.filter_hint_duration")}}</span>
                                        
                                    </div>
                                    </center>

                                </div>
                            

                            
                        </div> <!-- End row -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>{{trans("main.filter_option_transporting")}}</label>
                                <select class="form-control" name="transporting" id="transporting"
                                        data-ng-model="filterData.transporting"
                                        data-ng-init="filterData.transporting='{{Request::input("transporting")?:"n"}}'">
                                    <option value="y">{{trans("main.filter_yes_need")}}</option>
                                    <option value="n">{{trans("main.filter_no_need")}}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_insurance")}}</label>
                                    <select class="form-control" name="i" id="top_filters_insurance"
                                            data-ng-model="filterData.insurance"
                                            data-ng-init="filterData.insurance='{{Request::input("insurance")}}'||'y'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>


                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <input type="hidden" name="scroll" value="true">
                        <button class="btn_1 green" type="submit"><i class="icon-search"></i>{{trans('main.btn_search_now')}}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <img src="" alt="Image" class="header-video--media" data-video-src=""
                 data-teaser-source="/assets/video/Sketch" data-provider="Youtube" data-video-width="854"
                 data-video-height="480">
        </section><!-- End Header video -->
        <main data-ng-controller="favoriteCtrl" data-ng-init="getFavoritesCourses()">

            <div id="position">
                <div class="container">
                    <ul>
                        <li><a href="/">{{trans("main.link_home")}}</a>
                        </li>
                        <li>{{trans("courses.link_courses")}}</li>
                    </ul>
                </div>
            </div>
            <!-- Position -->

            <!-- End Map -->


            <div class="container margin_60">

                <div class="row">
                    <aside class="col-lg-3 col-md-3">

                        @if($categories->count())
                            <div class="box_style_cat">
                                <ul id="cat_nav">
                                    @foreach($categories as $category)
                                        <li><a href="#" onclick="updateQueryString('category','{{$category->id}}')"
                                               id="active"><i
                                                        class="icon_set_1_icon-51"></i>{{$category->name}}
                                                <span>({{\Corsata\Course::where("category_id",$category->id)->count()}}
                                                    )</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div id="filters_col">
                            <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false"
                               aria-controls="collapseFilters" id="filters_col_bt"><i
                                        class="icon_set_1_icon-65"></i>{{trans("institutes.title_filters")}}
                                <i class="icon-plus-1 pull-right"></i></a>
                            <div class="collapse" id="collapseFilters">

                                <div class="filter_type">
                                    <h6>{{trans("courses.text_international_rating")}}</h6>
                                    <ul>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[rating][international][]"
                                                          {{(is_array(Request::input("filter.rating.international")) && in_array(5,Request::input("filter.rating.international")))?"checked":""}}
                                                          value="5"><span class="rating"><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i></span>({{\Corsata\Institute::published()->where("international_rate",5)->count()}}) </label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][international][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.international")) && in_array(4,Request::input("filter.rating.international")))?"checked":""}}
                                                          value="4"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("international_rate",4)->count()}})</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][international][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.international")) && in_array(3,Request::input("filter.rating.international")))?"checked":""}}
                                                          value="3"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("international_rate",3)->count()}})</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][international][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.international")) && in_array(2,Request::input("filter.rating.international")))?"checked":""}}
                                                          value="2"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("international_rate",2)->count()}})</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][international][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.international")) && in_array(1,Request::input("filter.rating.international")))?"checked":""}}
                                                          value="1"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("international_rate",1)->count()}})</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="filter_type">
                                    <h6>{{trans("courses.text_locale_rating")}}</h6>
                                    <ul>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[rating][locale][]"
                                                          {{(is_array(Request::input("filter.rating.locale")) && in_array(5,Request::input("filter.rating.locale")))?"checked":""}}
                                                          value="5"><span class="rating"><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i></span>({{\Corsata\Institute::published()->where("locale_rate",5)->count()}}
                                                )</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][locale][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.locale")) && in_array(4,Request::input("filter.rating.locale")))?"checked":""}}
                                                          value="4"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("locale_rate",4)->count()}})</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][locale][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.locale")) && in_array(3,Request::input("filter.rating.locale")))?"checked":""}}
                                                          value="3"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("locale_rate",3)->count()}})</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][locale][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.locale")) && in_array(2,Request::input("filter.rating.locale")))?"checked":""}}
                                                          value="2"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81 voted"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("locale_rate",2)->count()}})</label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" name="filter[rating][locale][]"
                                                          onchange="submitFilters()"
                                                          {{(is_array(Request::input("filter.rating.locale")) && in_array(1,Request::input("filter.rating.locale")))?"checked":""}}
                                                          value="1"><span class="rating">
                        <i class="icon_set_1_icon-81 voted"></i><i class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i><i
                                                            class="icon_set_1_icon-81"></i>
                        </span>({{\Corsata\Institute::published()->where("locale_rate",1)->count()}})</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="filter_type">
                                    <h6>{{trans("institutes.label_location_type")}}</h6>
                                    <ul>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(1,Request::input("filter.location")))?"checked":""}}
                                                          value="1">{{trans_choice("institutes.institute_location_type_option",1)}}
                                            </label></li>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(2,Request::input("filter.location")))?"checked":""}}
                                                          value="2">{{trans_choice("institutes.institute_location_type_option",2)}}
                                            </label></li>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(3,Request::input("filter.location")))?"checked":""}}
                                                          value="3">{{trans_choice("institutes.institute_location_type_option",3)}}
                                            </label></li>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(4,Request::input("filter.location")))?"checked":""}}
                                                          value="4">{{trans_choice("institutes.institute_location_type_option",4)}}
                                            </label></li>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(5,Request::input("filter.location")))?"checked":""}}
                                                          value="5">{{trans_choice("institutes.institute_location_type_option",5)}}
                                            </label></li>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(6,Request::input("filter.location")))?"checked":""}}
                                                          value="6">{{trans_choice("institutes.institute_location_type_option",6)}}
                                            </label></li>
                                        <li><label><input type="checkbox" onchange="submitFilters()"
                                                          name="filter[location][]"
                                                          {{(is_array(Request::input("filter.location"))&& in_array(7,Request::input("filter.location")))?"checked":""}}
                                                          value="7">{{trans_choice("institutes.institute_location_type_option",7)}}
                                            </label></li>

                                    </ul>
                                </div>

                            </div><!--End collapse -->
                        </div><!--End filters col-->
                        <!--End filters col-->
                        @if(Settings::get('show_help_box'))
                             @include('frontend.includes.help_col')
                        @endif
                    </aside>
                    <!--End aside -->
                    <div class="col-lg-9 col-md-9">

                        <div id="tools">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="styled-select-filters">
                                        <select name="sort" id="sort_rating" data-ng-model="filterData.sort">
                                            <option value="">{{trans("institutes.option_select_sort_by")}}</option>
                                            <option value="lrh" {{Request::get('sort')=='lrh'?"selected":""}}>{{trans("institutes.sort_option_by_higher_locale_rate")}}</option>
                                            <option value="lrl" {{Request::get('sort')=='lrl'?"selected":""}}>{{trans("institutes.sort_option_by_lower_locale_rate")}}</option>
                                            <option value="irh" {{Request::get('sort')=='irh'?"selected":""}}>{{trans("institutes.sort_option_by_higher_international_rate")}}</option>
                                            <option value="irl" {{Request::get('sort')=='irl'?"selected":""}}>{{trans("institutes.sort_option_by_lower_international_rate")}}</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- <button type="submit" form="compare"
                                        class="btn_1 medium compare pull-right">{{trans("course.compare")}}</button> -->
                            </div>
                        </div>
                        <!--/tools -->
                       {{-- <form method="get" action="{{ route('compare.courses') }}" id="compare">--}}
                            <div ng-cloak data-ng-repeat="course in coursesList.data"
                                 class="strip_all_tour_list wow fadeIn"
                                 data-wow-delay="0.1s">


                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="ribbon_3" ng-if="course.featured"><span>{{trans("courses.featured_word")}}</span></div>
                                        <div class="my_wishlist" ng-if="'{{Auth::check()}}' && favoritesCourses.indexOf(course.id) < 0">
                                            <a class="tooltip_flip tooltip-effect-1"  href ng-click="favorite('courses', course.id)">+<span
                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                        </div>

                                        <div class="my_wishlist_remove" ng-if="'{{Auth::check()}}' && favoritesCourses.indexOf(course.id) > -1">
                                            <a class="tooltip_flip tooltip-effect-1"  href ng-click="unfavorite('courses', course.id)">-<span
                                                        class="tooltip-content-flip"><span
                                                            class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                                        </div>

                                         <div class="my_wishlist" ng-if="'{{Auth::check()}}' < 1">
                                            <a class="tooltip_flip tooltip-effect-1"  href="javascript:void(0);" >+<span
                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                            class="tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                        </div>



                                        <div class="img_list">
                                            <a href="<%course.url%>">
                                                <!-- <div class="ribbon popular"></div> -->
                                                <img data-ng-src="<%course.photo_path%>"
                                                     alt="<%course.name%>">
                                            
                                         <div class="badge_save" ng-if="course.offer_price > 0">{{trans('main.icon_offer_save')}}<strong>
                                         <% ((course.offer_price / course.price) * 100).toFixed() %> %</strong></div>
                                        
                                         <div class="short_info">
                                            <div class="short_info_content">
                                           
                                            <a ng-href="<%course.institute.url%>" style="margin: 0px 5px 2px 5px;  z-index: 10;" ng-if="course.institute.logo != false" target="_blanck"><i> <img id="img_not_zoom" data-ng-src="<%course.institute.logo%>"
                                             width="27" height="27" class="logo-grid-circle"
                                             alt="<%course.institute.name%>" style="height: 27px; width: 27px;"></i></a>
                                            <a ng-href="<%course.institute.url%>" style="color: #fff; z-index: 10;" ng-if="course.institute.logo == false" target="_blanck">
                                                <i class="icon_set_1_icon-1"  style="font-size: 20px; border: solid #fff 1px; border-radius: 50%; padding: 4px 1px 1px 1px; z-index: 10; "></i>
                                            </a>
                                             
                                            
                                             <strong><%course.institute.name%></strong>
                                                
</div>
                                        </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix visible-xs-block"></div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="tour_list_desc">
                                            {{-- <div class="rating"><i class="icon-smile voted"></i><i
                                                        class="icon-smile  voted"></i><i
                                                        class="icon-smile  voted"></i><i
                                                        class="icon-smile  voted"></i><i class="icon-smile"></i>
                                            </div> --}}
                                            <h3><a href="<%course.url%>"><strong><%course.name%></strong></a></h3>
                                            <h5><a href="<%course.institute.url%>" target="_blank"><%course.institute.name%></a></h5>
                                            <p> <% (course.short_description.length
                                                >100)?course.short_description.substring(0,400)+'...':course.short_description
                                                %> </p>
                                            <ul class="add_info" data-ng-if="course.services.length">
                                                <li data-ng-repeat="service in course.services">
                                                    <div class="tooltip_styled tooltip-effect-4">
                                                        <span class="tooltip-item">
                                                            <i data-ng-if="service.type=='house'"
                                                               class="icon_set_2_icon-115"></i>

                                                        <i data-ng-if="service.type=='transport'"
                                                           class="icon-flight"></i>

                                                        <i data-ng-if="service.type=='adviser'"
                                                           class="icon_set_1_icon-57"></i>

                                                        <i data-ng-if="service.type=='insurance'"
                                                           class=" icon-stethoscope"></i></span>
                                                        <div class="tooltip-content">
                                                            <h4><%service.name%></h4>
                                                            <p><%service.description%></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">

                                        <div class="price_list">
                                            <div ng-if="course.offer_price > 0"><sup style="font-size: 12px">{{$currencyCode}}</small></sup><% (currencyRate * course.offer_price).toFixed() %> <span class="normal_price_list"><% (currencyRate * course.price).toFixed() %></span>
                                                <small>*{{trans("courses.price_per_week")}}</small>
                                                <p><a href="<%course.url%>"
                                                      class="btn_1">{{trans("courses.btn_read_more")}}</a>
                                                </p>
                                               


                                            </div>

                                            <div ng-if="course.offer_price <= 0"><sup style="font-size: 12px">{{$currencyCode}}</small></sup><% (currencyRate * course.price).toFixed() %>
                                                <small>*{{trans("courses.price_per_week")}}</small>
                                                <p><a href="<%course.url%>"
                                                      class="btn_1">{{trans("courses.btn_read_more")}}</a>
                                                </p>
                                               


                                            </div>


                                        </div>
                                    </div>


                                </div>
                            </div>

                        {{--</form>--}}
                        <!--End strip -->
                        <hr>

        

                        <div class="text-center">
                            {{--pagination is here--}}
                        </div>
                        <!-- end pagination-->

                    </div>
                    <!-- End col lg-9 -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </main>
        <!-- End main -->
    </div>


@stop
@section("styles")
    <link href="/assets/css/skins/square/grey.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
@stop

@section("scripts")

<!--  <script src="/addTocompare/js/main.js"></script>
 -->
    <!-- Map -->



    <script src="/assets/js/infobox.js"></script>
    <script src="/assets/js/icheck.js"></script>
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script src="/assets/js/modernizr.js"></script>
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
    </script>
    <script>

        $(document).ready(function () {
            // $('input').iCheck({
            //     checkboxClass: 'icheckbox_square-grey',
            //     radioClass: 'iradio_square-grey'
            // }).on(
            //     'ifToggled',
            //     function (e) {
            //         $(e).trigger("change");
            //     }
            // );

            $('input.date-pick').datepicker('setDate', 'today');
            $('input.time-pick').timepicker({
                minuteStep: 15,
                showInpunts: false
            });

            if ($($.QueryString).size() && $.QueryString.scroll === 'true') {
                $("html, body").delay(1000).animate({scrollTop: $('#position').offset().top - 60}, 500);
            }

        });

    </script>



@stop