@extends('layouts.lesson') 
@php
$closeItemRoute = route('courses.show', ['id' => $course->hashed_id]);
$breadcrumb = [
	['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
	['name' => __('developnet-lms::labels.links.link_page_courses'), 'link' => route('courses.index')],
	['name' => $course->title, 'link' => route('courses.show', ['id' => $course->hashed_id])],
	
	['name' => __('developnet-lms::labels.spans.show_results'), 'link' => false],
];

			
@endphp

@php


 //course progress
    $progress = $courseProgress['progress'];
    $courseLog = $progress['courseLog'];
    $completedLessons =  $progress['completedLessons'];
    $unrolledLessonsCount = $progress['unrolledLessons'];
    $unrolledQuizzesCount = $progress['unrolledQuizzes'];
    $passedQuizzes = $progress['passedQuizzes'];
    $unpassedQuizzes = $progress['unpassedQuizzes'];
    $percentage = 0;

@endphp
@section('css')
	<style>
		.grade-statics  li{
			margin-bottom: 10px;
		}
		.grade-statics  li span{
			font-size: 17px;
    		display: inline-block;
    		margin-left: 10px;
    		width: 180px;
    		text-align: right;
		}
		.course-grades-content{
			border: transparent;
			align-items: initial;
		}
		.course-grades {
			background: #fcfcfc;
			border: 1px solid #ddd;
			padding-bottom: 10px
		}
		.grades {
			margin-top: 10px
		} 
	</style>

@stop

@section('content')
	      	@php
	      	$courseLoggedItems = $courseLogs->children()->get();
	      	@endphp
				
		<section class="page-content">
	  	<div class="container">
	      <div class="row"> 
	     
	      <div class="col-lg-9">
	        	{{-- <p>هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصًا بديلًا ومؤقتًا.
	        	 هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصًا بديلًا ومؤقتًا.</p>
	        	 <br> --}}
	        	 <div class="page-side-title normal">
					<h4>
						@lang('developnet-lms::labels.cert.course_results')
					</h4>
				</div>
					  @if($courseLogs->status < 1)
				   <div class="text-center">
			    	<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#completeCourseModal">@lang('developnet-lms::labels.cert.btn_mark_course_as_complete')</a>
			    </div>

			    @else

			    @if($courseLogs->passed)

			  <div class="message message-success alert alert-success" role="alert"> 
					<i class="fa"></i> {!! __('developnet-lms::labels.messages.course_pass_result', ['degree' =>  $courseLogs->degree.'%', 'passing_grade' => $courseLogs->passing_grade.'%', 'user' =>user()->name]) !!} 
				</div>

				{{--   <div class="text-center">
			    	<a href="#" class="btn-certification btn-colored" data-toggle="modal" data-target="#exampleModal">@lang('developnet-lms::labels.cert.show_cert')</a>
			    </div> --}}
			    @else

			    <div class="message message-error alert alert-danger" role="alert"> 
					<i class="fa"></i> {!! __('developnet-lms::labels.messages.course_failed_result', ['degree' =>  $courseLogs->degree.'%', 'passing_grade' => $courseLogs->passing_grade.'%']) !!} 
				</div>

			    @endif


			    @endif
	        	 <div class=" course-grades ">
				  <div class="course-grades-content">
				    <div class="grade-statics ">
				    	<ul style="list-style-type: none; padding: 0"> 
				    	
					    	<li>
								<span>@lang('developnet-lms::labels.cert.count_completed_lessons')</span>
								<small>{{$courseLoggedItems->where('lms_loggable_type', 'lesson')->where('status', 1)->where('passed', true)->count()}}</small>
							</li>
							<li>
								<span>@lang('developnet-lms::labels.cert.count_completed_quizzes')</span>
								<small>{{$courseLoggedItems->where('lms_loggable_type', 'quiz')->where('status', 1)->where('passed', true)->count()}}</small>
							</li>
				    		<li>
				    			<span>@lang('developnet-lms::labels.cert.course_log_date')</span>
				    			<small>{!! format_date($courseLogs->created_at) !!}</small>
				    		</li>
				    		<li>
				    			<span>@lang('developnet-lms::labels.cert.course_finished_date')</span>
				    			<small>@if($courseLogs->finished_at){!! format_date($courseLogs->finished_at) !!} @else @lang('developnet-lms::labels.cert.no_finished') @endif</small>
				    		</li>

				    		

				    	</ul>
				    </div>
				   
				    <div class="grades col-lg-5">
				    	<p>@lang('developnet-lms::labels.spans.span_percentage')</p>
				    	@if($courseLogs->status > 0)

				    	<div class="circle" id='circles-course-{{$course->hashed_id}}'></div>
				    	@else
				    	<p>@lang('developnet-lms::labels.cert.not_calculate_degree')</p>
				    	
				    	@endif
				    	{{-- <div><span>@lang('developnet-lms::labels.spans.span_total') 350 / 400</span></div> --}}
				    </div>
				    
				  </div>
			

				</div>
	        </div>
	      
	       

	      </div>

	    </div>
	    
	</section>  
   
	  {{--   <div class="col-sm-12 text-center" style="margin-bottom: 30px;">
	    	 {!! Form::model($lesson, ['url' => route('courses.lesson_completed', ['course_id' => $course->hashed_id, 'lesson_id'=> $lesson->hashed_id]),'method'=>'PUT','files'=>true]) !!}

	    	 @if($enrollStatus['success'] && $enrollStatus['status'] == 1)
               <button type="submit" class="btn btn-danger">{{__('developnet-lms::labels.buttons.btn_uncompleted')}}</button>
	    	@else
	    	  <button type="submit" class="btn btn-success">{{__('developnet-lms::labels.buttons.btn_completed')}}</button>

	    	@endif
	    	

	    	 {!! Form::close() !!}
	    </div> --}}

	  
@endsection

@section('after_content')
<!-- Modal -->
<div class="modal fade" id="completeCourseModal" tabindex="-1" role="dialog" aria-labelledby="completeCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #fff">
      {{-- <div class="modal-header">
        <h5 class="modal-title" id="completeCourseModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}

       {!! Form::model($course, ['url' => route('courses.course_completed', ['course_id' => $course->hashed_id]),'method'=>'PUT','files'=>true]) !!}
      <div class="modal-body">

      	@if($unrolledLessonsCount && $unrolledQuizzesCount)
      	
<p>{!! __('developnet-lms::labels.cert.msg_finish_uncompleted_course') !!}</p>
@else

<p>{!! __('developnet-lms::labels.cert.msg_finish_completed_course') !!}</p>

@endif
              

      </div>
      <div class="modal-footer">
      	 <button type="submit" class="btn btn-primary">@lang('developnet-lms::labels.cert.btn_mark_course_as_complete')</button>
        <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>
       
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection


 @section('js')

 {!! Theme::js('js/circles.min.js"') !!}  
<script>
		Circles.create({
			id:           'circles-course-{{$course->hashed_id}}',
			value:        {{$courseProgress['degree']}},
			radius:       60,
			width:        8,
			duration:     1,
			colors:       ['#d1e4d6', '#28a745 ']
		});
	</script>
@stop
