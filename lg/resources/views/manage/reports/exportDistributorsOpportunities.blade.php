@extends("layouts.export")
@section("content")
    @if($distributor)
        <h3>{{trans("opportunities.distributor_name_opportunities",['name'=>$distributor->name])}}</h3>
    @endif
    <div class="">
        <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
               data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
            <thead>
            <tr>
                <th class="width-50">{{trans('opportunities.id')}}</th>
                <th class="width-200">{{trans('opportunities.client_name')}}</th>
                <th class="width-100">{{trans('opportunities.products_count')}}</th>
                <th class="width-150">{{trans('opportunities.total_price')}}</th>
                <th class="width-50">{{trans('opportunities.status')}}</th>
                <th class="width-150">{{trans('opportunities.progress')}}</th>
                <th class="width-100">{{trans('opportunities.deliver_at')}}</th>
                <th class="width-100">{{trans('opportunities.created_at')}}</th>
                <th class="width-100">{{trans('opportunities.updated_at')}}</th>

            </tr>
            </thead>
            <tbody>
            @if($data and count($data))
                @foreach($data as $row)
                    <tr>
                        <td class="width-50">{{$row->id}}</td>
                        <td><b>{{$row->client_name}}</b>
                        </td>
                        <td>{{count($row->products)}}</td>
                        <td>{{number_format($row->total_price,2)}} {{trans("products.currency_symbol")}}</td>
                        <td>{{trans_choice("opportunities.status_options",$row->status)}}</td>
                        <td>
                            @if($row->status==1)
                                {{trans("opportunities.progress_complete",['value'=>$row->progress])}}
                            @endif
                        </td>
                        <td>{{$row->deliver_at}}</td>
                        <td>{{Carbon::instance($row->created_at)->diffForHumans()}}</td>
                        <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">

                        @if(Request::input('q'))
                            <p class="alert alert-warning text-center">
                                {{trans('opportunities.no_search_result')}}
                            </p>
                        @else
                            <p class="alert alert-warning text-center">
                                {{trans('opportunities.no_data')}}
                                ...
                                {!! Html::link("opportunities/create",trans("opportunities.link_create")) !!}
                            </p>
                        @endif
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection