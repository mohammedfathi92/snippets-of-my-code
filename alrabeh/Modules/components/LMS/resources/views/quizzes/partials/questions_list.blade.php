<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="questionsListDT" class="table table-bordered table-striped">
            <thead>

            <tr>
                <th>{{ __('LMS::attributes.main.title') }}</th>
                <th>{{ __('LMS::attributes.main.content') }}</th>

                <th>{{ __('LMS::attributes.main.options') }}</th>
            </tr>

            </thead>


            @foreach($questions as $question)
                <tr id="question_row_{{ $question->id }}">
                    <td>{{ str_limit($question->title,100) }}</td>
                    <td>{{ str_limit(strip_tags($question->content),100) }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" style="margin:0;"
                                data-index="{{$question->id }}" onclick="addToQuiz('{{$question->id }}')"><i
                                    class="fa fa-plus-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach


        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<script type="text/javascript">
    $('#questionsListDT').DataTable();
</script>

<script type="text/javascript">
    //store & update Question Form

    function addToQuiz(question) {
        $.get("/lms/ajax/questions/" + question + "/{{$quiz_session_id}}/add_to_quiz", function (result, status) {
            if ($.isEmptyObject(result.error)) {
                var title = result.data.title;
                var id = result.data.id;
                var listedQuestion = '<li id="liQ_' + id + '" class="list-group-item  sortable"><span> <i class="fa fa-arrows-alt grabbing handle"></i> ' + title + '<input  class="get-questions-list" type="hidden" value=' + id + '></span>' + ' <span class="pull-right dd-nodrag"><div class="item-actions"><div class="btn-group pull-right"> <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button><ul class="dropdown-menu" role="menu"> <li> <a href="javascript:;" class=""  onclick="editQuestionModal(' + id + ')" data-id=' + id + '><i class="fa fa-pen"></i> {{__('LMS::attributes.main.edit')}} </a></li> <li><a href="javascript:;"  data-id=' + id + ' onclick="removeItem(' + id + ')"><i class="fa fa-minus-circle"></i> {{__('LMS::attributes.main.remove')}}</a></li> </ul></div> </div></span></li>'

                $('#questions-list-group .addSortRow:last-child').before(listedQuestion);
                $('#question_row_' + id).fadeOut(300, function () {
                    $(this).remove();
                });

            } else {
                printErrorMsg(result.error);
                $("#edit_question_content").animate({scrollTop: 0}, "slow");
            }
        });

    }

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function (key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }


</script>
