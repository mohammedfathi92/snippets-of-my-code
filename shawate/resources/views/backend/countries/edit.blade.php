<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <div class="page-title">
        <h1><i class="fa fa-map"></i> {{trans("countries.backend_page_update_header")}}</h1> <br>
    </div>
    <div class="panel pale-default">
        <div class="panel-body">
            <span class="help-block">{{trans("main.prime_link")}}
                : <code>{!! Html::link("country/{$data->id}/".str_slug($data->{"name:en"}),"/country/{$data->id}/".str_slug($data->{"name:en"})) !!}</code></span>
            <hr>
            <span class="help-block">{{trans("main.prime_link")}}
                : <code>{!! Html::link("country/{$data->id}/".str_slug($data->{"name:en"})."/guide","/country/{$data->id}/".str_slug($data->{"name:en"})."/guide") !!}</code></span>
        </div>
    </div>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="content">
                @if($errors->count())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                    {!! Form::open(['class'=>'form-horizontal','method'=>'put','name'=>'form','novalidate']) !!}

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
                                        <label for="name_{{$localeCode}}"
                                               class="col-sm-3 control-label">{{trans("countries.label_name")}}
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                                   id="name_{{$localeCode}}"
                                                   placeholder=""
                                                   value="{{old("name.$localeCode",$data->{"name:$localeCode"})}}">
                                            @if ($errors->has("name.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}}">
                                        <label for="description_{{$localeCode}}"
                                               class="col-sm-3 control-label">{{trans("countries.label_description")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea name="description[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="description_{{$localeCode}}"
                                                      placeholder="">{{old("name.$localeCode",$data->{"description:$localeCode"}) }}</textarea>
                                            @if ($errors->has("description.$localeCode"))
                                                <span class=" help-block">
                                            <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("guide.$localeCode")?:"has-error"}}">
                                        <label for="guide"
                                               class="col-sm-3 control-label">{{trans("countries.label_guide")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="guide[{{$localeCode}}]"
                                                      class="form-control ckeditor" rows="10" cols="50"
                                                      id="guide" placeholder=""
                                            >{{old("guide.$localeCode",$data->{"guide:$localeCode"})}}</textarea>
                                            @if ($errors->has("guide.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("guide.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("notes.$localeCode")?:"has-error"}}">
                                        <label for="notes"
                                               class="col-sm-3 control-label">{{trans("countries.label_notes")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="notes[{{$localeCode}}]"
                                                      class="form-control ckeditor" rows="10" cols="50"
                                                      id="notes" placeholder=""
                                            >{{old("notes.$localeCode",$data->{"notes:$localeCode"})}}</textarea>
                                            @if ($errors->has("notes.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("notes.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("meta_keywords.$localeCode")?:"has-error"}}">
                                        <label for="meta_keywords_{{$localeCode}}"
                                               class="col-sm-3 control-label">{{trans("countries.label_meta_keywords")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="meta_keywords[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_keywords_{{$localeCode}}" placeholder=""
                                            >{{old("meta_keywords.$localeCode",$data->{"meta_keywords:$localeCode"})}}</textarea>
                                            @if ($errors->has("meta_keywords.$localeCode"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{!$errors->has("meta_description.$localeCode")?:"has-error"}}">
                                        <label for="meta_description_{{$localeCode}}"
                                               class="col-sm-3 control-label">{{trans("countries.label_meta_description")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="meta_description[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_description_{{$localeCode}}" placeholder=""
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
                        <div class="form-group {{$errors->has("embed_video")?"has-error":''}}">
                            <label for="embed_video"
                                   class="control-label col-sm-3">{{trans("countries.label_embed_video")}}

                            </label>

                            <div class="col-sm-3">
                                <textarea name="embed_video" class="form-control" id="embed_video" cols="50" rows="5"
                                          placeholder="">{{old("embed_video",$data->embed_video)}} </textarea>
                                @if ($errors->has('embed_video'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('embed_video') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="map"
                                   class="control-label col-md-3">{{trans("countries.label_map")}}</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" name="map"
                                           value="{{old("map",$data->map)}}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group {{$errors->has("flag")?"has-error":''}}"
                             data-ng-controller="backendUploaderCtrl"
                             data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                             data-resize="50,50"
                             data-prefix="flag_"
                        >

                            <label for="flag"
                                   class="control-label col-sm-3">{{trans("countries.label_flag")}}
                            </label>

                            <div class="col-sm-9">

                                <div class="col-md-3 col-xs-6">

                                    <div class="clearfix"></div>

                                    <a id="flag"
                                       class="btn btn-default form-control btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="flag"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'image/*'"
                                       ngf-max-size="10MB">
                                        <i class="site-menu-icon md-cloud-upload"></i> {{trans("main.btn_upload")}}
                                    </a>

                                </div>
                                <span class="help-block">
                                    {{trans("countries.code_input_help")}}
                                </span>
                                @if ($errors->has('flag'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('flag') }}</strong>
                            </span>
                                @endif
                                <div class="clearfix"></div>
                                <div class="col-md-5">
                                    @if($data->flag && Storage::disk('public')->exists(config('settings.upload_dir')."/".$data->flag))
                                        <div class="col-md-4 col-xs-2 " id="file-{{$data->flag}}">
                                            <div class="panel">
                                                <img src="/files/small/{{$data->flag}}"
                                                     class="img-thumbnail">
                                                <a href="javascript:;" class="btn btn-danger"
                                                   ng-click="removeByName('{{$data->flag}}')"
                                                >{{trans("main.btn_delete")}}</a>
                                            </div>

                                        </div>
                                    @endif

                                    <div ng-repeat="f in photos">
                                        <div class="">
                                            <img ng-show="form.flag.$valid" ngf-thumbnail="f"
                                                 class="thumbnail img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removePhoto($index)"
                                               ng-show="flag">{{trans("main.btn_delete")}}</a>
                                            <br>
                                            <i ng-show="f.$error.required">*required</i>
                                            <i ng-show="f.$error.maxSize">File too large
                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                            <input type="hidden" name="flag" value="<%f.result.file%>"
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
                        <div class="form-group {{$errors->has("photo")?"has-error":''}}"
                             data-ng-controller="backendUploaderCtrl"
                             data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                             data-resize="250,180"
                             data-prefix="photo_"
                        >

                            <label for="photo"
                                   class="control-label col-sm-3">{{trans("countries.label_photo")}}
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
                                    @if($data->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$data->photo))
                                        <div class="" id="file-{{$data->photo}}">
                                            <div class="panel">
                                                <input type="hidden" name="old_photo" value="{{$data->photo}}">
                                                <img src="/files/small/{{$data->photo}}"
                                                     class="img-thumbnail">
                                                <a href="javascript:;" class="btn btn-danger"
                                                   ng-click="removeByName('{{$data->photo}}')"
                                                >{{trans("main.btn_delete")}}</a>
                                            </div>

                                        </div>
                                    @endif

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
                                   class="control-label col-sm-3">{{trans("countries.label_gallery")}}
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
                                    @if($data->gallery->count())
                                        @foreach($data->gallery as $img)
                                            <div class="col-md-4 col-xs-2 " id="file-{{$img->name}}">
                                                <div class="panel">
                                                    <img src="/files/small/{{$img->name}}"
                                                         class="img-thumbnail">
                                                    <a href="javascript:;" class="btn btn-danger"
                                                       ng-click="removeByName('{{$img->name}}')"
                                                    >{{trans("main.btn_delete")}}</a>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                    <div ng-repeat="f in photos">
                                        <div class="col-md-4 col-xs-2">
                                            <img ng-show="form.gallery.$valid" ngf-thumbnail="f"
                                                 class="thumbnail img-thumbnail">
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
                        <div class="form-group {{$errors->has("status")?"has-error":''}}">
                            <label for="in_home" class="label-control col-md-3">
                                {{trans("countries.label_status")}}
                            </label>
                            <div class="col-md-9">
                                <input type="checkbox" name="status" id="status" class="toggle-checkbox"
                                       placeholder=""
                                       value="1" {{!old("status",$data->status)?:"checked"}}>
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
                                        class="btn btn-primary">{{trans("main.btn_update")}}</button>
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
