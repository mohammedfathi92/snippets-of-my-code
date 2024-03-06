<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
<div>{{trans("bookings.email_thank_you")}}</div>
<h3>{{trans("bookings.email_header_booking_information")}}</h3>
<table>
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
                <td><a href="{{url("packages/{$data->package_id}/".make_slug($data->package->name))}}"
                      target="_blank">{{$data->package->name}}</a></td>
            </tr>
        @endif
        @if(($data->booking_type=="hotel")&&$data->hotel_id)
            <tr>
                <td>{{trans("bookings.label_hotel")}}</td>
                <td><a href="{{url("hotels/{$data->hotel_id}/".make_slug($data->hotel->name))}}"
                      target="_blank">{{$data->hotel->name}}</a></td>
            </tr>
        @endif

        @if(($data->booking_type=="room")&&$data->room_id)
            <tr>
                <td>{{trans("bookings.label_hotel")}}</td>
                <td><a href="{{url("hotels/{$data->hotel_id}/".make_slug($data->hotel->name))}}"
                      target="_blank">{{$data->hotel->name}}</a></td>
            </tr>
            <tr>
                <td>{{trans("bookings.label_room")}}</td>
                <td><a href="{{url("hotels/{$data->hotel_id}/".make_slug($data->hotel->name))}}"
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

</body>
</html>