<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\StudentTip;
use Corsata\Category;
use Corsata\Country;
use Corsata\Http\Controllers\Controller;

class StudentTipsController extends Controller
{

    function index()
    {
        $this->data['title']=trans("student_tips.frontend_title_tips")." - ".$this->data['title'];
         $this->data['data']= StudentTip::whereStatus(true)->paginate(10);

        return view("frontend.student_tips.index", $this->data);
    }


    function show($id = 0, $slug = null)
    {

       $student_tip = StudentTip::find($id);
        if (!$student_tip) {
            return abort(404);
        }


        $this->data['title'] = $student_tip->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $student_tip->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $student_tip->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['data'] = $student_tip;
        $this->data['tips'] = StudentTip::whereStatus(true)->orderBy('id', 'desc')->take(10)->get();;
        return view("frontend.student_tips.show", $this->data);
    }

   
}