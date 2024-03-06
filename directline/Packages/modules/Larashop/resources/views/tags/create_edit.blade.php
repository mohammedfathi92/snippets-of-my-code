@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_tag_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('components.box')
                {!! Form::model($tag, ['url' => url($resource_url.'/'.$tag->hashed_id),'method'=>$tag->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
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
                        {!! PackagesForm::text('name['.$code.']','Larashop::attributes.tag.name',true, $tag->getTranslation('name', $code)) !!}
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
                {{-- {!! PackagesForm::text('name','Larashop::attributes.tag.name',true) !!} --}}
                {!! PackagesForm::text('slug','Larashop::attributes.tag.slug',true) !!}
                {!! PackagesForm::radio('status','Packages::attributes.status', true, trans('Packages::attributes.status_options')) !!}
                {!! PackagesForm::customFields($tag, 'col-md-12') !!}
                {!! PackagesForm::formButtons() !!}

                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection