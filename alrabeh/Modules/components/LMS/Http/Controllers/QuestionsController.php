<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\QuestionsDataTable;
use Modules\Foundation\Http\Requests\BulkRequest;
use Modules\Components\LMS\Http\Requests\QuestionRequest;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;

class QuestionsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.question.resource_url');
        $this->title = 'LMS::module.question.title';
        $this->title_singular = 'LMS::module.question.title_singular';

        parent::__construct();
    }

    /**
     * @param QuestionRequest $request
     * @param QuestionsDataTable $dataTable
     * @return mixed
     */
    public function index(QuestionRequest $request, QuestionsDataTable $dataTable)
    {
        return $dataTable->render('LMS::questions.index');
    }

    /**
     * @param QuestionRequest $request
     * @return $this
     */
    public function create(QuestionRequest $request)
    {
    
        $question = new Question();

                $question_title = '';
                    if(session()->has('question_current_title')){
               $question_title = session()->get('question_current_title');
            }


        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::questions.create_edit')->with(compact('question', 'question_title'));
    }

    /**
     * @param QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(QuestionRequest $request)
    {
        try {
            
         if(session()->has('question_current_title')){
                session()->forget('question_current_title');
            }

            session()->put('question_current_title', $request->get('title'));


            $checks = ['show_check_answer' => $request->show_check_answer?:0, 'show_question_title' => $request->show_question_title?:0,'allow_comments' => $request->allow_comments?:0];
            $request->merge($checks);

            $data = $request->except('answers','categories','quizzes');

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
             // $question->categories()->sync($request->get('categories', []));
     

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Question::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return Question
     */
    public function show(QuestionRequest $request, Question $question)
    {
        return $question;
    }

    /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return $this
     */
    public function edit(QuestionRequest $request, Question $question)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $question->title])]);

        return view('LMS::questions.create_edit')->with(compact('question'));
    }

    /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(QuestionRequest $request, Question $question)
    {
        try {

             $checks = ['show_check_answer' => $request->show_check_answer?:0, 'allow_comments' => $request->allow_comments?:0, 'show_question_title' => $request->show_question_title?:0,];
            $request->merge($checks);
            
            $data = $request->except('categories', 'answers','quizzes');


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
    public function destroy(QuestionRequest $request, Question $question)
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
                        $question_request = new QuestionRequest;
                        $question_request->setMethod('DELETE');
                        $this->destroy($question_request, $question);
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
}