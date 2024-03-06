@extends("layouts.emails")
@section("content")
    {!!
    trans("emails.email_new_message_com",[
    'user_name'=>$user_name,
    'sender'=>$data->sender->name,
    'url'=>url("manage/contacts/".$data->id."/message"),
    ],'messages',$language) !!}
@endsection