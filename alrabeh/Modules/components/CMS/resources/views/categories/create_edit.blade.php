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
        <div class="col-md-6">
            @component('components.box')
                {!! ModulesForm::openForm($category) !!}

                {!! ModulesForm::text('name','CMS::attributes.category.name',true) !!}
                {!! ModulesForm::text('slug','CMS::attributes.category.slug',true) !!}
                {!! ModulesForm::radio('status','Modules::attributes.status',true, trans('Modules::attributes.status_options')) !!}

                @if (\Modules::isModuleActive('corals-subscriptions'))
                    {!! ModulesForm::select('subscription_plans[]','CMS::attributes.category.access_plans', [], false, null,
                    ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                    'model'=>\Modules\Components\Subscriptions\Models\Plan::class,
                    'columns'=> json_encode(['name']),
                    'selected'=>json_encode($category->subscribable_plans(['getData'=>true])->pluck('id')->toArray()),
                    'where'=>json_encode([['field'=>'status','operation'=>'=','value'=>'active']]),
                    ]],'select2') !!}
                @endif

                {!! ModulesForm::customFields($category, 'col-md-12') !!}
                {!! ModulesForm::formButtons() !!}

                {!! ModulesForm::closeForm($category) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection
