@extends('frontend.layouts.master')
@section("content")

 
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{url('/')}}">{{trans('users.home_page')}}</a></li>
                <li>{{trans('users.my_account')}}</li>
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
    <main>
        <div class="margin_60 container">
            <aside class="col-md-2" id="sidebar">
        <div class="theiaStickySidebar">
        <div class="box_style_cat">
           @include('frontend.users.side_menu')
            </div>
        </div><!--End sticky -->
        </aside>
        <div class="col-md-10 add_bottom_15">
             
              <div class="row">
                    <div class="col-md-12 add_bottom_30">
                          <center><a href="{{url('account/bookings/'.$booking->id.'/'.$booking->booking_code.'/show')}}" class="btn_1 outline" >{{trans('bookings.text_details_menu')}}</a>  
                            <a href="{{url('account/bookings/'.$booking->id.'/'.$booking->booking_code.'/advisor')}}" class="btn_1 outline" >{{trans('bookings.text_advisor_menu')}}</a> 
                            <a href="#" class="btn_1 outline" style="background-color: #e25a70; color: #fff; border: 2px solid #e25a70;">{{trans('bookings.text_housing_menu')}}</a>  </center>
                            
                            
                    </div>
                    </div>
              
         
        @if($booking && $housing)             
           
                           
          @if($housing->gallery()->count())
                    <div id="Img_carousel" class="slider-pro">
                        <div class="sp-slides">

                            @foreach($housing->gallery as $photo)
                                <div class="sp-slide">
                                    <img alt="{{$housing->name}}" class="sp-image"
                                         src="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-src="{{url("files/{$photo->name}?size=500,333")}}"
                                         data-small="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-medium="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-large="{{url("files/{$photo->name}?size=1000,667")}}"
                                         data-retina="{{url("files/{$photo->name}?size=1000,667")}}">
                                </div>
                            @endforeach
                        </div>
                        <div class="sp-thumbnails">
                            @foreach($housing->gallery as $photo)
                                <img alt="Image" class="sp-thumbnail" src="{{url("files/{$photo->name}?size=120,80")}}">
                            @endforeach
                        </div>
                    </div>

                    <hr>
                @endif
        <div class="content " style="background-color: #fff; padding: 10px;">
           <div class="row">
             <div class="strip_booking col-md-12">
                   

         
                             
                                {!! $housing->description !!}
                            

                        </div><!-- End strip booking -->
                       
                      
</div>
                   </div>

                     @else 
          
          <div class="content" style="background-color: #fff; padding: 10px;">

                        <div class="strip_booking">
                            <div class="row">
                                There isn't any housing services for this booking
                            </div>
                            </div>
                            </div>
                     @endif 
        </div>

        </div><!-- end container -->
    </main>



@stop

@section("styles")

    <!-- CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
     <!-- CSS -->
    <link href="/assets/css/slider-pro.min.css" rel="stylesheet">
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


    <style>



.scrollbar
{
    
    float: left;
    padding:0px;
    margin:0px;
    height: 100px;
    width: 100%;
    background: #F5F5F5;
    overflow-y: scroll;
    margin-bottom: 25px;
}

.force-overflow
{
    min-height: 100px;
}



/*
 *  STYLE 1
 */

#style-1::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
    background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
</style>
@stop

@section("scripts")

    <!-- Date and time pickers -->
<script src="/assets/js/jquery.sliderPro.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function( $ ) {
        $( '#Img_carousel' ).sliderPro({
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


@stop