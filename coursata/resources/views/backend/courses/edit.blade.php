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
        <i class="fa fa-h-square"></i> {{trans("courses.backend_page_update_header")}} </h1>
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
                                <div class="form-group {{!$errors->has("name.$localeCode")?:"has-error"}} ">
                                    <label for="name"
                                           class="col-sm-3 control-label">{{trans("courses.label_name")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                               id="name"
                                               placeholder="" value="{{old("name.$localeCode",$data->{"name:$localeCode"})}}">
                                        @if ($errors->has("name.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}}">
                                    <label for="description"
                                           class=" control-label">{{trans("courses.label_description")}}
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
                                <div class="form-group {{!$errors->has("notes.$localeCode")?:"has-error"}}">
                                    <label for="notes"
                                           class="control-label">{{trans("courses.label_notes")}}
                                    </label>
                                    <div class="">
                                            <textarea type="text" name="notes[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control ckeditor"
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
                                    <label for="meta_keywords"
                                           class="col-sm-3 control-label">{{trans("courses.label_meta_keywords")}}
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
                                           class="col-sm-3 control-label">{{trans("courses.label_meta_description")}}
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
                    <div class="form-group {{$errors->has("avg_students")?"has-error":''}}">
                        <label for="avg_students"
                               class="control-label col-sm-3">{{trans("courses.label_avg_students")}}

                        </label>

                        <div class="col-sm-3">
                            <input type="number" name="avg_students" class="form-control" id="avg_students" min="1"
                                   min="1"
                                   placeholder="" value="{{old("avg_students",$data->avg_students)}}">
                            @if ($errors->has('avg_students'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('avg_students') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("max_students")?"has-error":''}}">
                        <label for="max_students"
                               class="control-label col-sm-3">{{trans("courses.label_max_students")}}

                        </label>

                        <div class="col-sm-3">
                            <input type="number" name="max_students" class="form-control" id="max_students" min="1"
                                   min="1"
                                   placeholder="" value="{{old("max_students",$data->max_students)}}">
                            @if ($errors->has('max_students'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('max_students') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("hours")?"has-error":''}}">
                        <label for="hours"
                               class="control-label col-sm-3">{{trans("courses.label_hours")}}

                        </label>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" name="hours" class="form-control" id="hours" min="1" max="10"
                                       placeholder="" value="{{old("hours",$data->hours)}}">
                                <span class="input-group-addon">{{trans("courses.text_hours_per_week")}}</span>
                            </div>
                            @if ($errors->has('hours'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('hours') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("lessons")?"has-error":''}}">
                        <label for="hours"
                               class="control-label col-sm-3">{{trans("courses.label_lessons")}}

                        </label>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" name="lessons" class="form-control" id="lessons" min="1"
                                       placeholder="" value="{{old("lessons",$data->num_lessons)}}">
                                <span class="input-group-addon">{{trans("courses.text_lessons_per_week")}}</span>
                            </div>
                            @if ($errors->has('lessons'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('lessons') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("start_day")?"has-error":''}}">
                        <label for="start_day"
                               class="control-label col-sm-3">{{trans("courses.label_start_day")}}

                        </label>

                        <div class="col-sm-4">
                            <select name="start_day" id="start_day" class="form-control">
                                <option value="mo" {{old("start_day",$data->start_day)=='mo'?"selected":""}}>{{trans("courses.week_days_options.mo")}}</option>
                                <option value="tu" {{old("start_day",$data->start_day)=='tu'?"selected":""}}>{{trans("courses.week_days_options.tu")}}</option>
                                <option value="we" {{old("start_day",$data->start_day)=='we'?"selected":""}}>{{trans("courses.week_days_options.we")}}</option>
                                <option value="th" {{old("start_day",$data->start_day)=='th'?"selected":""}}>{{trans("courses.week_days_options.th")}}</option>
                                <option value="fr" {{old("start_day",$data->start_day)=='fr'?"selected":""}}>{{trans("courses.week_days_options.fr")}}</option>
                                <option value="sa" {{old("start_day",$data->start_day)=='sa'?"selected":""}}>{{trans("courses.week_days_options.sa")}}</option>
                                <option value="su" {{old("start_day",$data->start_day)=='su'?"selected":""}}>{{trans("courses.week_days_options.su")}}</option>
                            </select>
                            @if ($errors->has('start_day'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('start_day') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("min_age")?"has-error":''}}">
                        <label for="min_age"
                               class="control-label col-sm-3">{{trans("courses.label_min_age")}}

                        </label>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" name="min_age" class="form-control" id="min_age" min="1" max="10"
                                       placeholder="" value="{{old("min_age",1)}}">
                                <span class="input-group-addon">{{trans("courses.text_years_old")}}</span>
                            </div>
                            @if ($errors->has('min_age'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('min_age') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-group {{$errors->has("currency")?"has-error":''}}">
                        <label for="currency"
                               class="control-label col-sm-3">
                            {{trans("courses.label_currency")}}

                        </label>

                        <div class="col-sm-4">
                            <select name="currency" id="currency" class="select2 form-control">
                                @foreach(\Corsata\Currency::published()->get() as $currency)
                                    <option value="{{$currency->id}}" {{old("currency",$data->currency_id)==$currency->id?"selected":""}} >{{$currency->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('currency'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('currency') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("price")?"has-error":''}}">
                        <label for="price"
                               class="control-label col-sm-3">{{trans("courses.label_price")}}

                        </label>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" name="price" class="form-control" id="price"
                                       step="0.001"
                                       min="0.0"
                                       placeholder="" value="{{old("price",$data->price)}}">
                                <span class="input-group-addon">{{trans("courses.text_price_per_week")}}</span>
                            </div>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("offer_price")?"has-error":''}}">
                        <label for="offer_price"
                               class="control-label col-sm-3">{{trans("courses.label_offer_price")}}

                        </label>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" name="offer_price" class="form-control" id="offer_price"
                                       step="0.001"
                                       min="0.0"
                                       placeholder="" value="{{old("offer_price",$data->offer_price)}}">
                                <span class="input-group-addon">{{trans("courses.text_price_per_week")}}</span>
                            </div>
                            @if ($errors->has('offer_price'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('offer_price') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-group {{$errors->has("category")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("courses.label_category")}}
                        </label>
                        <div class="col-md-9">
                            <select name="category" class="form-control" id="category">
                                @foreach(\Corsata\Category::all() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                        @endif

                    </div>

                    <div class="form-group {{$errors->has("locale_rate")?"has-error":''}}">
                        <label for="locale_rate"
                               class="control-label col-sm-3">{{trans("institutes.label_locale_rate")}}

                        </label>

                        <div class="col-sm-3">
                            <select name="locale_rate" id="locale_rate" class="form-control select2">
                                <option value="1" {{old("locale_rate",$data->locale_rate)==1?"selected":""}}>{{trans_choice("institutes.institute_stars_option",1)}}</option>
                                <option value="2" {{old("locale_rate",$data->locale_rate)==2?"selected":""}}>{{trans_choice("institutes.institute_stars_option",2)}}</option>
                                <option value="3" {{old("locale_rate",$data->locale_rate)==3?"selected":""}}>{{trans_choice("institutes.institute_stars_option",3)}}</option>
                                <option value="4" {{old("locale_rate",$data->locale_rate)==4?"selected":""}}>{{trans_choice("institutes.institute_stars_option",4)}}</option>
                                <option value="5" {{old("locale_rate",$data->locale_rate)==5?"selected":""}}>{{trans_choice("institutes.institute_stars_option",5)}}</option>
                                <option value="6" {{old("locale_rate",$data->locale_rate)==6?"selected":""}}>{{trans_choice("institutes.institute_stars_option",6)}}</option>
                                <option value="7" {{old("locale_rate",$data->locale_rate)==7?"selected":""}}>{{trans_choice("institutes.institute_stars_option",7)}}</option>
                            </select>
                            @if ($errors->has('locale_rate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('locale_rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("international_rate")?"has-error":''}}">
                        <label for="international_rate"
                               class="control-label col-sm-3">{{trans("institutes.label_international_rate")}}
                        </label>
                        <div class="col-sm-3">
                            <select name="international_rate" id="international_rate"
                                    class="form-control select2">
                                <option value="1" {{old("international_rate",$data->international_rate)==1?"selected":""}}>{{trans_choice("institutes.institute_stars_option",1)}}</option>
                                <option value="2" {{old("international_rate",$data->international_rate)==2?"selected":""}}>{{trans_choice("institutes.institute_stars_option",2)}}</option>
                                <option value="3" {{old("international_rate",$data->international_rate)==3?"selected":""}}>{{trans_choice("institutes.institute_stars_option",3)}}</option>
                                <option value="4" {{old("international_rate",$data->international_rate)==4?"selected":""}}>{{trans_choice("institutes.institute_stars_option",4)}}</option>
                                <option value="5" {{old("international_rate",$data->international_rate)==5?"selected":""}}>{{trans_choice("institutes.institute_stars_option",5)}}</option>
                                <option value="6" {{old("international_rate",$data->international_rate)==6?"selected":""}}>{{trans_choice("institutes.institute_stars_option",6)}}</option>
                                <option value="7" {{old("international_rate",$data->international_rate)==7?"selected":""}}>{{trans_choice("institutes.institute_stars_option",7)}}</option>
                            </select>
                            @if ($errors->has('international_rate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('international_rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has("featured")?"has-error":''}}">
                        <label for="featured" class="label-control col-md-3">
                            {{trans("institutes.label_featured")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="featured" id="featured" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{!old("featured",$data->featured)?:"checked"}}>
                        </div>
                        @if ($errors->has('featured'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('featured') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("in_home")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("institutes.label_in_home")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="in_home" id="in_home" class="toggle-checkbox"
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
                            {{trans("courses.label_status")}}
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

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><i
                            class="fa fa-youtube fa-2x"></i> {{trans("institutes.label_video_youtube")}} </div>
                <div class="panel-body">
                    <input type="text" name="video_youtube" id="video_youtube" class="form-control"
                           placeholder=""
                           value="{{old("video_youtube",$data->video_youtube)}}"/>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("courses.label_photo")}} <span
                            class="text-danger">*</span>
                </div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("photo")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="institute_"
                    >

                        <div class="">
                            <div class="">
                                @if($data->photo)
                                    <div class="thumbnail" id="file-{{$data->photo}}" data-ng-if="!photo">
                                        <img src="{{url("files/{$data->photo}")}}" alt=""
                                             class="responsive-img img-thumbnail">
                                        <input type="hidden" name="photo" value="{{$data->photo}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{$data->photo}}')">{{trans("main.btn_delete")}}</a>
                                    </div>
                                @endif
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
                <div class="panel-heading text-center">{{trans("courses.label_gallery")}}</div>
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
                                @if($data->gallery()->count())
                                    @foreach($data->gallery as $image)
                                        <div class="thumbnail" id="file-{{$image->name}}" data-ng-if="!photo">
                                            <img src="{{url("files/{$image->name}")}}" alt=""
                                                 class="responsive-img img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removeByName('{{$image->name}}')">{{trans("main.btn_delete")}}</a>
                                        </div>
                                    @endforeach
                                @endif
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
                        class="btn btn-primary">{{trans("main.btn_update")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
