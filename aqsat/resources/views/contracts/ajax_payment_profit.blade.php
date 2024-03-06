{!! Form::open(['route'=>['contracts.pay_profit',$contract->id]]) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel"> دفع عمولة عقد رقم <span> [ {{$contract->contract_num}} ] </span></h4>
</div>
<div class="modal-body">

        <div class="form-group col-lg-6">
            <label for="recipient-name" class="control-label">المستثمر:</label>
            <input type="text"readonly class="form-control" id="recipient-name" value="{{$contract->investor->name}}">
        </div>
        <div class="form-group col-lg-6">
            <label for="recipient-name" class="control-label"> قيمه العمولة:</label>
            <input type="text" class="form-control" id="recipient-name" name="contract_profit"
                   value="{{$contract->contract_profit - $contract->contract_profit_payment}}">
        </div>

        <div class="form-group col-lg-6">
            <label for="recipient-name" class="control-label">حسابات المستثمر </label>
            <select name="investor_account_id" class="form-control" onchange="getInvestorAccountValue(this.value);">
                <option value="">-- أختر --</option>
                @foreach($contract->investor->company_account as $account)
                    <option value="{{$account->id}}">{{$account->account_name}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group col-lg-6">
            <label for="recipient-name" class="control-label"> حسابات الشركه:</label>
            <select name="company_account_id" class="form-control" onchange="getCompanyAccountValue(this.value);">
                <option value="">-- أختر --</option>
            
                    <option value="{{$account->id}}">{{$account->account_name}}</option>
              
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label for="recipient-name" class="control-label">المبلغ:</label>
            <input type="text"readonly class="form-control" id="investor_account_value">
        </div>

        <div class="form-group col-lg-6">
            <label for="recipient-name" class="control-label">المبلغ:</label>
            <input type="text"readonly class="form-control" id="company_account_value" >
        </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">دفع</button>
</div>

{!! Form::close() !!}