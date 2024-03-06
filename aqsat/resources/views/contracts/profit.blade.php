@extends('voyager::master')
@section('page_title', __('title.contract.profit'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> عموله العقد </span> <a href="{{route('contracts.create',1)}}"
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
                        {!! Form::open(['route'=>'contracts.search_profit','method'=>'get',
                      ]) !!}
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
                            <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمة عمولات العقود</h3>
                        </div>
                        <div class="box-body">
                            <table id="aqTable" class="table table-striped table-bordered table-hover display   "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>م</th>
                                    <th>العميل</th>
                                    <th>المستثمر</th>
                                    <th>  تاريخ كتابه العقد </th>
                                    <th>إجمالي العقد</th>
                                    <th>نوع العقد</th>
                                    <th>قيمة العمولة</th>
                                    <th>المدفوع</th>
                                    <th>المتبقي</th>
                                    <th> الدفع </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contracts->get() as $contract)
                                    <tr>
                                        <td>{{$contract->contract_num}}</td>
                                        <td><a href="{{route('contracts.show',$contract->id)}}">{{$contract->client->name}}</a></td>
                                        <td>{{$contract->investor->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($contract->contract_date)->format('Y-m-d') }}</td>
                                        <td>{{$contract->contract_value}}</td>
                                        <td>{{$contract->contract_type == 1? 'تقسيط':'اجل'}}</td>
                                        <td>{{$contract->contract_profit}}</td>
                                        <td>
                                            @if(!$contract->contract_profit_payment)
                                                <span> 0 </span>
                                                @else
                                                {{$contract->contract_profit_payment}}
                                                @endif

                                        </td>
                                        <td>{{$contract->contract_profit - $contract->contract_profit_payment}}</td>
                                        <td>
                                            @if($contract->contract_profit - $contract->contract_profit_payment)
                                            <button class="btn btn-sm btn-primary fa fa-paypal" type="button"  data-toggle="modal"
                                                    data-target="#exampleModal" data-whatever="@mdo"
                                            onclick="payProfit({{$contract->id}});">
                                                <span> دفع </span>
                                            </button>
                                            @else

                                           <span>لا يوجد</span>
                                           

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    {{--model payment profits--}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" id="payment_profit">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br clear="both"/>
        </div>
    </section>

@endsection


@section('javascript')

    <script>

        function payProfit(id) {
            $.ajax({
                type: 'post',
                url: '/admin/contracts/ajax_payment_profit',
                data: {id:id},
                success: function (data) {
                    $("#payment_profit").html(data);
                }
            });
        }

        function getInvestorAccountValue(id) {
            $.ajax({
                type: 'post',
                url: '/admin/contracts/ajax_investor_account_value',
                data: {id:id},
                success: function (data) {
                    $("#investor_account_value").val(data);
                }
            });
        }

        function getCompanyAccountValue(id) {
            $.ajax({
                type: 'post',
                url: '/admin/contracts/ajax_company_account_value',
                data: {id:id},
                success: function (data) {
                    $("#company_account_value").val(data);
                }
            });
        }
    </script>

    @endsection