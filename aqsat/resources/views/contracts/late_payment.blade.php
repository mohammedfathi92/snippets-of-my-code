@extends('voyager::master')

@section('page_title', __('title.contract.late'))
@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> المتأخرة بالسداد </span> <a href="{{route('contracts.create',1)}}"
                                                                         class="btn btn-danger my_btn_left">
            <i class="fa fa-plus-circle"> اضافه عقد تقسيط </i>
        </a></h1>
@endsection
@section('content')
    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> البحث المتقدم</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route'=>'contracts.search_late_payment','method'=>'get']) !!}
                        <div class="form-group">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="id">رقم العقد</label>
                                    <input type="number" class="form-control" name="contract_num" id="contract_num"
                                           placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="buyer">العميل</label>
                                    <input type="text" class="form-control" name="client" id="email"
                                           placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="seller">المستثمر</label>
                                    <input type="text" class="form-control" name="investor" id="email"
                                           placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type">نظام العقد</label>
                                    <select name="type" class="form-control" style="width:100%;">
                                        <option value="">--الكل--</option>
                                        <option value="1">نظام أقساط</option>
                                        <option value="2">نظام آجل</option>
                                    </select></div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit"  class="btn btn-primary my_btn_left"><i class="fa fa-search"></i> أبحث</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="raw">
                    <div class="box box-success box-solid">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-list-alt"></i> نتائج البحث</h3>
                        </div>
                        <div class="box-body">
                            <table id="aqTable" class="table table-striped table-bordered table-hover display   "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>رقم العقد</th>
                                    <th>العميل</th>
                                    <th>الجوال</th>
                                    <th>المستثمر</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>نوعه</th>
                                    <th>المبلغ</th>
                                    <th>المسدد</th>
                                    <th>المتبقي</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contracts->get() as $contract)
                                @php
                                $client_profile = $contract->client->profile;

                                @endphp
                                    <tr>
                                        <td>{{$contract->contract_num}}</td>
                                        <td><a href="{{route('contracts.show',$contract->id)}}">
                                                {{$contract->client->name}}
                                            </a>
                                        </td>
                                        <td>{{$client_profile?$client_profile->mobile:'-'}}</td>
                                        <td>{{$contract->investor->name}}</td>
                                      
                                        <td>{{\Carbon\Carbon::parse($contract->contract_date)->format('Y-m-d') }}</td>
                                        <td>{{$contract->contract_type == 1? 'تقسيط':'اجل'}}</td>
                                        <td>{{$contract->contract_value}}</td>
                                        <td>{{$contract->contract_premium->sum('payment')}}</td>
                                        <td>{{$contract->contract_value - $contract->contract_premium->sum('payment')}}</td>
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


