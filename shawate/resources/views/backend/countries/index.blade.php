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
        <i class="fa fa-map"></i> {{trans("countries.backend_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri.'/countries/create')}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">

            <div class="col-md-12 ">

                <div class="panel panel-default">
                    <div class="panel-body buttons-spacing-vertical">
                        <p>
                            @can('create countries')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/countries/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan

                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/countries/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle datatable">
                                <thead>
                                <tr>
                                    <th>{{trans("countries.id")}}</th>
                                    <th>{{trans("countries.photo")}}</th>
                                    <th>{{trans("countries.name")}}</th>
                                    <th>{{trans("countries.cities")}}</th>
                                    <th>{{trans("tabs.tabs")}}</th>
                                    <th>{{trans("countries.status")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data)
                                    @foreach($data as $row)

                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                @if($row->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$row->photo))
                                                    <img src="{{url("files/small/$row->photo")}}" alt="{{$row->name}}"
                                                         style="width: 50px">
                                                @endif
                                            </td>
                                            <td>{!! Html::link("country/$row->id/".str_slug($row->{"name:en"}),$row->name) !!}</td>

                                            <td>{!! $row->cities->count()?Html::link("$backend_uri/countries/$row->id/cities",$row->cities->count(),['class'=>'btn btn-primary']):Html::link("$backend_uri/countries/$row->id/cities/create",trans('cities.link_cities_create'),['class'=>'btn btn-primary']) !!}</td>

                                            <td>{{$row->tabs()->count()?Html::link("$locale/$backend_uri/countries/$row->id/tabs",trans('tabs.count_tabs',['count'=>$row->tabs()->count()]),['class'=>'btn btn-success']):Html::link("$locale/$backend_uri/countries/$row->id/tabs/create",trans('tabs.btn_add_tab'),['class'=>'btn btn-primary'])}}</td>
                                            <td>{!! $row->status?'<span class="label label-success">'.trans("countries.status_active").'</span>':'<span class="label label-danger">'.trans("countries.status_inactive").'</span>' !!}</td>
                                            <td class="text-right">
                                                @can('edit countries')
                                                    <a href="{{url("$locale/$backend_uri/countries/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete countries')
                                                    <a href="{{url("$locale/$backend_uri/countries/{$row->id}/delete")}}"
                                                       class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_delete")}}"
                                                       onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"><i
                                                                class="fa fa-times"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
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

@stop

@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/countries' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop