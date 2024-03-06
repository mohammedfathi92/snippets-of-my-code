@if(!empty($subscriptions))


		<div id="accordionSubs">

			@if(countData($subscriptions->where('subscriptionnable_type', 'plan')))

		<div class="card">
		    <div class="card-header">
		      <a class="collapsed card-link" data-toggle="collapse" href="#plansColl">
					<h4>
						<i class="fa fa-bars"></i>
						@lang('developnet-lms::labels.headings.text_bookings_plans')
					</h4>
		      </a>
		    </div>
		    <div id="plansColl" class="collapse " data-parent="#accordionSubs">
		    	<div class="card-body">


			<div class="p-course-list">

				@foreach($subscriptions->where('subscriptionnable_type', 'plan') as $subRow)
				@php
				$plan = \Modules\Components\LMS\Models\Plan::find($subRow->subscriptionnable_id);


				@endphp
				@if($plan)
	  			@include('plans.partials.list_plan', ['plan' => $plan, 'subscription' => $subRow])
	  			@endif

	  			@endforeach
	  		</div>


		      </div>

		    </div>
		</div>

		@endif

		@if(countData($subscriptions->where('subscriptionnable_type', 'course')))
			<div class="card">
		    <div class="card-header">
		      <a class="collapsed card-link" data-toggle="collapse" href="#coursesColl">
					<h4>
						<i class="fa fa-suitcase"></i>
						@lang('developnet-lms::labels.headings.text_bookings_courses')
					</h4>
		      </a>
		    </div>



		    <div id="coursesColl" class="collapse " data-parent="#accordionSubs">
		    	<div class="card-body ">

	  		<div class="p-course-list">

	  			@foreach($subscriptions->where('subscriptionnable_type', 'course') as $subRow)
	  			@php
				$course = \Modules\Components\LMS\Models\Course::find($subRow->subscriptionnable_id);


				@endphp

				@if($course)

	  			@include('courses.partials.list_course', ['course' => $course, 'subscription' => $subRow])
	  			@endif
	  			@endforeach
	  		</div>

		      </div>

		    </div>
		</div>

		@endif


@if(countData($subscriptions->where('subscriptionnable_type', 'quiz')))
			<div class="card">
		    <div class="card-header">
		      <a class="collapsed card-link" data-toggle="collapse" href="#quizColl">
					<h4>
						<i class="fa fa-clock-o"></i>
						@lang('developnet-lms::labels.headings.text_bookings_exams')
					</h4>
		      </a>
		    </div>

		    <div id="quizColl" class="collapse " data-parent="#accordionSubs">
		    	<div class="card-body ">


	  		<div class="p-exam-list">

				@foreach($subscriptions->where('subscriptionnable_type', 'quiz') as $subRow)
				@php
				$quiz = \Modules\Components\LMS\Models\Quiz::find($subRow->subscriptionnable_id);

				@endphp

				@if($quiz)
	  			@include('quizzes.partials.list_quiz_profile', ['quiz' => $quiz, 'subscription' => $subRow])
	  			@endif
	  			@endforeach
	  		</div>



		      </div>

		    </div>
		</div>

			@endif

			@if(countData($subscriptions->where('subscriptionnable_type', 'book')))

			<div class="card">
		    <div class="card-header">
		      <a class="collapsed card-link" data-toggle="collapse" href="#booksColl">
					<h4>
						<i class="fa fa-book"></i>
						@lang('developnet-lms::labels.headings.text_bookings_books')
					</h4>
		      </a>
		    </div>
		    <div id="booksColl" class="collapse" data-parent="#accordionSubs">
		    	<div class="card-body ">

			<div class="p-course-list">

				@foreach($subscriptions->where('subscriptionnable_type', 'book') as $subRow)
				@php
				$book = \Modules\Components\LMS\Models\Book::find($subRow->subscriptionnable_id);

				@endphp
			   @if($book)
	  			@include('books.partials.list_books', ['book' => $book, 'subscription' => $subRow])
	  			@endif
	  			@endforeach
	  		</div>
		      </div>

		    </div>
		</div>

		</div>


	  	@endif

	</div>
@else
<p>@lang('developnet-lms::labels.headings.user_has_no_subscriptions')</p>
@endif
