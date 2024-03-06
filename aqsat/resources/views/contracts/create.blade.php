@extends('voyager::master')

@section('page_title', __('title.contract.create'))

@section('page_header')
    <h1><i class="fa fa-plus-circle"></i>العقود : إضافة عقد جديد </h1>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            @include('include.message')
            <div id="message_new_user"></div>
            <div id="step_one_message"></div>
            <div class="col-md-12">
                <!--steps 1-3-->
                <div class="box box-danger box-solid" id="contractCreateBox">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-plus-circle"></i>إضافة عقد جديد</h3>
                    </div>

                    <div class="box-body">

                        <!--step_1-->
                        {{Form::open(['route'=> ['contracts.store',$type],'method'=>'post','id'=>'create_contract'])}}
                        <div class="row setup-content">
                            <div class="col-md-12">
                                <br clear="both"/>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('investor_id') ? ' has-error' : '' }}">
                                        <label class="control-label">المستثمر/الحساب الإستثماري</label>
                                        <select onchange="get_products(this.value);GetBankAccount(this.value);"
                                                class="form-control select2 "
                                                style="border:1px solid #aaa;"
                                                tabindex="1" id="investor" name="investor_id">
                                            <option value="">--أختر المستثمر --</option>
                                            @foreach($investors as $investor)
                                                <option value="{{$investor->id}}" 
                                                >{{$investor->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('investor_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('investor_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('client_id') ? ' has-error' : '' }}">
                                        <label class="control-label">العميل
                                            <a href="javascript:;" onclick="openNewUserForm('client', 'all_clients')">
                                                <li class="fa fa-plus"></li>
                                                اضافة </a>
                                        </label>
                                        <div id="all_clients">
                                            <select name="client_id" class="form-control person_select select2">
                                                <option value="">-- أختر العميل --</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('client_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('client_id') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!--  first_sponsor -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">الكفيل الأول
                                            <a href="javascript:;" onclick="openNewUserForm('sponsor_1', 'sponsor_1_list')">
                                                <li class="fa fa-plus"></li>
                                                اضافة </a>
                                        </label>
                                        <div class="newsponsor" id="sponsor_1_list">
                                            <select name="sponsor_id"
                                                    class="form-control person_select select2">
                                                <option value="">-- أختر الكفيل الاول --</option>
                                                @foreach($sponsors as $sponsor)
                                                    <option value="{{$sponsor->id}}">{{$sponsor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--  second_sponsor -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">الكفيل الثاني
                                            <a href="javascript:;" onclick="openNewUserForm('sponsor_2', 'sponsor_2_list')" >
                                                <li class="fa fa-plus"></li>
                                                <span>اضافة</span>
                                            </a>
                                        </label>
                                        <div class="newSponsorTwo" id="sponsor_2_list">
                                            <select name="sponsor_two_id"
                                                    class="form-control person_select select2" tabindex="2">
                                                <option value="">-- أختر الكفيل الثانى --</option>
                                                @foreach($sponsors as $sponsor)
                                                    <option value="{{$sponsor->id}}">{{$sponsor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!--second step-->

                        <div class="row setup-content">
                            <ul class="alert alert-danger" id="result_step2" style="display: none;"></ul>
                            <div class="col-md-12">
                                <br clear="both"/>
                                <table id="wares_wizard" onload="GetWares();"
                                       class="table table-striped table-bordered table-hover display   "
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
                                    <div class="form-group {{ $errors->has('contract_date') ? ' has-error' : '' }}">

                                        <label>
                                            تاريخ كتابة العقد
                                        </label>
                                        <div class="input-group">
                                            <input type="text" style="display:none;" disabled="disabled"
                                                   id="date_agd_ummalqura" 
                                                   name="contract_date" placeholder="الصيغة: 1439/08/07"
                                                   class="form-control "/>
                                            <input type="text" tabindex="6" id="date_agd_gregorian" 
                                                   name="contract_date"
                                                   class="form-control "/>
                                            <span class="input-group-btn ">
                                           <button style="margin-top: 0px;" id="date_calender" class="btn green"
                                                   type="button"
                                                   onclick="DateCalender();">هجري</button>
                                            </span>
                                            <input type="hidden" id="date_calender_hidden" name="date_calender"
                                                   value="H"/>
                                            @if ($errors->has('contract_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contract_date') }}</strong>
                                                </span>
                                            @endif
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
                                                <option value="0">الهجري</option>
                                                <option selected value="1">الميلادي</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>نوع الجدولة</label>
                                            <select class="form-control select2" tabindex="11" name="schedule_type">
                                                <option value="0">يومي</option>
                                                <option value="1">أسبوعي</option>
                                                <option value="2" selected="selected">شهري</option>
                                                <option value="3">نصف سنوي</option>
                                                <option value="4">سنوي</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('premiums_start_date') ? ' has-error' : '' }}">
                                            <label>
                                                تاريخ بداية الأقساط
                                            </label>
                                            <div class="input-group ">
                                                <input type="text" style="display:none; width:239px;" tabindex="15"
                                                       name="premiums_start_date_hijry"
                                                       id="date_start_agd_ummalqura" placeholder="الصيغة: 1439/08/27"
                                                       class="form-control "/>
                                                <input type="text" tabindex="15" name="premiums_start_date"
                                                       id="date_start_agd_gregorian" placeholder="2018/08/27"
                                                       class="form-control "
                                                       style="width: 239px;"/>
                                                {{--<span class="input-group-btn">--}}
                                                {{--<button id="date_start_calender" class="btn default" type="button"  style="margin-top: 0px;"--}}
                                                {{--onclick="DateCalender();">هجري</button>--}}
                                                {{--</span>--}}
                                            </div>

                                            @if ($errors->has('premiums_start_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('premiums_start_date') }}
                                                    </strong></span>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                            @endif

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('contract_value') ? ' has-error' : '' }}">
                                    <label>قيمة العقد</label>
                                    <input readonly type="number" value="0" class="form-control"
                                           name="contract_value" id="label_total_price">
                                    @if ($errors->has('contract_value'))
                                        <span class="help-block"><strong>{{ $errors->first('contract_value') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('total_profit') ? ' has-error' : '' }}">
                                    <label>إجمالي الربح</label>
                                    <input readonly type="number" class="form-control" id="totalProfit"
                                           value="0" name="total_profit">
                                    @if ($errors->has('total_profit'))
                                        <span class="help-block"><strong>{{ $errors->first('total_profit') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('first_payment') ? ' has-error' : '' }}">
                                    <label>الدفعة المقدمة</label>
                                    <input type="number" placeholder="في حال كانت هناك دفعة"
                                           name="first_payment" id="first_payment" value="0"
                                           class="form-control "
                                           tabindex="7" onkeyup="firstPayment(this.value);"/>
                                    @if ($errors->has('first_payment'))
                                        <span class="help-block"><strong>{{ $errors->first('first_payment') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            @php
                             $all_accounts = \App\Company_account::all();
                            @endphp

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('account_id') ? ' has-error' : '' }}">
                                    <label>الحساب (لإيداع الدفعة المقدمة)</label>
                                    <select class="form-control select2 "
                                            style="border:1px solid #aaa;" id="investor_accounts" name="account_id">
                                  
                                        <option value="" selected> اختر الحساب </option>
                                          @foreach($all_accounts as $account)
                                           <option value="{{ $account->id }}"> {{ $account->account_name }}</option>
                                       
                                        @endforeach
                                    </select>
                                    @if ($errors->has('account_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('account_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--contract other type--}}
                            @if(isset($type)  and $type == 2)
                                <div class="col-md-3">
                                    <div class="form-group  {{ $errors->has('premiums_start_date') ? ' has-error' : '' }}">
                                        <label>
                                            <span> تاريخ حلول الدفع </span>
                                        </label>
                                        <div class="input-group">
                                            <input type="date" name="premiums_start_date"
                                                   class="form-control">
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
                                    <div class="form-group {{ $errors->has('premiums_number') ? ' has-error' : '' }}">
                                        <label>عدد الأقساط <a href="javascript:" id="freeze_string"
                                                              onclick="FreezeCountInstallment();">[تثبيت]</a></label>
                                        <input type="number" tabindex="12" id="premiums_number"
                                               name="premiums_number"
                                               placeholder="كم عدد الأقساط" onkeyup="premiumNum(this.value);"
                                               value="1"
                                               class="form-control "/>
                                        @if ($errors->has('premiums_number'))
                                            <span class="help-block"><strong>{{ $errors->first('premiums_number') }}</strong></span>
                                        @endif
                                        <input type="hidden" id="freeze_count_installment"
                                               name="freeze_count_installment" value="0"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('premiums_value') ? ' has-error' : '' }}">
                                        <label>مقدار القسط </label>
                                        <input type="text" tabindex="13" id="premiums_value" name="premiums_value"
                                               onkeyup="premiumValue(this.value);"
                                               placeholder="مقدار القسط" value="0"
                                               class="form-control  premium_amount"/>
                                        @if ($errors->has('premiums_value'))
                                            <span class="help-block"><strong>{{ $errors->first('premiums_value') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('last_premium') ? ' has-error' : '' }}">
                                        <label>القسط الأخير</label>
                                        <input type="text" tabindex="14" readonly="" id="last_premium"
                                               name="last_premium" placeholder="مقدار القسط " value="0"
                                               class="form-control"/>
                                        @if ($errors->has('last_premium'))
                                            <span class="help-block"><strong>{{ $errors->first('last_premium') }}</strong></span>
                                        @endif
                                        <span class="label label-danger" style="display: none;"
                                              id="msg_last_qasst">يجب أن يكون مقدار القسط أقل</span>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-3 rassom_agd_div">
                                <div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
                                    <label>رقم العقد</label>
                                    @php
                                    $last_cNum = 1;
                                    if($last_contract= \App\Contract::orderBy('contract_num', 'desc')->first()){
                                    $last_cNum = $last_contract->contract_num."1";
                                    }
                                    @endphp
                                    <input type="text"  id="contract_num" name="contract_num"
                                           placeholder="" value="{{ $last_cNum }}" class="form-control number" min="1"/>
                                    @if ($errors->has('contract_num'))
                                        <span class="help-block"><strong>{{ $errors->first('contract_num') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('profit_type') ? ' has-error' : '' }}">
                                    <label> نوع العمولة </label>
                                    <select name="profit_type" class="form-control">
                                        <option value="">-- أختر --</option>
                                        <option value="1"> نسبة من الربح</option>
                                        <option value="2"> مبلغ</option>
                                    </select>
                                    @if ($errors->has('profit_type'))
                                        <span class="help-block"><strong>{{ $errors->first('profit_type') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 rassom_agd_div">
                                <div class="form-group {{ $errors->has('profit_type') ? ' has-error' : '' }}">
                                    <label>عمولة العقد <a style="color:orange;" id="RassomAGD"><i
                                                    class="fa fa-info-circle"></i></a></label>
                                    <input type="text" tabindex="19" id="rassom_agd" name="contract_profit"
                                           placeholder="" value="50" class="form-control number"/>
                                    @if ($errors->has('contract_profit'))
                                        <span class="help-block"><strong>{{ $errors->first('contract_profit') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                    
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('profit_pay_type') ? ' has-error' : '' }}">
                                    <label> طرق دفع العمولة </label>
                                    <select name="profit_pay_type" class="form-control">
                                        <option value="">-- أختر --</option>
                                        <option value="1"> فى اول الاقساط</option>
                                        <option value="2"> مقسمة على عدد الاقساط</option>
                                        <option value="3"> فى اخر الاقساط</option>
                                    </select>
                                    @if ($errors->has('profit_pay_type'))
                                        <span class="help-block"><strong>{{ $errors->first('profit_pay_type') }}</strong></span>
                                    @endif
                                </div>
                            </div>



                             <div class="col-md-3">
                                <div class="form-group {{ $errors->has('commission_account') ? ' has-error' : '' }}">
                                    <label> صندوق استقبال قيمة العمولة </label>
                                    <select name="commission_account" class="form-control select2">
                                        @foreach($all_accounts as $uAccount)
                                        <option value="{{ $uAccount->id }}"> {{ $uAccount->account_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('commission_account'))
                                        <span class="help-block"><strong>{{ $errors->first('commission_account') }}</strong></span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('group_id') ? ' has-error' : '' }}">
                                    <label>المجموعة </label>
                                    <select name="group_id" class="form-control">
                                        <option value="">-- أختر --</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('group_id'))
                                        <span class="help-block"><strong>{{ $errors->first('group_id') }}</strong></span>
                                    @endif
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
                            <span>إضافة العقد</span>
                        </button>
                    </div>
                    {!! Form::close()!!}
                </div>
            </div>

            <br clear="both"/>


        {{--model new client--}}
        <!-- Modal -->
            <div class="modal fade myModal_client" style="z-index: 999999;" id="newUserFormModal" tabindex="-1"
                 role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">إضافة عميل جديد</h4>
                        </div>
                        <div class="modal-body">
                       
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