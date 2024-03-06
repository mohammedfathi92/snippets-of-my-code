@extends("layouts.app")

@section("header-links")
    <link rel="stylesheet" href="/css/profile.min.css">
@endsection
@section("content")
    <div class="row page-profile">

        <div class="panel">
            <ol class="breadcrumb">
                <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                @if(Auth::user()->id == $data->id)
                    <li class="active">{{trans("users.link_profile")}}</li>
                @else
                    <li class="active">{{$data->name}} <span
                                class="label label-default">{{trans("users.link_profile")}}</span></li>
                @endif
            </ol>
        </div>

        <div class="col-md-3">
            <!-- Page Widget -->
            <div class="widget widget-shadow text-center">
                <div class="widget-header">
                    <div class="widget-header-content">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                            @if($data->avatar)
                                <img src="{{url("images/sm/".$data->avatar)}}" alt="{{$data->name}}">
                            @else
                                <img src="/assets/images/default_avatar.jpg" alt="{{$data->name}}">
                            @endif
                        </a>
                        <h4 class="profile-user">{{$data->name}}</h4>

                        @if($data->job)
                            <p class="profile-job">{{$data->job}}</p>
                        @endif
                        @if($data->about)
                            <p>{{$data->about}}</p>
                        @endif
                        @if($data->email)
                            <div class="profile-social">{{$data->email}}<br/></div>
                        @endif
                        @if($data->mobile)
                            <div class="profile-social">{{$data->mobile}}<br/></div>
                        @endif
                        @if($data->phone)
                            <div class="profile-social">{{$data->phone}}<br/></div>
                        @endif
                        @if(Auth::user()->id==$data->id)
                            <a href="{{url("account")}}"
                               class="btn btn-primary">{{trans("users.btn_edit_profile")}}</a>
                        @endif
                    </div>
                </div>
                <div class="widget-footer">
                    <div class="row no-space">
                        <div class="col-xs-4">
                            <strong class="profile-stat-count green-600">{{$leadsCount}}</strong>
                            <span class="green-600">{{trans("main.text_leads")}}</span>
                        </div>
                        <div class="col-xs-4">
                            <strong class="profile-stat-count blue-600">{{$openCount}}</strong>
                            <span class="blue-600">{{trans("main.text_opportunities")}}</span>
                        </div>
                        <div class="col-xs-4">
                            <strong class="profile-stat-count orange-600">{{$canceledCount}}</strong>
                            <span class="orange-600">{{trans("main.text_canceled")}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Widget -->
        </div>
        <div class="col-md-9">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body nav-tabs-animate nav-tabs-horizontal">
                    <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                        <li class="active" role="presentation">
                            <a class="lisp" data-toggle="tab"
                               href="#activities"
                               aria-controls="activities"
                               role="tab">{{trans("main.text_opportunities")}}
                                <span
                                        class="badge badge-info">{{$allCount}}</span></a></li>

                        <li class="" role="presentation">
                            <a class="lisp" data-toggle="tab" href="#leads"
                               aria-controls="leads"
                               role="tab">{{trans("main.text_leads")}}</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active animation-slide-left" id="activities" role="tabpanel">
                            <br/>
                            <div class="">
                                <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                                       data-tablesaw-mode-switch data-tablesaw-minimap
                                       data-tablesaw-mode-exclude="columntoggle">
                                    <thead>
                                    <tr>
                                        <th class="width-50">{{trans('opportunities.id')}}</th>
                                        <th>{{trans('opportunities.client_name')}}</th>
                                        <th class="width-100">{{trans('opportunities.products_count')}}</th>
                                        <th class="width-150">{{trans('opportunities.total_price')}}</th>
                                        <th class="width-50">{{trans('opportunities.status')}}</th>
                                        <th class="width-150">{{trans('opportunities.progress')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($opportunities and count($opportunities))
                                        @foreach($opportunities as $row)
                                            <tr>
                                                <td>{{$row->id}}</td>
                                                <td>
                                                    <a href="{{url("opportunities/{$row->id}/show")}}">{{$row->client_name}}</a>
                                                </td>
                                                <td>{{count($row->products)}}</td>
                                                <td><%{{$row->total_price}}
                                                    |number:2%> {{trans("products.currency_symbol")}}</td>
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
                            <div class=" align-left">
                                {!! $opportunities->links() !!}
                            </div>


                        </div>

                        <div class="tab-pane animation-slide-left" id="leads" role="tabpanel">
                            <br/>
                            <div class="">
                                <table class="tablesaw table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="width-50">{{trans('opportunities.id')}}</th>
                                        <th>{{trans('opportunities.client_name')}}</th>
                                        <th class="width-100">{{trans('opportunities.products_count')}}</th>
                                        <th class="width-150">{{trans('opportunities.total_price')}}</th>
                                        <th class="width-50">{{trans('opportunities.status')}}</th>
                                        <th class="width-150">{{trans('opportunities.progress')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($leadsOpportunities and count($leadsOpportunities))
                                        @foreach($leadsOpportunities as $row)
                                            <tr>
                                                <td>{{$row->id}}</td>
                                                <td>
                                                    <a href="{{url("opportunities/{$row->id}/show")}}">{{$row->client_name}}</a>
                                                </td>
                                                <td>{{count($row->products)}}</td>
                                                <td><%{{$row->total_price}}
                                                    |number:2%> {{trans("products.currency_symbol")}}</td>
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



                        </div>

                    </div>
                </div>
            </div>
            <!-- End Panel -->

        </div>
    </div>
@endsection