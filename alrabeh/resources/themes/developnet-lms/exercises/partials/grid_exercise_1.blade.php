 
<div class="item subject-block">
  	<a href="{{ route('exercises.show', $exercise->hashed_id) }}" class="subject-img">
  		<img src="{{$exercise->thumbnail}}">
  		<span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
  	</a>
  	<div class="subject-content">
			<a href="{{route('exercises.show', $exercise->hashed_id)}}" class="sub-content-title">{{$exercise->title}}</a>
      @if($exercise->started_at)
			<div class="sub-content-details">
				<i class="fa fa-calendar"></i> 
				<span>@lang('developnet-lms::labels.spans.span_start_at') </span>
        
				<span>
 
         {{format_date($exercise->started_at)}}
        </span>

			</div>
      @endif
  	</div>
  	<div class="subject-meta">
  		<div class="subject-overview">
  			<i class="fa fa-group"></i>


  			<span>{{$exercise->enrolled_students + $exercise->subscriptions()->count()}}</span>
  			{{-- <i class="fa fa-comment"></i>
  			<span>0</span> --}}

  		</div>
  		<div class="subject-value">


        @if($exercise->sale_price)
            @if($exercise->sale_price ==0)
              <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
            @elseif($exercise->sale_price == $exercise->price || $exercise->price < $exercise->sale_price)  
              
              <span class="money"> {{$exercise->sale_price}}$</span>
            @else
              <span class="subject-value-deleted">{{$exercise->price}}$</span>
                  <span class="money"> {{$exercise->sale_price}}$</span>
            @endif  
          
          @endif

  		</div> 
  	</div>
 </div>