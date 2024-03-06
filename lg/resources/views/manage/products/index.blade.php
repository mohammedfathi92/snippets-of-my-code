@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    @if(Request::input('category'))
                        <li><a href="{{url("/manage/categories")}}">{{trans("main.link_categories")}}</a></li>
                        {{--                        <li><a href="{{url("/manage/categories/".Request::input('category')."/edit")}}">{{$category->name}}</a></li>--}}
                        <li class="active">{{$category->name}}</li>
                    @else
                        <li class="active">{{trans("products.link_list_all")}}</li>
                    @endif
                </ol>
            </div>
            <div class="panel-body ">

                <div class="">
                    <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                           data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
                        <thead>
                        <tr>
                            <th style="width:10%">Photo</th>

                            <th>{{trans('products.name')}}</th>
                            <th>{{trans('products.category')}}</th>
                            <th>{{trans('products.price')}}</th>
                            <th>{{trans('products.updated_at')}}</th>
                            <th>
                                <a href="{{url('/manage/products/create'.(Request::input('category')?"?category=".Request::input('category'):''))}}"
                                   class="btn btn-primary"><i
                                            class="site-menu-icon md-plus"></i> {{trans("products.link_create")}}</a>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>
                                        <div class="thumbnail">
                                            @if($row->photo && Storage::disk('uploads')->has("small/".$row->photo))
                                                <img src="{{url("images/sm/".$row->photo)}}" class="img-thumbnail img-bordered"
                                                     alt="">
                                            @else
                                                <img src="/assets/images/no-product-image.jpg" class="img-thumbnail img-bordered"
                                                     alt="">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$row->name}}</td>
                                    <td>{!! Html::link("/manage/products/?category={$row->category->id}",$row->category->name) !!}</td>
                                    <td>
                                        @if($row->promotion)
                                            <span style="text-decoration: line-through;color:red">
                                                <%"{{$row->price}}
                                                "|number:2 %> {{trans("products.currency_symbol") }}</span>
                                            <br>
                                            <%"{{$row->promotion}}"|number:2 %> {{trans("products.currency_symbol") }}
                                        @else
                                            <%"{{$row->price}}"|number:2 %> {{trans("products.currency_symbol") }}
                                        @endif

                                    </td>
                                    <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{url("manage/products/{$row->id}/edit")}}" class="btn btn-warning">
                                            <i class="site-menu-icon md-edit"></i>
                                            {{trans('main.btn_edit')}}</a>
                                        <a href="{{url("manage/products/{$row->id}/delete")}}"
                                           onclick="return confirm('{{trans('products.message_confirm_delete')}}')"
                                           class="btn btn-danger">
                                            <i class="site-menu-icon md-delete"></i>
                                            {{trans('main.btn_delete')}}</a>
                                    </td>
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