<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Answer;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\UserLMS;
use Illuminate\Support\Facades\Auth;
use Modules\Components\LMS\Models\Logs as StudentLogs;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Modules\Components\CMS\Traits\SEOTools;

class ExercisesController extends PublicBaseController
{  
   use SEOTools;
    public function index(){
      $page_title = \LMS::setGeneralPagesTitle('exercises');

      \LMS::setGeneralPagesSeo('exercises', route('exercises.index'), null, 'exercises');
        $exercises = Quiz::where([['status','=','1'],['is_exercise','=','1']])->get();
        return view('exercises.index')->with(compact('exercises', 'page_title'));
    }
    
    public function show($hashed_id){

      $id = hashids_decode($hashed_id);

        $exercise =Quiz::find($id);

        if(empty($exercise)){
           abort(404);
        }

        $page_title = $exercise->title;
          $item = [
            'title' => $exercise->title,
            'meta_description' => str_limit(strip_tags($exercise->meta_description), 500),
            'url' => route('courses.show', $exercise->hashed_id),
            'type' => 'exercise',
            'image' => $exercise->thumbnail,
            'meta_keywords' => $exercise->meta_keywords
        ];

        $this->setSEO((object)$item);

        /*******  Related Courses*********/
        $relatedIds = $exercise->categories->pluck('id')->toArray();
        $relatedQuizzes = Quiz::whereHas('categories',  function ($q)use ($relatedIds) {
            $q->whereIn('id',$relatedIds);
        })->where('status', true);
         /******* Side bar*********/
        $user = null;
        $subscriptionStatus = false;
        $enroll_status = false;

        if(!user()){
           return view('exercises.show')->with(compact('exercise',
            'relatedQuizzes',
            'subscriptionStatus'

        ));
        }

         
        $user = UserLMS::find(Auth()->id());

        $moduleArray = [
        'module' => 'exercise',
        'module_id' => $id,
        'user' => $user,
        'parent' => [],
       
      ];

        $subscriptionStatus = \Subscriptions::check_subscription($moduleArray);

        // if($subscriptionStatus['success'] && $subscriptionStatus['status'] > 0){
        //     \Logs::enroll($moduleArray);
        
        // }
        return view('exercises.show')->with(compact('exercise',
            'relatedQuizzes',
            'subscriptionStatus'

        ));
    }


    


}