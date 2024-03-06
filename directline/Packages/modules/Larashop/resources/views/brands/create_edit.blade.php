@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_brand_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                {!! Form::model($brand, ['url' => url($resource_url.'/'.$brand->hashed_id),'method'=>$brand->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! PackagesForm::text('name','Larashop::attributes.brand.name',true) !!}
                        {!! PackagesForm::text('slug','Larashop::attributes.brand.slug',true) !!}
                        {!! PackagesForm::checkbox('is_featured', 'Larashop::attributes.brand.is_featured', $brand->is_featured) !!}
                        {!! PackagesForm::radio('status','Packages::attributes.status',true, trans('Packages::attributes.status_options')) !!}
                    </div>
                    <div class="col-md-6">
                        @if($brand->hasMedia($brand->mediaCollectionName))
                            <img src="{{ $brand->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! PackagesForm::checkbox('clear', 'Larashop::attributes.brand.clear') !!}
                        @endif
                        {!! PackagesForm::file('thumbnail', 'Larashop::attributes.brand.thumbnail') !!}
                    </div>
                </div>
                {!! PackagesForm::customFields($brand, 'col-md-12') !!}
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}

                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection