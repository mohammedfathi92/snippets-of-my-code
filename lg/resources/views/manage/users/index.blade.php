@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li class="active">{{trans("main.link_users")}}</li>
                </ol>
            </div>
            <div class="panel-body ">

                @if(Request::input('q'))
                    <p class="panel-title">{{trans('users.search_about')}}: <span
                                class="label label-warning">{{ Request::input('q') }}</span></p>
                @endif
                <div class="">
                    <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                           data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
                        <thead>
                        <tr>
                            <th>{{trans('users.avatar')}}</th>
                            <th>{{trans('users.name')}}</th>
                            <th>{{trans('users.email')}}</th>
                            <th>{{trans('users.permission')}}</th>
                            <th>{{trans('users.join_at')}}</th>

                            <th>
                                <a href="{{url('/manage/users/create')}}" class="btn btn-primary"><i
                                            class="site-menu-icon md-account-add"></i> {{trans("users.link_create")}}
                                </a>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr>
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
                                    <td>
                                        <a href="{{url("manage/users/{$row->id}/edit")}}" class="btn btn-warning">

                                            <i class="site-menu-icon md-edit"></i>
                                            {{trans('main.btn_edit')}}
                                        </a>
                                        <a href="{{url("manage/users/{$row->id}/delete")}}" class="btn btn-danger"
                                           onclick="return confirm('{{trans('users.message_confirm_delete')}}')">
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