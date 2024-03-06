<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 4:56 PM
 */ ?>

@extends('backend.layouts.master')
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-file-code-o"></i> {{trans("pages.backend_landing_page_header")}}
        <a href="{{url($locale.'/'.$backend_uri.'/landing-pages/create')}}" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>

@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-md-12 ">

                <div class="panel panel-default">
                    <div class="panel-body buttons-spacing-vertical">
                        <p>
                            {{-- @can('create builder') --}}
                                <a class="btn btn-primary"
                                   href="{{url(config("settings.backend_uri")."/landing-pages/create")}}"><i
                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</a>
                            {{-- @endcan --}}
                            @can('delete builder')
                                <button type="submit"
                                        onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"
                                        form="tableForm" class="btn btn-danger"><i
                                            class="fa fa-times"></i> {{trans("main.btn_delete")}}</button>
                            @endcan
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/landing-pages/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    @can('delete builder')
                                        <th width="20">
                                            <div class="checkbox checkbox-single margin-none">
                                                <input id="checkAll" data-toggle="check-all"
                                                       data-target="#responsive-table-body" type="checkbox">
                                                <label for="checkAll">{{trans("main.label_check_all")}}</label>
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{trans("pages.id")}}</th>
                                    <th>{{trans("pages.name")}}</th>
                                    <th>Builder (AR)</th>
                                    <th>Builder (EN)</th>
                                    <th>{{trans("pages.status")}}</th>
                                    <th>{{trans("pages.last_update")}}</th>
                                    <th class="text-right">{{trans("main.options")}}</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($data=\Sirb\LandingPage::all())
                                    @foreach($data as $row)

                                        <tr>
                                            @can('delete builder')
                                                <td>
                                                    <div class="checkbox checkbox-single">
                                                        <input id="checkbox_{{$row->id}}" name="items[]" type="checkbox"
                                                               value="{{$row->id}}">
                                                        <label for="checkbox_{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>{{$row->id}}</td>
                                            <td><a href="{{route('landing_page.user_show',['slug'=>$row->slug])}}"
                                                   target="_blank">{{$row->name}}</a></td>
                                            <td>{!! $row->{"lang_status:ar"}?Html::link("/$backend_uri/landing-pages/$row->id/build?lang=ar","Edit Page - AR",['class'=>'btn btn-success']):Html::link("$backend_uri/landing-pages/$row->id/build?lang=ar","Build Page - AR",['class'=>'btn btn-primary']) !!}</td>
                                            <td>{!! $row->{"lang_status:en"}?Html::link("$backend_uri/landing-pages/$row->id/build?lang=en","Edit Page - EN",['class'=>'btn btn-success']):Html::link("/$backend_uri/landing-pages/$row->id/build?lang=en","Build Page - EN",['class'=>'btn btn-primary']) !!}</td>

                                            <td>{!! $row->status?'<span class="label label-success">'.trans("pages.status_active").'</span>':'<span class="label label-danger">'.trans("pages.status_inactive").'</span>' !!}</td>
                                            <td>{!! \Carbon\Carbon::instance($row->updated_at)->diffForHumans() !!}</td>
                                            <td class="text-right">

                                                    <a href="{{route('landing_page.user_show',['slug'=>$row->slug])}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("pages.btn_show_page")}}"><i
                                                                class="fa fa-eye"></i></a>

                                                @can('create builder')
                                                    <a href="javascript:;"
                                                       class="copy_modal btn btn-default btn-xs"

                                                       page_id = "{{$row->id}}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("pages.btn_duplicate_page")}}"> <i
                                                                class="fa fa-copy"></i></a>
                                                @endcan
                                                @can('edit builder')
                                                    <a href="{{url("$locale/$backend_uri/landing-pages/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete builder')
                                                    <a href="{{url("$locale/$backend_uri/landing-pages/{$row->id}/delete")}}"
                                                       class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_delete")}}"
                                                       onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"><i
                                                                class="fa fa-times"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>
                        <!-- // Progress table -->

                    </div>
                </div>

            </div>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="myCopyPage" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">
    <form class="login-form" role="form" method="POST" action="{{ route('page.duplicate') }}">
                                {{ csrf_field() }}
          <div id="copyFormBody"></div>

       <center><button class="btn btn-primary" type="submit">{{trans('pages.btn_copy')}}</button></center>


   </form>
        </div>
      </div>

    </div>
  </div>

@endsection
@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();

            $('.copy_modal').click(function (e) {
            var pageId =  $(this).attr('page_id');
            $('#myCopyPage').modal('show');
            $('#copyFormBody').html('<input type="hidden" name="page_id" value=' +pageId+ '>');

  });

        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/builder' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop
