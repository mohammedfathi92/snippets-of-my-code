@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.manual_hotel_order.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('manual_hotel_orders') }}
        @endslot
    @endcomponent
@endsection