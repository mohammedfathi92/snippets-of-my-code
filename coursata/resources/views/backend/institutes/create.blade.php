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
        <i class="icon icon-study"></i> {{trans("institutes.backend_page_create_header")}} </h1>
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
                                           class="col-sm-3 control-label">{{trans("institutes.label_name")}}
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
                                           class=" control-label">{{trans("institutes.label_description")}}
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
                                <div class="form-group {{!$errors->has("address.$localeCode")?:"has-error"}}">
                                    <label for="meta_keywords"
                                           class="col-sm-3 control-label">{{trans("institutes.label_address")}}
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address[{{$localeCode}}]"
                                               cols="50" rows="5" class="form-control"
                                               id="address" placeholder=""
                                               value="{{old("address.$localeCode")}}"/>

                                        @if ($errors->has("address.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("address.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class=" form-group {{!$errors->has("bank_account.$localeCode")?:"has-error"}}">
                                    <label for="meta_keywords"
                                           class="col-sm-3 control-label">{{trans("institutes.label_bank_account")}}
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="bank_account[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control ckeditor"
                                                      id="bank_account" placeholder=""
                                            >{{old("bank_account.$localeCode")}}</textarea>
                                        @if ($errors->has("bank_account.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("bank_account.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("meta_keywords.$localeCode")?:"has-error"}}">
                                    <label for="meta_keywords"
                                           class="col-sm-3 control-label">{{trans("institutes.label_meta_keywords")}}
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="meta_keywords[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_keywords" placeholder=""
                                            >{{old("meta_keywords.$localeCode")}}</textarea>
                                        @if ($errors->has("meta_keywords.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("meta_keywords.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("meta_description.$localeCode")?:"has-error"}}">
                                    <label for="meta_description"
                                           class="col-sm-3 control-label">{{trans("institutes.label_meta_description")}}
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="meta_description[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
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
                    <div data-ng-controller="countryCitiesCtrl">
                        <div class="form-group {{$errors->has("country")?"has-error":''}}">
                            <label for="country"
                                   class="control-label col-sm-3">{{trans("institutes.label_country")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select name="country" id="country" class=" form-control select2"
                                        data-ng-model="country" data-ng-init="country='{{old("country")}}'">
                                    <option value=""></option>
                                    @foreach(\Corsata\Region::with('countries')->get() as $region)
                                        <optgroup label="{{$region->name}}">
                                            @foreach($region->countries as $country)
                                                <option value="{{$country->id}}" {{old("country")==$country->id?"selected":""}} >{{$country->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
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
                                   class="control-label col-sm-3">{{trans("institutes.label_city")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                  <select class="form-control" name="city" id="city"
                                        data-ng-model="city"
                                        data-ng-init="city='{{old('city')}}' ">
                                    <option value="">{{trans("main.filters_select_city")}}</option>
                               
                                    <optgroup  label="<%state.name%>" data-ng-repeat="state in citiesList | where:{is_state: 1} ">

                                    <option value="<%state.id%>" style="background-color: #9bf39b" data-ng-selected="city.id=='{{old('city')}}'"> <%state.name%>
                                    </option>
                    
                                    <option data-ng-repeat="city in citiesList | where:{state_id: state.id}" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{old('city')}}'">  - <%city.name%>
                                    </option>
                                </optgroup>
                                <option data-ng-repeat="city in citiesList | where:{state_id: null}" value="<%city.id%>"
                                            data-ng-selected="city.id=='{{old('city')}}'" style="font-weight: bold;"><%city.name%>
                                    </option>
                                </select>
                               
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Map Here --> 
<hr>
              <div class="map_canvas"></div> 
                    

                    <div class="form-group {{$errors->has("map_address")?"has-error":''}}">
                        <label for="map_address" class="control-label col-md-3 col-sm-3">{{trans("institutes.label_map")}}

                        </label>

                        <div class="col-md-7 col-sm-9">
                            <input id="geocomplete" class="form-control" type="text" placeholder="Type in an address" value="{{old("map_address")}}" name="map_address" />
                           @if ($errors->has('map_address'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('map_address') }}</strong>
                                        </span>
                            @endif
                            
                        </div>
                        <div class="col-md-2">
                         <input id="find" type="button" value="find" class="btn btn-default" />
                     </div>
                    </div>


     
      

       <div class="form-group">
                        <label for="lat" class="control-label col-sm-3"> Latitude
                        </label>

                        <div class="col-sm-9">
                            <input name="lat" class="form-control" type="text" value="{{old("lat")}}" style="background-color: #d1f9ce;" readonly>
                           
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="lng" class="control-label col-sm-3"> Longitude
                        </label>

                        <div class="col-sm-9">
                            <input name="lng" class="form-control" type="text" value="{{old("lng")}}" style="background-color: #d1f9ce;" readonly>
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lng" class="control-label col-sm-3" > Formatted Address
                        </label>

                        <div class="col-sm-9">
                            <input name="formatted_address" type="text" value="{{old("formatted_address")}}" class="form-control "  style="background-color: #d1f9ce;" readonly>
                           
                        </div>
                    </div>
<hr>
              <!-- End Map inputes -->                    

              <div class="form-group {{$errors->has("email")?"has-error":''}}">
                        <label for="email" class="control-label col-sm-3">{{trans("institutes.label_email")}}

                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" value="{{old("email")}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("website")?"has-error":''}}">
                        <label for="website" class="control-label col-sm-3">{{trans("institutes.label_website")}}

                        </label>

                        <div class="col-sm-9">
                            <input type="text" name="website" class="form-control" value="{{old("website")}}">
                            @if ($errors->has('website'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('website') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("phone")?"has-error":''}}">
                        <label for="phone" class="control-label col-sm-3">{{trans("institutes.label_phone")}}

                        </label>

                        <div class="col-sm-9">
                            <textarea type="text" name="phone" class="form-control"
                                      placeholder="{{trans("institutes.holder_phone")}}">{{old("phone")}}</textarea>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-group {{$errors->has("location_type")?"has-error":''}}">
                        <label for="location_type"
                               class="control-label col-sm-3">{{trans("institutes.label_location_type")}}

                        </label>

                        <div class="col-sm-9">
                            <select name="location_type" id="location_type" class="form-control select2">
                                <option value="1" {{old("location_type")==1?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",1)}}</option>
                                <option value="2" {{old("location_type")==2?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",2)}}</option>
                                <option value="3" {{old("location_type")==3?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",3)}}</option>
                                <option value="4" {{old("location_type")==4?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",4)}}</option>
                                <option value="5" {{old("location_type")==5?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",5)}}</option>
                                <option value="6" {{old("location_type")==6?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",6)}}</option>
                                <option value="7" {{old("location_type")==7?"selected":""}}>{{trans_choice("institutes.institute_location_type_option",7)}}</option>
                            </select>
                            @if ($errors->has('location_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('location_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has("locale_rate")?"has-error":''}}">
                        <label for="locale_rate"
                               class="control-label col-sm-3">{{trans("institutes.label_locale_rate")}}

                        </label>

                        <div class="col-sm-3">
                            <select name="locale_rate" id="locale_rate" class="form-control select2">
                                <option value="1" {{old("locale_rate")==1?"selected":""}}>{{trans_choice("institutes.institute_stars_option",1)}}</option>
                                <option value="2" {{old("locale_rate")==2?"selected":""}}>{{trans_choice("institutes.institute_stars_option",2)}}</option>
                                <option value="3" {{old("locale_rate")==3?"selected":""}}>{{trans_choice("institutes.institute_stars_option",3)}}</option>
                                <option value="4" {{old("locale_rate")==4?"selected":""}}>{{trans_choice("institutes.institute_stars_option",4)}}</option>
                                <option value="5" {{old("locale_rate")==5?"selected":""}}>{{trans_choice("institutes.institute_stars_option",5)}}</option>
                                <option value="6" {{old("locale_rate")==6?"selected":""}}>{{trans_choice("institutes.institute_stars_option",6)}}</option>
                                <option value="7" {{old("locale_rate")==7?"selected":""}}>{{trans_choice("institutes.institute_stars_option",7)}}</option>
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
                                <option value="1" {{old("international_rate")==1?"selected":""}}>{{trans_choice("institutes.institute_stars_option",1)}}</option>
                                <option value="2" {{old("international_rate")==2?"selected":""}}>{{trans_choice("institutes.institute_stars_option",2)}}</option>
                                <option value="3" {{old("international_rate")==3?"selected":""}}>{{trans_choice("institutes.institute_stars_option",3)}}</option>
                                <option value="4" {{old("international_rate")==4?"selected":""}}>{{trans_choice("institutes.institute_stars_option",4)}}</option>
                                <option value="5" {{old("international_rate")==5?"selected":""}}>{{trans_choice("institutes.institute_stars_option",5)}}</option>
                                <option value="6" {{old("international_rate")==6?"selected":""}}>{{trans_choice("institutes.institute_stars_option",6)}}</option>
                                <option value="7" {{old("international_rate")==7?"selected":""}}>{{trans_choice("institutes.institute_stars_option",7)}}</option>
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
                                   value="1" {{!old("featured")?:"checked"}}>
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
                                   value="1" {{!old("in_home")?:"checked"}}>
                        </div>
                        @if ($errors->has('in_home'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('in_home') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="in_home" class="label-control col-md-3">
                            {{trans("institutes.label_status")}}
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
            <div class="panel panel-default">
                <div class="panel-heading text-center"><i
                            class="fa fa-youtube fa-2x"></i> {{trans("institutes.label_video_youtube")}} </div>
                <div class="panel-body">
                    <input type="text" name="video_youtube" id="video_youtube" class="form-control"
                           placeholder="Embed code"
                           value="{{old("video_youtube")}}"/>
                </div>
            </div>
                       <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("institutes.label_photo")}} <span
                            class="text-danger">*</span></div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("photo")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="institute_"
                    >

                        <div class="">
                            <div class="">
                                @if(file_exists(config("settings.upload_path").'/'.old('photo')))
                                    <div class="thumbnail" id="file-{{old('photo')}}" data-ng-if="!photo">
                                        <img src="{{url("files/".old('photo'))}}" alt=""
                                             class="responsive-img img-thumbnail">
                                        <input type="hidden" name="photo" value="{{old('photo')}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{old('photo')}}')">{{trans("main.btn_delete")}}</a>
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
                <div class="panel-heading text-center">{{trans("institutes.label_logo")}} </div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("logo")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="institute_"
                    >

                        <div class="">
                            <div class="">

                                  @if(file_exists(config("settings.upload_path").'/'.old('logo')))
                                    <div class="thumbnail" id="file-{{old('logo')}}" data-ng-if="!logo">
                                        <img src="{{url("files/".old('logo'))}}" alt=""
                                             class="responsive-img img-thumbnail">
                                        <input type="hidden" name="logo" value="{{old('logo')}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{old('logo')}}')">{{trans("main.btn_delete")}}</a>
                                    </div>
                                @endif
                                
                                 
                                <div ng-repeat="f in photos">
                                    <div class="thumbnail">
                                        <img ng-show="form.logo.$valid" ngf-thumbnail="f"
                                             class=" img-thumbnail">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removePhoto($index)"
                                           ng-show="logo">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="logo" value="<%f.result.file%>"
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

                            @if ($errors->has('logo'))
                                <span class="help-block">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>


                </div>
            </div>



              <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("institutes.label_brochures")}}</div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("brochures")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="files_"
                    >
                        <div class="">
                            <a id="brochures"
                               class="btn btn-default"
                               ngf-select="uploadFile($files, $invalidFiles)"
                               ng-model="brochures"
                               ngf-pattern="'*/*'"
                               ngf-accept="'*/*'"
                               ngf-max-size="1000MB"
                              
                            >
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>
                            @if ($errors->has('brochures'))
                                <span class="help-block">
                                <strong>{{ $errors->first('brochures') }}</strong>
                            </span>
                            @endif
                            <div class="clearfix"></div>
                            <div class="">
                                  @if(old('brochures'))
                                    <div class="thumbnail" id="file-{{old('logo')}}" data-ng-if="!brochures">
                                        <img src="/images/file_default.png" alt=""
                                             class="responsive-img img-thumbnail" height="70" width="70" >
                                        <input type="hidden" name="brochures" value="{{old('brochures')}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{old('brochures')}}')">{{trans("main.btn_delete")}}</a>
                                    </div>
                                @endif
                        
                                <div ng-repeat="f in files">
                                    <div class="thumbnail">
                                        <img src="/images/file_default.png" height="70" width="70" 
                                             class=" img-thumbnail">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeFile($index)"
                                           ng-show="brochures">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="brochures" value="<%f.result.file%>"
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


            <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("institutes.label_gallery")}}</div>
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
                                     @if(old('gallery'))
                                    @foreach(old('gallery') as $image)
                                        <div class="thumbnail" id="file-{{$image}}" data-ng-if="!photo">
                                            <img src="{{url("files/{$image}")}}" alt=""
                                                 class="responsive-img img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removeByName('{{$image}}')">{{trans("main.btn_delete")}}</a>
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
                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlWay-lJo-HstwNWHZwkEFNHAuuZYbGkM&libraries=places"></script>
<script type="text/javascript" src="/backend/lib/js/geocomplete/jquery.geocomplete
.min.js"></script>

 <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form ",
          markerOptions: {
            draggable: true
          }
        });
        
        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
          $("input[name=lat]").val(latLng.lat());
          $("input[name=lng]").val(latLng.lng());
          $("#reset").show();
        });
        
        
        $("#reset").click(function(){
          $("#geocomplete").geocomplete("resetMarker");
          $("#reset").hide();
          return false;
        });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        }).click();
      });
    </script>

@stop
