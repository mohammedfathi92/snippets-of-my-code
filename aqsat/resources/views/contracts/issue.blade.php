@extends('voyager::master')

@section('page_title', __('title.contract.issue'))


@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> العقود ذات قضية </span> <a href="{{url('admin/contracts/1/create')}}"
                                                                        class="btn btn-danger my_btn_left"
                                                                        onclick="$('#add_panal').toggle();">
            <i class="fa fa-plus-circle"> </i>عقد تقسيط جديد
        </a></h1>
@endsection
@section('content')
    <section class="content">
        @include('include.message')
        <div class="row">
            {!! Form::open(['route'=>'contracts.search_issue','method'=>'get']) !!}
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list-ul"></i> العقود ذات قضية</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id">رقم العقد</label>
                                    <input type="number" class="form-control" name="id" id="id"
                                           placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="buyer">العميل</label>
                                    <input type="text" class="form-control" name="client" id="email"
                                           placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="seller">المستثمر</label>
                                    <input type="text" class="form-control" name="investor" id="email"
                                           placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="seller">قيمه العقد </label>
                                    <input type="text" class="form-control" name="contract_value"
                                           id="monthly_installment" placeholder="اختياري">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">نظام العقد</label>
                                    <select name="type" class="form-control" style="width:100%;">
                                        <option value="">--الكل--</option>
                                        <option value="1">نظام أقساط</option>
                                        <option value="2">نظام آجل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">المجموعة</label>
                                    <select name="group_id" class="form-control" style="width:100%;">
                                        <option value="">--الكل--</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}"> {{$group->name}} </option>
                                        @endforeach
                                    </select>
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
                        <h3 class="box-title"><i class="fa fa-list-ul"></i> قائمة العقود</h3>
                    </div>
                    <div class="box-body">
                        <table id="aqTable" class="table table-striped table-bordered table-hover display   "
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>م</th>
                                <th>العميل</th>
                                <th>جوال العميل</th>
                                <th>المستثمر</th>
                                <th>نوع العقد</th>
                                <th>التاريخ</th>
                                <th>المبلغ</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th>آخر عملية دفع</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contracts->get() as $contract)
                                <tr>
                                    <td>{{$contract->id}}</td>
                                    <td>{{$contract->client->name}}</td>
                                    <td>{{$contract->client->phone}}</td>
                                    <td>{{$contract->investor->name}}</td>
                                    <td>{{$contract->contract_type == 2? 'اجل':'تقسيط'}}</td>
                                    <td>{{$contract->last_date}}</td>
                                    <td>{{$contract->contract_value}}</td>
                                    <td>{{$contract->contract_premium->sum('payment')}}</td>
                                    <td>{{$contract->contract_value - $contract->contract_premium->sum('payment')}}</td>
                                    <td></td>
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


