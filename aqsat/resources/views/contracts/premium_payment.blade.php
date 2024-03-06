{!! Form::open(['route'=>['contracts.premium_payment', $premium_info->id],'method'=>'post','id'=>'premium_payment']) !!}

 @if($premium_info->status == 2)
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">تم سداد القسط رقم #{{$premium_info->order}}</h4>
</div>

<div class="modal-body">

    <div id="form_content">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">تاريخ الإستحقاق</label>
                <label class="form-control">{{\Carbon\Carbon::parse($premium_info->date_type_hij)->format('Y-m-d')}} /
                    {{date('d-m-y', strtotime($premium_info->date_type_mi))}}
                </label>
               <input type="hidden" name="prem_type" value="1"> {{-- paid --}}
                <input type="hidden" name="order" value="{{$order}}">
                <input type="hidden" value="{{$contract_id}}" name="contract_id">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">قيمة القسط</label>
                <input type="number" id="amount" class="form-control"
                       value="{{$premium_info->payment}}" name="amount" disabled/>
            </div>
        </div>
        @php
        $finan = \App\Financial_transaction::where('premium_id', $premium_info->id)->first();

         $paid_account_name = '';
         $paid_account_id = '';
        if($finan){
            $paid_account_id = $finan->account_id;
            $paid_account = \App\Company_account::find($paid_account_id);
            if($paid_account){
               $paid_account_name = $paid_account->account_name;
            }
        }   
        @endphp
        <div class="col-md-6">
            <div class="form-group">
                <label for="">الحساب البنكي</label>
                <select name="account_id" class="form-control select2" style="border:1px solid #aaa;"  name="account_id" disabled>
                   
                    <option value="{{$paid_account_id }}" selected >{{$paid_account_name?:'لا يوجد حساب'}} </option>
           
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">ملاحظة القسط</label>
                <textarea id="note" class="form-control"
                          name="note" disabled> {{ $premium_info->note }}</textarea>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <div class="row col-md-12">
    <input type="submit" class="btn btn-primary" value="دفع" disabled/>
    </div>
</div>

@else

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">سداد القسط رقم #{{$premium_info->order}}</h4>
</div>

<div class="modal-body">

    <div id="form_content">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">تاريخ الإستحقاق</label>
                <label class="form-control">{{\Carbon\Carbon::parse($premium_info->date_type_hij)->format('Y-m-d')}} /
                    {{date('d-m-y', strtotime($premium_info->date_type_mi))}}
                </label>
                 <input type="hidden" name="prem_type" value="0"> {{-- not paid --}}
                <input type="hidden" name="order" value="{{$order}}">
                <input type="hidden" value="{{$contract_id}}" name="contract_id">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">المبلغ</label>
                <input type="number" id="amount" class="form-control"
                       value="{{$premium_info->amount - $premium_info->payment}}" name="amount"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">الحساب البنكي</label>
                <select name="account_id" class="form-control select2" style="border:1px solid #aaa;"  name="account_id">
                    <option value="">-- اختر الحساب --</option>
                    @foreach($investor_accounts as $investor_account)
                    <option value="{{$investor_account->id}}">{{$investor_account->account_name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">ملاحظة إضافية</label>
                <textarea id="note" class="form-control" name="note">{{ $premium_info->note }}</textarea>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <div class="row col-md-12">
    <input type="submit" class="btn btn-primary" value="دفع" />
    </div>
</div>

@endif


{!! Form::close() !!}

<script>
    $('.select2').select2();
</script>






