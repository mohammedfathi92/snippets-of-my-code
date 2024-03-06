
<div class="modal fade" id="finishQuizModal" tabindex="-1" role="dialog" aria-labelledby="finishQuizModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #fff">

      <div class="modal-body">

        <div class="alert alert-danger">
    @if(\Request::segment(1) == 'courses')
     <strong>تنبية !</strong> هل متأكد من رغبتك في إنهاء  الاختبار؟
</div>
    @else
  <strong>تنبية !</strong> عند قيامك بتأكيد انهاء  الاختبار فإنه لن تتمكن مرة ثانية بالتعديل على اجاباتك السابقة وإنما سيتوجب عليك اعادة  الاختبار من جديد.
</div>
@endif

      </div>
      <div class="modal-footer">
      	 <button type="button" class="btn btn-danger finish finish_exam" style="margin-left: 10px; margin-right: 10px;" data-dismiss="modal">
                @lang('developnet-lms::labels.spans.span_finish_exam')
                    </button>
        <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>

      </div>

    </div>
  </div>
</div>
