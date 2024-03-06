@foreach($questions as $question)
<input type="hidden" value="30%" id="question_progress" data-title="30% Complete (success)">
			<div class="pull-left question-hint" style="position: relative; ">
							<span class="badge badge-pill badge-dark"> ! </span>
							<div class="tooltip fade bs-tooltip-bottom show" role="tooltip" id="tooltip541667" x-placement="bottom"><div class="arrow" style="left: 50%;"></div><div class="tooltip-inner">نص محتوي عربي منت منت منت</div></div>
							<style>
								.question-hint .tooltip{
									position: absolute;  
									top: 23px; 
									left: calc(50% - 5px ); 
									transform: translate(-50% ,0); 
									will-change: transform; 
									width: max-content; 
									display: none;
								}
								.question-hint:hover .tooltip{
									display: block !important;
								}
							</style>
						</div>
<div class="quiz-questions">
							<form role="form" name="quizform" action="#" method="post">
								<ul class="quiz-questions-list">
									<li class="singl-question" >
										<div class="question-name">
											<h3>{{$question->title}}</h3>
										</div>
										
										    <div class="radio">
										    	<label><input type="radio" name="quiz" > &lt;head&gt;</label>
										    </div>
										    <div class="radio">
										    	<label><input type="radio" name="quiz" > &lt;heading&gt;</label>
										    </div>
										    <div class="radio">
										    	<label><input type="radio" name="quiz" > &lt;h1&gt;</label>
										    </div>
										    <div class="radio">
										    	<label><input type="radio" name="quiz" id="3" value="3"> &lt;h6&gt;</label>
										    </div>		 
									</li>
								</ul>
					
							</form>
						</div>
@endforeach

{{ $questions->links('quizzes.ajax.tools') }}
				