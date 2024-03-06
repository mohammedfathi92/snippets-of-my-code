<style type="text/css">
    .display-flex {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px
    }

    .display-flex div:first-child {
        margin: 0 2px;
    }

</style>
<div class="row">
    <div class="col-md-4">
        @php
            $question_type = [
                'true_false' => __('LMS::attributes.questions.true_false'),
                'multi_choice' => __('LMS::attributes.questions.multi_choice'),
                'single_choice' => __('LMS::attributes.questions.single_choice'),
                'single_choice' => __('LMS::attributes.questions.single_choice'),
                'paragraph' => __('LMS::attributes.questions.paragraph'),
            ]


        @endphp
        {!! ModulesForm::select('question_type','LMS::attributes.questions.type', $question_type,true,null, ['id'=>'select_input_type', 'onchange' => 'changeInputType()']) !!}
    </div>


    {{--  <div class="col-md-4">
         @php
         $difficulty = [
             'easy' => __('LMS::attributes.questions.easy'),
             'normal' => __('LMS::attributes.questions.normal'),
             'deficult' => __('LMS::attributes.questions.deficult'),
         ]


         @endphp
         {!! ModulesForm::select('difficulty','LMS::attributes.questions.difficulty', $difficulty,false,$question->exists?$question->difficulty:'normal') !!}
     </div> --}}
</div>
<div class="row question-type-div" @if($question->question_type != 'paragraph') style="display: none" @endif>
    <div class="col-md-12">

        <div class="table-responsive">
            <table id="values-table" width="100%" class="table table-striped">
                <thead>
                <tr>
                    <th width="80%">@lang('LMS::attributes.questions.order')</th>
                    <th width="20%" style="text-align: center;">@lang('LMS::attributes.questions.display')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr></tr>
                @if(count($answers))

                    @foreach($answers as $answer)
                        <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
                            <td>
                                <div class="form-group">
                                    <input name="answers[{{ $loop->index }}][title]" type="text"
                                           value="{{ $answer->title }}" class="form-control"/>
                                </div>
                            </td>
                            <td class="text-center">

                                <input name="answers[{{ $loop->index }}][is_correct]" type="radio"
                                       value="1" @if($answer->is_correct) checked
                                       @endif class="input_type disable-icheck" data-input='radio'/>

                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                        data-index="{{ $loop->index }}"><i
                                            class="fa fa-minus-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr id="tr_1" data-index="1">
                        <td>
                            <div class="form-group">
                                <input name="answers[1][title]" type="text"
                                       value="{{ __('LMS::attributes.questions.true_answer') }}" class="form-control"/>
                            </div>
                        </td>
                        <td class="text-center">

                            <input name="answers[1][is_correct]" type="radio"
                                   value="1" checked='' class="input_type disable-icheck" data-input='radio'/>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                    data-index="1"><i
                                        class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr id="tr_2" data-index="2">
                        <td>
                            <div class="form-group">
                                <input name="answers[2][title]" type="text"
                                       value="{{ __('LMS::attributes.questions.false_answer') }}" class="form-control"/>
                            </div>
                        </td>
                        <td class="text-center">

                            <input name="answers[2][is_correct]" type="radio"
                                   value="1" class="input_type disable-icheck" data-input='radio'/>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                    data-index="2"><i
                                        class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr id="tr_3" data-index="3">
                        <td>
                            <div class="form-group">
                                <input name="answers[3][title]" type="text"
                                       value="{{ __('LMS::attributes.questions.false_answer') }}" class="form-control"/>
                            </div>
                        </td>
                        <td class="text-center">

                            <input name="answers[3][is_correct]" type="radio"
                                   value="1" class="input_type disable-icheck" data-input='radio'/>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                    data-index="3"><i
                                        class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr id="tr_4" data-index="4">
                        <td>
                            <div class="form-group">
                                <input name="answers[4][title]" type="text"
                                       value="{{ __('LMS::attributes.questions.false_answer') }}" class="form-control"/>
                            </div>
                        </td>
                        <td class="text-center">

                            <input name="answers[4][is_correct]" type="radio"
                                   value="1" class="input_type disable-icheck" data-input='radio'/>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                    data-index="4"><i
                                        class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <button type="button" class="btn btn-success btn-sm" id="add-value" data-input="checkbox" style="display:none">
            <i
                    class="fa fa-plus"></i> @lang('LMS::attributes.questions.add_new_option')
        </button>
        <br>
        <br>
        {!! ModulesForm::select('parent_id','LMS::attributes.questions.parent_paragraph',\LMS::getQuestionsParagraphsList(),false) !!}

    </div>


</div>
<hr>

{{--                     <div class=" display-flex">
                            <div>
                                {!! ModulesForm::number('duration','LMS::attributes.questions.question_duration',false,$question->exists?$question->duration: 0.00,['min'=>0])!!}
                            </div>
                            <div>
                                    @php
                                    $duration_unit = [
                                        'minute' => __('LMS::attributes.main.minute'),
                                        'hour' => __('LMS::attributes.main.hour'),
                                        'day' => __('LMS::attributes.main.day'),
                                        'week' => __('LMS::attributes.main.week'),
                                    ]


                                    @endphp
                                {!! ModulesForm::select('duration_unit',' ', $duration_unit,false, $question->exists?$question->duration_unit: 'minute') !!}
                            </div>
                        </div>

                        <br>
                        {!! ModulesForm::checkbox('show_check_answer','LMS::attributes.quizzes.show_check_answer',$question->show_check_answer >= 1?true:false ) !!}
                        {!! ModulesForm::checkbox('allow_comments','LMS::attributes.main.allow_comments',$question->allow_comments >= 1?true:false ) !!}
                        <br> --}}




@section('js')
    <script type="text/javascript">

        function changeInputType() {

            var selectedType = $('#select_input_type').val();
            if (selectedType == 'true_false' || selectedType == 'single_choice') {
                var type = 'radio';
                $('.question-type-div').show();
                $('#add-value').show();
            } else if (selectedType == 'multi_choice') {
                var type = 'checkbox';
                $('.question-type-div').show();
                $('#add-value').show();
            } else {
                $('.question-type-div').hide();
                $('#add-value').hide();
            }

            $("#add-value").attr('data-input', type);
            $(".input_type").attr('type', type);

        }

        radio_init = function () {
            //radio checked
            $('#values-table input[type=radio]').change(function () {
                $('#values-table input[type=radio]:checked').not(this).prop('checked', false);
            });
            //end rdio checked
        }
        answers_init = function () {

            if ($("#values-table").length > 0) {
                $(document).on('click', '#add-value', function () {

                    var index = $('#values-table tr:last').data('index');
                    var inputType = $("#add-value").attr('data-input');
                    if (isNaN(index)) {
                        index = 0;
                    } else {
                        index++;
                    }
                    $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td><div class="form-group">' +
                        '<input name="answers[' + index + '][title]" type="text"' +
                        'value="" class="form-control"/></div></td><td class="text-center">' +
                        '<input name="answers[' + index + '][is_correct]" class="input_type" type=' + inputType +
                        ' value="1" /></td>' +
                        '<td><div class="form-group"><button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="' + index + '">'
                        + '<i class="fa fa-minus-circle"></i></button></div></td>' +
                        '</tr>');
                    radio_init();
                });

                $(document).on('click', '.remove-value', function () {
                    var index = $(this).data('index');
                    $("#tr_" + index).remove();
                });
            }
        };

        window.initFunctions.push('answers_init', 'radio_init', 'changeInputType');
    </script>
@endsection
