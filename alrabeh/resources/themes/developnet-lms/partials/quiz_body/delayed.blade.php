	@php
	$check_delayed = $is_delayed;

	if($check_delayed){
		$fav_text = 'سؤال مؤجل';
		$fav_color = '';
	}else{
		$fav_text = 'تأجيل';
		$fav_color = '';
	}

	
   @endphp


		<a id="press-delayed-btn-{{$question->hashed_id}}" href="javascript:;" class="add-to delayed-question" title="{{$fav_text}}" data-url="{{route('quizzes.markAsDelayed', ['quiz_id' => $quiz->hashed_id, 'logs_id' => $quizLogs->hashed_id, 'question_id' => $question->hashed_id ])}}" style="color:{{$fav_color}}; font-weight: bold;" data-isDelayed="{{$check_delayed}}" question="{{$question->hashed_id}}" quiz="{{$quiz->hashed_id}}"> <i class="fa fa-bookmark-o" aria-hidden="true"></i>	
					<span>{{$fav_text}}</span>
		  				
		</a>		
					  
