<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Content;
use Modules\Components\LMS\Models\Section;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\LMS\Models\UserLMS;
use Modules\User\Models\User;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Logs as StudentLogs;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class QuizLogs
{
    /**
     * LMS constructor.
     */
    function __construct()
    {
    }


     /**
     * mark as completed || uncompleted
     *
     * @param bool $status, $degree = 1, array $attributes
     * status = true complete | status = false uncomplete
     */

    public function markAsCompleted($status = 0, $degree = 0, $attributes = [])
    {

      // $degree must be in percentage
        $resposn = $this->enroll_status($attributes);
        $moduleData = \LMS::getModuleData($attributes['module'], $attributes['module_id']);
        $passed = false;

        if($attributes['module'] != 'lesson'){

          $modulePassingGrade = $moduleData->passing_grade;

          if($degree < $modulePassingGrade){

             $passed = false;

          }else{
            $passed = true;
          }


        }else{

          $passed = true;
        }

        
        if($resposn['success'] ){

          $itemLog = $resposn['itemLog']; 

          // mark as completed

          if($resposn['status'] == 0){

             

            if($itemLog){
                $itemLog->update(['status' => 1, 'passed' => $passed, 'degree' => $degree]);

                return  ['success' => true, 'status' => 1, 'message' => 'Done'];
            }

            return  ['success' => false, 'status' => 0, 'message' => 'not find item log'];

          }else{

          //mark as uncompleted

            if($itemLog){
                $itemLog->update(['status' => 0, 'passed' => 0, 'degree' => 0]);

                return  ['success' => true, 'status' => 1, 'message' => 'Done'];
            }

            return  ['success' => false, 'status' => 0, 'message' => 'not find item log'];


          }



        }

          return  ['success' => false, 'status' => 2, 'message' => 'error enroll happen'];
    }

    /**
     * check if user can enroll [log into] items [lessons & quizzes]
     *
     * @param array $attributes
     */

    public function can_enroll_quiz($attributes = [])
    {
       $user = $attributes['user'];
       $module = $attributes['module'];
       $module_id = $attributes['module_id'];

       $previousItemsCount = 0;
       $currentParentItemsLogs = 0;


       $parent_module = isset($attributes['parent']['type'])?$attributes['parent']['type']:'course';

       $parent_id = isset($attributes['parent']['id'])?$attributes['parent']['id']:null;

       $course = \LMS::getModuleData($parent_module, $parent_id);


      if(empty($course)){
        return ['success' => false, 'status' => 2, 'message' => 'somthig happend']; //@transM
       }



       if($module == 'lesson'){
        $section = Section::where('course_id', $course->id)->whereHas('lessons', function($q) use ( $module_id){
        $q->where('lms_lessons.id', $module_id);

        })->first();
       
       
       }

        elseif($module == 'quiz'){
        $section = Section::where('course_id', $course->id)->whereHas('quizzes', function($q) use ( $module_id){
        $q->where('lms_quizzes.id', $module_id);

        })->first();

       }else{

        return ['success' => false, 'status' => 2, 'message' => 'somthig happend']; //@transM
       }

       if(empty($section)){

      return ['success' => false, 'status' => 2, 'message' => 'somthig happend']; //@transM
       }

       $sectionItem = DB::table('lms_sectionables')->where('section_id', $section->id)->where('lms_sectionable_id', $module_id)->first();

       if (!$sectionItem) {
         return ['success' => false, 'status' => 2, 'message' => 'somthig happend']; //@transM
        
       }

       $previousItemsCount += DB::table('lms_sectionables')->where('section_id', $section->id)->where('order','<', $sectionItem->order)->count();

       $lessOrderSections = $course->sections()->where('order', '<', $section->order)->get();

       if(!empty($lessOrderSections)){

         $lessOrderSectionsIds = $lessOrderSections->pluck('id')->toArray();
         $previousItemsCount += DB::table('lms_sectionables')->whereIn('section_id', $lessOrderSectionsIds)->count();
       }



      $parentLog = $this->currentItemLog([
            'user' => $user,
            'module' => isset($attributes['parent']['type'])?$attributes['parent']['type']:'course',
            'module_id' =>isset($attributes['parent']['id'])?$attributes['parent']['id']:'null',
            'parent' => []
        ]);

      if(!$parentLog->count()){

       return ['success' => false, 'status' => 2, 'message' => 'somthig happend']; //@transM

      }

      $currentParentItemsLogs = DB::table('lms_logs')->where('parent_id', $parentLog->id)->where('status', 1)->count();

      if($currentParentItemsLogs >= $previousItemsCount){

        return ['success' => true, 'status' => 1, 'message' => 'can enroll']; //@transM


      }

      return ['success' => false, 'status' => 0, 'message' => 'cannot enroll']; //@transM

      }

     /**
     * user enroll [log into] items
     *
     * @param array $attributes, bool $retake
     */


    public function enroll($attributes = [], $retake = false, $retake_number = 0)
    {

       $parent = false;   

       $passingGrade = isset($attributes['passingGrade'])?$attributes['passingGrade']:null;

    if(isset($attributes['parent']) && !empty($attributes['parent'])){

        $parent = true;
      }

    if($retake){


        $logsNumber = $this->logsNumber($attributes, $parent);

        if($retake_number >= $logsNumber){

          $enroll_status = $this->enroll_status($attributes);

    return ['success' => false, 'status' => 2, 'message' => 'you finished your retakes numbers', 'itemLog' =>  $enroll_status['itemLog']];


        }
        

        }

      $enroll_status = $this->enroll_status($attributes);


      $user = $attributes['user'];

      $parentId = null;

      $parentStatus = 1;


      //if not enrolled before


    if($parent){

        $parentLog = $this->currentItemLog([
            'user' => $user,
            'module' => $attributes['parent']['type'],
            'module_id' => $attributes['parent']['id'],
            'parent' => []
        ]);

        if($parentLog){
            $parentId = $parentLog->id;
            $parentStatus = $parentLog->status;
        }


        }

        if($enroll_status['status'] == 2){

        $enroll = true;
        }elseif ($enroll_status['status'] == 1 && $parentStatus == 1) {
            $enroll = true;
        }else{
            $enroll = false;
        }

      if($enroll){
        $itemLog = StudentLogs::create([
            'user_id' => $user->id,
            'lms_loggable_type' => $attributes['module'],
            'lms_loggable_id' => $attributes['module_id'],
            'passing_grade' => $passingGrade,
            'parent_id' => $parentId
        ]);

         return ['success' => true, 'status' => 1, 'message' => 'create new user log for this item', 'itemLog' =>  $itemLog];

      }

      $itemLog = isset($enroll_status['itemLog'])?$enroll_status['itemLog']:null;

      if($itemLog){
      
      $itemLog->update(['enrolls_number' => $itemLog->enrolls_number+1]);

      }

        
        return ['success' => true, 'status' => 1, 'message' => 'update current log', 'itemLog' =>  $itemLog];
    }

      /**
     * enroll status
     *
     * @param array $attributes
     */

    public function enroll_status($attributes = [])
    {
     /**
     ** response status
     1=>completed,
     0=>not completed,
     2=>not enrolled before
     **/
        $currentItemLog = $this->currentItemLog($attributes);
        if(!empty($currentItemLog)){

            //if not complete item
        if($currentItemLog->status == 1){

             $data = ['success' => true, 'status' => 1, 'message' => 'completed', 'itemLog' => $currentItemLog];
         return $data;


            }else{

        $data = ['success' => true, 'status' => 0, 'message' => 'not completed', 'itemLog' => $currentItemLog];
         return $data;


            }

        }


        $data = ['success' => false, 'status' => 2, 'message' => 'not enrolled before', 'itemLog' => null];
         return $data;
    }

     /**
     * last user log for specific item ifo
     *
     * @param array $attributes
     * @return $itemLog
     */


     public function currentItemLog($attributes = [])
    {

        $user = $attributes['user'];
        $itemLog = null;

         if(isset($attributes['parent']) && !empty($attributes['parent'])){
            $parent_type = $attributes['parent']['type'];
            $parent_id = $attributes['parent']['id'];
            

          $itemLogs = StudentLogs::where('user_id', $user->id)->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->whereHas('parent', function($q) use ($parent_type, $parent_id){
           $q->where('lms_loggable_type', $parent_type)->where('lms_loggable_id',  $parent_id);

        })->orderBy('id', 'desc');

       
         
         if($itemLogs->count()){

             $itemLog = $itemLogs->first();

            foreach($itemLogs->where('id', '!=', $itemLog->id)->where('status', 0)->get() as $item){

                $item->update(['status' => 1]);

            }

         }

          if($itemLog){

             return $itemLog;

          }

         
        }

          $itemLogs = StudentLogs::where('user_id', $user->id)->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->orderBy('created_at',  'desc');

          if($itemLogs){

             return $itemLogs->first();

          }

          return $itemLog;

      }

     /**
     * logsNumber for item
     *
     * @param array $attributes, bool $parent 
     * $parent [only logs for item that has this parent]
     * @return logsNumber for item
     */  

    public function logsNumber($attributes = [], $parent = false)
    {

        $user = $attributes['user'];

        $number = 0;

        if($parent){

        $parent_type = $attributes['parent']['type'];
        $parent_id = $attributes['parent']['id'];

             $number = $user->logs->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->whereHas('parent', function($q){
           $q->where('lms_loggable_type', $parent_type)->where('lms_loggable_id',  $parent_id);

        })->count();

        return $number;


        }

        $number = $user->logs->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->count();

        return $number;

    }

    public function courseProgress($user, $course){

         $childerenLogs = null;
         $completedLessons = null;
         $passedQuizzes = null;
         $unpassedQuizzes = null;
         $unrolledLessons = 0;
         $unrolledQuizzes = 0;
         $status = false;

     //get course (current or last) log
         $courseLog = $this->currentItemLog([
            'user' => $user,
            'module' => 'course',
            'module_id' => $course->id,
            'parent' => []
        ]);

    //get course logs of it's childeren [lessons , quizzes]

       if($courseLog) {

         $childerenLogs = StudentLogs::where('user_id', $user->id)->where('parent_id', $courseLog->id);

         if($childerenLogs){

             $status = true;

            $completedLessons = $childerenLogs->where('lms_loggable_type', 'lesson')->where('status', 1)->where('passed', true);
            $passedQuizzes = $childerenLogs->where('lms_loggable_type', 'quizzes')->where('status', 1)->where('passed', true);
            $unpassedQuizzes =  $childerenLogs->where('lms_loggable_type', 'quizzes')->where('status', 1)->where('passed', false);

            if($passedQuizzes->count()){

                $unrolledQuizzes =  $course->quizzes->count() - $passedQuizzes->count();
            }

             if($completedLessons->count()){

                $unrolledLessons =  $course->lessons->count() - $completedLessons->count();

            }

         }
       }

    $data = [
      'success' =>  $status,
      'courseLog' => $courseLog,
      'completedLessons' => $completedLessons,
      'unrolledLessons' => $unrolledLessons,
      'unrolledQuizzes' => $unrolledQuizzes,
      'passedQuizzes' => $passedQuizzes,
      'unpassedQuizzes' => $unpassedQuizzes
      ];

     return $data;

    }



    public function isCoursePassed ($user, $course, $condition = null){

    //course progress
    $progress = $this->courseProgress($user, $course);
    $courseLog = $progress['courseLog'];
    $completedLessons =  $progress['completedLessons'];
    $unrolledLessons = $progress['unrolledLessons'];
    $unrolledQuizzes = $progress['unrolledQuizzes'];
    $passedQuizzes = $progress['passedQuizzes'];
    $unpassedQuizzes = $progress['unpassedQuizzes'];

    if($courseLog->count()){
      return ['status' => false, 'degree' => 0];
    }
    
    //course passing condition

    $condition = $condition?:$course->passing_condition;

      switch ($condition) {
          case 'completed_lessons_quizzes':

          $countCourseLessons = $course->lessons()->count();

           if($countCourseLessons > 0 && $completedLessons->count() > 0){

            $percentage = ($completedLessons->count() / $countCourseLessons) * 100;


            if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

            return ['status' => true, 'degree' => $percentage];


            }else{

            $courseLog->update(['passed' => false, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

             return ['status' => false, 'degree' => $percentage];


            }

           }else{

             $courseLog->update(['passed' => false, 'passing_grade' => 0, 'passing_grade_type' => 'percentage']);

            return ['status' => false, 'degree' => 0];
           }

          break;
          case 'final_quiz':
           $finalQuiz = null;
           $percentage = 0;
          $finalSection = Course::sections()->orderBy('order', 'desc')->first();
          if($finalSection){
            $finalQuiz = $finalSection->quizzes()->orderBy('order', 'desc')->first();
          }
          if($finalQuiz){
            //get final quiz (current or last) log
         $quizLog = $this->currentItemLog([
            'user' => $user,
            'module' => 'quiz',
            'module_id' => $finalQuiz->id,
            'parent' => ['type' => 'course',
            'id' => $course->id
            ]
        ]);
         if($quizLog){

             $finalQuizStatus =$quizLog->passed;
              $userDegree = $quizLog->degree;
              $quizTotalDegree = $finalQuiz->total_degree;

              if($userDegree <= $quizTotalDegree && $quizTotalDegree > 0){

                $percentage = ($userDegree / $quizTotalDegree) * 100;

                   if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

            return ['status' => true, 'degree' => $percentage];


            }else{

            $courseLog->update(['passed' => false, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

             return ['status' => false, 'degree' => $percentage];


            }


            }

             return ['status' => $finalQuizStatus, 'degree' => $percentage];

         }

          }

          return false;
         
              break;
          case 'passed_quizzes':
             if(!$passedQuizzes){

                 $courseLog->update(['passed' => false, 'passing_grade' => 0, 'passing_grade_type' => 'percentage']);

            return ['status' => false, 'degree' => 0];

           }else{

            $passedQuizzesDegree = $passedQuizzes->sum('degree');
            $courseQuizzesDegree = $course->quizzes()->sum('total_degree');

            $percentage = 0;

            if($passedQuizzesDegree <= $courseQuizzesDegree && $courseQuizzesDegree > 0){

                $percentage = ($passedQuizzesDegree / $courseQuizzesDegree) * 100;

        if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

            return ['status' => true, 'degree' => $percentage];


            }else{

            $courseLog->update(['passed' => false, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

             return ['status' => false, 'degree' => $percentage];


            }


            }


             return ['status' => true, 'degree' => $percentage];
           }
              break;
          case 'completed_lessons':
              if($course->lessons->count()){

                $percentage = $completedLessons->count() / $course->lessons->count();

                

           
        if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

            return ['status' => true, 'degree' => $percentage];


            }else{

            $courseLog->update(['passed' => false, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

             return ['status' => false, 'degree' => $percentage];


            }

           }else{

            $courseLog->update(['passed' => false, 'passing_grade' => 0, 'passing_grade_type' => 'percentage']);

            return ['status' => false, 'degree' => 0];
           }
              break;                                         
          
          default:

            $countCourseLessons = $course->lessons()->count();

           if($countCourseLessons > 0 && $completedLessons->count() > 0){

            $percentage = ($completedLessons->count() / $countCourseLessons) * 100;


            if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

            return ['status' => true, 'degree' => $percentage];


            }else{

            $courseLog->update(['passed' => false, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

             return ['status' => false, 'degree' => $percentage];


            }

           

           }else{

             $courseLog->update(['passed' => false, 'passing_grade' => 0, 'passing_grade_type' => 'percentage']);

            return ['status' => false, 'degree' => 0];
           }

              
              break;
      }
    }


     public function isQuizPassed ($attributes = []){

      $moduleData = \LMS::getModuleData($attributes['module'], $attributes['module_id']);

        $quizLog = $this->currentItemLog($attributes);

if($quizLog->count()){

  $quizQuestionsCount = $moduleData->questions()->count();


    $questionsPassedCount = StudentLogs::where('parent_id', $quizLog->id)->where('passed', true)->count();

    $percentage = ($questionsPassedCount / $quizQuestionsCount) * 100;

    if($percentage < $moduleData->passing_grade){

      $quizLog->update(['passed' => false, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

      return ['status' => false, 'degree' => $percentage];



    }

      $quizLog->update(['passed' => true, 'passing_grade' => $percentage, 'passing_grade_type' => 'percentage']);

      return ['status' => true, 'degree' => $percentage];


}
      return ['status' => false, 'degree' => 0];

     }

     //parentLog => parent quiz log

     //$parentLog = {},

     //$question = {},


    public function answerQuestion($questionLog, $question, $showAnswer = false, $attributes = []){

      $studentAnswersCount = count($attributes['answers']);

      $correctAnswers = $question->answers()->where('is_correct', true)->whereIn('id', $attributes['answers'])->get();

      if(empty($correctAnswers)){
        return ['success' => false, 'status' => 0, 'message' => 'something wrong happen']; //@transM
      }

      $correctAnswersCount = $question->answers()->where('is_correct', true)->whereIn('id', $attributes['answers'])->count();

      $passed = false;

      if($studentAnswersCount == $correctAnswersCount){
        $passed = true;
      }

      //check if completed

      $studentAnswers = ['answers' => 
      $attributes['answers']
    ];

      if($showAnswer){
          $updatedLog = $questionLog->update([
            'passed' => $passed,
            'status' => 1, //completed
            'degree' => $question->points?:1,
            'options' => encode($studentAnswers),

           ]);
      }else{
           $updatedLog = $questionLog->update([
            'passed' => $passed,
            'status' => 0, //uncompleted
            'degree' => $question->points?:1,
            'options' => encode($studentAnswers),
           ]);
      }

      return ['success' => true, 'status' => $updatedLog->status, 'correctAnswers' => $correctAnswers];

    }



      //parentLog => parent quiz log

     //$parentLog = {},

     //$question = {},


    public function questionEasyStatus($questionLog, $status = 0){

          $updatedLog = $questionLog->update([
            'passed' => $passed,
            'status' => 1, //completed
            'passing_grade' => $question->points?:1,
            'options' => encode($studentAnswers),

           ]);

      return ['success' => true, 'status' => $updatedLog->status, 'correctAnswers' => $correctAnswers];

    }


}