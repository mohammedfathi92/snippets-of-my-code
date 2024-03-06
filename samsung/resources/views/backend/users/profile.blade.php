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
            Users
            <small>User Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> {{trans('main.link_dashboard')}}</a></li>
            <li><a href="{{url('admin/users')}}">{{trans('users.link_users')}}</a></li>
            <li class="active">{{trans("users.user_profile_title",["Name"=>$data->name])}}</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans("users.user_profile_title",["Name"=>$data->name])}}
                        @if(Auth::user()->level < 2)
                            <a href="{{url('admin/users/edit/'.$data->id)}}" class=""
                               title="{{trans("main.btn_edit")}}"><i class="fa fa-edit"></i></a>
                        @endif
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-2">
                        @if($data->avatar)
                            <img src="/{{config('settings.upload_path')."/".$data->avatar}}" alt="{{$data->name}}" class="img-responsive img-rounded"
                                 style="width: 160px;height: 160px;">
                        @else
                            <img src="{{asset('backend/dist/img/default-avatar.jpg')}}" alt="{{$data->name}}"
                                 class="img-responsive img-rounded" style="width: 160px;height: 160px;">
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3">{{trans("users.label_name")}}</label>
                            <div class="col-md-9">
                                <p>{{$data->name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-3">{{trans("users.label_email")}}</label>
                            <div class="col-md-9">
                                <p>{{$data->email}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updated"
                                   class="control-label col-md-3">{{trans("users.label_last_update")}}</label>
                            <div class="col-md-9">
                                <p>{{$data->updated_at}}</p>
                            </div>
                        </div>

                    </div>
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
