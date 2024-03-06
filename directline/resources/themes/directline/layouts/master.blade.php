@php
$locale = \Language::getCode();
@endphp

<!DOCTYPE html>
<html lang="{{ \Language::getCode() }}" dir="{{ \Language::getDirection() }}">
<head>
    {!! \SEO::generate() !!}
    <meta charset="utf-8">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="shortcut icon" href="{{ \Settings::get('site_favicon') }}" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {!! Theme::css('font-awesome-4.7.0/css/font-awesome.min.css') !!}

    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    {!! Theme::css('css/vendor.min.css') !!}

    <!-- Main Template Styles-->
    {!! Theme::css('css/styles.css') !!}

    {!! \Html::style('assets/Packages/plugins/lightbox2/css/lightbox.min.css') !!} 

      <!-- RTL -->        
    
    @if(\Language::isRTL())
        {!! Theme::css('css/vendor-rtl.css') !!}
        {!! Theme::css('css/styles-rtl.css') !!}
    @endif

   {!! \Html::style('https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css') !!}
   {!! Theme::css('plugins/Ladda/ladda-themeless.min.css') !!}
   {!! Theme::css('css/custom.css') !!}

   <!-- Modernizr-->
    {!! Theme::js('js/modernizr.min.js') !!}

    <script type="text/javascript">
        window.base_url = '{!! url('/') !!}';
    </script>
     {!! Theme::css('css/newstyle.css') !!} 
    @if(\Language::isRTL())
     {!! Theme::css('css/newstyle.rtl.css') !!} 
    @endif


 @yield('css')

    @if(\Settings::get('google_analytics_id'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id={{ \Settings::get('google_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', "{{ \Settings::get('google_analytics_id') }}");
        </script>
    @endif
    <style type="text/css">

    /*-- dropdown menu --*/
 .sub-menu.menu-products{
    min-height: 220px;
 }
 .footer ul {
    padding-right: 0 !important;
     padding-left: 0 !important;
}
/**/

.opacity-nav .site-menu .dropdown-menu a{
    width: 50%;
}
.dropdown-menu.menu-products{
        width: 40vw !important;
        left: -15vw !important;
        @if(\Language::isRTL())
        right: -20vw !important;
        @endif
}
        {!! \Settings::get('custom_css', '') !!}

    </style>
   
</head>

<body>
  
{{--     <!--loading overlay-->
    <section class="Loading-overlay">
     <div class='middle'>...DIRECT LINE...
        <div class='loading-bar'>
            <div class='loading-bar-pulse'></div>
        </div>
     </div>
    </section> --}}

@include('partials.header')

@yield('before_content')

@php
if(Request::segment(1) == $locale){
    $segment_no = 2;  
}else{
    $segment_no = 1;
}
@endphp

<div id="editable_content" @if(Request::segment($segment_no) !== null) style="margin-top: 100px;"@endif>
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
        @yield('editable_content')
        <div>@include('partials.footer')</div>

          <!-- side social media-->

        {{--  <div class="side-social-media">
            <div class="show-social-list"><i class="fa fa-forward" aria-hidden="true" title="show social media"></i></div>
                        
                <ul class="social-nav model-3d-0  dv_agile_social side-social-list">
                    <li><a href="#" class="facebook" title="facebook">
                          <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                          <div class="back" ><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
                    <li><a href="#" class="twitter" title="twitter"> 
                          <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                          <div class="back" ><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
                    <li><a href="#" class="instagram" title="instagram">
                          <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                          <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
                    <li><a href="#" class="pinterest" title="pinterest">
                          <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                          <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
                </ul>
            <div class="hide-social-list"><i class="fa fa-backward" aria-hidden="true" title="hide"></i></div>
        </div>  --}} 
    </div>
</div>

<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#"><i class="fa fa-arrow-up"></i></a>
<!-- Backdrop-->
<div class="site-backdrop"></div>
@yield('after_content')

<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
{!! Theme::js('js/vendor.min.js') !!}
{!! Theme::js('js/scripts.min.js') !!}
  @if(\Language::isRTL())
{!! Theme::js('js/menu.rtl.js') !!}
    @else

    {!! Theme::js('js/menu.js') !!}

@endif

{!! \Html::script('assets/Packages/plugins/lightbox2/js/lightbox.min.js') !!}
{!! \Html::script('https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.js') !!}

<!-- Ladda -->
{!! Theme::js('plugins/Ladda/spin.min.js') !!}
{!! Theme::js('plugins/Ladda/ladda.min.js') !!}

{!! Theme::js('js/functions.js') !!}
{!! Theme::js('js/main.js') !!}
{!! \Html::script('assets/Packages/js/Packages_functions.js') !!}
{!! \Html::script('assets/Packages/js/Packages_main.js') !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.11.0/lazyload.min.js"></script>
<script>
var myLazyLoad = new LazyLoad({
    elements_selector: ".lazy"
});
</script>

{!! Assets::js() !!}

@php  \Actions::do_action('footer_js') @endphp

@yield('js')



<script type="text/javascript">
    {!! \Settings::get('custom_js', '') !!}

</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bfe7cd940105007f379f525/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6109323279450960",
    enable_page_level_ads: true
  });
</script>



</body>
</html>