@extends('voyager::master')
@section('page_title', __('title.contract.premium_edit_date'))
@section('page_header')
    <h1><i class="fa fa-money"> </i> تعديل تاريخ الاستحقاق </h1>
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route'=>['contracts.update_date',$premium->id]]) !!}
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search"></i> تعديل تاريخ إستحقاق القسط</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>تاريخ الإستحقاق الهجرى</label>
                                        <div id="html_input">
                                            <input tabindex="2" name="date_type_hij" id="date"
                                                   value="{{\Carbon\Carbon::parse($premium->date_type_hij)->format('Y-m-d') }}"
                                                   class="form-control number date_start_agd_ummalqura">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> تاريخ الإستحقاق الميلادى</label>
                                        <div id="html_input">
                                            <input tabindex="2" name="date_type_mi" id="date"
                                                   value="{{date('Y-m-d',strtotime($premium->date_type_mi))}}"
                                                   placeholder="تاريخ الإستحقاق" class="form-control number  date_start_agd_gregorian">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <input type="submit" class="btn blue-hoki btn-lg" value=" حفظ التغييرات"/>
                                    </center>
                                </div>
                            </div>
                            <br clear="both"/>
                </form>
            </div>
        </div>
            </div>
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


        jQuery(document).ready(function () {
            change_calender();
        });

        function change_calender() {
            $('#date').calendarsPicker({
                calendar: $.calendars.instance('ummalqura', 'ar'),
                dateFormat: 'yyyy/mm/dd',
                defaultDate: '1439/10/03',
                selectDefaultDate: true
            });

        }
    </script>

@endsection