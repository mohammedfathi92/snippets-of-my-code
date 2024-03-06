@extends('frontend.layouts.master')
@section("content")

@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp

  {{-- <section class="header-video" id="search_container" style="max-height: 664px">
        <div id="hero_video"></div>
    </section><!-- End Header video --> --}}
    <!-- End section -->
    <!-- End section -->
    <div data-ng-controller="institutesFilterCtrl">
        <section class="header-video" id="search_container">
            <div id="hero_video">
                <div id="search">
                    {!! Form::open(['route'=>'institutes.index','method'=>"get",'id'=>"searchFiltersForm",'name'=>'searchFiltersForm']) !!}
                    <ul class="nav nav-tabs">
                        <li><a href="#" data-target="#quickSearch"
                                              data-toggle="tab">{{trans("main.tab_quick_search")}}</a></li>
                        <li class="active"><a href="#" data-target="#advancedSearch"
                               data-toggle="tab">{{trans("main.tab_advanced_search")}}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane" id="quickSearch">
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
                        </div><!-- End tab -->
                        <div class="tab-pane active" id="advancedSearch">
                            <h3>{{trans('main.title_advanced_search')}}</h3>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group" data-ng-init="getCountriesList()">
                                    <label>{{trans("courses.label_country")}}</label>
                                    <select class="form-control" name="country" id="top_filter_country_inst"

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
                                <select class="form-control" name="city" id="top_filter_city_inst"
                                        data-ng-model="filterData.city"
                                        data-ng-init="filterData.city='{{Request::input("city")}}' ">
                                    <option value="">{{trans("main.filters_select_city")}}</option>
                                    <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{Request::input("city")}}'"> <%city.name%>
                                    </option>
                                </select>
                            </div>


                        </div><!-- End row -->
                  <br>
                            <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_housing")}}</label>
                                    <select class="form-control" name="housing" id="top_filters_housing_inst"
                                            data-ng-model="filterData.housing"
                                            data-ng-init="filterData.housing='{{Request::input("housing")?:"y"}}'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>
                                    </select>
                                </div>
                            </div>
                              
                                 <div class="col-md-6">
                                <label>{{trans("main.filter_option_transporting")}}</label>
                                <select class="form-control" name="transporting" id="transporting_inst"
                                        data-ng-model="filterData.transporting"
                                        data-ng-init="filterData.transporting='{{Request::input("transporting")?:"n"}}'">
                                    <option value="y">{{trans("main.filter_yes_need")}}</option>
                                    <option value="n">{{trans("main.filter_no_need")}}</option>
                                </select>
                            </div>
                            
                                        
                            
                        </div> <!-- End row -->
<center>
   <br>
                        <div class="row">
                          
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label>{{trans("main.filter_option_insurance")}}</label>
                                    <select class="form-control" name="i" id="top_filters_insurance_inst"
                                            data-ng-model="filterData.insurance"
                                            data-ng-init="filterData.insurance='{{Request::input("insurance")}}'||'y'">
                                        <option value="y">{{trans("main.filter_yes_need")}}</option>
                                        <option value="n">{{trans("main.filter_no_need")}}</option>


                                    </select>
                                </div>
                            </div>

 

                        </div>
                        </center>
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


    <main data-ng-controller="favoriteCtrl" data-ng-init="getFavoritesInstitutes()">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_frontend_home")}}</a>
                    </li>
                    <li>{{trans("institutes.link_institutes")}}</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

    {{--<div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div>--}}
    <!-- End Map -->

        <div class="container margin_60" data-ng-controller="compareCtrl" data-ng-init="getCompareInstitutes()">

            <form action="" name="filterForm" id="filterForm" onsubmit="submitFilters()">
                <div class="row">
                    <aside class="col-lg-3 col-md-3">
                        {{--<p>
                            <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"
                               aria-controls="collapseMap">View on map</a>
                        </p>--}}

                        <div id="filters_col">
                            <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false"
                               aria-controls="collapseFilters" id="filters_col_bt"><i
                                        class="icon_set_1_icon-65"></i>{{trans("institutes.title_filters")}}
                                <i class="icon-plus-1 pull-right"></i></a>
                            <div class="collapse" id="collapseFilters">

                                <div class="filter_type">
                                    <h6>{{trans("courses.text_international_rating")}}</h6>
                                    <ul>

                                           <ul>


                                     <li ng-repeat="gRating in gRatings">
                                        <label><input type="checkbox" data-ng-model="gRating.selected" data-ng-change="gRatingAdd()"
                                                          name="global_rating[]"
                                                          value="<%gRating.stars%>"
                                                          data-ng-init="gRating.selected='{{Request::input("gRating")}}'"
                                                          ><span class="rating"><i
                                                            class="<% gRating.stars >= 1 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% gRating.stars >= 2 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% gRating.stars >= 3 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% gRating.stars >= 4 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% gRating.stars >= 5 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i></span>
                                     <!-- <% getlRatingsCount(lRating.stars) %> -->
                                                 </label>
                                        </li>

    
                                      </ul>
                                       

                                    </ul>
                                </div>
                                <div class="filter_type">
                                    <h6>{{trans("courses.text_locale_rating")}}</h6>
                                    <ul>


                                     <li ng-repeat="lRating in lRatings">
                                        <label><input type="checkbox" data-ng-model="lRating.selected" data-ng-change="lRatingAdd()"
                                                          name="local_rating[]"
                                                          value="<%lRating.stars%>"
                                                          data-ng-init="lRating.selected='{{Request::input("lRating")}}'"><span class="rating"><i
                                                            class="<% lRating.stars >= 1 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% lRating.stars >= 2 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% lRating.stars >= 3 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% lRating.stars >= 4 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i><i
                                                            class="<% lRating.stars >= 5 ? 'icon_set_1_icon-81 voted':'icon_set_1_icon-81'%>"></i></span>
                                     <!-- <% getlRatingsCount(lRating.stars) %> -->
                                                 </label>
                                        </li>

    
                                      </ul>

                                </div>
                                <div class="filter_type">
                                    <h6>{{trans("institutes.label_location_type")}}</h6>
                                    <ul>
                                        <li ng-repeat="nearPlace in nearPlaces">
                                            <label ng-show="wLocale == 'ar'"><input type="checkbox" data-ng-model="nearPlace.selected" data-ng-change="nearPlaceAdd()"
                                             value="<%nearPlace.pType%>" name="location_type[]" data-ng-init="'{{Request::input("lRating")}}'"><%nearPlace.name_ar%>
                                            </label>

                                            <label ng-show="wLocale == 'en'"><input type="checkbox" data-ng-model="nearPlace.selected" data-ng-change="nearPlaceAdd()"
                                             value="<%nearPlace.pType%>"><%nearPlace.name_en%>
                                            </label>


                                        </li>
                                        
                                    </ul>
                            </div>

                            </div><!--End collapse -->
                        </div><!--End filters col-->
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
                                        <select name="sort" id="sort_rating" data-ng-model="filterData.sort"
                                            data-ng-init="filterData.sort='{{Request::input("sort")}}'">
                                            <option value="">{{trans("institutes.option_select_sort_by")}}</option>
                                            <option value="lrh" {{Request::get('sort')=='lrh'?"selected":""}}>{{trans("institutes.sort_option_by_higher_locale_rate")}}</option>
                                            <option value="lrl" {{Request::get('sort')=='lrl'?"selected":""}}>{{trans("institutes.sort_option_by_lower_locale_rate")}}</option>
                                            <option value="irh" {{Request::get('sort')=='irh'?"selected":""}}>{{trans("institutes.sort_option_by_higher_international_rate")}}</option>
                                            <option value="irl" {{Request::get('sort')=='irl'?"selected":""}}>{{trans("institutes.sort_option_by_lower_international_rate")}}</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <button  type="submit" form="compare" class="btn_1 medium compare">{{trans("institutes.compare")}}</button> --}}

                              {{--  <div class="col-md-6 col-sm-6 hidden-xs text-right">
                                    <a href="#" onclick="updateQueryString('view','grid')" class="bt_filters"><i
                                                class="icon-th"></i></a> <a
                                            href="#" onclick="updateQueryString('view','list')" class="bt_filters"><i
                                                class=" icon-list"></i></a>
                                </div> --}}
                            </div>
                        </div>

                     {{--   @if($view=="grid")
                            @include("frontend.institutes.view.grid")
                        @else
                            @include("frontend.institutes.view.list")
                        @endif --}}

                     <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s" ng-cloak data-ng-repeat="institute in institutesList.data">

                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="ribbon_3" ng-if="institute.featured"><span>{{trans("courses.featured_word")}}</span></div>
                                                        <div class="my_wishlist" ng-if="'{{Auth::check()}}' && favoritesInstitutes.indexOf(institute.id) < 0">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href href ng-click="favorite('institutes', institute.id)">+<span
                                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                                        </div>

                                                          <div class="my_wishlist_remove" ng-if="'{{Auth::check()}}' && favoritesInstitutes.indexOf(institute.id) > -1">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href href ng-click="unfavorite('institutes', institute.id)">-<span
                                                                        class="tooltip-content-flip"><span
                                                                            class="tooltip-back">{!! trans("main.tip_remove_favorite") !!}</span></span></a>
                                                        </div>

                                                        <div class="my_wishlist" ng-if="'{{Auth::check()}}' < 1">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href="javascript:void(0);">+<span
                                                                        class="tooltip-content-flip" style="background-color: #46bf5b;"><span
                                                                            class="edit-tooltip-back">{!! trans("main.tip_add_favorite") !!}</span></span></a>
                                                        </div>

                                                           <div class="my_logo">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href="javascript:void(0);"><img id="img_not_zoom" class="logo-grid-circle" data-ng-src="<%institute.logo_path%>"
                                                     alt="" width="45" height="45"></a>
                                                        </div>
                                                       

                                      <!--   <div class="logo_img">
                                              <img class="logo_img_circ" data-ng-src="<%institute.logo_path%>"
                                                     alt="" width="80" height="80" >
                                        </div> -->
                                                       
                                        <div class="img_list">
                                            <a href="<%institute.url%>">
                                               
                                                <img data-ng-src="<%institute.photo_path%>"
                                                     alt="">

                                        <div class="short_info">
                                            <div class="short_info_content"><i class="icon_set_1_icon-41" style="right: 5px"></i><span style="font-size: 12px;"><%institute.country_name%> - <%institute.city_name%></span></div>
                                                

                                        </div>


                                              
                                            </a>
                                        </div>
                                                    </div>
                                                    <div class="clearfix visible-xs-block"></div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <div class="tour_list_desc">

                                                       <div class="row">  <div class="col-md-8"><h3><a href="<%institute.url%>"><%institute.name%></a> 

                                                        <a {{-- class="tooltip_flip tooltip-effect-1" --}}
                                                               href ng-click="addToCompare(institute.id)"><i class=" icon-balance-scale"></i><span
                                                                        class="tooltip-content-flip" style="background-color: #46bf5b;">{{--<span
                                                                            class="edit-tooltip-back">{!! trans("main.tip_add_compare") !!}</span>--}}</span></a> 

                                                                           </h3>
                                                        </div> <div class="col-md-4"> 

                                                           <ul class="add_info" data-ng-if="institute.getServices.length">

                                                <li data-ng-repeat="service in institute.getServices">
                                                    <div class="tooltip_styled tooltip-effect-4">
                                                        <span class="tooltip-item">
                                                            <i data-ng-if="service.type=='house'"
                                                               class="icon_set_2_icon-115" style="color: #e14d67;"></i>

                                                        <i data-ng-if="service.type=='transport'"
                                                           class="icon-flight" style="color: #e14d67;"></i>

                                                        <i data-ng-if="service.type=='advisor'"
                                                           class="icon_set_1_icon-57" style="color: #e14d67;"></i>

                                                        <i data-ng-if="service.type=='insurance'"
                                                           class=" icon-stethoscope" style="color: #e14d67;"></i></span>
                                                        <div class="tooltip-content">
                                                            <h4><%service.name%></h4>
                                                            <p><%service.description%></p>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div>

                                            
                                        </div>
                                            <p> <% (institute.short_description.length
                                                >100)?institute.short_description.substring(0,400)+'...':institute.short_description
                                                %> </p>
                                           <hr>

                       <div class="row">
                        <div class="rating col-md-6 col-sm-12" data-toggle="tooltip"
                             title="{{trans("courses.text_locale_rating")}}">
                             <small>( {{trans("courses.text_locale_rating")}} )</small>
                            
                            <i class="<% institute.locale_rate >=1?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.locale_rate >=2?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.locale_rate >=3?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.locale_rate >=4?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.locale_rate >=5?'icon-star voted':'icon-star-empty'%>"></i>
                        </div>

                         <div class="rating col-md-6 col-sm-12" data-toggle="tooltip"
                             title="{{trans("courses.text_international_rating")}}">
                             <small>( {{trans("courses.text_international_rating")}} )</small>
                            
                            <i class="<% institute.international_rate >=1?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.international_rate >=2?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.international_rate >=3?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.international_rate >=4?'icon-star voted':'icon-star-empty'%>"></i>
                            <i class="<% institute.international_rate >=5?'icon-star voted':'icon-star-empty'%>"></i>
                        </div>
                       
                    </div>
                   

                                               

                                                        </div>
                                                    </div>
                                                   {{-- <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <div class="price_list">
                                                            <div><sup>$</sup>{{$course->price}}*<span
                                                                        class="normal_price_list">{{$course->price}}</span>
                                                                <small>*{{trans("courses.price_per_week")}}</small>
                                                                <p>
                                                                    <a href="{{route("course.details",['id'=>$course->id,'slug'=>$course->{"name:en"}])}}"
                                                                       class="btn_1">Details</a>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div> --}}
                                                </div>
                                               
                                           
                    </div> <!--End strip --> 


                    </div>
                    <!-- End col lg-9 -->
                </div>
            </form>
            <!-- End row -->



       <div ng-cloak class="cd-cart-container" ng-class="{empty:!comparisonItems.length}">

           <!--  <div ng-cloak class="cd-cart-container"> -->

                <a href class="cd-cart-trigger" ng-click="openCartBtn()" style="z-index: 20000; opacity: 0.9;">

                   
                    <ul class="count"> <!-- cart items count -->
                        <li><%comparisonItems.length%></li>
                        <li><%comparisonItems.length-1%></li>
                    </ul> <!-- .count -->
                    
                </a>

                <div class="cd-cart">
                    <div class="wrapper">
                        <header>
                            <h2>{{trans("institutes.compare")}}</h2>
    {{--<span class="undo">Item removed. <a href="javascript:void(0);">Undo</a></span>--}}
                        </header>

                        <div class="body">
                            <ul id="add_cont">
                                <li class="product" ng-repeat="item in comparisonItems">
                                    
                                    
                                    <div class="product-image"><a href="<%item.url%>" target="_blanck"><img ng-src="<%item.photo_path%>"
                                                alt="<%item.name%>"></a>
                                    </div>
                                    <div class="product-details"><h3><a href="<%item.url%>" target="_blanck"><% item.name %></a></h3>
                                        <div class="actions"><a href class="delete-item" ng-click="removeFromCompare(item.id)">{{trans("institutes.btn_compare_delete")}}</a>
                                           {{-- <div class="quantity"><label for="cd-product-'+ productId +'">courses
                                                    No.:</label><span
                                                        class="select"></span></div> --}}
                                        </div>
                                    </div>
                                    
                                  
                                </li>
                            </ul>
                        </div>
@php
$compareItems = [];
if(Session::has('compare')){
$compareItems = Session::get('compare')->pluck('id')->toArray();

}
@endphp
 

                        <footer>
                            <a href="/actions/compare/list?list=<%comparisonItemsLink%>" class="checkout btn" target="_blanck"><em>{{trans("institutes.btn_compare_now")}}
                                    <span><%comparisonItems.length%></span></em></a>
                        </footer>
                    </div>
                </div> <!-- .cd-cart -->
            </div> <!-- cd-cart-container --> 


        </div>
        <!-- End container -->
    </main>
    <!-- End main -->
    </div>

@stop
@section("styles")
    <link rel="stylesheet" type="text/css" href="/compare/css/style.css"> 
@endsection



