@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            <span style="color: #673ab7;">{{'اختبار: '.$quiz->title}}</span> - {{ $title }}
        @endslot
     
        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_quiz_questions', $quiz) }}
        @endslot
    @endcomponent
@endsection