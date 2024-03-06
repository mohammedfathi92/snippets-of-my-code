
   @if ($paginator->hasPages())
   <div class="row">
                <ul class="pagination">
        @if ($paginator->onFirstPage())
                  <li class="page-item"><button class="btn btn-dark prev"  disabled="">@lang('developnet-lms::labels.spans.span_previous')</button></li>
          @else
                   <li class="page-item"><a class="btn btn-dark prev" href="{{ $paginator->previousPageUrl() }}" >@lang('developnet-lms::labels.spans.span_previous')</a></li>        
          @endif
             @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>{{ $element }}</li>
                    @endif
                                   {{-- Array Of Links --}}
             @if (is_array($element))
                        @foreach ($element as $page => $url) 

            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link" href="javascript:;">{{ $page }}</a></li>
                            @else    

                  <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>

                            @endif
                        @endforeach
                    @endif
                @endforeach  

            {{-- Next Page Link --}}
        @if ($paginator->hasMorePages()) 
                  <li class="page-item"><a class="btn btn-dark next" href="{{ $paginator->nextPageUrl() }}"> @lang('developnet-lms::labels.spans.span_next')</a></li>
        @else

         <li class="page-item"><button class="btn btn-dark next" href="javascript:;" disabled=""> @lang('developnet-lms::labels.spans.span_next')</button></li>
                  
        @endif
        <li>
          @if(!$showAnswer && isset($quiz))
          <button type="button" class="btn btn-success finish finish_exam" style="margin-left: 10px; margin-right: 10px;">
                @lang('developnet-lms::labels.spans.span_finish_exam')
                    </button>
            @else

              <button type="submit" class="btn btn-success finish show_result_btn" style="margin-left: 10px; margin-right: 10px;" data-url="{{route('quizzes.show_result', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id])}}">
                @lang('developnet-lms::labels.spans.span_show_result')
                    </button>
                  
            
            @endif        
        </li>

                </ul>
              </div>
  

    @else

       <div class="row">
                <ul class="pagination">
        <li>
          @if(!$showAnswer && isset($quiz))
          <button type="button" class="btn btn-success finish finish_exam" style="margin-left: 10px; margin-right: 10px;">
                @lang('developnet-lms::labels.spans.span_finish_exam')
                    </button>
            @else

              <button type="submit" class="btn btn-success finish show_result_btn" style="margin-left: 10px; margin-right: 10px;" data-url="{{route('quizzes.show_result', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id])}}">
                @lang('developnet-lms::labels.spans.span_show_result')
                    </button>
                  
            
            @endif        
        </li>

                </ul>
              </div>

    @endif 




