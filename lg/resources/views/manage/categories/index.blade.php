@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li class="active">{{trans("main.link_categories")}}</li>
                </ol>
            </div>
            <div class="panel-body ">

                @if(Request::input('q'))
                    <p class="panel-title">{{trans('categories.search_about')}}: <span class="label label-warning">{{ Request::input('q') }}</span></p>
                @endif
                <div class="">
                    <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                           data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
                        <thead>
                        <tr>
                            <th>{{trans('categories.id')}}</th>
                            <th>{{trans('categories.name')}}</th>
                            <th>{{trans('categories.products_count')}}</th>
                            <th>{{trans('categories.updated_at')}}</th>
                            <th>
                                <a href="{{url('/manage/categories/create')}}" class="btn btn-primary"><i
                                            class="site-menu-icon md-plus"></i> {{trans("categories.link_create")}}</a>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{!! count($row->products)>0?Html::link("/manage/products/?category={$row->id}",count($row->products),['class'=>'label label-warning']):Html::link("/manage/products/create?category={$row->id}",trans("products.link_create")) !!}</td>
                                    <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url("manage/categories/{$row->id}/edit")}}" class="btn btn-warning">
                                            <i class="site-menu-icon md-edit"></i>
                                            {{trans('main.btn_edit')}}</a>
                                        <a href="{{url("manage/categories/{$row->id}/delete")}}" class="btn btn-danger"
                                           onclick="return confirm('{{trans('categories.message_confirm_delete')}}')">
                                            <i class="site-menu-icon md-delete"></i>
                                            {{trans('main.btn_delete')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">

                                    @if(Request::input('q'))
                                        <p class="alert alert-warning text-center">
                                            {{trans('categories.no_search_result')}}
                                        </p>
                                    @else
                                        <p class="alert alert-warning text-center">
                                            {{trans('categories.no_data')}}
                                            ...
                                            {!! Html::link("/manage/categories/create",trans("categories.link_create")) !!}
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