@extends('layouts.master')
@section('editable_content')    

  @php
    $locale = \Language::getCode();
    $products = \Packages\Modules\Ecommerce\Models\Product::all(); 
    $categories = \Shop::getFeaturedCategories(); 
  @endphp

   @php \Actions::do_action('pre_content',$item, $home??null) @endphp

    {!! $item->rendered !!}
         
        
      

        <div class="new_arrivals_agile_dvls_info fadeIn wow  animated" data-wow-delay="0.25s"> 
            <div class="container">
                <h3 class="wthree_text_info">@lang('directline::custom.home_page.title_new_arrivals')</h3>     
                    <div id="horizontalTab">
                            <ul class="resp-tabs-list">
                                 @foreach($categories as $category)
                                <li> {{ $category->name }}</li>
                                @endforeach
                            </ul>
                        <div class="resp-tabs-container">
                         <!--/tab_one-->
                         
                        @foreach($categories as $category)
                            <div class="{{ $category }}_1">
                               <div class="row cols-3 mb-2">
                                

                                     @foreach($category->products()->orderBy('created_at','desc')->paginate(4) as $product)
                                     @php
                                     $grid_col = 1;
                                     @endphp
                @include('partials.product_grid_item',compact('product','grid_col'))
            @endforeach
                               </div>
                            </div>
                            @endforeach
                            <!--//tab_one-->
                        </div>
                    </div>  
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
                <div class="col text-center">
                    <a class="btn btn-outline-secondary margin-top-none" href="{{ route('shop.index') }}">
                        @lang('directline::custom.home_page.btn_all_products')                   </a>
                </div>
            </div>
        </div>
        <!-- //new_arrivals -->

{{-- Commented section is the section for English & Arabic --}}
        <!-- /Image Gallery-->
     {{--    <section class="image-gallery">
            <div class="container">
                <div class="row gallery-cont">
                    <div class="col-sm-6 gallery-col">
                      <a href="{!! \Settings::get('section_top_right_url_ar')?: '#' !!}">
                       <div class="gallery-block ">
                           <!-- <div class="g-desc text-white">
                               <h4>Power Bank</h4>
                               <p>Brands at Best prices and qualities</p>
                           </div> -->
                            {!! \Settings::get('section_top_right_text_ar') !!}
                           <img src="{!! \Settings::get('section_top_right_img_ar') !!}">
                       </div>
                       </a>
                       <a href="{!! \Settings::get('section_bott_right_url_ar')?: '#' !!}">
                       <div class="gallery-block ">
                          
                              {!! \Settings::get('section_bott_right_text_ar') !!}
                           
                           <img src="{!! \Settings::get('section_bott_right_img_ar') !!}">
                       </div> 
                    </div>
                    <div class="col-sm-6 gallery-col">
                       </a>
                       <a href="{!! \Settings::get('section_top_leftt_url_ar')?: '#' !!}">
                       <div class="gallery-block">
                           
                              {!! \Settings::get('section_top_left_text_ar') !!}
                           
                           <img src="{!! \Settings::get('section_top_left_img_ar') !!}">
                       </div>
                        </a>
                       <a href="{!! \Settings::get('section_bott_left_url_ar')?: '#' !!}">
                       <div class="gallery-block">
                           
                               {!! \Settings::get('section_bott_left_text_ar') !!}
                           
                           <img src="{!! \Settings::get('section_bott_left_img_ar') !!}">
                       </div>
                       </a> 
                    </div>
                </div>
            </div>
        </section> --}}

           <section class="image-gallery">
            <div class="container">
                <div class="row gallery-cont">
                    <div class="col-sm-6 gallery-col">
                      <a href="{!! \Settings::get('section_top_right_url_ar')?: '#' !!}">
                       <div class="gallery-block ">
                           <!-- <div class="g-desc text-white">
                               <h4>Power Bank</h4>
                               <p>Brands at Best prices and qualities</p>
                           </div> -->
                            {!! \Settings::get('section_top_right_text_ar') !!}
                           <img src="{!! \Settings::get('section_top_right_img_ar') !!}">
                       </div>
                       </a>
                       <a href="{!! \Settings::get('section_bott_right_url_ar')?: '#' !!}">
                       <div class="gallery-block ">
                          
                              {!! \Settings::get('section_bott_right_text_ar') !!}
                           
                           <img src="{!! \Settings::get('section_bott_right_img_ar') !!}">
                       </div> 
                    </div>
                    <div class="col-sm-6 gallery-col">
                       </a>
                       <a href="{!! \Settings::get('section_top_leftt_url_ar')?: '#' !!}">
                       <div class="gallery-block">
                           
                              {!! \Settings::get('section_top_left_text_ar') !!}
                           
                           <img src="{!! \Settings::get('section_top_left_img_ar') !!}">
                       </div>
                        </a>
                       <a href="{!! \Settings::get('section_bott_left_url_ar')?: '#' !!}">
                       <div class="gallery-block">
                           
                               {!! \Settings::get('section_bott_left_text_ar') !!}
                           
                           <img src="{!! \Settings::get('section_bott_left_img_ar') !!}">
                       </div>
                       </a> 
                    </div>
                </div>
            </div>
        </section>

    
        <br><br>
        {{-- <section class="gallery-bfr-footer">
                            <div class="container-fluid">
                                <div class="row gbr-content">
                                    <div class=" row-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="gbr-block">
                                                    <a href="#">
                                                        <img src="/images/02.jpg" title="productname">
                                                    </a>
                                                </div> 
                                                <div class="gbr-overlay">
                                                    <a href="#"> Power Bank</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="gbr-block">
                                                    <a href="#">
                                                        <img src="/images/d1.jpg" title="productname">
                                                    </a>
                                                </div> 
                                                <div class="gbr-overlay">
                                                    <a href="#"> USB CABLE</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="gbr-block">
                                                    <a href="#">
                                                        <img src="/images/05.jpg" title="productname">
                                                    </a>
                                                </div> 
                                                <div class="gbr-overlay">
                                                    <a href="#"> Power Bank</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class=" row-info">
                                        <div class="dark-cont">
                                             <h5>SIGN UP FOR NEWSLETTER !</h5>
                                        </div>
                                        <div class="gbr-data">
                                            <div class="newsright">
                                                <form action="#" method="post">
                                                    <input type="email" placeholder="Enter your email..." name="email" required="">
                                                    <input type="submit" value="Submit">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row-block">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="gbr-block">
                                                    <a href="#">
                                                        <img src="/images/h1.jpg" title="productname">
                                                    </a>
                                                </div> 
                                                <div class="gbr-overlay">
                                                    <a href="#"> USB CABLE</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="gbr-block">
                                                    <a href="#">
                                                        <img src="/images/h2.jpg" title="productname">
                                                    </a>
                                                </div> 
                                                <div class="gbr-overlay">
                                                    <a href="#"> Power Bank</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="gbr-block">
                                                    <a href="#">
                                                        <img src="/images/h3.jpg" title="productname">
                                                    </a>
                                                </div> 
                                                <div class="gbr-overlay">
                                                    <a href="#"> USB CABLE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> --}}
@endsection
@section('css')

  {!! Theme::css('css/easy-responsive-tabs.css') !!}
    {!! Theme::css('css/animate.min.css') !!}
   {!! \Html::style('assets/Packages/plugins/OwlCarousel2-2.2.1/assets/owl.carousel.min.css') !!}
    {!! \Html::style('assets/Packages/plugins/OwlCarousel2-2.2.1/assets/owl.theme.default.min.css') !!}


    <style type="text/css">
      
/* -- remove slider image zoom--*/
.up-3 >div,
.right-3 >div ,
.focal-point >div{
    margin: 0 !important;
    margin-top: 0 !important;
    margin-left: 0 !important;
    margin-bottom: 0 !important;
    margin-right: 0 !important
}

 @media (max-width: 991px){
    #slider .item{
        height: auto !important;
    }
    .owl-carousel.owl-theme .item img{
        height: auto !important;
    }
    #slider .owl-dots{
        margin-top: auto 
    }
 }
@media (max-width: 767px){
    .owl-carousel.owl-theme .carousel-caption .container{
        left: auto !important;
        right: auto !important;

     }

}
@media (max-width: 580px){
    .owl-carousel.owl-theme .carousel-caption {
        padding: 0 25px;
}
    </style>

   
@stop

@section('js')
    @parent

<script type="text/javascript">
   $(document).ready(function (){

      var owl = $('.owl-carousel.owl-theme');

      

      owl.owlCarousel({
          loop:true,
          margin:0,
          navSpeed:500,
          nav:true,
          rtl: @if(\Language::isRTL()){{'true'}}@else{{'false'}}@endif,    
          autoplay: true,
          rewind: true,
          items:1
      });
      var owlFirstSlide = $('.owl-carousel.owl-theme .owl-stage .item').first();
      owlFirstSlide.find('h3').addClass('wow animated fadeInDown');
      owlFirstSlide.find('p').addClass('wow animated fadeIn ');
       owlFirstSlide.find('a').addClass('wow animated fadeInUp ');

      function setAnimation ( _elem, _InOut ) {

        var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        _elem.each ( function () {
          var $elem = $(this);
          var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

          $elem.addClass($animationType).one(animationEndEvent, function () {
            $elem.removeClass($animationType); 
          });
        });
      }


      owl.on('change.owl.carousel', function(event) {
          var $currentItem = $('.owl-item', owl).eq(event.item.index);
          var $elemsToanim = $currentItem.find("[data-animation-out]");
          setAnimation ($elemsToanim, 'out');
      });


      var round = 0;
      owl.on('changed.owl.carousel', function(event) {

          var $currentItem = $('.owl-item', owl).eq(event.item.index);
          var $elemsToanim = $currentItem.find("[data-animation-in]");
        
          setAnimation ($elemsToanim, 'in');
      })

      
      owl.on('translated.owl.carousel', function(event) {
        
          if (event.item.index == (event.page.count - 1))  {
            if (round < 1) {
              round++
            } else {
              owl.trigger('stop.owl.autoplay');
              var owlData = owl.data('owl.carousel');
              owlData.settings.autoplay = false; 
              owlData.options.autoplay = false;
              owl.trigger('refresh.owl.carousel');
            }
          }
      });

      
    });
       
</script>

    @include('Ecommerce::cart.cart_script')

    {!! Theme::js('js/easy-responsive-tabs.js') !!}
 
 
 <script>
    $(document).ready(function () {
    $('#horizontalTab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion           
    width: 'auto', //auto or any width like 600px
    fit: true,   // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    activate: function(event) { // Callback function if tab is switched
    var $tab = $(this);
    var $info = $('#tabInfo');
    var $name = $('span', $info);
    $name.text($tab.text());
    $info.show();
    }
    });
    $('#verticalTab').easyResponsiveTabs({
    type: 'vertical',
    width: 'auto',
    fit: true
    });
    });
</script>

<!-- header scroll-->
<script>
    $(document).ready(function () {  
        var iScrollPos = 0;
        $(  window).on('scroll',function(){
        
            var iCurScrollPos = $(this).scrollTop();
            if (iCurScrollPos > iScrollPos) {
                //Scrolling Down
                $('header.navbar').css('position',"absolute");
                
            } 
            else if(iCurScrollPos ==0){
                $('header.navbar').css('position',"absolute");
            }
            else {
               //Scrolling Up
                $('header.navbar').css('position',"fixed");
                
            }
            iScrollPos = iCurScrollPos;
            
         
        });
    });
</script>
@stop