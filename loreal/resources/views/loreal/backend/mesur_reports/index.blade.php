@extends('voyager::master')

@section('page_title', "Loreal Options")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-file-text"></i>  Mesur Reports
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
                                      <th>Leader: Mngr. n+1 / Mentor m</th>
                                      <th>Co-Leader: Direct report, n</th>
                                      <th>Person Visited</th>
                                      <th>Date of Visit</th>
                                      <th>Visited Area</th>
                                      <th>Created at</th>
                                      <th>Actions</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                              @foreach($data as $row) 
                            
                                   <tr>
                                      <td>{{$loop->index + 1}}</td>
                                      <td>{{$row->leader}}</td>
                                      <td>{{$row->co_leader}}</td>
                                      <td>{{$row->person_visited}}</td>
                                      <td>{{$row->visit_date}}</td>
                                       <td>{{$row->visited_area}}</td>
                                      
                                      <td><code>{{\Carbon\Carbon::createFromTimeStamp(strtotime($row->created_at))->diffForHumans()}}</code></td>
                                      
                                      <td><a href="javascript:;" class="btn btn-primary" onclick="openMesurReportModal('{{$row->id}}')">Show</a> <a href="{{route('mesur_reports.destroy', $row->id)}}" class="btn btn-danger">Delete</a></td>
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
        function openMesurReportModal(id, key = null){
            $.ajax({
                 method: 'GET',
                 url:'/admin/mesur-reports/ajax/'+id+'/show'
                }).done(function (data) {
                 $("#showReportsModal").modal({show: true}).find(".modal-body").html(data.view); 

                }).fail(function () {
                    alert('Somthing Happenned !');
                });
        }

    </script>
@stop
