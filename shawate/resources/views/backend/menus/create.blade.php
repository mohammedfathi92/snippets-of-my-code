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
        <i class="fa fa-list-alt"></i> {{trans("menus.backend_page_create_header")}} </h1>
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
                                <div class="form-group {{!$errors->has("title.$localeCode")?:"has-error"}} ">
                                    <label for="title"
                                           class="col-sm-3 control-label">{{trans("menus.label_title")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title[{{$localeCode}}]" class="form-control"
                                               id="title"
                                               placeholder="" value="{{old("title.$localeCode")}}">
                                        @if ($errors->has("title.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("title.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <hr>
                    <div class="form-group {{$errors->has("position")?"has-error":''}}">
                        <label for="position" class="label-control col-md-3">
                            {{trans("menus.label_position")}}
                            <span class="text-danger">*</span></label>
                        </label>
                        <div class="col-md-9">
                            <select name="position" id="position" class="form-control select2">
                                <option value="main_menu">{{trans("menus.position_option.main_menu")}}</option>
                                <option value="top_menu">{{trans("menus.position_option.top_menu")}}</option>
                                <option value="footer">{{trans("menus.position_option.footer")}}</option>
                                <option value="footer1">{{trans("menus.position_option.footer1")}}</option>
                                <option value="footer2">{{trans("menus.position_option.footer2")}}</option>
                                {{--<option value="footer3">{{trans("menus.position_option.footer3")}}</option>--}}
                            </select>
                        </div>
                        @if ($errors->has('position'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("class")?"has-error":''}}">
                        <label for="position" class="label-control col-md-3">
                            {{trans("menus.label_class")}}
                            </label>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-css3"></i></span>
                                <input id="class" type="text"  name="class" class="form-control"
                                       value="{{old("class")}}">

                            </div>

                        </div>
                    </div>
                    <div class="form-group {{$errors->has("sort")?"has-error":''}}">
                        <label for="position" class="label-control col-md-3">
                            {{trans("menus.label_sort")}}
                            </label>
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="sort" type="number" min="1" name="sort" class="form-control"
                                       value="{{old("sort",1)}}">

                            </div>

                        </div>
                    </div>
                    <div class="form-group {{$errors->has("show_title")?"has-error":''}}">
                        <label for="show_title" class="label-control col-md-3">
                            {{trans("menus.label_show_title")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="show_title" id="show_title" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{!old("show_title")?:"checked"}}>
                        </div>
                        @if ($errors->has('show_title'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('show_title') }}</strong>
                                        </span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="status" class="label-control col-md-3">
                            {{trans("menus.label_status")}}
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
