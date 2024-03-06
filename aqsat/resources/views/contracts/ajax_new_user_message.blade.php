@php
if($type == 'client'){
    $input_name = 'client_id';
}elseif ($type == 'sponsor_1') {
    $input_name = 'sponsor_id';
}else{
$input_name = 'sponsor_two_id';
}
@endphp
@if(count($errors) > 0)
    <div class="alert alert-danger " id="messages">
        <button type="button" data-dismiss="alert" class="btn btn-danger"
                aria-hidden="true">×
        </button>
        <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة تحذيرية</strong>
        <hr class="message-inner-separator">
        <p>
        <ul>
            @foreach($errors->all() as $errors)
                <li style="font-size: 17px;">  {{ $errors }} </li>
            @endforeach
        </ul>
        </p>
    </div>
@endif
    <select name="{{ $input_name }}" class="form-control person_select select2" tabindex="2">
        <option value="">-- أختر العميل --</option>
        @foreach($dataUsers as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>


<script>
    $('.select2').select2();
</script>