@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_cart') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('components.box',['box_class'=>'box-success'])

        <div class="container">
            <div class="row text-center">
                <div class="col-sm-6 col-sm-offset-3">
                    <br><br>
                    <h2 style="color:#0fad00">@lang('Larashop::labels.order.success')</h2>
                    <p style="font-size:20px;color:#5C5C5C;">@lang('Larashop::labels.order.order_has_been_placed')</p>
                    <a href="{{ url('e-commerce/orders/my') }}" class="btn btn-success">@lang('Larashop::labels.order.go_to_my_order')</a>
                    <br><br>
                </div>

            </div>
        </div>
    @endcomponent
@endsection

