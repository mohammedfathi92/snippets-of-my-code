<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body'          => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead'      => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body'       => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell'  => 'padding: 35px;',

    'email-footer'      => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub'    => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor'           => 'color: #3869D4;',
    'header-1'         => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph'        => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub'    => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red'   => 'background-color: #dc4d2f;',
    'button--blue'  => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>


<body style="{{ $style['body'] }}">
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="{{ $style['email-wrapper'] }}" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <!-- Logo -->
                <tr>
                    <td style="{{ $style['email-masthead'] }}">
                        <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ url('/') }}"
                           target="_blank">
                            {{ Settings::get('site_title') }}
                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td style="{{ $style['email-body'] }}" width="100%">
                        <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                    <!-- Greeting -->
                                    <h1 style="{{ $style['header-1'] }}"> {{trans("bookings.email_new_booking_notification_heading")}} </h1>

                                    <!-- Intro -->
                                    <p style="{{ $style['paragraph'] }}">

                                    <table width="100%" align="center">
                                        <tr>
                                            <td>{{trans("bookings.label_order_time")}}</td>
                                            <td>{{$data->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_booking_status")}}</td>
                                            <td>
                                                <span class="label label-{{trans_choice("bookings.status_options_color",$data->status?:1)}}">{!! trans_choice("bookings.status_options",$data->status?:1) !!}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_name")}}</td>
                                            <td>{{$data->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_email")}}</td>
                                            <td>{{$data->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_nationality")}}</td>
                                            <td>{{$data->nationality}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_mobile")}}</td>
                                            <td>{{$data->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_country")}}</td>
                                            <td>{{$data->country_id?$data->country->name:"--"}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_booking_type")}}</td>
                                            <td>{{trans("bookings.type_option.{$data->booking_type}")}}</td>
                                        </tr>
                                        @if($data->booking_type !='free')
                                            @if(($data->booking_type=="package")&&$data->package_id)
                                                <tr>
                                                    <td>{{trans("bookings.label_package")}}</td>
                                                    <td><a href="{{url("packages/{$data->package_id}/".str_slug($data->package->{"name:en"}))}}"
                                                          target="_blank">{{$data->package->name}}</a></td>
                                                </tr>
                                            @endif
                                            @if(($data->booking_type=="hotel")&&$data->hotel_id)
                                                <tr>
                                                    <td>{{trans("bookings.label_hotel")}}</td>
                                                    <td><a href="{{url("hotels/{$data->hotel_id}/".str_slug($data->hotel->{"name:en"}))}}"
                                                          target="_blank">{{$data->hotel->name}}</a></td>
                                                </tr>
                                            @endif

                                            @if(($data->booking_type=="room")&&$data->room_id)
                                                <tr>
                                                    <td>{{trans("bookings.label_hotel")}}</td>
                                                    <td><a href="{{url("hotels/{$data->hotel_id}/".str_slug($data->hotel->{"name:en"}))}}"
                                                          target="_blank">{{$data->hotel->name}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans("bookings.label_room")}}</td>
                                                    <td><a href="{{url("hotels/{$data->hotel_id}/".str_slug($data->hotel->{"name:en"}))}}"
                                                          target="_blank">{{$data->room->name}}</a></td>
                                                </tr>
                                            @endif
                                        @endif
                                        <tr>
                                            <td>{{trans("bookings.label_arrival_date")}}</td>
                                            <td>{{$data->arrival_date}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_departure_date")}}</td>
                                            <td>{{$data->departure_date}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_num_rooms")}}</td>
                                            <td>{{$data->num_rooms?:"--"}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_num_adults")}}</td>
                                            <td>{{$data->num_adults?:"--"}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_num_children")}}</td>
                                            <td>{{$data->num_children?:"--"}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_num_bags")}}</td>
                                            <td>{{$data->num_bags?:"--"}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans("bookings.label_notes")}}</td>
                                            <td>{{$data->notes?:"--"}}</td>
                                        </tr>
                                        @if($data->booking_type=='free' || $data->booking_type=='package')
                                            <tr>
                                                <td>{{trans("bookings.label_hotel_level")}}</td>
                                                <td>{{$data->hotels_level?trans_choice("hotels.hotel_stars_option",$data->hotels_level):"--"}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    </p>
                                    <!-- Action Button -->

                                    <table style="{{ $style['body_action'] }}" align="center" width="100%"
                                           cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center">
                                                <a href="{{url("/".\App\Setting::get("backend_uri")."/bookings/{$data->id}/show")}}"
                                                   style="{{ $fontFamily }} {{ $style['button'] }} {{ $style['button--blue'] }}"
                                                   class="button"
                                                   target="_blank">
                                                    {{trans("bookings.email_btn_show_booking_order")}}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td>
                        <table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                                    <p style="{{ $style['paragraph-sub'] }}">
                                        &copy; {{ date('Y') }}
                                        <a style="{{ $style['anchor'] }}" href="{{ url('/') }}"
                                           target="_blank">{{ Settings::get("site_title") }}</a>.
                                        All rights reserved.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>