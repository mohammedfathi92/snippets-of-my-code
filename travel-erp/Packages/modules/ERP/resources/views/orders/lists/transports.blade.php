@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.transport_order.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('transport_orders') }}
        @endslot
    @endcomponent
@endsection