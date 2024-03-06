@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.hotel_package.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('hotel_packages') }}
        @endslot
    @endcomponent
@endsection