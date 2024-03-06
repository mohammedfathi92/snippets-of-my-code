<?php
/**sense*/ ?>

@extends('backend.layouts.master')
@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-lock"></i> {{trans("permissions.backend_page_header")}}
        <a href="/{{"$locale/$backend_uri"}}/permissions/create"  class="btn btn-success"><i class="fa fa-plus-circle"></i> {{trans("permissions.btn_add_new")}}</a>
    </h1>
@stop
@section("content")
    <div class="panel-body buttons-spacing-vertical">
        <p>
            <button type="submit"
                    onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"
                    form="tableForm" class="btn btn-danger"><i
                        class="fa fa-times"></i> {{trans("main.btn_delete")}}</button>
        </p>
    </div>
    <div class="page-content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <table class="table v-middle datatable">
                            <thead>
                            <tr>
                                <th width="20">
                                    <div class="checkbox checkbox-single margin-none">
                                        <input id="checkAll" data-toggle="check-all"
                                               data-target="#responsive-table-body" type="checkbox">
                                        <label for="checkAll">{{trans("main.label_check_all")}}</label>
                                    </div>
                                </th>
                                <th>{{trans("permissions.name")}}</th>
                                <th>{{trans("permissions.members")}}</th>
                                <th class="text-right">{{trans("main.options")}}</th>
                            </tr>
                            </thead>
                            <tbody id="responsive-table-body">
                            @if($data)
                                @foreach($data as $row)

                                    <tr>
                                        <td>
                                            <div class="checkbox checkbox-single">
                                                <input id="checkbox_{{$row->id}}" name="items[]" type="checkbox"
                                                       value="{{$row->id}}">
                                                <label for="checkbox_{{$row->id}}"></label>
                                            </div>
                                        </td>

                                        <td>{{ucfirst($row->name)}}</td>
                                        <td>{{$row->users()->count()}}</td>
                                        <td class="text-right no-sort no-click">

                                            <div class="btn-sm btn-danger pull-right delete" data-id="{{ $row->id }}"><i
                                                        class="fa fa-trash"></i> {{trans("main.btn_delete")}}
                                            </div>
                                            <a href="{{url("$locale/$backend_uri/permissions/{$row->id}/edit")}}"
                                               class="btn-sm btn-primary pull-right edit" data-toggle="tooltip"

                                               data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                        class="fa fa-pencil"></i> {{trans("main.btn_edit")}}</a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-trash-o"></i> {{trans("main.alert_delete_confirmation_title")}}</h4>
                </div>
                <div class="modal-body"><h5>{{trans("main.alert_delete_confirmation")}}?</h5></div>
                <div class="modal-footer">
                    <form action="{{"$locale/$backend_uri/permissions"}}" id="delete_form" name="deleteConfirmationForm" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" form="deleteConfirmationForm"
                               value="Confirm">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{trans("main.btn_cancel")}}</button>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/permissions' + '/' + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop