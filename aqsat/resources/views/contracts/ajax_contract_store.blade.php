{{--@endif--}}
@if(isset($contract))
    {{--contrac_id--}}
    <input type="hidden" name="ajax_contract_id" id="contract_id" value="{{$contract->id}}">
    {{--investors_id--}}
    <input type="hidden" name="ajax_investor_id" id="investor_id" value="{{$contract->investor_id}}">

@endif



@if(isset($no_items))

    <div class="alert alert-danger">
        <button type="button" data-dismiss="alert" class="btn btn-danger"
                aria-hidden="true">×
        </button>
        <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة تحذيرية</strong>
        <hr class="message-inner-separator">
        <p>
        <ul>
            <li style="font-size: 17px;">  {{ $no_items }} </li>
        </ul>
        </p>
    </div>

@endif






@if(isset($quantity))

    <div class="alert alert-danger">
        <button type="button" data-dismiss="alert" class="btn btn-danger"
                aria-hidden="true">×
        </button>
        <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة تحذيرية</strong>
        <hr class="message-inner-separator">
        <p>
        <ul>
            <li style="font-size: 17px;">  {{ $quantity }} </li>
        </ul>
        </p>
    </div>

@else

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <button type="button" data-dismiss="alert" class="btn btn-danger"
                    aria-hidden="true">×
            </button>
            <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة تحذيرية</strong>
            <hr class="message-inner-separator">
            <p>
            <ul>
                @foreach($errors->all() as $errors)
                    <li style="font-size: 17px;">  {{ $errors }} </li>
                @endforeach
            </ul>
            </p>
        </div>

    @else

        @if(isset($check))

            <div class="alert alert-danger">
                <button type="button" data-dismiss="alert" class="btn btn-danger"
                        aria-hidden="true">×
                </button>
                <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة تحذيرية</strong>
                <hr class="message-inner-separator">
                <p>
                <ul>
                    <li style="font-size: 17px;">  {{ $check }} </li>
                </ul>
                </p>
            </div>

        @else

            @if(isset($step_four))

                <div class="row setup-content" id="step-4">
                    <ul class="alert alert-danger" id="result_step4" style="display: none;"></ul>
                    <div class="col-md-12">

                        {!! Form::open(['route'=>['contracts.save',$contract->id],'method'=>'post','id'=>'step_four']) !!}

                        <input type="hidden" name="s" value="4"/>
                        <div id="loader4" style="background:white;width:100%;padding:50px;display:none">
                            <center><img src=""/></center>
                            <br clear="both"/>
                        </div>
                        <div id="step_4_div">
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        البيانات الأساسية
                                    </div>
                                    <div class="tools hidden-xs">
                                        <a href="javascript:;" class="remove" data-original-title=""
                                           title="">
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body ">
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
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->pivot->price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3"
                                        style="font-family:'Kufi';font-weight:normal;font-size:18px;background-color:#67809f;color:white;text-align:left;">
                                        قيمة العقد
                                    </td>
                                    <td style="background-color:#fff;text-align:center;"
                                        id="label_ware_total_items">{{$contract->contract_value}}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <br clear="both"/>
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        معلومات العقد
                                    </div>
                                    <div class="tools hidden-xs">
                                        <a href="javascript:;" class="remove" data-original-title=""
                                           title="">
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> نوع العقد</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_type_agd">{{$contract->contract_type? 'اجل':'تقسيط'}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>تاريخ كتابة العقد</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_agd_date">{{$contract->contract_date}}</label>
                                        </div>
                                    </div>
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
                                                   id="step4_label_type_installment">{{$contract->schedule_type}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>تاريخ أول قسط</label>
                                            <label class="form-control label-form"
                                                   id="step4_label_start_installment">{{$contract->premiums_start_date}}</label>
                                        </div>
                                    </div>
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
                                                   id="step4_label_bank">{{$contract->account_id}}</label>
                                        </div>
                                    </div>
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

                        <br clear="both"/>
                        <div>
                            <br clear="both"/>
                            <input type="submit" value="Save Contract"  class="btn btn-primary nextBtn btn-lg pull-right">
                            <a href="#"
                               class="btn btn-lg btn-warning  f_left">العودة</a>
                        </div>
                        <br clear="both"/>

                        {!! Form::close() !!}
                    </div>
                </div>

            @else

                <div class="alert alert-success">
                    <button type="button" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong class="text-center" style="font-size: 20px;margin-right: 8px;">success message</strong>
                    <hr class="message-inner-separator">
                    <p>
                    <ul>
                        <li style="font-size: 17px;">new contract created</li>
                    </ul>
                    </p>
                </div>

            @endif

        @endif

    @endif
@endif

