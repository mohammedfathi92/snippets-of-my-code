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
        <i class="icon icon-mail"></i> {{trans("messages.backend_page_header")}}
    </h1>
    <div class="panel pale-default">
        <div class="panel-body"><span
                    class="help-block">{!! Html::link("contact-us","/contact-us") !!}</span>
        </div>
    </div>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-md-12 ">
                @can('edit messages settings')
                    <div class="panel panel-default">
                        <div class="panel-body buttons-spacing-vertical">
                            <p>

                                <a class="btn btn-default"
                                   href="{{url(config("settings.backend_uri")."/messages/settings")}}"><i
                                            class="icon icon-settings"></i> {{trans("messages.btn_settings")}}</a>


                                {{--<a class="btn btn-default"
                                   href="{{url(config("settings.backend_uri")."/messages/tabs")}}"><i
                                            class="fa fa-copy"></i> {{trans("messages.btn_tabs")}}</a>--}}

                            </p>
                        </div>
                    </div>
                @endcan
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/messages/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <th data-sortable="false"></th>
                                <th data-sortable="false"></th>
                                <th data-sortable="false"></th>
                                <th data-sortable="false"></th>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data)
                                    @foreach($data as $row)

                                        <tr class="{{!$row->read?"highlight":""}}">
                                            <td>{!!  Html::link("$backend_uri/messages/$row->id/show",$row->name." - $row->subject")!!} </td>
                                            <td>{!! str_limit(strip_tags($row->message),100) !!}</td>
                                            <td>{!! \Carbon\Carbon::instance($row->created_at)->diffForHumans() !!}</td>
                                            <td class="text-right">
                                                @can('delete messages')
                                                    <a href="{{url("$locale/$backend_uri/messages/{$row->id}/delete")}}"
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
@section("css")
    <style>
        tr.highlight td {
            font-weight: bold;
            background: #faf2cc;
        }
    </style>
@stop
@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/messages' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop