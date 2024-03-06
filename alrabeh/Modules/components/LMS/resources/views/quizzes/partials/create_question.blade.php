<style type="text/css">

    div.layoutContent {

        width: 100%;
        height: 550px;
        padding: 10px;
        overflow-x: hidden;
    }
</style>

<div class="row layoutContent" id="create_question_content">
    <div class="col-md-12">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>

        {!! Form::model($question, ['url' => route('ajax.questions.store'),'method'=>'POST','files'=>true,'class'=>'ajax-crud-questions', 'id' => $question->exists?'edit_ques':'create_ques']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="box ">
                    <div class="box-header with-border ">
                        <h3 class="box-title ">{{ __('LMS::attributes.questions.general_head') }}</h3>

                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <div class="box-body" style="position: static; zoom: 1;">
                        <input type="hidden" name="quiz_session_id" value="{{$quiz_session_id}}">
                        {{-- {!! ModulesForm::text('title','LMS::attributes.main.title',true,__('LMS::attributes.questions.question_title_code', ['code'=> LMS::codeGenerator('q', 7)])) !!} --}}
                        {!! ModulesForm::text('title','LMS::attributes.main.title',true,$question->exists?$question->title:$question_title) !!}

                        {!! ModulesForm::textarea('content',trans('LMS::attributes.main.content'),true,null,
                        ['class'=>'ckeditor2']) !!}

                    </div>
                </div>
                <div class="box ">
                    <div class="box-header with-border ">
                        <h3 class="box-title ">{{  __('LMS::attributes.main.answers_head') }}</h3>

                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <div class="box-body" style="position: static; zoom: 1;">

                        @include('LMS::quizzes.partials.answers_v2', ['answers'=>$question->answers??[]])
                    </div>
                </div>

                <div class="box ">
                    <div class="box-header with-border ">
                        <h3 class="box-title ">{{ __('LMS::attributes.questions.settings_head') }}</h3>

                        <div class="box-tools pull-right">

                        </div>
                    </div>

                    <div class="box-body" style="position: static; zoom: 1;">
                        {!! ModulesForm::checkbox('show_question_title','LMS::attributes.questions.show_question_title',$question->show_question_title?:false) !!}
                        {!! ModulesForm::text('preview_video','LMS::attributes.main.preview_video',false) !!}
                        <small> {{__('LMS::attributes.main.preview_video_hint')}} </small>
                        {{--  {!! ModulesForm::number('points','LMS::attributes.questions.points',true,$question->points?$question->points:1) !!} --}}
                        {!! ModulesForm::textarea('question_explanation','LMS::attributes.questions.explanation',false,null,['rows' => '4', 'class'=>'ckeditor2']) !!}
                        {{-- {!! ModulesForm::textarea('question_hint','LMS::attributes.questions.hint',false,null,['rows' => '4']) !!} --}}
                    </div>
                </div>

                <input type="hidden" name="status" value="1">

            </div>


        </div>


        <div class="row">


            {!! ModulesForm::customFields($question) !!}

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success ladda-button" type="submit"><span class="ladda-label"><i
                                    class="fa fa-save"></i>
                                @lang('LMS::attributes.quizzes.create_question')
                            </span><span class="ladda-spinner"></span></button>
                </div>
            </div>

        </div>
        {!! Form::close() !!}


    </div>
</div>

<script type="text/javascript">
    $('.with-select2').select2();

</script>


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

    function add_answer() {

        if ($("#values-table").length > 0) {

            var index = $('#values-table tr:last').data('index');
            var inputType = $("#add-value").attr('data-input');
            if (isNaN(index)) {
                index = 0;
            } else {
                index++;
            }
            $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td><div class="form-group">' +
                '<input name="answers[' + index + '][title]" type="text"' +
                'value="" class="form-control"/></div></td><td>' +
                '<center>' +
                '<input name="answers[' + index + '][is_correct]" class="input_type" type=' + inputType +
                '  />' +
                '</center></td>' +
                '<td><div class="form-group"><button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="' + index + '">'
                + '<i class="fa fa-minus-circle"></i></button></div></td>' +
                '</tr>');
            radio_init();

        }
    };

    $(document).on('click', '.remove-value', function () {
        var index = $(this).data('index');
        $("#tr_" + index).remove();
    });

    window.initFunctions.push('radio_init', 'changeInputType');


    // autocomplete question title
    $(function () {
        var cache = {}, ft = true;
        $("#create-question-title").select2({
            tags: true,
            ajax: {
                url: '{{route("ajax.questions.title-search")}}',
                data: function (params) {
                    var el = $(this);
                    if (el.val() && ft) {
                        $(".select2-search__field").val(el.val());
                        ft = false;
                    }
                    var query = {
                        q: params.term || $(this).val()
                    };

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (resp) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: _.uniqBy($.map(resp.data, function (obj) {
                            obj.id = obj.text || obj.title; // replace name with the property used for the text
                            obj.text = obj.text || obj.title; // replace name with the property used for the text
                            return obj;
                        }), "text")
                    };
                }
            }
        }).on("select2:closing", function () {
            // set first time selection to true
            ft = true;
        });
    });
</script>
