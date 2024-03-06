{{--
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 6/27/16
 * Time: 8:16 PM
 --}}

@extends('backend.layout.master')

@section("page_header")
    <div class="content-header">
        <h1>
            {{trans('categories.categories')}}
            <small>{{$page_title}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/categories')}}"><i
                            class="fa fa-dashboard"></i> {{trans("categories.link_categories")}}</a></li>
            <li><a href="{{url('admin/categories')}}"><i class="fa fa-dashboard"></i> {{ $category->cat_title }}</a>
            </li>
            <li class="active">{{trans('properties.page_title')}}</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('properties.page_title')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" data-ng-controller="propertiesCtrl">
                    <div class="">
                        <button class="btn btn-primary pull-right btn-lg"
                                data-ng-click="add('{{$category->id}}')">{{trans('main.btn_add')}}</button>
                        <div class="clearfix"></div>
                    </div>
                    <ul class="list-group" data-ng-init="getProperties('{{$category->id}}')">
                        <li class="list-group-item" data-ng-repeat="property in properties">
                            <div class="col-md-10">

                                <div class="row">
                                    <div class=" form-group">
                                        <label class="control-label col-md-3">{{trans('categories.property_name_ar')}}</label>
                                        <div class="col-md-7">
                                            <p><% property.translations[0].name%></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class=" form-group">
                                        <label class="control-label col-md-3">{{trans('categories.property_name_en')}}</label>
                                        <div class="col-md-7">
                                            <p><% property.translations[1].name%></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2 col-md-2">
                                        <p class="label label-default"><% property.sort %></p>
                                    </div>
                                    <div class=" col-md-5">

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                     <i class="<%property.icon%>"></i>
                                            </span>
                                            <div class="form-control"><%property.icon%></div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-2">
                                <a href="javascript:;"
                                   class="btn btn-success "
                                   data-ng-click="edit(property.category_id,property.id)"><i
                                            class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;"
                                   class="btn btn-danger "
                                   data-ng-click="delete(property.category_id,property.id)"><i
                                            class="fa fa-trash"></i>
                                </a>
                            </div>


                            <div class="clearfix"></div>
                        </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

    <!-- The actual modal template, just a bit o bootstrap -->
    {{--add property modal--}}
    <script type="text/ng-template" id="modalAddProperty.html">
        <div class="modal-header">
            <h3 class="modal-title">{{trans('properties.title_add_property')}}</h3>
        </div>
        <div class="modal-body">
            <form action="" data-ng-submit="$event.preventDefault();ok()" class="form-horizontal">


                <div class=" form-group">
                    <label for="<%property.id%>_ar"
                           class="control-label col-md-3">{{trans('properties.label_name_ar')}}</label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="property_name[ar]" data-ng-model="propertyNameAr"
                               id="<%property.id%>_ar"
                               value="<% property.property_name_ar%>"
                               placeholder="{{trans('categories.hint_enter_property')}}"/>
                    </div>

                </div>
                <div class=" form-group">
                    <label for="name_en"
                           class="control-label col-md-3">{{trans('properties.label_name_en')}}
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="property_name[en][]"
                               data-ng-model="propertyNameEn"
                               id="name_en"
                               value=""
                               placeholder="{{trans('categories.hint_enter_property')}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="property_icon"
                           class="control-label col-md-3 col-xs-12">{{trans('properties.label_icon')}}</label>
                    <div class="col-md-7 col-xs-12">
                        <div class="input-group">
                         <span class="input-group-addon">
                               <ui-iconpicker
                                       groups="font-awesome" data-ng-model="propertyIcon"
                                       value="<%property.property_icon%>">
                                </ui-iconpicker>
                         </span>
                            <input type="text" class="form-control" id="property_icon" data-ng-model="propertyIcon"
                                   value="<%property.property_icon%>"
                                   name="property_icon[]"/>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label  col-md-3 col-xs-12">{{trans('properties.label_icon_size')}}</label>
                    <div class="col-md-3 col-xs-5">
                        <input type="number" name="icon_size[]" class="form-control" data-ng-model="propertyIconSize"
                               value="<% property.property_icon_size%>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="property_sort"
                           class="control-label col-md-3 col-xs-12">{{trans('properties.label_sort')}}</label>
                    <div class="col-xs-3 col-md-3">
                        <input type="number" id="property_sort" name="property_sort" data-ng-model="propertySort"
                               value="<% property.property_sort %>" size="3"
                               class="form-control">
                    </div>
                </div>


            </form>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
    <!-- Edit property -->
    <script type="text/ng-template" id="modalEditProperty.html">
        <div class="modal-header">
            <h3 class="modal-title">{{trans('properties.title_update_property')}}</h3>
        </div>
        <div class="modal-body">
            <form action="" data-ng-submit="$event.preventDefault();ok()" class="form-horizontal">


                <div class=" form-group">
                    <label for="<%property.id%>_ar"
                           class="control-label col-md-3">{{trans('properties.label_name_ar')}}</label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="property_name[ar]" data-ng-model="propertyNameAr"
                               id="<%property.id%>_ar"
                               value=""
                               placeholder="{{trans('categories.hint_enter_property')}}"/>
                    </div>

                </div>
                <div class=" form-group">
                    <label for="name_en"
                           class="control-label col-md-3">{{trans('properties.label_name_en')}}
                    </label>
                    <div class="col-md-7">
                        <input class="form-control" type="text" name="property_name[en][]"
                               data-ng-model="propertyNameEn"
                               id="name_en"
                               value=""
                               placeholder="{{trans('categories.hint_enter_property')}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="property_icon"
                           class="control-label col-md-3 col-xs-12">{{trans('properties.label_icon')}}</label>
                    <div class="col-md-7 col-xs-12">
                        <div class="input-group">
                         <span class="input-group-addon">
                               <ui-iconpicker
                                       groups="font-awesome" data-ng-model="propertyIcon"
                                       value="<%propertyIcon%>">
                                </ui-iconpicker>
                         </span>
                            <input type="text" class="form-control" id="property_icon" data-ng-model="propertyIcon"
                                   value="<%propertyIcon%>"
                                   name="property_icon[]"/>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label  col-md-3 col-xs-12">{{trans('properties.label_icon_size')}}</label>
                    <div class="col-md-3 col-xs-5">
                        <input type="number" name="icon_size[]" class="form-control" data-ng-model="propertyIconSize"
                               value="<% propertyIconSize%>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="property_sort"
                           class="control-label col-md-3 col-xs-12">{{trans('properties.label_sort')}}</label>
                    <div class="col-xs-3 col-md-3">
                        <input type="number" id="property_sort" name="property_sort" data-ng-model="propertySort"
                               value="<% propertySort %>" size="3"
                               class="form-control">
                    </div>
                </div>


            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
    <script type="text/ng-template" id="modalDeleteProperty.html">
        <div class="modal-body">
            {{trans('properties.confirm_delete_message')}}
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="ok()">{{trans('main.btn_confirm')}}</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">{{trans('main.btn_cancel')}}</button>
        </div>
    </script>

@stop
@section("scripts")
    <script>
        $(function () {
            $("#dataTable").DataTable();
        });
    </script>
@stop
