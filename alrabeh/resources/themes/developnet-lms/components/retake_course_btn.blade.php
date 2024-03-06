@if(\Auth::check())
                @php
                $user = Modules\Components\LMS\Models\UserLMS::find(auth()->id());

                $canRetake = false;
                $logsNumber = \Logs::logsNumber([
                    'user' => $user,
                    'module' => 'course',
                    'module_id' => $course->id
                ]);
                if($logsNumber < $course->retake_count){
                    $canRetake = true;
                }

        $response = \Logs::enroll_status([
        'module' => 'course',
        'module_id' => $course->id,
        'user' => $user,
        'parent' => []
      ]);

        if($response['status'] != 1){
             $canRetake = false;
        }
                @endphp
             @if($canRetake)   
            <li>
                <center>
             <br>

             <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#retakeCourseModal">@lang('developnet-lms::labels.spans.retake_course')</a>

               
                </center>
            </li>
            @endif
           @endif 


@push('child_content')
<!-- Modal -->
<div class="modal fade" id="retakeCourseModal" tabindex="-1" role="dialog" aria-labelledby="completeCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #fff">
      {{-- <div class="modal-header">
        <h5 class="modal-title" id="completeCourseModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}

       {!! Form::model($course, ['url' => route('courses.retake', ['course_id' => $course->hashed_id ]),'method'=>'POST','files'=>true]) !!}
      <div class="modal-body">
     @lang('developnet-lms::labels.spans.message_retake_course')
              

      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary">@lang('developnet-lms::labels.spans.retake_course')</button>
        <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>
       
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endpush