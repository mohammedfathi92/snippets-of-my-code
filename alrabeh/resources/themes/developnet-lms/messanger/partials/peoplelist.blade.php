<div id="contacts">
            <ul>
              @php
              $user_ids = [];
              @endphp
        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))
            @php
              $user_ids[] = $inbox->withUser->id; 
             @endphp
                  <li @if(isset($user) && $user) class="contact {{$inbox->withUser->id == $user->id?'active':''}}" @else class="contact"@endif>
                    <div class="wrap">
                         <a href="{{route('message.read', ['id'=>$inbox->withUser->hashed_id])}}" style="color: #fff;">
                        {{-- <span class="contact-status online"></span> --}}
                        <img src="{{$inbox->withUser->picture_thumb}}" alt="" />
                        <div class="meta">
                            <p class="name">{{$inbox->withUser->name}}</p>
                           {{--   @if(auth()->user()->id == $inbox->thread->sender->id)
                        <span class="fa fa-reply"></span>
                    @endif --}}
                                         <p class="preview">{{$inbox->withUser->job_title}}</p>
                            {{-- <p class="preview">{{substr($inbox->thread->message, 0, 20)}}</p> --}}
                        </div>
                       </a> 
                    </div>
                </li>

              @endif
        @endforeach         

        @foreach(Modules\User\Models\User::where('user_type', 'teacher')->whereNotIn('id', $user_ids)->where('id', '!=', user()->id)->get() as $teacher)
 <li class="contact">
                    <div class="wrap">
                          <a href="{{route('message.read', ['id'=>$teacher->hashed_id])}}" style="color: #fff;">
                        <img src="{{$teacher->picture_thumb}}" alt="" />
                       <div class="meta">
                            <p class="name">{{$teacher->name}}</p>
                  
                     <p class="preview">{{$teacher->job_title}}</p>
                        </div>
                    </a>
                    </div>
                </li>
        @endforeach

            </ul>
        </div>

