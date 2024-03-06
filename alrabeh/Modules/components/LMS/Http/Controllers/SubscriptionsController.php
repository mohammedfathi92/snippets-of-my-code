<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\SubscriptionsDataTable;
use Modules\Components\LMS\Http\Requests\SubscriptionRequest;
use Modules\Components\LMS\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.subscription.resource_url');
        $this->title = 'LMS::module.subscription.title';
        $this->title_singular = 'LMS::module.subscription.title_singular';

        parent::__construct();
    }

    /**
     * @param SubscriptionRequest $request
     * @param SubscriptionsDataTable $dataTable
     * @return mixed
     */
    public function index(SubscriptionRequest $request, SubscriptionsDataTable $dataTable)
    {
        return $dataTable->render('LMS::subscriptions.index');
    }

    /**
     * @param SubscriptionRequest $request
     * @return $this
     */
    public function create(SubscriptionRequest $request)
    {
        $subscription = new Subscription();

        $session_id = \LMS::codeGenerator(8, true ,'sub_',user()->hashed_id);



        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::subscriptions.create_edit')->with(compact('subscription', 'session_id'));
    }


        /**
     * @param SubscriptionRequest $request
     * @return $this
     */
    public function change_status(SubscriptionRequest $request, Subscription $subscription)
    {

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::subscriptions.partials.change_status')->with(compact('subscription'));
    }

    /**
     * @param SubscriptionRequest $request
     * @return $this
     */
    public function update_status(Request $request, $hashed_id)
    {
         if (!user()->hasPermissionTo('LMS::subscription.update')) {
           return abort(403);
        }

        $this->validate($request, ['status' => 'required']);

        try {
        $data = $request->all();
        $id = hashids_decode($hashed_id);

        $subscription = Subscription::find($id);

        $subscription->update([
                'status' => $data['status'],
               
            ]);



     flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Subscription::class, 'update');
        }

                return redirectTo($this->resource_url);

    }

    /**
     * @param SubscriptionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SubscriptionRequest $request)
    {
        try {

            $data = $request->except(['thumbnail', 'plan', 'course', 'quiz']);
            $subscription = Subscription::create($data);
            if ($request->hasFile('thumbnail')) {
                $course->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($subscription->mediaCollectionName);
                   }

            $subscription->categories()->sync($request->input('categories', []));
            $subscription->courses()->sync($request->input('courses', []));
            $subscription->quizzes()->sync($request->input('quizzes', []));

            $tags = $this->getTags($request);

            $subscription->tags()->sync($tags);


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Subscription::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param SubscriptionRequest $request
     * @param Subscription $subscription
     * @return $this
     */
    public function show(SubscriptionRequest $request, Subscription $subscription)
    {
        return redirect('admin-preview/' . $subscription->slug);
    }


    /**
     * @param SubscriptionRequest $request
     * @param Subscription $subscription
     * @return $this
     */
    public function edit(SubscriptionRequest $request, Subscription $subscription)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $subscription->title])]);

        return view('LMS::subscriptions.create_edit')->with(compact('subscription'));
    }

    /**
     * @param SubscriptionRequest $request
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        try {
        $data = $request->except(['thumbnail', 'plan', 'course', 'quiz', 'clear']);

            // $data['author_id'] = user()->id;
            $subscription->update($data);

           if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $subscription->clearMediaCollection('thumbnail');
            }

           if ($request->hasFile('thumbnail')) {
                $subscription->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($subscription->mediaCollectionName);
                   }

           $subscription->categories()->sync($request->input('categories', []));
            $subscription->courses()->sync($request->input('courses', []));
            $subscription->quizzes()->sync($request->input('quizzes', []));

            $tags = $this->getTags($request);

            $subscription->tags()->sync($tags);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Subscription::class, 'update');
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
     * @param SubscriptionRequest $request
     * @param Subscription $subscription
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SubscriptionRequest $request, Subscription $subscription)
    {
        try {
            $subscription->clearMediaCollection('featured-image');
            $subscription->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Subscription::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}