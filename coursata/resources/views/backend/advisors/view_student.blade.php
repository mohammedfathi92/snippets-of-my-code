<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-study"></i> {{trans("bookings.backend_page_create_header")}} </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        
       
        <div class="col-md-8">


          <div class="panel panel-primary">
                <div class="panel-heading">{{trans("main.tab_general")}}</div>
                
                <div class="panel-body">
                  <br>
                  <div class="row nomargin-bottom">
                    <div class="col-md-6 col-sm-6 margin-bottom-15">

                    <h4> 1) Personal Info </h4>

                  </div>
                </div>
                  <hr>
                 

      <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">First Name:</span> {{$data->first_name}}</p> 
            </div>
            <div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Last Name:</span> {{$data->last_name}}</p> 
            </div>
          </div>

<div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Email:</span> {{$data->email}}</p> 
            </div>
            <div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Phone No.:</span> {{$data->phone}}</p> 
            </div>
          </div>

          <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Whats app:</span> {{$data->whatsapp}}</p> 
            </div>
            <div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Facebook:</span> {{$data->facebook}}</p> 
            </div>
          </div>

          <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Birth Of Date:</span> {{$data->birth_date}}</p> 
            </div>
            <div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Gender:</span> {{$data->gender == "m"? "Male": "Female"}}</p> 
            </div>
          </div>

          <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 ">
  @php
  $nationality = \Corsata\Country::find($data->nationality);
  $residencePlace = \Corsata\Country::find($data->residence_place);

  @endphp

               <p><span style="font-weight: bold;">Nationality:</span> {{$nationality->name}}</p> 
            </div>
            <div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Residence Place:</span> {{$residencePlace->name}}</p> 
            </div>
          </div>

           <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 ">

               <p><span style="font-weight: bold;">City:</span> {{$data->city_name}}</p> 
            </div>
           
          </div>

          <hr>

          <div class="row nomargin-bottom">
                    <div class="col-md-6 col-sm-6 margin-bottom-15">

                    <h4> 2) Booking info </h4>

                  </div>
                </div>
<hr>
      <div class="row nomargin-bottom">
<div class="col-md-12 col-sm-12 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Institute:</span> {{$institute->name}}</p> 
            </div>
          </div>
            <div class="row nomargin-bottom">
<div class="col-md-12 col-sm-12 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Course:</span> {{$course->name}}</p> 
            </div>
          </div>

              <div class="row nomargin-bottom">
<div class="col-md-12 col-sm-12 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Student Housing Address: </span> {{$housing?$housing->address_line1."<br>".$housing->address_line2:"---"}}</p> 
            </div>
            <div class="col-md-12 col-sm-12 margin-bottom-15 ">

               <p><span style="font-weight: bold;">Student Housing phone No.:</span> {{$housing?$housing->phone_no1."<br>".$housing->phone_no2."<br>".$housing->phone_no2:"----"}}  </p> 
            </div>
          </div>
 

                </div>
            </div>

        </div>
        <div class="col-md-4">
            
            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("bookings.label_gallery")}}</div>
                <div class="panel-body">
                 <div class="thumbnail">
                                            @if($data->avatar)
                                                <img src="{{Storage::url($data->avatar)}}" alt="Avatar"
                                                     class="img-responsive">
                                            @else
                                                <img src="/images/default-avatar.jpg" alt="Avatar"
                                                     class="img-responsive ">
                                            @endif
                                        </div>
                                        <center><a href="{{url($locale.'/message/'.$data->id)}}" 
                        class="btn btn-success" target="_blank">{{trans("main.btn_message")}}</a></center>
                </div>
            </div>
        </div>

       

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection

@section("javascript")
    <script>
        $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        
    </script>
@stop
