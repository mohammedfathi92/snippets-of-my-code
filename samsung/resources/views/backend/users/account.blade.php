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
            Users
            <small>Update Account</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> {{trans('main.link_dashboard')}}</a></li>

            <li class="active">Update Account</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Update Your Account</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    {!! Form::open(['class'=>'form-horizontal','name'=>'form','files'=>true]) !!}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3"> Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{old("name",$data->name)}}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('email')?"has-error":""}}">
                            <label for="name" class="control-label col-md-3"> Email:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email" value="{{old("name",$data->email)}}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3"> New Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label col-md-3"> Confirm Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>
                        <div class="pull-right">
                            {!! Form::submit(trans("main.btn_save"),['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" ng-controller="updateAvatarCtrl as fCtrl">
                            {!! Form::label("photo","Profile Photo",['class'=>'label-control col-md-3']) !!}
                            <div class="">
                                @if($data->photo)

                                    <div class="row">
                                        <a href="javascript:;" data-ng-click="delete('{{$data->photo}}',$event)"
                                           class="">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <input type="hidden" name="old_photo" value="{{$data->photo}}">
                                        <a href="{{asset($data->photo)}}"
                                           target="_blank">
                                            <img src="{{asset(config('settings.upload_path')."/small/".$data->photo)}}"
                                                 alt=""
                                                 class="thumbnail img-rounded img-responsive img-lg">
                                        </a>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-9 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>

                                    <a href="javascript:;"
                                       class="btn btn-default form-control btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="photo"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'image/*'"
                                       ngf-max-size="10MB" ngf-min-height="100"
                                    ><i class="fa fa-upload"></i> Select</a>

                                </div>
                                @if($data->avatar)
                                <div class="thumbnail">
                                    <img src="/{{config("settings.upload_path")."/".$data->avatar}}" alt="">
                                </div>
                                @endif
                                <br/>

                                <div ng-repeat="f in photos" style="font:smaller">
                                    <div class="col-md-3">
                                        <img ng-show="form.file.$valid" ngf-thumbnail="f"
                                             class="thumbnail img-thumbnail">
                                        <a href="javascript:;" class="btn btn-danger" ng-click="removePhoto($index)"
                                           ng-show="photo">Remove</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="photo" value="<%f.result.file%>"
                                               ng-if="f && f.progress==100">
                                        <div class="progress  active" ng-show="f.progress >= 0"
                                             ng-if="f">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                 role="progressbar" aria-valuenow="<%f.progress%>" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: <%f.progress%>%">
                                                <span class="sr-only"><% f.progress %> % Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- nav-tabs-custom -->




                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

@stop
@section("scripts")
    <script>
        $('.colorpicker-component').colorpicker();
    </script>
@stop
