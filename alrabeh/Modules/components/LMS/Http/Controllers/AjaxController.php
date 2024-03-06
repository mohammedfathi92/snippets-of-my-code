<?php

namespace Modules\Components\LMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Components\LMS\Http\Requests\AjaxQuestionRequest;
use Modules\Components\LMS\Models\Answer;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Lesson;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Section;
use Validator;


class AjaxController extends Controller
{

    public function create_question($quiz_session_id)
    {
        $question = New Question;
                $question_title = '';
                    if(session()->has('question_current_title')){
               $question_title = session()->get('question_current_title');
            }


        return view('LMS::quizzes.partials.create_question')->with(compact('question', 'quiz_session_id', 'question_title'));
    }


    public function store_question(AjaxQuestionRequest $request)
    {


        //  $rules = [];

        //  $rules = array_merge($rules, [
        //   'title' => 'required',
        //   'content' => 'required',
        //   'status' => 'required',
        //   'question_type' => 'required',
        // ]);

          if(session()->has('question_current_title')){
                session()->forget('question_current_title');
            }

            session()->put('question_current_title', $request->get('title'));

        $checks = ['show_check_answer' => $request->show_check_answer ?: 0, 'allow_comments' => $request->allow_comments ?: 0, 'show_question_title' => $request->show_question_title ?: 0,];
        $request->merge($checks);

        $quiz_session_id = $request->quiz_session_id;

        //  foreach ($request->get('answers', []) as $id => $item) {
        //   $rules = array_merge($rules, [
        //     "answers.{$id}.title" => 'required',
        //   ]);
        // }

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->passes()) {
        $data = $request->except('answers', 'categories', 'quiz_session_id');

        $question = Question::create($data);

        $question_answers = [];

        $answers = $request->get('answers', []);
            if($request->get('question_type') != 'paragraph'){

        foreach ($answers as $answer) {
            $answer['question_id'] = $question->id;
            $question_answer = Answer::create($answer);
            $question_answers[] = $question_answer;
        }
    }

        $question_data = $question->toArray();
        if ($request->session()->has('quiz_session_' . $quiz_session_id)) {
            $quiz = $request->session()->get('quiz_session_' . $quiz_session_id);
            $quiz['questions'][] = $question->id;
            $request->session()->put('quiz_session_' . $quiz_session_id, ['questions' => $quiz['questions']]);
        } else {
            $request->session()->put('quiz_session_' . $quiz_session_id, ['questions' => [$question->id]]);
        }

        return response()->json(['success' => true, 'data' => $question_data]);


        // }
        // return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function edit_question($question_id, $quiz_session_id)
    {
        $question = Question::find($question_id);
        if (!$question) {
            return response()->json(['error' => 'LMS::main.messages.not_found_question']);
        }

        return view('LMS::quizzes.partials.edit_question')->with(compact('question', 'quiz_session_id'));

    }


    public function update_question(AjaxQuestionRequest $request, $question_id)
    {


        $checks = ['show_check_answer' => $request->show_check_answer ?: 0, 'allow_comments' => $request->allow_comments ?: 0, 'show_question_title' => $request->show_question_title ?: 0,];
        $request->merge($checks);


        $quiz_session_id = $request->quiz_session_id;

        $data = $request->except('answers', 'categories', 'quiz_session_id');
        $question = Question::find($question_id);


        $question->update($data);

        $question->answers()->delete();

        $question_answers = [];

        $answers = $request->get('answers', []);
            if($request->get('question_type') != 'paragraph'){

        foreach ($answers as $answer) {
            $answer['question_id'] = $question->id;
            $question_answer = Answer::create($answer);
            $question_answers[] = $question_answer;
        }
    }

        $question_data = $question->toArray();
        if ($request->session()->has('quiz_session_' . $quiz_session_id)) {
            $quiz = $request->session()->get('quiz_session_' . $quiz_session_id);
            $quiz['questions'][] = $question->id;
            $request->session()->put('quiz_session_' . $quiz_session_id, ['questions' => $quiz['questions']]);
        } else {
            $request->session()->put('quiz_session_' . $quiz_session_id, ['questions' => [$question->id]]);
        }


        return response()->json(['success' => true, 'data' => $question_data]);


    }

    public function list_questions($quiz_session_id)
    {
        $selected_questions = [];
        if (session()->has('quiz_session_' . $quiz_session_id)) {
            $quiz = session('quiz_session_' . $quiz_session_id);
            $selected_questions = $quiz['questions'];
        }
        $questions = Question::whereNotIn('id', $selected_questions)
            ->orderBy('created_at', 'desc')->get(['id', 'title', 'content']);

        return view('LMS::quizzes.partials.questions_list')->with(compact('questions', 'quiz_session_id'));

    }

    public function add_to_quiz($question_id, $quiz_session_id)
    {
        $question = Question::find($question_id);
        $question_data = $question->toArray();
        if (session()->has('quiz_session_' . $quiz_session_id)) {
            $quiz = session()->get('quiz_session_' . $quiz_session_id);
            $quiz['questions'][] = $question->id;
            session()->put('quiz_session_' . $quiz_session_id, ['questions' => $quiz['questions']]);
        } else {
            session()->put('quiz_session_' . $quiz_session_id, ['questions' => [$question->id]]);
        }

        return response()->json(['success' => true, 'data' => $question_data]);
    }


    public function remove_from_quiz($question_id, $quiz_session_id)
    {
        $question = Question::find($question_id);
        if (session()->has('quiz_session_' . $quiz_session_id)) {
            $quiz = session()->get('quiz_session_' . $quiz_session_id);
            $qArray = $quiz['questions'];
            $new_array = array_diff($qArray, [$question_id]);
            session()->put('quiz_session_' . $quiz_session_id, ['questions' => $new_array]);
            return response()->json(['success' => true, 'data' => $new_array]);

        }

        return response()->json(['success' => false, 'msg' => "error happened"]);


    }

    //courses

    function create_course_item(Request $request, $section_id = null, $item, $course_session_id)
    {


        $rules = [];

        $rules = array_merge($rules, [
            'course_item_title' => 'required',
        ]);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $timeStmp = Carbon::now();

            $strRand = '0123456789abcdefghijk' . $timeStmp . 'lmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $slug = $item . '-' . Auth()->id() . substr(str_shuffle(str_repeat($strRand, 15)), 0, 15);


            switch ($item) {
                case 'section':
                    $data = Section::create(['title' => $request->input('course_item_title'), 'created_by' => Auth()->id(), 'updated_by' => Auth()->id()]);
                    break;
                case 'quiz':
                    $data = Quiz::create(['title' => $request->input('course_item_title'), 'created_by' => Auth()->id(), 'updated_by' => Auth()->id(), 'slug' => $slug]);
                    break;
                default:

                    $data = Lesson::create(['title' => $request->input('course_item_title'), 'created_by' => Auth()->id(), 'updated_by' => Auth()->id(), 'slug' => $slug]);
                    break;
            }


            $item_data = ['type' => $item, 'id' => $data->id];
            if ($request->session()->has('course_session_' . $course_session_id)) {
                $courseSession = $request->session()->get('course_session_' . $course_session_id);
                $courseSession['items'][] = $item_data; //['section', 1]
                $request->session()->put('course_session_' . $course_session_id, $courseSession);
            } else {
                $items = [];
                $items[] = $item_data;
                $request->session()->put('course_session_' . $course_session_id, ['items' => $items]);
            }

            return view('LMS::courses.partials.' . $item . '_row')->with(compact('item', 'section_id', 'data'));
        }

        return response()->json(['error' => $validator->errors()->all()]);

    }


    function show_edit_section($section_id)
    {

        $section = Section::find($section_id);


        return view('LMS::courses.partials.edit_section')->with(compact('section'));

    }


    function update_course_item(Request $request, $item_id = 0, $item)
    {

        $rules = [];

        $rules = array_merge($rules, [
            'course_item_title' => 'required',
        ]);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            switch ($item) {
                case 'section':
                    $updattable = Section::find($item_id);


                    break;
                case 'quiz':
                    $updattable = Quiz::find($item_id);

                    break;
                default:
                    $updattable = Lesson::find($item_id);
                    break;
            }

            if (!$updattable) {

                return response()->json(['error' => 'Something happened']);

            }

            $updattable->update(['title' => $request->input('course_item_title')]);


            return response()->json(['title' => $updattable->title, 'id' => $updattable->id]);


        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    function remove_course_item(Request $request, $item_id = 0, $item, $course_session_id)
    {

        if (session()->has('course_session_' . $course_session_id)) {
            $courseItems = session()->get('course_session_' . $course_session_id);
            $cArray = $courseItems['items'];
            $new_array = [];


            if (!empty($cArray)) {

                session()->forget('course_session_' . $course_session_id);

                foreach ($cArray as $key => $value) {


                    if ($value['type'] != $item && $value['id'] != $item_id) {

                        $new_array[] = $key;
                    }


                }


            }


            $request->session()->put('course_session_' . $course_session_id, ['items' => $new_array]);


            return response()->json(['success' => true, 'data' => $new_array]);

        }

        return response()->json(['success' => false, 'msg' => "error happened"]);


    }


    public function list_course_items($section_id, $item_type, $course_session_id)
    {
        $section_id = $section_id;
        $item_type = $item_type;
        $selected_questions = [];
        $courseItems = [];
        if (session()->has('course_session_' . $course_session_id)) {

            $courseSession = session('course_session_' . $course_session_id);
            $courseSession['items'];

            if (!empty($courseSession['items'])) {

                foreach ($courseSession['items'] as $row) {


                    $courseItems[] = isset($row['id']) ? $row['id'] : 0;

                }


            }

        }

        if ($item_type == 'lesson') {
            $courseItems = Lesson::select('id', 'title')->whereNotIn('id', $courseItems)->orderBy('created_at', 'desc')->get();
        } elseif ($item_type == 'quiz') {
            $courseItems = Quiz::select('id', 'title')->whereNotIn('id', $courseItems)->orderBy('created_at', 'desc')->get();
        } else {

            $courseItems = Section::select('id', 'title')->whereNotIn('id', $courseItems)->orderBy('created_at', 'desc')->get();


        }


        return view('LMS::courses.partials.items_list')->with(compact('courseItems', 'section_id', 'item_type', 'course_session_id'));


        //end

    }


    public function add_to_section(Request $request, $section_id, $item, $item_id, $course_session_id)
    {
        if ($item == 'lesson') {
            $data = Lesson::find($item_id);
        } else {
            $data = Quiz::find($item_id);
        }

        $item_data = ['type' => $item, 'id' => $item_id];
        if ($request->session()->has('course_session_' . $course_session_id)) {
            $courseSession = $request->session()->get('course_session_' . $course_session_id);
            $courseSession['items'][] = $item_data; //['section', 1]
            $request->session()->put('course_session_' . $course_session_id, $courseSession);
        } else {
            $request->session()->put('course_session_' . $course_session_id, ['items' => $item_data]);
        }

        return view('LMS::courses.partials.' . $item . '_row')->with(compact('item', 'section_id', 'data'));
    }


    public function invoice_items_list(Request $request, $item_type, $session_id)
    {


        $item_type = $item_type;
        $invoiceItems = [];
        if (session()->has('invoice_session_' . $session_id)) {

            $invoiceSession = session('invoice_session_' . $session_id);
            $invoiceSession['items'];

            if (!empty($invoiceSession['items'])) {

                foreach ($invoiceSession['items'] as $row) {


                    $invoiceItems[] = isset($row['id']) ? $row['id'] : 0;

                }


            }


        }

        if ($item_type == 'plan') {
            $invoiceItems = Plan::select('id', 'title', 'price', 'sale_price')->whereNotIn('id', $invoiceItems)->orderBy('created_at', 'desc')->get();
        } elseif ($item_type == 'quiz') {
            $invoiceItems = Quiz::select('id', 'title', 'price', 'sale_price')->whereNotIn('id', $invoiceItems)->orderBy('created_at', 'desc')->get();

        } else {

            $invoiceItems = Course::select('id', 'title', 'price', 'sale_price')->whereNotIn('id', $invoiceItems)->orderBy('created_at', 'desc')->get();

        }

        return view('LMS::invoices.partials.items_list')->with(compact('invoiceItems', 'session_id', 'item_type'));
    }


    function remove_invoice_item(Request $request, $item, $item_id, $session_id)
    {


        if (session()->has('invoice_session_' . $session_id)) {
            $invoiceItems = session()->get('invoice_session_' . $session_id);

            $cArray = $invoiceItems['items'];
            $new_array = [];
            if (!empty($cArray)) {
                session()->forget('invoice_session_' . $session_id);


                foreach ($cArray as $key => $value) {

                    if ($value['type'] == $item) {
                        if ($value['id'] != $item_id) {
                            $new_array[] = ['type' => $value['type'], 'id' => $value['id']];
                        }


                    } else {
                        $new_array[] = ['type' => $value['type'], 'id' => $value['id']];
                    }


                }


            }


            session()->put('invoice_session_' . $session_id, ['items' => $new_array]);


            return response()->json(['success' => true, 'data' => $new_array]);

        }

        return response()->json(['success' => false, 'msg' => "error happened"]);


    }


    public function invoice_add_new_item(Request $request, $item_type, $item_id, $session_id)
    {

// dd(session()->get('invoice_session_'.$session_id));
        if ($item_type == 'plan') {
            $data = Plan::find($item_id);
        } elseif ($item_type == 'course') {
            $data = Quiz::find($item_id);

        } else {
            $data = Course::find($item_id);
        }

        $item_data = ['type' => $item_type, 'id' => $item_id];
        if ($request->session()->has('invoice_session_' . $session_id)) {

            $invoiceSession = $request->session()->get('invoice_session_' . $session_id);
            $invoiceSession['items'][] = $item_data;
            $request->session()->put('invoice_session_' . $session_id, $invoiceSession);
        } else {
            $items = [];
            $items[] = $item_data;
            $request->session()->put('invoice_session_' . $session_id, ['items' => $items]);
        }

        // dd(session()->get('invoice_session_'.$session_id));

        $data = ['price' => $request->item_price, 'data' => $data];
        return view('LMS::invoices.partials.item_row')->with(compact('data', 'item_type', 'session_id'));
    }

    public function searchQuestionsTitles(Request $request)
    {
        $questions = [];
        if ($request->q)
            $questions = Question::where("title", "like", "%" . $request->input("q") . "%")->get(["id", "title"]);
        return response()->json(['success' => true, 'data' => $questions]);
    }

}
