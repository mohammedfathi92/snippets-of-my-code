<?php
/**
 * @project     : blog
 * @file        : sidebar.blade.php
 * @created_at  : 3/5/16 - 10:27 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/
?>
        <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::user()->avatar)
                <img src="/{{ config("settings.upload_path")."/".Auth::user()->avatar}}" style="width:100px" class="img-circle" alt="User Image">
                    @else
                    <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="active treeview">
                <a href="{{url('admin')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>
            <li class="treeview">
                <a href="{{url('admin/categories')}}">
                    <i class="fa fa-files-o"></i>
                    <span>Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/categories')}}"><i class="fa fa-list"></i> All Categories</a></li>
                    <li><a href="{{url('admin/categories/add')}}"><i class="fa fa-plus-circle"></i> Add Category</a>
                    </li>

                </ul>
            </li>
            <li class="treeview">
                <a href="{{url("admin/products")}}">
                    <i class="fa fa-file-text"></i>
                    {{trans("products.link_products")}}</a>
                <ul class="treeview-menu">
                    <li><a href="{{url("admin/products/create")}}"><i
                                    class="fa fa-plus-circle"></i> {{trans("products.link_add_product")}}</a></li>
                    <li><a href="{{url("admin/products")}}"><i class="fa fa-file-text"></i> {{trans("products.link_products")}}
                        </a></li>
                </ul>
            </li>
            @if(Auth::user()->level<1)
            <li class="treeview">
                <a href="{{url("admin/users")}}">
                    <i class="fa fa-file-text"></i>
                    {{trans("users.link_users")}}</a>
                <ul class="treeview-menu">
                    <li><a href="{{url("admin/users/create")}}"><i
                                    class="fa fa-plus-circle"></i> {{trans("users.link_add_user")}}</a></li>
                    <li><a href="{{url("admin/users")}}"><i class="fa fa-file-text"></i> {{trans("users.list_all")}}
                        </a></li>
                </ul>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

