@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('bar_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! ModulesForm::openForm($bar) !!}
                <div class="row">
                    <!-- place bar fields here-->
                </div>

                {!! ModulesForm::customFields($bar) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::formButtons() !!}
                    </div>
                </div>
                {!! ModulesForm::closeForm($bar) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection
