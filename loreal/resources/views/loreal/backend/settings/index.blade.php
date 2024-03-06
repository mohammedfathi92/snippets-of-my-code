@extends('voyager::master')

@section('page_title', "Loreal Options")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=""></i> 
        </h1>

    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                      <th>N</th>
                                      <th>Name</th>
                                      <th>Code</th>
                                      <th>Action</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                              @foreach($data as $row)      
                                   <tr>
                                      <td>{{$loop->index + 1}}</td>
                                      <td>{{$row->label}}</td>
                                      <td><code>{{$row->code}}</code></td>
                                      <td><a href="javascript:;" class="btn btn-danger" onclick="openSettingsModal('{{$row->id}}', '{{$row->code}}')">Edit</a></td>
                                    </tr>
                               @endforeach     
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('loreal.backend.settings.partials.modal')
@stop

@section('css')

@stop

@section('javascript')
    <script>
        $(document).ready(function () {
          
         $('#dataTable').DataTable();
           
        });
    </script>

    <script>
        function openSettingsModal(id, key = null){
            $.ajax({
                 method: 'GET',
                 url:'/admin/loreal-settings/ajax/'+id+'/'+key+'/get-options'
                }).done(function (data) {
                 $("#editLorealSettingsModal").modal({show: true}).find(".modal-body").html(data.view); 

                }).fail(function () {
                    alert('Somthing Happenned !');
                });
        }

    </script>
@stop
