    {!! Form::model($quiz, ['url' => url('ajax/ask_teacher/send'),'method'=>'POST','files'=>true,'class'=>'ajax-ask-teacher']) !!}
    <div class="alert-ask-teacher-message alert alert-danger" style="display: none;">
  <strong>خطأ!</strong> يجب ملء خانة الرسالة قبل الإرسال.
</div>
            <div class="media">
          <img class="mr-2 teacher-img" src="{{$teacher->picture_thumb}}" alt="teacher" width="50" height="50">
          <div class="media-body">
            <h5 class="mt-0 mb-0">{{$teacher->name}}</h5>
            <small>{{$teacher->job_title}}</small>
          </div>
        </div>
        <div class="mt-3 col-sm-12">
          <div class="border bg-light p-2 mb-2">
            <p>{{ str_limit(strip_tags($question->content),75, '...') }}</p>
            <hr>
            <small><span style="font-weight: bold;"> الاختبار : </span> {{$quiz->title}}</small>
            <input type="hidden" name="quiz_id" value="{{$quiz->hashed_id}}">
            <input type="hidden" name="question_id" value="{{$question->hashed_id}}">
            <input type="hidden" name="question_content" value="{{ str_limit(strip_tags($question->content),75, '...') }}">
            <input type="hidden" name="_id" value="{{$teacher->hashed_id}}">
          </div>
          <div >
            <textarea row="4" class="form-control rounded-0" placeholder="اكتب استفسارك هنا" name="message-data" id="ask-message-data" required=""></textarea>
          </div>
        </div>
{!! Form::close() !!}
