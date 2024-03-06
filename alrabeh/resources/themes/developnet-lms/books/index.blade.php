@extends('layouts.master')
 
@section('css')
 {!! Theme::css('css/pages.css') !!} 
@endsection

@section('content')	 
 
	@include('partials.banner')
 
	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 course-wrap">
					<div class="page-side-title">
						<h3>@lang('developnet-lms::labels.headings.text_all_books')</h3>
					</div>
					<div class="other-courses">
						@if($books->count())
						<div class="row">
							@foreach($books as $book)
							
								<div class="col-md-4 col-sm-6">
						 			@include('books.partials.grid_books_1', ['book' => $book ])
								</div>
								
							@endforeach
						</div>
				{{ $books->links('partials.paginator') }}
						@else
							@lang('developnet-lms::labels.headings.text_book_msg')
						@endif
					</div>
				</div>
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection

 