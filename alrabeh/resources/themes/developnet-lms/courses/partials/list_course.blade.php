@php
    $logsPercentage = 0;
    $userItemLogsDegree = 0;
    $logStatus = 0;

        if($course && $userLogs->count()){

                    $userItemLogs = $userLogs->where('lms_loggable_type', 'course')->where('lms_loggable_id', $course->id)->last();

                }

    if(isset($userItemLogs) && $userItemLogs){
        $courseItems = \DB::table('lms_courseables')->where('course_id', $course->id)->count();
        $courseLogsItems = $userLMS->logs()->where('parent_id', $userItemLogs->id)->where('status', 1)->count();
        $logsPercentage = ($courseLogsItems / ($courseItems > 0?$courseItems:1)) * 100;
        $userItemLogsDegree = $userItemLogs->degree;
        $logStatus = $userItemLogs->status;
    }

@endphp
<div class="p-course-item">
    <div class="media course-item-content">
        <img src="/assets/themes/developnet-lms/img/05.jpg" alt="course-name">
        <div class="media-body row">
            <div class="row">
                <div class="">
                    <div><a href="{{route('courses.show', ['id' => $course->hashed_id])}}"> {{$course->title}} </a>
                    </div>
                    <p> {!! str_limit(strip_tags($course->content), 200) !!} </p>
                </div>
                <div class="col-sm-3 item-content-badges">
                    @if(isset($userItemLogs) && $userItemLogs && !empty($userItemLogs))
                        @if($userItemLogs->status == 1)
                            @if($userItemLogs->passed > 0)
                                <span class="badge badge-success">
						@lang('LMS::attributes.main.passed_status_text.passed')
					</span>
                            @else

                                <span class="badge badge-danger">
						@lang('LMS::attributes.main.passed_status_text.unpassed')
					</span>

                            @endif



                        @else
                            <span class="badge badge-primary">
						@lang('LMS::attributes.main.passed_status_text.inprogress')
				</span>

                        @endif
                    @else

                        <span class="badge badge-warning">
						@lang('LMS::attributes.main.passed_status_text.notStarted')
				</span>

                    @endif

                    {{-- <span class="badge badge-danger">{{ $plan->price }} @lang('LMS::attributes.main.currency_rs')</span> --}}

                </div>
            </div>
        </div>
    </div>

    <div class="course-progress row">
		<span class="col-sm-2">
			@lang('developnet-lms::labels.spans.span_pass')
		</span>
        <div class="progress col-sm-8">
            <div class="progress-bar bg-success progress-bar-striped"
                 style="width:{{$logsPercentage}}%">{{round($logsPercentage)}}%
            </div>
        </div>
        <div class="col-sm-2 course-btn-details">
            <a class="btn-colored " data-toggle="collapse" href="{{'#collapseQuiz'.$course->id}}" role="button"
               aria-expanded="false" aria-controls="{{'collapseQuiz'.$course->id}}">
                @lang('developnet-lms::labels.spans.span_details')
            </a>
        </div>
        <div class="collapse course-grades " id="{{'collapseQuiz'.$course->id}}">
            <div class="course-grades-content">
                <div class="grade-statics ">
                    <ul>
                        <li>
                            <span> @lang('developnet-lms::labels.items_details.course_level') : </span>
                            <small> @lang('LMS::attributes.main.level_options_easabilty.'.$course->level)</small>
                        </li>
                        <li>
                            <span>@lang('developnet-lms::labels.items_details.course_lessons_num') : </span>
                            <small>{{$course->lessons()->count()}}</small>
                        </li>
                        <li>
                            <span>@lang('developnet-lms::labels.items_details.course_quiz_num') : </span>
                            <small>{{$course->quizzes()->count()}}</small>
                        </li>
                        <li>
                            <span>@lang('developnet-lms::labels.items_details.course_enrolled_student') : </span>
                            <small>{{$course->enrolled_students + $course->subscriptions()->count()}}</small>
                        </li>
                        <li>
                            <span>@lang('developnet-lms::labels.items_details.subscribed_at') : </span>

                            <small>{!! \Carbon\Carbon::instance($subRow->created_at)->diffForHumans() !!}</small>

                        </li>

                    </ul>
                </div>
                <div class="grades ">
                    @if($logStatus)
                        <p>@lang('developnet-lms::labels.spans.span_percentage')</p>
                        <div class="circle" id="{{'circles-course'.$course->id}}"></div>
                    @else

                        <div><p>@lang('developnet-lms::labels.spans.span_percentage')</p>
                            <span>@lang('developnet-lms::labels.spans.span_not_cal_percentage')</span></div>
                    @endif
                    {{-- <div><span>@lang('developnet-lms::labels.spans.span_total') 350 / 400</span></div> --}}
                </div>

                @php

                    $cert_id = null;

                        if(isset($userItemLogs) && $userItemLogs){

                            $certificate = \Modules\Components\LMS\Models\StudentCertificate::where('log_id',$userItemLogs->id)->first();

                            $cert_id = null;

                            if(isset($certificate) && $certificate ){

                                $cert_id = $certificate->hashed_id;

                            }
                        }


                @endphp

                @if($cert_id)
                    <div class="certification-link">
                        <a href="javascript:;" class="btn-certification btn-colored" data-toggle="modal"
                           data-target="#certificatonModal" data-url="{{route('ajax.get_certificate', $cert_id)}}"
                           data-id="{{$cert_id}}">@lang('developnet-lms::labels.spans.span_certification')</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@push('scripts_profile')
    <script>
        Circles.create({
            id: '{{'circles-course'.$course->id}}',
            value: '{{$userItemLogsDegree?:0}}',
            radius: 60,
            width: 8,
            duration: 1,
            colors: ['#d1e4d6', '#28a745 ']
        });
    </script>

@endpush
