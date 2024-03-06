<div class="row">

    @if($products)
        <div id="owl-demo" class="owl-carousel">
            @foreach($products as $item)
                <div class="item">
                    <div class="whitebg2">
                        <div class="centimage">
                            @if($item->photo and is_string($item->photo))
                                <a class="spes1" resultItem href="#/product/{{$item->id}}"><img  class="paddh40 owl-lazy lazyOwl" data-src="{{url($item->photo)}}" alt=""/></a>
                                @endif
                        </div>

                        <div class="catname miniproductname">{{$item->name}}</div>
                        <div class="colorsamsungpro">
                            @if($item->colors) @foreach($item->colors as $color)
                                <span class="whitecol" style="background: {{$color->color}};"></span>
                            @endforeach
                            @endif
                        </div>
                        <div class="productdetailsmini ulscrollbar">
                            {!! $item->translateOrNew(app()->getLocale())->description !!}
                        </div>
                        <div class="mindetails">
                            <a class="compare" href="javascript:;" onclick="bendCompare({{$item->id}})"></a>
                            <a class="spes1" resultItem href="#/product/{{$item->id}}">{{trans('main.know_more')}}</a>

                        </div>


                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if(!$products)
            <div class="no-results alert alert-warning">{{trans('main.no_results')}}</div>
        @endif
</div>
<script>
    $(".owl-carousel").owlCarousel({
        items: 3,
        lazyLoad:true,
        lazyFollow:true,
        lazyEffect:"fade",
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [979, 1]
    });
    $(".spes1").click(function () {
        $(".productinfo").addClass('bounceInRight-duration bounceInRight');
        $(".productinfo").removeClass('bounceOutRight');
    });

    function bendCompare(product) {
        var $http = angular.injector(["ng"]).get("$http");
        var qs = "?product=" + product;
        var $rootScope = angular.injector(['ng']).get("$rootScope");
        var scope = angular.element('.ct-cart').scope();
            if(laraApp.lang){
                laraApp.lang="{{app()->getLocale()}}";
            }
        $http.get(laraApp.appUrl+"/"+laraApp.lang + "/compare" + qs).success(function (result) {
            if (result.success) {
                scope.compareList = result.data;
                if(scope.compareList ==null){
                    angular.element('.ct-js-cart__button').hide();
                }
                scope.$apply();
            }
        });
        angular.element('.ct-js-cart__button').show();
        angular.element('.ct-cart__message').addClass('ct-cart__message-added');
        setTimeout(function () {
            angular.element('.ct-cart__message').removeClass('ct-cart__message-added');
        }, 1000)
    }
</script>