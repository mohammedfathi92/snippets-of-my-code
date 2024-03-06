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

        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">

                @if (sizeof(ShoppingCart::getItems()) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="table-image"></th>
                                <th>@lang('Larashop::labels.cart.product')</th>
                                <th>@lang('Larashop::labels.cart.quantity')</th>
                                <th>@lang('Larashop::labels.cart.price')</th>
                                <th class="column-spacer"></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (ShoppingCart::getItems() as $item)
                                <tr id="item-{{$item->getHash()}}">
                                    <td class="table-image">
                                        <a href="{{ url('shop', [$item->id->product->slug]) }}" target="_blank">
                                            <img src="{{ $item->id->image }}" alt="SKU Image"
                                                 class="img-rounded" width="50"></a>
                                    </td>

                                    <td>
                                        <a target="_blank"
                                           href="{{url('shop', [$item->id->product->slug])}}">{{ $item->id->product->name }}
                                            [ {{$item->id->code }}]</a><br>
                                        {!!  $item->id->present('options')  !!}
                                        {!! formatArrayAsLabels(\OrderManager::mapSelectedAttributes($item->product_options), 'success',null,true)    !!}
                                    </td>

                                    <td>
                                        @if($item->id->allowed_quantity != 1)
                                            <a href="{{ url('cart/quantity', [$item->getHash()]) }}"
                                               class="btn btn-xs btn-warning item-button"
                                               title="Remove One" data-action="post" data-style="zoom-in"
                                               data-request_data='@json(["action"=>"decreaseQuantity"])'
                                               data-page_action="updateCart">
                                                <i class="fa fa-fw fa-minus"></i>
                                            </a>

                                            <form action="{{ url('cart/quantity', [$item->getHash()]) }}" method="POST"
                                                  class="ajax-form inline">
                                                {{ csrf_field() }}
                                                <input step="1" min="1" class="cart-quantity"
                                                       style="width:40px;text-align: center;"
                                                       type="number"
                                                       name="quantity"
                                                       data-id="{{ $item->rowId }}"
                                                       {!! $item->id->allowed_quantity>0?('max="'.$item->id->allowed_quantity.'"'):'' !!} value="{{ $item->qty }}"/>
                                            </form>
                                            <a href="{{ url('cart/quantity', [$item->getHash()]) }}"
                                               class="btn btn-xs btn-success item-button" data-style="zoom-in"
                                               title="Add One" data-action="post" data-page_action="updateCart"
                                               data-request_data='@json(["action"=>"increaseQuantity"])'>
                                                <i class="fa fa-fw fa-plus"></i>
                                            </a>
                                        @else
                                            <input style="width:40px;text-align: center;"
                                                   value="1"
                                                   disabled/>
                                        @endif
                                    </td>
                                    <td id="item-total-{{$item->getHash()}}">{{ \Payments::currency($item->qty * $item->price) }}</td>
                                    <td class=""></td>
                                    <td>
                                        <a href="{{ url('cart/quantity', [$item->getHash()]) }}"
                                           class="btn btn-xs btn-danger item-button"
                                           title="Delete" data-action="post" data-style="zoom-in"
                                           data-request_data='@json(["action"=>"removeItem"])'
                                           data-page_action="updateCart">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-bottom">
                                <td class="table-image"></td>
                                <td style="padding: 40px;"></td>
                                <td class="small-caps table-bg" style="text-align: right">@lang('Larashop::labels.cart.sub_total')</td>
                                <td id="total">{{ ShoppingCart::subTotal() }}</td>
                                <td class="column-spacer"></td>
                                <td></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="spacer"></div>

                    <a href="{{ url('e-commerce/shop') }}" class="btn btn-primary btn">@lang('Larashop::labels.cart.continue_shop')</a> &nbsp;

                    <a href="{{ url('e-commerce/checkout') }}" class="btn btn-success btn">@lang('Larashop::labels.cart.proceed_checkout')</a>

                    <div style="float:right">
                        <a href="{{ url('cart/empty') }}"
                           class="btn  btn-danger item-button"
                           title="Delete" data-action="post" data-page_action="site_reload">
                            <i class="fa fa-fw fa-trash"></i>@lang('Larashop::labels.cart.empty_cart')
                        </a>
                    </div>
                @else
                    <div class="text-center">
                        <h3>@lang('Larashop::labels.cart.no_item_in_shopping')</h3>
                        <a href="{{ url('e-commerce/shop') }}" class="btn btn-primary btn">
                            <i class="fa fa-shopping-cart fa-fw"></i> @lang('Larashop::labels.cart.continue_shop')
                        </a>
                    </div>
                @endif

                <div class="spacer"></div>
            </div>
        </div>
    @endcomponent
@endsection

@section('js')
    @parent

    @include('Larashop::cart.cart_script')
@endsection