@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	

	@include('partials.banner')

	<section class="page-content">
		<div class="container">
			<div class="row">

				<!-- Page Content-->
				<div class="col-lg-9">
					@include('partials.list_search')
					@include('partials.list_search')
					@include('partials.list_search')
				</div>
				<!-- Side bar-->
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection
 