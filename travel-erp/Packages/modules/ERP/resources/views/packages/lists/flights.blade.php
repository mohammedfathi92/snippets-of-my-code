@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.flight_package.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('flight_packages') }}
        @endslot
    @endcomponent
@endsection