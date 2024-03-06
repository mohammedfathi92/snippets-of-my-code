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
        {!! Form::open(['class'=>'form-horizontal','method'=>'put','name'=>'form','novalidate']) !!}
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_personal_information")}}</div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_name")}}</label>
                <div class="col-md-5">
                    <b> {{$user->name}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_email")}}</label>
                <div class="col-md-5">
                    <b> {{$user->email}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_residental_country")}}</label>
                <div class="col-md-5">

                    <b> {{$user->country->name}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_nationality")}}</label>
                <div class="col-md-5">

                    <b> {{$user->userNationality->name}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_mobile")}}</label>
                <div class="col-md-5">
                    <b> {{$data->phone}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_whatsapp")}}</label>
                <div class="col-md-5">
                    <b> {{$data->whatsapp}}</b>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_booking_information")}}</div>
             <br>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_course_name")}}</label>
                <div class="col-md-5">
                   <a href="{{route("course.details",['id'=>$data->course->id,'slug'=>str_slug($data->course->{"name:en"})])}}" target="_blank"><b> {{$data->course->name}}</b></a> 
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_course_weeks")}}</label>
                <div class="col-md-5">
                <b> {{$data->course_weeks}}</b> 
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_course_total_price")}}</label>
                <div class="col-md-5">
                <b> {{$data->course_total_price}}</b> 
                </div>
            </div>
            <hr>
            <div class="row">
                <center><h5>{{trans("bookings.title_course_services")}}</h5></center>
            
            @if($data->services()->count())


            @foreach($data->services()->get() as $service)
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_service_name")}}</label>
                <div class="col-md-5">
                    <b> {{$service->name}}</b>
                </div>
            </div>
            @if($service->type === 'house')
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_house_type")}}</label>
                <div class="col-md-5">
                    <b> {{$service->house_type=== 'family'?trans("bookings.label_house_family"): trans("bookings.label_house_studental")}} </b>
                </div>
            </div>
           
            
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_house_weeks")}}</label>
                <div class="col-md-5">
                    <b> {{$service->num_weeks}}</b>
                </div>
            </div>
            @endif
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_service_price")}}</label>
                <div class="col-md-5">
                    <b> {{$service->total_price}}</b>
                </div>
            </div>
           
            @endforeach
            @else
            <center>No course services found for this booking</center>
            @endif
            </div>
            <hr>
            <br>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_total_price")}}</label>
                <div class="col-md-5">

                    <b> {{$data->total_price}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_last_update")}}</label>
                <div class="col-md-5">
                    <b>  {{ $data->updated_at }}</b>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_status")}}</label>
                <div class="col-md-5">
                    <b>
                        <span class="label label-{{trans_choice("bookings.status_options_color",$data->status)}}">{!! trans_choice("bookings.status_options",$data->status) !!}</span></b>
                </div>
            </div>
        </div>
   


    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">
@endsection
@section("javascript")
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.icon-picker').iconpicker();
        })
    </script>


@endsection
