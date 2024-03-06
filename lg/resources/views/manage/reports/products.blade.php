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
                    <li class="active">{{trans("reports.link_products_reports")}}</li>
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
                            <th class="width-50">{{trans('products.id')}}</th>
                            <th class="width-150" style="width:10%">#</th>

                            <th class="width-200">{{trans('products.name')}}</th>
                            <th class="width-150">{{trans('products.category')}}</th>
                            <th class="width-100">{{trans('products.price')}}</th>
                            <th class="width-100">{{trans('products.sold_count')}}</th>
                            <th class="width-100">{{trans('products.opportunities_count')}}</th>
                            <th class="width-150">{{trans('products.updated_at')}}</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>
                                        <div class="thumbnail">
                                            <img src="{{url("images/sm/".$row->photo)}}" class=" img-bordered" alt="">
                                        </div>
                                    </td>

                                    <td>{{$row->name}}</td>
                                    <td>{!! Html::link("/manage/products/?category={$row->category->id}",$row->category->name) !!}</td>
                                    <td><%"{{$row->price}}"|number:2 %> {{trans("products.currency_symbol") }}</td>
                                    <td>{{trans("products.count_times",['number'=>$row->soldCount])}} </td>
                                    <td><a href="{{url("manage/reports/product/$row->id/opportunities")}}"
                                           class="label label-default">{{trans("products.count_opportunities",['number'=>count($row->validOpportunities)])}}</a>
                                    </td>
                                    <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    @if(Request::input('q'))
                                        <p class="alert alert-warning text-center">
                                            {{trans('products.no_search_result')}}
                                        </p>
                                    @else
                                        <p class="alert alert-warning text-center">
                                            {{trans('products.no_data')}}
                                            ...
                                            {!! Html::link("/manage/products/create".(Request::input('category')?"?category=".Request::input('category'):''),trans("products.link_create")) !!}
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
