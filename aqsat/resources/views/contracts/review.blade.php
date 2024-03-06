@extends('voyager::master')

@section('page_title', __('title.contract.review'))

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="col-md-12">
                <br><br>
                <div class="alert alert-success">
                    <button type="button" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة نجاح</strong>
                    <hr class="message-inner-separator">
                    <p>
                    <ul>
                        <li style="font-size: 17px;">{{__('messages.contract.create')}}</li>
                    </ul>
                    </p>
                </div>
                <div class="row setup-content" id="step">
                    <ul class="alert alert-danger" id="result_step4" style="display: none;"></ul>
                    <div class="col-md-12">

                        {!! Form::open(['route'=>['contracts.save',$contract->id],'method'=>'post','id'=>'step_four']) !!}

                        <input type="hidden" name="s" value="4"/>
                        <div id="loader4" style="background:white;width:100%;padding:50px;display:none">
                            <center><img src=""/></center>
                            <br clear="both"/>
                        </div>
                        <div id="step_4_div">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-info"></i> البيانات الاساسية</h3>
                                </div>
                                <div class="box-body ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>المستثمر</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_investor">{{$contract->investor->name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>العميل</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_customer">{{$contract->client->name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>الكفيل الأول</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_khafel1">
                                                {{$contract->sponsor_id == null ? 'no sponsor': $contract->sponsor->name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>الكفيل الثاني</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_khafel2">
                                                {{$contract->sponsor_two_id == null ? 'no sponsor': $contract->sponsor_two->name}}</label>
                                        </div>
                                    </div>
                                    <br clear="both"/>
                                </div>
                            </div>
                            <table style="border:1px solid #67809f;"
                                   class="table table-striped table-bordered table-hover display   "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="font-family:'Kufi';font-weight:normal;font-size:18px;background-color:#67809f;color:white;text-align:center;">
                                        الصنف
                                    </th>
                                    <th style="font-family:'Kufi';font-weight:normal;font-size:18px;background-color:#67809f;color:white;text-align:center;">
                                        الكمية
                                    </th>
                                    <th style="font-family:'Kufi';font-weight:normal;font-size:18px;background-color:#67809f;color:white;text-align:center;">
                                        سعر الشراء
                                    </th>
                                    <th style="font-family:'Kufi';font-weight:normal;font-size:18px;background-color:#67809f;color:white;text-align:center;">
                                        سعر البيع
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="wares_summary" style="background:#fff!important;">
                                @foreach($contract->products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->pivot->quantity}}</td>
                                        <td style="display: none;">
                                            {{$price = $contract->investor->product_payments
                                            ->where('product_id',$product->id)
                                            ->where('price',$product->pivot->first_payment)->first()}}
                                        </td>
                                        <td>{{$price->price}}</td>
                                        <td>{{$product->pivot->price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3"
                                        style="font-family:'Kufi';font-weight:normal;font-size:18px;background-color:#67809f;color:white;text-align:left;">
                                        <span>قيمة العقد</span>
                                    </td>
                                    <td style="background-color:#fff;text-align:center;"
                                        id="label_ware_total_items">{{$contract->contract_value}} +
                                        <small style="color: #3f8027"> {{$contract->first_payment}} دفعة مقدمة </small> =
                                        <small> {{$contract->contract_value + $contract->first_payment}} </small>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <br clear="both"/>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-info"></i> بيانات العقد</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> نوع العقد</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_type_agd">
                                                {{$contract->contract_type == 2? 'اجل':'تقسيط'}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>تاريخ كتابة العقد</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_agd_date">
                                                {{\Carbon\Carbon::parse( $contract->contract_date)->format('Y-m-d')}}
                                            </label>
                                        </div>
                                    </div>

                                    {{--contract order other type--}}
                                    @if($contract->contract_type == 1)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>جدولة الأقساط بالتقويم
                                                </label>
                                                <label class="form-control label-form"
                                                       id="step4_label_schedule_installment">
                                                    {{$contract->premiums_start_date?'ميلادى':'هجرى'}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>نوع الجدولة
                                                </label>
                                                <label class="form-control label-form"
                                                       id="step4_label_type_installment">

                                                    @if($contract->schedule_type == 0)
                                                        <span>يومى</span>
                                                    @elseif($contract->schedule_type == 1)
                                                        <span>اسبوعى </span>
                                                    @elseif($contract->schedule_type == 2)
                                                        <span>شهرى </span>
                                                    @elseif($contract->schedule_type == 3)
                                                        <span>نصف سنوى  </span>
                                                    @elseif($contract->schedule_type == 4)
                                                        <span>سنوى </span>

                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>تاريخ أول قسط</label>
                                                <label class="form-control label-form"
                                                       id="step4_label_start_installment">{{$contract->premiums_start_date}}</label>
                                            </div>
                                        </div>
                                    @endif

                                    {{--contract order other type--}}
                                    @if($contract->contract_type == 2)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>تاريخ حلول الدفع</label>
                                                <label class="form-control label-form"
                                                       id="step4_label_start_installment">{{$contract->premiums_start_date}}</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>قيمة العقد</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_TotalPrice">{{$contract->contract_value}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>الأرباح</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_profit">{{$contract->total_profit}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>الدفعة المقدمة</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_dof3ah">{{$contract->first_payment}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>الحساب (لإيداع الدفعة المقدمة والرسوم الإدارية)</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_bank">
                                                {{$account_name->account_name}}
                                            </label>
                                        </div>
                                    </div>
                                    {{--contract order other type--}}
                                    @if($contract->contract_type == 1)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>مقدار القسط </label>
                                                <label class="form-control label-form"
                                                       id="step4_label_monthly_installment">{{$contract->premiums_value}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>القسط الأخير</label>
                                                <label class="form-control label-form"
                                                       id="step4_label_last_installment">{{$contract->last_premium}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>عدد الأقساط</label>
                                                <label class="form-control label-form"
                                                       id="step4_label_sum_installment">{{$contract->premiums_number}}</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-3 rassom_agd_div">
                                        <div class="form-group">
                                            <label>عمولة العقد </label>
                                            <label class="form-control label-form"
                                                   id="step4_label_rassom_agd">{{$contract->contract_profit}}</label>
                                        </div>
                                    </div>
                                    <br clear="both"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                            <br clear="both"/>
                            <input type="submit" value="حفظ العقد"
                                   class="btn btn-primary nextBtn btn-lg pull-right">
                            <a href="{{route('contracts.cancel',['id'=>$contract->id,'type'=>$contract->contract_type])}}"
                               class="btn btn-lg btn-warning  f_left">الغاء</a>
                        </div>
                        </div>
<br>
                        <br>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


