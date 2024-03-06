<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 11/10/16
 * Time: 12:56 PM
 */
?>
@extends('backend.layouts.master')

@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-group"></i>{{trans("users.backend_update_page_header")}}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('flash::message')
        {!! Form::open(['method'=>'PUT','class'=>'form-horizontal','files'=>true]) !!}

        <div class="row">

            <div class="col-md-8">

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group {{$errors->has('name')?"has-error":''}}">
                            <label for="first_name"
                                   class="col-sm-3 control-label">{{trans("users.label_name")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="first_name"
                                       placeholder="" value="{{old('name',$data->name)}}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('email')?"has-error":''}}">
                            <label for="email" class="col-sm-3 control-label">{{trans("users.label_email")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <dif class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="" value="{{old('email',$data->email)}}">
                                </dif>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password')?"has-error":''}}">
                            <label for="password"
                                   class="col-sm-3 control-label"> {{trans("users.label_password")}}
                                <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="password" name="password" type="password"
                                           value="{{old('password')}}"
                                           class="form-control" placeholder="{{trans("users.label_password")}}">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password_confirmation')?"has-error":''}}">
                            <label for="password_confirmation"
                                   class="col-sm-3 control-label"> {{trans("users.label_password_confirmation")}}
                                <span
                                        class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="password_confirmation" name="password_confirmation"
                                           type="password"
                                           value="{{old('password_confirmation')}}" class="form-control"
                                           placeholder="{{trans("users.label_password_confirmation")}}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('level')?"has-error":''}}">
                            <label for="level"
                                   class="col-sm-3 control-label"> Level
                            </label>
                            <div class="col-sm-9">
                                @if($data->level===0)
                                    <strong>Super Administrator</strong>
                                @else
                                    <select name="level" class="form-control" data-ng-model="level"
                                            data-ng-init="level='{{old("level",$data->level)}}'"
                                            data-placeholder="Select Access Level">
                                        <option value=""></option>
                                        <option value="1" @if(old('level',$data->level)==1) selected @endif>Manager
                                        </option>
                                        <option value="2" @if(old('level',$data->level)==2) selected @endif>Member
                                        </option>
                                    </select>
                                    @if ($errors->has('level'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        {{--@can('assign permissions')--}}
                        <div data-ng-show="level==1"
                             class="form-group {{$errors->has('permissions') ? ' has-error' : '' }}">
                            <label for="permissions"
                                   class="col-md-3 control-label">{!! trans("users.label_permissions") !!}
                                <strong
                                        class='text-danger'> *</strong></label>

                            <div class="col-md-9">
                                @php
                                    $roles_list=[];

                                        foreach ($data->roles as $role)
                                            {
                                                $roles_list[]=$role->name;
                                            }
                                @endphp
                                <select name="permissions[]" id="permissions" class="form-control"
                                        multiple>
                                    @if($permissions)
                                        @foreach($permissions as $perm)
                                            <option value="{{$perm->name}}"
                                                    @if(in_array($perm->name,old("permissions",$roles_list)))selected @endif>{{ucfirst($perm->name)}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('permissions'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permissions') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--@endcan--}}
                    </div>


                </div>
            </div>


            <div class="col-md-4">
                <!-- ### IMAGE ### -->
                <div class="panel panel-bordered panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon wb-image"></i> User Avatar</h3>
                        <div class="panel-actions">
                            <a class="panel-action icon wb-minus" data-toggle="panel-collapse"
                               aria-hidden="true"></a>
                        </div>
                    </div>
                    <div class="panel-body">

                        <img src="/images/default-avatar.jpg" style="width:100%"/>

                        <input type="file" name="avatar">
                    </div>
                </div><!-- .panel -->

            </div><!-- .col-md-4 -->
        </div><!-- .row -->

        <!-- PUT Method if we are editing -->

        <!-- CSRF TOKEN -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <button type="submit"
                class="btn btn-primary pull-right"><i class="icon wb-plus-circle"></i> Create Account
        </button>

        {!! Form::close() !!}

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="/{{$locale."/".$backend_uri}}/upload" target="form_target" method="post"
              enctype="multipart/form-data"
              style="width:0px;height:0;overflow:hidden">
            <input name="avatar" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="users">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div><!-- .container-fluid -->
@stop

