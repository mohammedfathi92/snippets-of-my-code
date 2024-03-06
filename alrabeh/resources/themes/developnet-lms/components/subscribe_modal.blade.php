
 <!-- Modal -->
 @php
 $authCheck = \Auth::check();
 @endphp

<div class="modal fade" id="{{$modal_id}}" tabindex="-1" role="dialog" aria-labelledby="showSubBtnsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    {!! Form::model($module_data, ['url' => route('subscriptions.subscribe', ['module_id' => $module_data->hashed_id, 'module'=> $module]),'method'=>'POST','files'=>true]) !!}
    <div class="modal-content" style="background: #fff">

        <div class="modal-body" dir="rtl">

        	@if(!$authCheck)
        	  <div class="alert alert-danger">
        	  	<strong>عفواً ..</strong> لإستكمال طلبك يجب عليك تسجيل الدخول اولاً.
        	  </div>
             <center> 
             <button  type="submit" class="btn btn-primary" value="login" name="auth_type"> لديك حساب بالفعل؟   </button>
            <button  type="submit"  class="btn btn-success" value="register" name="auth_type">إنشاء حساب جديد </button>

          </center>
        	@elseif(($planned['success'] && $planned['status'] > 0) || ($finalPrice <= 0))

           <div class="alert alert-warning">
              <strong>تنبيه ..</strong> انت على وشك الاشتراك في  <strong style="color: #007bff;">{{$module_data->title}}</strong> هل ترغب في استكمال طلبك .
            </div>
            @else

             <div class="alert alert-warning">
        	  	<strong>تنبيه ..</strong> لمعرفة معلومات اكثر عن كود الدفع وطريقة الاشتراك . <strong><a href="/info-payment" target="_blank">اضغط هنــا</a></strong>
        	  </div>
            <div class="form-group {{ $errors->has('coupon') ? 'has-error' :'' }}">
                      

              <input type="text" class="form-control" id="pay-coupon-5521772" value="{{old('coupon')}}" required="" name="coupon" placeholder="ادخل كود الدفع هنا  .... ." >
               @if ($errors->has('coupon'))
                  <span class="help-block" style="color: red;">
                  <strong>{{ $errors->first('coupon') }}</strong>
                  </span>
                 @endif
            </div>
            @endif





        </div>
          <div class="modal-footer border-top-0" style="padding-right: 30px">
            @if($authCheck)

            <button type="submit" class="btn btn-danger" {{-- data-dismiss="modal" --}}><i class="fa fa-paper-plane"></i> تأكيد </button>
            @endif
           
            <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>
          </div>


   
    </div>

    {!! Form::close() !!}
  </div>
</div>





