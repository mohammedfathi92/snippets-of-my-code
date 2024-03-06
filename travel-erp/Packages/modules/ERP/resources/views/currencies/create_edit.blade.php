@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('currencies_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-4">
            @component('components.box')
                {!! PackagesForm::openForm($currency) !!}

                {!! PackagesForm::text('code','Payment::attributes.currency.code',true,$currency->code,['readonly']) !!}
                {!! PackagesForm::text('name','Payment::attributes.currency.name',true) !!}
                {!! PackagesForm::text('symbol','Payment::attributes.currency.symbol',true) !!}
                {!! PackagesForm::text('format','Payment::attributes.currency.format',true) !!}
                {!! PackagesForm::text('exchange_rate','Payment::attributes.currency.exchange_rate',true) !!}
                {!! PackagesForm::checkbox('active','Packages::attributes.status_options.active',$currency->active) !!}

                {!! PackagesForm::formButtons() !!}

                {!! PackagesForm::closeForm($currency) !!}
            @endcomponent
        </div>
    </div>
@endsection