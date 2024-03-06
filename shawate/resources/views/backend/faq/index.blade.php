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
        <i class="fa fa-question-circle-o"></i> {{trans("faq.backend_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri.'/faq/create')}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>
    <div class="panel pale-default">
        <div class="panel-body"><span
                    class="help-block">{{trans("main.prime_link")}}
                : <code>{!! Html::link("faq","/faq") !!}</code> </span>
        </div>
    </div>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-md-12 ">

                <div class="panel panel-default">
                    <div class="panel-body buttons-spacing-vertical">
                        <p>
                            @can('create faq')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/faq/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan

                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/faq/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    <th>{{trans("faq.id")}}</th>
                                    <th>{{trans("faq.name")}}</th>
                                    <th>{{trans('faq.questions')}}</th>
                                    <th>{{trans('faq.type')}}</th>
                                    <th>{{trans("faq.status")}}</th>
                                    <th>{{trans("faq.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data->count())
                                    @foreach($data as $row)

                                        <tr>

                                            <td>{{$row->id}}</td>
                                            <td>{{Html::link("faq/{$row->slug}",$row->name)}}</td>
                                            <td>{!! Html::link("$locale/$backend_uri/faq/$row->id/questions",trans("faq.questions_count",['count'=>$row->questions()->count()])) !!}</td>
                                            <td>{{$row->type?trans("faq.type_options.$row->type"):"--"}}</td>
                                            <td class="text-center">{!! $row->status?'<span class="label label-success">'.trans("faq.status_active").'</span>':'<span class="label label-danger">'.trans("faq.status_inactive").'</span>' !!}</td>
                                            <td>{!! \Carbon\Carbon::instance($row->updated_at)->diffForHumans() !!}</td>
                                            <td class="text-right">
                                                @can('edit faq')
                                                    <a href="{{url("$locale/$backend_uri/faq/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete faq')
                                                    <a href="{{url("$locale/$backend_uri/faq/{$row->id}/delete")}}"
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
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/faq' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop