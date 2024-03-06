@php


$userFavourites = $userLMS->favourites()->get();

if(Auth::check()){
	$authId = Auth()->id();
}else{
	$authId = null;
}



@endphp

 	@if(countData($userFavourites) && $userFavourites->count())
 	<div id="accordion">
		@php
    		$questionsFav = $userFavourites->where('favourittable_type', 'question');
    	@endphp
    	{{-- @if(countData($questionsFav))
		<div class="card">
		    <div class="card-header">
		      <a class="card-link" data-toggle="collapse" href="#collapseOne">
		        @lang('developnet-lms::labels.headings.text_questions')
		      </a>
		    </div>
		    <div id="collapseOne" class="collapse show" data-parent="#accordion">
		      <div class="card-body ">
		      	<div class="with-datatable">
			      
			        <table class="datatableLMS table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
				                <th>
				                	@lang('developnet-lms::labels.spans.span_question')
				                </th>
				            <th>
				                	@lang('developnet-lms::labels.spans.span_lesson')
				                </th> 
				             
				                <th>
				                	@lang('developnet-lms::labels.spans.span_actions')
				                </th>
				            </tr>
				        </thead>
				        <tbody>
				        	
				        	@foreach($questionsFav as $fav)
				        	@php
				      	 $questionFav =  Modules\Components\LMS\Models\Question::find($fav->favourittable_id);
				        	@endphp
				            <tr>
				          	
				                <td><a href="{{route('questions.preview', ['id' => $questionFav->hashed_id])}} " target="_blank"> {!! str_limit(strip_tags($questionFav->content), 50) !!} </a></td>

				           <td>System Architect</td>
				                <td>Edinburgh</td>
				                <td>61</td>
				                <td>2011/04/25</td> 
				                <td>

							<span>
		                	<a href="{{route('questions.preview', ['id' => $questionFav->hashed_id])}}" target="_blank" class="btn btn-sm  btn-success" > <i class="fa fa-eye"></i> {{__('developnet-lms::labels.spans.span_copy_question_link')}} </a>
		                	</span>
		                	<span>
		                	<button class="btn btn-sm  btn-danger remove_fav_btn" 
		                	data-url="{{route('ajax.favourite', ['module' => 'question', 'module_id' => $questionFav->hashed_id])}}"> <i class="fa fa-trash"> </i>{{__('developnet-lms::labels.spans.span_remove_text')}} </a>
		           	
		                </span></td>
				            </tr> 

				            @endforeach    
				
				      
				      	 </tbody>
				    </table>
				   
			    </div>
		      </div>
		    </div>
		</div>
		@endif --}}

		@php
	        $coursesFav = $userFavourites->where('favourittable_type', 'course');
	    @endphp
	    @if($coursesFav)
		<div class="card">
		    <div class="card-header">
		      <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
		       	@lang('developnet-lms::labels.headings.text_courses')
		      </a>
		    </div>
		    <div id="collapseTwo" class="collapse show" aria-expanded="true" data-parent="#accordion">
		    	<div class="card-body ">
		      	<div class="with-datatable">
			      	
			        <table class="datatableLMS table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
				                <th>
				                	@lang('LMS::attributes.main.title')
				                </th>
				       
				             
				                <th>
				                	@lang('developnet-lms::labels.spans.span_actions')
				                </th>
				            </tr>
				        </thead>
				        <tbody>
				        	
				        	@foreach($coursesFav as $fav)
				        	@php
				       $courseFav =  Modules\Components\LMS\Models\Course::find($fav->favourittable_id);
				        	@endphp
				        	@if($courseFav)
				            <tr>
				                <td> <a href="{{route('courses.show', ['id' => $courseFav->hashed_id])}}" target="_blank">{!! str_limit(strip_tags($courseFav->title), 50) !!} </a></td>
				        
				                <td>

									<span>
				                	<a href="{{route('courses.show', ['id' => $courseFav->hashed_id])}}" target="_blank" class="btn btn-sm  btn-success" > <i class="fa fa-eye"></i> </a>
				                	</span>
				                	<span>

				                	<a href="javascript:;" class="btn btn-sm  btn-danger remove_fav_btn" 
				                	data-url="{{route('ajax.favourite', ['module' => 'course', 'module_id' => $courseFav->hashed_id])}}"> <i class="fa fa-trash"> </i></a>
				                </span></td>
				            </tr> 
				            @endif

				            @endforeach    
				
				      
				        </tbody>
				    </table>
				    
			    </div>
		      </div>
		    {{--   <div class="card-body">
		        <div class="saved-tages">
		        	<div class="flex-between">
		        		<div class="marked-tag">
				       		<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
				       		<a href="#">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،?</a>
				       	</div>
				       	<div>
				       		<span class="badge badge-danger">×</span>
				       	</div>
		        	</div>
			       	
			       	<div class="flex-between">
		        		<div class="marked-tag">
				       		<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
				       		<a href="#">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،?</a>
				       	</div>
				       	<div class="delete">
				       		<span class="badge badge-danger">×</span>
				       	</div>
		        	</div>
		        	<div class="flex-between">
		        		<div class="marked-tag">
				       		<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
				       		<a href="#">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،?</a>
				       	</div>
				       	<div class="delete">
				       		<span class="badge badge-danger">×</span>
				       	</div>
		        	</div>
		        	<div class="flex-between">
		        		<div class="marked-tag">
				       		<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
				       		<a href="#">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،?</a>
				       	</div>
				       	<div class="delete">
				       		<span class="badge badge-danger">×</span>
				       	</div>
		        	</div>
		        </div>
		      </div> --}}
		    </div>
		</div>
		@endif	


		@php
        	$quizzesFav = $userFavourites->where('favourittable_type', 'quiz');
        @endphp

        @if(countData($quizzesFav))
		<div class="card">
		    <div class="card-header">
		      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
		          @lang('developnet-lms::labels.headings.text_exams')
		      </a>
		    </div>
		    <div id="collapseThree" class="collapse" data-parent="#accordion">

		     <div class="card-body ">
		      	<div class="with-datatable">
			      	
			        <table class="datatableLMS table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
				                <th>
				                	@lang('LMS::attributes.main.title')
				                </th>
				       
				             
				                <th>
				                	@lang('developnet-lms::labels.spans.span_actions')
				                </th>
				            </tr>
				        </thead>
				        <tbody>
				        	
				        	@foreach($quizzesFav as $fav)
				        	@php
				       $quizFav =  Modules\Components\LMS\Models\Quiz::find($fav->favourittable_id);
				        	@endphp
				        	@if( $quizFav)
				            <tr>
				                <td> <a href="{{route('quizzes.show', ['id' => $quizFav->hashed_id])}}" target="_blank">{!! str_limit(strip_tags($quizFav->title), 50) !!} </a>

				                </td>
				        
				                <td>

							<span>
				                	<a href="{{route('quizzes.show', ['id' => $quizFav->hashed_id])}}" target="_blank" class="btn btn-sm  btn-success" > <i class="fa fa-eye"></i> </a>
				                	</span>
				                	<span>

				                	<a href="javascript:;" class="btn btn-sm  btn-danger remove_fav_btn" 
				                	data-url="{{route('ajax.favourite', ['module' => 'quiz', 'module_id' => $quizFav->hashed_id])}}"> <i class="fa fa-trash"> </i></a>
				                </span></td>
				            </tr> 
				            @endif

				            @endforeach    
				
				      
				        </tbody>
				    </table>
			    </div>
		      </div>
		    </div>
		</div>
		@endif
	</div>
	@else
	<p>@lang('developnet-lms::labels.headings.user_has_no_favourites')</p>

	@endif