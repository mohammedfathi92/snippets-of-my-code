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
            Users
            <small>Users list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">All Users</li>
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
                    <table id="dataTable" class="table table-bordered table-hover" data-order="[[1,1]]" >
                        <thead>
                        <tr>
                            <th>{!! trans("users.avatar") !!}</th>
                            <th>{!! trans("users.name") !!}</th>
                            <th>{!! trans("users.email") !!}</th>
                            <th>{!! trans("users.join_at") !!}</th>
                            <th data-orderable="false"><a href="{{url("admin/users/create")}}" class="btn btn-primary pull-right">{{trans('main.btn_add')}}</a></th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $row)
                                <tr>

                                    <td data-search="{{$row->name}}">
                                        <a href="{{url('admin/users/profile/'.$row->id)}}">
                                            @if($row->avatar)
                                                <img  src="/{{config('settings.upload_path')."/".$row->avatar}}" alt="" class="img-thumbnail" style="width:100px">
                                                @else
                                                <img  src="/backend/dist/img/default-avatar.jpg" alt="" class="img-thumbnail" style="width:100px">
                                            @endif
                                        </a>
                                    </td>
                                    <td data-search="{{$row->name}}"><a href="{{url('admin/users/profile/'.$row->id)}}">{{$row->name}}</a></td>

                                    <td data-search="{{$row->email}}">{{$row->email}}</td>
                                    <td data-order="">{{\Carbon\Carbon::instance($row->created_at)->diffForHumans()}}</td>
                                    <td data-order="false">
                                        <a class="btn btn-success" href="{{url("admin/users/edit/".$row->id)}}" title="{{trans("main.btn_edit")}}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('{{trans('main.delete_confirmation_message')}}');" href="{{url("admin/users/delete/".$row->id)}}" title="{{trans("main.btn_delete")}}"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr><td colspan="5">{{trans("users.no_data")}}</td></tr>
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{!! trans("users.avatar") !!}</th>
                            <th>{!! trans("users.name") !!}</th>
                            <th>{!! trans("users.email") !!}</th>
                            <th>{!! trans("users.join_at") !!}</th>


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