@extends('layouts.master')

@section('css')
@endsection

@section('title', $title_singular)

@section('actions')
    @isset($edit_url)
        {!! ModulesForm::link(url($edit_url), trans('Modules::labels.edit'), ['class'=>'btn btn-primary']) !!}
    @endisset
@endsection

@section('js')
@endsection
