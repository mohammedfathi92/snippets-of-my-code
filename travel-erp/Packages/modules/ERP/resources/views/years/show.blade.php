@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('region_show') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('components.box')
        <div class="row">
            <div class="col-md-12">
                <!-- show regions details here -->
                <p>{{$country->name}}</p>
                <p>{{$country->code}}</p>
                <p> {{$country->region->name}}</p>
                <p>{{$country->description}} </p>
            </div>
        </div>
    @endcomponent
@endsection

