@extends('layouts.app')
@section('content')
    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a href="{{url("/manage/club")}}">{{trans("main.link_club_management")}}</a></li>
                    <li class="active"> {{$data->name}} <span
                                class="label label-default">{{trans("levels.link_edit")}}</span></li>
                </ol>
            </div>
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    {!! Form::open(['class'=>'form-horizontal labelbold']) !!}

                    <div class="col-sm-8">
                        <!-- Example Input Sizing -->
                        <div class="example-wrap">

                            <div class="form-group">
                                <label for="name" class="control-label col-md-3">{{trans("levels.label_name")}}</label>
                                <div class="col-md-9">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $locale=> $properties)
                                        <div class="form-group  {{App::isLocale($locale)?"required":""}} {{$errors->has("name.$locale")?'has-error':''}}">
                                            <label class="control-label col-md-2"
                                                   for="name_{{$locale}}">{{$properties['native']}}</label>
                                            <div class="col-md-10">
                                                {!! Form::text("name[$locale]",old("name.$locale",$data->{"name:$locale"}),['class'=>'form-control','id'=>"name_$locale"]) !!}
                                                @if ($errors->has("name.$locale"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name.$locale") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description_ar"
                                       class="control-label col-md-3">{{trans("levels.label_description")}}</label>
                                <div class="col-md-9">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $locale=> $properties)
                                        <div class="form-group {{$errors->has('description')?'has-error':''}}">
                                            <label class="control-label col-md-2"
                                                   for="description_{{$locale}}">{{$properties['native']}} </label>
                                            <div class="col-md-10">
                                                {!! Form::textarea("description[$locale]",old("description.$locale",$data->{"description:$locale"}),['class'=>'form-control','id'=>"description_$locale"]) !!}
                                                @if ($errors->has("description.$locale"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("description.$locale") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <hr>
                            <div class="clearfix"></div>
                            <div class="form-group required {{$errors->has('parent')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="parent">{{trans('levels.label_parent')}} </label>
                                <div class="col-md-10">
                                    <select name="parent" id="parent" class="select2 form-control">
                                        <option value="0">{{trans('levels.option_parent')}}</option>
                                        @if($parents)
                                            @foreach($parents as $item)
                                                <option value="{{$item->id}}"
                                                        @if($item->id==old("parent",$data->parent_id)) selected @endif >{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('parent'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('parent') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required {{$errors->has('target')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="target">{{trans('levels.label_target')}} </label>
                                <div class="col-md-10">
                                    {!! Form::number("target",old('target',$data->target),['class'=>'form-control','id'=>'target','min'=>0]) !!}
                                    @if ($errors->has('target'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('target') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required {{$errors->has('min')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="target">{{trans('levels.label_minimum')}} </label>
                                <div class="col-md-10">
                                    {!! Form::number("min",old('min',$data->min),['class'=>'form-control','id'=>'min','min'=>0]) !!}
                                    @if ($errors->has('min'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('min') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit"
                                        class="btn btn-primary waves-effect waves-light waves-effect waves-light">
                                    {{trans('main.submit')}}
                                </button>
                                <button type="reset" class="btn waves-effect waves-light waves-effect waves-light">
                                    {{trans('main.reset')}}
                                </button>
                            </div>

                        </div>
                        <!-- End Example Input Sizing -->
                    </div>
                    <div class="col-md-4 col-sm-4  {{$errors->has('photo')?'has-error':''}}"
                         data-ng-controller="manageUploaderCtrl"
                         upload-url="{{url($locale."/manage/club/upload")}}">
                        <h4 class="text-center">{{trans('levels.label_photo')}}</h4>
                        <div class="clearfix"></div>
                        <br>


                        <a href="javascript:;"
                           class="btn btn-default form-control btn btn-default"
                           ngf-select="uploadPhoto($files, $invalidFiles)"
                           ng-model="photo"
                           ngf-pattern="'image/*'"
                           ngf-accept="'image/*'"
                           ngf-max-size="10MB" ngf-min-height="100">
                            <i class="site-menu-icon md-cloud-upload"></i> {{trans("main.btn_upload")}}</a>
                        @if ($errors->has('photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif

                        @if($data->photo)
                            <div class="thumbnail">
                                <a href="{{url("images/$data->photo")}}" data-lightbox="roadtrip">
                                    <img src="/images/sm/{{$data->photo}}" class="img-thumbnail" alt="">
                                    <input type="hidden" name="old_photo" value="{{$data->photo}}">
                                </a>
                            </div>
                        @endif
                        <div ng-repeat="f in photos" style="font:smaller">
                            <div class="thumbnail">
                                <img ng-show="form.file.$valid" ngf-thumbnail="f" class=" img-thumbnail">
                                <a href="javascript:;" class="btn btn-danger" ng-click="removePhoto($index)"
                                   ng-show="photo">{{trans("main.btn_delete")}}</a>
                                <br>
                                <br>
                                <i ng-show="f.$error.required">*required</i>
                                <i ng-show="f.$error.maxSize">File too large
                                    <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                <input type="hidden" name="photo" value="<%f.result.file%>"
                                       ng-if="f && f.progress==100">
                                <div class="progress  active" ng-show="f.progress >= 0 && f.progress<100"
                                     ng-hide="f.progress>=100"
                                     ng-if="f">
                                    <div class="progress-bar progress-bar-success progress-bar-striped"
                                         role="progressbar" aria-valuenow="<%f.progress%>" aria-valuemin="0"
                                         aria-valuemax="100" style="width: <%f.progress%>%">
                                        <span class="sr-only"><% f.progress %> % Complete</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection