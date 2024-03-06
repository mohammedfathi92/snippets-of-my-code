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
        <i class="fa fa-question-circle-o"></i> {{trans("faq.backend_page_create_header")}} </h1>
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
        <div class="content">

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
                                           class="col-sm-3 control-label">{{trans("faq.label_name")}}
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
                                           class="col-sm-3 control-label">{{trans("faq.label_description")}}
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
                                           class="col-sm-3 control-label">{{trans("faq.label_meta_keywords")}}
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
                                           class="col-sm-3 control-label">{{trans("faq.label_meta_description")}}
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
                    <div class="form-group">
                        <label for="slug"
                               class="control-label col-md-3">{{trans("faq.label_slug")}}
                            <span class="text-danger">*</span></label>
                        </label>
                        <div class="col-md-3">
                            <input type="text" name="slug" class="form-control"
                                   value="{{old("slug")}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type"
                               class="control-label col-md-3">{{trans("faq.label_type")}}</label>
                        <div class="col-md-3">
                            <select name="type" id="type" class="form-control">
                                <option value=""></option>
                                <option value="hotels" {{old("type")=="hotels"?"selected":""}}>{{trans("faq.type_options.hotels")}}</option>
                                <option value="places" {{old("type")=="places"?"selected":""}}>{{trans("faq.type_options.places")}}</option>
                                <option value="packages" {{old("type")=="packages"?"selected":""}}>{{trans("faq.type_options.packages")}}</option>
                                <option value="countries" {{old("type")=="countries"?"selected":""}}>{{trans("faq.type_options.countries")}}</option>
                                <option value="cities" {{old("type")=="cities"?"selected":""}}>{{trans("faq.type_options.cities")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icon_class"
                               class="control-label col-md-3">{{trans("faq.label_icon")}}</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="icon" class="form-control icon-picker"
                                       value="{{old("icon",isset($data->icon_class)?$data->icon_class:'')}}">
                                <span class="input-group-addon"><i class="fa fa-adn"></i></span>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sort"
                               class="control-label col-md-3">{{trans("faq.label_sort")}}</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input id="sort" type="number" min="1" name="sort" class="form-control"
                                       value="{{old("sort",1)}}">

                            </div>

                        </div>
                    </div>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="status" class="label-control col-md-3">
                            {{trans("faq.label_status")}}
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
                <button href="faq.html" type="submit"
                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">
@stop
@section('javascript')
    <!-- DataTables -->
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>
        $('.icon-picker').iconpicker()
    </script>
@stop