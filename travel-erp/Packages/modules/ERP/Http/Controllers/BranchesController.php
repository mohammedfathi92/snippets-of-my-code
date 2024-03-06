<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\BranchesDataTable;
use Packages\Modules\ERP\Http\Requests\BranchRequest;
use Packages\Modules\ERP\Models\Branch;

class BranchesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.branch.resource_url');

        $this->title = 'ERP::module.branch.title';
        $this->title_singular = 'ERP::module.branch.title_singular';

        parent::__construct();
    }

    /**
     * @param BranchRequest $request
     * @param BranchsDataTable $dataTable
     * @return mixed
     */
    public function index(BranchRequest $request, BranchesDataTable $dataTable)
    {
        return $dataTable->render('ERP::branches.index');
    }

    /**
     * @param BranchRequest $request
     * @return $this
     */
    public function create(BranchRequest $request)
    {
        $branch = new Branch();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::branches.create_edit')->with(compact('branch'));
    }

    /**
     * @param BranchRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BranchRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $branch = Branch::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Branch::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BranchRequest $request
     * @param Branch $branch
     * @return Branch
     */
    public function show(BranchRequest $request, Branch $branch)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $branch->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Branch->hashed_id . '/edit']);

        return view('ERP::branches.show')->with(compact('branch'));
    }

    /**
     * @param BranchRequest $request
     * @param Branch $branch
     * @return $this
     */
    public function edit(BranchRequest $request, Branch $branch)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $branch->name])]);

        return view('ERP::branches.create_edit')->with(compact('branch'));
    }

    /**
     * @param BranchRequest $request
     * @param Branch $branch
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $branch->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Branch::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BranchRequest $request
     * @param Branch $branch
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BranchRequest $request, Branch $branch)
    {
        try {
            $branch->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Branch::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}