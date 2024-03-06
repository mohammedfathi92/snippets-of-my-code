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
        <i class="fa fa-dedent"></i> {{trans("articles.backend_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri.'/articles/create')}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>
    <div class="panel pale-default">
        <div class="panel-body"><span
                    class="help-block">@if(isset($category)) {!! Html::link("guide/$category->id/".str_slug($category->name)) !!} @endif</span>
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
                            @can('create articles')
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/articles/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            @endcan
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/articles/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>

                                    <th>{{trans("articles.id")}}</th>
                                    <th>{{trans("articles.photo")}}</th>
                                    <th>{{trans("articles.name")}}</th>
                                    <th>{{trans("articles.category")}}</th>
                                    <th>{{trans("tabs.tabs")}}</th>
                                    <th>{{trans("articles.status")}}</th>
                                    <th>{{trans("articles.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data=\App\Article::all())
                                    @foreach($data as $row)

                                        <tr>

                                            <td>{{$row->id}}</td>
                                            <td>
                                                @if($row->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$row->photo))
                                                    <img src="{{url("files/small/$row->photo")}}" alt="{{$row->name}}"
                                                         style="width: 50px">
                                                @endif
                                            </td>
                                            <td>{{$row->name}}</td>
                                            <td>{!! Html::link("$backend_uri/categories/$row->category_id/articles",$row->category->name) !!}</td>
                                            <td>{{$row->tabs()->count()?Html::link("$locale/$backend_uri/articles/$row->id/tabs",trans('tabs.count_tabs',['count'=>$row->tabs()->count()]),['class'=>'btn btn-success']):Html::link("$locale/$backend_uri/articles/$row->id/tabs/create",trans('tabs.btn_add_tab'),['class'=>'btn btn-primary'])}}</td>
                                            <td>{!! $row->status?'<span class="label label-success">'.trans("articles.status_active").'</span>':'<span class="label label-danger">'.trans("articles.status_inactive").'</span>' !!}</td>
                                            <td>{!! \Carbon\Carbon::instance($row->updated_at)->diffForHumans() !!}</td>
                                            <td class="text-right">
                                                @can('edit articles')
                                                    <a href="{{url("$locale/$backend_uri/articles/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete articles')
                                                    <a href="{{url("$locale/$backend_uri/articles/{$row->id}/delete")}}"
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

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/articles' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop