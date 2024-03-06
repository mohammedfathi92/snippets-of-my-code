@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_coupon_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                {!! Form::model($coupon, ['url' => url($resource_url.'/'.$coupon->hashed_id),'method'=>$coupon->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! PackagesForm::text('code','Larashop::attributes.coupon.code',true) !!}
                        {!! PackagesForm::select('type', 'Larashop::attributes.coupon.type',trans('Larashop::attributes.coupon.type_option')) !!}
                        {!! PackagesForm::text('value','Larashop::attributes.coupon.value',true) !!}
                        {!! PackagesForm::number('min_cart_total','Larashop::attributes.coupon.min_cart_total') !!}
                    </div>
                    <div class="col-md-6">
                        {!! PackagesForm::date('start','Larashop::attributes.coupon.start',true,$coupon->start) !!}
                        {!! PackagesForm::date('expiry','Larashop::attributes.coupon.expiry',true,$coupon->expiry) !!}
                        {!! PackagesForm::number('uses','Larashop::attributes.coupon.uses',false,$coupon->exists?$coupon->uses:'', array_merge(['step'=>1,'min'=>1,'max'=>999999])) !!}
                        {!! PackagesForm::number('max_discount_value','Larashop::attributes.coupon.max_discount_value') !!}

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::select('users[]','Larashop::attributes.coupon.users', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Packages\User\Models\User::class,
                        'columns'=> json_encode(['name']),
                        'selected'=>json_encode($coupon->users()->pluck('users.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::select('products[]','Larashop::attributes.coupon.products', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Packages\Modules\Larashop\Models\Product::class,
                        'columns'=> json_encode(['name']),
                        'selected'=>json_encode($coupon->products()->pluck('ecommerce_products.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>

                {!! PackagesForm::customFields($coupon, 'col-md-6') !!}

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