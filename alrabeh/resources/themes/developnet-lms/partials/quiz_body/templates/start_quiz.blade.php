
		<div class="col-md-12" id="startQuizForm">
			<input type="hidden" name="course_id" value="{{$course?$course->hashed_id:null}}">
							<div class="start-quiz-group" id="start_quiz_form">
								<img class="image-responsive" style="width: 100%; height: auto; min-height: 160px" src="{{Theme::url('img/start-quiz.jpg')}}">
								<input type="hidden" name="course_id" value="{{$course?$course->hashed_id:null}}">
								<div class="start-quiz-btns">

									<a href="javascript:;" class="btn btn-success" data-quiz_duration="{{$quiz->duration}}" id="start_quiz_btn"  data-form_url="{{route('quizzes.enroll_quiz', ['quiz' => $quiz->hashed_id])}}">إبدأ  الاختبار</a>
								</div>
							</div>
		</div>

		 	<style>
				.start-quiz-group{
					position: relative;
					display: inline;
				}
				.start-quiz-btns{
					position: absolute;
					top: 50%;
					left: 50%;
					transform: translate(-50%,-50%);
				}
				.start-quiz-btns a{
					margin: 2px;
					box-shadow: 1px 1px 0px 0px #ffffff9e
				}
			</style>

		<br>

