@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('category_show') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('components.box')
                   <div id="{{'form-elements-cat'.$category->hashed_id}}">
      
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
                        {!! PackagesForm::select('type', 'ERP::attributes.main.type', \ERP::getCategoriesTypes(), true, null, [], 'select2') !!}
                       
                    </div>
                        <div class="col-md-6"> 
                        {!! PackagesForm::select('parent_id', 'ERP::attributes.category.parent_cat', \ERP::getCategoriesParents($category->id), false, null, [], 'select2') !!}
                       </div>



                </div>

             <div class="row">

                         <div class="col-md-6" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),false,null, ['class' => 'get-country-lists',
                             'data-other_div' => 'cities_list_div',
                             'data-other_type' => 'cities',
                              'data-other_list' => 'cities_list'],
                               'select2') !!}
                         </div>

                          <div class="col-md-6">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', [],false,null, ['class' => 'cities_list', 'data-label' => __('ERP::attributes.hotel.city')], 'select2') !!}
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
    @endcomponent
@endsection

@section('js')
<script type="text/javascript">
    $('#{{'form-elements-cat'.$category->hashed_id}} input, #{{'form-elements-cat'.$category->hashed_id}} textarea, #{{'form-elements-cat'.$category->hashed_id}} select').attr('disabled', '');
</script>
@endsection

