@extends('voyager::master')

@section('page_title', "")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="">IO Reports </i> 
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
                                      <th>hi</th>
                                      <th>ho</th>
                                      <th>po</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                   <tr>
                                      <td>vo</td>
                                      <td>jo</td>
                                      <td>do</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@stop

@section('css')

@stop

@section('javascript')
    <script>
        $(document).ready(function () {
          
         $('#dataTable').DataTable();
           
        });
    </script>
@stop
