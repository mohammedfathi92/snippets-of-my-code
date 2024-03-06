<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\CategoriesDataTable;
use Modules\Components\LMS\Http\Requests\CategoryRequest;
use Modules\Components\LMS\Models\Category;

class CategoriesController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->resource_url = config('lms.models.category.resource_url');
        $this->title = 'LMS::module.category.title';
        $this->title_singular = 'LMS::module.category.title_singular';


    }

    /**
     * @param CategoryRequest $request
     * @param CategoriesDataTable $dataTable
     * @return mixed
     */
    public function index(CategoryRequest $request, CategoriesDataTable $dataTable)
    {

        return $dataTable->render('LMS::categories.index');
    }

    /**
     * @param CategoryRequest $request
     * @return $this
     */
    public function create(CategoryRequest $request)
    {
        $category = new Category();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::categories.create_edit')->with(compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        try {


            $data = $request->except('subscription_plans', 'thumbnail', 'quizzes', 'courses', 'books');

            $category = Category::create($data);



                 if ($request->hasFile('thumbnail')) {
                $category->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($category->mediaCollectionName);
                   }

            $category->courses()->sync($request->input('courses', []));
            $category->quizzes()->sync($request->input('quizzes', []));
            $category->books()->sync($request->input('books', []));



            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Category::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return Category
     */
    public function show(CategoryRequest $request, Category $category)
    {
        return $category;
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return $this
     */
    public function edit(CategoryRequest $request, Category $category)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $category->name])]);


        return view('LMS::categories.create_edit')->with(compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->except('subscription_plans', 'thumbnail','quizzes', 'courses', 'clear', 'books');



            $category->update($data);




              if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $category->clearMediaCollection($category->mediaCollectionName);
            }


           if ($request->hasFile('thumbnail')) {
                $category->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($category->mediaCollectionName);
                   }
            $category->quizzes()->sync($request->input('quizzes', []));
            $category->books()->sync($request->input('books', []));        
            $category->courses()->sync($request->input('courses', []));
      




            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Category::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CategoryRequest $request, Category $category)
    {
        try {
            $category->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Category::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}
