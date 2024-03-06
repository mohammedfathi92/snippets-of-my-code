
<div class="course-lesson-content" id="quiz_container">
					<!-- Quiz-->
					<div class="exam-section single-quiz">
						<h4 class=" quiz-title">Awesome test</h4>
						<div class="quiz-meta ">
							<ul class="quiz-meta-list">
							{{-- 	<li class="question-num-field">
									<span class="text">سؤال</span >
									<span class="question-num">1</span><span>/</span>
									<span class="question-val">1</span>
								</li> --}}
								<li class="question-tile-field">
									<span class="text"><i class="fa fa-clock-o" style="font-size:20px;color:#28a745;"></i> @lang('developnet-lms::labels.spans.rest_time') </span>
									<span class=" timer" data-minutes-left=65></span>
								</li>
								
							</ul>
						</div>

		<div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      40% Complete (success)
    </div>
  </div>
  <br>
			
						
						<div class="question_container">
						@include('quizzes.ajax.questions', ['questions' => $questions])
						</div>
						
					</div>
				</div>

