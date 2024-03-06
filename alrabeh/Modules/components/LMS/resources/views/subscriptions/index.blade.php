@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_subscriptions') }}
        @endslot
    @endcomponent
@endsection

@section('actions')
    @if(!empty($dataTable->filters()))
        {!! ModulesForm::link('#'.$dataTable->getTableAttributes()['id'].'_filtersCollapse','<i class="fa fa-filter"></i>',['class'=>'btn btn-info','data'=>['toggle'=>"collapse"]]) !!}
    @endif
@endsection