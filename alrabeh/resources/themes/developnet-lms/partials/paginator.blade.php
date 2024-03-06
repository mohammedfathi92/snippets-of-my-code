
   @if ($paginator->hasPages())
   <div class="row">
                <ul class="pagination">
        @if ($paginator->onFirstPage())
                  <li class="page-item"><a class="page-link" href="javascript:;" style="color: #d8d8d8; cursor: no-drop;">@lang('developnet-lms::labels.spans.span_previous')</a></li>
          @else
                   <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" >@lang('developnet-lms::labels.spans.span_previous')</a></li>        
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
                  <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"> @lang('developnet-lms::labels.spans.span_next')</a></li>
        @else

         <li class="page-item"><a class="page-link" href="javascript:;" style="color: #d8d8d8; cursor: no-drop;"> @lang('developnet-lms::labels.spans.span_next')</a></li>
                  
        @endif

                </ul>
              </div>
    @endif          


