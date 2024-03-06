@extends('voyager::master')

@section('page_title', __('title.investor.edit'))

@section('page_header')
    <h1><i class="fa fa-edit"></i> تعديل بيانات المستخدم </h1>
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">

            @include('include.message')
            {!! Form::open(['route'=>['investors.update',$investor->id],'method'=>'post']) !!}

            <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-edit"></i> تعديل بيانات المستثمر</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                                    <label>اسم المستثمر/الصندوق</label>
                                    <input tabindex="1" name="full_name" value="{{ old('full_name',isset($investor)? $investor->name:'')}}"
                                           placeholder="الأسم رباعياً" class="form-control">
                                    @if ($errors->has('full_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('formal_name') ? ' has-error' : '' }}">
                                    <label>الأسم الرسمي</label>
                                    <input tabindex="1" name="formal_name" value="{{ old('formal_name',isset($investor)? $investor->profile->formal_name:'')}}"
                                           placeholder="الأسم الرسمي"
                                           class="form-control">
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
                                    <input tabindex="2" name="national_id" value="{{ old('national_id',isset($investor)? $investor->profile->national_id: '') }}"
                                           placeholder="رقم الهوية الوطنية / الإقامة" class="form-control">
                                    @if ($errors->has('national_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('national_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                              <div class="col-md-4">
                                <div class="form-group {{ $errors->has('release_date') ? ' has-error' : '' }}">
                                    <label>تقويم اصدار الهوية</label>
                                    <div class="input-group">
                                            <input type="text" style="display:none;" disabled="disabled"
                                                   id="date_agd_ummalqura" onchange=""
                                                   name="release_date" placeholder="الصيغة: 1439/08/07"
                                                   class="form-control "  value="{{ old('release_date', isset($investor) ? $investor->profile->release_date : '') }}"/>
                                            <input type="text" tabindex="6" id="date_agd_gregorian" onchange=""
                                                   name="release_date"
                                                   class="form-control"  value="{{ old('release_date', isset($investor) ? $investor->profile->release_date : '') }}"/>
                                            <span class="input-group-btn ">
                                           <button style="margin-top: 0px;" id="date_calender" class="btn green"
                                                   type="button"
                                                   onclick="DateCalender();" >هجري</button>
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
                                    <label>مصدر الهوية</label>
                                    <input tabindex="4" name="release_place"
                                           value="{{ old('release_place',isset($investor)? $investor->profile->release_place : '') }}"
                                           placeholder="مكان إصدار الهوية" class="form-control">
                                    @if ($errors->has('release_place'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('release_place') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label>رقم الجوال
                                        <span id="valid-msg1" style="color:darkgreen" class="hide">✓ </span>
                                        <span id="error-msg1" style="color:red" class="hide">X</span>
                                    </label>
                                    <input tabindex="5" style="width:100%!important;"
                                           name="mobile" value="{{ old('mobile',isset($investor)? $investor->profile->mobile : '')}}"
                                           id="mobile" class="form-control number phone">
                                    <input id="phone-full" type="hidden" name="phone-full" value="">
                                    <input id="phone-country" type="hidden" name="phone-country" value="">
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>رقم الهاتف
                                        <span id="valid-msg3" style="color:darkgreen" class="hide">✓ </span>
                                        <span id="error-msg3" style="color:red" class="hide">X</span>
                                    </label>
                                    <input tabindex="5" style="width:100%!important;"
                                           name="phone" value="{{ old('phone',isset($investor)? $investor->profile->phone : '')}}"
                                           id="mobile2" class="form-control number phone">
                                    <input id="phone2-full" type="hidden" name="phone2-full" value="">
                                    <input id="phone2-country" type="hidden" name="phone2-country" value="">
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
                                    <input tabindex="8" name="address"
                                           value="{{ old('address',isset($investor)?  $investor->profile->address : '')}}"
                                           placeholder="يكتب عنوان المستثمر هنا" class="form-control">
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
                                    <input tabindex="7" name="work" value="{{ old('work',isset($investor)? $investor->profile->work : '') }}"
                                           placeholder="اسم جهة العمل"
                                           class="form-control">
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
                                        رقم هاتف العمل
                                        <span id="valid-msg2" style="color:darkgreen" class="hide">✓ </span>
                                        <span id="error-msg2" style="color:red" class="hide">X</span>
                                    </label>
                                    <input tabindex="10" name="work_phone" value="{{ old('work_phone',isset($investor)? $investor->profile->work_phone : '') }}"
                                           class="form-control phone"
                                           id="phone_work_customer">
                                    <input id="phonework-full" type="hidden" name="phonework-full" value="">
                                    <input id="phonework-country" type="hidden" name="phonework-country"
                                           value="">
                                    @if ($errors->has('work_phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('work_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('nationality') ? ' has-error' : '' }}">
                                    <label>الجنسية</label>
                                    <input tabindex="6" name="nationality" value="{{ old('nationality',isset($investor)? $investor->profile->nationality:'') }}"
                                           placeholder="جنسية المستثمر"
                                           value="سعودي" class="form-control">
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
                                    <input tabindex="12" name="email" value="{{ old('email',isset($investor)? $investor->email: '') }}"
                                           placeholder="example@website.com"
                                           class="form-control">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                                      <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label>نوع الجنس</label>
                                          <select class="form-control " id="gender" name="gender">
                                                <option value="m" {{ $investor->profile->gender == 'm' ? 'selected':'' }}>ذكر</option>
                                                 <option value="f" {{ $investor->profile->gender == 'f' ? 'selected':'' }}>انثى</option>
                                                  <option value="c" {{ $investor->profile->gender == 'c' ? 'selected':'' }}>شركة/ مؤسسة</option>
                                           
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary my_btn_left"><i class="fa fa-save"></i> حفظ
                                التعديلات
                            </button>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
            <br clear="both"/>
        </div>
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
    @stop