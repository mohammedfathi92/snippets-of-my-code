<div class="row">
    <div class="col-md-4">
        @php
            $question_type = [
                'true_false' => __('LMS::attributes.questions.true_false'),
                'multi_choice' => __('LMS::attributes.questions.multi_choice'),
                'single_choice' => __('LMS::attributes.questions.single_choice'),
                 'paragraph' => __('LMS::attributes.questions.paragraph'),
            ]
        @endphp
        {!! ModulesForm::select('question_type','LMS::attributes.questions.type', $question_type,true,null, ['id'=>'select_input_type', 'onchange' => 'changeInputType()']) !!}
    </div>
</div>
<div class="question-type-div" @if($question->question_type != 'paragraph') style="display: none" @endif>
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
                                   value="1" class="form-control"/>
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
                                   value="1" class="form-control"/>
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
                                   value="1" class="form-control"/>
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
                                   value="1" class="form-control"/>
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

    <button type="button" class="btn btn-success btn-sm" id="add-value" data-input="checkbox" style="display:none"
            onclick="add_answer()"><i
                class="fa fa-plus"></i> @lang('LMS::attributes.questions.add_new_option')
    </button>

    <br>
    <br>
    {!! ModulesForm::select('parent_id','LMS::attributes.questions.parent_paragraph',\LMS::getQuestionsParagraphsList(),false,null, ['class'=> 'with-select2']) !!}

</div>

