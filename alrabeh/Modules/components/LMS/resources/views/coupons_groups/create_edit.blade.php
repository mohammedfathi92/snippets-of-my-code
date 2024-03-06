@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_coupon_group_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
          {!! ModulesForm::openForm($coupon_group) !!}
        <div class="col-md-8">
            @component('components.box')
              
                @php
                $couponCode = \LMS::codeGenerator(10, false, substr('Gr'.user()->id,0,4));
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="code" value="{{$coupon_group->exists?$coupon_group->code:$couponCode}}">
                        <input type="hidden" name="is_group" value="1">
                        

                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                       {{--  {!! ModulesForm::number('coupons_num','LMS::attributes.coupon.coupons_num',true,$coupon_group->exists?$coupon_group->coupons_num:100,['min' => 1,'max'=>1000]) !!} --}}
                       {!! ModulesForm::text('name','LMS::attributes.main.title',true) !!}
                        {!! ModulesForm::select('type', 'LMS::attributes.coupon.type',trans('LMS::attributes.coupon.type_option')) !!}
                        {!! ModulesForm::number('value','LMS::attributes.coupon.value',true) !!}
                        {{-- {!! ModulesForm::number('min_cart_total','LMS::attributes.coupon.min_cart_total') !!} --}}
                    </div>
                    <div class="col-md-6">
                        {!! ModulesForm::date('start','LMS::attributes.coupon.start',true,$coupon_group->start) !!}
                        {!! ModulesForm::date('expiry','LMS::attributes.coupon.expiry',true,$coupon_group->expiry) !!}
                        {!! ModulesForm::number('uses','LMS::attributes.coupon.uses',false,$coupon_group->exists?$coupon_group->uses:'', array_merge(['step'=>1,'min'=>1,'max'=>999999])) !!}
                       {{--  {!! ModulesForm::number('max_discount_value','LMS::attributes.coupon.max_discount_value') !!} --}}

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('users[]','LMS::attributes.coupon.users', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\User\Models\User::class,
                        'columns'=> json_encode(['name']),
                        'selected'=>json_encode($coupon_group->users()->pluck('users.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('plans[]','LMS::attributes.coupon.plans', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\Components\LMS\Models\Plan::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($coupon_group->plans()->pluck('lms_plans.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>

                  <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('courses[]','LMS::attributes.coupon.courses', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\Components\LMS\Models\Course::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($coupon_group->courses()->pluck('lms_courses.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>

                  <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('quizzes[]','LMS::attributes.coupon.quizzes', [], false, null,
                        ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                        'model'=>\Modules\Components\LMS\Models\Quiz::class,
                        'columns'=> json_encode(['title']),
                        'selected'=>json_encode($coupon_group->quizzes()->pluck('lms_quizzes.id')->toArray()),
                        ]],'select2') !!}
                    </div>
                </div>


               {{--  <div class="row">
                    <div class="col-md-12">
                {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                  </div>
                </div> --}}


                {!! ModulesForm::customFields($coupon_group, 'col-md-6') !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::formButtons() !!}
                    </div>
                </div>
               
            @endcomponent
        </div>


        <div class="col-md-4">

            @component('components.box',['box_class'=>'box-success'])
                <div class="row">
                    <div class="col-md-12">
                        <p>{!! trans('LMS::attributes.coupon.textarea_code_note') !!}</p>
                        <hr>

                     {!! ModulesForm::textarea('template',trans('LMS::attributes.coupon.coupon_template'),false,null,['class'=>'ckeditor']) !!}
                     <br>
                      {!! ModulesForm::radio('is_active','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),$coupon_group->exists?$coupon_group->is_active:1) !!}
                    </div>
                </div>        


               @if($coupon_group->exists)
                <div class="row">
                    <div class="col-md-12">
                       {!! ModulesForm::number('generate_coupons[number]','LMS::attributes.coupon.coupons_num',true,1,['min' => 1,'max'=>1000]) !!}

                   </div>
               </div>

                               <div class="row">
                    <div class="col-md-12">
<button class="btn btn-success ladda-button" type="submit" data-style="expand-right" value="1" name="generate_coupons[submit]"><span class="ladda-label"><i class="fa fa-refresh"></i> @lang('LMS::attributes.coupon.generate_coupons_btn') </span><span class="ladda-spinner"></span></button>
<a href="{{url('/lms/coupons_groups/'.$coupon_group->hashed_id.'/coupons-list')}}" class="btn btn-primary ladda-button" type="button" data-style="expand-right"  target='_blank'><span class="ladda-label"><i class="fa fa-eye"></i> @lang('LMS::attributes.coupon.show_coupons_list_btn') </span><span class="ladda-spinner"></span></a>
                    </div>
                </div>
 @endif

            @endcomponent

        </div>
       

         {!! ModulesForm::closeForm($coupon_group) !!}
        
    </div>


@endsection

@section('js')
@endsection
