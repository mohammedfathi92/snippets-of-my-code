@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.transport_package.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('transport_packages') }}
        @endslot
    @endcomponent
@endsection