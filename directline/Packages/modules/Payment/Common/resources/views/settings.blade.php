@extends('layouts.master')

@section('title', $title_singular)

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('payment_settings') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        @if(count($settings))
            <div class="col-md-10">
                @component('components.box',['box_class'=>'box-success'])
                    <ul class="nav nav-tabs">
                        @foreach($settings as $gateway_key => $gateway)
                            <li class="{{ $loop->first ? 'active':'' }}">
                                <a data-toggle="tab" href="#{{ $gateway_key }}">{{  $gateway['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($settings as $gateway_key => $gateway)
                            <div id="{{ $gateway_key }}"
                                 class="tab-pane fade {{ $loop->first ? 'in active':'' }} p-t-20">
                                {{ Form::open(['class'=>'ajax-form']) }}
                                @foreach($gateway['settings'] as $key => $setting)
                                    @if($setting['type'] == 'text')
                                        {!! PackagesForm::text($gateway_key.'_'.$key,$setting['label'],$setting['required'],\Settings::get($gateway_key.'_'.$key,'')) !!}
                                    @elseif($setting['type'] == 'boolean')
                                        {!! PackagesForm::boolean($gateway_key.'_'.$key,$setting['label'],false,\Settings::get($gateway_key.'_'.$key,'true')) !!}
                                    @elseif($setting['type'] == 'textarea')
                                        {!! PackagesForm::textarea($gateway_key.'_'.$key,$setting['label'],false,\Settings::get($gateway_key.'_'.$key,'true')) !!}
                                    @endif
                                @endforeach
                                {!! PackagesForm::formButtons(trans('Payment::labels.setting.save',['name' => $gateway['name']]),[],['href'=>url('dashboard')]) !!}

                                {{ Form::close() }}
                            </div>
                        @endforeach
                    </div>
                @endcomponent
            </div>
        @else
            <div class="col-md-4">
                <div class="alert alert-warning">
                    <h4>@lang('Payment::labels.setting.no_active_payment_gateway')</h4>
                </div>
            </div>
        @endif
    </div>
@endsection