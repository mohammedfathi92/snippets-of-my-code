<?php

namespace Modules\Components\Payments\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\Payments\DataTables\BarsDataTable;
use Modules\Components\Payments\Http\Requests\BarRequest;
use Modules\Components\Payments\Models\Bar;

class BarsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('payments.models.bar.resource_url');

        $this->title = 'Payments::module.bar.title';
        $this->title_singular = 'Payments::module.bar.title_singular';

        parent::__construct();
    }

    /**
     * @param BarRequest $request
     * @param BarsDataTable $dataTable
     * @return mixed
     */
    public function index(BarRequest $request, BarsDataTable $dataTable)
    {
        return $dataTable->render('Payments::conversations.index');
    }

    /**
     * @param BarRequest $request
     * @return $this
     */
    public function create(BarRequest $request)
    {
        $bar = new Bar();

        $this->setViewSharedData(['title_singular' => trans('Modules::labels.create_title', ['title' => $this->title_singular])]);

        return view('Payments::conversations.create_edit')->with(compact('bar'));
    }

    /**
     * @param BarRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BarRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $bar = Bar::create($data);

            flash(trans('Modules::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Bar::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BarRequest $request
     * @param Bar $bar
     * @return Bar
     */
    public function show(BarRequest $request, Bar $bar)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.show_title', ['title' => $bar->getIdentifier()])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $bar->hashed_id . '/edit']);

        return view('Payments::conversations.show')->with(compact('bar'));
    }

    /**
     * @param BarRequest $request
     * @param Bar $bar
     * @return $this
     */
    public function edit(BarRequest $request, Bar $bar)
    {
        $this->setViewSharedData(['title_singular' => trans('Modules::labels.update_title', ['title' => $bar->getIdentifier()])]);

        return view('Payments::conversations.create_edit')->with(compact('bar'));
    }

    /**
     * @param BarRequest $request
     * @param Bar $bar
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BarRequest $request, Bar $bar)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $bar->update($data);

            flash(trans('Modules::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Bar::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BarRequest $request
     * @param Bar $bar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BarRequest $request, Bar $bar)
    {
        try {
            $bar->delete();

            $message = ['level' => 'success', 'message' => trans('Modules::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Bar::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}
