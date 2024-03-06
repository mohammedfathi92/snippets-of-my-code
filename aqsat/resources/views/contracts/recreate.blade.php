@extends('voyager::master')

@section('page_title', __('title.contract.recreate'))


@section('page_header')
    <h1><i class="fa fa-plus-circle"></i>العقود : اعاده اضافة العقد </h1>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            @include('include.message')
            <div id="step_one_message"></div>
            <div class="col-md-12">

                <!--steps 1-3-->
                <div class="box box-danger box-solid" id="contractCreateBox">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-plus-circle"></i>تعديل العقد</h3>
                    </div>

                    <div class="box-body">

                        <!--step_1-->
                        {{Form::open(['route'=> ['contracts.store',$type],'method'=>'post','id'=>'create_contract'])}}
                        <div class="row setup-content">
                            <div class="col-md-12">
                                <br clear="both"/>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">المستثمر/الحساب الإستثماري</label>
                                        <select onchange="get_products(this.value);GetBankAccount(this.value);"
                                                class="form-control select2"
                                                style="border:1px solid #aaa;"
                                                tabindex="1" id="investor" name="investor_id">
                                            <option value="">--أختر المستثمر --</option>
                                            @foreach($investors as $investor)
                                                <option value="{{$investor->id}}"
                                                        @if($investor->id == $contract->investor_id) selected @endif>{{$investor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">العميل
                                            <a href="#myModal_client" id="new_sponsor">
                                                <li class="fa fa-plus"></li>
                                                اضافة </a>
                                        </label>
                                        <div id="all_clients">
                                            <select name="client_id" class="form-control person_select select2"
                                                    tabindex="2">
                                                <option value="">-- أختر العميل --</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}"
                                                            @if($client->id == $contract->client_id) selected @endif>{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--  first_sponsor -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">الكفيل الأول
                                            <a href="#myModal_sponsor" class="add_new_client">
                                                <li class="fa fa-plus"></li>
                                                اضافة </a>
                                        </label>
                                        <div class="newsponsor">
                                            <select name="sponsor_id" id="CustomerSelectLabel"
                                                    class="form-control person_select select2" tabindex="2">
                                                <option value="">-- أختر الكفيل الاول --</option>
                                                @foreach($sponsors as $sponsor)
                                                    <option value="{{$sponsor->id}}"
                                                            @if($sponsor->id == $contract->sponsor_id)selected @endif>
                                                        {{$sponsor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--  second_sponsor -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">الكفيل الثاني
                                            <a href="#myModalto_sponsor_two" class="add_sponsor_two">
                                                <li class="fa fa-plus"></li>
                                                <span>اضافة</span>
                                            </a>
                                        </label>
                                        <div class="newSponsorTwo">
                                            <select name="sponsor_two_id" id="CustomerSelectLabel"
                                                    class="form-control person_select select2" tabindex="2">
                                                <option value="">-- أختر الكفيل الثانى --</option>
                                                @foreach($sponsors as $sponsor)
                                                    <option value="{{$sponsor->id}}"
                                                            @if($sponsor->id == $contract->sponsor_two_id)selected @endif>
                                                        {{$sponsor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{--</form>--}}
                        </div>

                        <hr>

                        <!--second step-->

                        <div class="row setup-content">
                            <ul class="alert alert-danger" id="result_step2" style="display: none;"></ul>
                            <div class="col-md-12">
                                <h4 class="alert alert-warning ">
                                    <span class="fa fa-warning"> يجب اعاده تحديد المستثمر من جديد  وتحديد الحساب فى المرحله الثالثه من اضافه العقد </span>
                                </h4>
                                <table id="wares_wizard" onload="GetWares();"
                                       class="table table-striped table-bordered table-hover display"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>الصنف</th>
                                        <th>المتوفر</th>
                                        <th>الكمية</th>
                                        <th>سعر الشراء</th>
                                        <th>سعر بيع الوحدة</th>
                                        <th> إجمالي البيع</th>
                                    </tr>
                                    </thead>
                                    <tbody id="store_body" class="investor_product">


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:left;">
                                            رأس المال
                                        </th>
                                        <th id="" style="background:#eee;">
                                            <input disabled id="items_price" value=0 placeholder="0" type="number"
                                                   min="0"
                                                   class="form-control"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" style="text-align:left;">
                                            نسبة الربح
                                        </th>
                                        <th style="background:#eee;">
                                            <input readonly type="text" class=" color form-control"
                                                   id="ProfitPercent" value="0"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" style="text-align:left;">
                                            إجمالي قيمة العقد
                                        </th>
                                        <th id="" style="background:#eee;">
                                            <input readonly type="text" value="0" id="contract_price"
                                                   id="total_price"
                                                   name="contract_price" class="form-control"/>
                                        </th>
                                    </tr>
                                    <input type="hidden" name="contract_id"
                                           value="{{isset($contract->id)? $contract->id : ''}}">
                                    </tfoot>
                                </table>
                                <hr/>
                                <br clear="both"/>

                            </div>
                        </div>


                        <!--third step-->

                        <div class="row setup-content">

                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label>
                                            تاريخ كتابة العقد
                                        </label>
                                        <div class="input-group">
                                            <input type="text" style="display:none;" disabled="disabled"
                                                   id="date_agd_ummalqura" onchange=""
                                                   name="contract_date" placeholder="الصيغة: 1439/08/07"
                                                   class="form-control "/>
                                            <input type="text" tabindex="6" id="date_agd_gregorian" onchange=""
                                                   name="contract_date"
                                                   class="form-control "
                                                   value="{{date('Y-m-d', strtotime($contract->contract_date))}}"/>
                                            <span class="input-group-btn ">
                                           <button style="margin-top: 0px;" id="date_calender" class="btn green"
                                                   type="button"
                                                   onclick="DateCalender(); getattr();">هجري</button>
                                            </span>
                                            <input type="hidden" id="date_calender_hidden" name="date_calender"
                                                   value="H"/>
                                        </div>
                                    </div>
                                </div>


                                {{--contract premium--}}
                                @if(isset($type)  and $type == 1)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>جدولة الأقساط بالتقويم</label>
                                            <select name="premiums_date_type"
                                                    id="installment_schedule_type"
                                                    class="form-control toggle select2" onchange="getDate(this.value)">
                                                <option value="0" {{$contract->premiums_date_type == 0? 'selected':''}}>
                                                    <span>الهجري</span>
                                                </option>
                                                <option value="1" {{$contract->premiums_date_type == 1? 'selected':''}}>
                                                    <span>الميلادي</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>نوع الجدولة</label>
                                            <select class="form-control select2" tabindex="11" name="schedule_type">
                                                <option value="0" @if($contract->schedule_type ==0) selected @endif >
                                                    يومي
                                                </option>
                                                <option value="1" @if($contract->schedule_type ==1) selected @endif>
                                                    أسبوعي
                                                </option>
                                                <option value="2" @if($contract->schedule_type ==2) selected @endif>
                                                    شهري
                                                </option>
                                                <option value="3" @if($contract->schedule_type ==3) selected @endif>نصف
                                                    سنوي
                                                </option>
                                                <option value="4" @if($contract->schedule_type ==4) selected @endif>
                                                    سنوي
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>
                                                <span>تاريخ بداية الأقساط</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text"
                                                       style="width:239px; {{$contract->premiums_date_type == 1? 'display:none;':''}}"
                                                       tabindex="15"
                                                       name="premiums_start_date_hijry"
                                                       id="date_start_agd_ummalqura" placeholder="الصيغة: 1439/08/27"
                                                       class="form-control " value="{{$contract->contract_date}}"/>
                                                <input type="text" tabindex="15"
                                                       style="width: 239px; {{$contract->premiums_date_type == 0? 'display:none;':''}}"
                                                       name="premiums_start_date"
                                                       id="date_start_agd_gregorian" placeholder="2018/08/27"
                                                       class="form-control" value="{{$contract->contract_date}}"/>
                                            </div>

                                            @if ($errors->has('premiums_start_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('premiums_start_date') }}
                                                    </strong></span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>قيمة العقد</label>
                                        <input readonly type="number" value="{{$contract->contract_value}}"
                                               class="form-control"
                                               name="contract_value" id="label_total_price">
                                        @if ($errors->has('contract_value'))
                                            <span class="help-block"><strong>{{ $errors->first('contract_value') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>إجمالي الربح</label>
                                        <input readonly type="number" class="form-control" id="totalProfit"
                                               value="{{$contract->total_profit}}" name="total_profit">
                                        @if ($errors->has('total_profit'))
                                            <span class="help-block"><strong>{{ $errors->first('total_profit') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>الدفعة المقدمة</label>
                                        <input type="number" placeholder="في حال كانت هناك دفعة"
                                               name="first_payment" id="first_payment"
                                               value="{{$contract->first_payment}}"
                                               class="form-control"
                                               tabindex="7" onkeyup="firstPayment(this.value);"/>
                                        @if ($errors->has('first_payment'))
                                            <span class="help-block"><strong>{{ $errors->first('first_payment') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>الحساب (لإيداع الدفعة المقدمة والرسوم الإدارية)</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;"
                                                id="investor_accounts" name="account_id">
                                            <option value=""> اختر المستثمر اولا</option>
                                            @foreach(\App\Company_account::where('user_id',$contract->investor_id)->get() as $account)
                                                <option value="{{$account->id}}"
                                                        @if($account->id == $contract->account_id) selected @endif> {{$account->account_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--contract other type--}}
                                @if(isset($type)  and $type == 2)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>
                                                <span> تاريخ حلول الدفع </span>
                                            </label>
                                            <div class="input-group">
                                                <input type="date" value="{{$contract->premiums_start_date}}"
                                                       name="premiums_start_date"
                                                       class="form-control" style="width: 227px;">
                                                @if ($errors->has('premiums_start_date'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('premiums_start_date') }}
                                                    </strong></span>
                                                @endif
                                                <input type="hidden" name="premiums_value" value="">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <br clear="both"/>


                                {{--contract premium--}}
                                @if(isset($type)  and $type == 1)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>عدد الأقساط </label>
                                            <input type="number" tabindex="12" id="premiums_number"
                                                   name="premiums_number"
                                                   placeholder="كم عدد الأقساط" onkeyup="premiumNum(this.value);"
                                                   value="{{$contract->premiums_number}}"
                                                   class="form-control"/>
                                            @if ($errors->has('premiums_number'))
                                                <span class="help-block"><strong>{{ $errors->first('premiums_number') }}</strong></span>
                                            @endif
                                            <input type="hidden" id="freeze_count_installment"
                                                   name="freeze_count_installment" value="0"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>مقدار القسط </label>
                                            <input type="text" tabindex="13" id="premiums_value" name="premiums_value"
                                                   onkeyup="premiumValue(this.value);"
                                                   placeholder="مقدار القسط" value="{{$contract->premiums_value}}"
                                                   class="form-control  premium_amount"/>
                                            @if ($errors->has('premiums_value'))
                                                <span class="help-block"><strong>{{ $errors->first('premiums_value') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>القسط الأخير</label>
                                            <input type="text" tabindex="14" readonly="" id="last_premium"
                                                   name="last_premium" placeholder="مقدار القسط "
                                                   value="{{$contract->last_premium}}"
                                                   class="form-control"/>
                                            @if ($errors->has('last_premium'))
                                                <span class="help-block"><strong>{{ $errors->first('last_premium') }}</strong></span>
                                            @endif
                                            <span class="label label-danger" style="display: none;"
                                                  id="msg_last_qasst">يجب أن يكون مقدار القسط أقل</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> نوع العمولة </label>
                                        <select name="profit_type" class="form-control">
                                            <option value="">-- أختر --</option>
                                            <option value="1"> نسبة من العقد </option>
                                            <option value="2"> مبلغ </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3 rassom_agd_div">
                                    <div class="form-group">
                                        <label>عمولة العقد <a style="color:orange;" id="RassomAGD"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                        <input type="text" tabindex="19" id="rassom_agd" name="contract_profit"
                                               placeholder="" value="{{$contract->contract_profit}}" class="form-control number"/>
                                        @if ($errors->has('contract_profit'))
                                            <span class="help-block"><strong>{{ $errors->first('contract_profit') }}</strong></span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> طرق دفع العمولة </label>
                                        <select name="profit_pay_type" class="form-control">
                                            <option value="">-- أختر --</option>
                                            <option value="1"> فى اول الاقساط </option>
                                            <option value="2"> مقسمة على عدد الاقساط </option>
                                            <option value="3">  فى اخر الاقساط </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>المجموعة </label>
                                        <select name="group_id" class="form-control">
                                            <option value="">-- أختر --</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}"
                                                        @if($contract->group_id ==$group->id) selected @endif >{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br clear="both"/>
                                <hr/>


                                <input type="hidden" name="t" value="Taqseet"/>
                                <input type="hidden" class="sale_id" name="sale_id" value="3"/>
                                {{--</form>--}}
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger my_btn_left"><i class="fa fa-plus-circle"></i>
                                <span>  إضافة العقد </span>
                            </button>
                        </div>
                        {!! Form::close()!!}


                        {{--<input type="hidden" name="current_step" id="current_step" value="1"/>--}}
                    </div>
                </div>


            {{--model new client--}}
            <!-- Modal -->
                <div class="modal fade myModal_client" style="z-index: 999999;" id="myModal" tabindex="-1"
                     role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">إضافة عميل جديد</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="clientForm" action="#"
                                      id="NewCustomerForm">
                                    <div id="message"></div>
                                    <div id="form_inputs">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>اسم العميل</label>
                                                <input tabindex="1" name="full_name" id="full_name"
                                                       value="{{old('full_name')}}"
                                                       placeholder="الأسم رباعياً" class="form-control required">
                                                @if ($errors->has('full_name'))
                                                    <span class="help-block">
                <strong>{{ $errors->first('full_name') }}</strong>
                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>الهوية الوطنية / الإقامة</label>
                                                <input tabindex="2" name="national_id" value="{{old('national_id')}}"
                                                       placeholder="رقم الهوية الوطنية / الإقامة"
                                                       class="form-control number  ">
                                                @if ($errors->has('national_id'))
                                                    <span class="help-block"><strong>{{ $errors->first('national_id') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>تاريخ الإصدار</label>
                                                <input tabindex="3" id="EsdarDate" name="release_date" type="date"
                                                       value="{{old('release_date')}}"
                                                       placeholder="YYYY-MM-DD" class="form-control ">
                                                @if ($errors->has('release_date'))
                                                    <span class="help-block"><strong>{{ $errors->first('release_date') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>المصدر</label>
                                                <input tabindex="4" name="release_place"
                                                       value="{{old('release_place')}}"
                                                       placeholder="مكان إصدار الهوية" class="form-control ">
                                                @if ($errors->has('release_place'))
                                                    <span class="help-block"><strong>{{ $errors->first('release_place') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم الجوال</label>
                                                <input tabindex="5" style="width:100%!important;" name="mobile"
                                                       value="{{old('mobile')}}" class="form-control">
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block"><strong>{{ $errors->first('mobile') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم الهاتف</label>
                                                <input tabindex="6" style="width:100%!important;" name="phone"
                                                       value="{{old('phone')}}" class="form-control">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>العنوان</label>
                                                <input tabindex="7" name="address" value="{{old('address')}}"
                                                       placeholder="يكتب عنوان العميل هنا" class="form-control ">
                                                @if ($errors->has('address'))
                                                    <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>العمل</label>
                                                <input tabindex="8" name="work" value="{{old('work')}}"
                                                       placeholder="اسم جهة العمل"
                                                       class="form-control ">
                                                @if ($errors->has('work'))
                                                    <span class="help-block"><strong>{{ $errors->first('work') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم هاتف العمل</label>
                                                <input tabindex="9" name="work_phone" value="{{old('work_phone')}}"
                                                       class="form-control">
                                                @if ($errors->has('work_phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('work_phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنسية</label>
                                                <input tabindex="10" name="nationality" value="{{old('nationality')}}"
                                                       placeholder="جنسية العميل"
                                                       value="سعودي" class="form-control">
                                                @if ($errors->has('nationality'))
                                                    <span class="help-block"><strong>{{ $errors->first('nationality') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                        {{--<label>البريد الإلكتروني</label>--}}
                                        {{--<input tabindex="11" name="email" id="email" value="{{old('email')}}"--}}
                                        {{--placeholder="example@website.com"--}}
                                        {{--class="form-control email">--}}
                                        {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>--}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنس</label>
                                                <select name="gender" tabindex="12" class="form-control">
                                                    <option value="1">ذكر</option>
                                                    <option value="0">أنثى</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ملاحظات إضافية</label>
                                                <textarea tabindex="13" name="notes" placeholder="أكتب أي ملاحظة إضافية"
                                                          class="form-control">
                </textarea>
                                                @if ($errors->has('notes'))
                                                    <span class="help-block"><strong>{{ $errors->first('notes') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" value="0" id="le"/>
                                    </div>


                                    <br clear="both"/>
                                    <hr/>
                                    <button type="button" onclick="newClient();" id="submit_btn" tabindex="123"
                                            class="btn btn-primary btn-sm close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span style="font-size: 18px; padding: 11px;">إضافة</span>
                                    </button>


                                    <br clear="both"/>
                                    <style>
                                        .calendars-popup {
                                            z-index: 1051 !important;
                                        }
                                    </style>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            {{--model new sponsor--}}
            <!-- Modal -->
                <div class="modal fade myModal_sponsor  create_sponsor" style="z-index: 999999;" id="new_client"
                     tabindex="-1"
                     role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">إضافة كفيل جديد</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="sponsorForm" action="#"
                                      id="NewCustomerForm">
                                    <div id="form_inputs">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>اسم العميل</label>
                                                <input tabindex="1" name="full_name" id="full_name"
                                                       value="{{old('full_name')}}"
                                                       placeholder="الأسم رباعياً" class="form-control required">
                                                @if ($errors->has('full_name'))
                                                    <span class="help-block">
                                                   <strong>{{ $errors->first('full_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>الهوية الوطنية / الإقامة</label>
                                                <input tabindex="2" name="national_id" value="{{old('national_id')}}"
                                                       placeholder="رقم الهوية الوطنية / الإقامة"
                                                       class="form-control number  ">
                                                @if ($errors->has('national_id'))
                                                    <span class="help-block"><strong>{{ $errors->first('national_id') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>تاريخ الإصدار</label>
                                                <input tabindex="3" id="EsdarDate" name="release_date" type="date"
                                                       value="{{old('release_date')}}"
                                                       placeholder="YYYY-MM-DD" class="form-control ">
                                                @if ($errors->has('release_date'))
                                                    <span class="help-block"><strong>{{ $errors->first('release_date') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>المصدر</label>
                                                <input tabindex="4" name="release_place"
                                                       value="{{old('release_place')}}"
                                                       placeholder="مكان إصدار الهوية" class="form-control ">
                                                @if ($errors->has('release_place'))
                                                    <span class="help-block"><strong>{{ $errors->first('release_place') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم الجوال</label>
                                                <input tabindex="5" style="width:100%!important;" name="mobile"
                                                       value="{{old('mobile')}}" class="form-control">
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block"><strong>{{ $errors->first('mobile') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم الهاتف</label>
                                                <input tabindex="6" style="width:100%!important;" name="phone"
                                                       value="{{old('phone')}}" class="form-control">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>العنوان</label>
                                                <input tabindex="7" name="address" value="{{old('address')}}"
                                                       placeholder="يكتب عنوان العميل هنا" class="form-control ">
                                                @if ($errors->has('address'))
                                                    <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>العمل</label>
                                                <input tabindex="8" name="work" value="{{old('work')}}"
                                                       placeholder="اسم جهة العمل"
                                                       class="form-control ">
                                                @if ($errors->has('work'))
                                                    <span class="help-block"><strong>{{ $errors->first('work') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم هاتف العمل</label>
                                                <input tabindex="9" name="work_phone" value="{{old('work_phone')}}"
                                                       class="form-control">
                                                @if ($errors->has('work_phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('work_phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنسية</label>
                                                <input tabindex="10" name="nationality" value="{{old('nationality')}}"
                                                       placeholder="جنسية العميل"
                                                       value="سعودي" class="form-control">
                                                @if ($errors->has('nationality'))
                                                    <span class="help-block"><strong>{{ $errors->first('nationality') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                        {{--<label>البريد الإلكتروني</label>--}}
                                        {{--<input tabindex="11" name="email" id="email" value="{{old('email')}}"--}}
                                        {{--placeholder="example@website.com"--}}
                                        {{--class="form-control email">--}}
                                        {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>--}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنس</label>
                                                <select name="gender" tabindex="12" class="form-control">
                                                    <option value="1">ذكر</option>
                                                    <option value="0">أنثى</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ملاحظات إضافية</label>
                                                <textarea tabindex="13" name="notes" placeholder="أكتب أي ملاحظة إضافية"
                                                          class="form-control">
                </textarea>
                                                @if ($errors->has('notes'))
                                                    <span class="help-block"><strong>{{ $errors->first('notes') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" value="0" id="le"/>
                                    </div>


                                    <br clear="both"/>
                                    <hr/>
                                    <button type="button" onclick="newSponsor();" id="submit_btn" tabindex="123"
                                            class="btn btn-primary btn-sm close" data-dismiss="modal" aria-label="Close"
                                    >
                                        <span style="font-size: 18px; padding: 11px;">إضافة</span>
                                    </button>


                                    {{--<button type="button"  id="cancel"> الغاء </button>--}}


                                    <br clear="both"/>
                                    <style>
                                        .calendars-popup {
                                            z-index: 1051 !important;
                                        }
                                    </style>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            {{--model new sponsor two--}}
            <!-- Modal -->
                <div class="modal fade myModal_sponsor_two  create_sponsor" style="z-index: 999999;" id="new_client"
                     tabindex="-1"
                     role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">إضافة كفيل ثانى جديد</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="sponsorTwoForm" action="#"
                                      id="NewCustomerForm">
                                    <div id="form_inputs">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>اسم العميل</label>
                                                <input tabindex="1" name="full_name" id="full_name"
                                                       value="{{old('full_name')}}"
                                                       placeholder="الأسم رباعياً" class="form-control required">
                                                @if ($errors->has('full_name'))
                                                    <span class="help-block">
                                                   <strong>{{ $errors->first('full_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>الهوية الوطنية / الإقامة</label>
                                                <input tabindex="2" name="national_id" value="{{old('national_id')}}"
                                                       placeholder="رقم الهوية الوطنية / الإقامة"
                                                       class="form-control number  ">
                                                @if ($errors->has('national_id'))
                                                    <span class="help-block"><strong>{{ $errors->first('national_id') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>تاريخ الإصدار</label>
                                                <input tabindex="3" id="EsdarDate" name="release_date" type="date"
                                                       value="{{old('release_date')}}"
                                                       placeholder="YYYY-MM-DD" class="form-control ">
                                                @if ($errors->has('release_date'))
                                                    <span class="help-block"><strong>{{ $errors->first('release_date') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>المصدر</label>
                                                <input tabindex="4" name="release_place"
                                                       value="{{old('release_place')}}"
                                                       placeholder="مكان إصدار الهوية" class="form-control ">
                                                @if ($errors->has('release_place'))
                                                    <span class="help-block"><strong>{{ $errors->first('release_place') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم الجوال</label>
                                                <input tabindex="5" style="width:100%!important;" name="mobile"
                                                       value="{{old('mobile')}}" class="form-control">
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block"><strong>{{ $errors->first('mobile') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم الهاتف</label>
                                                <input tabindex="6" style="width:100%!important;" name="phone"
                                                       value="{{old('phone')}}" class="form-control">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>العنوان</label>
                                                <input tabindex="7" name="address" value="{{old('address')}}"
                                                       placeholder="يكتب عنوان العميل هنا" class="form-control ">
                                                @if ($errors->has('address'))
                                                    <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>العمل</label>
                                                <input tabindex="8" name="work" value="{{old('work')}}"
                                                       placeholder="اسم جهة العمل"
                                                       class="form-control ">
                                                @if ($errors->has('work'))
                                                    <span class="help-block"><strong>{{ $errors->first('work') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رقم هاتف العمل</label>
                                                <input tabindex="9" name="work_phone" value="{{old('work_phone')}}"
                                                       class="form-control">
                                                @if ($errors->has('work_phone'))
                                                    <span class="help-block"><strong>{{ $errors->first('work_phone') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنسية</label>
                                                <input tabindex="10" name="nationality" value="{{old('nationality')}}"
                                                       placeholder="جنسية العميل"
                                                       value="سعودي" class="form-control">
                                                @if ($errors->has('nationality'))
                                                    <span class="help-block"><strong>{{ $errors->first('nationality') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنس</label>
                                                <select name="gender" tabindex="12" class="form-control">
                                                    <option value="1">ذكر</option>
                                                    <option value="0">أنثى</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ملاحظات إضافية</label>
                                                <textarea tabindex="13" name="notes" placeholder="أكتب أي ملاحظة إضافية"
                                                          class="form-control">
                </textarea>
                                                @if ($errors->has('notes'))
                                                    <span class="help-block"><strong>{{ $errors->first('notes') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" value="0" id="le"/>
                                    </div>


                                    <br clear="both"/>
                                    <hr/>
                                    <button type="button" onclick="newSponsorTwo();" id="submit_btn" tabindex="123"
                                            class="btn btn-primary btn-sm close" data-dismiss="modal" aria-label="Close"
                                    >
                                        <span style="font-size: 18px; padding: 11px;">إضافة</span>
                                    </button>

                                    <br clear="both"/>
                                    <style>
                                        .calendars-popup {
                                            z-index: 1051 !important;
                                        }
                                    </style>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>


@endsection


@section('css')

@include('contracts.components.calendars_styles')

          <style type="text/css">
.calendars-popup[style] {
   z-index: 9999999999 !important;
}

  </style>
@stop


@section('javascript')
@include('contracts.components.calendars_scripts')


    <script>
        function getDate(value) {

            $('#date_start_agd_gregorian').toggle();

            $('#date_start_agd_ummalqura').toggle();

        }


        function DateCalender() {
                  var hij = $('#date_agd_ummalqura');
            if (hij.attr('disabled')) {
                hij.removeAttr('disabled', true);
            } else {
                hij.attr('disabled', true);
            }


            var mi = $('#date_agd_gregorian');
            if (mi.attr('disabled')) {
                mi.removeAttr('disabled');
            } else {
                mi.attr('disabled', true);
            }
            var date_calender_type = $('#date_calender_hidden').val();

            $('#date_agd_ummalqura').hide();
            $('#dg_ummalqura').hide();
            $('#date_agd_gregorian').hide();
            $('#dg_gregorian').hide();

            if (date_calender_type == 'G') { // if it gregorian , convert it to ummalqura
                $('#date_agd_ummalqura').show();
                $('#dg_ummalqura').show();
                $('#date_agd_gregorian').hide();
                $('#dg_gregorian').hide();

                $('#date_calender').html('هجري');
                $('#date_calender_2').html('هجري');
                $('#date_calender_hidden').val('H');

                $('#date_agd_ummalqura').calendarsPicker({
                    calendar: $.calendars.instance('ummalqura', 'ar'),
                    dateFormat: 'yyyy/mm/dd',
                                   minDate: '-10y',
                  minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                                    selectDefaultDate: true
                });

                $('#dg_ummalqura').calendarsPicker({
                    calendar: $.calendars.instance('ummalqura', 'ar'),
                    dateFormat: 'yyyy/mm/dd',
                       minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                    selectDefaultDate: true
                });


            } else {
                $('#date_agd_gregorian').show();
                $('#dg_gregorian').show();
                $('#date_agd_ummalqura').hide();
                $('#dg_ummalqura').hide();
                $('#date_calender , #date_calender_2').html('ميلادي');
                $('#date_calender_hidden').val('G');
                $('#date_agd_gregorian').calendarsPicker({
                    calendar: $.calendars.instance('gregorian', 'ar-EG'),
                    dateFormat: 'yyyy/mm/dd',
                           minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                    selectDefaultDate: true
                });
                $('#dg_gregorian').calendarsPicker({
                    calendar: $.calendars.instance('gregorian', 'ar-EG'),
                    dateFormat: 'yyyy/mm/dd',
                     minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
            selectDefaultDate: true

                });

            }

        }

        $(document).ready(function () {

            $('#date_start_agd_gregorian').calendarsPicker({
                calendar: $.calendars.instance('gregorian', 'ar-EG'),
                dateFormat: 'yyyy/mm/dd',
                minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                selectDefaultDate: true
            });

            $('#date_start_agd_ummalqura').calendarsPicker({
                calendar: $.calendars.instance('ummalqura', 'ar'),
                dateFormat: 'yyyy/mm/dd',
                             minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                selectDefaultDate: true
            });

            $('#date_start_agd_shamsi').calendarsPicker({
                calendar: $.calendars.instance('persian', 'ar'),
                dateFormat: 'yyyy/mm/dd',
                   minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                selectDefaultDate: true
            });

            $('#date_calender , #date_calender_2').html('ميلادي');
            $('#date_calender_hidden').val('G');
            $('#date_agd_gregorian').calendarsPicker({
                calendar: $.calendars.instance('gregorian', 'ar-EG'),
                dateFormat: 'yyyy/mm/dd',
                minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                selectDefaultDate: true
            });
            $('#dg_gregorian').calendarsPicker({
                calendar: $.calendars.instance('gregorian', 'ar-EG'),
                dateFormat: 'yyyy/mm/dd',
                minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                selectDefaultDate: true

            });

        });

    </script>


    <script>

        $(document).ready(function () {
            $("#new_sponsor").on('click', function () {
                $('.myModal_client').modal();
            });

            $(".add_new_client").on('click', function () {
                $('.myModal_sponsor').modal();
            });

            $(".add_sponsor_two").on('click', function () {
                $('.myModal_sponsor_two').modal();
            });


        });


        function data(id) {

            var i = 1;
            var n = 0;
            var totalPrice = 0;
            var contractPrice = 0;
            var profit = 0;
            // alert($('#items_price').val());

            for (i = 1; i < Number($('#product_num').val()) + 1; ++i) {


                     var payment_price = $('#payment_price_' + i).val();
                var price = $('#price_' + i).val();
                var quantity = $('#quantity_' + i).val();
                var total_data = Number(price) * Number(quantity);
                // var total_price = $('.total_' + i).val();
               // var item_price = Number(total_price) / Number(quantity);
                // $('#price_' + i).val(item_price);
                $('.total_' + i).val(total_data);
                totalPrice += Number(quantity) * Number(payment_price);
                contractPrice += Number($('.total_' + i).val());


            }

            fContract_price(totalPrice, contractPrice);


        }

              function tPrice(id) {

            var i = 1;
            var n = 0;
            var totalPrice = 0;
            var contractPrice = 0;
            var profit = 0;
            // alert($('#items_price').val());

            for (i = 1; i < Number($('#product_num').val()) + 1; ++i) {


                var payment_price = $('#payment_price_' + i).val();
                var price = $('#price_' + i).val();
                var quantity = $('#quantity_' + i).val();

                var total_price = $('.total_' + i).val();
               var item_price = Number(total_price) / Number(quantity);
                $('#price_' + i).val(item_price);

                totalPrice += Number(quantity) * Number(payment_price);
                contractPrice += Number($('.total_' + i).val());


            }

            fContract_price(totalPrice, contractPrice);


        }

        function fContract_price(totalPrice, contractPrice){
        $('#items_price').val(totalPrice);
            $('#contract_price').val(contractPrice);

            profit = (((contractPrice - totalPrice) / contractPrice) * 100).toFixed(2);

            if (contractPrice == 0) {
                $('#ProfitPercent').val(0);
                $('#ProfitPercent').css('background', '#eeeeee;');
            } else {
                $('#ProfitPercent').val(profit);
            }


            $('#label_total_price').val(contractPrice);
            $('.premium_amount').val(contractPrice);

            $('#totalProfit').val(contractPrice - totalPrice);

            reset_profit();
        }


        var profit_value = $('#ProfitPercent').val();


        function reset_profit() {
            profit_value = $('#ProfitPercent').val();

            if (profit_value >= 0) {
                $('#ProfitPercent').css('background', '#329247').css('color', 'white');
            } else {
                $('#ProfitPercent').css('background', '#d22a13').css('color', 'white');
            }

        }


        function select_item(id) {

            if ($('#item_' + id).is(":checked")) {
                $('#quantity_' + id).removeAttr("disabled");
                $('#price_' + id).removeAttr("disabled");
                 $('#total_' + id).removeAttr("disabled");


            } else {


                $('#items_price').val
                (Number($('#items_price').val()) - (Number($('#quantity_' + id).val()) * Number($('#payment_price_' + id).val())));

                $('#contract_price').val($('#contract_price').val() - $('#total_' + id).val());

                if ($('#contract_price').val() == 0) {
                    $('#ProfitPercent').val(0);
                } else {
                    $('#ProfitPercent').val(((($('#contract_price').val() - $('#items_price').val()) / $('#contract_price').val()) * 100).toFixed(2));
                }

                $('#first_payment').val(0);
                $('#premiums_value').val('');
                $('#last_premium').val('');


                $('#quantity_' + id).attr("disabled", true);
                $('#price_' + id).attr("disabled", true);
                $('#price_' + id).val('');
                $('#quantity_' + id).val('');
                $('.total_' + id).val('');

            }

            $('#totalProfit').val(Number($('#contract_price').val()) - Number($('#items_price').val()));
            $('#label_total_price').val($('#contract_price').val());
        }


        function get_products(id) {

            $.ajax({
                type: 'post',
                url: '/admin/contracts/new_data',
                data: {id: id},
                success: function (data) {
                    $(".investor_product").html(data);
                }
            });
        }


        function GetBankAccount(id) {
            $.ajax({
                type: 'post',
                url: '/admin/contracts/ajax_investor_accounts',
                data: {id: id},
                success: function (data) {
                    $("#investor_accounts").html(data);
                }
            });
        }


        function firstPayment(value) {

            if (!value == '') {
                var premiumValue = (Number($('#label_total_price').val()) - Number(value)) / Number($('#premiums_number').val());
                $('#premiums_value').val(premiumValue);
                $('#last_premium').val(premiumValue);
            } else {
                $('#premiums_value').val('');
                $('#last_premium').val('');
            }
        }

        function premiumNum(value) {
            if (!value == '') {
                var premiumValue = (Number($('#label_total_price').val()) - Number($('#first_payment').val())) / Number(value);
                $('#premiums_value').val(premiumValue);
                $('#last_premium').val(premiumValue);
            } else {
                $('#premiums_value').val('');
                $('#last_premium').val('');
            }
        }

        function premiumValue(value) {

            var premiumNum = Number($('#label_total_price').val() - Number($('#first_payment').val())) / Number(value);
            $('#premiums_number').val(premiumNum);
            $('#last_premium').val(premiumNum);
        }

             function newUser(type, select) {
            $.ajax({
                type: 'post',
                url: '/admin/contracts/ajax/new_user_store/'+ type,
                data: $('#newUserForm').serialize(),
                success: function (data) {
                    $("#"+ select).html(data);
                    // $(select).html(data).filter('#new_select');
                }
            });
        }

        // function newSponsor() {
        //     $.ajax({
        //         type: 'post',
        //         url: '/admin/contracts/ajax_sponsor_two_store',
        //         data: $('#sponsorForm').serialize(),
        //         success: function (data) {
        //             $("#sponsor_messages").html(data).filter('#messages');
        //             $(".newsponsor").html(data).filter('#new_select');
        //         }
        //     });
        // }

        // function newSponsorTwo() {
        //     $.ajax({
        //         type: 'post',
        //         url: '/admin/contracts/ajax_sponsor_store',
        //         data: $('#sponsorTwoForm').serialize(),
        //         success: function (data) {

        //             $("#sponsor_two_messages").html(data).filter('#messages');
        //             $(".newSponsorTwo").html(data).filter('#new_select');
        //         }
        //     });
        // }



    </script>
   <script>
        function openNewUserForm(type, select) {
            $('#newUserFormModal').modal('show').find('.modal-body').load('/admin/contracts/ajax/new_user_form/'+ type+'/'+ select);
        }
    </script>



@endsection