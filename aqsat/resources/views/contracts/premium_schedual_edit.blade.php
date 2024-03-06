@extends('voyager::master')
@section('page_title', __('title.contract.premium_edit'))
@section('page_header')
    <h1><i class="fa fa-edit"></i>إعادة جدولة الأقساط
    </h1>
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-edit"></i>إعادة جدولة الأقساط</h3>
                    </div>
                    <div class="box-body ">
                        @include('include.message')
                        {{Form::open(['route'=>['contracts.premium_update',$contract_id],'method'=>'post'])}}
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="background:#eee;text-align:center;" rowspan="2">م</th>
                                <th style="background:#eee;text-align:center;" rowspan="2">النوع</th>
                                <th id="date_column" style="background:#eee;text-align:center;"
                                    style="text-align:center;border-bottom:2px solid #eee;">
                                    تاريخ الإستحقاق
                                    <br/>
                                </th>
                                <th style="background:#eee;text-align:center;" rowspan="2">المبلغ</th>
                                {{--<th style="background:#eee;text-align:center;" rowspan="2">حذف</th>--}}
                            </tr>
                            <tr>
                                <td style="background:#eee;text-align:center;">
                                    <select class="form-control" id="default_calendar"
                                            onchange="getDate(this.val())"
                                            style="font-size:16px;height:45px">
                                        <option value="g"> التقويم الهجري</option>
                                        <option value="h">التقويم الميلادي</option>
                                    </select>
                                </td>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            @php
                            $num = 0;
                            @endphp

                            @foreach($premiums as $num=>$premium )

                                <tr class="editable" style="background:#f7f7f7;">
                                    <td>
                                        {{$num++}}
                                        <input type="hidden" name="order_{{$num}}" value="{{$premium->order}}">
                                    </td>
                                    <td><input type="text" class="form-control" readonly="" value="قسط"/></td>

                                    <td class="row_calendar row_h" style="display:none;">
                                        <input name="date_type_mi_{{$num}}"
                                               class="form-control date_start_agd_gregorian"
                                               value="{{date('Y-m-d', strtotime($premium->date_type_mi))}}"/>
                                    </td>

                                    <td class="row_calendar row_g" >
                                        <input name="date_type_hij_{{$num}}"
                                               class="form-control date_start_agd_ummalqura"
                                               value="{{\Carbon\Carbon::parse($premium->date_type_hij)->format('Y-m-d') }}"/>
                                    </td>

                                    <td>
                                        <input type="text" required onkeyup="sum_total(this.value);"
                                               id="amount_{{$num}}"
                                               class="form-control amounts" name="amount_{{$num}}"
                                               value="{{$premium->amount}}"/>
                                        <input type="hidden" id="premiums_count" value="{{$premiums_count}}">
                                    </td>

                                    {{--<td>--}}
                                        {{--<a href="javascript:" onclick="RemoveRow($(this));"><i class="fa fa-times"--}}
                                                                                               {{--style="color:#ee162d"></i>--}}
                                        {{--</a>--}}
                                    {{--</td>--}}
                                </tr>

                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3"
                                    style="text-align:left;font-weight:bold;background:#666;color:white;">
                                    <span>المجموع</span>

                                </td>
                                <td id="total_installment" colspan="2">
                                    <input readonly class="form-control" name="total" id="total_premiums" value="{{$total_remain}}">
                                    <input type="hidden" class="form-control" name="total_edit" id="total"
                                           value="{{$total_remain}}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"
                                    style="text-align:left;font-weight:bold;background:#666;color:white;">
                                    <span>  المتبقي في العقد</span>
                                </td>
                                <td colspan="2">
                                    {{$total_remain}}
                                    <input type="hidden" name="contract_remain" id="contract_remain"
                                           value="{{$total_remain}}">
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                        <input type="hidden" id="calendar" name="calendar" value="h"/>
                        <div class="text-center">
                            <a href="{{route('contracts.show',$contract_id)}}"
                               class="btn btn-lg blue"><i class="fa fa-undo"></i> العودة </a>
                            <button class="btn btn-danger btn-lg"><i class="fa fa-save"></i>حفظ</button>
                        </div>
                        {!!  Form::close()!!}
                    </div>
                </div>

                {{--<div class="modal fade  bs-example-modal-lg">--}}
                {{--<div class="modal-dialog modal-lg">--}}
                {{--<div class="modal-content" id="new_installment">--}}
                {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span--}}
                {{--class="sr-only">الإلغاء</span></button>--}}
                {{--<h4 class="modal-title">جدولة جديدة</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                {{--<ul class="alert alert-danger" id="result_step_reset_installment"--}}
                {{--style="display:none;"></ul>--}}
                {{--<div id="loader_reset_installment" style="display:none">--}}
                {{--<center><i style="font-size:40px;"--}}
                {{--class="fa fa-spinner fa-spin  fa-5x "></i></center>--}}
                {{--<br clear="both"/>--}}
                {{--</div>--}}
                {{--<div class="alert alert-info">--}}
                {{--<h3 style="margin-top:10px">تنبيهات مهمة</h3>--}}
                {{--<ul>--}}
                {{--<li>سيتم إعادة جدولة الأقساط وحذف الجدولة القديمة&nbsp;</li>--}}
                {{--<li>ستبدأ الجدولة من اليوم ، وسيتم تجاهل الأقساط السابقة وكذلك الأقساط--}}
                {{--المسددة.--}}
                {{--</li>--}}
                {{--<li>ستكون الجدولة فقط للمبلغ المتبقي فقط وهو 90.00.</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                {{--<label>نوع الجدولة</label>--}}
                {{--<select name="installment_way" class="form-control">--}}
                {{--<option value="">--أختر--</option>--}}
                {{--<option value="df">يومي</option>--}}
                {{--<option value="wf">أسبوعي</option>--}}
                {{--<option selected value="mf">شهري</option>--}}
                {{--<option value="yh"> نصف سنوي</option>--}}
                {{--<option value="yf">سنوي</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                {{--<label>جدولة الأقساط بالتقويم</label>--}}
                {{--<select name="installment_schedule_type" class="form-control"--}}
                {{--onchange="SetStartDate($(this).val());">--}}
                {{--<option value="hijri">الهجري</option>--}}
                {{--<option value="gregorian">الميلادي</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                {{--<label> تاريخ أول قسط</label>--}}
                {{--<input type="text" class="form-control" class="start_installment"--}}
                {{--id="start_installment" value="" name="start_installment"/>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                {{--<label> مقدار القسط</label>--}}
                {{--<input type="text" value="0" class="form-control"--}}
                {{--name="monthly_installment"/>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<center>--}}
                {{--<button type="button" onclick="RestInstallments()" class="btn btn-lg green">--}}
                {{--إعادة الجدولة--}}
                {{--</button>--}}
                {{--</center>--}}
                {{--<br clear="both"/>--}}
                {{--</form>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
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

        $(document).ready(function () {

            $('.date_start_agd_gregorian').calendarsPicker({
                calendar: $.calendars.instance('gregorian', 'ar-EG'),
                dateFormat: 'yyyy/mm/dd',
//                minDate: '-0d',
//                maxDate: '+50y',
//                defaultDate: '+30',
                selectDefaultDate: false
            });

            $('.date_start_agd_ummalqura').calendarsPicker({
                calendar: $.calendars.instance('ummalqura', 'ar'),
                dateFormat: 'yyyy/mm/dd',
//                minDate: '-0d',
//                maxDate: '+50y',
//                defaultDate: '+30',
                selectDefaultDate: false
            });


        });



        function sum_total(value) {
            var i;
            var total = 0;
            var premiums_count = $('#premiums_count').val();
            for (i = 1; i <= premiums_count; i++) {
                total += Number($('#amount_' + i).val());
            }

            $('#total_premiums').val(total);
            $('#total').val(total);

            ReCalucateTotals();
        }


        function ReCalucateTotals() {

            if (Number($('#total_premiums').val()) == Number($('#contract_remain').val())) {
                $('#total_installment').css('background', 'rgba(32, 107, 32, 0.4)').css('color', 'white').css('font-weight', 'bold');
            } else {
                $('#total_installment').css('background', 'red').css('color', 'white').css('font-weight', 'bold');
            }
        }


    </script>

    <script type="application/javascript">

        var shamsi_today = '1397/01/21';


        var count_row = 7;
        function ReCalucateTotals() {

            if (Number($('#total_premiums').val()) == Number($('#contract_remain').val())) {
                $('#total_installment').css('background', 'rgba(32, 107, 32, 0.4)').css('color', 'white').css('font-weight', 'bold');
            } else {
                $('#total_installment').css('background', 'red').css('color', 'white').css('font-weight', 'bold');
            }
        }

        function GetTotalMotabgi() {
            var amouts = $(".amounts").map(function () {
                return $(this).attr("value");
            }).get();
            var total_motabgi = 0;
            $.each(amouts, function (index, value) {
                total_motabgi = Number(Number(total_motabgi) + Number(value));
            });
            return total_motabgi;
        }


        function RemoveRow(row) {
            row.parent().parent().remove();
            ReCalucateTotals();
        }
        $('#addRow').on('click', function () {
            ReCalucateTotals();
            var current_calendar = $('#calendar').val();
            var hijri_status = 'display:none;';
            var shamsi_status = 'display:none;';
            var grogrean_status = 'display:none;';
            if (current_calendar == 'h') {
                var hijri_status = 'display:block;';
            } else if (current_calendar == 'g') {
                var grogrean_status = 'display:block;';
            } else if (current_calendar == 's') {
                var shamsi_status = 'display:block;';
            }
            var row = '<tr>' +
                '<td>' +  + '</td>' +
                '<td><input type="text" class="form-control" readonly="" value="قسط"></td>' +
                '<td class="row_calendar row_h"  style="' + hijri_status + '">' +
                '<input name="date_type_mi_{{$num}}" id="h_' + count_row + '" type="text" class="form-control date_hijri" value="1439/07/24"/>' +
                '</td>' +
                '<td class="row_calendar row_g" style="' + grogrean_status + '">' +
                '<input  name="amount_.$i" id="g_' + count_row + '" type="text" class="form-control date_gregorian" value="2018/04/10"/>' +
                '</td>' +
                '<td class="row_calendar row_s" style="' + shamsi_status + '">' +
                '<input  name="inst[' + count_row + '][shamsi]" id="s_' + count_row + '" type="text" class="form-control date_shamsi" value="' + shamsi_today + '"/>' +
                '</td>' +
                '<td><input type="text" class="form-control amounts" name="amount_{{$num}}" value="0"/></td>' +
                '<td><a href="javascript:;" onclick="RemoveRow($(this));"><i class="fa fa-times" style="color:#ee162d"></i></td>' +
                '</tr>';
            $('#tbody').append(row);
            reload_calendar_picker();

            count_row++;
        });
        $("#EditInstallment").submit(function (event) {


            var result_msg = $('#result_step');
            result_msg.empty();
            result_msg.hide();
            $('#loader').show();


            if (GetTotalMotabgi() == 90.00) {

                var postData = $('#EditInstallment').serialize();
                $.ajax({
                    type: 'post',
                    url: 'https://u89559.dhman.io/125/710/38295/102/5',
                    data: postData,
                    success: function (result) {
                        $('#loader').hide();


                        swal({
                            title: "تم الحفظ!",
                            text: "",
                            type: "success",
                            confirmButtonText: "إلغاء"
                        });

                    },
                    error: function (result) {
                        console.log(result);
                        $('#loader').hide();
                        result_msg.show();
                        $.each(result.responseJSON, function (index, value) {
                            result_msg.append('<li>' + value + '</li>');
                        });
                        swal({title: "يوجد خطأ", text: "", type: "error", confirmButtonText: "إلغاء"});

                    }
                });
            } else {
                result_msg.append('<li>يجب أن يكون مجموع الأقساط يساوي 90.00</li>');
                $('#loader').hide();
                result_msg.slideDown();
            }
            event.preventDefault();
        });

        function DeleteRow(row) {
            row.parent().parent().fadeOut(300, function () {
                $(this).remove();
            });
            ReCalucateTotals();
        }
        $('#default_calendar').on('change', function () {
            var value = $(this).val();
            $('.row_calendar ').hide();
            $('.row_' + value).show();
            $('#calendar').val(value);
        });

//        function HideColumn(id) {
//            if ($('#date_column').attr('colspan') == 1) {
//                alert('لا تستطيع حذف العمود');
//            } else {
//                $('.row_' + id).remove();
//                $('#date_column').attr('colspan', ($('#date_column').attr('colspan') - 1));
//            }
//        }
//
//        $(document).ready(function () {
//            $('#total_motabgi').text(90.00);
//            ReCalucateTotals();
//            reload_calendar_picker();
//            SetStartDate('hijri');
//        });

//        function reload_calendar_picker() {
//
//            $('.date_gregorian').calendarsPicker({
//                calendar: $.calendars.instance('gregorian', 'ar-EG'),
//                dateFormat: 'yyyy/mm/dd',
//                selectDefaultDate: true
//            });
//
//            $('.date_hijri').calendarsPicker({
//                calendar: $.calendars.instance('ummalqura', 'ar'),
//                dateFormat: 'yyyy/mm/dd',
//                selectDefaultDate: true
//            });
//        }
//
//        function SetStartDate(option) {
//            console.log('SetStartDate' + option);
//            if (option == 'hijri') {
//                $('#start_installment').val('1439/07/24');
//                $("#default_calendar option[value='h']").prop('selected', true);
//                $('.row_h').show();
//                $('.row_g').hide();
//                $('.row_s').hide();
//                ChangeDefaultCalender('h');
//            } else if (option == 'gregorian') {
//                $('#start_installment').val('2018/04/10');
//                $("#default_calendar option[value='g']").prop('selected', true);
//                $('.row_h').hide();
//                $('.row_g').show();
//                $('.row_s').hide();
//                ChangeDefaultCalender('g');
//            } else {
//                $('#start_installment').val(shamsi_today);
//                $("#default_calendar option[value='s']").prop('selected', true);
//                $('.row_h').hide();
//                $('.row_g').hide();
//                $('.row_s').show();
//                ChangeDefaultCalender('s');
//            }
//        }
//
//        function RestInstallments() {
//            var result_msg = $('#result_step_reset_installment');
//            result_msg.empty();
//            result_msg.hide();
//
//            var current_calendar = $('#calendar').val();
//            var hijri_status = 'display:none;';
//            var shamsi_status = 'display:none;';
//            var grogrean_status = 'display:none;';
//
//            if (current_calendar == 'h') {
//                var hijri_status = 'display:block;';
//            } else if (current_calendar == 'g') {
//                var grogrean_status = 'display:block;';
//            } else if (current_calendar == 's') {
//                var shamsi_status = 'display:block;';
//            }
//
//            $('#loader_reset_installment').show();
//
//            var postData = $('#ResetInstallments').serialize();
//            $.ajax({
//                type: 'post',
//                url: 'https://u89559.dhman.io/125/710/38295/102/6',
//                data: postData,
//                success: function (result) {
//                    $('#loader_reset_installment').hide();
//                    $('#tbody').empty();
//                    $.each(result, function (index, value) {
//                        var count_row = value.number;
//                        var row = '<tr>' +
//                            '<td>' + value['number'] + '</td>' +
//                            '<td><input type="text" class="form-control" readonly="" value="قسط"></td>';
//                        row += '<td class="row_calendar row_h"  style="' + hijri_status + '">' +
//                            '<input name="inst[' + count_row + '][hijri]" id="h_' + count_row + '" type="text" class="form-control date_hijri" value="' + value['date_h'] + '"/>' +
//                            '</td>';
//                        row += '<td class="row_calendar row_g" style="' + grogrean_status + '">' +
//                            '<input  name="inst[' + count_row + '][gregorian]" id="g_' + count_row + '" type="text" class="form-control date_gregorian" value="' + value['date_g'] + '"/>' +
//                            '</td>';
//                        row += '<td><input type="text" onkeyup="ReCalucateTotals();" onkeydown="ReCalucateTotals();" onchange="ReCalucateTotals();" class="form-control amounts" name="inst[' + count_row + '][amount]" value="' + value['amount'] + '"/></td>' +
//                            '<td><a href="javascript:;" onclick="RemoveRow($(this));"><i class="fa fa-times" style="color:#ee162d"></i></td>' +
//                            '</tr>';
//                        $('#tbody').append(row);
//
//                        //$('#EditInstallment').submit();
//                    });
//                    $('.modal').modal('hide');
//                },
//                error: function (result) {
//                    console.log(result);
//                    $('#loader_reset_installment').hide();
//                    result_msg.show();
//                    result_msg.removeClass('alert-success');
//                    result_msg.addClass('alert-danger');
//                    $.each(result.responseJSON, function (index, value) {
//                        result_msg.append('<li>' + value + '</li>');
//                    });
//                }
//            });
//
//
//        }

        function ChangeDefaultCalender(value) {
            console.log('ChangeDefaultCalender: ' + value);
            $('#calendar').val(value);
        }
    </script>

@endsection
