 
<div class="item subject-block">
    <a href="{{ route('books.show', $book->hashed_id) }}" class="subject-img">
      <img src="{{$book->thumbnail}}">
      <span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
    </a>
    <div class="subject-content">
      <a href="{{route('books.show', $book->hashed_id)}}" class="sub-content-title">{{$book->title}}</a>

    </div>
    <div class="subject-meta">
      <div class="subject-overview">
        <i class="fa fa-group"></i>


        <span>{{$book->subscriptions()->count()}}</span>
        {{-- <i class="fa fa-comment"></i>
        <span>0</span> --}}

      </div>
      <div class="subject-value">

              @php

              if($book->sale_price > 0){

                $bookPrice = $book->sale_price;

              }else{
                $bookPrice = $book->price;
              }
              @endphp
             

              @if($bookPrice > 0)
              <span class="money">{{$bookPrice}} ريال</span>
              @if($book->sale_price > 0 && $book->sale_price < $book->price)
              <span class="subject-value-deleted">{{$book->price}} ريال</span>
              @endif
              @else
              <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
              @endif


 {{--        @if($book->sale_price)
            @if($book->sale_price ==0)
              <span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span> 
            @elseif($book->sale_price == $book->price || $book->price < $book->sale_price)  
              
              <span class="money"> {{$book->sale_price}}$</span>
            @else
              <span class="subject-value-deleted">{{$book->price}}$</span>
                  <span class="money"> {{$book->sale_price}}$</span>
            @endif  
          
          @endif --}}

      </div> 
    </div>
 </div>