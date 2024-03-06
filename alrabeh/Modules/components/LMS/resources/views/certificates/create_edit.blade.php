@extends('layouts.crud.create_edit')

@section('css')

@endsection
 
@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_certificate_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($certificate, ['url' => url($resource_url.'/'.$certificate->hashed_id),'method'=>$certificate->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            <div class="row">
                <div class="col-md-8">

 
                    @component('components.box', ['box_title' => __('LMS::attributes.certificates.code_heading')])
            
                      @foreach(__('LMS::attributes.certificates.codes_names') as $key => $value) 

                     <div class="col-md-4 col-md-6"> <p> {{$value}} <span class="label label-warning" style="margin: 10px;">{{'c_'.$key}} </span> </p>
                        </div>

                      @endforeach


                    @endcomponent
                    @component('components.box', ['box_title' => __('LMS::attributes.main.general_head')])
                        {!! ModulesForm::text('title','LMS::attributes.main.title',true) !!}

                        {!! ModulesForm::textarea('content',trans('LMS::attributes.main.content'),false,null,['class'=>'ckeditor']) !!}

                        {!! ModulesForm::textarea('note',trans('LMS::attributes.certificates.note'),false,null,['class'=>'ckeditor']) !!}
                    @endcomponent
                     
                </div>
                <div class="col-md-4">


               
                    @component('components.box')
                    {!! ModulesForm::text('manager_name','LMS::attributes.certificates.manager_name',false) !!}
                     {!! ModulesForm::text('manager_title','LMS::attributes.certificates.manager_title',false) !!}
                    
                        @if($certificate->hasMedia('lms-certificate-image'))
                            <img src="{{ $certificate->image }}" class="img-responsive" style="max-width: 100%;"
                                 alt="image"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear_image', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('image', 'LMS::attributes.certificates.template_image') !!}

                    @if($certificate->hasMedia('lms-certificate-site_logo'))
                            <img src="{{ $certificate->site_logo }}" class="img-responsive" style="max-width: 100%;"
                                 alt="site_logo"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear_image', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('site_logo', 'LMS::attributes.main.site_logo') !!}

                         @if($certificate->hasMedia('lms-certificate-seal'))
                            <img src="{{ $certificate->seal }}" class="img-responsive" style="max-width: 100%;"
                                 alt="seal"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear_seal', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('seal', 'LMS::attributes.certificates.seal_image') !!}
                         @if($certificate->hasMedia('lms-certificate-signature'))
                            <img src="{{ $certificate->signature }}" class="img-responsive" style="max-width: 100%;"
                                 alt="signature"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear_signature', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('signature', 'LMS::attributes.certificates.signature_image') !!}
                        {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                    @endcomponent

                    
 

                    <div class="clearfix"></div>

                </div>
            </div>
        

            <div class="row">
                @component('components.box')

                    {!! ModulesForm::customFields($certificate) !!}

                    <div class="row">
                        <div class="col-md-12">
                            {!! ModulesForm::formButtons() !!}
                        </div>
                    </div>
                @endcomponent
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection




@section('js')
@endsection