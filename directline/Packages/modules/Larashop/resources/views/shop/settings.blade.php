@extends('layouts.master')

@section('title', $title_singular)

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_settings') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        @if(count($settings))
            <div class="col-md-10">
                @component('components.box',['box_class'=>'box-success'])
                    <ul class="nav nav-tabs">
                        @foreach($settings as $setting_key => $setting)
                            <li class="{{ $loop->first ? 'active':'' }}">
                                <a data-toggle="tab" href="#{{ $setting_key }}">{{  $setting_key }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">

                        @foreach($settings as $setting_key => $setting_items)
                            <div id="{{ $setting_key }}"
                                 class="tab-pane fade {{ $loop->first ? 'in active':'' }} p-t-20">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::open(['class'=>'ajax-form']) }}
                                        @foreach($setting_items as $key => $setting)
                                            @php $setting_field = 'ecommerce_'.strtolower($setting_key).'_'.$key @endphp

                                            @if($setting['type'] == 'text')
                                                {!! PackagesForm::text($setting_field,$setting['label'],$setting['required'],\Settings::get($setting_field)) !!}
                                            @elseif($setting['type'] == 'number')
                                                {!! PackagesForm::number($setting_field,$setting['label'],$setting['required'],\Settings::get($setting_field),['step'=>array_get($setting, 'step', 1)]) !!}
                                            @elseif($setting['type'] == 'boolean')
                                                {!! PackagesForm::boolean($setting_field,$setting['label'],false, \Settings::get($setting_field, 'false')) !!}
                                            @elseif($setting['type']=='select')
                                                {!! PackagesForm::select($setting_field,$setting['label'],$setting['options'], $setting['required'], \Settings::get($setting_field)) !!}
                                            @endif
                                        @endforeach
                                        {!! PackagesForm::formButtons('<i class="fa fa-save"></i> Save '.$setting_key.' Settings',[],['href'=>url('dashboard')]) !!}

                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endcomponent
            </div>
        @else
            <div class="col-md-4">
                <div class="alert alert-warning">
                    <h4>@lang('Larashop::labels.shop.no_setting_found')</h4>
                </div>
            </div>
        @endif
    </div>
@endsection