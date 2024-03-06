@extends('backend.layout.master')

@section("page_header")
    <div class="content-header">
        <h1>
            Categories
            <small>{{$page_title}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/categories')}}"><i
                            class="fa fa-dashboard"></i> {{trans("categories.link_categories")}}</a></li>
            <li><a href="{{url('admin/categories')}}"><i class="fa fa-dashboard"></i> {{ $category->cat_title }}</a>
            </li>
            <li class="active">{{trans('filters.page_title')}}</li>
        </ol>

    </div>
@stop

@section("content")


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('filters.page_title')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" data-ng-controller="filtersCtrl">
                    <div class="">
                        <button class="btn btn-primary pull-right btn-lg"
                                data-ng-click="add('{{$category->id}}')">{{trans('main.btn_add')}}</button>
                        <div class="clearfix"></div>
                    </div>


                    <div class="panel-group" id="accordion" data-ng-init="getFilters('{{$category->id}}')">

                        <div class="panel panel-default" data-ng-repeat="filter in filters"
                             data-ng-if="filter.parent==0">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<%$index%>"><%filter.name%></a>
                                    <div class="pull-right">
                                        <a href="#" data-ng-click="add('{{$category->id}}',filter.id)"
                                           class="btn btn-primary btn-sm">{{trans('filters.btn_add_sub_filter')}}</a>
                                        <a href="#" data-ng-click="edit('{{$category->id}}',filter.id)"
                                           class="btn btn-primary btn-sm">{{trans('main.btn_edit')}}</a>
                                        <a href="#" data-ng-click="delete('{{$category->id}}',filter.id)"
                                           class="btn btn-danger btn-sm">{{trans('main.btn_delete')}}</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </h4>
                            </div>
                            <div id="collapse<%$index%>" class="panel-collapse collapse "
                                 data-ng-class="$index==0?'in':''">
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item" data-ng-repeat="sub in filters"
                                            data-ng-if="sub.parent==filter.id">
                                            <div class="row">
                                                <div class="col-md-8"><%sub.name%></div>
                                                <div class="col-md-4">
                                                    <a href="#" data-ng-click="edit('{{$category->id}}',sub.id)"
                                                       class="btn btn-primary">{{trans('main.btn_edit')}}</a>
                                                    <a href="#" data-ng-click="delete('{{$category->id}}',sub.id)"
                                                       class="btn btn-danger">{{trans('main.btn_delete')}}</a>
                                                </div>
                                            </div>


                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
    </div>

    <!-- The actual modal template, just a bit o bootstrap -->
    {{--add filter modal--}}
    <script type="text/ng-template" id="modalAddFilter.html">
        <div class="modal-header">
            <h3 class="modal-title">{{trans('filters.title_add_filter')}}</h3>
        </div>
        <div class="modal-body">
            <form action="" data-ng-submit="$event.preventDefault();ok()" class="form-horizontal">
                <div class="form-group">
                    <label for="name_ar"
                           class="control-label col-md-3 col-xs-12">{{trans('filters.label_filter_name_ar')}}</label>
                    <div class="col-md-9 col-md-12">
                        <input type="text" id="name_ar" name="filterName[ar]" ng-model="filterNameAr"
                               class="form-control">
                    </div>

                </div>
                <div class="form-group">
                    <label for="name_en"
                           class="control-label col-md-3 col-xs-12">{{trans('filters.label_filter_name_en')}}</label>
                    <div class="col-md-9 col-md-12">
                        <input type="text" id="name_en" name="filterName[en]" ng-model="filterNameEn"
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
    <!-- Edit Filter -->
    <script type="text/ng-template" id="modalEditFilter.html">
        <div class="modal-header">
            <h3 class="modal-title">{{trans('filters.title_edit_filter')}}</h3>
        </div>
        <div class="modal-body">
            <form action="" data-ng-submit="$event.preventDefault();ok()" class="form-horizontal">
                <div class="form-group">
                    <label for="name_ar"
                           class="control-label col-md-3 col-xs-12">{{trans('filters.label_filter_name_ar')}}</label>
                    <div class="col-md-9 col-md-12">
                        <input type="text" id="name_ar" name="filterName[ar]" ng-model="filterNameAr"
                               class="form-control" value="<%filterNameAr%>">
                    </div>

                </div>
                <div class="form-group">
                    <label for="name_en"
                           class="control-label col-md-3 col-xs-12">{{trans('filters.label_filter_name_en')}}</label>
                    <div class="col-md-9 col-md-12">
                        <input type="text" id="name_en" name="filterName[en]" ng-model="filterNameEn"
                               class="form-control" value="<%filterNameEn%>">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
    <script type="text/ng-template" id="modalDeleteFilter.html">
        <div class="modal-body">
            {{trans('filters.confirm_delete_message')}}
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