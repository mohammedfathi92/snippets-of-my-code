<!-- Product-->
<div class="product-card product-list">
    <a class="product-thumb" href="{{ route('shop.show', ['id' => $product->hashed_id, 'slug_name' => \CMS::getSlugName($product->name)]) }}">
        @if($product->discount)
            <div class="product-badge text-danger">{{ $product->discount }}% Off</div>
        @endif
        <img class="mx-auto" src="{{ $product->image }}" alt="{{ $product->name }}"
             style="max-height: 90%;width: auto;"/>
    </a>
    <div class="product-info">
        @if(\Settings::get('ecommerce_rating_enable',true))
            @include('partials.components.rating',['rating'=> $product->averageRating(1)[0],'rating_count'=>null])
        @endif
        <h3 class="product-title">
            <a href="{{ route('shop.show', ['id' => $product->hashed_id, 'slug_name' => \CMS::getSlugName($product->name)]) }}">
                {{ $product->name }}
            </a>
        </h3>
        <h4 class="product-price">
            @if($product->discount)
                <del>{{ \Payments::currency($product->regular_price) }}</del>
            @endif
            {!! $product->price !!}
        </h4>
        <p class="hidden-xs-down">
            {!! str_limit(strip_tags($product->description),500) !!}
        </p>
        <div class="product-buttons">
            @if(\Settings::get('ecommerce_wishlist_enable',true))
                @include('partials.components.wishlist',['wishlist'=> user() ? \Wishlist::getWishlistItem($product->id,user()->id) : null ])
            @endif
            @if($product->activeSKU()->count() > 1 || $product->attributes()->count())
                @if($product->external_url)
                    <a href="{{ $product->external_url }}" target="_blank" class="btn btn-outline-primary btn-sm"
                       title="Buy Product">@lang('Packages-ecommerce-basic::labels.partial.buy_product')
                    </a>
                @else
                    <a href="{{ route('shop.show', ['id' => $product->hashed_id, 'slug_name' => \CMS::getSlugName($product->name)]) }}" class="btn btn-outline-primary btn-sm">
                        @lang('Packages-ecommerce-basic::labels.partial.add_to_cart')
                    </a>
                @endif
            @else
                @if($product->activeSKU()->first()->stock_status == "in_stock")
                    @if($product->external_url)
                        <a href="{{ $product->external_url }}" target="_blank" class="btn btn-outline-primary btn-sm"
                           title="Buy Product">@lang('Packages-ecommerce-basic::labels.partial.buy_product')
                        </a>
                    @else
                        <a href="{{ url('cart/'.$product->hashed_id.'/add-to-cart/'.$product->activeSKU()->first()->hashed_id) }}"
                           data-action="post" data-page_action="updateCart"
                           class="btn btn-outline-primary btn-sm">
                            @lang('Packages-ecommerce-basic::labels.partial.add_to_cart')
                        </a>
                    @endif
                @else
                    <a href="#" class="btn btn-sm btn-outline-danger"
                       title="Out Of Stock">
                        @lang('Packages-ecommerce-basic::labels.partial.out_stock')
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>