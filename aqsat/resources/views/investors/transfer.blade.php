@extends('voyager::master')

@section('page_title', __('title.investor.trancfer'))

@section('page_header')
    <h1><i class="fa fa-money"></i>عملية تحويل</h1>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @include('include.message')
                {!! Form::open(['route'=>'investors.transfer.make']) !!}
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-table"></i> بيانات التحويل</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>المبلغ</label>
                                        <input type="text" name="amount" value="" placeholder="المبلغ المراد تحويله"
                                               id="amount" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الملاحظة</label>
                                        <input type="text" name="note" id="note"
                                               placeholder="أكتب هنا الملاحظة المراد إضافتها لبيان العملية"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <br clear="both"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-minus"></i> من حساب</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>المستثمر</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="1"
                                                onchange="GetAccounts(this.value);"
                                                name="from_user_id">
                                            <option value="">--أختر المستثمر--</option>
                                            @foreach($investors as $investor)
                                                <option value="{{$investor->id}}">{{$investor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>الحساب</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="2"
                                                onchange="GetAccountValue(this.value)" id="investor_accounts" name="from_account_id">
                                            <option value="" selected>--أختر --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>الرصيد المتوفر</label>
                                        <input disabled="" id="f_BO_read" placeholder="" class="form-control">
                                        <input type="hidden" disabled="" id="f_BO" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <br clear="both"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-plus"></i> إلى حساب</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>المستثمر</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="1"
                                                onchange="ToGetAccounts(this.value);" id="t_inv" name="to_user_id">
                                            <option value="">--أختر المستثمر--</option>
                                            @foreach($investors as $investor)
                                                <option value="{{$investor->id}}">{{$investor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>الحساب</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="2"
                                                onchange="ToGetAccountValue(this.value);" id="to_investor_accounts"
                                                name="to_account_id">
                                            <option value="" selected>--أختر --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>الرصيد المتوفر</label>
                                        <input disabled="" id="t_BO_read" placeholder="" class="form-control">
                                        <input type="hidden" disabled="" id="t_BO" placeholder="" class="form-control">
                                    </div>
                                </div>

                                <br clear="both"/>
                            </div>
                        </div>
                    </div>
                    <br clear="both"/>
                </div>
                <br clear="both"/>
                
                <center>
                    <input type="submit" class="btn btn-lg btn-danger" value=" التحويل الآن ">
                </center>
                {!! Form::close() !!}
            </div>
        </div>
    </section>


@endsection

@section('javascript')

    <script type="text/javascript">


        function GetAccounts(id) {
            $.ajax({
                type: 'post',
                url: '/admin/investors/ajax',
                data: {id: id},
                success: function (data) {
                    $("#investor_accounts").html(data);
                }
            });
        }

        function GetAccountValue(value) {
            $.ajax({
                type: 'post',
                url: '/admin/investors/ajax_deposit_account_value',
                data: {id:value},
                success: function (data) {
                    $("#f_BO_read").val(data);
                }
            });
        }


        function ToGetAccounts(id) {
            $.ajax({
                type: 'post',
                url: '/admin/investors/ajax',
                data: {id: id},
                success: function (data) {
                    $("#to_investor_accounts").html(data);
                }
            });
        }

        function ToGetAccountValue(value) {
            $.ajax({
                type: 'post',
                url: '/admin/investors/ajax_deposit_account_value',
                data: {id:value},
                success: function (data) {
                    $("#t_BO_read").val(data);
                }
            });
        }


//        function ChangeStatment() {
//            var e = "سحب مبلغ نقدي #AMOUNT#، من/ #FROM# #NOTE#";
//            var e = e.replace("#AMOUNT#", $("#amount").val().format('0,0.00') + " ريـال سعودي");
//            var e = e.replace("#NOTE#", $("#statment").val());
//            var e = e.replace("#FROM#", $("#inv option:selected").text());
//            $("#st").html(e)
//        }
//        function f_UpBalance() {
//            var e = $("#f_inv").val();
//            var t = $("#f_bnk").val();
//            var n = 0;
//            $.ajax({
//                type: "POST",
//                url: "/admin/investors/transfer",
//                data: {
//                    n: e,
//                    b: t,
//                },
//                dataType: "text",
//                success: function (e) {
//                    $("#f_BO_read").val(e);
//                    $("#f_BO").val(e);
//                    UpTahweel("2", 'f_')
//                },
//                fail: function (e) {
//                    alert("يوجد خطأ في الاتصال بقاعدة البيانات")
//                }
//            })
//        }
//
//
//        function t_UpBalance() {
//            var e = $("#t_inv").val();
//            var t = $("#t_bnk").val();
//            var n = 0;
//            $.ajax({
//                type: "POST",
//                url: "/admin/investors/transfer_to",
//                data: {
//                    n: e,
//                    b: t,
//                },
//                dataType: "text",
//                success: function (e) {
//                    $("#t_BO_read").val(e);
//                    $("#t_BO").val(e);
//                    UpTahweel("2", 't_')
//                },
//                fail: function (e) {
//                    alert("يوجد خطأ في الاتصال بقاعدة البيانات")
//                }
//            })
//        }
//
//        function UpTahweel(t, d) {
//            var Before = Number($('#' + d + 'BO').val());
//            var Amount = Number($('#' + d + 'amount').val());
//
//            if (t === '1') {
//                var result = Number(Before + Amount);
//            } else {
//
//                var result = Number(Before - Amount);
//            }
//            $('#' + d + 'BF').val(result);
//
//        }

        $('form').submit(function () {
            $('input:submit').attr("disabled", true);
        });
    </script>

@endsection