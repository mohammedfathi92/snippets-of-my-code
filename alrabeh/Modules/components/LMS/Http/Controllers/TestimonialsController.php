<?php

namespace Modules\Components\LMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\LMS\DataTables\TestimonialsDataTable;
use Modules\Components\LMS\Http\Requests\TestimonialRequest;
use Modules\Components\LMS\Models\Testimonial;
use Modules\Components\LMS\Models\Tag;

class TestimonialsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.testimonial.resource_url');
        $this->title = 'LMS::module.testimonial.title';
        $this->title_singular = 'LMS::module.testimonial.title_singular';

        parent::__construct();
    }

    /**
     * @param TestimonialRequest $request
     * @param TestimonialsDataTable $dataTable
     * @return mixed
     */
    public function index(TestimonialRequest $request, TestimonialsDataTable $dataTable)
    {
        return $dataTable->render('LMS::testimonials.index');
    }

    /**
     * @param TestimonialRequest $request
     * @return $this
     */
    public function create(TestimonialRequest $request)
    {
        $testimonial = new Testimonial();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('LMS::testimonials.create_edit')->with(compact('testimonial'));
    }

    /**
     * @param TestimonialRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TestimonialRequest $request)
    {
        try {


            $data = $request->except(['thumbnail']);

            // $data['author_id'] = user()->id;

            $testimonial = Testimonial::create($data);

           if ($request->hasFile('thumbnail')) {
                $testimonial->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($testimonial->mediaCollectionName);
                   }


            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Testimonial::class, 'created');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return $this
     */
    public function show(TestimonialRequest $request, Testimonial $testimonial)
    {
        return redirect('admin-preview/' . $testimonial->slug);
    }


    /**
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return $this
     */
    public function edit(TestimonialRequest $request, Testimonial $testimonial)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $testimonial->title])]);

        return view('LMS::testimonials.create_edit')->with(compact('testimonial'));
    }

    /**
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        try {

      

          $data = $request->except(['thumbnail', 'clear']);

            // $data['author_id'] = user()->id;
            $testimonial->update($data);

            if ($request->has('clear') || $request->hasFile('thumbnail')) {
                $testimonial->clearMediaCollection($testimonial->mediaCollectionName);
            }

           if ($request->hasFile('thumbnail')) {
                $testimonial->addMedia($request->file('thumbnail'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($testimonial->mediaCollectionName);
                   }

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Testimonial::class, 'update');
        }

        return redirectTo($this->resource_url);
    }




    /**
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TestimonialRequest $request, Testimonial $testimonial)
    {
        try {
            $testimonial->clearMediaCollection('featured-image');
            $testimonial->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Testimonial::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}