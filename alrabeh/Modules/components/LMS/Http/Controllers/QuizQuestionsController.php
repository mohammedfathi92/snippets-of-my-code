<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\QuizQuestionsDataTable;
use Modules\Components\LMS\Http\Requests\QuizQuestionRequest;
use Modules\Foundation\Http\Requests\BulkRequest;

use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Illuminate\Support\Facades\DB;

class QuizQuestionsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = route(
            config('lms.models.quiz_question.resource_route'),
            ['quiz' => request()->route('quiz')]
        );
        $this->title = 'LMS::module.question.title';
        $this->title_singular = 'LMS::module.question.title_singular';

        parent::__construct();
    }

    /**
     * @param QuizQuestionRequest $request
     * @param QuizQuestionsDataTable $dataTable
     * @return mixed
     */
    public function index(QuizQuestionRequest $request,Quiz $quiz, QuizQuestionsDataTable $dataTable)
    {
        return $dataTable->render('LMS::quiz_questions.index', compact('quiz'));
    }

    /**
     * @param QuizQuestionRequest $request
     * @return $this
     */
    public function create(QuizQuestionRequest $request,Quiz $quiz)
    {
    
        $question = new Question();
        $question_title = '';
                    if(session()->has('question_current_title')){
               $question_title = session()->get('question_current_title');
            }
            

        $pivot = DB::table('lms_quiz_questions')->where('quiz_id', $quiz->id)->orderBy('order', 'desc')->first();
        if($pivot){
            $question_order = $pivot->order + 1;
        }else{
             $question_order = 1;
        }
        



        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::quiz_questions.create_edit')->with(compact('question', 'quiz', 'question_order', 'question_title'));
    }

    /**
     * @param QuizQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(QuizQuestionRequest $request, Quiz $quiz)
    {
        try {
            if(session()->has('question_current_title')){
                session()->forget('question_current_title');
            }

            session()->put('question_current_title', $request->get('title'));


            $checks = ['show_check_answer' => $request->show_check_answer?:0, 'show_question_title' => $request->show_question_title?:0,'allow_comments' => $request->allow_comments?:0];
            $request->merge($checks);

            $data = $request->except('answers','categories','quizzes', 'order');

            $question = Question::create($data);

            $question_answers = [];

            $answers = $request->get('answers', []);
                        if($request->get('question_type') != 'paragraph'){


            foreach ($answers as $answer) {
                $answer['question_id'] =  $question->id;
                $question_answer = Answer::create($answer);
                $question_answers[] = $question_answer;
            }
        }
             $question->quizzes()->sync($request->get('quizzes', []));
        $pivot = DB::table('lms_quiz_questions')->where('quiz_id', $quiz->id)->where('question_id', $question->id);
        if($pivot){
            $pivot->update(['order' => $request->get('order')]);
        }

             // $question->categories()->sync($request->get('categories', []));
     

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Question::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param QuizQuestionRequest $request
     * @param Question $question
     * @return Question
     */
    public function show(QuizQuestionRequest $request,Quiz $quiz, Question $question)
    {
        return $question;
    }

    /**
     * @param QuizQuestionRequest $request
     * @param Question $question
     * @return $this
     */
    public function edit(QuizQuestionRequest $request, Quiz $quiz, Question $question)
    {
        $pivot = DB::table('lms_quiz_questions')->where('quiz_id', $quiz->id)->where('question_id', $question->id)->first();
        if($pivot){
            $question_order = $pivot->order;
        }else{
             $question_order = 1;
        }
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $question->title])]);

        return view('LMS::quiz_questions.create_edit')->with(compact('question', 'quiz', 'question_order'));
    }

    /**
     * @param QuizQuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(QuizQuestionRequest $request, Quiz $quiz, Question $question)
    {
        try {

             $checks = ['show_check_answer' => $request->show_check_answer?:0, 'allow_comments' => $request->allow_comments?:0, 'show_question_title' => $request->show_question_title?:0,];
            $request->merge($checks);
            
            $data = $request->except('categories', 'answers','quizzes', 'order');


            $question->update($data);

            $question->answers()->delete();
            $question_answers = [];

            $answers = $request->get('answers', []);
                                    if($request->get('question_type') != 'paragraph'){

            foreach ($answers as $answer) {
                $answer['question_id'] =  $question->id;
                $question_answer = Answer::create($answer);
                $question_answers[] = $question_answer;
            }
        }

            $question->quizzes()->sync($request->get('quizzes', []));
             // $question->categories()->sync($request->get('categories', []));
                    $pivot = DB::table('lms_quiz_questions')->where('quiz_id', $quiz->id)->where('question_id', $question->id);
        if($pivot){
            $pivot->update(['order' => $request->get('order')]);
        }


            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Question::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

        /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkAction(BulkRequest $request)
    {
        try {

            $action = $request->input('action');
            $selection = json_decode($request->input('selection'), true);

            foreach ($selection as $selection_id) {
                $question = Question::findByHash($selection_id);
                switch ($action) {
                    case 'delete':
                        $question_request = new QuizQuestionRequest;
                        $question_request->setMethod('DELETE');
                        $quiz = new Quiz;
                        $this->destroy($question_request,$quiz, $question);
                        $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
                        break;
                }
            }


        } catch (\Exception $exception) {
            log_exception($exception, Question::class, 'bulkAction');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    /**
     * @param QuizQuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(QuizQuestionRequest $request, Quiz $quiz, Question $question)
    {
        try {
            $question->studentLogs()->delete();

            $question->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Question::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}