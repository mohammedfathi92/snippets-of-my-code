<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ExpensesDataTable;
use Packages\Modules\ERP\Http\Requests\ExpenseRequest;
use Packages\Modules\ERP\Models\Expense;
use Packages\Modules\ERP\Models\UserErp;
use Illuminate\Http\Request;


class ExpensesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.expense.resource_url');

        $this->title = 'ERP::module.expense.title';
        $this->title_singular = 'ERP::module.expense.title_singular';

        parent::__construct();
    }

    /**
     * @param ExpenseRequest $request
     * @param ExpensesDataTable $dataTable
     * @return mixed
     */
    public function index(ExpenseRequest $request, ExpensesDataTable $dataTable)
    {
        return $dataTable->render('ERP::expenses.index');
    }

    /**
     * @param ExpenseRequest $request
     * @return $this
     */
    public function create(ExpenseRequest $request)
    {
        $expense = new Expense();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::expenses.create_edit')->with(compact('expense'));
    }

    /**
     * @param ExpenseRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ExpenseRequest $request)
    {
        try {
            $data = $request->except('receipt_image');
            if($request->get('modulable_id')){
                $data['modulable_type'] = 'erp_main_order';

            }

            $data['type'] = 'purchases';

            $expense = Expense::create($data);
            if ($request->hasFile('receipt_image')) {
                $expense->addMedia($request->file('receipt_image'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($expense->mediaCollectionName);
            }

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Expense::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ExpenseRequest $request
     * @param Expense $expense
     * @return Expense
     */
    public function show(ExpenseRequest $request, Expense $expense)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $expense->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $expense->hashed_id . '/edit']);

        return view('ERP::expenses.show')->with(compact('expense'));
    }


    public function ajax_show(ExpenseRequest $request, Expense $expense)
    {


        return view('ERP::expenses.partials.ajax_show')->with(compact('expense'));
    }


    /**
     * @param ExpenseRequest $request
     * @param Expense $expense
     * @return $this
     */
    public function edit(ExpenseRequest $request, Expense $expense)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $expense->name])]);

        return view('ERP::expenses.create_edit')->with(compact('expense'));
    }

    /**
     * @param ExpenseRequest $request
     * @param Expense $expense
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        try {
            $data = $request->except('receipt_image', 'clear');

            if($request->get('modulable_id')){
                $data['modulable_type'] = 'erp_main_order';

            }

            $data['type'] = 'purchases';

            $expense->update($data);

            if ($request->has('clear') || $request->hasFile('receipt_image')) {
                $expense->clearMediaCollection($expense->mediaCollectionName);
            }

            if ($request->hasFile('receipt_image') && !$request->has('clear')) {
                $expense->addMedia($request->file('receipt_image'))
                    ->withCustomProperties(['root' => 'user_' . user()->hashed_id])
                    ->toMediaCollection($expense->mediaCollectionName);
            }


            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Expense::class, 'update');
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
     * @param ExpenseRequest $request
     * @param Expense $expense
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ExpenseRequest $request, Expense $expense)
    {
        try {
            $expense->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Expense::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}