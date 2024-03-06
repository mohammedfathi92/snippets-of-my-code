      <form method="POST" id="newUserForm" action=""
                                  id="NewCustomerForm">
                                  {{ csrf_field() }}
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
                                <div class="form-group {{ $errors->has('release_date') ? ' has-error' : '' }}">
                                    <label>تقويم اصدار الهوية</label>
                                    <div class="input-group">
                                            <input type="text" style="display:none;" disabled="disabled"
                                                   id="date_agd_ummalqura2" onchange=""
                                                   name="release_date" placeholder="الصيغة: 1439/08/07"
                                                   class="form-control "/>
                                            <input type="text" tabindex="6" id="date_agd_gregorian2" onchange=""
                                                   name="release_date"
                                                   class="form-control "/>
                                            <span class="input-group-btn ">
                                           <button style="margin-top: 0px;" id="date_calender2" class="btn green"
                                                   type="button"
                                                   onclick="DateCalender2();">هجري</button>
                                            </span>
                                            <input type="hidden" id="date_calender2_hidden" name="date_calender"
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
                                <button type="button" onclick="newUser('{{ $type }}', '{{ $select }}');" id="submit_btn" tabindex="123"
                                        class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 18px; padding: 11px;">إضافة</span>
                                </button>


                                <br clear="both"/>
                      
                            </form>

   
    <script>

        
        function DateCalender2() {

        	     var hij = $('#date_agd_ummalqura2');
            if (hij.attr('disabled')) {
                hij.removeAttr('disabled', true);
            } else {
                hij.attr('disabled', true);
            }


            var mi = $('#date_agd_gregorian2');
            if (mi.attr('disabled')) {
                mi.removeAttr('disabled');
            } else {
                mi.attr('disabled', true);
            }
            var date_calender_type = $('#date_calender2_hidden').val();

            $('#date_agd_ummalqura2').hide();
            $('#dg_ummalqura').hide();
            $('#date_agd_gregorian2').hide();
            $('#dg_gregorian').hide();

            if (date_calender_type == 'G') { // if it gregorian , convert it to ummalqura
                $('#date_agd_ummalqura2').show();
                $('#dg_ummalqura').show();
                $('#date_agd_gregorian2').hide();
                $('#dg_gregorian').hide();

                $('#date_calender2').html('هجري');
                $('#date_calender2_2').html('هجري');
                $('#date_calender2_hidden').val('H');

                $('#date_agd_ummalqura2').calendarsPicker({
                    calendar: $.calendars.instance('ummalqura', 'ar'),
                    dateFormat: 'yyyy/mm/dd',
                                   minDate: '-10y',
                  minDate: '-10y',
                maxDate: '+10y',
                defaultDate: '+-d',
                                    selectDefaultDate: true,
                                    //comment the beforeShow handler if you want to see the ugly overlay
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
                $('#date_agd_gregorian2').show();
                $('#dg_gregorian').show();
                $('#date_agd_ummalqura2').hide();
                $('#dg_ummalqura').hide();
                $('#date_calender2 , #date_calender2_2').html('ميلادي');
                $('#date_calender2_hidden').val('G');
                $('#date_agd_gregorian2').calendarsPicker({
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

            $('#date_calender2 , #date_calender2_2').html('ميلادي');
            $('#date_calender2_hidden').val('G');
            $('#date_agd_gregorian2').calendarsPicker({
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