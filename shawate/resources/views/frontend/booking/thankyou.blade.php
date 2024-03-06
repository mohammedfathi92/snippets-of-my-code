@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("bookings.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("bookings.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-sms-6 col-sm-8 col-md-9">
            <div class="booking-section travelo-box">

                <div class="alert alert-success">{!! trans("bookings.alert_thank_you") !!}</div>

            </div>
        </div>
        <div class="sidebar col-sms-6 col-sm-4 col-md-3">
            @if(Settings::get('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                    <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
                </div>
            @endif
        </div>
    </div>

@stop