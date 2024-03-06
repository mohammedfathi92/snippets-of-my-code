@extends('voyager::master')
@section('page_title', __('title.contract.premiums'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> الاقساط والدفعات </span> <strong>@if(Request::get('pay_status') == 0) [الغير مسددة] @elseif(Request::get('pay_status') == 2) [المسددة] @elseif(Request::get('pay_status') == 1) [سداد جزئي] @elseif(Request::get('pay_status') == 3) [المتأخرة في السداد] @endif</strong> <a href="{{route('contracts.create',1)}}"
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
                            {!! Form::open(['route'=>'contracts.search_premiums','method'=>'get']) !!}
                            <div class="form-group">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id">العميل</label>
                                        <input type="text" class="form-control" name="client" id="name"
                                               placeholder="اختياري">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="buyer">المستثمر</label>
                                        <input type="text" class="form-control" name="investor" id="email"
                                               placeholder="اختياري">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">حالة القسط </label>
                                        <select name="pay_status" class="form-control" style="width:100%;">
                                            <option value="">--الكل--</option>
                                            <option value="0" @if(Request::get('pay_status') == 0) selected @endif>الغير مسددة</option>
                                            <option value="2" @if(Request::get('pay_status') == 2) selected @endif>المسددة</option>
                                            <option value="3" @if(Request::get('pay_status') == 3) selected @endif>متاخر فى السداد</option>
                                            <option value="1" @if(Request::get('pay_status') == 1) selected @endif>سداد جزئى</option>
                                        </select>
                                    </div>

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
                            <h3 class="box-title"><i class="fa fa-list-alt"></i>نتائج البحث </h3>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="aqTable" class="table table-striped table-bordered table-hover display   "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>العميل</th>
                                    <th>الجوال</th>
                                    <th>المستثمر</th>
                                    <th>رقم العقد</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>نوعه</th>
                                    <th>المبلغ</th>
                                    <th>المسدد</th>
                                    <th>المتبقي</th>
                                    <th>الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($premiums)
                                @foreach($premiums->get() as $premium)
                                    <tr>
                                        <td>{{$premium->id}}</td>
                                        <td>{{$premium->contract->client->name}}</td>
                                        <td>{{$premium->contract->client->mobile}}</td>
                                        <td>{{$premium->contract->investor->name}}</td>
                                        <td>{{$premium->contract->contract_num}}</td>
                                        <td>{{\Carbon\Carbon::parse($premium->date_type_mi)->format('Y-m-d')}}</td>
                                        <td>{{$premium->contract->contract_type == 1? 'تقسيط':'اجل'}}</td>
                                        <td>{{$premium->amount}}</td>
                                        <td>{{$premium->payment}}</td>
                                        <td>{{$premium->amount - $premium->payment}}</td>
                                        <td>
                                            @if($premium->status == 0)
                                                <span style="color: red;"> غير مسدد </span>
                                            @elseif($premium->status == 2)
                                                <span style="color: green;"> مخالصه العقد </span>
                                            @elseif($premium->status == 3)
                                                <span style="color: red;"> متاخر فى السداد </span>
                                            @elseif($premium->status == 1)
                                                <span style="color: yellowgreen;"> سداد جزئى </span>
                                            @endif
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
            <br clear="both"/>
        </div>
    </section>

@endsection


