<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 3/23/16
 * Time: 11:36 PM
 */
?>
@extends('backend.layout.master')

@section("page_header")
    <div class="content-header">
        <h1>
            products
            <small>Add a new one</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> {{trans('main.link_dashboard')}}</a></li>
            <li><a href="{{url('admin/products')}}">{{trans('products.link_products')}}</a></li>
            <li class="active">{{trans("products.create_new")}}</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">add a new product</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                {!! Form::open(['class'=>'form-horizontal','name'=>'form','files'=>true, "ng-controller"=>"productsUploaderCtrl"]) !!}
                <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="javascript:;" data-target="#tab_general" data-toggle="tab">General</a>
                            </li>
                            <li><a href="javascript:;" data-target="#tab_gallery" data-toggle="tab">Gallery/Colors</a>
                            </li>
                            <li><a href="javascript:;" data-target="#tab_properties" data-toggle="tab">Properties</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">

                                <div>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li role="presentation" class="active">
                                            <a href="#" data-target="#language_ar" aria-controls="language_ar"
                                               role="tab"
                                               data-toggle="tab">{{trans('main.btn_lang_ar')}}</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#" data-target="#language_en" aria-controls="language_en"
                                               role="tab"
                                               data-toggle="tab">{{trans('main.btn_lang_en')}}</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="language_ar">
                                            {{--title--}}
                                            <div class="form-group">
                                                {!! Form::label("name",trans('products.label_name')." *",['class'=>'label-control col-md-3','required']) !!}
                                                <div class="col-md-9 col-xs-12">
                                                    {!! Form::text("name[ar]",old('name[ar]'),['class'=>'form-control']) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                {!! Form::label("description",trans('products.label_description'),['class'=>'label-control col-md-3']) !!}
                                                <div class="col-md-9 col-xs-12">
                                                    {!! Form::textarea("description[ar]",old('description[ar]'),['class'=>'form-control ckeditor']) !!}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="language_en">
                                            {{--title--}}
                                            <div class="form-group">
                                                {!! Form::label("name",trans('products.label_name')." *",['class'=>'label-control col-md-3','required']) !!}
                                                <div class="col-md-9 col-xs-12">
                                                    {!! Form::text("name[en]",old('name[en]'),['class'=>'form-control']) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                {!! Form::label("description",trans('products.label_description'),['class'=>'label-control col-md-3']) !!}
                                                <div class="col-md-9 col-xs-12">
                                                    {!! Form::textarea("description[en]",old('description[en]'),['class'=>'form-control ckeditor']) !!}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr/>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-md-3 control-label">Sort</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                            <input type="number" name="sort" class="form-control" min="0" value="1" step="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label("photo",trans("products.label_photo"),['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        <div class="input-group col-md-3">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>


                                            <a href="javascript:;"
                                               class="btn btn-default form-control btn btn-default"
                                               ngf-select="uploadPhoto($files, $invalidFiles)"
                                               ng-model="photo"
                                               ngf-pattern="'image/*'"
                                               ngf-accept="'image/*'"
                                               ngf-max-size="10MB" ngf-min-height="100"
                                            ><i class="fa fa-upload"></i> Select</a>

                                        </div>
                                        <br/>


                                        <div ng-repeat="f in photos" style="font:smaller">
                                            <div class="col-md-3">
                                                <img ng-show="form.file.$valid" ngf-thumbnail="f" class="thumbnail img-thumbnail">
                                                <a href="javascript:;" class="btn btn-danger" ng-click="removePhoto($index)"
                                                   ng-show="photo">Remove</a>
                                                <br>
                                                <i ng-show="f.$error.required">*required</i>
                                                <i ng-show="f.$error.maxSize">File too large
                                                    <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                                <input type="hidden" name="photo" value="<%f.result.file%>"
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
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_gallery">
                                <div class="form-group" data-ng-controller="productsCtrl">
                                    {!! Form::label("gallery",trans("products.label_gallery"),['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-5 col-xs-12">

                                        <div class="input-group">
                                            <a href="javascript:;"
                                               class="btn btn-default form-control btn btn-default"
                                               ngf-select="uploadGallery($files, $invalidFiles)"
                                               ng-model="gallery" ngf-multiple="true" ngf-pattern="'image/*'"
                                               ngf-accept="'image/*'"
                                               ngf-keep="true"
                                               ngf-max-size="10MB" ngf-min-height="100"
                                            ><i class="fa fa-upload"></i>  Select</a>

                                        </div>
                                        <br/>
                                        <div ng-repeat="f in gallery" style="font:smaller">
                                            <div class="col-md-3">
                                                <i ng-show="f.$error.required">*required</i>
                                                <i ng-show="f.$error.maxSize">File too large
                                                    <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                                <img ng-show="f.$valid" ngf-thumbnail="f" class="thumbnail img-thumbnail">
                                                <a href="javascript:;" class="btn btn-danger"
                                                   ng-click="removeGallery($index)"
                                                   ng-show="gallery">Remove</a>
                                                <br>
                                                <input type="hidden" name="gallery[]" value="<%f.result.file%>"
                                                       ng-if="f && f.progress==100">
                                                <div class="progress  active" ng-show="f.progress >= 0"
                                                     ng-if="f">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped"
                                                         role="progressbar" aria-valuenow="<%f.progress%>"
                                                         aria-valuemin="0" aria-valuemax="100"
                                                         style="width: <%f.progress%>%">
                                                        <span class="sr-only"><% f.progress %> % Complete</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="showInHome"
                                           class="label-control col-md-3">{{trans('products.label_show_in_home')}}</label>
                                    <div class="col-md-9 col-md-12">

                                        <label for="showInHome">
                                            <input type="checkbox" data-ng-model="showInHome" name="show_in_home"
                                                   value="1" id="showInHome"/> {{trans('products.label_show')}}
                                        </label>
                                        <div class="col-md-12" data-ng-if="showInHome">
                                            <div>
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li role="presentation" class="active">
                                                        <a href="#" data-target="#language_slide_ar"
                                                           aria-controls="language_slide_ar"
                                                           role="tab"
                                                           data-toggle="tab">{{trans('main.btn_lang_ar')}}</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#" data-target="#language_slide_en"
                                                           aria-controls="language_slide_en" role="tab"
                                                           data-toggle="tab">{{trans('main.btn_lang_en')}}</a></li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active" id="language_slide_ar">
                                                        {{--title--}}
                                                        <div class="form-group">
                                                            <label for="slideDescription"
                                                                   class="col-md-3">{{trans("products.label_slide_description")}}</label>
                                                            <div class="col-md-9">
                                                    <textarea name="slide_description[ar]" id="slideDescriptionAr"
                                                              cols="70"
                                                              rows="5">{{old('slide_description')['ar']}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade " id="language_slide_en">
                                                        {{--title--}}
                                                        <div class="form-group">
                                                            <label for="slideDescription"
                                                                   class="col-md-3">{{trans("products.label_slide_description")}}</label>
                                                            <div class="col-md-9">
                                                    <textarea name="slide_description[en]" id="slideDescriptionAr"
                                                              cols="70"
                                                              rows="5">{{old('slide_description')['en']}}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr/>
                                            </div>
                                            <div class="form-group">
                                                <label for="slidePhoto"
                                                       class="col-md-3 col-xs-6">{{trans('products.label_slide_photo')}}</label>

                                                {{--<div class="col-md-9">
                                                    <input type="file" name="slide_photo" id="slidePhoto">
                                                </div>--}}
                                                <div class="col-md-9 col-xs-6">

                                                    <div class="input-group">
                                                        <a href="javascript:;"
                                                           class="btn btn-default form-control btn btn-default"
                                                           ngf-select="uploadSlidePhoto($files, $invalidFiles)"
                                                           ng-model="slide"
                                                           ngf-pattern="'image/*'"
                                                           ngf-accept="'image/*'"
                                                           ngf-max-size="10MB" ngf-min-height="100"
                                                           ><i class="fa fa-upload"></i> Select</a>
                                                    </div>
                                                    <br/>
                                                    <div ng-repeat="f in slidePhoto" style="font:smaller">
                                                        <div class="col-md-7">
                                                            <i ng-show="f.$error.required">*required</i>
                                                            <i ng-show="f.$error.maxSize">File too large
                                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                                            <img ng-show="f.$valid" ngf-thumbnail="f" class="thumbnail img-thumbnail">
                                                            <a href="javascript:;" class="btn btn-danger"
                                                               ng-click="removeSlidePhoto($index)"
                                                               ng-show="f">Remove</a>
                                                            <br>
                                                            <input type="hidden" name="slide_photo" value="<%f.result.file%>"
                                                                   ng-if="f && f.progress==100">
                                                            <div class="progress  active" ng-show="f.progress >= 0"
                                                                 ng-if="f">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped"
                                                                     role="progressbar" aria-valuenow="<%f.progress%>"
                                                                     aria-valuemin="0" aria-valuemax="100"
                                                                     style="width: <%f.progress%>%">
                                                                    <span class="sr-only"><% f.progress %> % Complete</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="backgroundUploader"
                                                       class="col-md-3">{{trans('products.label_slide_background')}}</label>

                                                {{--<div class="col-md-9">
                                                    <input type="file" name="slide_background" id="backgroundUploader">
                                                </div>--}}
                                                <div class="col-md-9 col-xs-6">

                                                    <div class="input-group">
                                                        <a href="javascript:;"
                                                           class="btn btn-default form-control btn btn-default"
                                                           ngf-select="uploadSlideBackground($files, $invalidFiles)"
                                                           ng-model="background"
                                                           ngf-pattern="'image/*'"
                                                           ngf-accept="'image/*'"
                                                           ngf-max-size="10MB" ngf-min-height="100"
                                                        ><i class="fa fa-upload"></i> Select</a>
                                                    </div>
                                                    <br/>
                                                    <div ng-repeat="f in slideBackground" style="font:smaller">
                                                        <div class="col-md-7">
                                                            <i ng-show="f.$error.required">*required</i>
                                                            <i ng-show="f.$error.maxSize">File too large
                                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                                            <img ng-show="f.$valid" ngf-thumbnail="f" class="thumbnail img-thumbnail">
                                                            <a href="javascript:;" class="btn btn-danger"
                                                               ng-click="removeSlideBackground($index)"
                                                               ng-show="gallery">Remove</a>
                                                            <br>
                                                            <input type="hidden" name="slide_background" value="<%f.result.file%>"
                                                                   ng-if="f && f.progress==100">
                                                            <div class="progress  active" ng-show="f.progress >= 0"
                                                                 ng-if="f">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped"
                                                                     role="progressbar" aria-valuenow="<%f.progress%>"
                                                                     aria-valuemin="0" aria-valuemax="100"
                                                                     style="width: <%f.progress%>%">
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
                                <div class="form-group" ng-controller="colorpickerCtrl">
                                    <a href="javascript:;" class="btn btn-primary"
                                       ng-click="add()">{{trans('main.btn_add')}}</a>
                                    {!! Form::label("colors",trans("products.label_colors"),['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12 " ng-repeat="input in inputs">

                                        <div class="input-group col-md-3 col-xs-6 colorpicker-component"
                                             id="<% input.id %>">

                                            <span class="input-group-addon"><i
                                                        data-ng-style="{'background-color':input.color}"></i></span>
                                            <input colorpicker type="text" name="colors[]" value="<%input.color%>"
                                                   class="form-control" data-ng-model="input.color"/>
                                            <a href="javascript:;" class="input-group-addon btn btn-danger"
                                               data-ng-click="removeColor($index)"><i class="fa fa-trash"></i></a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_properties" data-ng-controller="categoryPropertiesCtrl">

                                <div class="form-group">
                                    {!! Form::label("category",trans('products.label_category')." *",['class'=>'label-control col-md-3']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        <select name="category" id="category" data-ng-model="selectedCategory"
                                                class="form-control select2">
                                            <option value=""></option>
                                            @if($categories)
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->cat_title}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">
                                    {!! Form::label("properties",trans('categories.label_properties')." *",['class'=>'label-control col-md-3','required']) !!}
                                    <div class="col-md-9 col-xs-12">
                                        <div class="list-group">
                                            <div class="list-group-item" data-ng-repeat="property in properties">
                                                <input type="hidden" name="cat_property_id[]"
                                                       value="<% property.id%>">
                                                <div class="form-group">
                                                    <label class="col-md-5" for="<%property.id%>ar"><%property.translations[0].name%></label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                        class="<%property.icon%>"></i></span>

                                                            <input type="text" name="value[<% property.id%>][ar]"
                                                                   class="form-control"
                                                                   id="<%property.id%>ar" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-5" for="<%property.id%>"><%property.translations[1].name%></label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                    class="<%property.icon%>"></i>
                                                        </span>

                                                            {{--                                                            {!! Form::text("value[]",old('value[]'),['class'=>'form-control','id'=>'<%property.property_id%>']) !!}--}}
                                                            <input type="text" name="value[<% property.id%>][en]"
                                                                   class="form-control"
                                                                   id="<%property.id%>" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="filters"
                                           class="control-label col-md-3">{{trans('products.label_filters')}}</label>
                                    <div id="filters" class="col-md-9">
                                        <div class="panel-group" data-ng-controller="productsFiltersCtrl">
                                            <div class="panel-group" id="accordion" data-ng-if="filters.length">


                                                <div class="panel panel-default" data-ng-repeat="filter in filters">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                               href="#collapse<%filter.id%>">
                                                                <% filter.name %></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse<%filter.id%>"
                                                         class="panel-collapse collapse <% (!$index)?'in':'' %>">
                                                        <div class="panel-body">

                                                            <ul class="list-group"
                                                                data-ng-if="filter.sub_filters.length">

                                                                <li class="list-group-item"
                                                                    data-ng-repeat="sub in filter.sub_filters">
                                                                    <label for="filter_<% sub.id %>">
                                                                        <input type="radio" id="filter_<% sub.id %>"
                                                                               data-ng-checked="sub.products.length?true:false"
                                                                               name="filters[<%filter.id%>]"
                                                                               value="<%sub.id%>">
                                                                        <% sub.name %>
                                                                    </label>

                                                                </li>

                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->

                    <div class="pull-right">
                        {!! Form::submit(trans("main.btn_save"),['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

@stop
@section("scripts")
    <script>
        $('.colorpicker-component').colorpicker();
    </script>
@stop