 
<div class="item subject-block">
  	<a href="{{ route('courses.show', $course->hashed_id) }}" class="subject-img">
  		<img src="{{$course->thumbnail}}">
  		<span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
  	</a>
  	<div class="subject-content">
			<a href="{{route('courses.show', $course->hashed_id)}}" class="sub-content-title">{{$course->title}}</a>
      @if($course->started_at)
			<div class="sub-content-details">
				<i class="fa fa-calendar"></i> 
				<span>@lang('developnet-lms::labels.spans.span_start_at') </span>
        
				<span>
 
         {{format_date($course->started_at)}}
        </span>

			</div>
      @endif
  	</div>
  	<div class="subject-meta">
  		<div class="subject-overview">
  			<i class="fa fa-group"></i>


  			<span>{{$course->enrolled_students + $course->subscriptions()->count()}}</span>
  			{{-- <i class="fa fa-comment"></i>
  			<span>0</span> --}}

  		</div>
  		<div class="subject-value">

              @php

              if($course->sale_price > 0){

                $coursePrice = $course->sale_price;

              }else{
                $coursePrice = $course->price;
              }
              @endphp
             

              @if($coursePrice > 0)
              <span class="money">{{$coursePrice}} ريال</span>
              @if($course->sale_price > 0 && $course->sale_price < $course->price)
              <span class="subject-value-deleted">{{$course->price}} ريال</span>
              @endif
              @else
              <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
              @endif


 {{--        @if($course->sale_price)
            @if($course->sale_price ==0)
              <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
            @elseif($course->sale_price == $course->price || $course->price < $course->sale_price)  
              
              <span class="money"> {{$course->sale_price}}$</span>
            @else
              <span class="subject-value-deleted">{{$course->price}}$</span>
                  <span class="money"> {{$course->sale_price}}$</span>
            @endif  
          
          @endif --}}

  		</div> 
  	</div>
 </div>