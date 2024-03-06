@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="panel">
            <ol class="breadcrumb">

                <li href="{{url("/")}}">{{trans("main.link_home")}}</li>
                <li class="active">{{ $data->title }}</li>
            </ol>
        </div>

        <div class="panel">
            <div class="panel-title">{{$data->title}}</div>

            <div class="panel-body">
                {!! $data->body !!}
            </div>

        </div>
    </div>
@endsection
