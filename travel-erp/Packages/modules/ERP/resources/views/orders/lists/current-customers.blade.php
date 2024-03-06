@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.current_customer.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('current_customers') }}
        @endslot
    @endcomponent
@endsection