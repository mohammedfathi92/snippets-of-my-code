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
                    <input type="text" class="form-control" name="name" value="{{old("name",$data->name)}}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_email")}}</label>
                <div class="col-md-5">
                    <input type="email" class="form-control" name="email" value="{{old("email",$data->email)}}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_nationality")}}</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="nationality"
                           value="{{old("nationality",$data->nationality)}}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_user_mobile")}}</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="mobile" value="{{old("mobile",$data->mobile)}}"
                           minlength="5">
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("bookings.heading_booking_information")}}</div>

            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_date")}}</label>
                <div class="col-md-5">
                    <b> {{ $data->created_at }}</b>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_status")}}</label>
                <div class="col-md-5">
                    <div class="col-md-3"><span
                                class="label label-{{trans_choice("bookings.status_options_color",$data->status)}}">{!! trans_choice("bookings.status_options",$data->status) !!}</span>
                    </div>
                    <div class="col-md-5">
                        <select name="status" id="status" class="form-control ">
                            <option value="1" {{old("status",$data->status)==1?"selected":""}}>{{trans_choice("bookings.status_options",1)}}</option>
                            <option value="2" {{old("status",$data->status)==2?"selected":""}}>{{trans_choice("bookings.status_options",2)}}</option>
                            <option value="3" {{old("status",$data->status)==3?"selected":""}}>{{trans_choice("bookings.status_options",3)}}</option>
                            <option value="4" {{old("status",$data->status)==4?"selected":""}}>{{trans_choice("bookings.status_options",4)}}</option>

                        </select>
                    </div>


                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_arrival_date")}}</label>
                <div class="col-md-5">
                    <input type="text" class="form-control datepicker" name="arrival_date"
                           value="{{old("arrival_date",date("d-m-Y",strtotime($data->arrival_date)))}}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_departure_date")}}</label>
                <div class="col-md-5">
                    <input type="text" class="form-control datepicker" name="departure_date"
                           value="{{old("arrival_date",date("d-m-Y",strtotime($data->departure_date)))}}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_num_adult")}}</label>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="num_adults"
                           value="{{old("arrival_date",$data->num_adults)}}" min="1">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_num_childes")}}</label>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="num_children"
                           value="{{old("arrival_date",$data->num_children)}}" min="0">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_num_bags")}}</label>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="num_bags"
                           value="{{old("arrival_date",$data->num_bags)}}" min="0">
                </div>
            </div>

            <div data-ng-controller="bookingHotelsAndPackagesCtrl">

                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_destination")}}</label>
                    <div class="col-md-5">
                        <select name="country" id="" class="form-control " data-ng-model="country"
                                data-ng-init="country='{{$data->country_id}}'">
                            @foreach(\Sirb\Country::published()->get() as $country)
                                <option value="{{$country->id}}" {{$data->country_id==$country->id?"selected":""}} >{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_type")}}</label>
                    <div class="col-md-5">
                        <div class="col-md-4"> {{ trans("bookings.type_option.{$data->booking_type}") }}</div>
                        <div class="col-md-6">
                            <select name="booking_type" data-ng-model="booking_type" id="booking_type"
                                    data-ng-init="booking_type='{{old("booking_type",$data->booking_type)}}'"
                                    class="form-control ">
                                <option value="free" {{old("booking_type",$data->booking_type)=="free"?"selected":""}}>{{ trans("bookings.type_option.free") }}</option>
                                <option value="hotel" {{old("booking_type",$data->booking_type)=="hotel"?"selected":""}}>{{ trans("bookings.type_option.hotel") }}</option>
                                <option value="package" {{old("booking_type",$data->booking_type)=="package"?"selected":""}}>{{ trans("bookings.type_option.package") }}</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_hotels_level")}}</label>
                    <div class="col-md-5">
                        <b> {{ $data->hotels_level?trans_choice("hotels.hotel_stars_option",$data->hotels_level):"--" }}</b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_hotel")}}</label>
                    <div class="col-md-5">
                        <select name="hotel" class="form-control " id="hotel" data-ng-model="hotel"
                                data-ng-init="hotel='{{old("hotel",$data->hotel_id)}}'"
                                data-ng-disabled="!country||!hotels.length">
                            <option value=""></option>
                            <option data-ng-repeat="item in hotels"
                                    value="<%item.id%>" {{old("hotel",$data->hotel_id)=="<%item.id%>"?"selected":""}}>
                                <%item.name%>
                            </option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_room")}}</label>
                    <div class="col-md-5">
                        <select name="room" class="form-control " id="room" data-ng-model="room"
                                data-ng-init="room='{{old("room",$data->room_id)}}'"
                                data-ng-disabled="!country ||!hotel||!rooms.length">
                            <option value=""></option>
                            <option data-ng-repeat="item in rooms" value="<%item.id%>"><%item.name%></option>

                        </select>
                    </div>
                </div>
                @if($data->booking_type=="free" ||$data->package_type)
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">{{trans("bookings.label_package_type")}}</label>
                        <div class="col-md-5">
                                  <select name="package_type" id="package_type" class="form-control">

                                        {{--<option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option> --}}
                                          <option value="program" {{old("package_type")=="program"?"selected":""}}>{{trans("packages.package_type_option.program")}}</option>
                                          <option value="hotels" {{old("package_type")=="hotels"?"selected":""}}>{{trans("packages.package_type_option.hotels")}}</option>
                                          <option value="local_fly" {{old("package_type")=="local_fly"?"selected":""}}>{{trans("packages.package_type_option.local_fly")}}</option>
                                          <option value="transport" {{old("package_type")=="transport"?"selected":""}}>{{trans("packages.package_type_option.transport")}}</option>
                                          <option value="tours" {{old("package_type")=="tours"?"selected":""}}>{{trans("packages.package_type_option.tours")}}</option>
                                          <option value="hotels_local_fly" {{old("package_type")=="hotels_local_fly"?"selected":""}}>{{trans("packages.package_type_option.hotels_local_fly")}}</option>
                                          <option value="hotels_fly_main_transport" {{old("package_type")=="hotels_fly_main_transport"?"selected":""}}>{{trans("packages.package_type_option.hotels_fly_main_transport")}}</option>
                                          <option value="hotels_main_transport" {{old("package_type")=="hotels_main_transport"?"selected":""}}>{{trans("packages.package_type_option.hotels_main_transport")}}</option>
                                           <option value="fly_main_transport" {{old("package_type")=="fly_main_transport"?"selected":""}}>{{trans("packages.package_type_option.fly_main_transport")}}</option>
                                            <option value="tours_transport" {{old("package_type")=="tours_transport"?"selected":""}}>{{trans("packages.package_type_option.tours_transport")}}</option>

                                </select>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_package")}}</label>
                    <div class="col-md-5">
                        <select name="package" class="form-control" id="package" data-ng-model="package"
                                data-ng-init="package='{{old("package",$data->package_id)}}'"
                                data-ng-disabled="!country||!packages.length">
                            <option value=""></option>
                            <option data-ng-repeat="item in packages" value="<%item.id%>"><%item.name%></option>

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="control-label col-md-3">{{trans("bookings.label_num_rooms")}}</label>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="num_rooms" min="1"
                               value="{{old("num_rooms",$data->num_rooms)}}">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_notes")}}</label>
                <div class="col-md-5">
                    <textarea name="notes" id="" cols="30" rows="10" class="form-control">{{$data->notes}}</textarea>
                </div>
            </div>
            <div class="form-group margin-none">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit"
                            class="btn btn-primary"><i class="fa fa-save"></i> {{trans("main.btn_update")}}</button>
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
