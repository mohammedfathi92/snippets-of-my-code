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
        <i class="fa fa-bed"></i> {{trans("rooms_services.backend_page_header")}}
        <a href="#newServiceCollapse" data-toggle="collapse" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("hotels_services.btn_add_new")}}</a>
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-offset-1 col-lg-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><a href="#newServiceCollapse" data-toggle="collapse">{{trans("hotels_services.btn_add_new")}}</a></div>
                    <div class="panel-collapse collapse @if($errors->count()||(isset($method) && $method=='put')) in @endif"
                         id="newServiceCollapse">
                        {!! Form::open(['method'=>$method?:"post"]) !!}
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
                            <input type="hidden" name="_method" value="post">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div role="tabpanel" class="tab-pane {{$loop->index==0?"active":""}}"
                                         id="lang-{{$localeCode}}">
                                        <div class="form-group {{!$errors->has("name.$localeCode")?:"has-error"}} ">
                                            <label for="name"
                                                   class="col-sm-4 control-label">{{trans("hotels_services.label_name")}}
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
                                    </div>
                                @endforeach

                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="form-group">
                                <label for="icon_class"
                                       class="control-label col-md-3">{{trans("hotels_services.label_icon")}}</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" name="icon" class="form-control icon-picker"
                                               value="{{old("icon",isset($data->icon_class)?$data->icon_class:'')}}">
                                        <span class="input-group-addon"><i class="fa fa-adn"></i></span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon_class"
                                       class="control-label col-md-3">{{trans("hotels_services.label_sort")}}</label>
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

            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-lg-8 col-md-offset-1 col-lg-offset-2 ">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/hotels/rooms/services/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    <th>{{trans("hotels_services.id")}}</th>
                                    <th>{{trans("hotels_services.icon")}}</th>
                                    <th>{{trans("hotels_services.name")}}</th>
                                    <th>{{trans("hotels_services.sort")}}</th>
                                    <th>{{trans("hotels_services.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($services=App\RoomService::all())
                                    @foreach($services as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{!! $row->icon_class?"<i class='fa $row->icon_class'></i> ".$row->icon_class :"" !!}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->sort}}</td>
                                            <td>{{\Carbon\Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                            <td class="text-right">
                                                @can('edit hotels')
                                                    <a href="{{url("$locale/$backend_uri/hotels/rooms/services/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete hotels')
                                                    <a href="{{url("$locale/$backend_uri/hotels/rooms/services/{$row->id}/delete")}}"
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