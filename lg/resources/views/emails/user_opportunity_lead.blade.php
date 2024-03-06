@extends("layouts.emails")
@section("content")
    {!! trans("emails.your_opportunity_lead",[
    'client_name'=>$data->client_name,
    'user_name'=>$data->user->name,
    'url'=>url("opportunities/".$data->id."/show"),
    'changer_name'=>$data->statusChanger->name],'messages',$language) !!}
@endsection