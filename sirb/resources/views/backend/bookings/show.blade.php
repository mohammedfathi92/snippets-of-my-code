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
        {!! Form::open(['class'=>'form-horizontal','method'=>'put','name'=>'form','novalidate']) !!}
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_personal_information")}}</div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_name")}}</label>
                <div class="col-md-5">
                    <b> {{$data->name}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_email")}}</label>
                <div class="col-md-5">
                    <b> {{$data->email}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_nationality")}}</label>
                <div class="col-md-5">
                    <b> {{$data->nationality}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_mobile")}}</label>
                <div class="col-md-5">
                    <b> {{$data->mobile}}</b>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_booking_information")}}</div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_type")}}</label>
                <div class="col-md-5">
                    <b> {{ trans("bookings.type_option.{$data->booking_type}") }}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_hotels_level")}}</label>
                <div class="col-md-5">
                    <b> {{ $data->hotels_level?trans_choice("hotels.hotel_stars_option",$data->hotels_level):"--" }}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_date")}}</label>
                <div class="col-md-5">
                    <b> {{ $data->created_at }}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_status")}}</label>
                <div class="col-md-5">
                    <b>
                        <span class="label label-{{trans_choice("bookings.status_options_color",$data->status)}}">{!! trans_choice("bookings.status_options",$data->status) !!}</span></b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_arrival_date")}}</label>
                <div class="col-md-5">
                    <b> {{$data->arrival_date}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_arrival_date")}}</label>
                <div class="col-md-5">
                    <b> {{$data->departure_date}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_num_adult")}}</label>
                <div class="col-md-5">
                    <b> {{$data->num_adults}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_num_childes")}}</label>
                <div class="col-md-5">
                    <b> {{$data->num_children?:"--"}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_num_bags")}}</label>
                <div class="col-md-5">
                    <b> {{$data->num_bags?:"--"}}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_destination")}}</label>
                <div class="col-md-5">
                    <b> {{$data->country_id?$data->country->name:"--"}}</b>
                </div>
            </div>
            @if(($data->booking_type=="hotel" ||$data->booking_type=="room")&&$data->hotel_id)
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_hotel")}}</label>
                    <div class="col-md-5">
                        <b><a href="{{url("hotels/{$data->hotel_id}/".make_slug($data->hotel->name))}}">{{$data->hotel->name}}</a></b>
                    </div>
                </div>
            @endif
            
            @if(($data->booking_type=="room")&&$data->room_id && $data->room)
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_room")}}</label>
                    <div class="col-md-5">
                        <b><a href="{{url("hotels/{$data->hotel_id}/".make_slug($data->hotel->name))}}">{{$data->room->name}}</a></b>
                    </div>
                </div>
            @endif
            @if($data->booking_type=="free" ||$data->package_type)
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_package_type")}}</label>
                    <div class="col-md-5">
                        <b>{{$data->package_type? trans("packages.package_type_option.".$data->package_type):"--"}}</b>
                    </div>
                </div>
            @endif
            @if(($data->booking_type=="package")&&$data->package_id)
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_package")}}</label>
                    <div class="col-md-5">
                        <b><a href="{{url("packages/{$data->package_id}/".make_slug($data->package->name))}}">{{$data->package->name}}</a></b>
                    </div>
                </div>
            @endif

            @if($data->booking_type=="room" ||$data->booking_type=="package" ||$data->booking_type=="hotel")
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_num_rooms")}}</label>
                    <div class="col-md-5">
                        <b>{{$data->num_rooms?:"--"}}</b>
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_notes")}}</label>
                <div class="col-md-5">
                    <b> {{$data->notes?:"--"}}</b>
                </div>
            </div>
            <div class="form-group margin-none">
                <div class="col-sm-offset-3 col-sm-9">
                    <a href="{{url("$backend_uri/bookings/{$data->id}/edit")}}"
                       class="btn btn-primary"><i class="fa fa-pencil"></i> {{trans("main.btn_edit")}}</a>
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
