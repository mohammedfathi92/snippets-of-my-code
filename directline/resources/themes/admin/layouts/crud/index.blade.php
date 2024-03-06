@extends('layouts.master')

@section('css')
    <style type="text/css">
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('title', $title)

@section('actions')
    @if(!empty($dataTable->filters()))
        {!! PackagesForm::link('#'.$dataTable->getTableAttributes()['id'].'_filtersCollapse','<i class="fa fa-filter"></i>',['class'=>'btn btn-info','data'=>['toggle'=>"collapse"]]) !!}
    @endif
    @unless(isset($hideCreate))
        {!! PackagesForm::link(url($resource_url.'/create'), trans('Packages::labels.create'),['class'=>'btn btn-success']) !!}
    @endunless
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_class'=>'box-primary'])
                @if(!empty($dataTable->filters()))
                    <div id="{{ $dataTable->getTableAttributes()['id'] }}_filtersCollapse"
                         class="filtersCollapse collapse">
                        <br/>
                        {!! $dataTable->filters() !!}
                    </div>
                @endif
                <div class="table-responsive m-t-10" style="min-height: 350px;padding-bottom: 20px;">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped table-condensed dataTableBuilder','style'=>'width:100%;']) !!}
                </div>
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
    @include('layouts.crud.filters_script')
    {!! $dataTable->assets() !!}
    {!! $dataTable->scripts() !!}
@endsection