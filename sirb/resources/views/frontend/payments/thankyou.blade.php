@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("bookings.title_paymeny_request")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("bookings.title_paymeny_request")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-sms-6 col-sm-8 col-md-9">
            <div class="booking-section travelo-box">

                <div class="alert alert-success">{!! trans("bookings.alert_thank_you_payments", ['user'=> $data->first_name]) !!}</div>

            </div>
        </div>
        <div class="sidebar col-sms-6 col-sm-4 col-md-3">
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>
                </div>
            @endif
        </div>
    </div>

@stop