<div class="p-course-item">
	<div class="media course-item-content">
		<img src="{{$plan->thumbnail}}" alt="course-name">
		<div class="media-body row">
			<div class="row">
				<div class="">
					<div><a href="{{route('plans.index')}}"> {{$plan->title}}</a></div>
					<p>{!! str_limit(strip_tags($plan->content), 200) !!} </p>
				</div>
				<div class="col-sm-3 item-content-badges ">
                    @if($subscription->status == 1)
					<span class="badge badge-success">
						@lang('LMS::attributes.main.status_options_text.active')
					</span>

				@else
				<span class="badge badge-warning">
						@lang('LMS::attributes.main.status_options_text.pending')
				</span>

				@endif

					{{-- <span class="badge badge-danger">{{ $plan->price }} @lang('LMS::attributes.main.currency_rs')</span> --}}
				</div>
			</div>
		</div>
	</div>

{{-- 	<div class="course-progress row">
		<span class="col-sm-2">
			@lang('developnet-lms::labels.spans.span_pass')
		</span>
		<div class="progress col-sm-8">
	    <div class="progress-bar bg-success progress-bar-striped" style="width:40%">40%</div>
	</div>
	<div class="col-sm-2 course-btn-details">
		 <a class="btn-colored " data-toggle="collapse" href="#collapseExample8" role="button" aria-expanded="false" aria-controls="collapseExample">
	    @lang('developnet-lms::labels.spans.span_details')
	  </a>
	</div>
	<div class="collapse course-grades " id="collapseExample8">
	  <div class="course-grades-content">
	    <div class="grade-statics ">
	    	<ul>
	    		<li>
		    		<span>مستوي الكورس</span>
		    		<small>صعب</small>
		    	</li>
		    		<li>
					<span>عدد الساعات:</span>
					<small>32</small>
				</li>
				<li>
					<span>عدد الاختبارات:</span>
					<small>12</small>
				</li>
	    		<li>
	    			<span>عدد الامتحانات:</span>
	    			<small>3</small>
	    		</li>
	    		<li>
	    			<span>عدد الكويزات:</span>
	    			<small>10</small>
	    		</li>

	    	</ul>
	    </div>
	    <div class="grades ">
	    	<p>@lang('developnet-lms::labels.spans.span_percentage')</p>
	    	<div class="circle" id="circles-1"></div>
	    	<div><span>@lang('developnet-lms::labels.spans.span_total') 350 / 400</span></div>
	    </div>
	    <div>
	    	<div class="certification-link">
	    	<a href="#" class="btn-certification btn-colored" data-toggle="modal" data-target="#certificatonModal">@lang('developnet-lms::labels.spans.span_certification')</a>
	    	</div>
	    </div>
	  </div>
	</div>
	</div> --}}
</div>
