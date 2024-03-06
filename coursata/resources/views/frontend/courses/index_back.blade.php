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
    <div data-ng-controller="coursesFilterCtrl">
        {!! Form::open(['method'=>"get",'id'=>"filtersForm",'name'=>'filtersForm']) !!}

        <section class="header-video">
            <div id="hero_video">
                <div id="search">
                    {!! Form::open(['route'=>'courses.index','method'=>"get",'id'=>"filtersForm",'name'=>'filtersForm']) !!}
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#" data-target="#quickSearch"
                                              data-toggle="tab">{{trans("courses.tab_quick_search")}}</a></li>
                        <li><a href="#" data-target="#advancedSearch"
                               data-toggle="tab">{{trans("courses.tab_advanced_search")}}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="quickSearch">
                            <h3>{{trans("courses.title_quick_search")}}</h3>
                            <div class="row">
                                <div class="input-group">
                                  <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button"><i
                                                class="icon-search"></i> {{trans("courses.btn_search")}}</button>
                                  </span>
                                    <input type="text" name="q" class="form-control" value="{{Request::get("q")}}"
                                           placeholder="{{trans("courses.holder_search")}}">
                                </div>
                            </div>
                        </div><!-- End rab -->
                        <div class="tab-pane" id="advancedSearch">
                            <h3>{{trans("courses.title_advanced_search")}}</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" data-ng-init="getCountriesList()">
                                        <label>{{trans("courses.label_country")}}</label>
                                        <select class="form-control" name="country" id="top_filter_country"

                                                data-ng-model="filterData.country"
                                                data-ng-init="filterData.country='{{Request::input("country")}}'">
                                            <option value=""
                                                    disabled>{{trans("courses.filters.select_country")}}</option>
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
                                        <option value="">{{trans("courses.filters.select_city")}}</option>
                                        <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                                data-ng-selected="city.id=='{{Request::input("city")}}'"> <%city.name%>
                                        </option>
                                    </select>
                                </div>


                            </div><!-- End row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("services.option_housing")}}</label>
                                        <select class="form-control" name="housing" id="top_filters_housing"
                                                data-ng-model="filterData.housing"
                                                data-ng-init="filterData.housing='{{Request::input("housing")?:"y"}}'">
                                            <option value="y">{{trans("services.option_need_housing")}}</option>
                                            <option value="n">{{trans("services.option_no_housing")}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-3 col-xs-5">
                                    <div class="col-md-6">
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
                                                       name="weeks">
                                            </div>
                                            <span class="help-block">{{trans("courses.help_weeks")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" data-ng-show="filterData.housing=='y'">
                                            <label>{{trans("courses.label_housing_duration")}}</label>
                                            <div class="numbers-row">
                                                <input type="text" min="1"
                                                       data-ng-model="filterData.hWeeks"
                                                       data-ng-init="filterData.hWeeks='{{Request::input("hWeeks")?:"1"}}'"
                                                       max="40" maxlength="40" minlength="1"
                                                       value="1" id="hWeeks" class="qty2 form-control"
                                                       name="hWeeks">
                                            </div>
                                            <span class="help-block">{{trans("courses.help_housing_weeks")}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{trans("services.option_transporting")}}</label>
                                    <select class="form-control" name="transporting" id="transporting"
                                            data-ng-model="filterData.transporting"
                                            data-ng-init="filterData.transporting='{{Request::input("transporting")?:"n"}}'">
                                        <option value="y">{{trans("services.option_need_transporting")}}</option>
                                        <option value="n">{{trans("services.option_no_transporting")}}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("services.option_insurance")}}</label>
                                        <select class="form-control" name="i" id="top_filters_insurance"
                                                data-ng-model="filterData.insurance"
                                                data-ng-init="filterData.insurance='{{Request::input("insurance")}}'||'y'">
                                            <option value="y">{{trans("services.option_need_insurance")}}</option>
                                            <option value="n">{{trans("services.option_no_insurance")}}</option>


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <img src="" alt="Image" class="header-video--media" data-video-src=""
                 data-teaser-source="/assets/video/Black_Keys" data-provider="Youtube" data-video-width="854"
                 data-video-height="480">
        </section><!-- End Header video -->

        <!-- End section -->
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li>{{trans("courses.link_courses")}}</li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Position -->

        <div class="collapse row" id="collapseMap">
            <div id="map" class="map"></div>
        </div><!-- End Map -->

        <div class="container">

            <div class="row">
                <aside class="col-lg-3 col-md-3">
                    <p>
                        <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"
                           aria-controls="collapseMap">{{trans("main.btn_view_on_map")}}</a>
                    </p>
                    <div class="styled-select">
                        <select class="form-control" name="currency" data-ng-model="filterData.currency" id="currency">
                            @foreach(\Corsata\Currency::all() as $currency)
                                <option value="{{$currency->code}}"
                                        data-ng-selected="queryParams.currency=='{{$currency->code}}'">{{$currency->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="filters_col">
                        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false"
                           aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>بحــث
                            <i
                                    class="icon-plus-1 pull-right"></i></a>
                        <div class="collapse" id="collapseFilters">
                            <div class="filter_type">

                                <div class="Hotel_search">
                                    <div class="styled-select">
                                        <select class="form-control" name="country" id="side_filter_country"
                                                data-ng-model="filterData.country"
                                                data-ng-init="country='{{Request::input("country")}}'">
                                            <option value=""
                                                    disabled>{{trans("courses.filters.select_country")}}</option>
                                            @foreach(\Corsata\Country::whereHas("institutes")->get() as $country)
                                                <option value="{{$country->code}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="Hotel_search">
                                    <div class="styled-select">
                                        <select class="form-control"
                                                name="city"
                                                id="side_filter_city"
                                                data-ng-model="filterData.city"
                                                data-ng-init="city='{{Request::input("city")}}'">
                                            <option value="">{{trans("courses.filters.select_city")}}</option>
                                            <option data-ng-repeat="city in citiesList" value="<%city.id%>">
                                                <%city.name%>
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="Hotel_search">
                                    <div class="styled-select">
                                        <select class="form-control" name="ins" id="side_filter_institute"
                                                data-ng-model="filterData.institute"
                                                data-ng-init="institute='{{Request::input("institute")}}'">
                                            <option value="">{{trans("institutes.option_all_institutes")}}</option>
                                            <option data-ng-repeat="institute in institutesList"
                                                    value="<%institute.id%>">
                                                <%institute.name%>
                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="filter_type">
                                    <h6>{{trans("institutes.title_institute_rating")}}</h6>
                                    <ul>
                                        <li>
                                            <label><input type="checkbox" i-check ng-value="5"
                                                          data-ng-model="filterData.rating"
                                                          name="rating[]"
                                                          value="5"><span
                                                        class="rating">
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                </span>{{trans_choice("institutes.institute_stars_option",5)}}
                                            </label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" i-check ng-value="4"
                                                          data-ng-model="filterData.rating"
                                                          name="rating[]"
                                                          value="4"><span
                                                        class="rating">
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81"></i>
                                                </span>{{trans_choice("institutes.institute_stars_option",4)}}
                                            </label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" i-check ng-value="3"
                                                          data-ng-model="filterData.rating"
                                                          name="rating[]"
                                                          value="3"><span
                                                        class="rating">
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81"></i>
                                                    <i class="icon_set_1_icon-81"></i>
                                                </span>{{trans_choice("institutes.institute_stars_option",3)}}
                                            </label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" i-check ng-value="2"
                                                          data-ng-model="filterData.rating"
                                                          name="rating[]"
                                                          value="2"><span
                                                        class="rating">
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                </span>{{trans_choice("institutes.institute_stars_option",2)}}
                                            </label>
                                        </li>
                                        <li>
                                            <label><input type="checkbox" i-check ng-value="1"
                                                          data-ng-model="filterData.rating"
                                                          name="rating[]"
                                                          value="1"><span
                                                        class="rating">
                                                    <i class="icon_set_1_icon-81 voted"></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                    <i class="icon_set_1_icon-81 "></i>
                                                </span>{{trans_choice("institutes.institute_stars_option",1)}}
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="filter_type">
                                    <h6>{{trans("institutes.title_institute_near_to")}}</h6>
                                    <ul>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="1">{{trans_choice("institutes.institute_location_type_option",1)}}
                                            </label></li>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="2">{{trans_choice("institutes.institute_location_type_option",2)}}
                                            </label></li>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="3">{{trans_choice("institutes.institute_location_type_option",3)}}
                                            </label></li>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="4">{{trans_choice("institutes.institute_location_type_option",4)}}
                                            </label></li>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="5">{{trans_choice("institutes.institute_location_type_option",5)}}
                                            </label></li>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="6">{{trans_choice("institutes.institute_location_type_option",6)}}
                                            </label></li>
                                        <li><label><input type="checkbox" i-check
                                                          data-ng-model="filterData.location"
                                                          name="location[]"
                                                          value="7">{{trans_choice("institutes.institute_location_type_option",7)}}
                                            </label></li>
                                    </ul>
                                </div>

                            </div>
                            <!--End collapse -->
                        </div>
                        <!--End filters col-->
                        <div class="box_style_2">
                            <i class="icon_set_1_icon-57"></i>
                            <h4>هل تريد <span> مساعدة؟</span></h4>
                            <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                            <small>Monday to Friday 9.00am - 7.30pm</small>
                        </div>
                    </div>
                </aside>

                <!--End aside -->

                <div class="col-lg-9 col-md-9">

                    <div id="tools">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <h3 class="sorted">الترتيب حسب</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="styled-select-filters">
                                    <select name="sort_rating" id="sort_rating" data-ng-model="filterData.sort">
                                        <option value="lRating" data-ng-selected="queryParams.sort=='lRating'">Sort by
                                            Locale Rating
                                        </option>
                                        <option value="iRating" data-ng-selected="queryParams.sort=='lRating'">Sort by
                                            International Rating
                                        </option>
                                        <option value="lower" data-ng-selected="queryParams.sort=='lower'">Lowest
                                            Price
                                        </option>
                                        <option value="higher" data-ng-selected="queryParams.sort=='higher'">Highest
                                            Price
                                        </option>
                                        <option value="newest" data-ng-selected="queryParams.sort=='newest'">last
                                            Added
                                        </option>
                                        <option value="oldest" data-ng-selected="queryParams.sort=='oldest'">first
                                            Added
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="text-center cpmarebtn">
                                <button type="submit" form="compare" class="btn_1 medium">{{trans("course.compare")}}</button>
                                 
                                </p>
                            </div>

                        </div>
                    </div>
                    <!--/tools -->
             <!-- start compare form -->
      <form method="get" action="{{ route('compare_list') }}" id="compare" >  
        

                    <div data-ng-repeat="course in coursesList.data" class="strip_all_tour_list wow fadeIn"
                         data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span
                                                class="tooltip-content-flip"><span
                                                    class="tooltip-back">{{trans("courses.btn_add_to_wish_list")}}</span></span></a>
                                </div>
                                <div class="img_list">
                                    <a href="<%course.url%>">
                                        <div class="ribbon popular"></div>
                                        <img data-ng-src="<%course.photo_path%>"
                                             alt="">
                                        <div class="short_info"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix visible-xs-block"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="tour_list_desc">
                                    <div class="score">
                                        <div class="rating" data-toggle="tooltip"
                                             title="{{trans("courses.text_locale_rating")}}">
                                            <i data-ng-class="course.locale_rate>=1?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.locale_rate>=2?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.locale_rate>=3?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.locale_rate>=4?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.locale_rate>=5?'icon-star voted':'icon-star-empty'"></i>
                                        </div>
                                        <div class="rating" data-toggle="tooltip"
                                             title="{{trans("courses.text_international_rating")}}">
                                            <i data-ng-class="course.international_rate>=1?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.international_rate>=2?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.international_rate>=3?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.international_rate>=4?'icon-star voted':'icon-star-empty'"></i>
                                            <i data-ng-class="course.international_rate>=5?'icon-star voted':'icon-star-empty'"></i>
                                        </div>

                                    </div>

                                    <h3>
                                        <a href="<%course.url%>"><strong><%course.name%></strong></a>
                                    </h3>
                                    <div class="location">
                                        <h5>
                                            <a href="<%course.institute.url%>"><%course.institute.name%></a>
                                        </h5>
                                    </div>
                                    <p><%course.short_description%></p>
                                    <div class="add_info">
                                        <div class="row" data-ng-if="course.services.length">


                                            <div class="col-md-6 col-xs-6 col-sm-6"
                                                 data-ng-repeat="service in course.services">
                                                <div class="CourseIcons ">
                                                    <a href="javascript:void(0);" class="tooltip-1"
                                                       data-placement="top"
                                                       title="<%service.name%>">

                                                        <i data-ng-if="service.type=='house'"
                                                           class="icon_set_2_icon-115"></i>

                                                        <i data-ng-if="service.type=='transport'"
                                                           class="icon-flight"></i>

                                                        <i data-ng-if="service.type=='adviser'"
                                                           class="icon_set_1_icon-57"></i>

                                                        <i data-ng-if="service.type=='insurance'"
                                                           class=" icon-stethoscope"></i>

                                                    </a>
                                                </div>
                                                <div class="CourseIcons_D">
                                                    <span><%service.name%></span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <div class="price_list">
                                    <div>
                                        <span data-ng-if="course.offer_price">
                                            <sup>$</sup><%course.offer_price%>*
                                            <span class="normal_price_list"><%course.price%></span>
                                        </span>
                                        <span data-ng-if="!course.offer_price">
                                            <sup>$</sup><%course.price%><span
                                                    class="normal_price_list"></span>
                                        </span>

                                        <small>{{trans("courses.price_per_week")}}</small>
                                        <p>
                                            <a href="<%course.url%>"
                                               class="btn_1">{{trans("courses.btn_read_more")}}</a></p> <br>
                                        <div class="compare">
                <a href="#0" class="cd-add-to-cart" data-price="25.99">Add To Cart</a>
 
                                            <label><input type="checkbox" name="selected[]" value="<%course.id%>"> {{trans("courses.btn_compare")}}
                                            </label>

                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


        

</form>
                    <!-- End courses list -->

                    <div data-ng-if="!coursesList.data.length" class="alert alert-info">
                        <p>{{trans("courses.no_results_found")}}</p>
                    </div>

                    <!--End strip -->
                    <hr>

                    <div class="text-center">
                        {{--{!! $courses->links() !!}--}}
                    </div>
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
        {!! Form::close() !!}


    </div>

@stop
@section("styles")
    <link href="/assets/css/skins/square/grey.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">


@stop

@section("scripts")

    <!-- Map -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="/assets/js/map_hotels.js"></script>
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
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-grey',
                radioClass: 'iradio_square-grey'
            }).on(
                'ifToggled',
                function (e) {
                    $(e).trigger("change");
                }
            );

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