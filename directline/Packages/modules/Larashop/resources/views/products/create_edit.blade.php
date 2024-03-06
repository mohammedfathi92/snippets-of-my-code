@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_product_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            @component('components.box')
                {!! Form::model($product, ['url' => url($resource_url.'/'.$product->hashed_id),'method'=>$product->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                  @if(count(\Settings::get('supported_languages', [])) > 0)   
        <div class="row col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            @foreach (\Language::allowed() as $code => $name) 
              <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_{{ $code }}" data-toggle="tab" href>{{ $name }}</a></li>
            @endforeach 
            </ul>
            <div class="tab-content" style="background-color: #efeded;">
                 @foreach (\Language::allowed() as $code => $name) 
              <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_{{ $code }}">
                <div class="post">
               <div class="row">
                    <div class="col-md-6">
                        {!! PackagesForm::text('name['.$code.']','Larashop::attributes.product.name',true,$product->getTranslation('name', $code),[]) !!}
                    </div>
                     <div class="col-md-6">
                        {!! PackagesForm::text('caption['.$code.']','Larashop::attributes.product.caption',true, $product->getTranslation('caption', $code),[]) !!}
                    </div>
                   

                </div>

                 <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::textarea('description['.$code.']','Larashop::attributes.product.description',false, $product->getTranslation('description', $code), ['class'=>'ckeditor','rows'=>5]) !!}
                    </div>
                </div>


                </div>
                </div>
                 @endforeach
             
              
              <!-- /.tab-pane -->
         
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        @endif
                <div class="row">
                   {{--  <div class="col-md-6">
                        {!! PackagesForm::text('name','Larashop::attributes.product.name',true,$product->name,[]) !!}
                    </div> --}}
                    <div class="col-md-12">
                        {!! PackagesForm::text('slug','Larashop::attributes.product.slug',true, $product->slug,['help_text'=>'Larashop::attributes.product.slug_help']) !!}
                    </div>
                   {{--  <div class="col-md-6">
                        {!! PackagesForm::text('caption','Larashop::attributes.product.caption',true,$product->caption,['help_text'=>'']) !!}
                    </div> --}}
                </div>
          

                <div class="row">
                    <div class="col-md-6">
                        {!! PackagesForm::select('global_options[]','Larashop::attributes.product.global_options', \Larashop::getAttributesList(),false,null,['multiple'=>true], 'select2') !!}
                        {!! PackagesForm::select('type','Larashop::attributes.product.type',trans('Larashop::attributes.product.type_option') ,true, null,['class'=>'']) !!}
                        <div id="simple_product_attributes" class="hidden">
                            {!! PackagesForm::text('code','Larashop::attributes.product.sku_code',true,$product->exists? $sku->code:'' ,[] ) !!}
                            {!! PackagesForm::number('regular_price','Larashop::attributes.product.regular_price',true,$product->exists? $sku->regular_price:null,['step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                            {!! PackagesForm::number('sale_price','Larashop::attributes.product.sale_price',false,$product->exists? $sku->sale_price:null,['step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                            {!! PackagesForm::number('allowed_quantity','Larashop::attributes.product.allowed_quantity', false,$sku->exists?$sku->allowed_quantity:0,
                            ['step'=>1,'min'=>0,'max'=>999999, 'help_text'=>'Larashop::attributes.product.help']) !!}
                            {!! PackagesForm::select('inventory','Larashop::attributes.product.inventory',  get_array_key_translation(config('ecommerce.models.sku.inventory_options')),true,$sku->inventory) !!}
                            <div id="inventory_value_wrapper"></div>
                        </div>
                        <div id="variable_product_attributes" class="hidden">
                            {!! PackagesForm::select('variation_options[]','Larashop::attributes.product.variation_options', \Larashop::getAttributesList(),false,null,['multiple'=>true], 'select2') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {!! PackagesForm::select('brand_id','Larashop::attributes.product.brand', \Larashop::getBrandsList(),false,null,[], 'select2') !!}
                        {!! PackagesForm::radio('status','Packages::attributes.status',true, trans('Packages::attributes.status_options')) !!}
                        {!! PackagesForm::checkbox('is_featured', 'Larashop::attributes.product.is_featured', $product->is_featured) !!}
                        {!! PackagesForm::select('categories[]','Larashop::attributes.product.categories', \Larashop::getCategoriesList(),true,null,['multiple'=>true], 'select2') !!}
                        {!! PackagesForm::select('tags[]','Larashop::attributes.product.tags', \Larashop::getTagsList(),false,null,['class'=>'tags','multiple'=>true], 'select2') !!}
                        {!! PackagesForm::select('tax_classes[]','Larashop::attributes.product.tax_classes', \Payments::getTaxClassesList(), false, null,['multiple'=>true], 'select2') !!}


                    </div>
                </div>
               {{--  <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::textarea('description','Larashop::attributes.product.description',false, $product->description, ['class'=>'ckeditor','rows'=>5]) !!}
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::checkbox('shipping[enabled]', 'Larashop::attributes.product.shippable', $product->shipping['enabled']) !!}

                        <div class="row" id="shipping" style="{{ !$product->shipping['enabled']?'display:none':'' }}">
                            <div class="col-md-3">
                                {!! PackagesForm::number('shipping[width]','Larashop::attributes.product.width',false,null,['help_text'=>\Settings::get('ecommerce_shipping_dimensions_unit','in'),'min'=>0]) !!}
                            </div>
                            <div class="col-md-3">
                                {!! PackagesForm::number('shipping[height]','Larashop::attributes.product.height',false,null,['help_text'=>\Settings::get('ecommerce_shipping_dimensions_unit','in'),'min'=>0]) !!}
                            </div>
                            <div class="col-md-3">
                                {!! PackagesForm::number('shipping[length]','Larashop::attributes.product.length',false,null,['help_text'=>\Settings::get('ecommerce_shipping_dimensions_unit','in'),'min'=>0]) !!}
                            </div>
                            <div class="col-md-3">
                                {!! PackagesForm::number('shipping[weight]','Larashop::attributes.product.weight',false,null,['help_text'=>\Settings::get('ecommerce_shipping_weight_unit','oz'),'min'=>0]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::checkbox('external', 'Larashop::attributes.product.external', $product->external_url, 1,['onchange'=>"toggleExternalURL();",'help_text'=>'Larashop::attributes.product.help_external']) !!}
                        <div id="external_section" style="display: {{ $product->external_url ? "block":"none" }}">
                            {!! PackagesForm::text('external_url','Larashop::attributes.product.external_url',false,null) !!}

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::checkbox('downloads_enabled', 'Larashop::attributes.product.downloads_enabled', count($product->downloads), 1,['onchange'=>"toggleDownloadable();"]) !!}
                        @include('Larashop::products.partials.downloadable', ['model' => $product])
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::checkbox('private_content_pages', 'Larashop::attributes.product.private_content_page', count($product->posts), 1,['onchange'=>"togglePremuimContent();"]) !!}
                    </div>
                </div>
                <div class="row" id="product_pages" style="display: {{ count($product->posts) ? "block":"none" }}">
                    <div class="col-md-12">
                        {!! PackagesForm::select('posts[]','Larashop::attributes.product.posts', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Packages\Modules\CMS\Models\Content::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($product->posts()->pluck('posts.id')->toArray()),
                        'where'=>json_encode([['field'=>'private','operation'=>'=','value'=>1]]),
                        ]],'select2') !!}
                    </div>
                </div>

                {!! \Actions::do_action('ecommerce_product_form_post_fields', $product) !!}

                {!! PackagesForm::customFields($product) !!}
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
        @if($product->exists)
            <div class="col-md-5">
                @component('components.box')
                    @include('Larashop::products.gallery',['product'=>$product,'editable'=>true])
                @endcomponent
            </div>
        @endif
    </div>
@endsection

@section('js')

    <script type="application/javascript">
        function slugify(text, locale)
{
  var slug = text.toString().toLowerCase()
    .replace(/\s+/g, '-')     // Replace spaces with -
    .replace(/\uFFFD/g, '-')  
    // .replace(/[^\w\-]+/g, '')    // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
   var slugInput = document.getElementById("slug_"+locale);
   slugInput.value = slug;
}
        $(document).ready(function () {
            $('input[name="external"]').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#external_link').fadeIn();
                } else {
                    $('#external_link').fadeOut();
                }
            });
            $('input[name="shipping[enabled]"]').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#shipping').fadeIn();
                } else {
                    $('#shipping').fadeOut();
                }
            });
            $('select[name="type"]').on('change', function () {
                $product_type = $(this).val();
                if ($product_type === "simple") {
                    $('#simple_product_attributes').removeClass('hidden');
                    $('#variable_product_attributes').addClass('hidden');
                    setInventoryValue('{{ old('inventory', $sku->inventory) }}');
                } else if ($product_type === "variable") {
                    $('#simple_product_attributes').addClass('hidden');
                    $('#variable_product_attributes').removeClass('hidden');
                } else {
                    $('#simple_product_attributes').addClass('hidden');
                    $('#variable_product_attributes').addClass('hidden');
                }
            });

            $('select[name="type"]').trigger('change');
            $('#inventory').change(function (event) {
                var value = $(this).val();
                setInventoryValue(value);
            });


        });

        function togglePremuimContent() {
            var input = $('#private_content_pages');
            if (input.prop('checked')) {
                $('#product_pages').fadeIn();
            } else {
                $('#product_pages').fadeOut();
            }
        }

        function toggleExternalURL() {
            var input = $('#external');
            if (input.prop('checked')) {
                $('#external_section').fadeIn();
            } else {
                $('#external_section').fadeOut();
            }
        }

        function setInventoryValue(value) {
            var input = '';

            if (value === 'bucket') {
                input = '{{ PackagesForm::select('inventory_value','Inventory Value', get_array_key_translation(config('ecommerce.models.sku.bucket')),false,$sku->inventory_value?$sku->inventory_value:null )  }}';
            } else if (value === 'finite') {
                input = '{{ PackagesForm::number('inventory_value','Inventory Value',false,$sku->inventory_value?$sku->inventory_value:null,
                                    ['help_text'=>'',
                                    'step'=>1,'min'=>0,'max'=>999999])  }}';
            } else {
                input = '';
            }

            $("#inventory_value_wrapper").html(input);

            if (input !== '') {
                $("#inventory_value_wrapper").show();
            } else {
                $("#inventory_value_wrapper").hide();
            }
        }

    </script>
@endsection