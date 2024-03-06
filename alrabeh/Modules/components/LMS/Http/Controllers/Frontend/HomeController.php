<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Modules\Components\LMS\Models\Course;
use Illuminate\Http\Request;
use Validator;

class HomeController extends PublicBaseController
{
         function index(){
         	$page_title = 'الصفحة الشخصية';
         $courses = Course::where('status','=','1')->orderBy('created_at', 'des')->take(8)->get();


         return view('templates.home')->with(compact('courses', 'page_title'));
  

    }
    function search(){
    	return abort(404);
    	// return view('search');
    }

}