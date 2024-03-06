<select name="account_id" class="form-control select2 investor"
        onchange=" GetAccountValue(this.value);">
    <option class="option" value=""> --اختر الحساب-- </option>
    @foreach($accounts as $account)
        <option  value="{{$account->id}}">{{$account->account_name}}</option>
    @endforeach
</select>