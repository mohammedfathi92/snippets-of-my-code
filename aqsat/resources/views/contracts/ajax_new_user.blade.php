@php
if($user_type == 'client'){
	$input_name = 'client_id';
}elseif ($user_type == 'sponsor_1') {
	$input_name = 'sponsor_id';
}else{
$input_name = 'sponsor_two_id';
}
@endphp
    <label style="background: green;padding: 3px;color: wheat;border-radius: 6px; "> تم إضافة المستخدم بنجاح </label>
    <select name="{{ $input_name }}" class="form-control person_select select2" tabindex="2">
        <option value="">-- أختر المستخدم --</option>
        @foreach($users_list as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>


<script>
    $('.select2').select2();
</script>

