@section('content')

    <div class="row">
        <div class="col-md-12">

        @php

        @endphp
            @component('components.box')
                {!! Form::model($quiz, ['url' => url('lms/quizzes/'.$quiz->hashed_id.'/delete-quiz'),'method'=>'POST','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    @php
                    $select = ['only_quiz' => 'حذف الاختبار فقط',
                                'with_questions' => 'حذف الاختبار مع الاسئلة'];
                    @endphp
                    <div class="col-md-12">
                        {!! ModulesForm::select('type','LMS::attributes.main.delete_way',$select,true) !!}
                        

                        {!! ModulesForm::formButtons(trans('LMS::attributes.main.delete',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
