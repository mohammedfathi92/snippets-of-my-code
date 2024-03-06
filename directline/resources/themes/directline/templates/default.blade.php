@extends('layouts.master')

@section('editable_content')
    @include('partials.page_header')
    @php \Actions::do_action('pre_content',$item, $home??null) @endphp
       <div class="row">
    	<div class="col-md-10" style="padding: 30px; margin: 30px;">
    		
    		{!! $item->content !!}
    		
    	</div>
    </div>
@stop