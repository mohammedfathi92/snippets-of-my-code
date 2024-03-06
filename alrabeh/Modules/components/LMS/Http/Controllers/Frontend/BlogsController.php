<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Illuminate\Http\Request;
use Validator;

class BlogsController extends PublicBaseController
{
    function index(){
  
        return view('blogs.index');

    }
    function show()
    {
    	  return view('blogs.show');
    }

}