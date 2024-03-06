@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection


@section('js')
@include('partials.quiz_body.scripts')
@stop
 
@section('content')	

	@php
$breadcrumb = [
	['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
	['name' => __('developnet-lms::labels.links.link_page_quizzes'), 'link' => route('quizzes.index')],
	['name' => $quiz->title, 'link' => false],
];

		$authUser = new \Modules\Components\LMS\Models\UserLMS;
		if(Auth::check()){
		$authUser = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());
		}
		@endphp

	@include('partials.banner', ['page_title' => $quiz->title, 'breadcrumb' => $breadcrumb])

	@include('partials.quiz_body.index', ['show_quiz_title' => false])


@endsection






 