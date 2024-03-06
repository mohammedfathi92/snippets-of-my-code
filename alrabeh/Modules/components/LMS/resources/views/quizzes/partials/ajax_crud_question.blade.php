<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('submit', '.ajax-crud-questions', function (event) {
    event.preventDefault();

    $('.has-error .help-block').html('');

    $('.form-group').removeClass('has-error');

    $('.nav.nav-tabs li a').removeClass('c-red');

    $form = $(this);

    ajax_crud_question($form);

});

   
    });

  function ajax_crud_question($form, $crud_type) {
    var page_action = $form.data('page_action');
    var $crud_type = $form.attr('id');
    var actionData = $form.data('action_data');
    var table = $form.data('table');


    var formData = new FormData($form.get(0));


    var button = $('button[name]:focus', $form);

    if (button.length) {
        formData.append(button.attr('name'), button.attr('value'));
    }

    var url = $form.attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response, textStatus, jqXHR) {
            handleAjaxSubmitSuccess(response, textStatus, jqXHR, page_action, actionData, table, $form);
            var title = response.data.content;
            var id = response.data.id;
            var updated_row =  '<span> <i class="fa fa-arrows-alt grabbing handle"></i>' +  title.replace(/(<([^>]+)>)/ig,"").substr(0, 100) +  '..<input  class="get-questions-list" type="hidden" value='+id+'></span>'+' <span class="pull-right dd-nodrag"><div class="item-actions"><div class="btn-group pull-right"> <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button><ul class="dropdown-menu" role="menu"> <li> <a href="javascript:;" class=""  onclick="editQuestionModal('+id+')" data-id='+id+'><i class="fa fa-pen"></i> {{__('LMS::attributes.main.edit')}} </a></li> <li><a href="javascript:;"  data-id='+id+' onclick="removeItem('+id+')"><i class="fa fa-minus-circle"></i> {{__('LMS::attributes.main.remove')}}</a></li> </ul></div> </div></span>';

             var createdQuestion =  '<li id="liQ_' + id + '" class="list-group-item  sortable"><span> <i class="fa fa-arrows-alt grabbing handle"></i> ' + title.replace(/(<([^>]+)>)/ig,"").substr(0, 100) +  '.. <input  class="get-questions-list" type="hidden" value='+id+'></span>'+' <span class="pull-right dd-nodrag"><div class="item-actions"><div class="btn-group pull-right"> <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button><ul class="dropdown-menu" role="menu"> <li> <a href="javascript:;" class=""  onclick="editQuestionModal('+id+')" data-id='+id+'><i class="fa fa-pen"></i> {{__('LMS::attributes.main.edit')}} </a></li> <li><a href="javascript:;"  data-id='+id+' onclick="removeItem('+id+')"><i class="fa fa-minus-circle"></i> {{__('LMS::attributes.main.remove')}}</a></li> </ul></div> </div></span></li>';

            if($crud_type === 'edit_ques'){

                $('#liQ_' + id).html(updated_row);

            }else{

             $('#questions-list-group .addSortRow:last-child').before(createdQuestion);

            }
         $("#crudQuestionModal").modal('hide'); 

      
      $("#crudQuestionModal").modal('hide'); 
        },
        error: function (response, textStatus, jqXHR) {
            handleAjaxSubmitError(response, textStatus, jqXHR, $form)
        }
    });
}


</script>