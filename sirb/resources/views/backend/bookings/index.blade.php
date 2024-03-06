<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 4:56 PM
 */ ?>

@extends('backend.layouts.master')
@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-calendar"></i> {{trans("bookings.backend_page_header")}}
    </h1>

@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12 ">


                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/bookings/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    @can('delete bookings')
                                        <th width="20">
                                            <div class="checkbox checkbox-single margin-none">
                                                <input id="checkAll" data-toggle="check-all"
                                                       data-target="#responsive-table-body" type="checkbox">
                                                <label for="checkAll">{{trans("main.label_check_all")}}</label>
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{trans("bookings.id")}}</th>
                                    <th>{{trans("bookings.name")}}</th>
                                    <th>{{trans("bookings.nationality")}}</th>
                                    <th>{{trans("bookings.email")}}</th>
                                    <th>{{trans("bookings.type")}}</th>
                                    <th>{{trans("bookings.status")}}</th>
                                    <th>{{trans("bookings.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data)
                                    @foreach($data as $row)

                                        <tr>
                                            @can('delete bookings')
                                                <td>
                                                    <div class="checkbox checkbox-single">
                                                        <input id="checkbox_{{$row->id}}" name="items[]" type="checkbox"
                                                               value="{{$row->id}}">
                                                        <label for="checkbox_{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}} </td>
                                            <td>{{$row->nationality}} </td>
                                            <td>{{$row->email}}</td>
                                            <td>{{trans("bookings.type_option.{$row->booking_type}")}}</td>
                                            <td>
                                                <span class="label label-{{trans_choice("bookings.status_options_color",$row->status)}}">{!! trans_choice("bookings.status_options",$row->status) !!}</span>
                                            </td>
                                            <td>{!! \Carbon\Carbon::instance($row->updated_at)->diffForHumans() !!}</td>
                                            <td class="text-right">
                                                @can('show bookings')
                                                    <a href="{{url("$locale/$backend_uri/bookings/{$row->id}/show")}}"
                                                       class="btn btn-primary btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_show")}}"><i
                                                                class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('edit bookings settings')
                                                    <a href="{{url("$locale/$backend_uri/bookings/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete bookings')
                                                    <a href="{{url("$locale/$backend_uri/bookings/{$row->id}/delete")}}"
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
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/bookings' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop