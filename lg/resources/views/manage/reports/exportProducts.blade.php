@extends('layouts.export')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">

            <div class="panel-body ">

                <div class="">
                    <table class="tablesaw table-striped table-bordered" >
                        <thead>
                        <tr>
                            <th class="width-50">{{trans('products.id')}}</th>
                            <th class="width-200">{{trans('products.name')}}</th>
                            <th class="width-150">{{trans('products.category')}}</th>
                            <th class="width-100">{{trans('products.price')}}</th>
                            <th class="width-100">{{trans('products.sold_count')}}</th>
                            <th class="width-100">{{trans('products.opportunities_count')}}</th>
                            <th class="width-150">{{trans('products.updated_at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{!! $row->category->name !!}</td>
                                    <td>{{number_format($row->price,2)}} {{trans("products.currency_symbol") }}</td>
                                    <td>{{trans("products.count_times",['number'=>$row->soldCount])}} </td>
                                    <td>{{trans("products.count_opportunities",['number'=>count($row->validOpportunities)])}}</td>
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
