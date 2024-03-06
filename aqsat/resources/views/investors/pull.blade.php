@extends('voyager::master')

@if(isset($type_2))

    @section('page_title', __('title.investor.pull_company'))
@else
    @section('page_title', __('title.investor.pull'))
@endif



@section('page_title', __('title.investor.pull'))

@section('page_header')
    @if(isset($type_2))
        <h1><i class="fa fa-money"></i> اداره المصروفات </h1>
    @else
        <h1><i class="fa fa-money"></i> عملية سحب </h1>
    @endif
@endsection

@section('content')


    <section class="content">
        <div class="row">
            <div class="col-md-12">


                @include('include.message')
                {!! Form::open(['route' => ['investors.pull.store'],'method'=>'post']) !!}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if(isset($type_2))
                            <h3 class="box-title"><i class="fa fa-minus-circle"></i> عملية سحب مصروفات جديدة</h3>
                        @else
                            <h3 class="box-title"><i class="fa fa-minus-circle"></i> عملية سحب جديدة</h3>
                        @endif
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
                                                onchange=" GetInvestorAccount(this.value); ">

                                            <option value=""> --اختر المستثمر--</option>
                                            @foreach($investors as $investor)
                                                <option class="option" value="{{$investor->id}}">
                                                    {{$investor->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
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
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="2"
                                                name="account_id" id="investor_accounts"
                                                onchange="GetAccountValue(this.value);">
                                            <option value="">--أختر --</option>
                                        </select>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>المبلغ</label>
                                    <input tabindex="1" id="new_balance" type="number" min="0"
                                           name="amount" value="" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>الرصيد قبل</label>
                                    <input disabled="" id="BO_read" placeholder="" class="form-control total_account"
                                           type="number">
                                    <input type="hidden" disabled="" id="BO" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>الرصيد بعد</label>
                                    <input disabled="" name="total_account" type="number"
                                           id="BF" placeholder="" min="0"
                                           class="form-control after_balance"
                                    >
                                </div>
                            </div>

                            @if(isset($type_2))
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> البند</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="2"
                                                name="target_id" id="investor_accounts">
                                            <option value="">--أختر --</option>
                                            @foreach($targets as $target)
                                                <option value="{{$target->id}}"
                                                        selected="selected">{{$target->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="type_2" value="{{$type_2}}">
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>البيان: </label>
                                    <textarea name="notes" placeholder="أكتب الملاحظات التي تريد إضافتها في البيان هنا ، أو أتركها فارغة." class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary my_btn_left"><i class="fa fa-save"></i> سحب
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br clear="both"/>
                {!! Form::close() !!}
            </div>
            <br clear="both"/>

            @if(isset($type_2))

                <div class="box box-primary box-solid">
                    <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمه المصروفات</h3>
                    <div class="box-body">
                        <table id="aqTable" class="table table-bordered table-hover display"
                               cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th id="name">اسم البند</th>
                                <th id="name">السعر</th>
                                <th id="name">تاريخ الاضافة</th>
                                <th id="name"> اسم الموظف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pull_expenses as $expens)
                                <tr>
                                    <td>{{$expens->target->name}}</td>
                                    <td>{{$expens->price}}</td>
                                    <td>{{$expens->created_at}}</td>
                                    <td>{{$expens->employee->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection

@section('javascript')

    <script>
        $(document).ready(function () {
            $('#new_balance').keyup(function () {
                var new_account = $(this).val();
                var total_account = $('.total_account').val();
                var after_balance = Number(total_account) - Number(new_account);
                $('.after_balance').val(after_balance);

            })
        });
    </script>

    <script type="text/javascript">

        function GetInvestorAccount(id) {
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
                data: {id: value},
                success: function (data) {
                    $("#BO_read").val(data);
                }
            });
        }

    </script>

@endsection