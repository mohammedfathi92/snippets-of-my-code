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
@if($booking->status == 1)
    <div class="alert alert-warning">
    <strong>{{trans("bookings.alert_attention_label")}}</strong> {{trans("bookings.alert_status_pending",['user'=> Auth::user()->name, 'num'=> $booking->booking_code])}}
  </div>
  @endif
             
              <div class="row">
                    <div class="col-md-12 add_bottom_30">
                          <center><a href="#" class="btn_1 outline" style="background-color: #e25a70; color: #fff; border: 2px solid #e25a70;">{{trans('bookings.text_details_menu')}}</a>  
                            <a href="{{url('account/bookings/'.$booking->id.'/'.$booking->booking_code.'/advisor')}}" class="btn_1 outline">{{trans('bookings.text_advisor_menu')}}</a> 
                            <a href="{{url('account/bookings/'.$booking->id.'/'.$booking->booking_code.'/housing')}}" class="btn_1 outline">{{trans('bookings.text_housing_menu')}}</a>  </center>
                            
                            
                    </div>
                    </div>
              
         <div class="content" style="background-color: #fff; padding: 10px;">

                        <div class="strip_booking">
                            <div class="row">
                                <div class="col-md-2 col-sm-2">
                                    <div class="date">
                                        <span class="month">Price</span>
                                        <span class="day"><strong>{{$booking->total_price}}</strong>USD</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-5">
                                   <a href="{{url("courses/$course->id-".str_slug($course->{"name:en"}))}}" target="_blank"><span style="font-size: 15px"><strong>{{$course->name}}</strong></span></a> <span
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
                                        <a href="{{route("booking.bill",["id" =>$booking->id])}}" class="btn_2 load_booking" booking-id="{{$booking->id}}"> View invoice {{-- {{trans('bookings.btn_download_bill')}} --}}</a>
                                       </br>
                                        <a href="{{route("booking.bill_pdf",["id" =>$booking->id,'download'=>'pdf'])}}" class="btn_2 load_booking" booking-id="{{$booking->id}}"> Download invoice {{-- {{trans('bookings.btn_download_bill')}} --}}</a>

                                      
                                    </div>
                                </div>
                            </div><!-- End row -->

                             <div class="strip_booking col-md-12 col-sm-12" style="background: #f8f8f8; border-bottom: 2px solid #6f6d6d;">
                            <div class="row" style="margin: 10px">

                                <h3 style="color: #fff; background-color: #e04f67; padding: 3px; text-align: center;">{{trans('bookings.invoice_box_title')}}</h3>
                                        <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>{{trans('bookings.label_bill_item')}}</strong></td>
                                    <td class="text-center"><strong>{{trans('bookings.label_bill_price')}}</strong></td>
                                    <td class="text-center"><strong>{{trans('bookings.label_bill_weeks')}}</strong></td>
                                    <td class="text-right"><strong>{{trans('bookings.label_bill_total_price')}}</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <tr>
                                    <td>{{$course->name}}</td>
                                    <td class="text-center">{{$booking->course_week_price}}</td>
                                    <td class="text-center">{{$booking->course_weeks}}</td>
                                    <td class="text-right">{{$booking->course_total_price}}</td>
                                </tr>
                                @foreach($booking->services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td class="text-center">{{$service->type=='house'?$service->week_price:"---"}}</td>
                                    <td class="text-center">{{$service->type=='house'?$service->num_weeks:"---"}}</td>
                                    <td class="text-right">{{$service->total_price}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>{{trans('bookings.label_bill_all_total_price')}}</strong></td>
                                    <td class="thick-line text-right">{{$booking->total_price}}</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                          
                                </div>
                        </div>

                        </div><!-- End strip booking -->
                       
                       <br>

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