<!--header-->
<header class="default ">
    <div class="toolbar d-none d-sm-block">
        <div class="container">
            <div class="row toolbar-content">
                <div class="have-any-question">
                    <span>@lang('developnet-lms::labels.header.have_question')</span>
                    <div class="mobile">
                        <i class="fa fa-whatsapp"></i><a href="tel:{{ \Settings::get('site_contact_phone') }}"
                                                         class="value">{{ \Settings::get('site_contact_phone') }}</a>
                    </div>
                    <div class="email"><i class="fa fa-envelope"></i><a
                                href="mailto:{{ \Settings::get('contact_form_email') }}">{{ \Settings::get('contact_form_email') }}</a>
                    </div>
                </div>
                <div class="login-popup-base">
                    <div class="thim-link-login thim-login-popup">
                        @auth()
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}

</form>
@if(user()->hasRole('subadmin') || user()->hasRole('superuser'))

                            <a class="my_account"
                               href="{{url('/dashboard')}}">لوحة التحكم</a>

@endif

                            <a class="my_account"
                               href="{{route('account.profile', user()->hashed_id)}}">@lang('developnet-lms::labels.header.my_account')</a>
                            <a  href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('developnet-lms::labels.header.log_out')</a>

                        @else
                            <a class="login"
                               href="{{ route('login') }}">@lang('developnet-lms::labels.header.login')</a>
                            <a class="register"
                               href="{{ route('register') }}">@lang('developnet-lms::labels.header.register')</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg  nav-menu">
                <a class="navbar-brand" href="/">
                    <img alt="Alrabeh"
                         src="{{\Settings::get('site_logo_dark', url('/assets/themes/developnet-lms/img/Alrabeh.png'))}}"
                         class="logo-original">
                    <img alt="Alrabeh"
                         src="{{\Settings::get('site_logo', url('/assets/themes/developnet-lms/img/Alrabeh-white.png'))}}"
                         class="logo-white">
                </a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="fa fa-bars"></span>
                </button>


                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        @include('partials.menu.menu_item', ['menus' => Menus::getMenu('lms_frontend','active')])
                        @auth()
                            <li class="nav-item">
                                <a class="btn btn-dark" href="/messages"
                                   onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=450,height=700');return false;">
                                    <i class="fa fa-envelope"></i>
                                    الرسائل {{-- <span class="badge badge-danger">0 جديد!</span> --}}
                                </a>
                            </li>
                            <li class="nav-item d-block d-sm-none">
                                <a class="my_account"
                                   href="{{route('account.profile', user()->hashed_id)}}">@lang('developnet-lms::labels.header.my_account')</a>
                            </li>
                            <li class="nav-item d-block d-sm-none">
                                <a  href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('developnet-lms::labels.header.log_out')</a>
                            </li>

                        @else
                            <li class="nav-item d-block d-sm-none">
                                <a class="login"
                                   href="{{ route('login') }}">@lang('developnet-lms::labels.header.login')</a>
                            </li>
                            <li class="nav-item d-block d-sm-none">
                                <a class="register"
                                   href="{{ route('register') }}">@lang('developnet-lms::labels.header.register')</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--./header-->
