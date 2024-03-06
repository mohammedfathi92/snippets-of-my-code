<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 11/9/16
 * Time: 11:31 PM
 */
?>
@extends('backend.layouts.master')

@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-group"></i> {{trans("users.backend_page_header")}} <a
                href="/{{"$locale/$backend_uri"}}/users/create"
                class="btn btn-success"><i class="fa fa-plus-circle"></i> {{trans("users.btn_add_new")}}</a>
    </h1>
@stop



@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th width="100px">Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Join Since</th>
                                <th class="actions">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>
                                    <td>
                                        <div class="thumbnail">
                                            @if($row->avatar)
                                                <img src="{{Storage::url($row->avatar)}}" alt="Avatar"
                                                     class="img-responsive">
                                            @else
                                                <img src="/images/default-avatar.jpg" alt="Avatar"
                                                     class="img-responsive ">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{\Carbon\Carbon::instance($row->created_at)->diffForHumans()}}</td>
                                    <td class="no-sort no-click">
                                        <div class="btn-sm btn-danger pull-right delete" data-id="{{ $row->id }}"><i
                                                    class="fa fa-trash"></i> Delete
                                        </div>
                                        <a href="/{{"$locale/$backend_uri/users/{$row->id}/edit"}}"
                                           class="btn-sm btn-primary pull-right edit"><i class="fa fa-edit"></i>
                                            Edit</a> {{--<a href="{{"$backend_uri/users/{$row->id}/view"}}"
                                                        class="btn-sm btn-warning pull-right"><i class="fa fa-eye"></i>
                                            View</a>--}}</td>
                                </tr>
                            @endforeach
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
                    <h4 class="modal-title"><i
                                class="fa fa-trash-o"></i> {{trans("main.alert_delete_confirmation_title")}}</h4>
                </div>
                <div class="modal-body"><h5>{{trans("main.alert_delete_confirmation")}}?</h5></div>
                <div class="modal-footer">
                    <form action="{{"$locale/$backend_uri/users"}}" id="delete_form" name="deleteConfirmationForm"
                          method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               {{--form="deleteConfirmationForm"--}}
                               value="Confirm">
                        <button type="button" class="btn btn-default pull-right"
                                data-dismiss="modal">{{trans("main.btn_cancel")}}</button>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    <!-- DataTables -->

    <script>

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $('.delete').click(function (e) {
            var id = $(this).data('id');
            $('#delete_form').attr('action', "/{{$locale."/".$backend_uri}}/users/" + id);

            $('#delete_modal').modal('show');
        });


    </script>
@stop
