<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 4:56 PM
 */ ?>

@extends('backend.layouts.master')
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-link"></i> {{trans("menus.backend_page_header")}}
        @can("create menus")
            <a href="{{url($locale.'/'.$backend_uri."/menus/$menu->id/items/create")}}" class="btn btn-success"><i
                        class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
        @endcan
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-md-12 ">

                <div class="panel panel-default">
                    <div class="panel-body buttons-spacing-vertical">
                        <p>
                            @can('create menus')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/menus/$menu->id/items/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/menus/{$menu->id}/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>

                                    <th>{{trans("menus.id")}}</th>
                                    <th>{{trans("menus.title")}}</th>
                                    <th>{{trans("menu_items.url")}}</th>
                                    <th>{{trans("menus.order")}}</th>
                                    <th>{{trans("menus.status")}}</th>
                                    <th>{{trans("menus.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($menu->firstChildItems()->count())
                                    @foreach($menu->firstChildItems as $row)

                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td><a href="{{$row->url}}">{{$row->title}}</a></td>
                                            <td>{{$row->url}}</td>
                                            <td>{{$row->position}}</td>
                                            <td>{{$row->order}}</td>
                                            <td>{!! $row->status?'<span class="label label-success">'.trans("menus.status_active").'</span>':'<span class="label label-danger">'.trans("menus.status_inactive").'</span>' !!}</td>
                                            <td>{!! \Carbon\Carbon::instance($row->updated_at)->diffForHumans() !!}</td>
                                            <td class="text-right">
                                                @can('edit menus')
                                                    <a href="{{url("$locale/$backend_uri/menus/{$menu->id}/items/$row->id/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete menus')
                                                    <a href="{{url("$locale/$backend_uri/menus/{$menu->id}/items/$row->id/delete")}}"
                                                       class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_delete")}}"
                                                       onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"><i
                                                                class="fa fa-times"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                        {{generateSubMenuItemsRows($row,$menu, $locale, $backend_uri)}}
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>
                        <!-- // Progress table -->

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/menus' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop