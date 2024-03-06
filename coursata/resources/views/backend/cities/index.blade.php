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
        <i class="fa fa-map"></i> {{trans("cities.backend_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri."/countries/$country->id/cities/create")}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
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
                            @can('create cities')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/countries/$country->id/cities/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan
                            @can('delete cities')
                                <button type="submit"
                                        onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"
                                        form="tableForm" class="btn btn-danger"><i
                                            class="fa fa-times"></i> {{trans("main.btn_delete")}}</button>
                            @endcan
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/cities/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle datatable">
                                <thead>
                                <tr>
                                    @can('delete cities')
                                        <th width="20">
                                            <div class="checkbox checkbox-single margin-none">
                                                <input id="checkAll" data-toggle="check-all"
                                                       data-target="#responsive-table-body" type="checkbox">
                                                <label for="checkAll">{{trans("main.label_check_all")}}</label>
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{trans("cities.name")}}</th>

                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data)
                                    @foreach($data as $row)

                                        <tr>
                                            @can('delete cities')
                                                <td>
                                                    <div class="checkbox checkbox-single">
                                                        <input id="checkbox_{{$row->id}}" name="items[]" type="checkbox"
                                                               value="{{$row->id}}">
                                                        <label for="checkbox_{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                            @endcan

                                            <td>{{$row->name}}</td>
                                            <td class="text-right">
                                                @can('edit cities')
                                                    <a href="{{url("$locale/$backend_uri/countries/$country->id/cities/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete cities')
                                                    <a href="{{url("$locale/$backend_uri/countries/$country->id/cities/{$row->id}/delete")}}"
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

@endsection
@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/cities' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop