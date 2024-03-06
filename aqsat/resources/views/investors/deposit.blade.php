@extends('voyager::master')


@section('page_title', __('title.investor.deposit'))

@section('page_header')
    <h1><i class="fa fa-money"></i>عملية إيداع</h1>
@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            @include('include.message')
            {!! Form::open(['route' => 'investors.deposit.store','method'=>'post']) !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-plus-circle"></i> إيداع جديد</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><span class="account"> المستثمر </span></label>

                                @if(isset($type))
                                    <input type="text" readonly value="company" class="form-control">
                                    <input type="hidden" name="user_id" value="1">
                                @else
                                    <select name="user_id" class="form-control select2 investor"
                                            onchange=" GetAccounts(this.value);">
                                        <option class="option" value=""> --اختر المستثمر--</option>
                                        @foreach($investors as $investor)
                                            <option class="option" value="{{$investor->id}}">
                                                {{$investor->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                                <input type="hidden" name="investor_id" id="investor_id">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" i>
                                <label>الحساب</label>
                                @if(isset($type))
                                    <select class="form-control select2" id="investor_accounts"
                                            style="border:1px solid #aaa;" tabindex="2"
                                            name="account_id" onchange=" GetAccountValue(this.value);">
                                        <option value="" selected="selected">--أختر --</option>
                                        @foreach($company_accounts as $account)
                                            <option value="{{$account->id}}">
                                                {{$account->account_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2" id="investor_accounts"
                                            style="border:1px solid #aaa;" tabindex="2"
                                            name="account_id" onchange=" GetAccountValue(this.value);">
                                        <option value="">--أختر --</option>
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>المبلغ</label>
                                <input tabindex="1" id="new_balance"
                                       name="amount" value="" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>الرصيد قبل</label>
                                <input disabled="" id="BO_read" placeholder="" class="form-control total_account">
                                <input type="hidden" name="after" id="after" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>الرصيد بعد</label>
                                <input disabled="" name="total_account" id="BF" class="form-control after_balance">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الملاحظات: </label>
                                <textarea name="notes" placeholder="أكتب الملاحظات التي تريد إضافتها في البيان هنا ، أو أتركها فارغة." class="form-control"></textarea>
                            </div>
                        </div>
                        <br clear="both"/>
                        <div class="col-md-4" style="float: none;">
                            <div class="form-group">
                                <input type="checkbox" id="buyNewProduct" onchange="buyOutProducts();"
                                       name="out_product">
                                <label> شراء سلعة خارجية </label>
                            </div>
                        </div>

                        <div id="outProducts" style="display: none;">
                            <h4 class="alert alert-warning ">
                                <span class="fa fa-warning"> قيمه الشراء يجب الا تزيد عن قيمة المبلغ المتوفر فى حساب المستثمر</span>
                            </h4>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> الكمية </label>
                                    <input type="number" disabled name="quantity" min="0" placeholder='الكمية'
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
                                    <input type="number" name="total_price" id="total_price" disabled
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary my_btn_left"><i class="fa fa-save"></i> إيداع
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <br clear="both"/>
            {!! Form::close() !!}
        </div>

    </div>
    </section>

@endsection

@section('javascript')

    <script>
        function buyOutProducts() {
            if ($('#buyNewProduct').is(":checked")) {
                $('#outProducts').css("display", 'block');
                $('#quantity').removeAttr('disabled');
                $('#price').removeAttr('disabled');
            } else {
                $('#outProducts').css("display", 'none');
                $('#quantity').attr('disabled');
                $('#price').attr('disabled');
            }
        }

        function sumTotalPrice() {
            var total = Number($('#quantity').val()) * Number($('#price').val());
            $('#total_price').val(total);
        }

    </script>



    <script>
        $(document).ready(function () {
            $('#new_balance').keyup(function () {
                var new_account = $(this).val();
                var total_account = $('.total_account').val();
                var after_balance = Number(new_account) + Number(total_account);
                $('.after_balance').val(after_balance);
            })
        });
    </script>

    <script type="text/javascript">

        function GetAccounts(id) {
            $.ajax({
                type: 'post',
                url: '/admin/investors/ajax',
                data: {id: id},
                success: function (data) {
                    $("#investor_accounts").html(data);
                    $("#investor_id").val(id);
                }
            });
        }

        function GetAccountValue(value) {
            $.ajax({
                type: 'post',
                url: '/admin/investors/ajax_deposit_account_value',
                data: {id: value},
                success: function (data) {
                    $("#BO_read").val(data);
                    $("#after").val(data);

                }
            });
        }

    </script>





@endsection