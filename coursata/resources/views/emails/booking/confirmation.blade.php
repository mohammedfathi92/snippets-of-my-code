<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
<div>{{trans("booking.email_thank_you")}}</div>
<h3>{{trans("booking.email_header_booking_information")}}</h3>
<table>
    <tr>
        <td>{{trans("booking.label_order_time")}}</td>
        <td>{{$data->created_at}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_booking_status")}}</td>
        <td><span class="label label-{{trans_choice("bookings.status_options_color",$data->status?:1)}}">{!! trans_choice("bookings.status_options",$data->status?:1) !!}</span></td>
    </tr>
    <tr>
        <td>{{trans("booking.label_name")}}</td>
        <td>{{$data->name}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_email")}}</td>
        <td>{{$data->email}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_nationality")}}</td>
        <td>{{$data->nationality}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_mobile")}}</td>
        <td>{{$data->mobile}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_country")}}</td>
        <td>{{$data->country_id?$data->country->name:"--"}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_arrival_date")}}</td>
        <td>{{$data->arrival_date}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_departure_date")}}</td>
        <td>{{$data->departure_date}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_num_courses")}}</td>
        <td>{{$data->departure_date?:"--"}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_num_courses")}}</td>
        <td>{{$data->departure_date?:"--"}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_num_adults")}}</td>
        <td>{{$data->num_adults?:"--"}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_num_children")}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_num_bags")}}</td>
        <td>{{$data->num_bags?:"--"}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_notes")}}</td>
        <td>{{$data->notes?:"--"}}</td>
    </tr>
    <tr>
        <td>{{trans("booking.label_institute_level")}}</td>
        <td>{{trans_choice("institutes.institute_level_options",$data->institutes_level)}}</td>
    </tr>
</table>

</body>
</html>