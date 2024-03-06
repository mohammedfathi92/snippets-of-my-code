@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_coupon_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                {!! ModulesForm::openForm($coupon) !!}
                @php
                $randNum1 = rand (1, 9);
                $randNum2 = rand (100, 900);
                $couponCode = \LMS::codeGenerator(10, false, substr($randNum1.user()->id.$randNum2,0,4));
                @endphp
                <div class="row">
                    <div class="col-md-6">
                         <input type="hidden" name="is_group" value="0">
                        {!! ModulesForm::text('code','LMS::attributes.coupon.code',true, $coupon->exists?$coupon->code:$couponCode) !!}
                        {!! ModulesForm::select('type', 'LMS::attributes.coupon.type',trans('LMS::attributes.coupon.type_option')) !!}
                        {!! ModulesForm::number('value','LMS::attributes.coupon.value',true) !!}
                        {{-- {!! ModulesForm::number('min_cart_total','LMS::attributes.coupon.min_cart_total') !!} --}}
                    </div>
                    <div class="col-md-6">
                        {!! ModulesForm::date('start','LMS::attributes.coupon.start',true,$coupon->start) !!}
                        {!! ModulesForm::date('expiry','LMS::attributes.coupon.expiry',true,$coupon->expiry) !!}
                        {!! ModulesForm::number('uses','LMS::attributes.coupon.uses',false,$coupon->exists?$coupon->uses:'', array_merge(['step'=>1,'min'=>1,'max'=>999999])) !!}
                       {{--  {!! ModulesForm::number('max_discount_value','LMS::attributes.coupon.max_discount_value') !!} --}}

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('users[]','LMS::attributes.coupon.users', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\User\Models\User::class,
                        'columns'=> json_encode(['name']),
                        'selected'=>json_encode($coupon->users()->pluck('users.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('plans[]','LMS::attributes.coupon.plans', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\Components\LMS\Models\Plan::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($coupon->plans()->pluck('lms_plans.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>

                  <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('courses[]','LMS::attributes.coupon.courses', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\Components\LMS\Models\Course::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($coupon->courses()->pluck('lms_courses.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>

                  <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('quizzes[]','LMS::attributes.coupon.quizzes', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\Components\LMS\Models\Quiz::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($coupon->quizzes()->pluck('lms_quizzes.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>


               {{--  <div class="row">
                    <div class="col-md-12">
                {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                  </div>
                </div> --}}


                {!! ModulesForm::customFields($coupon, 'col-md-6') !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::formButtons() !!}
                    </div>
                </div>
                {!! ModulesForm::closeForm($coupon) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection
