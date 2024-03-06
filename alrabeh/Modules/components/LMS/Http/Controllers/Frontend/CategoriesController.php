<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Components\CMS\Traits\SEOTools;
use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Plan;
use Modules\Foundation\Http\Controllers\PublicBaseController;
use Validator;

class CategoriesController extends PublicBaseController
{
    use SEOTools;

    function index()
    {

        $data['page_title'] = \LMS::setGeneralPagesTitle('categories');


        \LMS::setGeneralPagesSeo('categories', route('categories.index'), null, 'categories');

        // all categories
        $data['categories'] = Category::whereStatus(true)->paginate(10);
        $data['packages'] = Plan::where('status', 1)
            ->withCount('courses')
            ->withCount('quizzes')
            ->withCount('categories');
        return view('categories.index', $data);


    }

    function show($slug)
    {

        $category = Category::active()
            ->whereSlug($slug)
            ->with(["categories", "plans" => function ($q) {
                return $q->with(['quizzes', 'courses', 'books']);
            }, "quizzes", "courses", "books"])->first();

        if (!$category) {
            return abort(404);
        }

        $data['page_title'] = $category->name;
        $data['category'] = $category;
        // all plans
        return view('categories.show')->with($data);

    }
}
