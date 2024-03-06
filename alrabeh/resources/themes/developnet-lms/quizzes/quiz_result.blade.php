@extends('layouts.lesson')
@section('content')

	<!-- Quiz-->
	<div class="exam-section single-quiz">
		<div id="content-item-quiz" class="content-item-summary ">
			<h4 class=" quiz-title">Awesome test</h4>
			<div class="quiz-results faild">
				<h3 class="result-title">
					@lang('developnet-lms::labels.spans.span_result')
				</h3>
				<div class="result-summary">
					<div class="result-field correct">
						<span>
						@lang('developnet-lms::labels.spans.span_correct')</span>
						<span class="value">0</span>
					</div>
					<div class="result-field wrong">
						<span>
						@lang('developnet-lms::labels.spans.span_wrongs')</span>
						<span class="value">0</span>
					</div>
					<div class="result-field empty">
						<span>
						@lang('developnet-lms::labels.spans.span_skipped')</span>
						<span class="value">4</span>
					</div>
					<div class="result-field points">
						<span>
						@lang('developnet-lms::labels.spans.span_questions')</span>
						<span class="value">4</span>
					</div>
					<div class="result-field time">
						<span>
						@lang('developnet-lms::labels.spans.span_time')</span>
						<span class="value">34:42</span>
					</div>
				</div>
				<div class="message message-error alert alert-danger" role="alert">
					<i class="fa"></i>Your quiz grade <b>failed</b>. Quiz requirement <b>50%</b>
				</div>
				<div class="message message-success alert alert-success" role="alert"role="alert">
					<i class="fa"></i>Your quiz grade <b>success</b>Well Done <b>50%</b>
				</div>
			</div>
			<div class="content-item-description">
				<p>We provide an awesome testing with many types of questions. Making a test with those questions is never easier than that. Enjoy!</p>
			</div>
		</div>
	</div>

@endsection
