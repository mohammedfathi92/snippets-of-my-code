@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a href="{{url("/manage/reports")}}">{{trans("main.link_reports")}}</a></li>
                    <li class="active">{{trans("reports.link_distributors")}}</li>
                </ol>
            </div>
            <div class="panel-header">
                <div class="btn-toolbar container">
                    <div class="btn-group">
                        <a href="#"  export-data="print" class="btn btn-inverse " data-toggle="tooltip"
                           title="{{trans("main.tip_print")}}"><i class="fa fa-print"></i></a>
                        <a href="?{{http_build_query(Request::input())}}&export=excel"  target="_self"  class="btn btn-inverse " data-toggle="tooltip"
                           title="{{trans("main.tip_export_excel")}}"><i class="fa fa-file-excel-o"></i></a>
                        <a href="?{{http_build_query(Request::input())}}&export=pdf"  target="_self" class="btn btn-inverse " data-toggle="tooltip"
                           title="{{trans("main.tip_export_pdf")}}"><i class="fa fa-file-pdf-o"></i></a>
                    </div>

                </div>
            </div>
            <div class="panel-body ">
                @if(Request::input('q'))
                    <p class="panel-title">{{trans('categories.search_about')}}: <span
                                class="label label-warning">{{ Request::input('q') }}</span></p>
                @endif

                <div class="">
                    <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                           data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
                        <thead>
                        <tr>
                            <th>{{trans('users.id')}}</th>
                            <th>{{trans('users.avatar')}}</th>
                            <th>{{trans('users.name')}}</th>
                            <th>{{trans('users.email')}}</th>
                            <th>{{trans('users.permission')}}</th>
                            <th>{{trans('users.join_at')}}</th>


                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td >

                                        @if($row->avatar)
                                            <img style="width: 100px" src="{{url("images/sm/".$row->avatar)}}" alt="{{$row->name}}" class="img-thumbnail">
                                        @else
                                            <img style="width: 100px" src="{{asset("assets/images/default_avatar.jpg")}}" alt="{{$row->name}}" class="img-thumbnail">
                                        @endif

                                    </td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{trans_choice('users.permissions',$row->permission)}}</td>
                                    <td>{{Carbon::instance($row->created_at)->diffForHumans()}}</td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">

                                    @if(Request::input('q'))
                                        <p class="alert alert-warning text-center">
                                            {{trans('users.no_search_result')}}
                                        </p>
                                    @else
                                        <p class="alert alert-warning text-center">
                                            {{trans('users.no_data')}}
                                            ...
                                            {!! Html::link("/manage/users/create",trans("users.link_create")) !!}
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class=" align-left">
                    {!! $data->links() !!}
                </div>


            </div>
        </div>
        <!-- End Panel -->
    </div>
@endsection
