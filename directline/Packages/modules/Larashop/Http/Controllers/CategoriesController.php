<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\DataTables\CategoriesDataTable;
use Packages\Modules\Larashop\Http\Requests\CategoryRequest;
use Packages\Modules\Larashop\Models\Category;

class CategoriesController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.category.resource_url');
        $this->title = 'Larashop::module.category.title';
        $this->title_singular = 'Larashop::module.category.title_singular';

        parent::__construct();
    }

    /**
     * @param CategoryRequest $request
     * @param CategoriesDataTable $dataTable
     * @return mixed
     */
    public function index(CategoryRequest $request, CategoriesDataTable $dataTable)
    {
        return $dataTable->render('Larashop::categories.index');
    }

    /**
     * @param CategoryRequest $request
     * @return $this
     */
    public function create(CategoryRequest $request)
    {
        $category = new Category();

        $this->setViewSharedData(['title_singular' =>trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('Larashop::categories.create_edit')->with(compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->except('thumbnail');

            $category = Category::create($data);

            if ($request->hasFile('thumbnail')) {
                $category->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($category->mediaCollectionName);
            }

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
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
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $category->name])]);

        return view('Larashop::categories.create_edit')->with(compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->except('thumbnail', 'clear');
            $data['is_featured'] = array_get($data, 'is_featured', false);

            $category->update($data);

            if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $category->clearMediaCollection($category->mediaCollectionName);
            }

            if ($request->hasFile('thumbnail') && !$request->has('clear')) {
                $category->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($category->mediaCollectionName);
            }

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
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
            $category->clearMediaCollection($category->mediaCollectionName);
            $category->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Category::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}