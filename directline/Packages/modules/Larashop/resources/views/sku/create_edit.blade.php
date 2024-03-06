@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('sku_create_edit',$product) }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($sku, ['url' => trim(url($resource_url.'/'.$sku->hashed_id),'/'),'method'=>$sku->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! PackagesForm::number('regular_price','Larashop::attributes.sku.regular_price',true,$sku->exists?$sku->regular_price:null,['step'=>0.01,'min'=>0,'max'=>999999,'icon'=>$sku->currency_icon]) !!}
                        {!! PackagesForm::number('sale_price','Larashop::attributes.sku.sale_price',false,$sku->exists?$sku->sale_price:null,['step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                        {!! PackagesForm::number('allowed_quantity','Larashop::attributes.sku.allowed_quantity', false,$sku->exists?$sku->allowed_quantity:0,
                            ['step'=>1,'min'=>0,'max'=>999999, 'help_text'=>'Larashop::attributes.sku.help']) !!}

                        {!! PackagesForm::text('code','Larashop::attributes.sku.code_sku',true,$sku->code ,array_merge([], $sku->exists?['readonly'=>'readonly']:[]) ) !!}
                        {!! PackagesForm::radio('status','Packages::attributes.status', true, trans('Packages::attributes.status_options')) !!}

                        {!! PackagesForm::select('inventory','Larashop::attributes.sku.inventory', get_array_key_translation(config('ecommerce.models.sku.inventory_options')),true,null,[]) !!}

                        <div id="inventory_value_wrapper"></div>

                    </div>
                    <div class="col-md-4">
                        {!! $product->renderProductOptions('variation_options',$sku->exists ? $sku : null  )  !!}

                        @if($product->shipping['enabled'])
                            <div class="row" id="shipping">
                                <div class="col-md-3">
                                    {!! PackagesForm::number('shipping[width]','Larashop::attributes.sku.width',true,$sku->shipping['width'] ?? $product->shipping['width']  ,['help_text'=>\Settings::get('ecommerce_shipping_dimensions_unit','inch'),'min'=>0]) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! PackagesForm::number('shipping[height]','Larashop::attributes.sku.height',true,$sku->shipping['height']?? $product->shipping['height'] ,['help_text'=>\Settings::get('ecommerce_shipping_dimensions_unit','inch'),'min'=>0]) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! PackagesForm::number('shipping[length]','Larashop::attributes.sku.length',true,$sku->shipping['length']?? $product->shipping['length'] ,['help_text'=>\Settings::get('ecommerce_shipping_dimensions_unit','inch'),'min'=>0]) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! PackagesForm::number('shipping[weight]','Larashop::attributes.sku.weight',true,$sku->shipping['weight']?? $product->shipping['weight'] ,['help_text'=>\Settings::get('ecommerce_shipping_weight_unit','ounce'),'min'=>0]) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {!! PackagesForm::file('image', 'Larashop::attributes.sku.image') !!}

                        <img src="{{ $sku->image }}" class="img-responsive" width="150"
                             alt="SKU Image"/>
                        @if($sku->exists && $sku->getFirstMedia('ecommerce-sku-image'))

                            {!! PackagesForm::checkbox('clear', 'Larashop::attributes.sku.clear',0) !!}

                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        {!! PackagesForm::checkbox('downloads_enabled', 'Larashop::attributes.sku.downloads_enabled', count($sku->downloads), 1,['onchange'=>"toggleDownloadable();"]) !!}
                        @include('Larashop::products.partials.downloadable', ['model' => $sku])
                    </div>
                </div>
                {!! PackagesForm::customFields($sku) !!}
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function setInventoryValue(value) {
            var input = '';

            if (value == 'bucket') {

                input = '{{ PackagesForm::select('inventory_value','Larashop::attributes.sku.inventory_value',config('ecommerce.models.sku.bucket'),false,$sku->inventory_value?$sku->inventory_value:null )  }}';
            } else if (value == 'finite') {
                input = '{{ PackagesForm::number('inventory_value','Larashop::attributes.sku.inventory_value',false,$sku->inventory_value?$sku->inventory_value:null,
                                    ['help_text'=>'',
                                    'step'=>1,'min'=>0,'max'=>999999])  }}';
            } else {
                input = '';
            }

            $("#inventory_value_wrapper").html(input);

            if (input != '') {
                $("#inventory_value_wrapper").show();
            } else {
                $("#inventory_value_wrapper").hide();
            }
        }

        $(document).ready(function () {

            setInventoryValue('{{ old('inventory', $sku->inventory) }}');

            $('#inventory').change(function (event) {
                var value = $(this).val();
                setInventoryValue(value);
            });
        });
    </script>
@endsection