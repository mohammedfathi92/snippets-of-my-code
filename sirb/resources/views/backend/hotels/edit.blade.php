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
        <i class="fa fa-h-square"></i> {{trans("hotels.backend_page_update_header")}} ({{$data->name}})</h1>
    <div class="panel pale-default">
        <div class="panel-body"><span
                    class="help-block">{!! Html::link("hotels/{$data->id}/".make_slug($data->name)) !!}</span>
        </div>
    </div>
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
                                           class="col-sm-3 control-label">{{trans("hotels.label_name")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                               id="name"
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
                                    <label for="description"
                                           class=" control-label">{{trans("hotels.label_description")}}
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
                                    <label for="meta_keywords"
                                           class=" control-label">{{trans("hotels.label_notes")}}
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
                                           class="col-sm-3 control-label">{{trans("hotels.label_meta_keywords")}}
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
                                           class="col-sm-3 control-label">{{trans("hotels.label_meta_description")}}
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
                    <div data-ng-controller="countryCitiesCtrl">
                        <div class="form-group {{$errors->has("country")?"has-error":''}}">
                            <label for="country"
                                   class="control-label col-sm-3">{{trans("hotels.label_country")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select name="country" id="country" class=" form-control select2"
                                        data-ng-model="country"
                                        data-ng-init="country='{{old("country",$data->country_id)}}'">
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
                        <div class="form-group {{$errors->has("city")?"has-error":''}}">
                            <label for="city"
                                   class="control-label col-sm-3">{{trans("hotels.label_city")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select name="city" id="city" data-ng-model="city" class=" form-control"
                                        data-ng-init="city='{{old('city',$data->city_id)}}'"
                                        data-ng-disabled="!citiesList.length">
                                    <option value=""></option>
                                    <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                            @if(old('city',$data->city_id)=="<%city.id%>") selected @endif><%city.name%>
                                    </option>
                                </select>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("address")?"has-error":''}}">
                            <label for="address" class="control-label col-sm-3">{{trans("hotels.label_address")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="address" data-ng-model="address" class="form-control"
                                       value="{{old("address",$data->address)}}"
                                       data-ng-init="address='{{old('address',$data->address)}}'">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("map")?"has-error":''}}">
                            <label for="map" class="control-label col-sm-3">{{trans("hotels.label_map")}}

                            </label>

                            <div class="col-sm-9">
                                <input type="text" name="map" class="form-control" value="{{old("map",$data->map)}}">
                                @if ($errors->has('map'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('map') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("embed_video")?"has-error":''}}">
                            <label for="embed_video" class="label-control col-md-3">
                                {{trans("cities.label_embed_video")}}
                            </label>
                            <div class="col-md-9">
                                 <textarea name="embed_video" id="embed_video" class="form-control" rows="5"
                                           placeholder="Embed code"
                                 >{{old("embed_video",$data->embed_video)}}</textarea>
                            </div>
                            @if ($errors->has('embed_video'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('embed_video') }}</strong>
                                        </span>
                            @endif

                        </div>
                    </div>
                    <hr>
                    <div class="form-group {{$errors->has("stars")?"has-error":''}}">
                        <label for="stars"
                               class="control-label col-sm-3">{{trans("hotels.label_stars")}}

                        </label>

                        <div class="col-sm-3">
                            <select name="stars" id="stars" class="form-control select2">
                                <option value="1" {{old("stars",$data->stars)==1?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",1)}}</option>
                                <option value="2" {{old("stars",$data->stars)==2?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",2)}}</option>
                                <option value="3" {{old("stars",$data->stars)==3?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",3)}}</option>
                                <option value="4" {{old("stars",$data->stars)==4?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",4)}}</option>
                                <option value="5" {{old("stars",$data->stars)==5?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",5)}}</option>
                                <option value="6" {{old("stars",$data->stars)==6?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",6)}}</option>
                                <option value="7" {{old("stars",$data->stars)==7?"selected":""}}>{{trans_choice("hotels.hotel_stars_option",7)}}</option>
                            </select>
                            @if ($errors->has('stars'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('stars') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("price")?"has-error":''}}">
                        <label for="price"
                               class="control-label col-sm-3">{{trans("hotels.label_price")}}

                        </label>

                        <div class="col-sm-3">
                            <input type="number" name="price" class="form-control" id="price"
                                   placeholder="" value="{{old("price",$data->price)}}">
                            @if ($errors->has('price'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("offer_price")?"has-error":''}}">
                        <label for="price" class="control-label col-sm-3">
                            {{trans("hotels.label_offer_price")}}
                        </label>

                        <div class="col-sm-3">
                            <input type="number" name="offer_price" class="form-control" id="offer_price"
                                   placeholder="" value="{{old("offer_price",$data->offer_price)}}">
                            @if ($errors->has('offer_price'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('offer_price') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("season_price")?"has-error":''}}">
                        <label for="season_price"
                               class="control-label col-sm-3">
                            {{trans("hotels.label_season_price")}}

                        </label>

                        <div class="col-sm-3">
                            <input type="number" name="season_price" class="form-control" id="season_price"
                                   placeholder="" value="{{old("season_price",$data->season_price)}}">
                            @if ($errors->has('season_price'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('season_price') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-group {{$errors->has("in_home")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("hotels.label_in_home")}}
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
                    <div class="form-group {{$errors->has("in_country")?"has-error":''}}">
                        <label for="in_country" class="label-control col-md-3">
                            {{trans("hotels.label_in_country")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="in_country" id="in_country" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{old("in_country",$data->in_country)?"checked":""}}>
                        </div>
                        @if ($errors->has('in_country'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('in_country') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("hotels.label_status")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="status" id="status" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{old("status",$data->status)?"checked":""}}>
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
            <div class="panel panel-success">
                <div class="panel-heading text-center">{{trans("hotels.label_services")}} </div>
                <div class="panel-body">
                    @php $services=[];
                    $data_services=$data->services();

                    if($data_services->count()){
                    foreach($data_services->get() as $s):
                         $services[]=$s->id;
                    endforeach;
                    }
                    @endphp
                    <select name="services[]" multiple id="services" class="select2 form-control">

                        @foreach(\Sirb\HotelService::all() as $service)
                            <option value="{{$service->id}}" {{!(in_array(old("services.$loop->index",$service->id),$services))?:"selected" }}>{{$service->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("hotels.label_photo")}} <span
                            class="text-danger">*</span></div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("photo")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="hotel_"
                    >

                        <div class="">
                            <div class="">
                                <div class="thumbnail" id="file-{{$data->photo}}">
                                    <img class=" img-thumbnail" src="{{url("/files/small/$data->photo")}}">
                                    <input type="hidden" name="photo" value="{{$data->photo}}">
                                    <a href="javascript:;" class="btn btn-danger"
                                       ng-click="removeByName('{{$data->name}}')"
                                    >{{trans("main.btn_delete")}}</a>
                                </div>
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
                <div class="panel-heading text-center">{{trans("hotels.label_gallery")}}</div>
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