@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title',$title)
        @slot('breadcrumb',Breadcrumbs::render('categories'))
    @endcomponent
@endsection
