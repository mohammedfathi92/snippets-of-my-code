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
        <i class="fa fa-map"></i> {{trans("cities.backend_page_create_header")}} </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="content">

                <div class="panel panel-default">
                    <div class="panel-body">
                    {!! Form::open(['class'=>'form-horizontal','name'=>'form','novalidate']) !!}

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
                                    <div class="form-group {{!$errors->has("name.$localeCode")?:"has-error"}} ">
                                        <label for="name"
                                               class="col-sm-3 control-label">{{trans("cities.label_name")}}
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                                   id="name"
                                                   placeholder="" value="{{old("name.$localeCode")}}">
                                            @if ($errors->has("name.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}}">
                                        <label for="description"
                                               class="col-sm-3 control-label">{{trans("cities.label_description")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="description[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="description" placeholder=""
                                                      >{{old("description.$localeCode")}}</textarea>
                                            @if ($errors->has("description.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("meta_keywords.$localeCode")?:"has-error"}}">
                                        <label for="meta_keywords"
                                               class="col-sm-3 control-label">{{trans("cities.label_meta_keywords")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="meta_keywords[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control"
                                                      id="meta_keywords" placeholder=""
                                                      >{{old("meta_keywords.$localeCode")}}</textarea>
                                            @if ($errors->has("meta_keywords.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("meta_description.$localeCode")?:"has-error"}}">
                                        <label for="meta_description"
                                               class="col-sm-3 control-label">{{trans("cities.label_meta_description")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="meta_description[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control"
                                                      id="meta_description" placeholder=""
                                                      >{{old("meta_description.$localeCode")}}</textarea>
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
                        <div class="form-group {{$errors->has("map")?"has-error":''}}">
                            <label for="map" class="label-control col-md-3">
                                {{trans("cities.label_map")}}
                            </label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input name="map" id="map" class="form-control" value="{{old("map")}}">
                                </div>

                            </div>
                            @if ($errors->has('map'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('map') }}</strong>
                                        </span>
                            @endif

                        </div>
                        <div class="form-group {{$errors->has("embed_video")?"has-error":''}}">
                            <label for="embed_video" class="label-control col-md-3">
                                {{trans("cities.label_embed_video")}}
                            </label>
                            <div class="col-md-9">
                                <textarea name="embed_video" id="embed_video" class="form-control" rows="5"
                                          placeholder="Embed code"
                                >{{old("embed_video")}}</textarea>
                            </div>
                            @if ($errors->has('embed_video'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('embed_video') }}</strong>
                                        </span>
                            @endif

                        </div>
                        <hr>
                        <div class="form-group {{$errors->has("photo")?"has-error":''}}"
                             data-ng-controller="backendUploaderCtrl"
                             data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                             data-resize="100,100"
                             data-prefix="photo_"
                        >

                            <label for="photo"
                                   class="control-label col-sm-3">{{trans("cities.label_photo")}}
                            </label>

                            <div class="col-sm-9">

                                <div class="col-md-3 col-xs-6">

                                    <div class="clearfix"></div>

                                    <a id="photo"
                                       class="btn btn-default form-control btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="photo"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'image/*'"
                                       ngf-max-size="10MB">
                                        <i class="site-menu-icon md-cloud-upload"></i> {{trans("main.btn_upload")}}
                                    </a>

                                </div>

                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                                @endif
                                <div class="clearfix"></div>
                                <div class="col-md-5">

                                    <div ng-repeat="f in photos">
                                        <div class="">
                                            <img ng-show="form.photo.$valid" ngf-thumbnail="f"
                                                 class="thumbnail img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removePhoto($index)"
                                               ng-show="photo">{{trans("main.btn_delete")}}</a>
                                            <br>
                                            <i ng-show="f.$error.required">*required</i>
                                            <i ng-show="f.$error.maxSize">File too large
                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                            <input type="hidden" name="photo" value="<%f.result.file%>"
                                                   ng-if="f && f.progress==100">
                                            <div class="progress  active" ng-show="f.progress >= 0"
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

                            </div>
                        </div>

                        <hr>
                        <div class="form-group {{$errors->has("gallery")?"has-error":''}}"
                             data-ng-controller="backendUploaderCtrl"
                             data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                             data-resize="200,150"
                             data-prefix="gallery_"
                        >

                            <label for="flag"
                                   class="control-label col-sm-3">{{trans("cities.label_gallery")}}
                            </label>

                            <div class="col-sm-9">

                                <div class="col-md-3 col-xs-6">

                                    <div class="clearfix"></div>
                                    <a id="gallery"
                                       class="btn btn-default form-control btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="gallery"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'image/*'"
                                       ngf-max-size="10MB"
                                       ngf-keep="true"
                                       ngf-multiple="true"
                                    >
                                        <i class="site-menu-icon md-cloud-upload"></i> {{trans("main.btn_upload")}}
                                    </a>

                                </div>

                                @if ($errors->has('gallery'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('gallery') }}</strong>
                            </span>
                                @endif
                                <div class="clearfix"></div>
                                <div class="">

                                    <div ng-repeat="f in photos">
                                        <div class="col-md-4 col-xs-2">
                                            <img ng-show="form.gallery.$valid" ngf-thumbnail="f"
                                                 class="thumbnail img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removePhoto($index)"
                                               ng-show="photo">{{trans("main.btn_delete")}}</a>
                                            <br>
                                            <i ng-show="f.$error.required">*required</i>
                                            <i ng-show="f.$error.maxSize">File too large
                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                            <input type="hidden" name="gallery[]" value="<%f.result.file%>"
                                                   ng-if="f && f.progress==100">
                                            <div class="progress  active" ng-show="f.progress >= 0"
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

                            </div>
                        </div>
                        <hr>
                        <div class="form-group {{$errors->has("in_country")?"has-error":''}}">
                            <label for="in_country" class="label-control col-md-3">
                                {{trans("cities.label_in_country")}}
                            </label>
                            <div class="col-md-9">
                                <input type="checkbox" name="in_country" id="in_country" class="toggle-checkbox"
                                       placeholder=""
                                       value="1" {{!old("in_country",1)?:"checked"}}>
                            </div>
                            @if ($errors->has('in_country'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('in_country') }}</strong>
                                        </span>
                            @endif

                        </div>
                        <div class="form-group {{$errors->has("status")?"has-error":''}}">
                            <label for="status" class="label-control col-md-3">
                                {{trans("cities.label_status")}}
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
                        <div class="form-group margin-none">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button href="categories.html" type="submit"
                                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>

        </div>
        <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
