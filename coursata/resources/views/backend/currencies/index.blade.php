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
        <i class="icon icon-dollar"></i> {{trans("currencies.backend_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri.'/currencies/create')}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("currencies.btn_add_new")}}</a>
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
                            @can('create currencies')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/currencies/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan
                            @can('delete currencies')
                                <button type="submit"
                                        onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"
                                        form="tableForm" class="btn btn-danger"><i
                                            class="fa fa-times"></i> {{trans("main.btn_delete")}}</button>
                            @endcan

                            @can('edit currencies')
                                <a class="btn btn-success"
                                   href="{{url(config("settings.backend_uri")."/currencies/update_rates")}}"><i
                                            class="fa fa-refresh"></i> {{trans("currencies.btn_update_rates")}}</a>
                            @endcan
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/currencies/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle datatable">
                                <thead>
                                <tr>
                                    @can('delete currencies')
                                        <th width="20">
                                            <div class="checkbox checkbox-single margin-none">
                                                <input id="checkAll" data-toggle="check-all"
                                                       data-target="#responsive-table-body" type="checkbox">
                                                <label for="checkAll">{{trans("main.label_check_all")}}</label>
                                            </div>
                                        </th>
                                    @endcan


                                    <th>{{trans("currencies.name")}}</th>
                                    <th>{{trans("currencies.code")}}</th>
                                    <th>{{trans("currencies.value")}}</th>
                                    <th>{{trans("currencies.status")}}</th>
                                    <th>{{trans("currencies.last_update")}}</th>


                                    {{--                                    <th>{{trans("currencies.products")}}</th>--}}
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data)
                                    @foreach($data as $row)

                                        <tr>
                                            @can('delete currencies')
                                                <td>
                                                    <div class="checkbox checkbox-single">
                                                        <input id="checkbox_{{$row->id}}" name="items[]" type="checkbox"
                                                               value="{{$row->id}}">
                                                        <label for="checkbox_{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->code}}</td>
                                            <td>{{round((float)$row->value,$row->decimal_place)." ".strtoupper(config('settings.base_currency') ?: "USD")}} </td>

                                            <td>{!! $row->status?"<span class='label label-success'>".trans_choice("currencies.status_choice",$row->status)."</span>":
                                            "<span class='label label-warning'>".trans_choice("currencies.status_choice",$row->status)."</span>" !!}</td>
                                            <td>{{\Carbon\Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                            <td class="text-right">
                                                @can('edit countries')
                                                    <a href="{{url("$locale/$backend_uri/currencies/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete currencies')
                                                    <a href="{{url("$locale/$backend_uri/currencies/{$row->id}/delete")}}"
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

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/countries' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop