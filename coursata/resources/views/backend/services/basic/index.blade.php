<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 4:56 PM
 */ ?>

@extends('backend.layouts.master')
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-h-square"></i> {{trans("services.backend_page_header")}}
        <a href="#newServiceCollapse" data-toggle="collapse" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("services.btn_add_new")}}</a>
                   
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-offset-1 col-lg-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><a href="#newServiceCollapse"
                                                  data-toggle="collapse">{{trans("services.btn_add_new")}}</a>
                    </div>
                    <div class="panel-collapse collapse @if($errors->count()||(isset($method) && $method=='put')) in @endif"
                         id="newServiceCollapse">
                        @if($errors->count())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(['method'=>$method?:"post",'class'=>'form-horizontal']) !!}
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
                                                   class="col-sm-4 control-label">{{trans("services.label_name")}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                                       id="name"
                                                       placeholder=""
                                                       value="{{old("name.$localeCode",isset($data->{"name:$localeCode"})?$data->{"name:$localeCode"}:'')}}">
                                                @if ($errors->has("name.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("meals.$localeCode")?:"has-error"}} "
                                             data-ng-if="type=='house'">
                                            <label for="name"
                                                   class="col-sm-4 control-label">{{trans("services.label_meals")}}
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="meals[{{$localeCode}}]" class="form-control"
                                                       id="name"
                                                       placeholder=""
                                                       value="{{old("meals.$localeCode",isset($data->{"meals:$localeCode"})?$data->{"meals:$localeCode"}:'')}}">
                                                @if ($errors->has("meals.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("meals.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("room_type.$localeCode")?:"has-error"}} "
                                             data-ng-if="type=='house'">
                                            <label for="room_type"
                                                   class="col-sm-4 control-label">{{trans("services.label_room_type")}}
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="room_type[{{$localeCode}}]"
                                                       class="form-control"
                                                       id="room_type"
                                                       placeholder=""
                                                       value="{{old("room_type.$localeCode",isset($data->{"room_type:$localeCode"})?$data->{"room_type:$localeCode"}:'')}}">
                                                @if ($errors->has("room_type.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("room_type.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("transport_type.$localeCode")?:"has-error"}} "
                                             data-ng-if="type=='transport'">
                                            <label for="transport_type"
                                                   class="col-sm-4 control-label">{{trans("services.label_transport_type")}}
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="transport_type[{{$localeCode}}]"
                                                       class="form-control"
                                                       id="transport_type"
                                                       placeholder=""
                                                       value="{{old("transport_type.$localeCode",isset($data->{"transport_type:$localeCode"})?$data->{"transport_type:$localeCode"}:'')}}">
                                                @if ($errors->has("transport_type.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("transport_type.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}} ">
                                            <label for="description"
                                                   class="col-sm-4 control-label">{{trans("services.label_description")}}
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea name="description[{{$localeCode}}]"
                                                          class="form-control"
                                                          id="description"
                                                          placeholder=""
                                                          
                                                >{{old("description.$localeCode",isset($data->{"description:$localeCode"})?$data->{"description:$localeCode"}:'')}}</textarea>
                                                @if ($errors->has("description.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="type"
                                           class="control-label col-md-4">{{trans("services.label_type")}}</label>
                                    <div class="col-md-8">
                                        <select name="type" data-ng-model="type"
                                                data-ng-init="type='{{old("type",isset($data)?$data->type:'house')}}'"
                                                id="type" class="form-control">
                                            <option value="house" {{old("type",(isset($data)?$data->type:""))=="house"?'selected':''}}>{{trans("services.service_type_options.house")}}</option>
                                            <option value="transport" {{old("type",(isset($data)?$data->type:""))=="transport"?'selected':''}}>{{trans("services.service_type_options.transport")}}</option>
                                            <option value="insurance" {{old("type",(isset($data)?$data->type:""))=="insurance"?'selected':''}}>{{trans("services.service_type_options.insurance")}}</option>
                                            <option value="books" {{old("type",(isset($data)?$data->type:""))=="books"?'selected':''}}>{{trans("services.service_type_options.books")}}</option>
                                            <option value="advisor" {{old("type",(isset($data)?$data->type:""))=="advisor"?'selected':''}}>{{trans("services.service_type_options.advisor")}}</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6" data-ng-if="type=='house'">
                                    <label for="house_type"
                                           class="control-label col-md-4">{{trans("services.label_house_type")}}</label>
                                    <div class="col-md-8">
                                        <select name="house_type"
                                                id="house_type" class="form-control">
                                            <option value="students" {{old("house_type",(isset($data)?$data->house_type:""))=="students"?'selected':''}}>{{trans("services.service_house_type_options.students")}}</option>
                                            <option value="family" {{old("house_type",(isset($data)?$data->house_type:""))=="family"?'selected':''}}>{{trans("services.service_house_type_options.family")}}</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="sort"
                                           class="control-label col-md-4">{{trans("services.label_sort")}}</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" id="sort" min="1" name="sort" class="form-control"
                                                   value="{{old("sort",isset($data->sort)?$data->sort:1)}}">

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6" data-ng-if="type=='house'">
                                    <label for="min_age"
                                           class="control-label col-md-4">{{trans("services.label_min_age")}}</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" min="0" name="min_age" id="min_age"
                                                   class="form-control"
                                                   value="{{old("min_age",isset($data->min_age)?$data->min_age:1)}}">

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6 {{$errors->has("photo")?"has-error":''}}"
                                     data-ng-controller="backendUploaderCtrl"
                                     data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                                     data-resize="200,150"
                                     data-prefix="institute_"
                                >
                                    <label for=""
                                           class="col-md-3 control-label">{{trans("services.label_photo")}}</label>
                                    <div class="col-md-5">
                                        <div class="">
                                            @if(isset($data)&& $data->photo)
                                                <div class="thumbnail" id="file-{{$data->photo}}" data-ng-if="!photo">
                                                    <img src="{{url("files/{$data->photo}")}}" alt=""
                                                         class="responsive-img img-thumbnail">
                                                    <input type="hidden" name="photo" value="{{$data->photo}}">
                                                    <a href="javascript:;" class="btn btn-danger"
                                                       ng-click="removeByName('{{$data->photo}}')">{{trans("main.btn_delete")}}</a>
                                                </div>
                                            @endif
                                            <div ng-repeat="f in photos">
                                                <div class="thumbnail">
                                                    <img ng-show="form.photo.$valid" ngf-thumbnail="f"
                                                         class=" img-thumbnail">
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
                                                         ng-hide="f.progress==100"
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
                                        <div class="clearfix"></div>
                                        <a id="photo"
                                           class="btn btn btn-default"
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

                                    </div>
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="price"
                                           class="control-label col-md-4">{{trans("services.label_price")}}</label>
                                    <div class="col-md-8">
                                        <input type="number" step="0.001"
                                               name="price"
                                               value="{{old("price",isset($data)?$data->price:"")}}"
                                               min="0.0"
                                               class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fees"
                                           class="control-label col-md-4">{{trans("services.label_fees")}}</label>
                                    <div class="col-md-8">
                                        <input type="number" step="0.001"
                                               name="fees"
                                               value="{{old("fees",isset($data)?$data->fees:"")}}"
                                               min="0.0"
                                               class="form-control">

                                    </div>
                                </div>

                            </div>
                            <p class="alert alert-info">{!! trans("services.note_prices_currency_is_courses_currency") !!}</p>

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

            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-lg-8 col-md-offset-1 col-lg-offset-2 ">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/institutes/basic-services/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    <th>{{trans("services.id")}}</th>
                                    <th>{{trans("services.icon")}}</th>
                                    <th>{{trans("services.name")}}</th>
                                    <th>{{trans("services.sort")}}</th>
                                    <th>{{trans("services.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($services->count())
                                    @foreach($services as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{!! $row->icon_class?"<i class='fa $row->icon_class'></i> ".$row->icon_class :"" !!}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->sort}}</td>
                                            <td>{{\Carbon\Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                            <td class="text-right">
                                                @can('edit institutes')
                                                    <a href="{{url("$locale/$backend_uri/institutes/basic-services/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete institutes')
                                                    <a href="{{url("$locale/$backend_uri/institutes/basic-services/{$row->id}/delete")}}"
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
@stop
@section('javascript')
    <!-- DataTables -->
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/institutes' + '/' + id);

            $('#delete_modal').modal('show');
        });
        $('.icon-picker').iconpicker();
    </script>
@stop