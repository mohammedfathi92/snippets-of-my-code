@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>

                    @if($parent)
                        <li><a href="{{url("/manage/club")}}">{{trans("main.link_club_management")}}</a></li>
                        <li><a href="{{url("manage/club/$parent->id")}}">{{$parent->name}}</a></li>
                    @else
                        <li class="active">{{trans("main.link_club_management")}}</li>
                    @endif

                </ol>
            </div>
            <div class="panel-body ">

                @if(Request::input('q'))
                    <p class="panel-title">{{trans('users.search_about')}}:
                        <span class="label label-warning">{{ Request::input('q') }}</span></p>
                @endif
                <div class="">
                    <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                           data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
                        <thead>
                        <tr>
                            <th>{{trans('levels.photo')}}</th>
                            <th>{{trans('levels.name')}}</th>
                            <th>{{trans('levels.members')}}</th>
                            <th>{{trans('levels.range')}}</th>
                            <th>
                                <a href="{{url($parent_id?"/manage/club/{$parent_id}/create":'/manage/club/create')}}"
                                   class="btn btn-primary"><i class="site-menu-icon md-account-add"></i>
                                    {{trans("levels.link_create")}}
                                </a>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
                                    <td>
                                        <div class="thumbnail">
                                            @if(Storage::disk('uploads')->has("small/".$row->photo))
                                                <img src="{{url("images/sm/".$row->photo)}}" class="img-thumbnail img-bordered"
                                                     alt="">
                                            @else
                                                <img src="/assets/images/no-product-image.jpg" class="img-thumbnail img-bordered"
                                                     alt="">
                                            @endif
                                        </div>
                                    </td>
                                    <td><a href="{{url("manage/club/$row->id")}}">{{$row->name}}</a></td>
                                    <td>{{count($row->members())}}</td>
                                    <td>{{$row->min ." - ". $row->target}}</td>
                                    <td>
                                        <a href="{{url("manage/club/{$row->id}/edit")}}" class="btn btn-warning">

                                            <i class="site-menu-icon md-edit"></i>
                                            {{trans('main.btn_edit')}}
                                        </a>
                                        <a href="{{url("manage/club/{$row->id}/delete")}}" class="btn btn-danger"
                                           onclick="return confirm('{{trans('levels.message_confirm_delete')}}')">
                                            <i class="site-menu-icon md-delete"></i>
                                            {{trans('main.btn_delete')}}</a>
                                    </td>
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
                                            {{trans('levels.no_data')}}
                                            ...
                                            {!! Html::link($parent_id?"/manage/club/{$parent_id}/create":'/manage/club/create',trans("levels.link_create")) !!}
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
        <!-- End Panel -->
    </div>
@endsection