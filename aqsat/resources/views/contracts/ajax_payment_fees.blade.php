{!! Form::open(['route'=>['contracts.pay_fees',$contract->id]]) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel"> دفع الرسوم الادارية لعقد رقم <span> [ {{$contract->contract_num}} ] </span></h4>
</div>
<div class="modal-body">

    <div class="form-group col-lg-6">
        <label for="recipient-name" class="control-label">العميل:</label>
        <input type="text"readonly class="form-control" id="recipient-name" value="{{$contract->client->name}}">
    </div>
    <div class="form-group col-lg-6">
        <label for="recipient-name" class="control-label"> المبلغ المطلوب سداده:</label>
        <input type="number" class="form-control" id="recipient-name" name="contract_fees"
               value="{{$contract->fees - $contract->contract_fees_payment}}">
    </div>

    <div class="form-group col-lg-6">
        <label for="recipient-name" class="control-label"> الحساب المودع عليه قيمة الرسوم:</label>
        <select name="company_account_id" class="select2 form-control">
            
            @foreach($company_accounts as $account)
                <option value="{{$account->id}}">{{$account->account_name}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group col-lg-6">
        <label for="recipient-name" class="control-label">المبلغ المتبقي بالرصيد:</label>
        <input type="text"readonly class="form-control" id="company_account_value" >
    </div>


</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">دفع</button>
</div>

{!! Form::close() !!}

<script type="text/javascript">
$(".select2").select2({
       dropdownParent: $("#exampleModal")
  })
</script>
