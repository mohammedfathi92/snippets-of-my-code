<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 3/23/16
 * Time: 11:36 PM
 */
?>
@extends('backend.layout.master')

@section("page_header")
    <div class="content-header">
        <h1>
            Categories
            <small>Categories List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">All Categories</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-hover" data-order="[[1,1]]">
                        <thead>
                        <tr>

                            <th>#</th>
                            <th>{{trans("products.product_name")}}</th>
                            <th>{{trans("products.appear_in_home")}}</th>
                            <th>{{trans("products.category")}}</th>
                            <th>Sort</th>
                            <th>{{trans("products.updated_at")}}</th>
                            <th data-orderable="false"><a href="{{url("admin/products/create")}}"
                                                          class="btn btn-primary pull-right">{{trans('main.btn_add')}}</a>
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $row)
                                <tr>
                                    <td data-order="false">

                                        @if($row->photo)
                                            <img src="{{url(config('settings.upload_path')."/small/".$row->photo)}}" alt="{{$row->name}}" class="img-md">
                                        @endif
                                    </td>
                                    <td data-search="{{$row->name}}">{{$row->name}}</td>

                                    <td data-search="{{$row->show_in_home?trans('main.yes'):trans('main.no')}}">
                                        {!!  $row->show_in_home?"<span class='label label-success'>".trans('main.yes')."</span>":"<span class='label label-default'>".trans('main.no')."</span>"!!}
                                    </td>

                                    <td >
                                        @if($row->category()->first())
                                            <a
                                                    href="{{url('admin/categories/products/'.$row->category()->first()->id
                                                )}}">{{$row->category()->first()->cat_title}}</a>
                                        @endif
                                    </td>
                                    <td data-order="{{$row->sort}}">{{$row->sort}}</td>
                                    <td data-order="{{strtotime($row->updated_at)}}">{{\Carbon\Carbon::instance($row->updated_at)->diffForHumans()}}</td>

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
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{trans("products.product_name")}}</th>
                            <th>{{trans("products.appear_in_home")}}</th>
                            <th>{{trans("products.category")}}</th>
                            <th>{{trans("products.created_at")}}</th>


                            <th></th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

@stop
@section("scripts")
    <script>
        $(function () {
            $("#dataTable").DataTable();
        });
    </script>
@stop