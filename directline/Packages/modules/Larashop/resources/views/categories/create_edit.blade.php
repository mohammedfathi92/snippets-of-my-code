@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_category_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                {!! Form::model($category, ['url' => url($resource_url.'/'.$category->hashed_id),'method'=>$category->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-12">
                        {!! PackagesForm::text('name['.$code.']','Larashop::attributes.category.name',true, $category->getTranslation('name', $code)) !!}
                    </div>

                </div>

                 <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::textarea('description['.$code.']','Larashop::attributes.category.description', false, $category->getTranslation('description', $code)) !!}
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
                       {{--  {!! PackagesForm::text('name','Larashop::attributes.category.name',true) !!} --}}
                        {!! PackagesForm::text('slug','Larashop::attributes.category.slug',true) !!}
                        {!! PackagesForm::text('external_id','Larashop::attributes.category.external_id',true) !!}
                       {{--  {!! PackagesForm::textarea('description','Larashop::attributes.category.description', false) !!} --}}
                    </div>
                    <div class="col-md-6">
                        {!! PackagesForm::radio('status','Packages::attributes.status',true, trans('Packages::attributes.status_options')) !!}
                        {!! PackagesForm::select('parent_id', 'Larashop::attributes.category.parent_cat', \Larashop::getCategoriesList(true, false, null, $category->exists?[$category->id]:[]), false, null, [], 'select2') !!}
                        {!! PackagesForm::checkbox('is_featured', 'Larashop::attributes.category.is_featured', $category->is_featured) !!}
                        @if($category->hasMedia($category->mediaCollectionName))
                            <img src="{{ $category->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! PackagesForm::checkbox('clear', 'Larashop::attributes.category.clear') !!}
                        @endif
                        {!! PackagesForm::file('thumbnail', 'Larashop::attributes.category.thumbnail') !!}
                    </div>
                </div>

                {!! PackagesForm::customFields($category, 'col-md-6') !!}

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