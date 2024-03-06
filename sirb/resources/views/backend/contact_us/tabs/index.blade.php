<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 4:56 PM
 */ ?>

@extends('backend.layouts.master')
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-envira"></i> {{trans("tabs.backend_page_header")}}
        <a href="#newTabCollapse" data-toggle="collapse" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("tabs.btn_add_new")}}</a>
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="container">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="#newTabCollapse" data-toggle="collapse">{{trans("tabs.add_tab")}}</a></div>
                    <div class="panel-collapse collapse @if($errors->count()||(isset($method) && $method=='put') || Request::segment(8)) in @endif"
                         id="newTabCollapse">
                        {!! Form::open(['method'=>$method?:"post"]) !!}
                        <div class="panel-body">
                            @if($errors->count())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
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
                                            <label for="name"
                                                   class="col-sm-4 control-label">{{trans("tabs.label_title")}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title[{{$localeCode}}]" class="form-control"
                                                       id="title"
                                                       placeholder=""
                                                       value="{{old("title.$localeCode",isset($data->{"title:$localeCode"})?$data->{"title:$localeCode"}:'')}}">
                                                @if ($errors->has("title.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}} ">
                                            <label for="description_{{$localeCode}}"
                                                   class="col-sm-4 control-label">{{trans("tabs.label_description")}}</label>
                                            <div class="col-sm-8">
                                                <textarea name="description[{{$localeCode}}]"
                                                          class="form-control ckeditor" id="description_{{$localeCode}}"
                                                          placeholder="">{{old("description.$localeCode",isset($data->{"description:$localeCode"})?$data->{"description:$localeCode"}:'')}}</textarea>
                                                @if ($errors->has("title.$localeCode"))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="clearfix"></div>
                            </div>

                            <hr>
                            <div class="form-group {{$errors->has("photo")?"has-error":''}}"
                                 data-ng-controller="backendUploaderCtrl"
                                 data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                                 data-resize="200,150"
                                 data-prefix="articleTab_">
                                <label for="photo"
                                       class="control-label col-md-3">{{trans("tabs.label_photo")}}</label>
                                <div class="col-md-3">
                                    <a id="photo"
                                       class="btn btn-default form-control btn btn-default"
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
                                    <div class="clearfix"></div>
                                    <div class="">
                                        @if(isset($data) && $data->photo )
                                            <div class="thumbnail" id="file-{{$data->photo}}">
                                                <img class="img-thumbnail" src="/files/small/{{$data->photo}}">
                                                <input type="hidden" name="old_photo" value="{{$data->photo}}">
                                                <a href="javascript:;" class="btn btn-danger"
                                                   ng-click="removeByName('{{$data->photo}}')"
                                                >{{trans("main.btn_delete")}}</a>
                                            </div>
                                        @endif
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
                            <div class="form-group">
                                <label for="icon_class"
                                       class="control-label col-md-3">{{trans("tabs.label_sort")}}</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                        <input type="number" min="1" name="sort" class="form-control"
                                               value="{{old("sort",isset($data->sort)?$data->sort:1)}}">

                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>


                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary" type="submit">{{trans("main.btn_save")}}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/hotels/services/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    <th>{{trans("tabs.id")}}</th>
                                    <th>{{trans("tabs.photo")}}</th>
                                    <th>{{trans("tabs.title")}}</th>
                                    <th>{{trans("tabs.sort")}}</th>
                                    <th>{{trans("tabs.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($article->tabs()->count())
                                    @foreach($article->tabs as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                @if($row->photo && Storage::disk('public')->exists(config('settings.upload_dir')."/".$row->photo))
                                                    <img src="/files/small/{{$row->photo}}" alt="" width="100">
                                                @endif

                                            </td>
                                            <td>{{$row->title}}</td>
                                            <td>{{$row->sort}}</td>
                                            <td>{{\Carbon\Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                            <td class="text-right">
                                                @can('edit messages')
                                                    <a href="{{url("$locale/$backend_uri/messages/$article->id/tabs/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete messages')
                                                    <a href="{{url("$locale/$backend_uri/messages/$article->id/messages/tabs/{$row->id}/delete")}}"
                                                       class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_delete")}}"
                                                       onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"><i
                                                                class="fa fa-times"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>
                        <!-- // Progress table -->

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">
@endsection
@section('javascript')
    <!-- DataTables -->
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/hotels' + '/' + id);

            $('#delete_modal').modal('show');
        });
        $('.icon-picker').iconpicker();
    </script>
@stop