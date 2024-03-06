@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li class="active">{{trans("main.link_opportunities")}}</li>
                </ol>
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
                            <th class="width-50">{{trans('opportunities.id')}}</th>
                            <th class="width-200">{{trans('opportunities.client_name')}}</th>
                            <th class="width-200">{{trans('opportunities.distributor_name')}}</th>
                            <th class="width-100">{{trans('opportunities.products_count')}}</th>
                            <th class="width-150">{{trans('opportunities.total_price')}}</th>
                            <th class="width-100">{{trans('opportunities.status')}}</th>
                            <th class="width-150">{{trans('opportunities.progress')}}</th>
                            <th class="width-100">{{trans('opportunities.deliver_at')}}</th>
                            <th class="width-100">{{trans('opportunities.created_at')}}</th>
                            <th class="width-100">{{trans('opportunities.updated_at')}}</th>
                            <th class="width-200">
                                <a href="{{url('manage/opportunities/create')}}" class="btn btn-primary"><i
                                            class="site-menu-icon md-plus"></i> {{trans("opportunities.link_create")}}
                                </a>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td class="width-50">{{$row->id}}</td>
                                    <td><a href="{{url("manage/opportunities/{$row->id}/show")}}">{{$row->client_name}}</a></td>
                                    <td><a href="{{url("profile/{$row->user->id}")}}">{{$row->user->name}}</a></td>
                                    <td>{{count($row->products)}}</td>
                                    <td><%{{$row->total_price}}|number:2%> {{trans("products.currency_symbol")}}</td>
                                    <td>{!! "<span class='label label-".trans_choice("opportunities.status_colors",$row->status)."' >".trans_choice("opportunities.status_options",$row->status)."</span>" !!}</td>
                                    <td>
                                        @if($row->status==1)
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                     aria-valuenow="{{$row->progress}}"
                                                     aria-valuemin="0" aria-valuemax="100"
                                                     style="width:{{$row->progress}}%">
                                                    <span class=""> {{trans("opportunities.progress_complete",['value'=>$row->progress])}}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{$row->deliver_at}}</td>
                                    <td>{{Carbon::instance($row->created_at)->diffForHumans()}}</td>
                                    <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url("manage/opportunities/{$row->id}/show")}}" class="btn btn-warning">
                                            <i class="site-menu-icon md-eye"></i>
                                            {{trans('main.btn_show')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11">

                                    @if(Request::input('q'))
                                        <p class="alert alert-warning text-center">
                                            {{trans('opportunities.no_search_result')}}
                                        </p>
                                    @else
                                        <p class="alert alert-warning text-center">
                                            {{trans('opportunities.no_data')}}
                                            ...
                                            {!! Html::link("manage/opportunities/create",trans("opportunities.link_create")) !!}
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
