@extends('voyager::master')
@section('page_title', __('title.contract.premium_late'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> الاقساط المتاخره </span></h1>
@endsection
@section('content')
    <section class="content">
        @include('include.message')
        <div class="row">
            {!! Form::open(['route'=>'contracts.search_late_premiums','method'=>'get']) !!}
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search-plus"></i> البحث المتقدم</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">رقم القسط</label>
                                <input type="number" class="form-control" name="id" id="id"
                                       placeholder="اختياري">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="buyer">من تاريخ</label>
                                <input type="date" class="form-control" name="dstart" placeholder="اختياري">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="buyer">الى تاريخ</label>
                                <input type="date" class="form-control" name="dend" placeholder="اختياري">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-danger my_btn_left"><i class="fa fa-search"></i>
                        <span> بحث </span>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}

            <div class="raw">
                <div class="box box-danger box-solidi">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list-ul"></i> قائمة الاقساط المتاخره</h3>
                    </div>
                    <div class="box-body">
                        <table id="aqTable" class="table table-striped table-bordered table-hover display   "
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>م</th>
                                <th> تاريخ الهجرى</th>
                                <th> تاريخ الميلادى</th>
                                <th>المبلغ</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($late_premiums->get() as $premium)
                                <tr>
                                    <td>{{$premium->id}}</td>
                                    <td>
                                        {{\Carbon\Carbon::parse($premium->date_type_hij)->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($premium->date_type_mi)->format('Y-m-d')}}
                                    </td>
                                    <td>{{$premium->amount}}</td>
                                    <td>{{$premium->payment}}</td>
                                    <td>{{$premium->amount - $premium->payment}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>م</th>
                                <th> تاريخ الهجرى</th>
                                <th> تاريخ الميلادى</th>
                                <th>المبلغ</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                            </tr>
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


