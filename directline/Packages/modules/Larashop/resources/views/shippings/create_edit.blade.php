@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_shipping_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                {!! Form::model($shipping, ['url' => url($resource_url.'/'.$shipping->hashed_id),'method'=>$shipping->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! PackagesForm::text('name','Larashop::attributes.shipping.name',true,null,['help_text'=>'Larashop::attributes.shipping.help_shipping_name']) !!}
                        {!! PackagesForm::select('country', 'Larashop::attributes.shipping.country', \Settings::getCountriesList(),false , null,['placeholder'=>'Larashop::labels.shipping.place_holder']) !!}
                        {!! PackagesForm::select('shipping_method', 'Larashop::attributes.shipping.shipping_method', \Shipping::getShippingMethods() , true) !!}
                        {!! PackagesForm::number('min_order_total','Larashop::attributes.shipping.min_order_total',false,$shipping->min_order_total ?? 0.0,
                       array_merge(['help_text'=>'Larashop::attributes.shipping.help','right_addon'=>'<i class="fa fa-fw fa-'.strtolower(  \Settings::get('admin_currency_code', 'USD')).'"></i>',
                       'step'=>0.01,'min'=>0,'max'=>999999])) !!}
                        {!! PackagesForm::checkbox('exclusive', 'Larashop::attributes.shipping.exclusive', $shipping->exclusive,1, ['help_text'=>'Larashop::attributes.shipping.help_exclusive'] ) !!}


                    </div>
                    <div class="col-md-6">
                        {!! PackagesForm::number('priority','Larashop::attributes.shipping.priority',true,null,['step'=>1,'min'=>0,'max'=>999999,'help_text'=>'Larashop::attributes.shipping.help_num_higher']) !!}

                        {!! PackagesForm::number('rate','Larashop::attributes.shipping.rate',false,$shipping->rate ?? 0.0,
array_merge(['help_text'=>'Larashop::attributes.shipping.help','right_addon'=>'<i class="fa fa-fw fa-'.strtolower(  \Settings::get('admin_currency_code', 'USD')).'"></i>',
'step'=>0.01,'min'=>0,'max'=>999999])) !!}
                        {!! PackagesForm::textarea('description','Larashop::attributes.shipping.description',false,null,['rows'=>3]) !!}
                    </div>
                </div>
                {!! PackagesForm::customFields($shipping, 'col-md-6') !!}

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