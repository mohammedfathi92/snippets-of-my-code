@extends('voyager::master')
@section('page_title', __('title.contract.collection'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> السداد والتحصيل </span> <a href="{{route('contracts.create',1)}}"
                                                                       class="btn btn-danger my_btn_left"
                                                                       onclick="$('#add_panal').toggle();">
            <i class="fa fa-plus-circle"> اضافه عقد تقسيط </i>
        </a></h1>
@endsection
@section('content')
    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route'=>'contracts.premium_payment','method'=>'post']) !!}
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-credit-card"></i> سداد العقد </h3>
                        </div>

                        <div class="box-body ">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label> العميل</label>
                                    <label class="form-control" style="background:#eee;">{{$contract->client->name}} <a
                                                href="{{route('clients.show',$contract->client->id)}}"><i class="fa fa-link"></i></a></label>
                                </div>
                                <div class="col-md-6">
                                    <label> المستثمر</label>
                                    <label class="form-control" style="background:#eee;">{{$contract->investor->name}} <a
                                                href="{{route('investors.show',$contract->investor->id)}}"><i class="fa fa-link"></i></a></label>
                                </div>
                                <div class="col-md-12">
                                    <label>القسط</label>
                                    <select id="qasst" style="height:40px;" name="order"
                                            onchange="getPayment(this.value);ChangeStatment();"
                                            class="form-control">
                                        <option value="">-- أختر --</option>
                                        @foreach($premiums as $premium)
                                        <option  value="{{$premium->order}}">القسط المستحق بتاريخ:
                                            <span>{{$premium->date_type_mi}} / المبلغ: {{$premium->amount}}

                                                || المدفوع:{{$premium->payment}}
                                            </span>
                                        </option>
                                        @endforeach
                                        <input type="hidden" name="contract_id" id="contract_id" value="{{$contract->id}}">

                                        <option value="0">غير محدد</option>
                                    </select>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>المبلغ المراد سداده</label>
                                        <input tabindex="1" id="payment" name="amount" value=""  type="number" min="0"
                                               placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>المبلغ المتبقي</label>
                                        <input disabled=""  value="{{$contract->contract_value - $premiums_payment}}" placeholder=""
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الحساب</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;" tabindex="2" name="account_id">
                                            <option value=""> --اختر الحساب -- </option>
                                            @foreach($contract->investor->company_account as $account)
                                            <option value="{{$account->id}}">{{$account->account_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>الوصف: <font color="red" id="st"></font></label>
                                        <textarea name="note" onkeyup="ChangeStatment();" id="statment"
                                                  class="form-control"
                                                  placeholder="أكتب إذا كانت لديك ملاحظة إضافية ، أتركه فارغاً في حالة عدم وجود ملاحطة!"></textarea>
                                    </div>
                                </div>
                                <br clear="both"/>
                            </div>
                        </div>
                    </div>
                    <br clear="both"/>
                    <div class="col-md-12 ">
                        <button type="submit" onclick="$(this).hide();$('#h').show();"
                                class="btn  blue-hoki btn-lg btn-lg f_left">سداد المبلغ
                        </button>
                    </div>
                    <br clear="both"/>
                {{Form::close()}}
            </div>
        </div>
        <br clear="both"/>
        </div>
    </section>

@endsection
@section('javascript')
    <script type="text/javascript">
        function getPayment(order) {
            var contract_id = $('#contract_id').val();
            $.ajax({
               type:'post',
                url:'/admin/contracts/ajax_get_payment',
                data:{order:order,contract_id:contract_id},
                success:function (data) {
                    $('#payment').val(data);
                }
            });
        }

        function UpdateQasstInput(id) {
            $('#amount').val($('#qh' + id).val());
        }
        $('form').submit(function () {
            $('#submit_btn').attr("disabled", true);
        });
    </script>
@endsection

