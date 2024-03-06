@extends('layouts.crud.index')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ trans('ERP::module.customer_order.title') }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('customer_orders',$customer) }}
        @endslot
    @endcomponent
@endsection