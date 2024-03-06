<?php 

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\QuizzesDataTable;
use Modules\Components\LMS\Http\Requests\QuizRequest;
use Illuminate\Support\Facades\DB;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class QuizzesController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.quiz.resource_url');
        $this->title = 'LMS::module.quiz.title';
        $this->title_singular = 'LMS::module.quiz.title_singular';

        parent::__construct();
    }

    /**
     * @param QuizRequest $request
     * @param QuizzesDataTable $dataTable
     * @return mixed
     */
    public function index(QuizRequest $request, QuizzesDataTable $dataTable)
    {
        return $dataTable->render('LMS::quizzes.index');
    }

    /**
     * @param QuizRequest $request
     * @return $this
     */
    public function create(QuizRequest $request)
    {
        $quiz = new Quiz();
        
        $quiz_session_id = \LMS::codeGenerator(5, true ,'quiz_',user()->hashed_id);
      
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::quizzes.create_edit')->with(compact('quiz', 'quiz_session_id'));
    }

    /**
     * @param QuizRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(QuizRequest $request)
    {

        try {
            $checks = ['preview' => $request->preview?:0, 'pagination_questions' => $request->pagination_questions?:0, 'review_questions' => $request->review_questions?:0, 'show_check_answer' => $request->show_check_answer?:0, 'skip_question' => $request->skip_question?:0, 'show_hint' => $request->show_hint?:0, 'allow_comments' => $request->allow_comments?:0, 'status' => $request->status?:0, 'private' => $request->private?:0,'is_featured' => $request->is_featured?:0,'is_standlone' => $request->is_standlone?:0,'show_questions_title' => $request->show_questions_title?:0];
          
          $request->merge($checks);
            $data = $request->except('arr_questions_ids', 'questions','categories', 'tags', 'thumbnail', 'quiz_session_id');

            $quiz = Quiz::create($data);

               if ($request->hasFile('thumbnail')) {
               $quiz->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($quiz->mediaCollectionName);
            }

            // $q_ids = [];
            // $orders = [];

            // $arr_questions_ids = json_decode("[".$request->arr_questions_ids."]");

            // foreach ($arr_questions_ids as $index => $id) { 
            //     $q_ids[] = $id; 
            //     $orders[] = ['order' => $index]; 
            // } 
            // $quiz->questions()->sync(array_combine($q_ids, $orders));
            
            $quiz->categories()->sync($request->input('categories', []));

            // if($qQuestions = $quiz->questions()){

            // $totalQuestionsDegree = $qQuestions->sum('points');

            // $quiz->update(['total_degree' =>  $totalQuestionsDegree]);

            // }

            

           $tags = $this->getTags($request);

            $quiz->tags()->sync($tags);
     

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Quiz::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param QuizRequest $request
     * @param Quiz $quiz
     * @return Quiz
     */
    public function show(QuizRequest $request, Quiz $quiz)
    {
        return $quiz;
    }

    /**
     * @param QuizRequest $request
     * @param Quiz $quiz
     * @return $this
     */
    public function edit(QuizRequest $request, Quiz $quiz)
    {
        $quiz_session_id = \LMS::codeGenerator(5, true ,'quiz_'.$quiz->hashed_id,user()->hashed_id);
         if(session()->has('quiz_session_'.$quiz_session_id)){
                session()->forget('quiz_session_'.$quiz_session_id);
            }
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $quiz->title])]);

        if($quiz->questions){
           $questions = $quiz->questions->pluck('id')->toArray();
        session()->put('quiz_session_'.$quiz_session_id, ['questions' => $questions]);
        }

        return view('LMS::quizzes.create_edit')->with(compact('quiz', 'quiz_session_id'));
    }

    /**
     * @param QuizRequest $request 
     * @param Quiz $quiz
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(QuizRequest $request, Quiz $quiz)
    {
        try {
         
          $checks = ['preview' => $request->preview?:0, 'pagination_questions' => $request->pagination_questions?:0, 'review_questions' => $request->review_questions?:0, 'show_check_answer' => $request->show_check_answer?:0, 'skip_question' => $request->skip_question?:0, 'show_hint' => $request->show_hint?:0, 'allow_comments' => $request->allow_comments?:0, 'status' => $request->status?:0, 'private' => $request->private?:0,'is_featured' => $request->get('is_featured')?true:false,'is_standlone' => $request->is_standlone?:0, 'show_questions_title' => $request->show_questions_title?:0];
          
          $request->merge($checks);
            $data = $request->except('arr_questions_ids','questions','categories', 'tags', 'thumbnail', 'clear', 'quiz_session_id');
            $quiz->update($data);

               
               if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $quiz->clearMediaCollection($quiz->mediaCollectionName);
            }
 
              if ($request->hasFile('thumbnail')) {
                $quiz->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($quiz->mediaCollectionName);
                   }



         

            // $q_ids = [];
            // $orders = [];

            // $arr_questions_ids = json_decode("[".$request->arr_questions_ids."]");

            // foreach ($arr_questions_ids as $index => $id) { 
            //     $q_ids[] = $id; 
            //     $orders[] = ['order' => $index]; 
            // } 
            // $quiz->questions()->sync(array_combine($q_ids, $orders));
            
            $quiz->categories()->sync($request->input('categories', []));

            
            // if($qQuestions = $quiz->questions()){

            // $totalQuestionsDegree = $qQuestions->sum('points');

            // $quiz->update(['total_degree' =>  $totalQuestionsDegree]);

            // }

             $tags = $this->getTags($request);

            $quiz->tags()->sync($tags);

        if ($request->session()->has('questions_quiz_session_' . $quiz->hashed_id)) {
            $request->session()->forget('questions_quiz_session_' . $quiz->hashed_id);
        }


            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Quiz::class, 'update');
        }



        return redirectTo($this->resource_url);
    }

    /**
     * @param QuizRequest $request
     * @param Quiz $quiz
     * @return \Illuminate\Http\JsonResponse
     */

        private function getTags($request)
    {
        $tags = [];

        $requestTags = $request->get('tags', []);

        foreach ($requestTags as $tag) {
            if (is_numeric($tag)) {
                array_push($tags, $tag);
            } else {
                try {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);

                    array_push($tags, $newTag->id);
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        return $tags;
    }

    public function destroy(QuizRequest $request, Quiz $quiz)
    {
        try {
        $quiz->studentLogs()->delete();

            $quiz->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Quiz::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

            /**
     * @param QuizRequest $request
     * @return $this
     */
    public function delete_options(QuizRequest $request, Quiz $quiz)
    {

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.delete')]);

        return view('LMS::quizzes.partials.delete')->with(compact('quiz'));
    }

                /**
     * @param QuizRequest $request
     * @return $this
     */
    public function delete_quiz(Request $request, $hashed_id)
    {
    if (!user()->hasPermissionTo('LMS::quiz.delete')) {
            return abort(403);
        }
        try {
        $this->validate($request, ['type' => 'required']);

        $id = hashids_decode($hashed_id);
         $quiz = Quiz::find($id);

        if (empty($quiz)) {
            abort(404);
        }
        if($request->get('type') == 'only_quiz'){
            $quiz->delete();
        }else{

            $quiz->questions()->delete();
            $quiz->delete();

        }

     flash(trans('Modules::messages.success.delete', ['item' => $this->title_singular]))->success();
             } catch (\Exception $exception) {
            log_exception($exception, Quiz::class, 'destroy');
        }

                return redirectTo($this->resource_url);

    }
}