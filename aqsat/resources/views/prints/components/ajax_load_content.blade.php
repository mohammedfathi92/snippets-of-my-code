{!! Form::open(['route'=> ['prints.print','module'=>$module, 'module_id'=>$module_id],'method'=>'post','id'=>'print_'.$module.$module_id]) !!}
      <!-- Modal content-->
      
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">قم بتعديل النموذج قبل الضغط على امر طباعة</h4>
        </div>
        <div class="modal-body">

          <textarea id="editor_{{ $module_id }}" class="print_modal_content ckeditor" name="content" rows="10" cols="80">
                          {!! Prints::getSanad($module, $module_id) !!}
                    </textarea>
                    @php
                    $modulePrintedCount = \App\PrintAction::where('module', $module)->where('module_id', $module_id)->count();

                    @endphp
          
               
        </div>
        <div class="modal-footer">
          
        <button type="submit" class="btn bg-navy margin"><i class="fa fa-print"></i> طباعة </button>
          <button type="button" class="btn btn-default" data-dismiss="modal"> الغاء </button>
        </div>
    

      {!! Form::close() !!}  

    <script type="text/javascript">
            $(function () {
    CKEDITOR.replace('editor_{{ $module_id }}')
    $('.textarea').wysihtml5()
  })
        </script>          