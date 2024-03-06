@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_attribute_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($attribute, ['url' => url($resource_url.'/'.$attribute->hashed_id),'method'=>$attribute->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                 @if(count(\Settings::get('supported_languages', [])) > 0)   
        <div class="row col-md-4">
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
                    <div class="col-md-12">
                        {!! PackagesForm::text('label['.$code.']','Larashop::attributes.attributes.label',true,  $attribute->getTranslation('label', $code)) !!}
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
                    <div class="col-md-4">
                        {!! PackagesForm::select('type', 'Larashop::attributes.attributes.type', get_array_key_translation(config('settings.models.custom_field_setting.supported_types')), true,$attribute->type,$attribute->exists?['readonly']:[]) !!}
{{--   {!! PackagesForm::text('label','Larashop::attributes.attributes.label',true) !!} --}}                        {!! PackagesForm::number('display_order','Larashop::attributes.attributes.order',true,0,['min'=>0]) !!}
                        {!! PackagesForm::checkbox('use_as_filter', 'Larashop::attributes.attributes.use_as_filter', $attribute->use_as_filter) !!}
                        {!! PackagesForm::checkbox('required', 'Larashop::attributes.attributes.required', $attribute->required) !!}
                    </div>
                    <div class="col-md-4">

                        <div style="display: none;" id="options-field">
                            <div class="form-group" style="">
                                <span data-name="options"></span>
                                {!! PackagesForm::label('options', 'Larashop::attributes.attributes.options') !!}
                                @include('Larashop::attributes.options',[
                                                                'name'=>'options',

                                'options'=> $attribute->options??[]
                                ])
                            </div>
                        </div>
                    </div>
                </div>
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

    <script type="text/javascript">
        $(document).ready(function () {
            var $type = $("#type");

            var options_types = ['select', 'radio', 'multi_values'];
            if (_.includes(options_types, $type.val())) {
                $("#options-field").fadeIn();
            }

            $type.change(function (event) {
                if (_.includes(options_types, $(this).val())) {
                    $("#options-field").fadeIn();
                } else {
                    $("#options-field").fadeOut();
                }
            })


        });
    </script>
@endsection