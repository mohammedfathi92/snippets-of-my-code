<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ServicesDataTable;
use Packages\Modules\ERP\Http\Requests\ServiceRequest;
use Packages\Modules\ERP\Models\Service;

class ServicesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.service.resource_url');

        $this->title = 'ERP::module.service.title';
        $this->title_singular = 'ERP::module.service.title_singular';

        parent::__construct();
    }

    /**
     * @param ServiceRequest $request
     * @param ServicesDataTable $dataTable
     * @return mixed
     */
    public function index(ServiceRequest $request, ServicesDataTable $dataTable)
    {
        return $dataTable->render('ERP::services.index');
    }

    /**
     * @param ServiceRequest $request
     * @return $this
     */
    public function create(ServiceRequest $request)
    {
        $service = new Service();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::services.create_edit')->with(compact('service'));
    }

    /**
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ServiceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $service = Service::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Service::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ServiceRequest $request
     * @param Service $service
     * @return Service
     */
    public function show(ServiceRequest $request, Service $service)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $service->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Service->hashed_id . '/edit']);

        return view('ERP::services.show')->with(compact('service'));
    }

    /**
     * @param ServiceRequest $request
     * @param Service $service
     * @return $this
     */
    public function edit(ServiceRequest $request, Service $service)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $service->name])]);

        return view('ERP::services.create_edit')->with(compact('service'));
    }

    /**
     * @param ServiceRequest $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ServiceRequest $request, Service $service)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $service->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Service::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ServiceRequest $request
     * @param Service $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ServiceRequest $request, Service $service)
    {
        try {
            $service->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Service::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}