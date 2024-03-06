<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-h-square"></i> {{trans("testimonials.backend_page_update_header")}} </h1>
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
        {!! Form::open(['class'=>'form-horizontal','name'=>'form','novalidate','method'=>'put']) !!}
        <div class="col-md-8">

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
                                <div class="form-group {{!$errors->has("title.$localeCode")?:"has-error"}} ">
                                    <label for="name"
                                           class="col-sm-3 control-label">{{trans("testimonials.label_title")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title[{{$localeCode}}]" class="form-control"
                                               id="name"
                                               placeholder=""
                                               value="{{old("title.$localeCode",$data->{"title:$localeCode"})}}">
                                        @if ($errors->has("name.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("title.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("visitor_name.$localeCode")?:"has-error"}} ">
                                    <label for="name"
                                           class="col-sm-3 control-label">{{trans("testimonials.label_visitor_name")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="visitor_name[{{$localeCode}}]" class="form-control"
                                               id="name"
                                               placeholder=""
                                               value="{{old("visitor_name.$localeCode",$data->{"visitor_name:$localeCode"})}}">
                                        @if ($errors->has("name.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("visitor_name.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("nationality.$localeCode")?:"has-error"}} ">
                                    <label for="name"
                                           class="col-sm-3 control-label">{{trans("testimonials.label_nationality")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nationality[{{$localeCode}}]" class="form-control"
                                               id="nationality"
                                               placeholder=""
                                               value="{{old("nationality.$localeCode",$data->{"nationality:$localeCode"})}}">
                                        @if ($errors->has("name.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("nationality.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}}">
                                    <label for="description"
                                           class=" control-label">{{trans("testimonials.label_description")}}
                                    </label>
                                    <div class="">
                                            <textarea type="text" name="description[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="description" placeholder=""
                                            >{{old("description.$localeCode",$data->{"description:$localeCode"})}}</textarea>
                                        @if ($errors->has("description.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("meta_keywords.$localeCode")?:"has-error"}}">
                                    <label for="meta_keywords"
                                           class="col-sm-3 control-label">{{trans("testimonials.label_meta_keywords")}}
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="meta_keywords[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_keywords" placeholder=""
                                            >{{old("meta_keywords.$localeCode",$data->{"meta_keywords:$localeCode"})}}</textarea>
                                        @if ($errors->has("meta_keywords.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("meta_keywords.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("meta_description.$localeCode")?:"has-error"}}">
                                    <label for="meta_description"
                                           class="col-sm-3 control-label">{{trans("testimonials.label_meta_description")}}
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="meta_description[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_description" placeholder=""
                                            >{{old("meta_description.$localeCode",$data->{"meta_description:$localeCode"})}}</textarea>
                                        @if ($errors->has("meta_description.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("meta_description.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <hr>

                    <div class="form-group {{$errors->has("country")?"has-error":''}}">
                        <label for="country"
                               class="control-label col-sm-3">{{trans("testimonials.label_country")}}
                            <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <select name="country" id="country" class=" form-control select2">
                                <option value=""></option>
                                @if($countries)
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{old("country",$data->country_id)==$country->id?"selected":""}} >{{$country->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('country'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("type")?"has-error":''}}">
                        <label for="type"
                               class="control-label col-sm-3">{{trans("testimonials.label_type")}}
                            <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <select name="type" id="type" class=" form-control select2"
                                    data-ng-model="type"
                                    data-ng-init="type='{{old("type",$data->type)}}'">
                                <option value="text" {{old("type","text")=="text"?"selected":""}} >{{trans("testimonials.type_option.text")}}</option>
                                <option value="video" {{old("type")=="video"?"selected":""}} >{{trans("testimonials.type_option.video")}}</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("trip_type")?"has-error":''}}">
                        <label for="trip_type"
                               class="control-label col-sm-3">{{trans("testimonials.label_trip_type")}}
                        </label>

                        <div class="col-sm-9">
                            <select name="trip_type" id="trip_type" class=" form-control select2"
                                    data-ng-model="trip_type"
                                    data-ng-init="trip_type='{{old("trip_type",1)}}'">
                                <options value=""></options>
                                <option value="1" {{old("trip_type",1)==1?"selected":""}}>{{trans_choice("testimonials.trip_type_options",1)}}</option>
                                <option value="2" {{old("trip_type",2)==2?"selected":""}}>{{trans_choice("testimonials.trip_type_options",2)}}</option>
                                <option value="3" {{old("trip_type",3)==3?"selected":""}}>{{trans_choice("testimonials.trip_type_options",3)}}</option>
                                <option value="4" {{old("trip_type",4)==4?"selected":""}}>{{trans_choice("testimonials.trip_type_options",4)}}</option>
                                <option value="5" {{old("trip_type",5)==5?"selected":""}}>{{trans_choice("testimonials.trip_type_options",5)}}</option>
                            </select>
                            @if ($errors->has('trip_type'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('trip_type') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has("in_home")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("testimonials.label_in_home")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="in_home" id="in_home"
                                   class="toggle-checkbox"
                                   placeholder=""

                                   value="1" {{!old("in_home",$data->in_home)?:"checked"}}>
                        </div>
                        @if ($errors->has('in_home'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('in_home') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("testimonials.label_status")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="status" id="status" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{!old("status",1)?:"checked"}}>
                        </div>
                        @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif

                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="panel panel-danger" data-ng-if="type=='video'">
                <div class="panel-heading text-center">{{trans("testimonials.label_video_url")}} </div>
                <div class="panel-body">
                    <input type="text" class="form-control" name="video_url"
                           value="{{old("video_url",$data->video_url)}}"
                           placeholder="{{trans("testimonials.holder_video_url")}}">
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("testimonials.label_avatar")}}</div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("avatar")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="testimonial_avatar_"
                    >

                        <div class="">
                            <div class="">
                                @if($data->avatar)
                                    <div class="thumbnail" id="file-{{$data->avatar}}">
                                        <img class=" img-thumbnail" src="{{url("/files/small/$data->avatar")}}">
                                        <input type="hidden" name="avatar" value="{{$data->avatar}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{$data->avatar}}')"
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
                            <a id="photo"
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
            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("testimonials.label_gallery")}}</div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("gallery")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="gallery_"
                    >
                        <div class="">
                            <a id="gallery"
                               class="btn btn-default"
                               ngf-select="uploadPhoto($files, $invalidFiles)"
                               ng-model="gallery"
                               ngf-pattern="'image/*'"
                               ngf-accept="'image/*'"
                               ngf-max-size="10MB"
                               ngf-keep="true"
                               ngf-multiple="true"
                            >
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>
                            @if ($errors->has('gallery'))
                                <span class="help-block">
                                <strong>{{ $errors->first('gallery') }}</strong>
                            </span>
                            @endif
                            <div class="clearfix"></div>
                            <div class="">

                                <div ng-repeat="f in photos">
                                    <div class="thumbnail">
                                        <img ng-show="form.gallery.$valid" ngf-thumbnail="f"
                                             class=" img-thumbnail">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removePhoto($index)"
                                           ng-show="gallery">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="gallery[]" value="<%f.result.file%>"
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

                                @if($data->gallery->count())
                                    @foreach($data->gallery as $img)
                                        <div class="thumbnail" id="file-{{$img->name}}">
                                            <img class=" img-thumbnail" src="{{url("/files/small/$img->name")}}">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removeByName('{{$img->name}}')"
                                            >{{trans("main.btn_delete")}}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
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
