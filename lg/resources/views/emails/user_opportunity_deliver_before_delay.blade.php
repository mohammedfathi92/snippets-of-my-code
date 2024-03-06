@extends("layouts.emails")
@section("content")
    {!!
    trans("emails.your_opportunity_closed",[
    'client_name'=>$data->client_name,
    'days'=>$days,
    'url'=>url("opportunities/".$data->id."/show")],'messages',$language) !!}
@endsection