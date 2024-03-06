<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Components\CMS\Traits\SEOTools;
use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Lesson;
use Modules\Components\LMS\Models\Logs as StudentLogs;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\UserLMS;
use Modules\Foundation\Http\Controllers\PublicBaseController;
use Validator;

class CoursesController extends PublicBaseController
{
    use SEOTools;

    function index()
    {

        $page_title = \LMS::setGeneralPagesTitle('courses');

        \LMS::setGeneralPagesSeo('courses', route('courses.index'), null, 'courses');

        // all courses
        $courses = Course::where('status', 1)->paginate(10);


        return view('courses.index')->with(compact('courses', 'page_title'));


    }

    function show($hashed_id)
    {

        $id = hashids_decode($hashed_id);

        $course = Course::find($id);

        $response = \Logs::isCoursePassed(Auth::user(), $course);


        if (!$course) {
            abort(404);
        }

        $page_title = $course->title;
        $item = [
            'title'            => $course->title,
            'meta_description' => str_limit(strip_tags($course->meta_description), 500),
            'url'              => route('courses.show', $course->hashed_id),
            'type'             => 'course',
            'image'            => $course->thumbnail,
            'meta_keywords'    => $course->meta_keywords
        ];

        $this->setSEO((object)$item);

        $courseSections = $course->sections();
        $user = null;
        $subscriptionStatus = false;
        $enroll_status = false;

        /*******  Related Courses*********/
        $relatedIds = $course->categories->pluck('id')->toArray();
        $relatedCourses = Course::whereHas('categories', function ($q) use ($relatedIds) {
            $q->whereIn('id', $relatedIds);
        })->where('status', '=', '1')->where('id', '!=', $id);

        if (!Auth::check()) {
            return view('courses.show')->with(compact('course',
                'courseSections',
                'subscriptionStatus',
                'relatedCourses', 'page_title'
            ));
        }


        $user = UserLMS::find(Auth()->id());

        $moduleArray = [
            'module'    => 'course',
            'module_id' => $id,
            'user'      => $user,
            'parent'    => [],

        ];

        $subscriptionStatus = \Subscriptions::check_subscription($moduleArray);

        if ($subscriptionStatus['success'] && $subscriptionStatus['status'] > 0) {
            \Logs::enroll($moduleArray);

        }


        return view('courses.show')->with(compact('course',
            'courseSections',
            'subscriptionStatus',
            'relatedCourses'
        ));

    }

    function categories()
    {

        $page_title = \LMS::setGeneralPagesTitle('categories');

        \LMS::setGeneralPagesSeo('categories', route('categories.index'), null, 'categories');

        $categories = category::where('status', '=', 'active')->where('parent_id', null)->get();


        return view('courses.categories')->with(compact('categories', 'page_title'));


    }

    function category($category_hashed_id)
    {

        $id = hashids_decode($category_hashed_id);

        $category = Category::find($id);
        if(!$category){
            return abort(404);
        }

        $child_categories = Category::where('parent_id',$id)->get();

        $page_title = $category->name;
        $item = [
            'title'            => $category->name,
            'meta_description' => str_limit(strip_tags($category->meta_description), 500),
            'url'              => route('courses.show', $category->hashed_id),
            'type'             => 'course',
            'image'            => $category->thumbnail,
            'meta_keywords'    => $category->meta_keywords
        ];

        $this->setSEO((object)$item);

        $plans = $category->child_plans()->where('status', true)->paginate(6, ['*'], 'packages');

        $courses = $category->courses()->where('status', true)->paginate(5, ['*'], 'courses');

        $quizzes = $category->quizzes()->where([['status', true], ['is_standlone', true]])->paginate(5, ['*'], 'quizzes');

        $books = $category->books()->where('status', true)->paginate(5, ['*'], 'books');


        return view('courses.category')->with(compact('courses', 'quizzes', 'page_title'
        , 'category','child_categories', 'books', 'plans'));
    }

    function lesson_completed(Request $request, $course_hashed_id, $lesson_hashed_id)
    {

        $course_id = hashids_decode($course_hashed_id);
        $lesson_id = hashids_decode($lesson_hashed_id);

        if (!Auth::check()) {
            return abort(404);
        }

        $user = UserLMS::find(Auth()->id());

        // check course [parent] Subscribtion
        // check course [parent] enrolls
        // check completed lessons before this
        //check retake number if quiz or course

        $moduleArray = [
            'module'    => 'lesson',
            'module_id' => $lesson_id,
            'user'      => $user,
            'parent'    => [
                'type' => 'course',
                'id'   => $course_id
            ],

        ];


        $lesson = Lesson::find($lesson_id);
        if (!$lesson) {
            abort(404);
        }

        $course = Course::find($course_id);
        if (!$course) {
            abort(404);
        }

        $response = \Logs::markAsCompleted(0, 1, $moduleArray);
        if ($response['success']) {
            $alert_type = 'success';
        } else {
            $alert_type = 'danger';
        }

        return redirect()->back()->with(['message' => $response['message'], 'alert_type' => $alert_type]);


    }

    function showCourseResults($course_hashed_id)
    {
        $course_id = hashids_decode($course_hashed_id);

        $user = UserLMS::findOrFail(Auth()->id());
        $course = Course::findOrFail($course_id);
        $page_title = __('LMS::frontend.course_results');


        //check if course subscribed

        $subscriptionStatus = \Subscriptions::check_subscription([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);


        if (!$subscriptionStatus['success'] && $subscriptionStatus['status'] < 1) {
            return redirect()->back()->with(['message' => 'LMS::messages.course_subscription_items_error', 'alert_type' => 'danger']);
        }

        $courseLogs = \Logs::currentItemLog([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);

        // $enrollStatus = \Logs::enroll_status($moduleArray);
        $courseSections = $course->sections();

        $courseProgress = \Logs::isCoursePassed($user, $course);


        return view('courses.results')->with(compact('course', 'courseLogs', 'courseSections', 'courseProgress', 'page_title'));

    }

    function markCourseAsCompleted(Request $request, $course_hashed_id)
    {
        //check if Lesson is privet or not
        if (!Auth::check()) {
            return abort(404);
        }

        $course_id = hashids_decode($course_hashed_id);

        $user = UserLMS::find(Auth()->id());
        $course = Course::find($course_id);
        if (!$course) {
            abort(404);
        }


        //check if course subscribed

        $subscriptionStatus = \Subscriptions::check_subscription([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);


        if (!$subscriptionStatus['success'] && $subscriptionStatus['status'] < 1) {
            return abort(404);
        }

        $courseLogs = \Logs::currentItemLog([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);

        $user = UserLMS::find(Auth()->id());
        // $enrollStatus = \Logs::enroll_status($moduleArray);
        $courseSections = $course->sections();
        // isCoursePassed ($user, $course, $condition = null)
        $courseProgress = \Logs::isCoursePassed($user, $course);

        $courseLogs->update(['status' => 1, 'finished_at' => Carbon::now()]);


        return redirect()->back()->with(['message' => 'LMS::messages.success_completed_course', 'alert_type' => 'success']);

    }

    function showLesson($course_hashed_id, $lesson_hashed_id)
    {

        $course_id = hashids_decode($course_hashed_id);
        $lesson_id = hashids_decode($lesson_hashed_id);


        //check if Lesson is privet or not
        if (!Auth::check()) {
            return redirectTo(route('login'));
        }

        $user = UserLMS::find(Auth()->id());

        // check course [parent] Subscribtion
        // check course [parent] enrolls
        // check completed lessons before this
        //check retake number if quiz or course

        $moduleArray = [
            'module'    => 'lesson',
            'module_id' => $lesson_id,
            'user'      => $user,
            'parent'    => [
                'type' => 'course',
                'id'   => $course_id
            ],

        ];

        $lesson = Lesson::find($lesson_id);
        if (!$lesson) {
            abort(404);
        }

        $course = Course::find($course_id);
        if (!$course) {
            abort(404);
        }

        $page_title = $lesson->title;
        $item = [
            'title'            => $lesson->title,
            'meta_description' => str_limit(strip_tags($lesson->meta_description), 500),
            'url'              => route('courses.show', $lesson->hashed_id),
            'type'             => 'course',
            'image'            => $lesson->thumbnail,
            'meta_keywords'    => $lesson->meta_keywords
        ];

        $this->setSEO((object)$item);

        $parentArray = [
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ];

        //check if course subscribed

        $subscriptionStatus = \Subscriptions::check_subscription([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);


        if (!$subscriptionStatus['success'] && $subscriptionStatus['status'] < 1) {
            return redirect()->back()->with(['message' => 'LMS::messages.cannot_show_page', 'alert_type' => 'danger']);
        }

        if ($subscriptionStatus['success'] && $subscriptionStatus['status'] > 0) {

            if ($course->pagination_lessons < 1) {

                $response = \Logs::can_enroll_course_item($moduleArray);
                if (!$response['success']) {

                    return redirect()->back()->with(['message' => 'LMS::messages.cannot_show_page', 'alert_type' => 'danger']);
                }

                $log = \Logs::enroll($moduleArray);

            } else {

                //check parent Log
                $enrollParentStatus = \Logs::enroll_status($parentArray);
                if ($enrollParentStatus['status'] > 1) {

                    return redirect()->back()->with(['message' => 'LMS::messages.cannot_show_page', 'alert_type' => 'danger']);

                }


            }

            $log = \Logs::enroll($moduleArray);

        }

        $enrollStatus = \Logs::enroll_status($moduleArray);

        $courseSections = $course->sections();

        $courseLogs = null;

        if (countData($enrollStatus['itemLog'])) {
            $courseLogs = $enrollStatus['itemLog']->parent;
        }

        return view('courses.lesson')->with(compact('course', 'lesson', 'courseSections', 'enrollStatus', 'courseLogs'));
    }

    public function retake_course(Request $request, $course_hashed_id)
    {

        if (!Auth::check()) {
            abort(404);
        }

        $user = UserLMS::find(Auth()->id());

        $course_id = hashids_decode($course_hashed_id);

        $user = UserLMS::find(Auth()->id());
        $course = Course::find($course_id);
        if (!$course) {
            abort(404);
        }

        if ($course->retake_count <= 1) {

            return redirect()->back()->with(['message' => __('LMS::messages.cannot_retake_course'), 'alert_type' => 'danger']);
        }


        //check if course subscribed

        $subscriptionStatus = \Subscriptions::check_subscription([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);


        if (!$subscriptionStatus['success'] && $subscriptionStatus['status'] < 1) {
            return redirect()->back()->with(['message' => 'LMS::messages.cannot_show_page', 'alert_type' => 'danger']);
        }

        $response = \Logs::enroll_status([
            'module'    => 'course',
            'module_id' => $course_id,
            'user'      => $user,
            'parent'    => []
        ]);

        if ($response['status'] != 1) {

            return redirect()->back()->with(['message' => 'LMS::messages.cannot_retake_course', 'alert_type' => 'danger']);

        }

        $courseLogs = $response['itemLog'];
        if (!countData($courseLogs)) {
            redirect()->back()->with(['message' => __('LMS::messages.something_happen'), 'alert_type' => 'danger']);
        }

        $counLogsTimes = $courseLogs->where('parent_id', null)->count();

        if ($counLogsTimes >= $course->retake_count) {
            return redirect()->back()->with(['message' => __('LMS::messages.cannot_retake_course'), 'alert_type' => 'danger']);
        }

        StudentLogs::Create([
            'user_id'           => $user->id,
            'lms_loggable_type' => 'course',
            'lms_loggable_id'   => $course->id,

        ]);

        return redirect()->route('courses.show', $course->hashed_id)->with(['message' => __('LMS::messages.success_process'), 'alert_type' => 'success']);


    }


}
