@extends('voyager::master')

@section('page_title', "Loreal Options")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-file-text"></i> Sio Reports 
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
                            <table id="dataTable" class="table-responsive table table-hover">
                                <thead>
                                    <tr>
                                      <th>N</th>
                                      <th>Type of Loreal Site</th>
                                      <th>Name of Loreal Site</th>
                                      <th>Person reporting the incident</th>
                                      
                                      <th>injured Person</th>
                                      <th>Date of the incident</th>
                                      <th>Between</th>
                                     
                                      <th>Created at</th>
                                      <th>Actions</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                              @foreach($data as $row) 
                                @php
                                $work_area_arr = json_decode($row->main_work_area, true);


                                @endphp
                                   <tr>
                                      <td>{{$loop->index + 1}}</td>
                                      <td>{{$row->type_loreal_site}}</td>
                                      <td>{{$row->name_loreal_site}}</td>
                                      <td>{{$row->incident_reporter_name}}</td>
                                      <td>{{$row->injured_person_name}}</td>
                                      <td>{{$row->incident_date}}</td>
                                      <td>{{$row->time_between}}</td>
                                     
                                      <td><code>{{\Carbon\Carbon::createFromTimeStamp(strtotime($row->created_at))->diffForHumans()}}</code></td>
                                      
                                      <td><a href="javascript:;" class="btn btn-primary" onclick="openIncidentReportModal('{{$row->id}}')">Show</a> <a href="{{route('incident_reports.destroy', $row->id)}}" class="btn btn-danger">Delete</a></td>
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
        function openIncidentReportModal(id, key = null){
            $.ajax({
                 method: 'GET',
                 url:'/admin/incident-reports/ajax/'+id+'/show'
                }).done(function (data) {
                 $("#showReportsModal").modal({show: true}).find(".modal-body").html(data.view); 

                }).fail(function () {
                    alert('Somthing Happenned !');
                });
        }

    </script>
@stop
