@extends('layouts.master')

@section('title', $title)

@section('css')
@endsection

@section('actions')
    {!! PackagesForm::link(url($resource_url.'/create'), trans('Packages::labels.create'),['class'=>'btn btn-success']) !!}
@endsection

@section('content')
    <div class="row">
        @forelse($grid_items as $item)
            <div class="col-md-4">
                @include($grid_item_view,['item'=>$item])
            </div>
        @empty
            <div class="col-md-4">
                <div class="alert alert-info">
                    <strong><i class="fa fa-info-circle"></i>@lang('Packages-admin::labels.crud.no_item_found')</strong>
                    <br/>@lang('Packages-admin::labels.crud.create_item')
                </div>
            </div>
        @endforelse
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            {!! $grid_items->links() !!}
        </div>
    </div>
@endsection

@section('js')
@endsection