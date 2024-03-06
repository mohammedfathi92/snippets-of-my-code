 
<div class="item subject-block">
  	<a href="{{ route('quizzes.show', $quiz->hashed_id) }}" class="subject-img">
  		<img src="{{$quiz->thumbnail}}">
  		<span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
  	</a>
  	<div class="subject-content">
			<a href="{{route('quizzes.show', $quiz->hashed_id)}}" class="sub-content-title">{{$quiz->title}}</a>
      @if($quiz->started_at)
			<div class="sub-content-details">
				<i class="fa fa-calendar"></i> 
				<span>@lang('developnet-lms::labels.spans.span_start_at') </span>
        
				<span>
 
         {{format_date($quiz->started_at)}}
        </span>

			</div>
      @endif
  	</div>
  	<div class="subject-meta">
  		<div class="subject-overview">
  			<i class="fa fa-group"></i>


  			<span>{{$quiz->enrolled_students + $quiz->subscriptions()->count()}}</span>
  			{{-- <i class="fa fa-comment"></i>
  			<span>0</span> --}}

  		</div>
  		<div class="subject-value">


        @if($quiz->sale_price)
            @if($quiz->sale_price ==0)
              <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
            @elseif($quiz->sale_price == $quiz->price || $quiz->price < $quiz->sale_price)  
              
              <span class="money"> {{$quiz->sale_price}} ريال</span>
            @else
              <span class="subject-value-deleted">{{$quiz->price}} ريال</span>
                  <span class="money"> {{$quiz->sale_price}} ريال</span>
            @endif  
          
          @endif

  		</div> 
  	</div>
 </div>