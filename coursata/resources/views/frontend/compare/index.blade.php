<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" data-ng-app="frontendApp">

<head>
    <meta charset="utf-8">
    @yield('meta')
    <meta name="author" content="php.Mohammedfathi@gmail.com">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#e04f67">
    <meta name="description" content="{{$meta_description}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="author" content="Mohammed Zidan">
    <title>{{$title}}</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{Storage::url(Settings::get("favicon"))}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{Storage::url(Settings::get("favicon"))}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="{{Storage::url(Settings::get("favicon"))."?size=72,72"}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{Storage::url(Settings::get("favicon"))."?size=114,114"}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{Storage::url(Settings::get("favicon"))."?size=114,114"}}">

    <!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Amiri|Lato:300,400|Montserrat:400,400i,700,700i"
          rel="stylesheet">
   

    <!-- BASE CSS -->
    @if(LaravelLocalization::getCurrentLocaleDirection()=='rtl')
        <link href="/assets/css-rtl/base.css" rel="stylesheet">
        <!-- Radio and check inputs -->
        <link href="/assets/css-rtl/skins/square/grey.css" rel="stylesheet">

        <!-- Range slider -->
        <link href="/assets/css-rtl/ion.rangeSlider.css" rel="stylesheet">
        <link href="/assets/css-rtl/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    @else
        <link href="/assets/css/base.css" rel="stylesheet">
        <!-- Radio and check inputs -->
        <link href="/assets/css/skins/square/grey.css" rel="stylesheet">

        <!-- Range slider -->
        <link href="/assets/css/ion.rangeSlider.css" rel="stylesheet">
        <link href="/assets/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    @endif

<!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/assets/rev-slider-files/css/settings.css">
    <link rel="stylesheet" type="text/css" href="/assets/css-rtl/follow-btn.css">

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



 .my-layer-img {
    background-color: rgba(0, 0, 0, 0.45);
    top: 0;
    left: 0;
    width: 100%;
   /*height: 100%;*/
    
}

.logo-grid-circle {
  border-radius: 50%;
  border: solid #fff 1px;
}



#img_not_zoom:hover{
    -webkit-transform:scale(1.2);
    transform:scale(1.2);
}
#img_not_zoom{
    -webkit-transform:scale(1.2);
    transform:scale(1.2);
    -webkit-transition: all 0s ease;
    transition: all 0s ease;
}

.title-header-link:link {
    color: #fff;
}

.title-header-link:visited {
    color: #fff;
}
.title-header-link:hover {
    color: #51bce6;
}

.title-header-link:active {
    color: #fff;
}

.modal-backdrop {
  z-index: -1;
}


    </style>

    <link rel="stylesheet" href="/compare/table/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="/compare/table/css/style.css"> <!-- Resource style -->
    <script src="/compare/table/js/modernizr.js"></script> <!-- Modernizr -->



@php
$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp


    <div class="clearfix"></div>
    <!-- main content -->
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("courses")}}">{{trans("courses.link_courses")}}</a></li>
                    <li>
                        <a href="#"></a>
                    </li>
                    <li></li>
                </ul>
            </div>
        </div>
        <!-- End Position -->
        <!-- End Map -->
        <div class="container margin_60">
        <input type="hidden" value=""/>

            <div class="row">
                <div class="col-md-8" id="single_tour_desc">

                    <div class="row" data-ng-if="course">

                        <!-- Map button for tablets/mobiles -->
 <div class="cd-products-table">
                        <div class="features">
                            <div class="top-info">{{trans("compare.text_model")}}</div>
                            <ul class="cd-features-list">
                                <li>{{trans("compare.label_institute")}}</li>
                                <li>{{trans("compare.text_country")}}</li>
                                <li>{{trans("compare.text_city")}}</li>
                                <li>{{trans("compare.text_possition")}}</li>
                                <li>{{trans("compare.text_locale_rating")}}</li>
                                <li>{{trans("compare.text_international_rating")}}</li>
                                <li>{{trans("compare.label_insurance")}}</li>
                                <li>{{trans("compare.label_house")}}</li>
                                <li>{{trans("compare.label_transport")}}</li>
                                <li>{{trans("compare.label_courses_num")}}</li>
                                <li>{{trans("compare.label_featured")}}</li>
                            </ul>
                        </div> <!-- .features -->


                        <div class="cd-products-wrapper">
                            <ul class="cd-products-columns">
                                @foreach ($data as $row)

                                @php

                                $institute = \Corsata\Institute::find($row['id']);
                                
                                @endphp
                                    <li class="product">
                                        <div class="top-info">
                                            <div class="check"></div>
                                            <img src="{{url("files/{$institute->photo}?size=200,150")}}"
                                                 alt="{{$institute->name}}">
                                            <!-- <h3>{{$institute->name}}</h3> -->
                                        </div> <!-- .top-info -->
                                    

                                        <ul class="cd-features-list">
                                            <li>{{$institute->name}}</li>

                                            <li>

                                                {{$institute->country?$institute->country->name:""}}

                                               
                                            </li>
                                            <li>

                                                {{$institute->city?$institute->city->name:""}}

                                               
                                            </li>
                                            
                                            <li>

                                                @if($institute->location_type == 1)

                                                {{trans_choice("institutes.institute_location_type_option",1)}}

                                                @elseif($institute->location_type == 2)

                                                {{trans_choice("institutes.institute_location_type_option",2)}}

                                                @elseif($institute->location_type == 3)

                                                {{trans_choice("institutes.institute_location_type_option",3)}}

                                                @elseif($institute->location_type == 4)

                                                {{trans_choice("institutes.institute_location_type_option",4)}}

                                                @elseif($institute->location_type == 5)

                                                {{trans_choice("institutes.institute_location_type_option",5)}}

                                                @elseif($institute->location_type == 6)

                                                {{trans_choice("institutes.institute_location_type_option",6)}}

                                                @else($institute->location_type == 7)

                                                {{trans_choice("institutes.institute_location_type_option",7)}}

                                                @endif
                                               
                                            </li>
                                            <li class="rate">
                                                <span>{{($institute->local_rate?$institute->local_rate:'---')}}</span></li>
                                            <li class="rate">
                                                <span>{{($institute->international_rate?$institute->international_rate:'---')}}</span>
                                            </li>
                                            <li>{{($institute->services()->where('type', 'insurance')? trans('compare.label_yes'):'---')}}</li>
                                            <li>{{($institute->services()->where('type', 'house')? trans('compare.label_yes'):'---')}}</li>
                                            <li>{{($institute->services()->where('type', 'transport')? trans('compare.label_yes'):'---')}}</li>
                                            <li>{{$institute->courses()->count()}}</li>
                                           
                                            <li>{{($institute->featured?"&#9989;":'---')}}</li>
                                        </ul>
                                    </li> <!-- .product -->
                                @endforeach
                            </ul> <!-- .cd-products-columns -->
                        </div> <!-- .cd-products-wrapper -->

                        <ul class="cd-table-navigation">
                            <li><a href="#0" class="prev inactive">Prev</a></li>
                            <li><a href="#0" class="next">Next</a></li>
                        </ul>
                    </div> <!-- .cd-products-table -->
                   


                        <!-- End row  -->

                    </div>

                    <!-- Services Courses  -->
                    <!-- Housing -->
<br>
           

                    <br>
                   


                </div>


                <!--End  single_tour_desc-->

            </div>
            <!--End row -->
        </div>
        <!--End container -->



        <div id="overlay"></div>
        <!-- Mask on input focus -->

    </main>



<footer class="">
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-sm-3">
                <h3>{{trans('main.footer_need_help')}}</h3>
                <a href="tel://"{{Settings::get("help_phone")?:"123456789"}} id="phone">{{Settings::get("help_phone")?:"123456789"}}</a>
                <a href="mailto:{{Settings::get("help_email")?:"info@example.com"}}" id="email_footer">{{Settings::get("help_email")?:"info@example.com"}}</a>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>{{\Corsata\Menu::where('position','footer1')->first()->title}}</h3>
                <ul>
                    <li> {!! menu("footer1") !!}</li>
                   
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>{{\Corsata\Menu::where('position','footer2')->first()->title}}</h3>
                <ul>
                    <li> {!! menu("footer2") !!}</li>
                </ul>
            </div>



            <div class="col-md-2 col-sm-3">
                <h3>{{trans('main.footer_settings')}}</h3>
                <div class="styled-select">
                    <select class="form-control" name="lang" id="lang" onchange="if (this.value) window.location.href=this.value">
                        @php
                        $currentLocal = LaravelLocalization::getCurrentLocale();
                        @endphp
                         @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                         <option value="{{LaravelLocalization::getLocalizedURL($localeCode) }}" {{$localeCode == $currentLocal? 'selected':''}}>
                           {{ $properties['native']}}</option>  

                         @endforeach
                        
                    </select>
                </div>


                <div class="styled-select">
                    <select class="form-control" name="currency" id="currency" onchange="if (this.value) window.location.href=this.value">
                        @if(\Corsata\Currency::all())
                        @foreach(\Corsata\Currency::all() as $currency)
                        <option value="{{url('/setCurrency/'.$currency->code)}}"  {{$currency->code == $currencyCode? 'selected' :''}} >{{$currency->name}}</option>
                        @endforeach
                        @endif
                        
                    </select>
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="{{Settings::get("facebook")?:'#'}}"><i class="icon-facebook"></i></a></li>
                        <li><a href="{{Settings::get("twitter")?:'#'}}"><i class="icon-twitter"></i></a></li>
                        {{-- <li><a href="{{Settings::get("googleplus")?:'#'}}"><i class="icon-google"></i></a></li> --}}
                        <li><a href="{{Settings::get("instagram")?:'#'}}"><i class="icon-instagram"></i></a></li>
                       {{-- <li><a href="{{Settings::get("pinterest")?:'#'}}"><i class="icon-pinterest"></i></a></li>
                        <li><a href="{{Settings::get("vimeo")?:'#'}}"><i class="icon-vimeo"></i></a></li> --}}
                        <li><a href="{{Settings::get("youtube")?:'#'}}"><i class="icon-youtube-play"></i></a></li>
                        <li><a href="{{Settings::get("linkedin")?:'#'}}"><i class="icon-linkedin"></i></a></li>
                        {{-- <li><a href="{{Settings::get("snapchat")?:'#'}}"><i class="icon-youtube-play"></i></a></li> --}}
                    </ul>
                    <p>© Coursata.com 2018</p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

        <!-- Modal -->
  <div class="modal fade" id="checkLoginModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="icon-warning-1" style="color: #f90"></i>{{trans('auth.msg_login_to_countinue')}}</h4>
        </div>
        <div class="modal-body">
<center><a href="" class="btn_1 medium green" style="margin: 10px">{{trans('auth.login')}}</a>
          <a href="" style="margin: 10px" class="btn_1 medium">{{trans('auth.register')}}</a></center>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('main.btn_close')}}</button>
        </div>
      </div>
      
    </div>
  </div>


<!-- Modal Single room-->
<div class="modal fade" id="advancedSearchModal" tabindex="-1" role="dialog" aria-labelledby="modal_single_room" aria-hidden="true" style="z-index:20000">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="advancedSearchModal" style="text-align: center; color: #e04f67; font-weight: bold;">{{trans('main.title_advanced_search')}}</h4>
      </div>
      <div class="modal-body">
      <div data-ng-controller="coursesFilterCtrl">

             
                       

     <!--  <div class="row">
          <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>اختر نوع البحث</label>
                                    <select class="form-control" name="searchType" id="top_filter_search_type"

                                            data-ng-model="searchType"
                                           >
                                        <option value="institutes" selected>
                                            Search in institutes 

                                        </option>
                                        <option value="courses">
                                            search in Courses
                                        </option>
                                        

                                    </select>
                                </div>
                            </div>
      </div> -->
        <div class="row">
    <div class="col-xs12">

      <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
        <a href="#courses" class="btn btn-default active" data-toggle="tab">
          <input type="radio" />{{trans('main.tap_search_courses')}}
        </a>
        <a href="#institutes" class="btn btn-default" data-toggle="tab">
          <input type="radio" />{{trans('main.tap_search_institutes')}}
        </a>
        
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="courses">

         {!! Form::open(['route'=>'courses.index','method'=>"get",'id'=>"coursesFiltersForm",'name'=>'coursesFiltersForm']) !!}

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
                       <center> <button class="btn_1 green" type="submit"><i class="icon-search"></i>{{trans('main.btn_search_now')}}</button> </center>
                         {!! Form::close() !!}
    </div>
        <div class="tab-pane" id="institutes">
            
            {!! Form::open(['route'=>'institutes.index','method'=>"get",'id'=>"institutesFiltersForm",'name'=>'institutesFiltersForm']) !!}

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
                        <center> <button class="btn_1 green" type="submit"><i class="icon-search"></i>{{trans('main.btn_search_now')}}</button> </center>
            {!! Form::close() !!}


        </div>
        
      </div>
    </div>
  </div>
      
                    </div>
      </div>
    </div>
  </div>
</div>

<!-- Search Menu -->
<div class="search-overlay-menu">
    <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
    <form role="search" id="searchform" method="get">
        <input value="" name="q" type="search" placeholder="Search..."/>
        <button type="submit"><i class="icon_set_1_icon-78"></i>
        </button>
    </form>
</div><!-- End Search Menu -->

<!-- Common scripts -->
<script src="/compare/table/js/jquery-2.1.4.js"></script>

<script src="/compare/table/js/main.js"></script> <!-- Resource jQuery -->


</body>



</html>




