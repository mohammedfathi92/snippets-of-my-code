
@php

 if(isset($select['required'])){
 	$required = true;
 }else{

 	$required = false;

 }
@endphp


 {!! PackagesForm::select(
 $select['name'],
 $select['label'],
 $select['options'],
 $required,
 $select['selected'],
 $select['attributes'],
 $select['select2']
 )
  !!}



