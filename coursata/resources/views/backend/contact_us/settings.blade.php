<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-settings"></i> {{trans("messages.backend_page_update_settings_header")}}
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        @if($errors->count())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {!! Form::open(['class'=>'form-horizontal','method'=>'put','name'=>'form','novalidate']) !!}
        <div class="content">
            <div class="panel panel-primary">
                <div class="panel-heading">{{trans("main.tab_general")}}</div>
                <div class="panel-body">


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                            <li role="presentation" class="{{$loop->index==0?"active":""}}"><a
                                        href="#lang-{{$localeCode}}"
                                        aria-controls="lang-{{$localeCode}}" role="tab"
                                        data-toggle="tab">{{ $properties['native']}}</a>
                            </li>

                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div role="tabpanel" class="tab-pane {{$loop->index==0?"active":""}}"
                                 id="lang-{{$localeCode}}">
                                <div class="form-group {{!$errors->has("info.$localeCode")?:"has-error"}}">
                                    <label for="info"
                                           class="col-sm-3 control-label">{{trans("messages.label_settings_info")}}
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="info[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="info" placeholder=""
                                            >{{old("info.$localeCode",$data->{"info:$localeCode"})}}</textarea>
                                        @if ($errors->has("info.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("info.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("sent_message.$localeCode")?:"has-error"}}">
                                    <label for="sent_message"
                                           class="col-sm-3 control-label">{{trans("messages.label_settings_sent_message")}}
                                        <span class="help-block">{!! trans("messages.label_settings_sent_message_help") !!}</span>
                                    </label>

                                    <div class="col-sm-9">
                                            <textarea type="text" name="sent_message[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="sent_message" placeholder=""
                                            >{{old("sent_message.$localeCode",$data->{"sent_success_message:$localeCode"})}}</textarea>

                                        @if ($errors->has("sent_message.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("sent_message.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="geo_location"
                               class="control-label col-md-3">{{trans("messages.label_settings_geo_location")}}</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control" name="geo_location"
                                       value="{{old("geo_location",$data->geo_location)}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="auto_reply_user"
                               class="control-label col-md-3">{{trans("messages.label_auto_reply_user")}}</label>
                        <div class="col-md-4">
                            <select name="auto_reply_user" id="auto_reply_user" class="form-control select2">
                                @foreach($users as $user)
                                    @if($user->can("reply messages"))
                                        <option value="{{$user->id}}" {{$user->id==old("auto_reply_user",$data->auto_reply_user)?"selected":""}}>{{$user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-center {{$errors->has("map_background")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="500,350"
                         data-prefix="contact_us_"
                    >
                        <label for="map_background"
                               class="col-md-3 control-label">{{trans("messages.label_settings_map_background")}}</label>
                        <div class="col-md-5">
                            <div class="">
                                @if($data->map_background)
                                    <div class="thumbnail" id="file-{{$data->map_background}}">
                                        <img class=" img-thumbnail" src="{{url("/files/small/$data->map_background")}}">
                                        <input type="hidden" name="map_background" value="{{$data->map_background}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{$data->map_background}}')"
                                        >{{trans("main.btn_delete")}}</a>
                                    </div>
                                @endif
                                <div ng-repeat="f in photos">
                                    <div class="thumbnail">
                                        <img ng-show="form.map_background.$valid" ngf-thumbnail="f"
                                             class=" img-thumbnail">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removePhoto($index)"
                                           ng-show="map_background">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <input type="hidden" name="map_background" value="<%f.result.file%>"
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
                            <a id="map_background"
                               class="btn btn btn-default"
                               ngf-select="uploadPhoto($files, $invalidFiles)"
                               ng-model="map_background"
                               ngf-pattern="'image/*'"
                               ngf-accept="'image/*'"
                               ngf-max-size="10MB">
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>

                            @if ($errors->has('map_background'))
                                <span class="help-block">
                                <strong>{{ $errors->first('map_background') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has("show_mobile")?"has-error":''}}">
                        <label for="show_mobile" class="label-control col-md-3">
                            {{trans("messages.label_show_mobile")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="show_mobile" id="show_mobile" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{!old("show_mobile",$data->show_mobile)?:"checked"}}>
                        </div>
                        @if ($errors->has('show_mobile'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('show_mobile') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("mobile_required")?"has-error":''}}">
                        <label for="mobile_required" class="label-control col-md-3">
                            {{trans("messages.label_mobile_required")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="mobile_required" id="mobile_required" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{old("mobile_required",$data->mobile_required)?"checked":""}}>
                        </div>
                        @if ($errors->has('mobile_required'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('mobile_required') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("show_country")?"has-error":''}}">
                        <label for="show_country" class="label-control col-md-3">
                            {{trans("messages.label_show_country")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="show_country" id="show_country" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{old("show_country",$data->show_country)?"checked":""}}>
                        </div>
                        @if ($errors->has('show_country'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('show_country') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("country_required")?"has-error":''}}">
                        <label for="country_required" class="label-control col-md-3">
                            {{trans("messages.label_country_required")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="country_required" id="country_required" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{old("country_required",$data->country_required)?"checked":""}}>
                        </div>
                        @if ($errors->has('country_required'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('country_required') }}</strong>
                                        </span>
                        @endif

                    </div>
                </div>
            </div>

        </div>


        <div class="form-group margin-none">
            <div class="col-sm-offset-3 col-sm-9">
                <button href="categories.html" type="submit"
                        class="btn btn-primary">{{trans("main.btn_update")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
