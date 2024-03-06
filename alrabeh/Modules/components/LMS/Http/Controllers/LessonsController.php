<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\LessonsDataTable;
use Modules\Components\LMS\Http\Requests\LessonRequest;
use Modules\Components\LMS\Models\Lesson;
use Modules\Components\LMS\Models\Tag;

class LessonsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.lesson.resource_url');
        $this->title = 'LMS::module.lesson.title';
        $this->title_singular = 'LMS::module.lesson.title_singular';

        parent::__construct();
    }

    /**
     * @param LessonRequest $request
     * @param LessonsDataTable $dataTable
     * @return mixed
     */
    public function index(LessonRequest $request, LessonsDataTable $dataTable)
    {
        return $dataTable->render('LMS::lessons.index');
    }

    /**
     * @param LessonRequest $request
     * @return $this
     */
    public function create(LessonRequest $request)
    {
        $lesson = new Lesson();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::lessons.create_edit')->with(compact('lesson'));
    }

    /**
     * @param LessonRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(LessonRequest $request)
    {
        try {
          $checks = ['preview' => $request->preview?:0, 'allow_comments' => $request->allow_comments?:0];

           $request->merge($checks);

            $data = $request->except(['thumbnail', 'categories', 'tags']);

            // $data['author_id'] = user()->id;

            $lesson = Lesson::create($data);

           if ($request->hasFile('thumbnail')) {
                $lesson->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($lesson->mediaCollectionName);
                   }


            $lesson->categories()->sync($request->input('categories', []));

            $tags = $this->getTags($request);

            $lesson->tags()->sync($tags);


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Lesson::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param LessonRequest $request
     * @param Lesson $lesson
     * @return $this
     */
    public function show(LessonRequest $request, Lesson $lesson)
    {
        return redirect('admin-preview/' . $lesson->slug);
    }


    /**
     * @param LessonRequest $request
     * @param Lesson $lesson
     * @return $this
     */
    public function edit(LessonRequest $request, Lesson $lesson)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $lesson->title])]);

        return view('LMS::lessons.create_edit')->with(compact('lesson'));
    }

    /**
     * @param LessonRequest $request
     * @param Lesson $lesson
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(LessonRequest $request, Lesson $lesson)
    {
        try {

          $checks = ['preview' => $request->preview?:0, 'allow_comments' => $request->allow_comments?:0];

           $request->merge($checks);

          $data = $request->except(['thumbnail', 'clear', 'categories', 'tags']);

            // $data['author_id'] = user()->id;
            $lesson->update($data);

            if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $lesson->clearMediaCollection('thumbnail');
            }

           if ($request->hasFile('thumbnail')) {
                $lesson->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($lesson->mediaCollectionName);
                   }

            $lesson->categories()->sync($request->input('categories', []));

            $tags = $this->getTags($request);

            $lesson->tags()->sync($tags);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Lesson::class, 'update');
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
     * @param LessonRequest $request
     * @param Lesson $lesson
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(LessonRequest $request, Lesson $lesson)
    {
        try {
            $lesson->clearMediaCollection('featured-image');
            $lesson->studentLogs()->delete();

            $lesson->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Lesson::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}