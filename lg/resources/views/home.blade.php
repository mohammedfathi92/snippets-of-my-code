@extends('layouts.app')

@section('content')
    <div class="row">



        @if(Request::input('q'))
            <p class="panel-title">{{trans('categories.search_about')}}: <span
                        class="label label-warning">{{ Request::input('q') }}</span></p>
        @endif

        <div class="col-md-6 col-xs-12">
            @if($opportunities and count($opportunities))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.latest_opportunities")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>

                                        <th class="width-200">{{trans('opportunities.client_name')}}</th>
                                        @if(Auth::user()->permission < 2)
                                            <th class="width-100">{{trans('opportunities.distributor_name')}}</th>
                                        @endif
                                        <th class="width-150">{{trans('opportunities.total_price')}}</th>
                                        <th class="width-100">{{trans('opportunities.status')}}</th>
                                        <th class="width-100">{{trans('opportunities.updated_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($opportunities as $row)
                                        <tr>
                                            <td>
                                                <a href="{{url("opportunities/{$row->id}/show")}}">{{$row->client_name}}</a>
                                            </td>
                                            @if(Auth::user()->permission < 2)
                                                <td>{!! Html::link('profile/'.$row->user_id,$row->user->name) !!}</td>
                                            @endif
                                            <td><%{{$row->total_price}}
                                                |number:2%> {{trans("products.currency_symbol")}}</td>
                                            <td>{!! "<span class='label label-".trans_choice("opportunities.status_colors",$row->status)."' >".trans_choice("opportunities.status_options",$row->status)."</span>" !!}</td>
                                            <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>

                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($wonProjects && count($wonProjects))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.won_projects")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>

                                        <th class="width-200">{{trans('opportunities.client_name')}}</th>
                                        @if(Auth::user()->permission < 2)
                                            <th class="width-100">{{trans('opportunities.distributor_name')}}</th>
                                        @endif
                                        <th class="width-150">{{trans('opportunities.total_price')}}</th>
                                        <th class="width-100">{{trans('opportunities.status')}}</th>
                                        <th class="width-100">{{trans('opportunities.updated_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($wonProjects as $row)
                                        <tr>
                                            <td>
                                                <a href="{{url("opportunities/{$row->id}/show")}}">{{$row->client_name}}</a>
                                            </td>
                                            @if(Auth::user()->permission < 2)
                                                <td>{!! Html::link('profile/'.$row->user_id,$row->user->name) !!}</td>
                                            @endif

                                            <td><%{{$row->total_price}}
                                                |number:2%> {{trans("products.currency_symbol")}}</td>
                                            <td>{!! "<span class='label label-".trans_choice("opportunities.status_colors",$row->status)."' >".trans_choice("opportunities.status_options",$row->status)."</span>" !!}</td>
                                            <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>

                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($leads && count($leads))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.leads_projects")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>

                                        <th class="width-200">{{trans('opportunities.client_name')}}</th>
                                        @if(Auth::user()->permission < 2)
                                            <th class="width-100">{{trans('opportunities.distributor_name')}}</th>
                                        @endif
                                        <th class="width-150">{{trans('opportunities.total_price')}}</th>
                                        <th class="width-100">{{trans('opportunities.status')}}</th>
                                        <th class="width-100">{{trans('opportunities.updated_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($leads as $row)
                                        <tr>
                                            <td>
                                                <a href="{{url("opportunities/{$row->id}/show")}}">{{$row->client_name}}</a>
                                            </td>
                                            @if(Auth::user()->permission < 2)
                                                <td>{!! Html::link('profile/'.$row->user_id,$row->user->name) !!}</td>
                                            @endif

                                            <td><%{{$row->total_price}}
                                                |number:2%> {{trans("products.currency_symbol")}}</td>
                                            <td>{!! "<span class='label label-".trans_choice("opportunities.status_colors",$row->status)."' >".trans_choice("opportunities.status_options",$row->status)."</span>" !!}</td>
                                            <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>

                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($lostProjects && count($lostProjects))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.lost_projects")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>

                                        <th class="width-200">{{trans('opportunities.client_name')}}</th>
                                        @if(Auth::user()->permission < 2)
                                            <th class="width-100">{{trans('opportunities.distributor_name')}}</th>
                                        @endif
                                        <th class="width-150">{{trans('opportunities.total_price')}}</th>
                                        <th class="width-100">{{trans('opportunities.status')}}</th>
                                        <th class="width-100">{{trans('opportunities.updated_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($lostProjects as $row)
                                        <tr>
                                            <td>
                                                <a href="{{url("opportunities/{$row->id}/show")}}">{{$row->client_name}}</a>
                                            </td>
                                            @if(Auth::user()->permission < 2)
                                                <td>{!! Html::link('profile/'.$row->user_id,$row->user->name) !!}</td>
                                            @endif

                                            <td><%{{$row->total_price}}
                                                |number:2%> {{trans("products.currency_symbol")}}</td>
                                            <td>{!! "<span class='label label-".trans_choice("opportunities.status_colors",$row->status)."' >".trans_choice("opportunities.status_options",$row->status)."</span>" !!}</td>
                                            <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>

                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-6 col-xs-12">
            @if($products && count($products))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.latest_products")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>
                                        <th style="width:10%">#</th>
                                        <th>{{trans('products.name')}}</th>
                                        <th>{{trans('products.category')}}</th>
                                        <th>{{trans('products.price')}}</th>
                                        <th>{{trans('products.sold_count')}}</th>
                                        <th>{{trans('products.updated_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $row)
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
                                            <td>  @if($row->promotion)
                                                    <span style="text-decoration: line-through;color:red">
                                                <%"{{$row->price}}"|number:2 %> {{trans("products.currency_symbol") }}</span>
                                                    <br>
                                                    <%"{{$row->promotion}}"|number:2 %> {{trans("products.currency_symbol") }} </td>
                                            @else
                                                <%"{{$row->price}}"|number:2 %> {{trans("products.currency_symbol") }} </td>
                                                @endif</td>
                                            <td>{{trans("products.count_times",['number'=>$row->soldCount])}} </td>
                                            <td>{{Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($partners && count($partners))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.partners")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>
                                        <th>{{trans('users.avatar')}}</th>
                                        <th>{{trans('users.name')}}</th>
                                        <th>{{trans('users.email')}}</th>
                                        <th>{{trans('products.opportunities_count')}}</th>
                                        <th>{{trans('users.join_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($partners as $row)
                                        <tr>

                                            <td>
                                                <a href="{{url("profile/{$row->id}")}}">
                                                    @if($row->avatar)
                                                        <img style="width: 100px"
                                                             src="{{url("images/sm/".$row->avatar)}}"
                                                             alt="{{$row->name}}" class="img-thumbnail">
                                                    @else
                                                        <img style="width: 100px"
                                                             src="{{asset("assets/images/default_avatar.jpg")}}"
                                                             alt="{{$row->name}}" class="img-thumbnail">
                                                    @endif
                                                </a>
                                            </td>
                                            <td>{!! Html::link('profile/'.$row->id,$row->name) !!}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{count($row->opportunities)}}</td>
                                            <td>{{Carbon::instance($row->created_at)->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($messages && count($messages))
                <div class="">
                    <div class="panel">
                        <h3 class="panel-title">{{trans("home.messages")}}</h3>
                        <div class="panel-body">
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>
                                        <th>{{trans('contacts.from')}}</th>
                                        <th>{{trans('contacts.subject')}}</th>
                                        <th>{{trans('contacts.message')}}</th>
                                        <th>{{trans('contacts.sent_at')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($messages as $row)
                                        <tr class="{{!$row->opened?"alert alert-danger":""}}"
                                            style="{{!$row->opened?"background-color:rgba(255,205,210,.8)":""}}">
                                            <td>
                                                @if($row->opened)
                                                    <span> {{$row->sender->name}}</span>
                                                @else
                                                    <strong>{{$row->sender->name}}</strong>
                                                @endif
                                            </td>
                                            <td>{!! Html::link("manage/contacts/$row->id/message",str_limit($row->subject,100)) !!}</td>
                                            <td>{{str_limit($row->message,150)}}</td>
                                            <td>{{\Carbon\Carbon::instance($row->created_at)->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif





            @if(!(count($opportunities and Auth::user()->permission > 1) ))
                <div class="panel">
                    <div class="panel-body">
                        <h3>{!! trans("home.welcome_message",["name"=>Auth::user()->name]) !!}</h3>
                        <div class="well">
                            <p>{!! trans("home.dashboard_empty") !!}</p>
                        </div>

                    </div>
                </div>
            @endif
        </div>
@endsection
