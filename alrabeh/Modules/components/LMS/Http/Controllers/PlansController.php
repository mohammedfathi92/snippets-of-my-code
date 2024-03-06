<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\PlansDataTable;
use Modules\Components\LMS\Http\Requests\PlanRequest;
use Modules\Components\LMS\Models\Plan;

class PlansController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.plan.resource_url');
        $this->title = 'LMS::module.plan.title';
        $this->title_singular = 'LMS::module.plan.title_singular';

        parent::__construct();
    }

    /**
     * @param PlanRequest $request
     * @param PlansDataTable $dataTable
     * @return mixed
     */
    public function index(PlanRequest $request, PlansDataTable $dataTable)
    {
        return $dataTable->render('LMS::plans.index');
    }

    /**
     * @param PlanRequest $request
     * @return $this
     */
    public function create(PlanRequest $request)
    {
        $plan = new Plan();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::plans.create_edit')->with(compact('plan'));
    }

    /**
     * @param PlanRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PlanRequest $request)
    {
        try {
            $checks = ['is_featured' => $request->is_featured?:0];
            $request->merge($checks);

            $data = $request->except(['thumbnail', 'categories', 'quizzes', 'courses', 'tags', 'books','parent_categories']);

            // $data['author_id'] = user()->id;
 
            $plan = Plan::create($data);

            if ($request->hasFile('thumbnail')) {
                $plan->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($plan->mediaCollectionName);
                   }


            $plan->parent_categories()->sync($request->input('parent_categories', []));     

            $plan->categories()->sync($request->input('categories', []));
            $plan->courses()->sync($request->input('courses', []));
            $plan->quizzes()->sync($request->input('quizzes', []));
            $plan->books()->sync($request->input('books', []));

            $tags = $this->getTags($request);

            $plan->tags()->sync($tags);


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Plan::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param PlanRequest $request
     * @param Plan $plan
     * @return $this
     */
    public function show(PlanRequest $request, Plan $plan)
    {
        return redirect('admin-preview/' . $plan->slug);
    }


    /**
     * @param PlanRequest $request
     * @param Plan $plan
     * @return $this
     */
    public function edit(PlanRequest $request, Plan $plan)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $plan->title])]);

        return view('LMS::plans.create_edit')->with(compact('plan'));
    }

    /**
     * @param PlanRequest $request
     * @param Plan $plan
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        try {
            $checks = ['is_featured' => $request->is_featured?:0];
            $request->merge($checks);
        $data = $request->except(['thumbnail', 'categories', 'quizzes', 'courses', 'tags', 'clear', 'books','parent_categories']);

            // $data['author_id'] = user()->id;
            $plan->update($data);

           if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $plan->clearMediaCollection($plan->mediaCollectionName);
            }

           if ($request->hasFile('thumbnail')) {
                $plan->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($plan->mediaCollectionName);
                   }


            $plan->parent_categories()->sync($request->input('parent_categories', []));     
            $plan->categories()->sync($request->input('categories', []));
            $plan->courses()->sync($request->input('courses', []));
            $plan->quizzes()->sync($request->input('quizzes', []));
            $plan->books()->sync($request->input('books', []));

            $tags = $this->getTags($request);

            $plan->tags()->sync($tags);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Plan::class, 'update');
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
     * @param PlanRequest $request
     * @param Plan $plan
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PlanRequest $request, Plan $plan)
    {
        try {
            $plan->clearMediaCollection('featured-image');
            $plan->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Plan::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}
