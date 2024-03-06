
   <div class="row row-pagination">
   
                <ul class="pagination">



        @php

    $no_delayed = true;
      if($delayed_questions->count()){
        $no_delayed = false;
      }

    



        @endphp

 

   @if ($paginator->hasPages()) {{-- if has pages (pagination) --}}
        @if ($paginator->onFirstPage())
                  <li class="page-item"><button class="btn btn-dark prev"  disabled="">@lang('developnet-lms::labels.spans.span_previous')</button></li>
          @else
                   <li class="page-item"><a class="btn btn-dark prev ajax-paginate" href="{{ $paginator->previousPageUrl() }}" >@lang('developnet-lms::labels.spans.span_previous')</a></li>        
          @endif

                  @if(!$is_course_element)
        <li>


          @if($is_delayed)
          <a href="{{route('quizzes.quizPage', ['quiz' => $quiz->hashed_id])}}" class="btn btn-primary" style="margin-left: 10px; margin-right: 10px;">
                   عرض كل الأسئلة
                    </a>
            @else
               <span>({{$paginator->currentPage().' / '.$paginator->lastPage()}})</span>    

            @if($no_delayed)

             <button id="delays-btn-{{$quiz->hashed_id}}" class="btn btn-default" onclick="location.href='{{route('quizzes.delayed_questions', ['quiz' => $quiz->hashed_id, 'quiz_logs' => $quizLogs->hashed_id])}}'" style="margin-left: 10px; margin-right: 10px;" data-count="{{$delayed_questions->count()}}" disabled="">
               الأسئلة المؤجلة
                    </button>

             
              @else  
                 <button id="delays-btn-{{$quiz->hashed_id}}" class="btn btn-warning" onclick="location.href='{{route('quizzes.delayed_questions', ['quiz' => $quiz->hashed_id, 'quiz_logs' => $quizLogs->hashed_id])}}'" style="margin-left: 10px; margin-right: 10px;" data-count="{{$delayed_questions->count()}}">
               الأسئلة المؤجلة
                    </button>
             
              @endif      
                  
            
            @endif        
        </li>

        @endif   
     
             {{-- @foreach ($elements as $element) --}}

                    {{-- "Three Dots" Separator --}}
{{--                     @if (is_string($element))
                        <li>{{ $element }}</li>
                    @endif --}}
                                   {{-- Array Of Links --}}
{{--              @if (is_array($element))
                        @foreach ($element as $page => $url) 

            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link ajax-paginate" href="javascript:;">{{ $page }}</a></li>
                            @else    

                  <li class="page-item"><a class="page-link ajax-paginate" href="{{ $url }}">{{ $page }}</a></li>

                            @endif
                        @endforeach
                    @endif
                @endforeach  --}} 

            {{-- Next Page Link --}}
        @if ($paginator->hasMorePages()) 
                  <li class="page-item"><a class="btn btn-dark next ajax-paginate" href="{{ $paginator->nextPageUrl() }}"> @lang('developnet-lms::labels.spans.span_next')</a></li>
        @else

         <li class="page-item"><button class="btn btn-dark next ajax-paginate" href="javascript:;" disabled=""> @lang('developnet-lms::labels.spans.span_next')</button></li>
                  
        @endif 


        <li>

            @endif  {{-- end if not has pages --}}

           @if($quizLogs->status == 1)

            @php

            $course_hashed_id = $course?$course->hashed_id:'';

            @endphp

              <button type="submit" class="btn btn-success finish show_result_btn" style="margin-left: 10px; margin-right: 10px;" data-url="{{route('quizzes.show_result', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id]).'?course_id='.$course_hashed_id}}">
                @lang('developnet-lms::labels.spans.span_show_result')
                    </button>
                  
            
            @endif        
        </li>

              </ul> 
              </div>
  





