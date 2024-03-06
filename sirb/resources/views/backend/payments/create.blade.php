<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-calendar"></i> {{trans("bookings.backend_page_show_header")}}</h1>

@stop
@section("content")
    <div class="page-content container-fluid">
        



        @if($errors->count())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {!! Form::open(['class'=>'form-horizontal','method'=>'post','name'=>'form','novalidate']) !!}
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_personal_information")}}</div>
            <br>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_name")}} <span
                            class="text-danger">*</span> </label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="full_name" value="{{old("full_name")}}">
                </div>
            </div>

               
             <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_fname")}} <span
                            class="text-danger">*</span> </label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="first_name" value="{{old("first_name")}}">
                </div>
            </div>
         
            
             <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_lname")}} <span
                            class="text-danger">*</span> </label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="last_name" value="{{old("last_name")}}">
                </div>
            </div>

               <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_mobile")}}</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="whatsapp" value="{{old("whatsapp")}}"
                           minlength="5">
                </div>
            </div>
          
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_email")}}</label>
                <div class="col-md-5">
                    <input type="email" class="form-control" name="payer_email" value="{{old("payer_email")}}">
                </div>
            </div>
          
              <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_nationality")}}</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="nationality"
                           value="{{old("nationality")}}">
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_booking_information")}}</div>

          
            <br>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_package_num")}}</label>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="package_num"
                           value="{{old("package_num")}}" min="1">
                </div>
            </div>
             <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_pay_for")}}</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="title"
                           value="{{old("title")}}" min="0">
                </div>
            </div>
             <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_details")}}</label>
                <div class="col-md-5">
                    <textarea name="details" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
                <hr>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_pay_amount")}}</label>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="price"
                           value="{{old("price")}}" min="0">
                </div>
            </div>
             <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_fees")}}</label>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="fees"
                           value="{{old("fees")}}" min="0">
                </div>
            </div>
  
            <div class="form-group margin-none">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit"
                            class="btn btn-primary"><i class="fa fa-save"></i> {{trans("main.btn_create")}}</button>
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