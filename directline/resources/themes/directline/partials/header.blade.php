@php
$locale = \Language::getCode();
@endphp


<!-- Off-Canvas Mobile Menu-->
<div class="offcanvas-container" id="mobile-menu">
    @auth
        <a class="account-link" href="{{ url('profile') }}">
            <div class="user-ava">
                <img src="{{ user()->picture_thumb }}" alt="{{ user()->name }}">
            </div>
            <div class="user-info">
                <h6 class="user-name">{{ user()->name }}</h6>
                <span class="text-sm text-white opacity-60">
                    @lang('Packages-ecommerce-basic::labels.partial.member_since')
                    <br/>
                    {{ format_date(user()->created_at) }}
                </span>
            </div>
        </a>
    @endauth

    <nav class="offcanvas-menu">
        <ul class="menu">
         <!--    <li class="has-logo">
                <a href="/">
                    <img src="/assets/themes/directline/images/logo-white.png">
                </a>
            </li> -->

            @foreach(Menus::getMenu('frontend_'.$locale,'active') as $menu)
                @include('partials.menu.mobile_menu_item', compact('menu'))
            @endforeach
           
            <li class="has-children">
                <span><a href="#"><span> @lang('directline::labels.partial.languages') </span></a>
                    <span class="sub-menu-toggle none ">
                        <i class="fa fa-globe"></i>
                    </span>
                </span>
             
                <ul class="offcanvas-submenu">
                    @if(count(\Settings::get('supported_languages')) > 1)
              @foreach (\Language::allowed() as $code => $name)
        <li class="{{ $li_class??'' }}">
            <a href="{{ \Language::getLocaleUrl($code) }}">
                {!! \Language::flag($code) !!} {!! $name !!}
            </a>
        </li>
    @endforeach
        @endif
                
                </ul>
            </li>
            <li class="has-children">
                <span><a href="#"><span> @lang('Packages-ecommerce-basic::labels.partial.account') </span></a>
                    <span class="sub-menu-toggle"></span>
                </span>
                <ul class="offcanvas-submenu">
                    @auth
                        <li>
                            <a href="{{ url('dashboard') }}">@lang('Packages-ecommerce-basic::labels.partial.dashboard')</a>
                        </li>
                        <li>
                            <a href="{{ url('profile') }}">@lang('Packages-ecommerce-basic::labels.partial.my_profile')</a>
                        </li>
                        <li class="sub-menu-separator"></li>
                        <li><a href="{{ route('logout') }}"
                               data-action="logout">@lang('Packages-ecommerce-basic::labels.partial.logout')</a>
                        </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-sign-in fa-fw"></i>
                                    @lang('Packages-ecommerce-basic::labels.partial.login')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    <i class="fa fa-user fa-fw"></i>
                                    @lang('Packages-ecommerce-basic::labels.partial.register')
                                </a>
                            </li>
                            @endauth
                </ul>
            </li>
            
            <li class="m-menu-social">
              {{--     @foreach (currency()->getActiveCurrencies() as $currency) 
            <a class="label nav-link badge text-white {{strtolower(session('currency')) == strtolower($currency['code']) ? 'label-primary badge-success' : 'label-default badge-secondary'}}" style="padding: 15px 15px; font-size: 18px" href="{{ request()->url() . '?currency=' . $currency['code'] }}" > {{ $currency['symbol']}}</a>
        @endforeach --}}
            </li>

            <li class="m-menu-social">
                  @foreach(\Settings::get('social_links',[]) as $key=>$link)
                    @if($key == 'maroof')

                     <a class="social-button" href="{{ $link }}" target="_blank"><img src="/assets/themes/directline/images/icon/ma3rof.png" style="max-width: 30px; max-height: 30px;"></a>

                    @else
            <a class="social-button sb-{{ $key }} shape-none sb-dark" href="{{ $link }}" target="_blank"><i
                        class="fa fa-{{ $key }}"></i></a>
                        @endif
        @endforeach
            </li>


        </ul>
    </nav>
</div>
</div>
<!-- Topbar-->
<div class="topbar">
    <div class="topbar-column">
        <a class="hidden-md-down" href="mailto:{{ \Settings::get('contact_form_email','support@developnet.net') }}">
            <i class="fa fa-envelope-o"></i>&nbsp;
            {{ \Settings::get('contact_form_email','support@developnet.net') }}
        </a>
        <a class="hidden-md-down" href="tel:{{ \Settings::get('phone_number','+996599593301') }}"><i
                    class="fa fa-mobile"></i>
            &nbsp; {{ \Settings::get('phone_number','+970599593301') }}
        </a>
        @foreach(\Settings::get('social_links',[]) as $key=>$link)
            @if($key == 'maroof')

                     <a class="social-button" href="{{ $link }}" target="_blank"><img src="/assets/themes/directline/images/icon/ma3rof.png" style="max-width: 30px; max-height: 30px;"></a>

                    @else
            <a class="social-button sb-{{ $key }} shape-none sb-dark" href="{{ $link }}" target="_blank"><i
                        class="fa fa-{{ $key }}"></i></a>
                        @endif
        @endforeach
    </div>

    <div class="topbar-column">

        <ul class="list-unstyled currencies" style="display: inline-block;">
            @php \Actions::do_action('post_display_frontend_menu') @endphp
        </ul>
       @if(count(\Settings::get('supported_languages', [])) > 1)
            <li class="dropdown locale" style="list-style-type: none;display: inline-block">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {!! \Language::flag() !!} {!! \Language::getName() !!}
                </a>
                {!! \Language::flags('dropdown-menu') !!}

            </li>
        @endif
    </div>

</div>
<!-- Navbar-->
<!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
@php
if(Request::segment(1) == $locale){
    $segment_no = 2;  
}else{
    $segment_no = 1;
}
@endphp
<header class="navbar navbar-sticky @if(Request::segment($segment_no) == null) opacity-nav @else opacity-nav inv @endif">
    <!-- Search-->
    <form class="site-search" method="get" action="{{ route('shop.index') }}">
        <input type="text" name="search" value="{{ request()->get('search') }}"/>

        <div class="search-tools"><span
                    class="clear-search"> {{-- @lang('Packages-ecommerce-basic::labels.partial.clear') --}}</span>
            <span class="close-search"><i class="icon-cross"></i></span>
        </div>
    </form>
    <div class="site-branding">
        <div class="inner">
            <!-- Off-Canvas Toggle (#mobile-menu)-->
            <a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
            <!-- Site Logo-->
            <a class="site-logo" href="{{ url('/') }}">
                    <img src="/assets/themes/directline/images/logo-dark.png" alt="{{ \Settings::get('site_name', 'Directline') }}" class="logo-dark" >
                <img src="/assets/themes/directline/images/logo-white.png" alt="{{ \Settings::get('site_name', 'Directline') }}" class="logo-white">
              
            </a>
        </div>
    </div>
    <a href="/" class="m-logo"><img src="/assets/themes/directline/images/logo-dark.png"></a>
    <!-- Main Navigation-->

    <nav class="site-menu">
        <ul>

          @foreach(Menus::getMenu('frontend_'.$locale,'active') as $menu)
                @include('partials.menu.menu_item', compact('menu'))
            @endforeach 
        </ul>
    </nav>
    <!-- Toolbar-->
    <div class="toolbar">
        <div class="inner">
            <div class="tools">
                <div class="search"><i class="icon-search"></i></div>
                <div class="account">
                    <a href="#"></a><i class="icon-head"></i>
                    <ul class="toolbar-dropdown">
                        @auth
                            <li class="sub-menu-user">
                                <div class="user-ava">
                                    <img src="{{ user()->picture_thumb }}"
                                         alt="{{ user()->name }}">
                                </div>
                                <div class="user-info">
                                    <h6 class="user-name">{{ user()->name }}</h6>
                                    <span class="text-xs text-muted">
                                       {{ trans('Packages-ecommerce-basic::labels.partial.member_since') }}
                                        <br/>
                                        {{ format_date(user()->created_at) }}
                                    </span>
                                </div>
                            </li>
                            <li>
                                <a href="{{ url('dashboard') }}">@lang('Packages-ecommerce-basic::labels.partial.dashboard')</a>
                            </li>
                            <li>
                                <a href="{{ url('profile') }}">@lang('Packages-ecommerce-basic::labels.partial.my_profile')</a>
                            </li>
                            <li class="sub-menu-separator"></li>
                            <li><a href="{{ route('logout') }}" data-action="logout">
                                    @lang('Packages-ecommerce-basic::labels.partial.logout') <i
                                            class="fa fa-sign-out fa-fw"></i></a>
                            </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">
                                        <i class="fa fa-sign-in fa-fw"></i>
                                        @lang('Packages-ecommerce-basic::labels.partial.login')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">
                                        <i class="fa fa-user fa-fw"></i>
                                        @lang('Packages-ecommerce-basic::labels.partial.register')
                                    </a>
                                </li>
                                @endauth
                    </ul>
                </div>
                <div class="cart"><a href="{{ url('cart') }}"></a>
                    <i class="fa fa-shopping-cart fa-fw"></i>
                    <span class="count" id="cart-header-count">{{ count(\ShoppingCart::getItems()) }}</span>
                    <span class="subtotal" id="cart-header-total">
                        {{ \ShoppingCart::total() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>