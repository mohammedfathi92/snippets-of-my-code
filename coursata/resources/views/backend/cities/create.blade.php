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
            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">

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

                        
                          <div class="form-group {{$errors->has("is_state")?"has-error":''}} col-md-6">
                            <label for="is_state"
                                   class="control-label col-sm-3">{{trans("cities.label_is_state")}}
                                
                            </label>

                            <div class="col-sm-4">
                                <select name="is_state" id="is_state"  class=" form-control"
                                        >
                                    
                                    
                                    <option  value="0"
                                            @if(old('is_state')== 0) selected @endif> {{ trans('cities.option_city') }}
                                    </option>
                                    <option  value="1"
                                            @if(old('is_state')== 1) selected @endif> {{ trans('cities.option_state') }}
                                    </option>
                                    
                                </select>
                                @if ($errors->has('is_state'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('is_state') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group {{$errors->has("state_id")?"has-error":''}} col-md-6">
                            <label for="state_id"
                                   class="control-label col-sm-3">{{trans("institutes.label_state")}}
                                
                            </label>

                            <div class="col-sm-9">
                                <select name="state_id" id="state_id"  class=" form-control"
                                        >
                                    <option value="">Choose State of city</option>
                                    @foreach($country->states()->get() as $state)
                                    <option  value="{{ $state->id }}"
                                            @if(old('state_id')=="{{ $state->id }}") selected @endif>{{ $state->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('state_id') }}</strong>
                                        </span>
                                @endif
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
                            <input name="lat" class="form-control disabled" type="text" value="{{old("lat")}}" style="background-color: #d1f9ce;" disabled>
                           
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="lng" class="control-label col-sm-3"> Longitude
                        </label>

                        <div class="col-sm-9">
                            <input name="lng" class="form-control" type="text" value="{{old("lng")}}" style="background-color: #d1f9ce;" disabled>
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lng" class="control-label col-sm-3" > Formatted Address
                        </label>

                        <div class="col-sm-9">
                            <input name="formatted_address" type="text" value="{{old("formatted_address")}}" class="form-control disabled"  style="background-color: #d1f9ce;" disabled>
                           
                        </div>
                    </div>
<hr>
              <!-- End Map inputes -->   
              
                        <div class="form-group {{$errors->has("photo")?"has-error":''}}"
                             data-ng-controller="backendUploaderCtrl"
                             data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                             data-resize="50,50"
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
                                <span class="help-block">
                                    {{trans("countries.code_input_help")}}
                                </span>
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

@section('javascript')
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBlWay-lJo-HstwNWHZwkEFNHAuuZYbGkM&libraries=places"></script>
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
