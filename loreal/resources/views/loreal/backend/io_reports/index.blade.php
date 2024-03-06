@extends('voyager::master')

@section('page_title', "Loreal Options")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-file-text"></i> IO Reports 
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
                                      <th>r\Reporter Name</th>
                                      <th>Work Area</th>
                                      <th>Sub Work Area</th>
                                      <th>Created at</th>
                                      <th>Actions</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                              @foreach($data as $row) 
                                @php
                                $work_area_arr = json_decode($row->main_work_area, true);

                             $area = \App\Area::find($row->area_id);
                             $location = \App\Location::find($row->area_id);
                                @endphp
                                   <tr>
                                      <td>{{$loop->index + 1}}</td>
                                      <td>{{$row->reporter_name}}</td>
                                      <td>{{$area?$area->name:''}}</td>
                                      <td>{{$location?$location->name:''}}</td>
                                      <td><code>{{\Carbon\Carbon::createFromTimeStamp(strtotime($row->created_at))->diffForHumans()}}</code></td>
                                      
                                      <td><a href="javascript:;" class="btn btn-primary" onclick="openIoReportModal('{{$row->id}}')">Show</a> <a href="{{route('io_reports.destroy', $row->id)}}" class="btn btn-danger">Delete</a></td>
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
        function openIoReportModal(id, key = null){
            $.ajax({
                 method: 'GET',
                 url:'/admin/io-reports/ajax/'+id+'/show'
                }).done(function (data) {
                 $("#showReportsModal").modal({show: true}).find(".modal-body").html(data.view); 

                }).fail(function () {
                    alert('Somthing Happenned !');
                });
        }

    </script>
@stop
