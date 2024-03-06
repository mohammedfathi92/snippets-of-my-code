<?php
 
namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Illuminate\Http\Request;
use Validator;

class LessonsController extends PublicBaseController
{
    function index(){
  
        return view('courses.lesson');

    }
   function quiz(){

     return view('courses.quiz');

    }

    function QuizResult(){

     return view('courses.quiz_result');

    }


}