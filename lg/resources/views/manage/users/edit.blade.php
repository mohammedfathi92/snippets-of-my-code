@extends('layouts.app')
@section('content')
    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a href="{{url("/manage/users")}}">{{trans("main.link_users")}}</a></li>
                    <li class="active">{{ $data->name }} <span class="label label-default">({{trans("users.link_edit")}}
                            )</span></li>
                </ol>
            </div>
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    {!! Form::open(['class'=>'form-horizontal labelbold']) !!}

                    <div class="col-sm-8">
                        <!-- Example Input Sizing -->
                        <div class="example-wrap">


                            <div class="form-group required {{$errors->has('name')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="name">{{trans('users.label_name')}} *</label>
                                <div class="col-md-10">
                                    {!! Form::text("name",old('name',$data->name),['class'=>'form-control','id'=>'name']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required {{$errors->has('email')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="email">{{trans('users.label_email')}} *</label>
                                <div class="col-md-10">
                                    {!! Form::email("email",old('email',$data->email),['class'=>'form-control','id'=>'email']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('password')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="password">{{trans('users.label_password')}}</label>
                                <div class="col-md-10">
                                    {!! Form::password("password",['class'=>'form-control','id'=>'password']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('password_confirmation')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="password_confirmation">{{trans('users.label_password_confirmation')}}</label>
                                <div class="col-md-10">
                                    {!! Form::password("password_confirmation",['class'=>'form-control','id'=>'password_confirmation']) !!}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required {{$errors->has('permission')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="permission">{{trans('users.label_permission')}}</label>
                                <div class="col-md-10">
                                    <select name="permission" id="permission" class="form-control select2">
                                        <option value="1" {{old("permission",$data->permission)==1?"selected":""}}>{{trans("users.option_supervisor")}}</option>
                                        <option value="2" {{old("permission",$data->permission)==2?"selected":""}}>{{trans("users.option_partner")}}</option>
                                    </select>
                                    @if ($errors->has('about'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permission') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('address')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="address">{{trans('users.label_address')}}</label>
                                <div class="col-md-10">
                                    {!! Form::text("address",old('address',$data->address),['class'=>'form-control','id'=>'address']) !!}
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('company')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="company">{{trans('users.label_company')}}</label>
                                <div class="col-md-10">
                                    {!! Form::text("company",old('company',$data->company),['class'=>'form-control','id'=>'company']) !!}
                                    @if ($errors->has('company'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('company') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('annual_sales')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="annual_sales">{{trans('users.label_annual_sales')}}</label>
                                <div class="col-md-10">
                                    {!! Form::text("annual_sales",old('annual_sales',$data->annual_sales),['class'=>'form-control','id'=>'annual_sales']) !!}
                                    @if ($errors->has('annual_sales'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('annual_sales') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('phone')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="phone">{{trans('users.label_phone')}}</label>
                                <div class="col-md-10">
                                    {!! Form::tel("phone",old('phone',$data->phone),['class'=>'form-control','id'=>'phone']) !!}
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('mobile')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="mobile">{{trans('users.label_mobile')}}</label>
                                <div class="col-md-10">
                                    {!! Form::tel("mobile",old('mobile',$data->mobile),['class'=>'form-control','id'=>'mobile']) !!}
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('about')?'has-error':''}}">
                                <label class="control-label col-md-2"
                                       for="about">{{trans('users.label_about')}}</label>
                                <div class="col-md-10">
                                    {!! Form::textarea("about",old('about',$data->about),['class'=>'form-control','id'=>'about']) !!}
                                    @if ($errors->has('about'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('about') }}</strong>
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
                         upload-url="{{url($locale."/manage/users/upload")}}">
                        <h4 class="text-center">{{trans('users.label_avatar')}}</h4>
                        <div class="clearfix"></div>
                        <br>
                        @if($data->avatar)
                            <div class="thumbnail">
                                <img src="{{url('images/sm/'.$data->avatar)}}" class="img-thumbnail" alt="">
                            </div>
                        @endif

                        <a href="javascript:;"
                           class="btn btn-default form-control btn btn-default"
                           ngf-select="uploadPhoto($files, $invalidFiles)"
                           ng-model="avatar"
                           ngf-pattern="'image/*'"
                           ngf-accept="'image/*'"
                           ngf-max-size="10MB" ngf-min-height="100">

                            <i class="site-menu-icon md-cloud-upload"></i> {{$data->avatar?trans("main.btn_change"):trans("main.btn_upload")}}</a>
                        @if ($errors->has('avatar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                        @endif

                        <div ng-repeat="f in photos" style="font:smaller">
                            <div class="thumbnail">
                                <img ng-show="form.file.$valid" ngf-thumbnail="f" class=" img-thumbnail">
                                <a href="javascript:;" class="btn btn-danger" ng-click="removePhoto($index)"
                                   ng-show="avatar">{{trans("main.btn_delete")}}</a>

                                <br>
                                <br>
                                <i ng-show="f.$error.required">*required</i>
                                <i ng-show="f.$error.maxSize">File too large
                                    <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                <input type="hidden" name="avatar" value="<%f.result.file%>"
                                       ng-if="f && f.progress==100">
                                <div class="progress  active" ng-show="f.progress >= 0"
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