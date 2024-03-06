@extends('layouts.lesson') 
@php
$closeItemRoute = route('courses.show', ['id' => $course->hashed_id]);
$breadcrumb = [
  ['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
  ['name' => __('developnet-lms::labels.links.link_page_courses'), 'link' => route('courses.index')],
  ['name' => $course->title, 'link' => route('courses.show', ['id' => $course->hashed_id])],
  ['name' => __('developnet-lms::labels.links.link_page_quizzes'), 'link' => 'javascripts:;'],
  ['name' => $quiz->title, 'link' => false],
];
      
@endphp

@section('content')
        
    {{--   @if($quiz->preview_video)

          @include('components.embeded_media', ['embeded' => $quiz->preview_video])
          @else

          @if($quiz->thumbnail)

          <div class="course-media">
            <img src="{{$quiz->thumbnail}}" alt="{{$quiz->title}}" style="max-width: 100%; height: auto; vertical-align: middle;">
                     </div>
                     @endif

          @endif --}}
    <div class="col-sm-12 text-right mtb-15">
     @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id])

            </div>

    <div class="content-item-summary"> 

      @include('partials.quiz_body.index', ['show_quiz_title' => false])
 
      </div>




      
@endsection

