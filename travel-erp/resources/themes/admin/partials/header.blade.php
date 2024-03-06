<!-- contains the header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>D</b>L</span>
        <!-- logo for regular state and mobile devices -->
        <img src="{{ \Settings::get('site_logo') }}" class="" style="max-height: 30px;"/>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">@lang('Packages-admin::labels.partial.toggle_navigation')</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @php Actions::do_action('show_navbar') @endphp
                @if(count(\Settings::get('supported_languages', [])) > 1)
                    <li class="dropdown locale">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {!! \Language::flag() !!} {!! \Language::getName() !!}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        {!! \Language::flags('dropdown-menu') !!}
                    </li>
                @endif
                @if (schemaHasTable('notifications'))

                    <li class="dropdown notifications-menu">
                        <a href="{{ url('notifications') }}" class="_dropdown-toggle" data-_toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            @if($unreadNotifications = user()->unreadNotifications()->count())
                                <span class="label label-warning">{{ $unreadNotifications }}</span>
                            @endif
                        </a>
                        {{--<ul class="dropdown-menu">--}}
                        {{--<li class="header">You have 10 notifications</li>--}}
                        {{--<li>--}}
                        {{--<!-- inner menu: contains the actual data -->--}}
                        {{--<ul class="menu">--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-warning text-yellow"></i> Very long description here that may--}}
                        {{--not fit into the--}}
                        {{--page and may cause design problems--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-users text-red"></i> 5 new members joined--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-shopping-cart text-green"></i> 25 sales made--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-user text-red"></i> You changed your username--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="footer"><a href="#">View all</a></li>--}}
                        {{--</ul>--}}
                    </li>
                @endif
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ user()->picture_thumb }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ user()->picture_thumb }}" class="img-circle"
                                 alt="User Image">

                            <p>
                                {{ user()->name }}
                            </p>
                            <p>
                                {{ user()->email }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('profile') }}"
                                   class="btn btn-default btn-flat">@lang('Packages-admin::labels.partial.profile')</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" data-action="logout"
                                   class="btn btn-default btn-flat">
                                    @lang('Packages-admin::labels.partial.logout')
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>