<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\SourcesDataTable;
use Packages\Modules\ERP\Http\Requests\SourceRequest;
use Packages\Modules\ERP\Models\Source;

class SourcesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.source.resource_url');

        $this->title = 'ERP::module.source.title';
        $this->title_singular = 'ERP::module.source.title_singular';

        parent::__construct();
    }

    /**
     * @param SourceRequest $request
     * @param SourcesDataTable $dataTable
     * @return mixed
     */
    public function index(SourceRequest $request, SourcesDataTable $dataTable)
    {
        return $dataTable->render('ERP::sources.index');
    }

    /**
     * @param SourceRequest $request
     * @return $this
     */
    public function create(SourceRequest $request)
    {
        $source = new Source();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::sources.create_edit')->with(compact('source'));
    }

    /**
     * @param SourceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SourceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $source = Source::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Source::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param SourceRequest $request
     * @param Source $source
     * @return Source
     */
    public function show(SourceRequest $request, Source $source)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $source->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Source->hashed_id . '/edit']);

        return view('ERP::sources.show')->with(compact('source'));
    }

    /**
     * @param SourceRequest $request
     * @param Source $source
     * @return $this
     */
    public function edit(SourceRequest $request, Source $source)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $source->name])]);

        return view('ERP::sources.create_edit')->with(compact('source'));
    }

    /**
     * @param SourceRequest $request
     * @param Source $source
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SourceRequest $request, Source $source)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $source->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Source::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param SourceRequest $request
     * @param Source $source
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SourceRequest $request, Source $source)
    {
        try {
            $source->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Source::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}