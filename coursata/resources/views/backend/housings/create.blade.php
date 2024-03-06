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
        <i class="fa fa-fort-awesome"></i> {{trans("housings.backend_page_create_header")}} </h1>
@stop
@section("content")
    <div class="page-content container-fluid">

        {!! Form::open(['class'=>'form-horizontal','name'=>'form','novalidate']) !!}
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
                                <div class="form-group {{!$errors->has("name.$localeCode")?:"has-error"}} ">
                                    <label for="name"
                                           class="col-sm-3 control-label">{{trans("housings.label_name")}}
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
                                           class=" control-label">{{trans("housings.label_description")}}
                                    </label>
                                    <div class="">
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
                             
                               
                            </div>
                        @endforeach

                    </div>

                    <hr>

 <div class="form-group {{$errors->has('type')?"has-error":''}}">
                            <label for="type" class="col-sm-3 control-label">{{trans("housings.label_type")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-control">
                                    <option value="student_house">{{trans("housings.option_type_student_housings")}}</option>
                                    <option value="family">{{trans("housings.option_type_family")}}</option>
                                </select>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has("beds_num")?"has-error":''}}">
                            <label for="beds_num" class="control-label col-sm-3">{{trans("housings.label_beds_num")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="number" min="1" value="1" name="beds_num" class="form-control" value="{{old("beds_num")}}">
                                @if ($errors->has('beds_num'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('beds_num') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                    <div data-ng-controller="countryCitiesCtrl">
                        <div class="form-group {{$errors->has("country")?"has-error":''}}">
                            <label for="country"
                                   class="control-label col-sm-3">{{trans("housings.label_country")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select name="country" id="country" class=" form-control select2"
                                        data-ng-model="country" data-ng-init="country='{{old("country")}}'">
                                    <option value=""></option>
                                    @if($countries)
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{old("country")==$country->id?"selected":""}} >{{$country->name}}</option>
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
                        <div class="form-group {{$errors->has("state")?"has-error":''}}">
                            <label for="state" class="control-label col-sm-3">{{trans("housings.label_state")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="state" class="form-control" value="{{old("state")}}">
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("city")?"has-error":''}}">
                            <label for="city"
                                   class="control-label col-sm-3">{{trans("housings.label_city")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select name="city" id="city" data-ng-model="city" class=" form-control"
                                        data-ng-init="city='{{old('city')}}'"
                                        data-ng-disabled="!citiesList.length">
                                    <option value=""></option>
                                    <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                            @if(old('city')=="<%city.id%>") selected @endif><%city.name%>
                                    </option>
                                </select>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group {{$errors->has("address_line1")?"has-error":''}}">
                            <label for="address_line1" class="control-label col-sm-3">{{trans("housings.label_address_line1")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="address_line1" class="form-control" value="{{old("address_line1")}}">
                                @if ($errors->has('address_line1'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('address_line1') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group {{$errors->has("address_line2")?"has-error":''}}">
                            <label for="address_line2" class="control-label col-sm-3">{{trans("housings.label_address_line2")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="address_line2" class="form-control" value="{{old("address_line2")}}">
                                @if ($errors->has('address_line2'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('address_line2') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("map")?"has-error":''}}">
                            <label for="map" class="control-label col-sm-3">{{trans("housings.label_map")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="map" class="form-control" value="{{old("map")}}">
                                @if ($errors->has('map'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('map') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                <div class="form-group {{$errors->has("phone_no1")?"has-error":''}}">
                            <label for="phone_no1" class="control-label col-sm-3">{{trans("housings.label_phone_no1")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="phone_no1" class="form-control" value="{{old("phone_no1")}}">

                                <span class="help-block">
                                            {{trans('main.phone_code_msg')}}
                                        </span>
                                @if ($errors->has('phone_no1'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('phone_no1') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group {{$errors->has("phone_no2")?"has-error":''}}">
                            <label for="phone_no2" class="control-label col-sm-3">{{trans("housings.label_phone_no2")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="phone_no2" class="form-control" value="{{old("phone_no2")}}">
                                <span class="help-block">
                                            {{trans('main.phone_code_msg')}}
                                        </span>
                                @if ($errors->has('phone_no2'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('phone_no2') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                    </div>
                   
            
                    <hr>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("housings.label_status")}}
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

            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("housings.label_photo")}} <span
                            class="text-danger">*</span></div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("photo")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="housing_"
                    >

                        <div class="">
                            <div class="">

                                <div ng-repeat="f in photos">
                                    <div class="thumbnail">
                                        <img ng-show="form.photo.$valid" ngf-thumbnail="f"
                                             class=" img-thumbnail">
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
                               ng-model="photo"
                               ngf-pattern="'image/*'"
                               ngf-accept="'image/*'"
                               ngf-max-size="10MB">
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>


                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("housings.label_gallery")}}</div>
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group margin-none">
            <div class="col-sm-offset-3 col-sm-9">
                <button href="categories.html" type="submit"
                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
