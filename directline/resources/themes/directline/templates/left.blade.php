@extends('layouts.master')

@section('editable_content')
    @include('partials.page_header')
    
    <div class="container padding-bottom-3x mb-1">
        <div class="row">
            <div class="col-xl-9 col-lg-8 order-lg-2">
                {!! $item->rendered !!}
            </div>
            
                <aside class="col-xl-3 col-lg-4 order-lg-1">
                @include('partials.sidebar')
            </aside>
           
        </div>
    </div>
@stop