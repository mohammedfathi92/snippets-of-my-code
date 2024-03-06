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

                <th width="10%">@lang('LMS::attributes.questions.order')</th>

                <th width="80%" style="text-align: center;">@lang('LMS::attributes.questions.display')</th>
                
            </tr>
            </thead>
            <tbody>
            <tr></tr>
            @if(count($answers))
                @foreach($answers as $answer)
                    <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
                        <td>
                            <span> {{$loop->index + 1 .' '.'-'}}</span>
                            <input name="answers[{{ $loop->index }}][is_correct]" type="radio"
                                   value="1" @if($answer->is_correct) checked
                                   @endif class="input_type disable-icheck" {{-- data-input='radio' --}} value="1" />

                        </td>

                        <td>
                            <div class="form-group">
                                <textarea class="form-control ckeditor2" name="answers[{{ $loop->index }}][title]" >{!! $answer->title !!}</textarea>

                            </div>
                        </td>

{{--                         <td>
                            <button type="button" class="btn btn-danger btn-sm disable-answer-btn" style="margin:0;"
                                    data-index="{{ $loop->index }}"><i
                                        class="fa fa-minus-circle"></i>
                            </button>
                        </td> --}}
                    </tr>
                @endforeach
            @else


            @for($i=0; $i < 4; $i++)


                <tr id="tr_{{$i}}" data-index="{{$i}}">
                    <td>
                            <span> {{$i + 1 .' '.'-'}}</span>
                            <span> <button type="button" class="btn btn-danger btn-sm disable-answer-btn" style="margin:0;"
                                data-index="{{$i}}"><i
                                    class="fa fa-minus-circle"></i>
                        </button></span>   
                             <input name="answers[{{$i}}][is_correct]" type="radio"
                                class="input_type disable-icheck" {{-- data-input='radio' --}} value="1" />


                        </td>

                    <td class="text-center">

                          <div class="form-group">
                                <textarea class="form-control ckeditor2" name="answers[{{ $i }}][title]"></textarea>
                            </div>

                    </td>

{{--                     <td>
                        <button type="button" class="btn btn-danger btn-sm disable-answer-btn" style="margin:0;"
                                data-index="{{$i}}"><i
                                    class="fa fa-minus-circle"></i>
                        </button>
                    </td> --}}
                </tr>
                @endfor
                

            @endif


            </tbody>
        </table>
    </div>

{{--     <button type="button" class="btn btn-success btn-sm" id="add-value" data-input="checkbox" style="display:none"
            onclick="add_answer()"><i
                class="fa fa-plus"></i> @lang('LMS::attributes.questions.add_new_option')
    </button> --}}

    <br>
    <br>
    {!! ModulesForm::select('parent_id','LMS::attributes.questions.parent_paragraph',\LMS::getQuestionsParagraphsList(),false,null, [], 'select2') !!}

</div>

