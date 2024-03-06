<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 3/23/16
 * Time: 11:36 PM
 */
?>
@extends('backend.layout.master')

@section("page_header")
    <div class="content-header">
        <h1>
            Categories
            <small>Add a new one</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> {{trans('main.link_dashboard')}}</a></li>
            <li><a href="{{url('admin/categories')}}">{{trans('categories.link_categories')}}</a></li>
            <li class="active">{{trans("categories.create_new")}}</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('categories.create_new')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    {!! Form::open(['class'=>'form-horizontal','files'=>true]) !!}

                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active">
                                <a href="#" data-target="#language_ar" aria-controls="language_ar"
                                   role="tab"
                                   data-toggle="tab">{{trans('main.btn_lang_ar')}}</a>
                            </li>
                            <li role="presentation">
                                <a href="#" data-target="#language_en" aria-controls="language_en" role="tab"
                                   data-toggle="tab">{{trans('main.btn_lang_en')}}</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="language_ar">
                                {{--title--}}
                                <div class="form-group">
                                    {!! Form::label("title",trans('categories.label_title')." *",['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        {!! Form::text("title[ar]",old('title[ar]'),['class'=>'form-control','required']) !!}
                                    </div>

                                </div>
                                {{--description--}}
                                <div class="form-group">
                                    {!! Form::label("description",trans('categories.label_description'),['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        {!! Form::textarea("description[ar]",old('description'),['class'=>'form-control']) !!}
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade " id="language_en">
                                {{--title--}}
                                <div class="form-group">
                                    {!! Form::label("title",trans('categories.label_title')." *",['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        {!! Form::text("title[en]",old('title[en]'),['class'=>'form-control','required','data-ng-model'=>'title']) !!}
                                    </div>

                                </div>
                                {{--description--}}
                                <div class="form-group">
                                    {!! Form::label("description",trans('categories.label_description'),['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        {!! Form::textarea("description[en]",old('description'),['class'=>'form-control']) !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr/>
                    </div>
                    {{--<div class="form-group">
                        {!! Form::label("slug",trans('categories.label_slug')." *",['class'=>'label-control col-md-3']) !!}
                        <div class="col-md-9 col-xs-12">
                            {!! Form::text("slug",old('slug','<% title|slugify %>'),['class'=>'form-control']) !!}
                        </div>

                    </div>--}}
                    <div class="form-group">
                        {!! Form::label("product_photo",trans("products.label_photo"),['class'=>'label-control col-md-3']) !!}
                        <div class="col-md-9 col-xs-12">
                            {!! Form::file("photo",['class'=>'form-control btn btn-default']) !!}
                        </div>
                    </div>

                    <div class="pull-right">
                        {!! Form::submit(trans("main.btn_save"),['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

@stop
@section("scripts")

@stop