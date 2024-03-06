<?php
/**
 * @project     : blog
 * @file        : dashboard.blade.php
 * @created_at  : 3/5/16 - 12:52 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/
?>
@extends("backend.layout.master")

@section("sidebar")
    @include("backend.layout.sidebar")
@endsection

@section("content")
    <div class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{count($products)}}</h3>

                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('admin/products')}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-fuchsia">
                <div class="inner">
                    <h3>{{count($slides)}}</h3>

                    <p>Slides in Home Page</p>
                </div>
                <div class="icon">
                    <i class=" glyphicon glyphicon-bookmark "></i>
                </div>
                <a href="{{url('admin/products')}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{count($categories)}}</h3>

                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('admin/categories')}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#products-list" data-toggle="tab">Products</a></li>
                    <li><a href="#home-slides" data-toggle="tab">Home Slides</a></li>
                    <li class="pull-left header"><i class="fa fa-shopping-cart"></i> Products</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="products-list" style="position: relative; ">

                        <table id="dataTable" class="table table-bordered table-hover" data-order="[[1,1]]">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>{{trans("products.product_name")}}</th>
                                <th>{{trans("products.category")}}</th>

                                <th data-orderable="false">
                                    <a href="{{url("admin/products/create")}}"
                                                              class="btn btn-primary pull-right">{{trans('main.btn_add')}}</a>
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($products)
                                @foreach($products->slice(0,10) as $row)
                                    <tr>
                                        <td data-order="false">

                                            @if($row->photo)
                                                <img src="{{url($row->photo)}}" alt="{{$row->name}}" class="img-md">
                                            @endif
                                        </td>
                                        <td data-search="{{$row->name}}">{{$row->name}}</td>
                                        <td >
                                            @if($row->category()->first())
                                                <a
                                                        href="{{url('admin/categories/products/'.$row->category()->first()->id
                                                )}}">{{$row->category()->first()->cat_title}}</a>
                                            @endif
                                        </td>


                                        <td data-order="false">
                                            <a class="btn btn-success" href="{{url("admin/products/edit/".$row->id)}}"
                                               title="{{trans("main.btn_edit")}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger"
                                               onclick="return confirm('{{trans('main.delete_confirmation_message')}}');"
                                               href="{{url("admin/products/delete/".$row->id)}}"
                                               title="{{trans("main.btn_delete")}}"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="chart tab-pane" id="home-slides" style="position: relative; ">
                        <table id="dataTable" class="table table-bordered table-hover" data-order="[[1,1]]">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>{{trans("products.product_name")}}</th>
                                <th>{{trans("products.category")}}</th>
                                <th>Sort</th>

                                <th data-orderable="false">
                                    <a href="{{url("admin/products/create")}}"
                                       class="btn btn-primary pull-right">{{trans('main.btn_add')}}</a>
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($slides)
                                @foreach($slides as $row)
                                    <tr>
                                        <td data-order="false">

                                            @if($row->photo)
                                                <img src="{{url($row->photo)}}" alt="{{$row->name}}" class="img-md">
                                            @endif
                                        </td>
                                        <td data-search="{{$row->name}}">{{$row->name}}</td>
                                        <td >
                                            @if($row->category()->first())
                                                <a
                                                        href="{{url('admin/categories/products/'.$row->category()->first()->id
                                                )}}">{{$row->category()->first()->cat_title}}</a>
                                            @endif
                                        </td>
                                        <td>{{$row->sort}}</td>


                                        <td data-order="false">
                                            <a class="btn btn-success" href="{{url("admin/products/edit/".$row->id)}}"
                                               title="{{trans("main.btn_edit")}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger"
                                               onclick="return confirm('{{trans('main.delete_confirmation_message')}}');"
                                               href="{{url("admin/products/delete/".$row->id)}}"
                                               title="{{trans("main.btn_delete")}}"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->


        </section>
        <!-- /.Left col -->

    </div>
    <!-- /.row (main row) -->
@endsection
@section("footer")
    @include("backend.layout.footer")
@endsection