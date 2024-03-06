  <div class="item subject-block">
  	<a href="{{ route('courses.show', $course->id) }}" class="subject-img">
  		<img src="/assets/themes/developnet-lms/img/02.jpg">
  		<span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
  	</a>
  	<div class="subject-inst">
  		<a href="#">
  		<img src="/assets/themes/developnet-lms/img/user.png">
  		<span>Instructor Mike</span>
  		</a>
  	</div>
  	<div class="subject-content">
			<a href="{{route('courses.show', $course->id)}}" class="sub-content-title">{{$course->title}}Course</a>
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
        <span>{{$course->enrolled_students}}</span>
        <i class="fa fa-comment"></i>
        <span>0</span>
      </div>
      <div class="subject-value">
        @if($course->sale_price)
        <span class="money">{{$course->sale_price}} ريال</span>
        @else
        <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
        @endif
      </div> 
    </div>
 </div>