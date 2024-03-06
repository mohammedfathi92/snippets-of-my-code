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
        <i class="fa fa-question-circle-o"></i> {{trans("faqQuestions.backend_page_header")}}
        <a href="{{url("$locale/$backend_uri/faq/{$category->id}/questions/create")}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>
    <div class="panel pale-default">
        <div class="panel-body"><span
                    class="help-block">{{trans("main.prime_link")}}
                : <code>{!! Html::link("faq/{$category->slug}","/faq/{$category->slug}") !!}</code> </span>
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
                                   href="{{url(config("settings.backend_uri")."/faq/{$category->id}/questions/create")}}"><i
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
                            <div class="panel-group" id="accordion">
                                @if($data)
                                    @foreach($data as $row)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                   <h3 class="col-md-8"> <a data-toggle="collapse" data-parent="#accordion"
                                                           href="#collapse{{$loop->index}}">{{$row->question}}</a></h3>
                                                    <div class="col-md-4">
                                                        @can('edit faq')
                                                            <a href="{{url("$locale/$backend_uri/faq/{$row->category_id}/questions/{$row->id}/edit")}}"
                                                               class="btn btn-default btn-xs" data-toggle="tooltip"
                                                               data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                        class="fa fa-pencil"></i></a>
                                                        @endcan
                                                        @can('delete faq')
                                                            <a href="{{url("$locale/$backend_uri/faq/{$row->category_id}/questions/{$row->id}/delete")}}"
                                                               class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                               data-placement="top" title="{{trans("main.tooltip_delete")}}"
                                                               onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"><i
                                                                        class="fa fa-times"></i></a>
                                                        @endcan
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div id="collapse{{$loop->index}}" class="panel-collapse collapse {{$loop->index==0?"in":""}}">
                                                <div class="panel-body">{!! $row->answer !!}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
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