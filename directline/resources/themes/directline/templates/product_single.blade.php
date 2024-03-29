@extends('layouts.master')

@section('css')
    <style type="text/css">
        .sku-item {
            position: relative;
        }

        .sku-item .badge {
            font-size: 75%;
            /*width: 100%;*/
        }

        .img-radio {
            max-height: 100px;
            margin: 5px auto;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 103%;
            left: 79%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .selected-radio > img {
            opacity: .45;
        }

        .selected-radio .middle {
            opacity: 1;
        }
    </style>
@endsection

@section('editable_content')
    @php \Actions::do_action('pre_content',$product, null) @endphp

    <!-- Page Content-->
    <div class="container padding-bottom-3x my-5">
        <div class="row">
            <!-- Product Gallery-->
            <div class="col-md-6">
                <div class="product-gallery" style="padding-top: 15px;">
                    @if($product->discount)
                        <div class="product-badge text-danger">{{ $product->discount }}% Off</div>
                    @endif
                    @if(!($medias = $product->getMedia('ecommerce-product-gallery'))->isEmpty())
                        <div class="product-carousel owl-carousel text-center" data-owl-carousel="{ &quot;rtl&quot;: @if(\Language::isRTL()){{'true'}}@else {{'false'}}@endif }">
                            @foreach($medias as $media)
                                <a href="{{ $media->getUrl() }}" data-hash="gItem_{{ $media->id }}"
                                   data-lightbox="product-gallery">
                                    <img src="{{ $media->getUrl() }}" class="mx-auto" alt="Product"
                                         style="max-height: 400px; min-height: 400px;width: 100%;"/>
                                </a>
                            @endforeach
                        </div>
                       {{--  <ul class="product-thumbnails">
                            @foreach($medias as $media)
                                <li class="{{ $media->getCustomProperty('featured', false)?'active':'' }}">
                                    <a href="#gItem_{{ $media->id }}">
                                        <img src="{{ $media->getUrl() }}" alt="Product"
                                             style="max-height: 100px;width: auto;"></a>
                                </li>
                            @endforeach
                        </ul> --}}
                    @else
                        <div class="text-center text-muted">
                            <small>@lang('Packages-ecommerce-basic::labels.template.product_single.image_unavailable')</small>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Product Info-->
            <div class="col-md-6">
                <div class="padding-top-2x mt-2 hidden-md-up"></div>
                @if(\Settings::get('ecommerce_rating_enable',true))
                    @include('partials.components.rating',['rating'=> $product->averageRating(1)[0],'rating_count'=>$product->countRating()[0] ])
                @endif
                <h1 class="padding-top-1x text-normal">{{ $product->name }}</h1>

                <span class="h2 d-block">
                    {!! $product->price  !!}
                </span>
                <h4 class=" text-normal">{{ $product->caption }}</h4>
                {!! Form::open(['url'=>'cart/'.$product->hashed_id.'/add-to-cart','method'=>'POST','class'=> 'ajax-form','data-page_action'=>"updateCart"]) !!}
                @foreach($product->activeSKU as $sku)
                    @if($loop->index%4 == 0)
                        <div class="d-flex flex-wrap">
                            @endif
                            <div class="text-center sku-item mr-2 @if($loop->first)selected-radio @endif" style="width: 240px;">
                                <img src="{{ asset($sku->image) }}" class="img-responsive img-radio mx-auto">
                                <div class="middle">
                                    <div class="text text-success"><i class="fa fa-check fa-4x"></i></div>
                                </div>
                                <div>
                                    {!! !$sku->options->isEmpty() ? $sku->presenter()['options']:'' !!}
                                </div>
                                @if($sku->stock_status == "in_stock")
                                    <button type="button"
                                            class="btn btn-block btn-sm btn-default btn-secondary btn-radio m-t-5 @if($loop->first)active btn-success @endif">
                                        <b>{!! $sku->discount?'<del class="text-muted">'.\Payments::currency($sku->regular_price).'</del>':''  !!} {!! \Payments::currency($sku->price)!!}</b>
                                    </button>
                                @else
                                    <button type="button"
                                            class="btn btn-block btn-sm m-t-5 btn-danger">
                                        <b> @lang('Packages-ecommerce-basic::labels.partial.out_stock')</b>
                                    </button>
                                @endif
                                <input type="checkbox" id="left-item" name="sku_hash" value="{{ $sku->hashed_id }}"
                                       class="hidden d-none disable-icheck" @if($loop->first) checked="" @endif / >
                            </div>
                            @if($lastLoop = $loop->index%4 == 3)
                        </div>
                    @endif
                @endforeach
                @if(!$lastLoop)</div>@endif
            <div class="form-group">
                <span data-name="sku_hash"></span>
            </div>
            <div class="row m-t-20">
                <div class="col-md-4">
                    {!! PackagesForm::number('quantity','Packages-ecommerce-basic::attributes.template.quantity', false, 1, ['min' => 1,'class'=>'form-control form-control-sm']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @if($product->globalOptions->count())
                        {!! $product->renderProductOptions('global_options',null, ['class'=>'form-control form-control-sm']) !!}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(\Settings::get('ecommerce_wishlist_enable',true))
                        @include('partials.components.wishlist',['wishlist'=> user() ? \Wishlist::getWishlistItem($product->id,user()->id) : null ])
                    @endif
                    @if($product->external_url)
                        <a href="{{ $product->external_url }}" target="_blank" class="btn btn-success"
                           title={{trans('Packages-ecommerce-basic::labels.template.product_single.title_product')}} >
                            @lang('Packages-ecommerce-basic::labels.template.product_single.buy_product')
                        </a>
                    @else
                        {!! PackagesForm::button('Packages-ecommerce-basic::labels.partial.add_to_cart',
                        ['class'=>'btn add-to-cart btn-sm btn-primary'], 'submit') !!}
                    @endif
                </div>
            </div>

            {{ Form::close() }}
            <div class="mb-2">
                <span class="text-medium">@lang('Packages-ecommerce-basic::labels.template.product_single.category')</span>
                @foreach($product->activeCategories as $category)
                    <a class="" href="{{ route('shop.index').'?category='.$category->slug }}"><b>{{ $category->name }}</b></a>
                    &nbsp;&nbsp;
                @endforeach
            </div>
            @if($product->activeTags->count())
                <div class="padding-bottom-1x mb-2">
                    <span class="text-medium">@lang('Packages-ecommerce-basic::labels.template.product_single.tag')</span>
                    @foreach($product->activeTags as $tag)
                        <a class="" href="{{ url('shop?tag='.$tag->slug) }}"><b>{{ $tag->name }}</b></a>&nbsp;&nbsp;
                    @endforeach
                </div>
            @endif
            <hr class="mb-3">
            <div class="d-flex flex-wrap justify-content-between">
                @include('partials.components.social_share',['url'=> URL::current() , 'title'=>$product->name ])

            </div>
        </div>
    </div>
    <!-- Product Tabs-->
    <div class="row padding-top-3x mb-3">
        <div class="col-lg-10 offset-lg-1">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab"
                                        role="tab">@lang('Packages-ecommerce-basic::labels.template.product_single.description')</a>
                </li>
                @if(\Settings::get('ecommerce_rating_enable',true))

                    <li class="nav-item"><a class="nav-link" href="#reviews" data-toggle="tab"
                                            role="tab">@lang('Packages-ecommerce-basic::labels.template.product_single.reviews',['count'=>$product->ratings->count()])</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div>
                        {!! $product->description !!}
                    </div>
                </div>
                @if(\Settings::get('ecommerce_rating_enable',true))
                    <br>
                    @include('partials.tabs.reviews',['reviews'=>$product->ratings])
                @endif

            </div>
        </div>
    </div>

    @include('partials.featured_products',['title'=>trans('Packages-ecommerce-basic::labels.template.product_single.title'), 'categories_ids' => $product->categories()->pluck('id')->toArray()])
    </div>
@stop

@section('js')
    @parent
    @include('Ecommerce::cart.cart_script')
    <script type="text/javascript">

           $(document).ready(function () {
           $('.owl-carousel').owlCarousel({
             items: 5,
            singleItem: true,
                rtl:@if(\Language::isRTL()){{'true'}}@else{{'false'}}@endif
            });
        });

    </script>
@endsection