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
                    <h3 class="box-title">Hover Data Table</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-hover" data-order="[[1,1]]">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans("categories.title")}}</th>
                            <th>{{trans("categories.products_count")}}</th>
                            <th>{{trans("categories.properties_count")}}</th>
                            <th>{{trans("categories.filters_count")}}</th>
                            <th>{{trans("categories.created_at")}}</th>
                            <th data-orderable="false"><a href="{{url("admin/categories/create")}}"
                                                          class="btn btn-primary pull-right">{{trans('main.btn_add')}}</a>
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $row)
                                <tr>
                                    <td data-order="false">
                                        <a href="{{url('admin/categories/products/'.$row->id)}}">
                                            @if($row->cat_photo)
                                                <img src="{{url($row->cat_photo)}}" alt="{{$row->cat_title}}"
                                                     class="img-md">
                                            @endif
                                        </a></td>
                                    <td data-search="{{$row->cat_title}}"><a
                                                href="{{url('admin/categories/products/'.$row->id)}}">{{$row->cat_title}}</a>
                                    </td>
                                    <td data-order="{{count($row->products)}}">{{count($row->products)}}</td>
                                    <td data-order="{{count($row->properties)}}">
                                        <a href="{{url('admin/categories/'.$row->id.'/properties')}}">{{count($row->properties)?count($row->properties):trans('categories.add_properties')}}</a>
                                    </td>
                                    <td data-order="{{count($row->filters)}}">
                                        <a href="{{url('admin/categories/'.$row->id.'/filters')}}">{{count($row->filters)?count($row->filters):trans('filters.add_filters')}}</a>
                                    </td>
                                    <td data-order="{{strtotime($row->created_at)}}">{{$row->created_at}}</td>
                                    <td data-order="false">
                                        <a class="btn btn-success" href="{{url("admin/categories/edit/".$row->id)}}"
                                           title="{{trans("main.btn_edit")}}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger"
                                           onclick="return confirm('{{trans('main.delete_confirmation_message')}}');"
                                           href="{{url("admin/categories/delete/".$row->id)}}"
                                           title="{{trans("main.btn_delete")}}"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{trans("categories.title")}}</th>
                            <th>{{trans("categories.products_count")}}</th>
                            <th>{{trans("categories.properties_count")}}</th>
                            <th>{{trans("categories.filters_count")}}</th>
                            <th>{{trans("categories.created_at")}}</th>
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