      
  <br>

  <div class="post-comment block">
     <h2 class="reply-title">{{trans('main.title_reviews_members')}}</h2>
      <div class="travelo-box">
         <div class="row">
         
          

{!! Form::open(['url'=>route('review',['module'=>$module,'module_data'=>$module_data->id]), 'id'=>'form_review'] ) !!}
 @if($module_data->reviews()->count())

 @php

$sum_reviews = $module_data->reviews()->sum('amount');
$result = round($sum_reviews / $module_data->reviews()->count());



 @endphp
 
           <div class="col-md-6" style="padding-right: 100px">

           <div>
                  {{trans('main.members_reviews')}}
               
</div>
<div>
                 <div class="feedback clearfix">
                    <div title="{{trans_choice("main.reviews_stars_option",$result)}}"
                         class="five-stars-container" data-toggle="tooltip" data-placement="bottom">
                      <span class="five-stars" style="width: {{$result *20}}%;"></span></div>
                      

                </div>
                 <small>( {{trans('main.users_reviews_count') . $module_data->reviews()->count()}} )</small>
              </div>
            </div>
            @else
        <div class="col-md-6">

           <div>
                  {{trans('main.members_reviews')}}
               
</div>
<div>
                 <div class="feedback clearfix">
                    <div title="There isn't any reviews for this items"
                         class="five-stars-container" data-toggle="tooltip" data-placement="bottom">
                        <span class="five-stars" style="width: 0;"></span></div>

                </div>
              </div>
            </div>
            @endif
            @if(Auth::check())
              <div class="col-md-6">
            <div>
               <span style="text-align: center;">{{trans('main.send_your_review')}}</span>
                
                
               </div>
               <div>
  @php
  $auth_review = $module_data->reviews()->where('member_id', Auth::id())->first();  
  @endphp 


                                     
<div class="form-group {{!$errors->has("review_amount")?:"has-error"}}">
@if($auth_review)   
<fieldset class="rating">
    <input type="radio" id="star5" name="review_amount" value="5" @if($auth_review->amount == '5') checked @endif/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
   
    <input type="radio" id="star4" name="review_amount" value="4"  @if($auth_review->amount == '4') checked @endif/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    
    <input type="radio" id="star3" name="review_amount" value="3" @if($auth_review->amount == '3') checked @endif/><label class = "full" for="star3" title="Meh - 3 stars"></label>
    
    <input type="radio" id="star2" name="review_amount" value="2" @if($auth_review->amount == '2') checked @endif/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    
    <input type="radio" id="star1" name="review_amount" value="1"  @if($auth_review->amount == '1') checked @endif/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>

   
</fieldset>

@else
<fieldset class="rating">
    <input type="radio" id="star5" name="review_amount" value="5"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
   
    <input type="radio" id="star4" name="review_amount" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    
    <input type="radio" id="star3" name="review_amount" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    
    <input type="radio" id="star2" name="review_amount" value="2"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    
    <input type="radio" id="star1" name="review_amount" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>

   
</fieldset>
@endif

 @if ($errors->has("review_amount"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("review_amount") }}</strong>
                                                </span>
                                        @endif
            </div>

            </div>
        
        
                                  
                  </div>
                  @else

                   <div class="col-md-6">
            <div>
               <center><div>{{trans('main.send_your_review')}}</div>
                <a href="#login"><strong style="color: #0a8eff; text-align: center;">{{trans('main.to_review_login')}}</strong> </a></center>
                
               </div>
               <div>
            
                                      
  

            </div>
        
        
                                  
                  </div>

                  @endif
            
         </div>
        

          {!! Form::close() !!}
            
      

                                </div>
                                </div>
                               
                            

     <br>

   <!-- Start Comment -->


       <div class="comments-container block">
                                <h2>{{trans('main.label_comments', ['count'=> $module_data->comments()->where('status', 1)->count()?:'0'])}}</h2>
                 @if($module_data->comments()->where('status', 1)->count())
                                <ul class="comment-list travelo-box">
            
                     @foreach($module_data->comments()->where('status', 1)->with('children')->whereNull('parent_id')->get() as $parent)
                                    <li class="comment depth-1">
                                        <div class="the-comment">
                                            <div class="avatar">
                                                 @if($parent->member->avatar)
                                                        <img src="{{ url("/files/".$parent->member->avatar."?size=72,72") }}" width="72" height="72" alt="{{$parent->member->name}}">

                                                        @else
                                                         <img src="{{$parent->member->gravatar.'?d=mm'}}" width="72" height="72" alt="{{$parent->member->name}}">
                                                        @endif
                                            </div>
                                            <div class="comment-box">
                                                <div class="comment-author">
                                                    {{-- <a href="#" class="button btn-mini pull-right">{{trans('main.label_reply')}}</a>  --}}
                                                    <h4 class="box-title"><a href="#">{{$parent->creator_name}}</a><small>{!! \Carbon\Carbon::instance($parent->created_at)->diffForHumans() !!}</small></h4>
                                                </div>
                                                <div class="comment-text">
                                                    <p>{!!$parent->content!!}</p>
                                                </div>
                                            </div>
                                        </div>
                                         @if($parent->children()->where('status', 1)->count())
                                        <ul class="children">
                                   
                                     @foreach ($parent->children()->where('status', 1)->get() as $child)

                                            <li class="comment depth-2">
                                                <div class="the-comment">
                                                    <div class="avatar">
                                                        @if($parent->member->avatar)
                                                        <img src="{{ url("/files/".$parent->member->avatar."?size=72,72") }}" width="72" height="72" alt="{{$parent->member->name}}">

                                                        @else
                                                         <img src="{{$parent->member->gravatar.'?d=mm'}}" width="72" height="72" alt="{{$parent->member->name}}">
                                                        @endif
                                                    </div>
                                                    <div class="comment-box">
                                                        <div class="comment-author">
                                                          {{-- <a href="#" class="button btn-mini pull-right">{{trans('main.label_reply')}}</a>  --}}
                                                            <h4 class="box-title"><a href="#">{{$child->creator_name}}</a><small>{!! \Carbon\Carbon::instance($child->created_at)->diffForHumans() !!}</small></h4>
                                                        </div>
                                                        <div class="comment-text">
                                                            <p>{!!$child->content!!}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                             @endforeach
                                        </ul>
                                         @endif
                                          <div class="travelo-box">

                                             @if(Auth::check())
                                                
                                   {!! Form::open(['url'=>route('replies',['module'=> $module,'module_data'=>$module_data->id, 'parent_id' => $parent->id])] ) !!}
            
                                       
                                        <div class="col-md-10 form-group">
                                      
                                            <textarea rows="1" name="content" class="input-text full-width text-rtl" placeholder="{{trans('main.write_replay')}}"></textarea>

                                        </div>

                                         <input type="hidden" name="local" value="{{$locale}}">

                                        <div class="col-md-2">
                                            <button type="submit" class="btn-large full-width">{{trans('main.label_reply')}}</button>
                                        </div>
                                        
                                   {!! Form::close() !!}

                                   @endif

                                 
                                

                                </div>
                                    </li>
                                    @endforeach
                           
                                </ul>
                                 @else
                                <ul class="comment-list travelo-box">
                                 <li class="comment depth-1">
                                        <div class="the-comment">
                                            {{trans('main.text_no_comments_yet')}}
                                        </div>
                                    </li>
                                </ul>
                                @endif

                            </div>


                            <div class="post-comment block" id="login">
                                <h2 class="reply-title">{{trans('main.text_post_comment')}}</h2>
                                <div class="travelo-box">

                       @if(Auth::check())           
                                    {!! Form::open(['url'=>route('comments',['module'=> $module,'module_data'=>$module_data->id])] ) !!}
            
                                       
                                        <div class="form-group">
                                            <label>{{trans('main.label_your_comment')}} *</label>
                                            <textarea rows="6" name="content" class="input-text full-width text-rtl" placeholder="{{trans('main.write_comment')}}"></textarea>
                                        </div>

                                         <input type="hidden" name="local" value="{{$locale}}">
                                        
                                        <button type="submit" class="btn-large full-width">{{trans('main.btn_send_comment')}}</button>
                                   {!! Form::close() !!}

@else 
                                   <center><strong>{{trans('auth.to_comment_login')}}</strong> <a href="{{route('register')}}"><strong style="color: #0a8eff">{{trans('auth.to_comment_signup')}}</strong></a></center>
                                  <br>
                                        {!! Form::open(['url'=>route('login')] ) !!}

                    <div class="form-group">
                         <input type="text" id="email" type="email" name="email" value="{{ old('email') }}" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.email")}}" required>
                                @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                    </div>
                    <div class="form-group">
                         <input id="password" type="password"  name="password" class="input-text input-large full-width text-rtl" placeholder="{{trans("auth.password")}}" required>

                                 @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                    </div>
                    <div class="form-group">
                        <a href="{{\LaravelLocalization::localizeURL('password/reset')}}" style="color: #fdb714;"> {{trans("auth.forgot_pass")}}</a>
                        <div class="form-group">
                                <label class="checkbox">
                                    <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} ><span class="remember-rtl">{{trans("auth.remember_me" )}}</span>
                                </label>
                            </div>
                             <button type="submit" class="btn-large full-width sky-blue1">{{trans("auth.btn_front_login")}}</button>
                    </div>
                 {!! Form::close() !!}

                @endif

                                </div>
                            </div> 

                            <!-- End Comments -->
