@extends('voyager::master')
@section('page_title', __('title.logs.title'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> Logs </span> </h1>
@endsection
@section('content')
    <section class="content">
        <div class="row">


            <div class="raw">
                <div class="box box-danger box-solidi">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list-ul"></i> قائمة </h3>
                    </div>
                    <div class="box-body">
                        <table id="aqTable" class="table table-striped table-bordered table-hover display   "
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>م</th>
                                <th>الاكشن</th>
                                <th>الموظف</th>
                                <th>التوقيت</th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{$log->id}}</td>
                                    <td>{{ __('title.activities.'.$log->action) }}</td>
                                    <td>{{$log->user->name}}</td>
                                    <td>{{$log->created_at->diffForHumans()}}</td>
                                    <td>{{$log->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br clear="both"/>
        </div>
    </section>

@endsection


