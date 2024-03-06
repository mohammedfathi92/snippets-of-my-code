<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Content;
use Modules\Components\LMS\Models\Section;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\LMS\Models\StudentCertificate;
use Modules\Components\LMS\Models\UserLMS;
use Modules\User\Models\User;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Logs as StudentLogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Logs
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
      if(!Auth::check())
         return  ['success' => false, 'status' => 0, 'message' => 'LMS::messages.cannot_show_page'];

      // $degree must be in percentage
        $response = $this->enroll_status($attributes);
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

        
        if($response['success'] ){

          $itemLog = $response['itemLog']; 

          // mark as completed

          if($response['status'] == 0){

             

            if(countData($itemLog)){
                $itemLog->update(['status' => 1, 'passed' => $passed, 'degree' => $degree]);

                return  ['success' => true, 'status' => 1, 'message' => 'LMS::messages.success_completed_lesson'];
            }

            return  ['success' => false, 'status' => 0, 'message' => 'LMS::messages.something_happen'];

          }else{

          //mark as uncompleted

            if(countData($itemLog)){
                $itemLog->update(['status' => 0, 'passed' => 0, 'degree' => 0]);

                return  ['success' => true, 'status' => 1, 'message' => 'LMS::messages.success_uncompleted_lesson'];
            }

            return  ['success' => false, 'status' => 0, 'message' => 'LMS::messages.something_happen'];


          }



        }

          return  ['success' => false, 'status' => 2, 'message' => 'LMS::messages.cannot_complete_action'];
    }

    /**
     * check if user can enroll [log into] items [lessons & quizzes]
     *
     * @param array $attributes
     */

    public function can_enroll_course_item($attributes = [])
    {
      if(!Auth::check())
        return ['success' => false, 'status' => 0, 'message' => 'auth error']; //@transM

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

      if(!countData($parentLog)){

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
      if(!Auth::check())
        return ['success' => false, 'status' => 0, 'message' => 'auth', 'itemLog' => null];

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

      $parentStatus = 0;


      //if not enrolled before


    if($parent){

        $parentLog = $this->currentItemLog([
            'user' => $user,
            'module' => $attributes['parent']['type'],
            'module_id' => $attributes['parent']['id'],
            'parent' => []
        ]);

        if(countData($parentLog)){
            $parentId = $parentLog->id;
            $parentStatus = $parentLog->status;
        }


        }



        if($enroll_status['status'] == 2){
        $enroll = true;

        }else{
            $enroll = false;
        }

    // if($parentStatus){
    //       $enroll = true;
    //     }

        

      if($enroll && !$parentStatus){
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

      if(countData($itemLog)){
      
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
      if(!Auth::check())
        return ['success' => true, 'status' => 0, 'message' => 'not completed', 'itemLog' => null];

     /**
     ** response success
     true => is enrolled
     ** response status
     1=>completed,
     0=>not completed,
     2=>not enrolled before
     **/
        $currentItemLog = $this->currentItemLog($attributes);
        if(!empty($currentItemLog)){

            //if complete item
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


     public function currentItemLog($attributes = [], $is_exercise = false)
    {
      // if(!Auth::check())
      //   return null;


        $user = $attributes['user'];
        $itemLog = null;

        $parentArry = isset($attributes['parent'])?$attributes['parent']:[];

         if(!empty($attributes['parent'])){
            $parent_type = $attributes['parent']['type'];
            $parent_id = $attributes['parent']['id'];

          $parentLastLog = StudentLogs::where('user_id', $user->id)->where('lms_loggable_type', $parent_type)->where('lms_loggable_id', $parent_id)->where('parent_id', null)->orderBy('created_at',  'desc')->first();
          $itemLogs = null;
         if(!empty($parentLastLog)){

          $itemLogs = StudentLogs::where('user_id', $user->id)->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->where('parent_id', $parentLastLog->id)->orderBy('id', 'desc')->get();

             }     
         
         if(countData($itemLogs)){

             $itemLog = $itemLogs->first();

            foreach($itemLogs->where('id', '!=', $itemLog->id)->where('status', 0) as $item){

                $item->update(['status' => 1]);

            }

         }

          if(countData($itemLog)){

             return $itemLog;

          }

        
        }else{

            $itemLogs = StudentLogs::where('user_id', $user->id)->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->where('parent_id', null)->orderBy('created_at',  'desc')->get();

          if(countData($itemLogs)){
            $itemLog = $itemLogs->first();

           foreach($itemLogs->where('id', '!=', $itemLog->id)->where('status', 0) as $item){

                $item->update(['status' => 1]);

            }

             return  $itemLog;

          }
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
      if(!Auth::check())
        return 0;

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
      if(!Auth::check()){
        return  [
      'success' =>  null,
      'courseLog' => null,
      'completedLessons' => null,
      'unrolledLessons' => null,
      'unrolledQuizzes' => null,
      'passedQuizzes' => null,
      'unpassedQuizzes' => null
    ];
      }

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

       if(countData($courseLog)) {

         $childerenLogs = StudentLogs::where('user_id', $user->id)->where('parent_id', $courseLog->id)->get();

         if(countData($childerenLogs)){

             $status = true;

             $passedQuizzes = $childerenLogs->where('lms_loggable_type', 'quiz')->where('status', 1)->where('passed', true);
            $completedLessons = $childerenLogs->where('lms_loggable_type', 'lesson')->where('status', 1)->where('passed', true);
            
            $unpassedQuizzes =  $childerenLogs->where('lms_loggable_type', 'quiz')->where('status', 1)->where('passed', false);

            

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

      if(!Auth::check())
        return ['status' => false, 'degree' => 0, 'progress' => []];

    //course progress
    $progress = $this->courseProgress($user, $course);
    $courseLog = $progress['courseLog'];
    $completedLessons =  $progress['completedLessons'];
    $unrolledLessons = $progress['unrolledLessons'];
    $unrolledQuizzes = $progress['unrolledQuizzes'];
    $passedQuizzes = $progress['passedQuizzes'];
    $unpassedQuizzes = $progress['unpassedQuizzes'];
    $percentage = 0;



    if(!countData($courseLog)){
      return ['status' => false, 'degree' => 0, 'progress' => $progress];
    }
    
    //course passing condition

    $condition = $condition?:$course->evaluation_type;

      switch ($condition) {
          case 'completed_lessons_quizzes':

         $countCourseItems = \DB::table('lms_courseables')->where('course_id', $course->id)->count();
         $countLoggedItems = $courseLog->children()->where('status', 1)->where('passed', true)->count();
          

           if($countCourseItems > 0 && $countLoggedItems > 0){

            $percentage = ($countLoggedItems / $countCourseItems) * 100;


            if($percentage >= $course->passing_grade){

                 $courseLog->update(['passed' => true, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

       $this->createCertificate($user, $course, $courseLog, true);

            return ['status' => true, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }else{

            $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

             return ['status' => false, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }

           }else{

             $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

            return ['status' => false, 'degree' => 0, 'progress' => $progress];
           }

          break;
          case 'final_quiz':
           $finalQuiz = null;
           $percentage = 0;
          $finalSection = $course->sections()->orderBy('order', 'desc')->first();
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
         if(countData($quizLog)){

             $finalQuizStatus =$quizLog->passed;
              $userDegree = $quizLog->degree;
              if($finalQuizStatus){

                $courseLog->update(['passed' => true, 'degree' =>$userDegree > 100?100:$userDegree, 'passing_grade' => $course->passing_grade]);
                  return ['status' => true, 'degree' => $userDegree > 100?100:$userDegree , 'progress' => $progress];

$this->createCertificate($user, $course, $courseLog, true);
                
              }

             return ['status' => false, 'degree' => $userDegree > 100?100:$userDegree, 'progress' => $progress];

         }

          }

          return ['status' => false, 'degree' => 0, 'progress' => $progress];

          case 'passed_quizzes':

           if(!countData($passedQuizzes)){

                 $courseLog->update(['passed' => false, 'degree' =>$userDegree > 100?100:$userDegree, 'passing_grade' => $course->passing_grade]);

            return ['status' => false, 'degree' => 0, 'progress' => $progress];

           }else{

            $passedQuizzesCount = countData($passedQuizzes);
            $courseQuizzes = $course->quizzes()->count();

            if($courseQuizzes > 0 && $passedQuizzesCount > 0){

              $percentage = ($passedQuizzesCount / $courseQuizzes) * 100;

              if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

$this->createCertificate($user, $course, $courseLog, true);

                 return ['status' => true, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];

              }

            }

            return ['status' => false, 'degree' => 0, 'progress' => $progress];


           }



          break;
          
         
              break;
          case 'quizzes_results':
          
             if(!countData($passedQuizzes)){

                 $courseLog->update(['passed' => false, 'degree' =>0, 'passing_grade' => $course->passing_grade]);

            return ['status' => false, 'degree' => 0, 'progress' => $progress];

           }else{


            $passedQuizzesDegree = $passedQuizzes->sum('degree');
            $courseQuizzesCount = $course->quizzes()->count();
            $courseQuizzesDegree = $courseQuizzesCount * 100;

            $percentage = 0;

            if($courseQuizzesDegree > 0){

                $percentage = ($passedQuizzesDegree / $courseQuizzesDegree) * 100;

        if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

$this->createCertificate($user, $course, $courseLog, true);

            return ['status' => true, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }else{

            $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

             return ['status' => false, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }


            }


             return ['status' => false, 'degree' => $percentage, 'progress' => $progress];
           }
              break;
          case 'completed_lessons':

              if($course->lessons->count() && countData($completedLessons)){

                $percentage = ($completedLessons->count() / $course->lessons->count())*100;

                

           
        if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

                             //create certificate     
$this->createCertificate($user, $course, $courseLog, true);

            return ['status' => true, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }else{

            $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

             return ['status' => false, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }

           }else{

            $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

            return ['status' => false, 'degree' => 0, 'progress' => $progress];
           }
              break;

        default:
              if($course->lessons->count() && countData($completedLessons)){

                $percentage = ($completedLessons->count() / $course->lessons->count())*100;

                

           
        if($percentage > $course->passing_grade){

                 $courseLog->update(['passed' => true, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

      //create certificate 
$this->createCertificate($user, $course, $courseLog, true);   
            if($course->certificate_id){
              StudentCertificate::create([
                'code' => uniqid().$user->id,
                'certificatable_type' => 'course',
                'certificatable_id' => $course->id,
                'user_id' => $user->id,
                'log_id' => countData($courseLog)?$courseLog->id:null,
                'status' => true
              ]);
            }

            return ['status' => true, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }else{

            $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

             return ['status' => false, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];


            }

           }else{

            $courseLog->update(['passed' => false, 'degree' =>$percentage > 100?100:$percentage, 'passing_grade' => $course->passing_grade]);

            return ['status' => false, 'degree' => $percentage > 100?100:$percentage, 'progress' => $progress];
           }
              break;                                         
      }
    }


     public function isQuizPassed ($attributes = []){

      if(!Auth::check())
        return ['status' => false, 'degree' => 0];

      $moduleData = \LMS::getModuleData($attributes['module'], $attributes['module_id']);

        $quizLog = $this->currentItemLog($attributes);

if(countData($quizLog)){

  $quizQuestionsCount = $moduleData->questions()->where('question_type', '!=', 'paragraph')->count();


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

    public function answerQuestion($questionLog, $question, $skipped = false, $attributes = [], $checkAnswer = false){
      if(!Auth::check())
        return ['success' => false, 'status' => 0, 'message' => 'auth error']; //@transM
      $studentAnswersCount = count($attributes['answers']);


      $studentAnswersIds = [];
      foreach ($attributes['answers'] as $id) {
        $studentAnswersIds[] = hashids_decode($id);
        
      }

      $correctAnswers = $question->answers()->where('is_correct', true)->whereIn('id', $attributes['answers'])->get();
      // if(empty($correctAnswers)){
      //   return ['success' => false, 'status' => 0, 'message' => 'something wrong happen']; //@transM
      // }

      $correctAnswersCount = $question->answers()->where('is_correct', true)->count();

      $studentCorrectAnswersCount = $question->answers()->where('is_correct', true)->whereIn('id', $studentAnswersIds)->count();

      $passed = false;


      if(($studentCorrectAnswersCount == $correctAnswersCount) && (count($attributes['answers']) == $correctAnswersCount)  ){
        $passed = true;
      }

      //check if completed

      $studentAnswers = ['answers' => 
      $attributes['answers']
    ];

    $status = 0;
    if(count($attributes['answers'])){
      $status = 1;
    }
$is_checked = $questionLog->preview; //answered or not
$preview_num = $questionLog->preview_num; //time to try
    if($checkAnswer){
    if($questionLog->preview > 0 && $questionLog->preview_num > 0){

    $is_checked = true;  
    $preview_num = 2;

    }else{

      if($passed){

        $is_checked = true;  
        $preview_num = $questionLog->preview_num + 1;

      }else{

        $is_checked = false;  
        $preview_num = $questionLog->preview_num + 1;

        if($preview_num > 1){
          
          $is_checked = true; 


        }

      }
    }

    }
       if (!$questionLog->preview) {
    
      
              $questionLog->update([
            'passed' => $passed,
            'status' => $status, //completed
            'skipped' => $skipped,
            'degree' => $question->points?:1,
            'preview' => $is_checked,
            'preview_num' => $preview_num,
            'options' => json_encode($studentAnswers),

           ]);

}

   
      return ['success' => true, 'status' => $questionLog->status, 'correctAnswers' => $correctAnswers];

    }



      //parentLog => parent quiz log

     //$parentLog = {},

     //$question = {},


    public function questionEasyStatus($questionLog, $status = 0){
      if(!Auth::check())
         return ['success' => false, 'status' => 0, 'correctAnswers' => null];

          $updatedLog = $questionLog->update([
            'passed' => $passed,
            'status' => 1, //completed
            'passing_grade' => $question->points?:1,
            'options' => encode($studentAnswers),

           ]);

      return ['success' => true, 'status' => $updatedLog->status, 'correctAnswers' => $correctAnswers];

    }

    //student degree in percentage

      public function student_grade($student_degree){

        if($grades_name = \Settings::get('lms_student_grades_name')){

          foreach ($grades_name as $key => $value) {

            if($student_degree <= $value){
              return $key;
            }
            
          }


        }

        return null;
      

    }

    

    //create certificate 

    public function createCertificate($user, $course, $courseLog, $deleteOthers = true){

      $certCode = null;

      $certificate = null;

if($deleteOthers){
          
        $userCertificates = StudentCertificate::where('log_id', $courseLog->id)->get();         
      if(countData($userCertificates)){
        $certCode = $userCertificates->first()->code;
        foreach ($userCertificates as $cert) {
          $cert->delete();
        }
      }
      }    
            if($course->certificate_id){
             $certificate = StudentCertificate::create([
                'code' => $certCode?$certCode:uniqid().$user->id,
                'certificatable_type' => 'course',
                'certificatable_id' => $course->id,
                'temp_id' => $course->certificate_id,
                'user_id' => $user->id,
                'log_id' => countData($courseLog)?$courseLog->id:null,
                'status' => true
              ]);
            }

       return $certificate;    


    }






}