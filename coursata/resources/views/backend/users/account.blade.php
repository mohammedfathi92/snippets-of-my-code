<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/10/16
 * Time: 12:56 PM
 */
?>
@extends('backend.layouts.master')

@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-group"></i>{{trans("users.backend_update_page_header")}}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('flash::message')
        {!! Form::open(['method'=>'PUT','files'=>true]) !!}

        <div class="row">

            <div class="col-md-8">

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group {{$errors->has('firstName')?"has-error":''}}">
                            <label for="first_name"
                                   class="col-sm-3 control-label">{{trans("users.label_first_name")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="firstName" class="form-control" id="first_name"
                                       placeholder="" value="{{old('firstName',$data->first_name)}}">
                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('lastName')?"has-error":''}}">
                            <label for="first_name"
                                   class="col-sm-3 control-label">{{trans("users.label_last_name")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="lastName" class="form-control" id="first_name"
                                       placeholder="" value="{{old('lastName',$data->last_name)}}">
                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('name')?"has-error":''}}">
                            <label for="first_name"
                                   class="col-sm-3 control-label">{{trans("users.label_show_name")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="first_name"
                                       placeholder="" value="{{old('name',$data->name)}}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('email')?"has-error":''}}">
                            <label for="email" class="col-sm-3 control-label">{{trans("users.label_email")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="" value="{{old('email',$data->email)}}">
                                </div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password')?"has-error":''}}">
                            <label for="password"
                                   class="col-sm-3 control-label"> {{trans("users.label_password")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="password" name="password" type="password"
                                           value="{{old('password')}}"
                                           class="form-control" placeholder="{{trans("users.label_password")}}">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password_confirmation')?"has-error":''}}">
                            <label for="password_confirmation"
                                   class="col-sm-3 control-label"> {{trans("users.label_password_confirmation")}}
                                <span
                                        class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="password_confirmation" name="password_confirmation"
                                           type="password"
                                           value="{{old('password_confirmation')}}" class="form-control"
                                           placeholder="{{trans("users.label_password_confirmation")}}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group {{$errors->has('gender')?"has-error":''}}">
                            <label for="gender" class="col-sm-3 control-label">{{trans("users.label_gender")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="m">{{trans("users.option_gender_male")}}</option>
                                    <option value="f">{{trans("users.option_gender_female")}}</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <div class="col-md-4">
                <!-- ### IMAGE ### -->
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">{{trans("users.label_avatar")}} </div>
                    <div class="panel-body">
                        <div class="form-group text-center {{$errors->has("avatar")?"has-error":''}}"
                             data-ng-controller="backendUploaderCtrl"
                             data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                             data-resize="200,150"
                             data-prefix="user_"
                        >

                            <div class="">
                                <div class="">
                                    @if($data->avatar)
                                        <div class="thumbnail" id="file-{{$data->avatar}}">
                                            <img class=" img-thumbnail" src="{{url("/files/small/$data->avatar")}}">
                                            <input type="hidden" name="avatar" value="{{$data->avatar}}">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removeByName('{{$data->name}}')"
                                            >{{trans("main.btn_delete")}}</a>
                                        </div>
                                    @endif
                                    <div ng-repeat="f in photos">
                                        <div class="thumbnail">
                                            <img ng-show="form.avatar.$valid" ngf-thumbnail="f"
                                                 class=" img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removePhoto($index)"
                                               ng-show="avatar">{{trans("main.btn_delete")}}</a>
                                            <br>
                                            <i ng-show="f.$error.required">*required</i>
                                            <i ng-show="f.$error.maxSize">File too large
                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                            <input type="hidden" name="avatar" value="<%f.result.file%>"
                                                   ng-if="f && f.progress==100">
                                            <div class="progress  active" ng-show="f.progress >= 0"
                                                 ng-hide="f.progress==100"
                                                 ng-if="f">
                                                <div class="progress-bar progress-bar-success progress-bar-striped"
                                                     role="progressbar" aria-valuenow="<%f.progress%>"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100" style="width: <%f.progress%>%">
                                                    <span class="sr-only"><% f.progress %> % Complete</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <a id="avatar"
                                   class="btn btn btn-default"
                                   ngf-select="uploadPhoto($files, $invalidFiles)"
                                   ng-model="avatar"
                                   ngf-pattern="'image/*'"
                                   ngf-accept="'image/*'"
                                   ngf-max-size="10MB">
                                    <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                                </a>

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                                @endif

                            </div>
                        </div>


                    </div>
                </div>

            </div><!-- .col-md-4 -->
        </div><!-- .row -->

        <!-- PUT Method if we are editing -->
        <button type="submit"
                class="btn btn-primary pull-right"><i class="icon wb-plus-circle"></i>{{trans("main.btn_update")}}
        </button>

        {!! Form::close() !!}

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="/{{$locale."/".$backend_uri}}/upload" target="form_target" method="post"
              enctype="multipart/form-data"
              style="width:0px;height:0;overflow:hidden">
            <input name="avatar" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="users">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div><!-- .container-fluid -->
@stop

