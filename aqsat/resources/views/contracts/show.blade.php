@extends('voyager::master')

@section('page_title', __('title.contract.show'))

@section('page_header')
    <h1><i class="fa fa-plus-circle"></i> عقد رقم [ {{$contract->contract_num}}] </h1>
@endsection

@section('content')

  @php
                                    if($contract->contract_type == 1){
                                        $contract_type = 'contract_1';

                                    }else{
                                         $contract_type = 'contract_2';
                                    }
                                   
                                    @endphp
    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    {{$contract->contract_value + $contract->first_payment }}
                                    <small style="color:#fff"> ريال سعودى</small>
                                </h3>
                                <p>قيمة العقد</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    @if($contract->kind == 2)
                                        <span> عقد خالص </span>
                                    @else
                                        {{$contract->contract_premium->sum('payment') + $contract->first_payment}}
                                        <small style="color:#fff"> ريال سعودى</small>
                                    @endif
                                </h3>
                                <p>المدفوعات</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>
                                    @if($contract->kind == 2)
                                        <span> عقد خالص </span>
                                    @else
                                        {{$contract->contract_value - $contract->contract_premium->sum('payment')}}
                                        <small style="color:#fff">ريال سعودى</small>
                                    @endif
                                </h3>

                                <p>المتبقي</p>
                            </div>
                            <div class="icon">
                                <i class="ion  ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>
                                    @if($contract->kind == 2)
                                        <span> عقد خالص </span>
                                    @else
                                        {{ $late_payment }}
                                        <small style="color:#fff;">ريال سعودى</small>
                                    @endif
                                </h3>
                                <p>المتأخر</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
          @php
                        $paid_pr = $premiums->sum('payment');
                        $percent_paid = round(($paid_pr / $contract->contract_value) * 100, 1) ;

                        @endphp
                        <br clear="both" xmlns="http://www.w3.org/1999/html"/>
                        <p>تم تسديد ({{ $percent_paid }} %) من قيمة العقد</p>
                  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $percent_paid }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $percent_paid }}%">
      ({{ $percent_paid }} %) 
    </div>
  </div>

                {{--tab_title--}}
                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified no_print">
                        <li class="active">
                            <a href="#basic_information" data-toggle="tab" aria-expanded="true">بيانات العقد </a>
                        </li>
                        <li class="">
                            <a href="#installments" data-toggle="tab" aria-expanded="false">
                                الأقساط </a>
                        </li>
                        <li class="">
                            <a href="#operations" data-toggle="tab" aria-expanded="false">
                                عمليات الدفع </a>
                        </li>
                        {{--<li class="">--}}
                        {{--<a href="#attachments" data-toggle="tab" aria-expanded="false">--}}
                        {{--المرفقات </a>--}}
                        {{--</li>--}}
                        <li class="">
                            <a href="#notes" data-toggle="tab" aria-expanded="false">
                                الملاحظات </a>
                        </li>
                        <li class="">
                            <a href="#options" data-toggle="tab" aria-expanded="false">
                                الخيارات </a>
                        </li>
                    </ul>


                    <div class="tab-content">

                        {{--tab_contract_info--}}
                        <div class="tab-pane active" id="basic_information">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label> العميل</label>
                                    <label class="form-control" style="background:#eee;">{{$contract->client->name}}
                                        <a href="{{route('clients.show',$contract->client->id)}}"><i
                                                    class="fa fa-link"></i></a></label>
                                </div>
                                <div class="col-md-3">
                                    <label> المستثمر</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{$contract->investor->name}}
                                        <a href="{{route('investors.show',$contract->investor->id)}}"><i
                                                    class="fa fa-link"></i></a></label>
                                </div>
                                <div class="col-md-3">
                                    <label> الكفيل الأول</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{$contract->sponsor_id == null ? 'no sponsor': $contract->sponsor->name}}
                                        <a href="{{route('contracts.sponsor_edit',$contract->id)}}" target="_blank"><i
                                                    class="fa fa-edit"></i></a>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> الكفيل الثاني</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{$contract->sponsor_two_id == null ? 'no sponsor': $contract->sponsor_two->name}}
                                        <a target="_blank" href="{{route('contracts.sponsor_edit',$contract->id)}}"><i
                                                    class="fa fa-edit"></i></a>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> نوع العقد</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{$contract->contract_type == 2? 'اجل':'تقسيط'}}
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> تاريخ إضافة العقد</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{\Carbon\Carbon::parse($contract->contract_date)->format('Y-m-d')}}
                                    </label>
                                </div>
                                @if($contract->contract_type == 2)
                                    <div class="col-md-3">
                                        <label>تاريخ حلول الدفع</label>
                                        <label class="form-control" style="background:#eee;">
                                            {{$contract->premiums_start_date}}
                                        </label>
                                    </div>
                                @endif
                                @if($contract->contract_type == 1)
                                    <div class="col-md-3">
                                        <label>
                                            <label>تاريخ بداية الأقساط</label>
                                        </label>
                                        <label class="form-control" style="background:#eee;">
                                            {{$contract->premiums_start_date}}
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>تاريخ نهاية الأقساط</label>
                                        <label class="form-control" style="background:#eee;">
                                            {{$contract->last_date}}
                                        </label>
                                    </div>
                                @endif

                                <br clear="both"/>
                                <div class="col-md-3">
                                    <label>إجمالي الربح</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$contract->total_profit}}</label>
                                </div>
                                <div class="col-md-3">
                                    <label> الرسوم الإدارية</label>
                                    <label class="form-control" id="rassomedaryah_label" style="background:#eee;">
                                        {{$contract->fees}}
                                        <a href="javascript:void(0);" onclick="EditRassomEdariyah();"><i
                                                    class="fa fa-edit"></i></a></label>

                                    {!! Form::open(['route'=>['contracts.fees_update',$contract->id],
                                    'id'=>'form_rassomedaryah' ,'style'=>'display:none']) !!}
                                    <input type="text" class="form-control" name="amount"
                                           placeholder="الرسوم الإدارية العقد" value="{{$contract->fees}}"/>
                                    <input type="submit" value="حفظ" class="btn btn-sm"/>
                                    {!! Form::close() !!}
                                </div>

                                <div class="col-md-3">
                                    <label>عمولة العقد</label>
                                    <label class="form-control" id="rassomagd_label"
                                           style="background:#eee;">{{$contract->contract_profit}}
                                        <a href="javascript:void(0);" onclick="EditRassomAgd();"><i
                                                    class="fa fa-edit"></i></a></label>
                                    {{Form::open(['route'=>['contracts.profit_update',$contract->id],'method'=>'post'
                                    ,'id'=>'form_rassomagd','style'=>'display:none'])}}

                                    <input type="text" class="form-control" name="contract_profit"
                                           placeholder="عمولة العقد"
                                           value="{{$contract->contract_profit}}"/><input
                                            type="submit" value="حفظ" class="btn btn-sm"/>
                                    {{Form::close()}}
                                </div>


                                <div class="col-md-3">
                                    <label>الخصم (إن وجد)</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$contract->discount}} </label>
                                </div>
                                @if($contract->contract_type == 1)
                                    <div class="col-md-3">
                                        <label>عدد الأقساط</label>
                                        <label class="form-control" style="background:#eee;">
                                            {{ $contract->premiums_number }}
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>مقدار القسط</label>
                                        <label class="form-control" style="background:#eee;">
                                            {{ $contract->premiums_value }}
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>القسط الأخير</label>
                                        <label class="form-control" style="background:#eee;">
                                            {{ $contract->last_premium }}
                                        </label>
                                    </div>
                                @endif


                                <div class="col-md-3">
                                    <label> المجموعة</label>
                                    <label class="form-control" style="background:#eee;"
                                           id="group_label">{{$contract->group->name}}
                                        <a href="javascript:void(0);" onclick="ChangeGroup();"><i
                                                    class="fa fa-edit"></i></a>
                                    </label>
                                    {!! Form::open(['route'=>['contracts.update_group',$contract->id]]) !!}
                                    <select class="form-control" name="group_id">
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                    <input class="btn btn-sm" type="submit" value="تغيير "/>
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-3">
                                    <label> أضيف بواسطة</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$contract->user->name}}</label>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top:20px">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>السلعة</th>
                                                <th>الكمية</th>
                                                <th>سعر التكلفة الإجمالي</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contract->products as  $product)
                                                <tr>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->pivot->quantity}}</td>
                                                    <td>{{$product->pivot->price * $product->pivot->quantity}} </td>
                                                    <td style="display: none;">
                                                        {{$total += ($product->pivot->price * $product->pivot->quantity) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th style="text-align: left" colspan="2">الإجمالي</th>
                                                <td> {{$total}}</td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br clear="both"/>

                        </div>
                        {{--tab_premiums--}}
              
                        <div class="tab-pane" id="installments">
    
                            <br clear="both"/>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th rowspan="2">النوع</th>
                                    <th colspan="2" style="text-align:center;border-bottom:2px solid #eee;">تاريخ
                                        الإستحقاق
                                    </th>
                                    <th rowspan="2">آخر عملية دفع</th>
                                    <th rowspan="2">المبلغ</th>
                                    <th rowspan="2">المدفوع</th>
                                    <th rowspan="2">الربح</th>
                                    <th rowspan="2">الحالة</th>
                                </tr>
                                <tr>
                                    <th>الهجري</th>
                                    <th>الميلادي</th>
                                </tr>
                                </thead>
                                <style>
                                    .tr_installment_not_mostahag {
                                        border-bottom: grey 2px solid;
                                    }

                                    .tr_installment_not_mostahag_status {
                                        text-align: center;
                                        font-weight: bold;
                                        background: grey;
                                        color: white;
                                    }

                                    .tr_installment_mosadad {
                                        border-bottom: green 2px solid;
                                    }

                                    .td_installment_mosadad_status {
                                        background: green;
                                        color: white;
                                        font-weight: bold;
                                        text-align: center;
                                    }

                                    .tr_installment_mosadad_partly {
                                        border-bottom: orange 2px solid;
                                    }

                                    .tr_installment_mosadad_partly_status {
                                        background: orange;
                                        color: white;
                                        font-weight: bold;
                                        text-align: center;
                                    }

                                    .tr_installment_mostahag {
                                        border-bottom: #717CB5 2px solid

                                    }

                                    .tr_installment_mostahag_status {
                                        background: #717CB5;
                                        color: white;
                                        font-weight: bold;
                                        text-align: center;

                                    }

                                    .tr_installment_mutakher {
                                        border-bottom: #E60000 2px solid
                                    }

                                    .tr_installment_mutakher_status {
                                        background: #E60000;
                                        color: white;
                                        font-weight: bold;
                                        text-align: center;
                                    }
                                </style>
                                <tbody>
                                @if($contract->kind != 2)
                                    @foreach( $premiums as $premium )
                                        <tr class="tr_installment_not_mostahag">
                                            <td>
                                              
                                                    <a data-toggle="modal"
                                                       data-target="#exampleModal"
                                                       onclick=" get_premium({{$premium->order}},{{$contract->id}});">
                                                        {{$contract->contract_type == 2? 'اجل':'قسط'}}
                                                        #{{$premium->order}}</a>
                                                   
                                           
                 @include('prints.components.print_icon', ['module'=>'qest', 'module_id'=>$premium->id])

                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($premium->date_type_hij)->format('Y-m-d') }}
                                                <a href="{{route('contracts.edit_date',$premium->id)}}"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </td>
                                            <td>
                                                {{date('Y-m-d', strtotime($premium->date_type_mi))}}
                                                <a href="{{route('contracts.edit_date',$premium->id)}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($premium->last_pay_time)
                                              {{\Carbon\Carbon::parse($premium->last_pay_time)->format('Y-m-d')}}
                                              @else
                                              ----
                                              @endif
                                            </td>
                                            <td>
                                               {{$premium->amount}}
                                            </td>

                                            <td>{{$premium->payment}}</td>

                                            <td>{{$premium->profit}}</td>

                                            @if($premium->status == 0)
                                                <td class="tr_installment_not_mostahag_status">
                                                    <span> غير مستحق </span>
                                                </td>
                                            @elseif($premium->status== 1)
                                                <td style="background: yellowgreen"
                                                    class="tr_installment_not_mostahag_status">
                                                    <span> سداد جزئى </span>
                                                </td>

                                            @elseif($premium->status == 2)
                                                <td style="background: green;"
                                                    class="tr_installment_not_mostahag_status">
                                                    <span> تم السداد </span>
                                                </td>
                                            @elseif($premium->status == 3)
                                                @if($premium->call_status == 1)
                                                    <td style="background: #ff822a;"
                                                        class="tr_installment_not_mostahag_status">
                                                        <span> مؤجل </span>
                                                    </td>
                                                    @else
                                                    <td style="background: red;"
                                                        class="tr_installment_not_mostahag_status">
                                                        <span> متاخر عن السداد </span>
                                                    </td>
                                                    @endif

                                            @endif
                                        </tr>
                                        <tr style="display: none;" id="installment_operations_605547">
                                            <td colspan="8">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th style="background: #dcb375;">رقم العملية</th>
                                                        <th style="background: #dcb375;">البيان</th>
                                                        <th style="background: #dcb375;">التاريخ</th>
                                                        <th style="background: #dcb375;">المبلغ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td style="text-align: center;" colspan="5">
                                            <span> this contract is finished </span>
                                        </td>
                                    </tr>
                                @endif


                                </tbody>
                            </table>
                            @if($contract->contract_type == 1 and $contract->kind != 2)
                                <div class="text-center">
                                    <a href="{{route('contracts.premium_edit',$contract->id)}}"
                                       class="btn btn-lg green"><i
                                                class="fa fa-edit"></i> تعديل جدولة الأقساط</a>
                                </div>
                            @endif


                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" id="premium_payment">


                                    </div>
                                </div>
                            </div>


                        </div>
                        {{--payment_process--}}
                        <div class="tab-pane" id="operations">
                            <table style="font-size:14px"
                                   class="table aqTable table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>رقم العملية</th>
                                    <th>البيان</th>
                                    <th>الحساب</th>
                                    <th>التاريخ</th>
                                    <th>المبلغ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contract->financial_transactions as $financial_transaction)
                                    <tr>
                                        <td>{{$financial_transaction->id}}</td>
                                        <td>{{$financial_transaction->notes}}</td>
                                        <td>{{$financial_transaction->company_account->account_name}}</td>
                                        <td>{{$financial_transaction->created_at}}</td>
                                        <td>{{$financial_transaction->price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        {{--attachment--}}
                        {{--<div class="tab-pane" id="attachments">--}}
                        {{--<form method="POST" action="https://u89559.dhman.io/125/210/965/500/38184/attachments"--}}
                        {{--accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token"--}}
                        {{--type="hidden"--}}
                        {{--value="ZyCVYSqhamCC6x5pVaFafEY6cYvM1BBw8yGZjCbA">--}}
                        {{--<div class="portlet light ">--}}
                        {{--<div class="portlet-title  ">--}}
                        {{--<div class="caption">--}}
                        {{--<i class="icon-file font-green-sharp"></i>--}}
                        {{--<span class="caption-subject font-green-sharp bold uppercase">رفع المرفقات</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="portlet-body">--}}
                        {{--<div class="form-body">--}}
                        {{--<div class="alert alert-warning">--}}
                        {{--<p>لإضافة مساحة خاصة بالمرفقات لحسابكم ، يرجى التوجه لهذه--}}
                        {{--<a href="https://u89559.dhman.io/129/41/1"--}}
                        {{--target="_blank">الصفحة</a>.--}}
                        {{--</p>--}}
                        {{--</div>--}}
                        {{--<div class="alert alert-info">--}}
                        {{--<ul>--}}
                        {{--<li>يجب أن يكون حجم الملف أقل من 1 ميقابايت.</li>--}}
                        {{--<li>يجب أن يكون أمتداد الملف : pdf , jpg , png</li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-6">--}}
                        {{--<label>نوع المستند</label>--}}
                        {{--<select class="form-control" name="term_id">--}}
                        {{--<option value="1" selected="selected">الهوية</option>--}}
                        {{--<option value="2">صورة العقد</option>--}}
                        {{--<option value="3">سند لأمر</option>--}}
                        {{--<option value="4">خطاب المخالصة</option>--}}
                        {{--<option value="5">الكمبيالة</option>--}}
                        {{--<option value="6">سند إستلام السلعة</option>--}}
                        {{--<option value="7">أخرى</option>--}}
                        {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-6">--}}
                        {{--<label>رفع الملف</label>--}}
                        {{--<input type="file" class="form-control" name="attachment"--}}
                        {{--accept="image/jpeg,image/gif,image/png,application/pdf">--}}
                        {{--</div>--}}
                        {{--<center>--}}
                        {{--<input type="submit" class="btn  btn-success f_left"--}}
                        {{--value="رفع المرفقات">--}}
                        {{--</center>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--<table id="aqTable" class="table table-bordered table-striped">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                        {{--<th> نوع المستند</th>--}}
                        {{--<th> الحجم</th>--}}
                        {{--<th>بواسطة</th>--}}
                        {{--<th>تاريخ الرفع</th>--}}
                        {{--<th>الإجراءات</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--</tbody>--}}
                        {{--</table>--}}

                        {{--</div>--}}
                        {{--notes--}}
                        <div class="tab-pane " id="notes">
                            {{Form::open(['route'=>'contracts.note_store'])}}
                            <input type="hidden" name="contract_id" value="{{$contract->id}}">
                            <div class="form-group">
                                <label>إضافة ملاحظة</label>
                                <textarea name="note" class="form-control required"
                                          placeholder="لإضافة ملاحظة لهذا العقد."></textarea>
                            </div>
                            <button type="submit" id="note_submit" class="btn btn-primary btn-md f_left">
                                <span>حفظ الملاحظة</span>
                            </button>
                            {{Form::close()}}
                            <br clear="both"/>
                            <div class="col-md-12">
                                <table  class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>الملاحظة</th>
                                        <th>الكاتب</th>
                                        <th>الوقت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contract->notes->where('created_by', "!=", $contract->investor_id) as $note)
                                        <tr>
                                            <td>{{$note->note}}</td>
                                            <td>{{$note->user->name}}</td>
                                            <td>{{$note->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br clear="both">

                        </div>
                        {{--options--}}
                        <div class="tab-pane" id="options">
                            <div class=" no_print">
                                @if($contract->kind != 2)
                                  <button type="button" class="btn btn-lg red" data-toggle="modal" data-target="#myDeleteContractModal">حذف العقد</button>

                                    <!-- Modal -->
  <div class="modal fade" id="myDeleteContractModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      @php
     $contract_products_amount = 0.0;
         $contract_products = DB::table('contract_product')->where('contract_id', $contract->id)->get();
         foreach ($contract_products as $pro) {
           $contract_products_amount += ($pro->first_payment * $pro->quantity);
         }
      $accounts = \App\Company_account::all();
      $investor_first_account = $accounts->where('user_id', $contract->investor_id)->first();
       if($contract->quittance){
            $contract_paid_value = $contract->contract_value - $contract->discount;
           $contract_premiums_payment = ($contract->contract_premium->sum('payment') + $contract_paid_value) - $contract->contract_profit_payment;
         }else{
           $contract_premiums_payment = $contract->contract_premium->sum('payment') - $contract->contract_profit_payment;

         }
      @endphp
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">حف العقد</h4>
        </div>
        <div class="modal-body">
             {{Form::open(['route'=> ['contracts.destroy',$contract->id],'method'=>'post','id'=>'create_contract'])}}

             <div class="form-group {{ $errors->has('products_account') ? ' has-error' : '' }}">
                                        <label class="control-label">اختر الحساب المراد استرجاع قيمة رأس المال عليه حيث تساوي {{ $contract_products_amount }} ريال سعودي</label>
                                        <select 
                                                class="form-control select2 "
                                                style="border:1px solid #aaa;"
                                                tabindex="1" id="investor" name="products_account">
                                            @foreach($accounts->where('user_id', $contract->investor_id) as $account)
                                                <option value="{{$account->id}}" @if($account->id == $investor_first_account->id) selected @endif>{{$account->account_name}} -  ( الرصيد {{$account->account_value}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('products_account'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('products_account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
@if( $contract->first_payment > 0)
                                         <div class="form-group {{ $errors->has('first_pay_account') ? ' has-error' : '' }}">
                                        <label class="control-label">اختر الحساب المراد استرجاع قيمة الدفعة الاولى للعقد منه حيث تساوي {{ $contract->first_payment }} ريال سعودي</label>
                                        <select class="form-control select2 " style="border:1px solid #aaa;" tabindex="1" id="investor" name="first_pay_account">
                                        <option value=0>السحب من كافة حسابات المستثمر</option>
                                            @foreach($accounts->where('user_id', $contract->investor_id) as $account)
                                                <option value="{{$account->id}}" @if($account->id == $contract->account_id) selected @endif>{{$account->account_name}} -  ( الرصيد {{$account->account_value}})</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('first_pay_account'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_pay_account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
@endif
@if($contract_premiums_payment > 0)
                                         <div class="form-group {{ $errors->has('premium_account') ? ' has-error' : '' }}">
                                        <label class="control-label">اختر الحساب المراد خصم قيمة الاقساط المدفوعه منه حيث تساوي {{ $contract_premiums_payment }} ريال سعودي</label>
                                        <select 
                                                class="form-control select2 "
                                                style="border:1px solid #aaa;"
                                                tabindex="1" id="investor" name="premium_account">
                                                <option value=0>السحب من كافة حسابات المستثمر</option>
                                            @foreach($accounts->where('user_id', $contract->investor_id) as $account)
                                                <option value="{{$account->id}}" @if($account->id == $investor_first_account->id) selected @endif>{{$account->account_name}} -  ( الرصيد {{$account->account_value}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('premium_account'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('premium_account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @endif
@if($contract->fees > 0)
                                    @if($contract->fees - $contract->contract_fees_payment >= 0)
                                         <div class="form-group {{ $errors->has('premium_account') ? ' has-error' : '' }}">
                                        <label class="control-label">اختر الحساب المراد استرجاع قيمة المدفوع من الرسوم الإدارية عليه حيث تساوي {{ $contract->contract_fees_payment }} ريال سعودي</label>
                                        <select 
                                                class="form-control select2 "
                                                style="border:1px solid #aaa;"
                                                tabindex="1" id="investor" name="premium_account">
                                                <option value=0>السحب من كافة حسابات الشركة</option>
                                            @foreach($accounts->where('user_id', 1) as $account)
                                                <option value="{{$account->id}}" @if($account->id == $investor_first_account->id) selected @endif>{{$account->account_name}} -  ( الرصيد {{$account->account_value}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('premium_account'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('premium_account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @endif

                                    @endif
@if($contract->contract_profit_payment > 0)
                                <div class="form-group {{ $errors->has('commission_account') ? ' has-error' : '' }}">
                                        <label class="control-label">اختر الحساب المراد خصم قيمة العمولة منه {{ $contract->contract_profit_payment }} ريال سعودي</label>
                                        <p>الحساب المظلل بالاخضر هو الحساب المدفوع عليه قيمة العمولة لهذا العقد</p>

                                        <select 
                                                class="form-control select2 "
                                                style="border:1px solid #aaa;"
                                                tabindex="1" id="investor" name="commission_account">
                                                <option value=0>السحب من كافة حسابات المستخدم صاحب الحساب المدفوع عليه العمولة</option>

                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}" @if($account->id == $contract->commission_account) style="background-color: green" selected @endif>{{$account->account_name}} -  ( الرصيد {{$account->account_value}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('commission_account'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('commission_account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @endif

                                     <button type="submit" class="btn btn-primary margin" >حذف</button>

                                    {!! Form::close()!!}
         
        </div>
      </div>
      
    </div>
  </div>

                                    <a href="{{route('contracts.payment',$contract->id)}}" class="btn btn-lg green">
                                        <i class="fa fa-credit-card"></i> التحصيل والسداد
                                    </a>
                                    <a href="{{route('contracts.finished',$contract->id)}}" class="btn btn-lg green">
                                        <i class="fa fa-credit-card"></i> المخالصة
                                    </a>

                                    @include('prints.components.print_btn', ['module'=>$contract_type, 'module_id'=>$contract->id])
                                    <a href="{{route('contracts.conflict',$contract->id)}}"
                                       class="btn btn-lg btn-warning">
                                        <i class="fa fa-exclamation-circle"></i> إضافة للعقود المتعثرة
                                    </a>
                                    <a href="{{route('contracts.issue_save',$contract->id)}}"
                                       class="btn btn-lg btn-danger">
                                        <i class="fa fa-exclamation-triangle"></i> إضافة للعقود ذات قضية
                                    </a>

                                @endif
                                {{--<a href="#" class="btn btn-lg blue-hoki">--}}
                                {{--<i class="fa fa-print"></i> طباعة العقد--}}
                                {{--</a>--}}
                                {{--<a href="#" class="btn btn-lg blue-hoki">--}}
                                {{--<i class="fa fa-print"></i> طباعة سند لأمر--}}
                                {{--</a>--}}
                                {{--<a href="#" class="btn btn-lg blue-hoki">--}}
                                {{--<i class="fa fa-print"></i> طباعة كمبيالة--}}
                                {{--</a>--}}
                                {{--<a href="#" class="btn btn-lg blue-hoki">--}}
                                {{--<i class="fa fa-print"></i> طباعة سند إستلام سلعة--}}
                                {{--</a>--}}
                                {{--<a href="#" class="btn btn-lg blue-hoki">--}}
                                {{--<i class="fa fa-print"></i> طباعة جدولة الأقساط--}}
                                {{--</a>--}}
                                <hr/>
                            </div>
                            <br clear="both">
                        </div>
                    </div>
                </div>
            </div>
            <br clear="both"/>

        </div>
        <br clear="both"/>
    </section>

  

@endsection


@section('javascript')

    <script>

        function get_premium(order, contract_id) {
            $.ajax({
                type: 'post',
                url: '/admin/contracts/ajax_get_premium',
                data: {order: order, contract_id: contract_id},
                success: function (data) {
                    $("#premium_payment").html(data);
                }
            });
        }
    </script>


    <script type="text/javascript">

        function ChangeIndex() {
            $('#index_lable').hide();
            $('#form_index').show();
        }

        function ChangeGroup() {
            $('#group_label').toggle();
            $('#form_group').toggle();
        }

        function EditRassomAgd() {
            $('#rassomagd_label').hide();
            $('#form_rassomagd').show();
        }

        function EditRassomEdariyah() {
            $('#rassomedaryah_label').hide();
            $('#form_rassomedaryah').show();
        }


    </script>

    <script type="text/javascript">
        function ShowSadadForm(id) {
            $('#form_content').show();
            $('#result_msg').empty().hide();
            $('#submit_btn_quick').attr("disabled", false);
            var myString = $('#date_installment_' + id).val();

            if (myString.charAt(myString.length - 2) == '- ') {
                myString = myString.substr(0, myString.length - 2);
            }
            $('#date_installment').html(myString);
            $('#amount').val($('#amount_' + id).val());
            $('#installment_id').val(id);
            $('#SadadForm').modal();
        }


        $('#fsadd').submit(function (event) {
            $('#form_content').hide();
            $('#loader').show();
            $('#submit_btn_quick').attr("disabled", true);
            var postData = $(this).serializeArray();
            var formURL = "https://u89559.dhman.io/125/930/38184";
            $('#result_msg').show();
            $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    success: function (data, textStatus, jqXHR) {
                        $('#loader').hide();

                        if (data.result == 'n') {
                            $('#submit_btn_quick').attr("disabled", false);
                            $('#result_msg').removeClass('alert alert-success').addClass('alert alert-danger').show().html(data.messages);
                        } else {
                            $('#form_content').hide();
                            $('#submit_btn_quick').attr("disabled", true);
                            $('#id_installment').html('');
                            setTimeout(function () {
                                window.location = data.operation_url;
                            }, 1);
                            $('#result_msg').removeClass('alert alert-danger').addClass('alert alert-success').show().html(data.messages);


                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        if (textStatus) {
                            $('#result_msg').addClass('alert alert-danger');
                            $('#result_msg').html('');

                            $.each(jqXHR.responseJSON.errors, function (k, v) {
                                $('#result_msg').append('<li>' + v + '</li>');
                            });
                            $('#loader').hide();
                            $('#form_content').show();
                            $('#submit_btn_quick').attr("disabled", false);
                        } else {
                            alert('يوجد خطأ !.');

                        }
                    }
                });
            event.preventDefault(); //STOP default action
            event.unbind(); //unbind. to stop multiple form submit.
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.date').calendarsPicker({
                calendar: $.calendars.instance('gregorian', 'ar'),
                dateFormat: 'yyyy/mm/dd',
                selectDefaultDate: true
            });
        });
    </script>
@endsection