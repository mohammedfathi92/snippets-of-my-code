@extends("layouts.emails")
@section("content")
    {!!
    trans("emails.user_opportunity_progress_updated",[
    'client_name'=>$data->client_name,
    'url'=>url("opportunities/".$data->id."/show"),
    'changer_name'=>$data->statusChanger->name,
    'user_name'=>$data->user->name],'messages',$language) !!}
@endsection