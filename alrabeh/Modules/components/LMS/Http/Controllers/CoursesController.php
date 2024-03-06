<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\CoursesDataTable;
use Modules\Components\LMS\Http\Requests\CourseRequest;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Section;
use Modules\Components\LMS\Models\Lesson;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Tag;

class CoursesController extends BaseController
{
 
    public function __construct()
    {
        $this->resource_url = config('lms.models.course.resource_url');
        $this->title = 'LMS::module.course.title';
        $this->title_singular = 'LMS::module.course.title_singular';
        parent::__construct();

    }



    /**
     * @param CourseRequest $request
     * @param CoursesDataTable $dataTable
     * @return mixed
     */
    public function index(CourseRequest $request, CoursesDataTable $dataTable)
    {
        return $dataTable->render('LMS::courses.index');
    }

    /**
     * @return $this
     */
    public function create()
    {
        $course = new Course();
        $course_session_id = \LMS::codeGenerator(5, true ,'course_',user()->hashed_id);

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::courses.create_edit')->with(compact('course', 'course_session_id'));
    }

    /**
     * @param CourseRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CourseRequest $request)
    {
        try {
            
           $checks = ['is_featured' => $request->is_featured?:0,'pagination_lessons' => $request->pagination_lessons?:0, 'block_lessons' => $request->block_lessons?:0, 'allow_comments' => $request->allow_comments?:0];
           $auther = $request->author_id?:user()->id;

           $request->merge(['author_id' =>$auther]);
           $request->merge($checks);

            $data = $request->except(['thumbnail', 'categories', 'tags', 'sections','sectionItems','course_item_title','lessons', 'quizzes', 'course_session_id', 'is_private_lesson', 'is_private_quiz']);

            

            $course = Course::create($data);


            $sectionIds = []; 
            $sectionOrders = [];

            foreach ($request->get('sections', []) as $sectionOrder => $sectionId) {

                $sectionIds[] = $sectionId; 
                $sectionOrders[] = ['order' => $sectionOrder];

                $lessonsIds    = []; 
                $lessonsOrders = [];
                $quizzesIds    = []; 
                $quizzesOrders = [];
           

                $section = Section::find($sectionId);

                if(!$section){
                    return redirect()->back();
                }
                $section->course_id = $course->id;
                $section->order = $sectionOrder;
                $section->save();
    
            foreach ($request->input('sectionItems.'.$sectionId, []) as $inputKey => $inputValue) {
              $itemId = (int)preg_replace('/[^0-9.]+/', '', $inputValue);      

             if( strpos( $inputValue, 'lesson') !== false ){
                $is_private = $request->input('is_private_lesson.'.$itemId);
                $lessonsIds[] = $itemId; 
                $lessonsOrders[] = ['order' => $inputKey, 'type' => 'lesson', 'is_private' => $is_private, 'course_id' => $course->id];
             

             }else{
                 $is_private = $request->input('is_private_quiz.'.$itemId);

                $quizzesIds[] = $itemId; 
                $quizzesOrders[] = ['order' => $inputKey, 'type' => 'quiz', 'is_private' => 1, 'course_id' => $course->id];


             }   



                }



           $section->lessons()->sync(array_combine($lessonsIds, $lessonsOrders));

        

            $section->quizzes()->sync(array_combine($quizzesIds, $quizzesOrders));

                
            } 

              if ($request->hasFile('thumbnail')) {
                $course->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($course->mediaCollectionName);
                   }

            $course->categories()->sync($request->input('categories', []));

            $course->lessons()->sync($request->input('lessons', []));

            $course->quizzes()->sync($request->input('quizzes', []));


            $tags = $this->getTags($request);

            $course->tags()->sync($tags);

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Course::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CourseRequest $request
     * @param Course $course
     * @return $this
     */
    public function show(CourseRequest $request, Course $course)
    {
        return redirect('admin-preview/' . $course->slug);
    }

    /**
     * @param CourseRequest $request
     * @param Course $course
     * @return $this
     */
    public function edit(CourseRequest $request, Course $course)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $course->title])]);
        $course_session_id = \LMS::codeGenerator(5, true ,'course_'.$course->hashed_id,user()->hashed_id);

        $items = [];
        foreach ($course->lessons()->pluck('lms_lessons.id')->toArray() as $id) {
           $items[] = array_merge($items, ['type'=> 'lesson', 'id'=> $id]);
        }

        foreach ($course->quizzes()->pluck('lms_quizzes.id')->toArray() as $id) {
           $items[] = array_merge($items, ['type'=> 'quiz', 'id'=> $id]);
        }

        session()->put('course_session_'.$course_session_id, ['items' => $items]);



        return view('LMS::courses.create_edit')->with(compact('course', 'course_session_id'));
    }
 
    /**
     * @param CourseRequest $request
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CourseRequest $request, Course $course)
    {
        try {


           $checks = ['is_featured' => $request->get('is_featured')?true:false, 'block_lessons' => $request->get('block_lessons')?true:false, 'allow_comments' => $request->get('allow_comments')?true:false, 'pagination_lessons' => $request->pagination_lessons?:0,]; 

                      $auther = $request->author_id?:user()->id;
           
           $request->merge(['author_id' =>$auther]);
           $request->merge($checks);

            $data = $request->except(['thumbnail', 'categories', 'clear', 'tags', 'sections','sectionItems','course_item_title','lessons', 'quizzes', 'course_session_id', 'is_private_lesson', 'is_private_quiz']);




            $course->update($data);

            $sectionIds = []; 
            $sectionOrders = [];

    $private_lessons_arry = $request->input('is_private_lesson');
    $private_quizzes_arry = $request->input('is_private_quiz');

            foreach ($request->get('sections', []) as $sectionOrder => $sectionId) {

                $sectionIds[] = $sectionId; 
                $sectionOrders[] = ['order' => $sectionOrder];

                $lessonsIds    = []; 
                $lessonsOrders = [];
                $quizzesIds    = []; 
                $quizzesOrders = [];

                $section = Section::find($sectionId);

                if(!$section){
                    return redirect()->back();
                }
                $section->course_id = $course->id;
                $section->order = $sectionOrder;
                $section->save();
    
            foreach ($request->input('sectionItems.'.$sectionId, []) as $inputKey => $inputValue) {
              $itemId = (int)preg_replace('/[^0-9.]+/', '', $inputValue);      

             if( strpos( $inputValue, 'lesson') !== false ){

            $is_private = isset($private_lessons_arry[$itemId])?$private_lessons_arry[$itemId]:0;
                
                $lessonsIds[] = $itemId; 
                 $lessonsOrders[] = ['order' => $inputKey, 'type' => 'lesson','is_private' => $is_private];

             }else{

            $is_private = isset($private_quizzes_arry[$itemId])?$private_quizzes_arry[$itemId]:0;

                $quizzesIds[] = $itemId; 
                $quizzesOrders[] = ['order' => $inputKey, 'type' => 'quiz','is_private' => 1];


             }   



                }



           $section->lessons()->sync(array_combine($lessonsIds, $lessonsOrders));

           $section->quizzes()->sync(array_combine($quizzesIds, $quizzesOrders));

                
            } 
             $course->lessons()->sync($request->input('lessons', []));

            $course->quizzes()->sync($request->input('quizzes', []));
 


              if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $course->clearMediaCollection($course->mediaCollectionName);
            }

           if ($request->hasFile('thumbnail')) {
                $course->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($course->mediaCollectionName);
                   }

            $course->categories()->sync($request->input('categories', []));

            $tags = $this->getTags($request);

            $course->tags()->sync($tags);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Course::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    private function getTags($request)
    {
        $tags = [];

        $requestTags = $request->get('tags', []);

        foreach ($requestTags as $tag) {
            if (is_numeric($tag)) {
                array_push($tags, $tag);
            } else {
                try {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);

                    array_push($tags, $newTag->id);
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        return $tags;
    }

    /**
     * @param CourseRequest $request
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CourseRequest $request, Course $course)
    {
        try {
            $course->clearMediaCollection('featured-image');
            $course->studentLogs()->delete();

            $course->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Course::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}