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
        <i class="fa fa-fort-awesome"></i> {{trans("housings.backend_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri.'/housings/create')}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>
    <div class="panel pale-default">
        <div class="panel-body"><span
                    class="help-block">{{trans("main.prime_link")}}: <code>{!! Html::link("housings","/housings") !!}</code> </span>
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
                            @can('create housings')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/housings/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/housings/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    <th>{{trans("housings.id")}}</th>
                                    <th>{{trans("housings.photo")}}</th>
                                    <th>{{trans("housings.name")}}</th>
                                    <th>{{trans("housings.country")}}</th>
                                    <th>{{trans("housings.city")}}</th>
                                    <th>{{trans("housings.status")}}</th>
                                    <th>{{trans("housings.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data=\Corsata\BookedHousing::all())
                                    @foreach($data as $row)

                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                @if($row->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$row->photo))
                                                    <img src="{{url("files/small/$row->photo")}}" alt="{{$row->name}}"
                                                         style="width: 50px">
                                                @endif
                                            </td>
                                            <td>{!! Html::link("housings/$row->id/".str_slug($row->name),$row->name) !!}</td>
                                            <td><img src="{{url("/files/small/".$row->country->flag)}}" alt=""
                                                     style="width: 16px"> {{$row->country->name}}</td>
                                            <td>{{$row->city->name}}</td>
                                            <td>{!! $row->status?'<span class="label label-success">'.trans("housings.status_active").'</span>':'<span class="label label-danger">'.trans("housings.status_inactive").'</span>' !!}</td>
                                            <td>{!! \Carbon\Carbon::instance($row->updated_at)->diffForHumans() !!}</td>
                                            <td class="text-right">
                                                @can('edit housings')
                                                    <a href="{{url("$locale/$backend_uri/housings/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete housings')
                                                    <a href="{{url("$locale/$backend_uri/housings/{$row->id}/delete")}}"
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

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/housings' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop