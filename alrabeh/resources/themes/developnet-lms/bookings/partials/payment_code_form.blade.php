    {!! Form::model($invoice, ['url' => route('subscriptions.submit_pay_code', ['invoice' => $invoice]),'method'=>'post','files'=>true,'class'=>'form-horizontal']) !!}
        <div class="modal-body" dir="rtl">

        	<div class="row">
        		<div class="col-md-12"> 
        			<div class="form-group   required-field ">
        			<label for="coupon">كود الدفع    <small id="bookingCodeHelp" class="form-text text-muted">
	                           	<a href="{{url('/info-payment')}}" target="_blank">@lang('developnet-lms::labels.headings.text_get_booking_code')</a></small></label>
        				<input class="form-control " placeholder="ادخل كود الدفع هنا ... ." id="coupon" name="coupon" type="text" required=""></div>

        		</div>
        	</div>

          </div>
          <div class="modal-footer border-top-0" style="padding-right: 30px">
          	<button type="submit" class="btn btn-primary"> <i class="fa fa-paper-plane"></i> تفعيل </button>
           
            <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>
          </div>


     {!! Form::close() !!}