<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\FinancialsDataTable;
use Packages\Modules\ERP\Http\Requests\FinancialRequest;
use Packages\Modules\ERP\Models\Financial;
use Packages\Modules\ERP\Models\UserErp;
use Illuminate\Http\Request;


class FinancialsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.financial.resource_url');

        $this->title = 'ERP::module.financial.title';
        $this->title_singular = 'ERP::module.financial.title_singular';

        parent::__construct();
    }

    /**
     * @param FinancialRequest $request
     * @param FinancialsDataTable $dataTable
     * @return mixed
     */
    public function index(FinancialRequest $request, FinancialsDataTable $dataTable)
    {
        return $dataTable->render('ERP::financials.index');
    }

    /**
     * @param FinancialRequest $request
     * @return $this
     */
    public function create(FinancialRequest $request)
    {
        $financial = new Financial();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::financials.create_edit')->with(compact('financial'));
    }

    /**
     * @param FinancialRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FinancialRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $financial = Financial::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Financial::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param FinancialRequest $request
     * @param Financial $financial
     * @return Financial
     */
    public function show(FinancialRequest $request, Financial $financial)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $financial->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $financial->hashed_id . '/edit']);

        return view('ERP::financials.show')->with(compact('financial'));
    }


    public function ajax_show(FinancialRequest $request, Financial $financial)
    {


        return view('ERP::financials.partials.ajax_show')->with(compact('financial'));
    }


    /**
     * @param FinancialRequest $request
     * @param Financial $financial
     * @return $this
     */
    public function edit(FinancialRequest $request, Financial $financial)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $financial->name])]);

        return view('ERP::financials.create_edit')->with(compact('financial'));
    }

    /**
     * @param FinancialRequest $request
     * @param Financial $financial
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FinancialRequest $request, Financial $financial)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $financial->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Financial::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    

    public function ajax_get_user_accounts(Request $request, $user_id)
    { 

        $user = UserErp::find($user_id);

        if(!$user){
            return response()->json(['success' => false, 'message' => __('ERP::messages.somthing_happen'), 'data'=> []]); 
        }

        $options = $user->accounts()->get();

        $select = [
            'label' => $request->label,
            'name' => $request->name,
            'required' => $request->required,
            'selected' => $request->selected,
            'options' => $options,
            'attributes' => ['class' => 'form-control add-select2 get_accoun_value '.$request->class, 'data-label' => $request->label, 'data-math_type' => $request->math_type],
        ];

        $view = view('ERP::partials.options')->with(compact('select'))->render(); 



      return response()->json(['success' => true, 'message' => 'get accounts', 'data'=> $view]);


    }

    /**
     * @param FinancialRequest $request
     * @param Financial $financial
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FinancialRequest $request, Financial $financial)
    {
        try {
            $financial->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Financial::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}