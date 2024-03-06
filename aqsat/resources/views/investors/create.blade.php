@extends('voyager::master')

@section('page_title', __('title.investor.create'))

@section('page_header')
    <h1><i class="fa fa-user"></i>إنشاء مستثمر جديد</h1>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> بيانات المستثمر</h3>
                    </div>

                    @include('include.message')

                    {!! Form::open(['route'=>'investors.store','method'=>'post']) !!}
                    <div class="box-body">

                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                                    <label>المستثمر<span class="label label-info label-sm"
                                        >[الاسم المعروض في البرنامج]</span>
                                    </label>
                                    <input type="text" tabindex="1" name="full_name" id="full_name"
                                           value="{{ old('full_name') }}" placeholder="أكتب الأسم"
                                           class="form-control required">
                                    @if ($errors->has('full_name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('formal_name') ? ' has-error' : '' }}">
                                    <label>الأسم الرسمي <span
                                                class="label label-info label-sm">[غير ضروري]</span></label>
                                    <input tabindex="2" name="formal_name" id="offical_name"
                                           value="{{ old('formal_name') }}"
                                           placeholder="يظهر في المطبوعات والأوراق الرسمية" class="form-control">
                                    @if ($errors->has('formal_name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('formal_name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">
                                    <label>رقم الهوية الوطنية</label>
                                    <input tabindex="3" name="national_id" value="{{old('national_id')}}"
                                           placeholder="رقم الهوية الوطنية / الإقامة" class="form-control number ">
                                    @if ($errors->has('national_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('national_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <br clear="both">
                             <div class="col-md-4">
                                <div class="form-group {{ $errors->has('release_date') ? ' has-error' : '' }}">
                                    <label>تقويم اصدار الهوية</label>
                                    <div class="input-group">
                                            <input type="text" style="display:none;" disabled="disabled"
                                                   id="date_agd_ummalqura" onchange=""
                                                   name="release_date" placeholder="الصيغة: 1439/08/07"
                                                   class="form-control "/>
                                            <input type="text" tabindex="6" id="date_agd_gregorian" onchange=""
                                                   name="release_date"
                                                   class="form-control "/>
                                            <span class="input-group-btn ">
                                           <button style="margin-top: 0px;" id="date_calender" class="btn green"
                                                   type="button"
                                                   onclick="DateCalender();">هجري</button>
                                            </span>
                                            <input type="hidden" id="date_calender_hidden" name="date_calender"
                                                   value="H"/>
                                            @if ($errors->has('release_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('release_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('release_place') ? ' has-error' : '' }}">
                                    <label>المصدر </label>
                                    <input tabindex="5" name="release_place" value="{{old('release_place')}}"
                                           placeholder="مكان إصدار الهوية"
                                           class="form-control ">
                                    @if ($errors->has('release_place'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('release_place') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label>رقم الجوال</label>
                                    <div class="intl-tel-input allow-dropdown separate-dial-code iti-sdc-3">
                                        <input tabindex="6" style="width:100%!important;" name="mobile"
                                               value="{{old('mobile')}}"
                                               class="form-control" autocomplete="off" placeholder="100 123 4567">
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                    @endif
                                    <input id="phone-full" type="hidden" name="phone-full" value="">
                                    <input id="phone-country" type="hidden" name="phone-country" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>رقم الهاتف

                                    </label>
                                    <div class="intl-tel-input allow-dropdown separate-dial-code iti-sdc-3">
                                        <input tabindex="7" style="width:100%!important;" name="phone"
                                               value="{{old('phone')}}"
                                               class="form-control" placeholder="100 123 4567">
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label>العنوان</label>
                                    <input tabindex="8" name="address" value="{{old('address')}}"
                                           placeholder="يكتب عنوان العميل هنا"
                                           class="form-control ">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('work') ? ' has-error' : '' }}">
                                    <label>العمل</label>
                                    <input tabindex="9" name="work" value="{{old('work')}}" placeholder="اسم جهة العمل"
                                           class="form-control ">
                                    @if ($errors->has('work'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('work') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('work_phone') ? ' has-error' : '' }}">
                                    <label>
                                        <span>   رقم هاتف العمل</span>
                                    </label>
                                    <div class="intl-tel-input allow-dropdown separate-dial-code iti-sdc-3">
                                        <div class="flag-container">
                                        </div>
                                        <input tabindex="10" name="work_phone" value="{{old('work_phone')}}"
                                               class="form-control" placeholder="رقم ثابت" autocomplete="off">
                                        @if ($errors->has('work_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('work_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('nationality') ? ' has-error' : '' }}">
                                    <label>الجنسية</label>
                                    <input tabindex="11" name="nationality" value="{{old('nationality')}}"
                                           placeholder="جنسية العميل"
                                           class="form-control  ">
                                    @if ($errors->has('nationality'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('nationality') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>البريد الإلكتروني</label>
                                    <input tabindex="12" name="email" value="{{old('email')}}"
                                           placeholder="example@website.com"
                                           class="form-control email" type="email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>كلمه السر</label>
                                    <input tabindex="11" type="password" name="password" value=""
                                           placeholder='كلمة المرور'
                                           class="form-control ">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تاكيد كلمه السر</label>
                                    <input tabindex="11" type="password" name="password_confirmation" value=""
                                           placeholder='تاكيد كلمة المرور' class="form-control "
                                    >
                                </div>
                            </div>
                                 <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label>نوع الجنس</label>
                                          <select class="form-control " id="gender" name="gender">
                                                <option value="m">ذكر</option>
                                                 <option value="f">انثى</option>
                                                  <option value="c">شركة/ مؤسسة</option>
                                           
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            <br clear="both">
                            <div class="col-md-8">
                                <div class="form-group {{ $errors->has('total_account') ? ' has-error' : '' }}">
                                    <label>الرصيد الإفتتاحي (إيداع رصيد إفتتاحي للمستثمر)</label>
                                    <input type="number" tabindex="13" name="total_account" value="0" placeholder="0.00"
                                           class="form-control" min="0">
                                    @if ($errors->has('total_account'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('total_account') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>اسم الحساب البنكي</label>
                                    <input type="text" id="investorAccount"  name="account_name" value="الصندوق">
                                
                                </div>
                            </div>

                            <div class="col-md-4" style="float: none; margin-top: 92px;">
                                <div class="form-group">
                                    <input type="checkbox" id="buyNewProduct" onchange="buyOutProducts();" name="out_product">
                                    <label> شراء سلعة خارجية </label>
                                </div>
                            </div>

                            <div id="outProducts" style="display: none;">
                                <h4 class="alert alert-warning ">
                                    <span class="fa fa-warning"> قيمه الشراء يجب الا تزيد عن قيمة المبلغ المتوفر فى حساب المستثمر (الرصيد الافتتاحى)</span>
                                </h4>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> الكمية </label>
                                        <input type="number" disabled name="quantity"  min="0" placeholder='الكمية'
                                               class="form-control" id="quantity" onkeyup="sumTotalPrice();">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> قيمة السلعة </label>
                                        <input type="number" disabled name="price" min="0" placeholder='السعر'
                                               class="form-control" id="price" onkeyup="sumTotalPrice();">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> الاجمالى </label>
                                        <input type="number" name="total_price" id="total_price" disabled class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary my_btn_left"><i
                                            class="fa fa-plus-circle"></i> اضافة
                                </button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div> <!-- /box -->
            </div> <!-- end col-12 -->
        </div> <!-- end row -->
    </section>


@endsection

@section('css')

@include('contracts.components.calendars_styles')

@stop


@section('javascript')
@include('contracts.components.calendars_scripts')


    <script>

        
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
        function buyOutProducts() {
            if ($('#buyNewProduct').is(":checked")) {
                $('#outProducts').css("display",'block');
                $('#quantity').removeAttr('disabled');
                $('#price').removeAttr('disabled');
            }else{
                $('#outProducts').css("display",'none');
                $('#quantity').attr('disabled');
                $('#price').attr('disabled');
            }
        }

        function sumTotalPrice(){
           var total = Number($('#quantity').val()) * Number($('#price').val());
           $('#total_price').val(total);
        }

    </script>




@endsection