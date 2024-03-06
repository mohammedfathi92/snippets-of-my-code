
@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('category_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($category, ['url' => url($resource_url.'/'.$category->hashed_id),'method'=>$category->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
        <div class="row form-group">
             <div class="col-md-10 col-md-offset-1">

                
                {{-- translation row --}}
                    <div class="row"> 
                     @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $code => $name) 
                                  <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_{{ $code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                     @foreach (\Language::allowed() as $code => $name) 
                     
                    <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_{{ $code }}">
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $category->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $category->getTranslation('description', $code)) !!}
                        {!! PackagesForm::text('notes['.$code.']','ERP::attributes.main.note',false, $category->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                <div class="row">
                    {{-- <div class="col-md-6">
                        {!! PackagesForm::text('slug','ERP::attributes.category.slug',true) !!}                       
                    </div> --}}
                    <div class="col-md-6">
                        {!! PackagesForm::select('type', 'ERP::attributes.main.type', \ERP::getCategoriesTypes(), true, null, ['id' => 'cat_type_value'], 'select2') !!}
                       
                    </div>
                        <div class="col-md-6"> 
                        {!! PackagesForm::select('parent_id', 'ERP::attributes.category.parent_cat', \ERP::getCategoriesParents($category->id), false, null, [], 'select2') !!}
                       </div>



                </div>

                <div class="row rooms-num-row" style="display: none;">
                     <div class="col-md-6">
                    {!! PackagesForm::number('rooms_num','ERP::attributes.categories.rooms_num',false,$category->exists?$category->rooms_num:1, ['class' => 'rooms-num', 'id' => 'rooms-num-input', 'min' => '1', 'disabled' => '']) !!}
                </div>
                </div>

             <div class="row">

                        <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),false,null, ['class' => 'get_geo_lists', 'data-other_select_id' => 'row_city_id', 'data-item_type' => 'countries', 'data-list_type' => 'cities'],
                               'select2') !!}
                        </div>

                        <div class="col-md-4">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', \ERP::getCitiesListByCountry($category->country_id),false,null, ['id' => 'row_city_id'], 'select2') !!}
                            </div>
                        </div>
             </div> 

                <div class="row">

                
                       <div class="col-md-6">
                         {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'),  $category->exists?$category->status:1) !!}
                     
                       </div>
{{--              <div class="col-md-6"> 
                     
                        @if($category->hasMedia($category->mediaCollectionName))
                            <img src="{{ $category->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! PackagesForm::checkbox('clear', 'ERP::attributes.category.clear') !!}
                        @endif
                     
                        
                        {!! PackagesForm::file('thumbnail', 'ERP::attributes.category.thumbnail') !!}
                    </div> --}}
                       </div> 

       
                    </div>
                </div>


                </div>
            </div>

                {!! PackagesForm::customFields($category, 'col-md-6') !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>

            </div>

                {!! Form::close($category) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@include('ERP::partials.scripts.general_scripts')

<script type="text/javascript">
  $(window).on("load", function () {

    var select = $('#cat_type_value');

     if (select.val() == 'rooms') {
           $('.rooms-num-row').show();
           $(".rooms-num").prop('disabled', false);
           $(".rooms-num").val(1);

        }

    });
  $('body').on('change', '#cat_type_value', function(){
         if (this.value == 'rooms') {
          $('.rooms-num-row').show();
           $(".rooms-num").prop('disabled', false);
            $(".rooms-num").val(1);
        }else{

            $('.rooms-num-row').hide();
           $(".rooms-num").prop('disabled', true);
            $(".rooms-num").val(1);

        }
});

</script>

@endsection