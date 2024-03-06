<?php
/**
 * @project     : blog
 * @file        : header.blade.php
 * @created_at  : 3/5/16 - 10:22 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/
?>
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::user()->avatar)
                        <img src="/{{config("settings.upload_path")."/".Auth::user()->avatar}}" class="user-image" alt="User Image">
                    @else
                        <img src="{{asset('backend/dist/img/default-avatar.jpg')}}" class="user-image" alt="User Image">
                    @endif


                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        @if(Auth::User()->avatar)
                        <img src="/{{config("settings.upload_path")."/".Auth::user()->avatar}}" class="img-circle" alt="User Image">
                            @else
                            <img src="{{asset('backend/dist/img/default-avatar.jpg')}}" class="img-circle" alt="User Image">
                        @endif


                        <p>
                            {{Auth::user()->name}}
                            <small>{{ date("Y M d",strtotime(Auth::user()->created_at)) }}</small>
                            {{--<small>{{Carbon::now()}}</small>--}}
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="user-footer">

                        <div class="pull-left">
                            <a href="{{ URL::to('admin/account') }}" class="btn btn-default btn-flat"><i class="fa fa-gears"></i>  Account</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
        </ul>
    </div>
</nav>
