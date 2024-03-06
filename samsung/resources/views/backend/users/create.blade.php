<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 3/26/16
 * Time: 4:56 AM
 */
?>

@extends('backend.layout.master')

@section("page_header")
    <div class="content-header">
        <h1>
            posts
            <small>Add a new one</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> {{trans('main.link_dashboard')}}</a></li>
            <li><a href="{{url('admin/users')}}">{{trans('users.link_users')}}</a></li>
            <li class="active">{{trans("users.title_create_user")}}</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans("users.title_create_user")}}

                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['class'=>'form-horizontal']) !!}
                    <div class="col-md-2">

                        <img src="{{asset('backend/dist/img/default-avatar.jpg')}}"
                             class="img-responsive img-rounded" style="width: 160px;height: 160px;">
                        <span>Change</span> : <input type="file" name="avatar">
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3">{{trans("users.label_name")}}</label>
                            <div class="col-md-9">
                                {!! Form::text("name",old("name"),['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-3">{{trans("users.label_email")}}</label>
                            <div class="col-md-9">
                                {!! Form::email("email",old("email"),['class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updated"
                                   class="control-label col-md-3">{{trans("users.label_password")}}</label>
                            <div class="col-md-9">
                                {!! Form::password("password",['class'=>'form-control']) !!}
                                <span class="help-block">{{trans("users.hint_leave_password_blank")}}</span>
                            </div>
                        </div>

                        <div class="form-group">

                            {!! Form::submit(trans("main.btn_save"),['class'=>' pull-right btn btn-primary']) !!}


                        </div>
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
