@php
$logsPercentage = 0;
$userItemLogsDegree = 0;
$logStatus = 0;
$quizQuestions = $quiz->questions()->where('status', true)->count();

if($quiz && $userLogs->count()){
	$userItemLogs = $userLogs->where('lms_loggable_type', 'quiz')->where('lms_loggable_id', $quiz->id)->last();

	}

if(isset($userItemLogs) && $userItemLogs){
	$loggedQuestions = $userLMS->logs()->where('parent_id', $userItemLogs->id)->where('status', 1)->where('lms_loggable_type', 'question')->where('skipped', false)->count();
	$logsPercentage = ($loggedQuestions / $quizQuestions?:1) * 100;
	$userItemLogsDegree = $userItemLogs->degree;
	$logStatus = $userItemLogs->status;
}
@endphp

<div class="p-course-item">
	<div class="media course-item-content">
		<img src="/assets/themes/developnet-lms/img/05.jpg" alt="course-name">
		<div class="media-body row">
			<div class="row">
				<div class="">
					<div><a href="{{route('quizzes.show', ['id' => $quiz->hashed_id])}}"> {{$quiz->title}} </a></div>
					<p> {!! str_limit(strip_tags($quiz->content), 200) !!} </p>
				</div>
				<div class="col-sm-3 item-content-badges">
					@if(isset($userItemLogs) && $userItemLogs && !empty($userItemLogs))
                    @if($userItemLogs->status == 1)
                    @if($userItemLogs->passed > 0)
					<span class="badge badge-success">
						@lang('LMS::attributes.main.passed_status_text.passed')
					</span>
					@else

					<span class="badge badge-danger">
						@lang('LMS::attributes.main.passed_status_text.unpassed')
					</span>

					@endif



				@else
				<span class="badge badge-primary">
						@lang('LMS::attributes.main.passed_status_text.inprogress')
				</span>

				@endif
				@else

				<span class="badge badge-warning">
						@lang('LMS::attributes.main.passed_status_text.notStarted')
				</span>

				@endif

					{{-- <span class="badge badge-danger">{{ $plan->price }} @lang('LMS::attributes.main.currency_rs')</span> --}}

				</div>
			</div>
		</div>
	</div>

	<div class="course-progress row">
		<span class="col-sm-2">
			@lang('developnet-lms::labels.spans.span_pass')
		</span>
		<div class="progress col-sm-8">
	    <div class="progress-bar bg-success progress-bar-striped" style="width:{{$logsPercentage}}%">{{round($logsPercentage)}}%</div>
	</div>
	<div class="col-sm-2 course-btn-details">
		 <a class="btn-colored " data-toggle="collapse" href="{{'#collapseQuiz'.$quiz->hashed_id}}" role="button" aria-expanded="false" aria-controls="{{'collapseQuiz'.$quiz->hashed_id}}">
	    @lang('developnet-lms::labels.spans.span_details')
	  </a>
	</div>
	<div class="collapse course-grades " id="{{'collapseQuiz'.$quiz->hashed_id}}">
	  <div class="course-grades-content">
	    <div class="grade-statics ">
	    	<ul>
	    		<li>
		    		<span> @lang('developnet-lms::labels.items_details.quiz_level') : </span>
		    		<small> @lang('LMS::attributes.main.level_options_easabilty.'.$quiz->level)</small>
		    	</li>
		    		<li>
					<span> @lang('developnet-lms::labels.items_details.quiz_duration') :</span>
					<small>{{$quiz->duration}} @if($quiz->duration > 2 && $quiz->duration < 11)@lang('LMS::attributes.main.minutes') @else @lang('LMS::attributes.main.minute')
					@endif</small>
				</li>
				<li>
					<span> @lang('developnet-lms::labels.items_details.quiz_questions_num') :</span>
					<small>{{$quizQuestions}}</small>
				</li>
	    		<li>
	    			<span> @lang('developnet-lms::labels.items_details.subscribed_at') :</span>
	    			<small>{!! \Carbon\Carbon::instance($subRow->created_at)->diffForHumans() !!}</small>
	    		</li>

	    	</ul>
	    </div>
		    <div class="grades ">
	    	@if($logStatus)
	    	<p>@lang('developnet-lms::labels.spans.span_percentage')</p>
	    	<div class="circle" id="{{'circles-quiz'.$quiz->id}}"></div>
	    	@else

	    	<div><p>@lang('developnet-lms::labels.spans.span_percentage')</p>
	    		<span>@lang('developnet-lms::labels.spans.span_not_cal_percentage')</span></div>
	    	@endif
	    	{{-- <div><span>@lang('developnet-lms::labels.spans.span_total') 350 / 400</span></div> --}}
	    </div>
	{{--     <div>
	    	<div class="certification-link">
	    	<a href="#" class="btn-certification btn-colored" data-toggle="modal" data-target="#certificatonModal">@lang('developnet-lms::labels.spans.span_certification')</a>
	    	</div>
	    </div> --}}
	  </div>
	</div>
	</div>
</div>



    @php

    $cert_id = null;

    if(isset($userItemLogs) && $userItemLogs){

	    $certificate = \Modules\Components\LMS\Models\StudentCertificate::where('log_id',$userItemLogs->id)->first();


	    if(countData($certificate)){

	    	$cert_id = $certificate->hashed_id;

	    }
}

	    @endphp

	   @if($cert_id)
	    	<div class="certification-link">
	    	<a href="javascript:;" class="btn-certification btn-colored" data-toggle="modal" data-target="#certificatonModal" data-url="{{route('ajax.get_certificate', $cert_id)}}" data-id="{{$cert_id}}">@lang('developnet-lms::labels.spans.span_certification')</a>
	    	</div>
	    	@endif

@push('scripts_profile')
   <script>
		Circles.create({
			id:           '{{'circles-quiz'.$quiz->id}}',
			value:        '{{$userItemLogsDegree}}',
			radius:       60,
			width:        8,
			duration:     1,
			colors:       ['#d1e4d6', '#28a745 ']
		});
	</script>
@endpush
