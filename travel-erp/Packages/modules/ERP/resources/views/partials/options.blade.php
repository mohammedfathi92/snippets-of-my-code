
@php
 if(isset($select['required']) && $select['required'] == 'true'){
 	$required = 'required-field';
 }else{

 	$required = '';

 }
 	
@endphp


<div class="form-group {{$required}}">
	<label for={{$select['name']}}>{{$select['label']}}</label>
	<select @foreach($select['attributes'] as $key => $value) {{$key}}= "{{$value}}" @endforeach name="{{$select['name']}}">
	<option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
	@foreach($select['options'] as $row)
	<option value="{{$row->id}}" data-balance="{{$row->balance}}">{{$row->translated_name}}</option>
	@endforeach
  </select>
</div>


  <script type="text/javascript">
  	$(".add-select2").select2();
  </script>


