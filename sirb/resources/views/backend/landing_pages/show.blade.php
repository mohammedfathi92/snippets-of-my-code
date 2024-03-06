<!DOCTYPE html>
<html lang="{{LaravelLocalization::getCurrentLocaleRegional()}}" data-ng-app="backendApp">

<!-- Mirrored from droitlab.com/html/inova/v1/main/app-rtl.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Feb 2018 12:33:09 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>صانع صفحات الهبوط</title>
        <!--    favicon-->
        <link rel="shortcut icon" href="/builder/image/faveicon.png" type="image/x-icon">

        <!-- Bootstrap -->
        <link href="/builder/css/all-plugin.css" rel="stylesheet">
        <link rel="stylesheet" href="/builder/css/bootstrap-rtl.css">


        <link rel="stylesheet" href="/builder/vendors/themify-icon/themify-icons.css">
        <!-- strock-Gap-icon -->
        <link rel="stylesheet" href="/builder/vendors/linear-icon/style.css">
        <!-- RS5.0 Main Stylesheet -->
        <link rel="stylesheet" type="text/css" href="/builder/vendors/revolution/css/revulation.css">
        <link rel="stylesheet" type="text/css" href="/backend/lib/css/select2.min.css">


        <!--    css-->
        <link rel="stylesheet" href="/builder/css/style.css">
        <!--responsive css-->
        <link rel="stylesheet" href="/builder/css/responsive.css">
        <link rel="stylesheet" href="/builder/css/rtl.css">
        @if($page->page_color)
        <link rel="stylesheet" id="triggerColor" href="/builder/css/saved-color/{{$page->page_color}}.css">
        @endif
        <!--color css-->
        <link rel="stylesheet" id="triggerColor" href="/builder/css/triggerPlate/color-0.css">
        {{-- <link rel="stylesheet" type="text/css" href="/builder/vendors/content-tools/content-tools.min.css"> --}}
        <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">




        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="/builder/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="/builder/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            /* Alignment styles for images, videos and iframes in editable regions */
/*Arabic css*/
  .my_img{

    height: 170px !important;
    width: 270px;


  }

  .my_right_div{
    float: right;

  }

    header{
     position: relative !important;
  }

  .stricky-fixed{
     position: fixed !important;
  }

.navu{
   margin-top: 10px !important;
}

  /*End Arabic css*/
.navu li a{
    color: #272727 !important;
}
ar-toggle .icon-bar {
    background: #040404;
}

@media (max-width:991px){
    .navbar.navbar-default .navbar-collapse .menu li a{
        color: #fff !important;
    }
}


  .my_text{
    padding-left: 0px !important;
    line-height: 20px !important;
  }

  .my_hr{
    margin-top: 5px;
    margin-bottom: 0px;
  }

  .btn_c{

    width: 80%;
    margin-top: 10px;
    height: 35px;
    line-height: 35px;

  }



.par_div
  {
    position: relative;
    top: 0;
    left: 0;
  }
  .ch_div
  {
    position: absolute;
    padding-left: 10px;
    padding-right: 10px;
    top: 142px;
    /*left: 14px;*/
    background-color: #27262694;
    width: 100%;

  }
  .text-left{
    padding-right: 50px;
  }

.my_list_tools{

     display:flex;
  list-style:none;

}

.my_list_tools li{

  margin: 2px 5px 2px 5px;
}

/*  Discount */
.badge_save {
    position: absolute;
    top: 0;
    right: 0;
    width: 65px;
    height: 77px;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    background: url(/builder/image/badge_save.png);
    font-size: 11px;
    line-height: 12px;
    padding-top: 32px;
}


  .my_fixed:before {
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: absolute;
    background-image: -moz-linear-gradient(-15deg, #3a7bd5 0%, #1aabec 100%);
    background-image: -webkit-linear-gradient(-15deg, #5d6877ad 0%, #343535cf 100%);
    background-image: -ms-linear-gradient(-15deg, #3a7bd5 0%, #1aabec 100%);
    opacity: 0.90;
    z-index: -1;
}

.myHeaderImage:before{
   content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-image: -moz-linear-gradient(-15deg, #000000 0%, #00000066 100%);
    background-image: -webkit-linear-gradient(15deg, #000000 0%, #00000066 100%);
    background-image: -ms-linear-gradient(15deg, #000000 0%, #00000066 100%);
    opacity: 0.65;
    z-index: -1;
}


.hero-content .slider-btn {
    border-color: #ffffff;
    color: #ffffff;
}

{{-- /* Center (default) */
[data-editable] iframe,
[data-editable] image,
[data-editable] [data-ce-tag=img],
[data-editable] img,
[data-editable] video {
    clear: both;
    display: block;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
}

/* Left align */
[data-editable] .align-left {
    clear: initial;
    float: left;
    margin-right: 0.5em;
}

/* Right align */
[data-editable].align-right {
    clear: initial;
    float: right;
    margin-left: 0.5em;
}

/* Alignment styles for text in editable regions */
[data-editable] .text-center {
    text-align: center;
}

[data-editable] .text-left {
    text-align: left;
}

[data-editable] .text-right {
    text-align: right;
}
​
 .author {
            font-style: italic;
            font-weight: bold;
        }




.ct-widget .ct-ignition__button--edit {
    background: #ff03bd;
    left: 5px;
}

.ct-widget .ct-ignition__button--confirm {
    background: #27ae60;
    left: 5px;
}


.ct-widget .ct-ignition__button--cancel {
    background: #e74c3c;
    left: 64px;
}
--}}


        </style>
    </head>
    <body data-scroll-animation="true">

       {{--  <!--start preloader area-->
                      <div class="loader-container circle-pulse-multiple">
                          <div class="loader">
                              <div id="loading-center-absolute">
                                  <div class="object" id="object_four"></div>
                                  <div class="object" id="object_three"></div>
                                  <div class="object" id="object_two"></div>
                                  <div class="object" id="object_one"></div>
                              </div>
                          </div>
                      </div>
                     <!--End preloader area--> --}}

        <!--Start searchForm -->
        <div class="searchForm">
            <span class="input-group-addon cross-btn form_hide"><i class="lnr lnr-cross"></i></span>
           <div class="container">
                <form action="#" class="row search_row m0">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Type & Hit Enter">
                    </div>
                    <p>Input your search keywords and press Enter.</p>
                </form>
           </div>
        </div>
        <!-- End searchForm -->
        <!-- Start color-plate -->
        <div id="td-theme-settings" class="td-color-theme-demos">
            <a href="#" class="settingBtn"><i class="fa fa-cog" aria-hidden="true"></i></a>
            <div class="td-skin-body">
                <div class="td-skin-wrap">
                    {{-- <div class="sw-logo">
                                                                <a href="saas.html"><img src="/builder/image/logo1-blue.png" alt=""></a>
                                                            </div> --}}
                    <h2 class="td-title">اختر لون الاساتيل العام</h2>
                    <p>اضغط مرتين بالموس للحفظ</p>
                    <p style="color: green;" id="color_saved"></p>
                    <div class="td-sw-color" id="actionColors">
                        <a href="color-1.html" class="color1 db_color active" id="color_1"><i class="fa fa-check"></i></a>
                        <a href="color-2.html" class="color2 db_color" id="color_2"><i class="fa fa-check"></i></a>
                        <a href="color-3.html" class="color3 db_color" id="color_3"><i class="fa fa-check"></i></a>
                        <a href="color-4.html" class="color4 db_color" id="color_4"><i class="fa fa-check"></i></a>
                        <a href="color-5.html" class="color5 db_color" id="color_5"><i class="fa fa-check"></i></a>
                        <a href="color-6.html" class="color6 db_color" id="color_6"><i class="fa fa-check"></i></a>
                    </div>
                    <h2 class="td-title">اختر نوع البلوك</h2>
                    <div class="td-sw-demo row m0">
                        <div class="td-set-theme-style">
                            <a href="#DyBlockFormModal" data-toggle="modal" block-type="dynamic" class="addBlockModal btn btn-primary">
                                بلوك داينامك
                            </a>
                        </div>
                        <div class="td-set-theme-style">
                            <a href="#StBlockFormModal" data-toggle="modal" data-target="#StBlockFormModal" block-type="static" class="addBlockModal btn btn-success">
                               بلوك استاتيك
                            </a>
                        </div>
                        <div class="td-set-theme-style">
                            <a href="#CityBlockFormModal" data-toggle="modal" block-type="city" class="addBlockModal btn btn-danger">
                                المدن والدول
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End color-plate -->
        <!--start header Area-->
        <header class="header header2" id="stricky" style="background-color: #fff;">
            <nav class="navbar navbar-default" style="padding: 15px 0px 15px 0px;">
                <div class="container">
                    <!--========== Brand and toggle get grouped for better mobile display ==========-->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/"> <img src="{{Storage::url(settings("logo")."?size=200,60&encode=png")}}" alt="{{settings("{$locale}_title")}}">  <img src="{{Storage::url(settings("logo")."?size=200,60&encode=png")}}" alt="{{settings("{$locale}_title")}}"> </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!--========== Collect the nav links, forms, and other content for toggling ==========-->
                   {{--  <ul class="nav navbar-nav nav-right navbar-right">
                        <li class="search_dropdown"><a href="#"><i class="ti-search"></i></a></li>
                        <li>
                           <a href="#" class="btn g-btn">
                                بدء
                            </a>
                        </li>
                    </ul> --}}
                    <div class="collapse navbar-right navbar-collapse" id="bs-example-navbar-collapse-1">
                        @php
                if($page->menu_id){
                        $menu = \Sirb\Menu::where('id', $page->menu_id)->first()->position;
                    }else{
                    $menu = 'landing_menu';

                }
                        @endphp


                        {!! menu($menu,['class'=>'nav navbar-nav menu navu']) !!}


                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
        </header>
        <!--End header Area-->
              <!--End slide-banner -->
               <div>
@php

 $lang = Request::get('lang')?:"ar";

$blocks = $page->blocks()->where('lang', $lang)->orderBy('order', 'asc')->get();

@endphp

   @if(count($blocks))


    @foreach($blocks as $block)

    @if($block->is_dynamic)


       @include('backend.landing_pages.parts.block_dynamic', ['block' => $block])


       @endif

        @if(!$block->is_dynamic)


       @include('backend.landing_pages.parts.block_static', ['block' => $block])


       @endif



@endforeach

        @endif

       </div>



        <!--start footer area-->
        <footer class="row footer-area" >
            <div class="footer-top">
                <div class="container">
                    <div class="row footer_sidebar">
                     {{--   <div class="widget widget1 about_us_widget col-xs-6 col-sm-6 col-md-3 wow fadeIn" data-wow-delay="0ms" data-wow-duration="1500ms" data-wow-offset="0">
                                                                                           <a href="index.html" class="logo">
                                                                                            <img src="{{Storage::url(settings("logo")."?size=80,21&encode=png")}}" alt="{{settings($locale."_title")}}">
                                                                                           </a>

                                                                                           <p>{!! str_limit(strip_tags(settings($locale."_meta_description")),200) !!}</p>
                                                                                           <ul class="nav social_icon row m0">
                                                                                               @if($social=settings("facebook"))
                                                                                               <li><a href="{{$social}}"><i class="fa fa-facebook"></i></a></li>
                                                                                               @endif
                                                                                               @if($social=settings("instagram"))
                                                                                               <li><a href="{{$social}}"><i class="fa fa-instagram"></i></a></li>
                                                                                               @endif
                                                                                                @if($social=settings("linkedin"))
                                                                                               <li><a href="{{$social}}"><i class="fa fa-linkedin"></i></a></li>
                                                                                               @endif
                                                                                                @if($social=settings("pinterest"))
                                                                                               <li><a href="{{$social}}"><i class="fa fa-pinterest-p"></i></a></li>
                                                                                               @endif
                                                                                               @if($social=settings("youtube"))
                                                                                               <li><a href="{{$social}}"><i class="fa fa-youtube"></i></a></li>
                                                                                               @endif
                                                                                                @if($social=settings("twitter"))
                                                                                               <li><a href="{{$social}}"><i class="fa fa-twitter"></i></a></li>
                                                                                               @endif

                                                                                           </ul>
                                                                                       </div> --}}

                            @php
                            $menu_title_1 = "";
                            $menu_title_2 = "";
                            $menu_title_3 = "";
                            $menu_title_4 = "";


                            if(\Sirb\Menu::where('position', 'landing_footer_1')->first()){
                            $menu_title_1 = \Sirb\Menu::where('position', 'landing_footer_1')->first()->title;
                              }
                              if(\Sirb\Menu::where('position', 'landing_footer_2')->first()){
                              $menu_title_2 = \Sirb\Menu::where('position', 'landing_footer_2')->first()->title;

                              }

                               if(\Sirb\Menu::where('position', 'landing_footer_3')->first()){
                              $menu_title_3 = \Sirb\Menu::where('position', 'landing_footer_3')->first()->title;

                              }

                               if(\Sirb\Menu::where('position', 'landing_footer_4')->first()){
                              $menu_title_4 = \Sirb\Menu::where('position', 'landing_footer_4')->first()->title;

                              }


                            @endphp
                    <div class="widget widget2 widget_instagram col-xs-6 col-sm-6 col-md-3 wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <h4 class="widget_title">{{$menu_title_1}}</h4>
                            <div class="widget_inner row m0">
                {!! menu('landing_footer_1',['class'=>'nav']) !!}
                            </div>
                        </div>
                        <div class="widget widget3 widget_twitter  col-xs-6 col-sm-6 col-md-3 wow fadeIn" data-wow-delay="150ms" data-wow-duration="1500ms">
                            <h4 class="widget_title">{{$menu_title_2}}</h4>
                            <div class="widget_inner row m0">

                             {!! menu('landing_footer_2',['class'=>'nav']) !!}

                            </div>
                        </div>
                        <div class="widget widget4 widget_instagram  col-xs-6 col-sm-6 col-md-3 wow fadeIn" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <h4 class="widget_title">{{$menu_title_3}}</h4>
                            <div class="widget_inner row m0">
                                 {!! menu('landing_footer_3',['class'=>'nav']) !!}

                            </div>
                        </div>
                         <div class="widget widget4 widget_instagram  col-xs-6 col-sm-6 col-md-3 wow fadeIn" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <h4 class="widget_title">{{$menu_title_4}}</h4>
                            <div class="widget_inner row m0">
                                 {!! menu('landing_footer_4',['class'=>'nav']) !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m0 footer_bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
           <p dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">&copy; {{date("Y")}} {!! Html::link(\LaravelLocalization::localizeURL('/'),settings("{$locale}_title")) !!} </p>
                        </div>

                        <div class="right col-sm-7">

                            {!! menu('landing_footer_bottom',['class'=>'footer-menu']) !!}

                        </div>
                    </div>
                </div>
            </div>

 <!-- Dynamic Data Modal -->
  <div class="modal fade" id="DyBlockFormModal" role="dialog"  data-ng-controller="builderCtrl" data-ng-init="getCountriesList()">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اختر خصائص البلوك</h4>
        </div>
        <div class="modal-body">


          @include('backend.landing_pages.parts.dy_block_forms', ['is_dynamic' => true,])

        </div>

      </div>

    </div>
  </div>

   <!-- city Data Modal -->
  <div class="modal fade" id="CityBlockFormModal" role="dialog"  data-ng-controller="cityBuilderCtrl" data-ng-init="getCountriesList()">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اختر خصائص البلوك</h4>
        </div>
        <div class="modal-body">


          @include('backend.landing_pages.parts.city_block_forms', ['is_dynamic' => true,])

        </div>

      </div>

    </div>
  </div>
   <!-- Static Block Modal -->
  <div class="modal fade" id="StBlockFormModal" role="dialog" data-ng-controller="builderCtrl">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">لوحة ادارة بلوك استاتيك</h4>
        </div>
        <div class="modal-body">


          @include('backend.landing_pages.parts.st_block_forms', ['is_dynamic' => true,])

        </div>

      </div>

    </div>
  </div>
        </footer>
        <!--End footer area-->
        <!-- scrolltop area-->
        <a href="#" class="scrolltop"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>

        <script type="text/javascript" src="{{elixir("js/angular.js")}}"></script>


       {{-- <script type="text/javascript" src="/builder/vendors/content-tools/content-tools.min.js"></script>
                      <script type="text/javascript" src="/builder/vendors/content-tools/editor.js"></script> --}}

        <script type="text/javascript" src="/builder/js/jquery-2.2.4.js"></script>
        <script type="text/javascript" src="/builder/js/all-plugin.js"></script>



        <script type="text/javascript" src="/builder/js/plugins.js"></script>
              <script type="text/javascript" src="/backend/lib/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="/backend/lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="/backend/lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/backend/lib/js/dataTables.bootstrap.min.js"></script>
        <!-- REVOLUTION JS FILES -->
        <script type="text/javascript" src="/builder/vendors/revolution/js/revulation.min.js"></script>

        <script type="text/javascript" src="/builder/js/custom-rtl.js"></script>
        <script type="text/javascript" src="/backend/lib/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/backend/js/readmore.min.js"></script>
<script src="/backend/js/builder_tinymce.js"></script>




<script type="text/javascript" src="/backend/js/app.js"></script>
<script type="text/javascript" src="{{elixir("backend/js/ng-dependencies.js")}}"></script>
<script type="text/javascript" src="{{elixir("backend/js/ng-app.js")}}"></script>

<script type="text/javascript" src="/backend/lib/js/select2.full.min.js"></script>

<script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.icon-picker').iconpicker();
        })
    </script>



<script>
    $(function() {


     $('.select2').select2({
  minimumResultsForSearch: Infinity
});

     $('.no-select2').remove();

     $('.db_color').dblclick(function(){
     var color_id = $(this).attr('id');
     $.get("/"+window.locale+"/{{$backend_uri}}/landing-pages/ajax/{{$page->id}}/change-color/"+color_id, function(data, status){
        $('#color_saved').text(data.msg);

        });
    });

});



</script>


      {{-- <script>
           $(function() {

    $("#btn2").click(function(){
        alert("HTML: " + $("#get_el").html());
    });

    // Load Form Content into Modal

      $(".addBlockModal").click(function() {
        var type = $(this).attr("block-type");
        var url = "/"+window.locale+"/{{$backend_uri}}/landing-pages/ajax/getBlockForm/"+type;
        $(".modal-body").load(url);
        console.log(url);

      });

});
       </script> --}}
    </body>

<!-- Mirrored from droitlab.com/html/inova/v1/main/app-rtl.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Feb 2018 12:33:09 GMT -->
</html>
