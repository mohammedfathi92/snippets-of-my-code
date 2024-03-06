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
            
         <div class="content" style="background-color: #fff; padding: 10px;">

                       @if($data->bookings->count())
                       @foreach($data->bookings()->get() as $booking)
                       @php
                       $course = $booking->course;
                       @endphp
                        <div class="strip_booking">
                            <div class="row">
                                <div class="col-md-2 col-sm-2">
                                    <div class="date">
                                        <span class="month">Price</span>
                                        <span class="day"><strong>{{$booking->total_price}}</strong>USD</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-5">
                                   <a href="{{url("courses/$course->id-".str_slug($course->{"name:en"}))}}" target="_blank"><span style="font-size: 15px"><strong>{{$course->name}}</strong></span></a>  <span
                                class="label label-{{trans_choice("bookings.status_options_color",$booking->status)}}">{!! trans_choice("bookings.status_options",$booking->status) !!}</span> 
                                    <div>{!! str_limit($course->description, 200, ' ..... .' ) !!}</div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <ul class="info_booking">
                                        <li><strong>{{trans('bookings.label_booking_id')}}</strong> {{$booking->booking_code}}</li>
                                        <li><strong> {{trans('bookings.label_booking_at')}} </strong> {{$booking->created_at->format('Y-m-d')}}</li>
                                    </ul>
                                </div>
                                
                              

                                <div class="col-md-2 col-sm-2">
                                    <div class="booking_buttons">
                              
                                        <a href="{{url('account/bookings/'.$booking->id.'/'.$booking->booking_code.'/show')}}" class="btn_1 load_booking" 
                                            >{{trans('bookings.btn_view_booking_page')}}</a>
                                       <!-- <a href="#0" class="btn_3">Contact advisor</a> -->
                                    </div>
                                </div>
                            </div><!-- End row -->

                         

                        </div><!-- End strip booking -->
                       
                       <br>


                        @endforeach
                        @else
                        <div class="strip_booking">
                            <div class="row">
                                You didn't book any courses
                                </div>
                        </div><!-- End strip booking -->
                        @endif

                         

                        

                   </div>
        </div>

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


@stop