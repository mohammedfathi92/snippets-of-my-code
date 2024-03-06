@extends("frontend.layouts.master")
@section("page_title")

@endsection
@section("content")

@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
                   

@endphp

  {{--  <section class="header-video" data-ng-controller="coursesFilterCtrl" id="search_container" style="max-height: 1349px">
        <div id="hero_video">
            <div id="search">
                {!! Form::open(['route'=>'courses.index','method'=>"get",'id'=>"filtersForm",'name'=>'filtersForm']) !!}
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#" data-target="#quickSearch"
                                          data-toggle="tab">{{trans("courses.tab_quick_search")}}</a></li>
                    <li><a href="#" data-target="#advancedSearch"
                           data-toggle="tab">{{trans("main.btn_advanced_search")}}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="quickSearch">
                        <h3>{{trans("courses.title_quick_search")}}</h3>
                        <div class="row">
                            <div class="input-group">
                                  <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i
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
                                        <option value="" disabled>{{trans("courses.filters.select_country")}}</option>
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
                                    <label>Course type</label>
                                    <select class="form-control" name="category" id="top_filters_course_category"
                                            data-ng-model="filterData.category"
                                            data-ng-init="filterData.category='{{Request::input("category")}}'">
                                       <option value="">{{trans("courses.filters.select_course_category")}}</option>
                                    <option data-ng-repeat="category in coursesCategories" value="<%category.id%>"
                                            data-ng-selected="category.id=='{{Request::input("category")}}'"> <%category.name%>
                                    </option>
                                    </select>
                                </div>
                            </div>
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
                        </div>
                            <div class="row">
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
                                                   name="hWeeks" style="right: 1px;">
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
                        <input type="hidden" name="scroll" value="true">
                        <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @php
        $video_url = str_replace(".mp4","", \Corsata\Setting::get("header_video"));
        @endphp
        <img src="" alt="Image" class="header-video--media" data-video-src=""
             data-teaser-source='{{\Corsata\Setting::get("header_video")? "/video/".$video_url: "#"}}' data-provider="Youtube" data-video-width="854"
             data-video-height="480">
    </section> --}} 

<section class="header-video" style="max-height: 664px; background: url({{Storage::url(Settings::get("header_image"))."?size=1349,758"?:'/assets/img/slide_hero.jpg'}});">
            <div id="hero_video">
                <div class="intro_title">

                    <h3 class="animated fadeInDown">{!!\Corsata\Setting::get('home_slider_title_'.$locale) !!}
</h3>
                    <p class="animated fadeInDown">{!!\Corsata\Setting::get('home_slider_description_'.$locale) !!}</p>
                  {{--   <a href="#" class="animated fadeInUp button_intro">View Tours</a>
                    <a href="#" class="animated fadeInUp button_intro outline hidden-sm hidden-xs">View Tickets</a>
                    <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video animated fadeInUp button_intro outline">Play video</a> --}}
                </div>
            </div>
            <div id="search_bar_container" style="z-index:9999">
                <div class="container">
                    <div class="search_bar">
                        
                        <center style="margin-bottom:5px"><button class="button_intro outline" data-toggle="modal" data-target="#advancedSearchModal" style="font-size: 18px;">{{trans("main.btn_advanced_search")}}</button></center>
                        <div class="row">
                            {!! Form::open(['route'=>'courses.index','method'=>"get",'id'=>"filtersForm",'name'=>'queckSearchForm']) !!}
                            <div class="input-group">
                                  <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i
                                                class="icon-search"></i> {{trans("main.btn_quick_search")}}</button>
                                  </span>
                                <input type="text" name="q" class="form-control" value="{{Request::get("q")}}"
                                       placeholder="{{trans("main.holder_quick_search")}}">
                            </div>
                            {!! Form::close() !!}
                        </div>

 



                    </div>

                    <!-- End search bar-->
                </div>
            </div>
            <!-- /search_bar-->
            @php
            $header_video = \Corsata\Setting::get('header_video');
            if($header_video){
            $new_header_video = str_replace(".mp4","","$header_video");

             }

            @endphp
            <img src="" alt="Image" class="header-video--media" data-video-src="" data-teaser-source= @if($header_video) "video/{{$new_header_video}}" @else "/assets/video/paris" @endif data-provider="Youtube" data-video-width="854" data-video-height="480">

        </section>


        <!-- End Header video -->


    <!-- End hero -->
    <main data-ng-controller="favoriteCtrl">

        <div class="container margin_60">
            @if(isset($topCountries) && $topCountries->count())
                <div class="main_title">
                    <h2>{!! trans("countries.title_top_countries") !!}</h2>
                    <p>{{ trans("countries.text_top_countries") }}</p>
                </div>
                <div class="row">
                    @foreach($topCountries as $topCountry)
                        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                            <!-- country -->
                            <div class="tour_container">

                                <div class="img_container">
                                    <a href="{{route("countries.cities",['code'=>$topCountry->code,'slug'=>str_slug($topCountry->{"name:en"})])}}">
                                        <img src="{{$topCountry->photo?url("files/{$topCountry->photo}?size=358,239"):'/assets/img/no-image-available.png'}}"
                                             class="img-responsive" with="358" height="239" alt="{{$topCountry->name}}">

                                    </a>
                                </div>
                                <div class="tour_title">
                                    <h3>
                                        <a href="{{route("countries.cities",['code'=>$topCountry->code,'slug'=>str_slug($topCountry->{"name:en"})])}}"><strong>{{$topCountry->name}}</strong></a>
                                    </h3>


                                </div>
                            </div>

                        </div>
                        <!-- End col-md-4 -->
                        <!-- End country -->
                    @endforeach
                </div>
                <!-- End row -->


                <p class="text-center add_bottom_30">
                    <a href="{{url('countries')}}" class="btn_1 medium"><i
                                class="icon-eye-7"></i>{{trans("countries.btn_show_all")}} </a>
                </p>
            @endif

        </div>

            <section class="promo_full">
            <div class="promo_full_wp magnific">
                <div>
                    {!!\Corsata\Setting::get($locale.'_usage_steps') !!}
                    
                    <a href="{{\Corsata\Setting::get("steps_video_youtube")}}" class="video"><i class="icon-play-circled2-1"></i></a>
                </div>
            </div>
        </section>

        <!-- End section -->
            @if(isset($featuredCourses) && $featuredCourses->count())
            <div class="container margin_60">
                <div class="main_title">
                    <h2>{!! trans("courses.title_featured_courses") !!}</h2>
                    <p>{{ trans("courses.text_featured_courses") }}</p>
                </div>
                <div class="row" data-ng-init="getFavoritesCourses()">
                    @foreach($featuredCourses as $featuredCourse)
                        <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.3s">
                            <div class="tour_container">

                                @if($featuredCourse->featured)
                                    <div class="ribbon_3"><span>{{trans("courses.featured_word")}}</span></div>
                                @endif
                                <div class="img_container">
                                    <a href="{{route("course.details",["id"=>$featuredCourse->id,'slug'=>str_slug($featuredCourse->{"name:en"})])}}">
                                        <img  src="{{$featuredCourse->photo?url("files/$featuredCourse->photo?size=800,533"):"/assets/img/noimagefound.jpg"}}"
                                             width="800" height="533" class="img-responsive"
                                             alt="$featuredCourse->name" >
                                       @if($featuredCourse->offer_price > 0)      
                                         <div class="badge_save">{{trans('main.icon_offer_save')}}<strong>{{round(($featuredCourse->offer_price/$featuredCourse->price)*100)}} %</strong></div>
                                        @endif     


                                        <div class="short_info hotel">
                                           @if($featuredCourse->institute->logo) <i style="margin: 0px 5px 0px 5px;"> <img id="img_not_zoom" src="{{url("files/".$featuredCourse->institute->logo."?size=27,27")}}"
                                             width="27" height="27" class="logo-grid-circle"
                                             alt="{{$featuredCourse->institute->name}}"></i>
                                             @else
                                             <i class="icon_set_1_icon-1" style="font-size: 20px; border: solid #fff 1px; border-radius: 50%; padding: 4px 1px 1px 1px; "></i>
                                             @endif
                                             <strong>{{$featuredCourse->institute->name}}</strong><span
                                                    class="price" style="font-size: 20px;"><sup
                                                        title="{{$currencyName}}" style="font-size: 10px;">{{$currencyCode}}</sup>

                                                        @if($featuredCourse->offer_price > 0)
                                                        {{round($currencyRate * $featuredCourse->offer_price)}}
                                                        <strike class="old_course_price" style="font-size: 12px; color: #fff;"> {{round($currencyRate * $featuredCourse->price)}}</strike>
@else

  {{round($currencyRate * $featuredCourse->price)}}

@endif
                                                    </span>
                                                

                                        </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <h3>
                                        <strong><a href="{{route("course.details",["id"=>$featuredCourse->id,'slug'=>str_slug($featuredCourse->{"name:en"})])}}">{{$featuredCourse->name}}</a></strong>
                                    </h3>
                                    <div class="rating" data-toggle="tooltip"
                                         title="{{trans("courses.text_locale_rating")}}">
                                        <i class="{{$featuredCourse->locale_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->locale_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->locale_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->locale_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->locale_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                                        <small>({{trans("courses.text_locale_rating")}})</small>
                                    </div>
                                    <div class="rating" data-toggle="tooltip"
                                         title="{{trans("courses.text_international_rating")}}">
                                        <i class="{{$featuredCourse->international_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->international_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->international_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->international_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                                        <i class="{{$featuredCourse->international_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                                        <small>({{trans("courses.text_international_rating")}})</small>
                                    </div>
                                    <!-- end rating -->

@if (Auth::check())
                            <div class="edit_wishlist_remove" ng-if="favoritesCourses.indexOf({{$featuredCourse->id}}) > -1">
                                <a class="tooltip_flip tooltip-effect-1" href ng-click="unfavorite('courses', {{$featuredCourse->id}})">-<span class="tooltip-content-flip"><span class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                            </div>
                            
                          
                                    
                           <div class="wishlist" ng-if="favoritesCourses.indexOf({{$featuredCourse->id}}) < 0">
                                <a class="tooltip_flip tooltip-effect-1" href ng-click="favorite('courses', {{$featuredCourse->id}})">+<span class="tooltip-content-flip"><span class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                            </div>
                            
 @else
 <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" data-toggle="modal" href="#checkLoginModal">+<span class="tooltip-content-flip"><span class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                            </div>
 
 @endif                           
                            <!-- End wish list-->
                                    <!-- End wish list-->
                                </div>
                            </div>
                            <!-- End box tour -->
                        </div>
                        <!-- End col-md-4  Courses-->
                    @endforeach
                </div>
                <!-- End Row -->
                <p class="text-center nopadding">
                    <a href="{{url("courses")}}" class="btn_1 medium"><i
                                class="icon-eye-7"></i>{{trans("courses.btn_show_all_courses")}}</a>
                </p>
                <hr>
                 </div> <!-- End container (1) -->
            @endif

       

        <div class="container margin_60">
            @if($homeInstitutes->count())

                <div class="main_title">
                    <h2>{!! trans("institutes.title_recommended_institutes") !!}</h2>
                    <p>{{trans("institutes.text_recommended_institutes")}}</p>
                </div>

                <div class="row"  data-ng-init="getFavoritesInstitutes()">
      @foreach($homeInstitutes as $institute)
                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                    @if($institute->featured)
                         <div class="ribbon_3"><span>{{trans("courses.featured_word")}}</span></div>
                                @endif
                    <div class="tour_container">
                        <div class="img_container">
                             <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}">
                                        <img src="{{url("files/{$institute->photo}?size=358,239&encode=jpg")}}"
                                             class="img-responsive" alt="{{$institute->name}}">

                                             <div class="short_info hotel">
                                            <i class="icon_set_1_icon-41"></i><strong>{{$institute->country->name." - ".$institute->city->name}}</strong>
                                                

                                        </div>

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
                            @if (Auth::check())
                            <div class="edit_wishlist_remove" ng-if="favoritesInstitutes.indexOf({{$institute->id}}) > -1">
                                <a class="tooltip_flip tooltip-effect-1" href ng-click="unfavorite('institutes', {{$institute->id}})">-<span class="tooltip-content-flip"><span class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                            </div>
                            
                          
                                    
                           <div class="wishlist" ng-if="favoritesInstitutes.indexOf({{$institute->id}}) < 0">
                                <a class="tooltip_flip tooltip-effect-1" href ng-click="favorite('institutes', {{$institute->id}})">+<span class="tooltip-content-flip"><span class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                            </div>
                            
 @else
 <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" data-toggle="modal" href="#checkLoginModal">+<span class="tooltip-content-flip"><span class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                            </div>
 
 @endif
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                  @endforeach
                <!-- End col-md-4 -->
                </div>
                <!-- End row -->
                <p class="text-center add_bottom_30">
                    <a href="{{url("institutes")}}" class="btn_1 medium"><i
                                class="icon-eye-7"></i>{{trans("institutes.btn_show_more_institutes")}}</a>
                </p>
                <hr>
                <!-- End Courses -->
        @endif


        <!-- News part -->

        </div>
        <!-- End container -->

    </main>

@stop

@section("styles")

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css"
          href="/assets/rev-slider-files/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/css/settings.css">

    <!-- REVOLUTION LAYERS STYLES -->
    <style>
        .tp-caption.NotGeneric-Title,
        .NotGeneric-Title {
            color: rgba(255, 255, 255, 1.00);
            font-size: 70px;
            line-height: 70px;
            font-weight: 800;
            font-style: normal;
            text-decoration: none;
            background-color: transparent;
            border-color: transparent;
            border-style: none;
            border-width: 0px;
            border-radius: 0 0 0 0px
        }

        .tp-caption.NotGeneric-SubTitle,
        .NotGeneric-SubTitle {
            color: rgba(255, 255, 255, 1.00);
            font-size: 13px;
            line-height: 20px;
            font-weight: 500;
            font-style: normal;
            text-decoration: none;
            background-color: transparent;
            border-color: transparent;
            border-style: none;
            border-width: 0px;
            border-radius: 0 0 0 0px;
            letter-spacing: 4px
        }

        .tp-caption.NotGeneric-Icon,
        .NotGeneric-Icon {
            color: rgba(255, 255, 255, 1.00);
            font-size: 30px;
            line-height: 30px;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0);
            border-color: rgba(255, 255, 255, 0);
            border-style: solid;
            border-width: 0px;
            border-radius: 0px 0px 0px 0px;
            letter-spacing: 3px
        }

        .tp-caption.NotGeneric-Button,
        .NotGeneric-Button {
            color: rgba(255, 255, 255, 1.00);
            font-size: 14px;
            line-height: 14px;
            font-weight: 500;
            font-style: normal;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0);
            border-color: rgba(255, 255, 255, 0.50);
            border-style: solid;
            border-width: 1px;
            border-radius: 0px 0px 0px 0px;
            letter-spacing: 3px
        }

        .tp-caption.NotGeneric-Button:hover,
        .NotGeneric-Button:hover {
            color: rgba(255, 255, 255, 1.00);
            text-decoration: none;
            background-color: transparent;
            border-color: rgba(255, 255, 255, 1.00);
            border-style: solid;
            border-width: 1px;
            border-radius: 0px 0px 0px 0px;
            cursor: pointer
        }

        .promo_full {
    height: auto;
    background: url(/images/institute-page-header.jpg) no-repeat center center;
    background-attachment: fixed;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    position: relative;


}



    </style>

    <!-- SPECIFIC CSS -->
    <link href="/assets/css/skins/square/grey.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->



@stop
@section("scripts")

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

   {{-- <script src="/assets/js/notify_func.js"></script> --}}

    <!-- Specific scripts -->
   {{-- <script src="/assets/js/icheck.js"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });
    </script> --}}
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>
    <script src="/assets/js/jquery.ddslick.js"></script>
    <script src="/assets/js/modernizr.js"></script>
    <script>
        $("select.ddslick").each(function () {
            $(this).ddslick({
                showSelectedHTML: true
            });
        });
    </script>


@stop



