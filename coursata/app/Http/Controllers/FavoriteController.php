<?php


namespace Corsata\Http\Controllers;

use Corsata\Http\Controllers\Controller;
use Corsata\Course;
use Corsata\Institute;
use Corsata\User;
use Corsata\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{


function index()
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

            
        $this->data['data'] = $user;
        $this->data['title'] = "Profile";
        $this->data['meta_description'] = "test";
        $this->data['meta_keywords'] = "test";
        $this->data['related'] = "test";
        $this->data['application_name'] = "test";
        $this->data['courses'] = $user->favorites(\Corsata\Course::class)->get();
        $this->data['institutes'] = $user->favorites(\Corsata\Institute::class)->get();



         return view("frontend.users.favorites", $this->data);
    }

   

    function addCourse($id = 0){

          
        if (Auth::check()) {
          $course = Course::find($id);
if(!$course){
   return response()->json(["success" => false, 'message' => trans('msg_element_not_found'), 'alert_type' => 'success']);

}else{

        $user = Auth::user();
        $user->favorite($course);

         return response()->json(["success" => true, 'message' => trans('msg_success_add_favourite'), 'alert_type' => 'success']);

}
        

      

    }

     return response()->json(["success" => false, 'message' => trans('msg_error_add_favourite'), 'alert_type' => 'error']);

  
   }

    function removeCourse($id = 0){

               if (Auth::check()) {
          $course = Course::find($id);
if(!$course){
   return response()->json(["success" => false, 'message' => trans('msg_element_not_found'), 'alert_type' => 'success']);

}else{

        $user = Auth::user();
        $user->unfavorite($course);

        return response()->json(["success" => true, 'message' => trans('msg_success_add_favourite'), 'alert_type' => 'success']);


}

       
    }

   return response()->json(["success" => false, 'message' => trans('msg_error_add_favourite'), 'alert_type' => 'error']);

    }


        function addInstitute($id = 0){

          
        if (Auth::check()) {
          $institute = Institute::find($id);
if(!$institute){
   return response()->json(["success" => false, 'message' => trans('msg_element_not_found'), 'alert_type' => 'success']);

}else{

        $user = Auth::user();
        $user->favorite($institute);

         return response()->json(["success" => true, 'message' => trans('msg_success_add_favourite'), 'alert_type' => 'success']);

}
        

      

    }

     return response()->json(["success" => false, 'message' => trans('msg_error_add_favourite'), 'alert_type' => 'error']);

  
   }

    function removeInstitute($id = 0){

               if (Auth::check()) {
          $institute = Institute::find($id);
if(!$institute){
   return response()->json(["success" => false, 'message' => trans('msg_element_not_found'), 'alert_type' => 'success']);

}else{

        $user = Auth::user();
        $user->unfavorite($institute);
         return response()->json(["success" => true, 'message' => trans('msg_success_add_favourite'), 'alert_type' => 'success']);

}

      

    }

   return response()->json(["success" => false, 'message' => trans('msg_error_add_favourite'), 'alert_type' => 'error']);

    }






    
}
