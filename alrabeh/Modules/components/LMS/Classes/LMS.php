<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Content;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\UserLMS;
use Modules\Components\LMS\Models\Book;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Logs as StudentLogs;
use Modules\Components\LMS\Models\Certificate;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Lesson;
use Modules\Components\LMS\Models\Section;
use Modules\Components\LMS\Models\Tag;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Media;
use Carbon\Carbon;
use Modules\Components\CMS\Traits\SEOTools;

class LMS
{
    use SEOTools;
    /**
     * LMS constructor.
     */
    function __construct()
    {
    }

    /**
     * @param bool $objects
     * @param null $status
     * @return mixed
     */

    public function getAuthorsList($objects = false, $status = null)
    {
        $author = UserLMS::where('user_type', 'teacher');
        $author = $author->pluck('name', 'id');
       
        return $author;
    }

public function getCertificatesList($objects = false, $status = null)
    {
        $cert = Certificate::whereNotNull('id');
            $cert = $cert->where('status', true)->pluck('title', 'id');
       
        return $cert;
    }


        public function getQuestionsParagraphsList($objects = false, $status = null)
    {
        $questions = Question::whereNotNull('id')->where('question_type', 'paragraph');
            $questions = $questions->pluck('title', 'id');
       
        return $questions;
    }


        public function getBooksList($objects = false, $status = null)
    {
        $books = Book::whereNotNull('id');
            $books = $books->pluck('title', 'id');
       
        return $books;
    }

    public function getQuizzesList($objects = false, $status = null)
    {
        $quizzes = Quiz::whereNotNull('id');
            $quizzes = $quizzes->pluck('title', 'id');
       
        return $quizzes;
    }

      public function getUsersList($objects = false, $status = null)
    {
        $users = User::whereNotNull('id');
        $users = $users->pluck('name', 'id');
       
        return $users;
    }



       public function getCoursesList($objects = false, $status = null)
    {
        $courses = Course::whereNotNull('id');
            $courses = $courses->pluck('title', 'id');
       
        return $courses;
    }

    public function getPlansList($objects = false, $status = null)
    {
        $plans = Plan::whereNotNull('id');
            $plans = $plans->pluck('title', 'id');
       
        return $plans;
    }

    public function getCategoriesList($objects = false, $status = null)
    {
        $categories = Category::whereNotNull('id');

        $not_available_categories = $this->getNotAvailableCategories();
        if ($not_available_categories) {
            $categories->whereNotIn('id', $not_available_categories);
        }
        if ($status) {
            $categories = $categories->where('status', $status);
        }
        if ($objects) {
            $categories = $categories->get();
        } else {
            $categories = $categories->pluck('name', 'id');
        }
        return $categories;
    }

    public function getParentCategoriesList($skip = 0, $objects = false, $status = null)
    {
        $categories = Category::whereNotNull('id')->where('id','!=', $skip);

        $not_available_categories = $this->getNotAvailableCategories();
        if ($not_available_categories) {
            $categories->whereNotIn('id', $not_available_categories);
        }
        if ($status) {
            $categories = $categories->where('status', $status);
        }
        if ($objects) {
            $categories = $categories->get();
        } else {
            $categories = $categories->pluck('name', 'id');
        }
        return $categories;
    }

    public function getCategoryCoursesCount($category)
    {
        $courses = $category->courses()->published();

        if (!user()) {
            $courses = $courses->public();
        }

        return $courses->count();
    }

    /**
     * @param bool $objects
     * @param null $status
     * @return mixed
     */
    public function getTagsList($objects = false, $status = null)
    {
        $tags = Tag::whereNotNull('id');

        if ($status) {
            $tags = $tags->where('status', $status);
        }

        if ($objects) {
            $tags = $tags->get();
        } else {
            $tags = $tags->pluck('name', 'id');
        }

        return $tags;
    }

    /**
     * @param Content $content
     * @return null
     */
    public function getContentFeaturedImage(Content $content)
    {
        if (!$content) {
            return null;
        }

        $media = Media::where('collection_name', 'featured-image')->where('model_id', $content->id)->first();

        if ($media) {
            return $media->getFullUrl();
        } elseif ($content->featured_image_link) {
            return url($content->featured_image_link);
        } else {
            return null;
        }
    }

    public function getLatestCourses($limit = 2)
    {
        $courses = Course::whereHas('categories', function ($categories) {
            $categories->where('status', 'active');
        });

        $courses = $courses->published();

        if (!user()) {
            $courses = $courses->public();
        }

        $courses = $courses->orderBy('published_at', 'desc')->take($limit)->get();

        return $courses;
    }

    public function getFrontendThemeTemplates()
    {
        $frontend_theme = \Settings::get('active_frontend_theme');
        $theme_views_path = \Theme::find($frontend_theme)->viewsPath;
        $templates = [];
        foreach (glob(themes_path($theme_views_path . '/templates/*.php')) as $template) {
            $template_key = basename(str_replace('.blade.php', '', $template));
            $templates[$template_key] = ucfirst($template_key);
        }
        return $templates;

    }

    public function getNotAvailableCategories()
    {
        if (isSuperUser()) {
            return [];
        }
        $not_available_categories = [];
        if (\Modules::isModuleActive('developnet-subscriptions')) {

            $categories = Category::all();
            $not_available_categories = [];
            foreach ($categories as $category) {
                $subscription_plans = $category->subscribable_plans;
                if ($subscription_plans) {
                    foreach ($subscription_plans as $subscription_plan) {
                        if (!user() || !user()->subscriptions->contains($subscription_plan->id)) {
                            $not_available_categories [] = $category->id;

                        }
                    }
                }
            }
        }
        return $not_available_categories;
    }

    public function leatestCourses(){

        $courses = Course::where('status',true)->orderBy('created_at', 'desc')->take(8);
        return $courses;

    }
    public function leatestQuizzes(){

        $quizzes =Quiz::where([['status','=','1'],['is_standlone','=','1']])->orderBy('created_at', 'des')->take(4);

        return $quizzes;

    }


     public function codeGenerator($number = 14, $int = true ,$prefix = null, $suffix = null){

        if($number < 7){
            $number = 7;
        }

        if(!$int){
            $subCode = str_shuffle(str_repeat(uniqid(), 100));
        }else{
            $subCode = str_shuffle(str_repeat(hexdec(user()->id.uniqid().user()->id), 100));

        }
 

         $code = $prefix.substr($subCode, 0, $number).$suffix;

         return  $code;

     }

        public function getModuleData($module, $module_id){

     $module_data = null;
      
      if($module == 'course'){

       

        $module_data = Course::find($module_id);
      }

      if($module == 'quiz'){

        $module_data = Quiz::find($module_id);
      }

       if($module == 'plan'){

        $module_data = Plan::find($module_id);
      }

    if($module == 'book'){

        $module_data = Book::find($module_id);
      }

         return $module_data;

     }


    public function getRemainTime($duration = null, $startTime = null){
$remainTime = 0;
if(!empty($startTime)){
    $createdTime = $startTime;
    $finishTime = $createdTime->addMinutes($duration);
    if($finishTime > Carbon::now()){
         $remainTime =  $finishTime->diffInMinutes(Carbon::now());
    }else{
        $remainTime = 0;
    }
}
// dd($remainTime);

         return $remainTime;

     }


  public function getEmbededLink($link, $embeded_code = false){
     $parsed = parse_url($link);

        $scheme= isset($parsed['scheme'])?$parsed['scheme']:null;
        $host= isset($parsed['host'])?$parsed['host']:null;
        $path= isset($parsed['path'])?$parsed['path']:null;
        $query= isset($parsed['query'])?$parsed['query']:null;

        $previewLink = '/';

        if (strpos($host, 'youtube') !== false){
            if(strpos($path, 'embed') !== false){

          $previewLink = $link;
          return ['link' => $previewLink, 'type' => 'youtube'];
            }else{
                $queries = array();
              parse_str($query, $queries);
              $video_id = $queries['v'];
        $previewLink = 'https://www.youtube.com/embed/'.$video_id.'?rel=0&amp;showinfo=0';
        return ['link' => $previewLink, 'type' => 'youtube'];

            }
        }elseif (strpos($host, 'youtu.be') !== false) {
        $video_id = str_replace("/","", $path);

            $previewLink = $previewLink = 'https://www.youtube.com/embed/'.$video_id.'?rel=0&amp;showinfo=0;';
        return ['link' => $previewLink, 'type' => 'youtube'];

        }elseif (strpos($host, 'vimeo') !== false) {
            if(strpos($path, 'video') !== false){
                $previewLink = $link;
        return ['link' => $previewLink, 'type' => 'vimeo'];
    
            }else{
                 $video_id = str_replace("/","", $path);

                 $previewLink = 'https://player.vimeo.com/video/'.$video_id; 
             return ['link' => $previewLink, 'type' => 'vimeo'];   

            }
              
           
        }elseif (strpos($host, 'drive.google') !== false){

            if(strpos($host, 'preview') !== false){
                $previewLink = $link;
                return ['link' => $previewLink, 'type' => 'drive']; 
            }else{

        $searchReplaceArray = ['file/d/' => '', '/' => '', 'view' => '', 'edit' => '', 'presentation' => '', 'document' => '', '/d/' => ''];  

        $video_id = str_replace(array_keys($searchReplaceArray), array_values($searchReplaceArray),$path);
            $previewLink = 'https://drive.google.com/file/d/'.$video_id.'/preview';
             return ['link' => $previewLink, 'type' => 'drive'];

            }

         

        }elseif (strpos($host, 'docs.google') !== false){
            if(strpos($host, 'preview') !== false){
                $previewLink = $link;
            return ['link' => $previewLink, 'type' => 'docs_google'];
            }else{
                
              $searchReplaceArray = ['file/d/' => '', '/' => '', 'view' => '', 'edit' => '', 'presentation' => '', 'document' => '', '/d/' => ''];  

        $video_id = str_replace(array_keys($searchReplaceArray), array_values($searchReplaceArray),$path);
            $previewLink = 'https://drive.google.com/file/d/'.$video_id.'/preview';
            return ['link' => $previewLink, 'type' => 'docs_google'];

            }
            

        }else{
            $previewLink = $link;
        return ['link' => $previewLink, 'type' => 'others'];
        }
 return ['link' => $previewLink, 'type' => 'error'];

     }


    public function profilePermissions($profileUser, $action){
        
        if(!Auth::check()){
            return false;
        }

        $user = user();

        if($profileUser->id == $user->id){
            return true;
        }


        if($user->can($action)){
            return true;
        }

         return false;

     }   


public function getCertificateData($certificate, $template){

    $module_type = $certificate->certificatable_type;
    $module_data = null;

    if($module_type == 'course'){
      $module_data = Course::find($certificate->certificatable_id);
    }

   if($module_type == 'quiz'){
      $module_data  = Quiz::find($certificate->certificatable_id);
    }


    if(!countData($module_data)){
      return ['success' => false, 'content' => null];
    }

    $logs_data = StudentLogs::find($certificate->log_id);


   if(!countData($logs_data)){
      return ['success' => false, 'content' => null];
    }

    $student = User::find($certificate->user_id);


  if(!countData($student)){
      return ['success' => false, 'content' => null];
    }

   $teacher = User::find($module_data->author_id);

  if(!countData($teacher)){
      return ['success' => false, 'content' => null];
    }



    $replaced_array = [
           'c_student_name' => $student->name,
            'c_teacher_name' => $teacher->name,
            'c_matrial_name' => $module_data->title,
            'c_pass_date' => Carbon::createFromFormat('Y-m-d H:i:s', $logs_data->finished_at)->format('Y-m-d'),
                                               
            'c_enroll_date' => Carbon::createFromFormat('Y-m-d H:i:s', $logs_data->created_at)->format('Y-m-d'),
            'c_student_degree' => $logs_data->degree,
            'c_passing_degree' => $logs_data->passing_grade,
            'c_student_grade' => \Logs::student_grade($logs_data->degree),
    ];




    if(!$template->content){

        return ['success' => false, 'content' => null];
    }

    $new_content = str_replace(array_keys($replaced_array), array_values($replaced_array),$template->content);


    return ['success' => false, 'content' => $new_content];


     }


    public function setGeneralPagesSeo($key, $url = null, $image = null, $type = null){

        $site_name = \Settings::get('site_name', 'الرابح');
        $titles = \Settings::get('site_meta_titles', []);
        $page_title = isset($titles[$key])?$titles[$key]:$site_name;
        $meta_keywords = \Settings::get('site_meta_keywords', []);
        $page_meta_keywords = isset($meta_keywords[$key])?$meta_keywords[$key]:$site_name;
        $meta_descriptions = \Settings::get('site_meta_descriptions', []);
        $page_meta_description = isset($meta_descriptions[$key])?$meta_descriptions[$key]:$site_name;
        

        $item = [
            'title' => $page_title,
            'meta_description' =>  str_limit(strip_tags($page_meta_description), 500),
            'url' => $url,
            'type' => $type,
            'image' => $image?:\Settings::get('site_logo'),
            'meta_keywords' =>  $page_meta_keywords
        ];

        $this->setSEO((object)$item);

}

    public function setGeneralPagesTitle($key, $url = null){

        $site_name = \Settings::get('site_name', 'الرابح');
        $titles = \Settings::get('site_pages_titles', []);
        $page_title = isset($titles[$key])?$titles[$key]:$site_name;


        return $page_title;

}


     
}