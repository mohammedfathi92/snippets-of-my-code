  <li class="sent" id="message-{{$message->id}}" style="text-align: right; direction: rtl;">
                    <img src="{{ user()->picture_thumb }}" alt="" />
                    @if($message->media_url)
                    <div style="margin: 0px 10px;" class="pull-right"><audio controls="" src="{{\Storage::get($message->media_url)}}"></audio></div>
                    {{-- <div class="pull-right"> <p>{{$message->message}}</p></div> --}}
                    @else
                      <div class="pull-right"> <p>{{$message->message}}</p></div>
                        @endif
                    
                    
                     <span class="message-data-time" >منذُ {{$message->humans_time}}</span> &nbsp; &nbsp;
                    <a href="#" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message"><i class="fa fa-close"></i></a>
                </li>



           