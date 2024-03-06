<div class="question-palette ">
	<ul class="question-palette-list">
		<li class="palette-element not-answered"><span>1</span></li>
		<li class="palette-element not-visited"><span>2</span></li>
		<li class="palette-element answered"><span>3</span></li>
		<li class="palette-element not-visited"><span>4</span></li>
		<li class="palette-element not-visited"><span>5</span></li>
		<li class="palette-element not-visited"><span>6</span></li>
		<li class="palette-element not-visited"><span>7</span></li>
		<li class="palette-element not-visited"><span>4</span></li>
		<li class="palette-element not-visited"><span>5</span></li>
		<li class="palette-element not-visited"><span>6</span></li>
		<li class="palette-element not-visited"><span>7</span></li>
	</ul>
</div> 
<div class="quiz-questions">
	<form role="form" name="quizform" action="#" method="post">
		<ul class="quiz-questions-list">
			<li class="singl-question" >
				<div class="question-name">
					<h3>Choose the correct HTML element for the largest heading?</h3>
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
		
		<div class="question-meta-links">
				<button type="button" class="btn btn-dark prev" disabled="">
					<i class="fa fa-angle-double-right"></i> @lang('developnet-lms::labels.spans.span_previous') 
				</button>
				<button type="button"  class="btn btn-dark next ">
					@lang('developnet-lms::labels.spans.span_next') <i class="fa fa-angle-double-left"></i>
				</button>
				<button type="button"  class="btn btn-dark skip">
					@lang('developnet-lms::labels.spans.span_skip')
				</button>
				<button type="submit" class="btn btn-success finish">
					@lang('developnet-lms::labels.spans.span_finish')
				</button>
		</div>
	</form>

</div>