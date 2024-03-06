@extends('messanger.layouts.chat')

@section('content')
    <ul id="talkMessages">
         @foreach($messages as $message)
                @if($message->sender->id == auth()->user()->id)
                <li class="sent" id="message-{{$message->id}}" style="text-align: right; direction: rtl;">
                    <img src="{{ user()->picture_thumb }}" alt="" />
                    @if($message->media_url)
                    <div style="margin: 0px 10px;" class="pull-right"><audio controls="" src="{{\Storage::get($message->media_url)}}"></audio></div>
                    {{-- <div class="pull-right"> <p>{{$message->message}}</p></div> --}}
                    @else
                      <div class="pull-right"> {!! $message->message!!}</div>
                        @endif
                    
                    
                     <span class="message-data-time" >منذُ {{$message->humans_time}}</span> &nbsp; &nbsp;
                    <a href="javascript:;" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message"><i class="fa fa-close"></i></a>
                </li>
                @else
                <li class="replies" style="text-align: right;">
                    <img src="{{ user()->picture_thumb }}" alt="" />
                    @if($message->media_url)
                    <p><audio controls="" src="{{$message->media_url}}"></audio></p>
                        @else


                        <div class="pull-left"> {!! $message->message!!}</div>

                        @endif
                    
                    
                     <span class="message-data-time" >منذُ {{$message->humans_time}}</span> &nbsp; &nbsp;
                    {{-- <a href="javascript:;" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message"><i class="fa fa-close"></i></a> --}}
                </li>
                @endif
                @endforeach
              
            </ul>
@endsection
