

 @php
 $index_section = $loop->index + 1;
    $sectionItems = [];

	if($section->lessons){

   		foreach($section->lessons as $less){

   			$order = $less->pivot->order;
   			

   			$sectionItems[] = ['type' => 'lesson', 
   							'id' => $less->id, 
   							'hashId' => $less->hashed_id,
   							'title' => $less->title, 
   							'order'=> $less->order, 
   							'duration' => $less->duration, 
   							'item_type' => $less->type,
   							'duration_unit' => $less->duration_unit];

     }


   	}

   	if($section->quizzes){

   		foreach($section->quizzes as $q){

   			$order = $q->pivot->order;
   			

   		 $sectionItems[] = ['type' => 'quiz', 
   		 					'id' => $q->id, 
   		 					'hashId' => $q->hashed_id,
   		 					'title' => $q->title, 
   		 					'order'=> $q->order,
   		 					'duration' => $q->duration,
   		 					'item_type' => 'quiz',
   							'duration_unit' => $q->duration_unit];


     }


   	}
   //	array_reverse () desc

   	$sectionItemsSortable = array_values(collect($sectionItems)->sortBy('order')->toArray()); //asc

 @endphp

<li>  
	<div class="curriculum-section-header" data-toggle="collapse" href="#{{'collapseSection_'. $section->id}}" role="button" aria-expanded="false" aria-controls="{{'collapseSection_'. $section->id}}">
		<div><i class="fa fa-chevron-down"></i><h4>{{$section->title}}</h4></div>
		<span class="meta">{{$index_section}}/{{$courseSections->count()}}</span>
 	</div>
 	<div class="collapse curriculum-section-content" id="{{'collapseSection_'. $section->id}}">
	 	<ul class="section-content" style="display: block;">

	 		   

	 		@foreach($sectionItemsSortable as $index_item => $row)
	 		@php
	 		$itemArray = [
	 			'module' => $row['type'],
	 			'module_id' => $row['id'],
	 			'user' => $authUser,
	 			'parent' => ['type' => 'course',
	 			'id' => $course->id

	 			]
	 		];

	 		$enroll = \Logs::enroll_status($itemArray);
	 		$enroll_status = $enroll['status'];
	 		if($enroll_status == 1){
	 		    $bg_color = 'background-color: #1ade3c;';
	 			$text_color = 'color: #fff";';
	 		}elseif ($enroll_status == 0){
	 		    $bg_color = 'background-color: #ffc107;';
	 			$text_color = 'color: #fff";';
	 		}else{
	 			$bg_color = '';
	 			$text_color = '';
	 		}
	 		if(!Auth::check()){
	 			$bg_color = '';
	 			$text_color = '';

	 		}

	 		@endphp
	 		<li class="course-item" style="{!! $bg_color !!} {!! $text_color !!}">
	 			<div class="meta-left"> 
	 				<span class="course-format-icon">
	 					<i class="fa @if($row['item_type'] == 'quiz') fa-puzzle-piece 
	 								@elseif ($row['item_type'] == 'video') fa-play-circle 
	 								@elseif  ($row['item_type'] == 'audio') fa fa-volume-up
	 								 @else fa-file-o @endif" style="{!! $text_color !!}"></i>
	 				</span>
	 				<div class="index">
	 					<span class="label">@if($row['item_type'] == 'quiz')@lang('developnet-lms::labels.spans.quiz') @else @lang('developnet-lms::labels.spans.lecture') @endif </span><span class="order">
	 						{{$index_section}}.{{$index_item + 1}}</span>
	 						
	 				</div>
	 			</div> 
	 			@if($row['type'] == 'quiz')
	 			<a class="lesson-title course-item-title button-load-item" href="{{route('courses.quiz', ['course_id' => $course->hashed_id,'quiz_id'=> $row['hashId']])}}" style="{!! $text_color !!}"> {{$row['title']}}</a>
	 			
	 			@else

	 			<a class="lesson-title course-item-title button-load-item" href="{{route('courses.lesson', ['course_id' => $course->hashed_id,'lesson_id'=> $row['hashId']])}}" style="{!! $text_color !!}"> {{$row['title']}}</a>

	 			@endif
	 			@if($row['duration'])

	 			@if($row['duration'] > 1 || $row['duration'] > 10)

	 			<span class="meta duration" style="{!! $text_color !!}">{{$row['duration']}} {{__('developnet-lms::labels.spans.duration_units.'.$row['duration_unit'])}}</span>
	 			@else
	 			<span class="meta duration" style="{!! $text_color !!}">{{$row['duration']}} {{__('developnet-lms::labels.spans.duration_unit.'.$row['duration_unit'])}}</span>

	 			@endif

	 			@endif

	 		</li>
	 		@endforeach
	 			
	 	</ul>
	</div>
</li>
	
	
