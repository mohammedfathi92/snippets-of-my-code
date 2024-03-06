<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\AgentsDataTable;
use Packages\Modules\ERP\Http\Requests\AgentRequest;
use Packages\Modules\ERP\Models\Agent;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Models\Financial;

class AgentsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.agent.resource_url');

        $this->title = 'ERP::module.agent.title';
        $this->title_singular = 'ERP::module.agent.title_singular';

        parent::__construct();
    }

    /**
     * @param AgentRequest $request
     * @param AgentsDataTable $dataTable
     * @return mixed
     */
    public function index(AgentRequest $request, AgentsDataTable $dataTable)
    {
        return $dataTable->render('ERP::agents.index');
    }

    /**
     * @param AgentRequest $request
     * @return $this
     */
    public function create(AgentRequest $request)
    {
        $agent = new Agent();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::agents.create_edit')->with(compact('agent'));
    }

    /**
     * @param AgentRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AgentRequest $request)
    {
        try {

            $agent = \ERP::storeUser($request, 'agent', ['financial_accounts', 'create_financial_account']);

        //add financials and account

            if($request->create_financial_account == 'yes'){

         if(is_array($request->financial_accounts)){
    
        $accountData = array_merge($request->financial_accounts, [
            'name' => $request->input('financial_accounts.translated_name.ar'),
           'name_en' => $request->input('financial_accounts.translated_name.en'),
           'user_id' => $agent->id,

        ]);

       
            $account = Account::create($accountData);

            $opening_balance = $request->input('financial_accounts.opening_balance');
            $description_financial = [
                    'ar' => 'ايداع  مبلغ'. $opening_balance. ' كرصيد افتتاحي لحساب رقم  ['.$account->account_code.']',
                    'en' => 'Deposit of '. $opening_balance.' to account with code ['.$account->account_code.'] as account opening balance',

                ];
            if($account->exists && $opening_balance > 0){   
            $financial = Financial::create([
                'reg_code' => uniqid(),
                'type' => 'deposit',
                'reg_value' => $request->input('financial_accounts.opening_balance'),
                'value_type' => 'amount',
                'final_value' => $request->input('financial_accounts.opening_balance'),
                'description' => $description_financial,
                'status' => 1,
                'to_user_id' => $agent->id,
                'to_account_id' => $account->id,

            ]);

            } 

            }

            }

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Agent::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AgentRequest $request
     * @param Agent $agent
     * @return Agent
     */
    public function show(AgentRequest $request, Agent $agent)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $agent->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Agent->hashed_id . '/edit']);

        return view('ERP::agents.show')->with(compact('agent'));
    }

    /**
     * @param AgentRequest $request
     * @param Agent $agent
     * @return $this
     */
    public function edit(AgentRequest $request, Agent $agent)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $agent->name])]);

        return view('ERP::agents.create_edit')->with(compact('agent'));
    }

    /**
     * @param AgentRequest $request
     * @param Agent $agent
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AgentRequest $request, Agent $agent)
    {
        try {
            \ERP::updateUser($request, $agent, 'agent',['financial_accounts', 'create_financial_account']);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Agent::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AgentRequest $request
     * @param Agent $agent
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AgentRequest $request, Agent $agent)
    {
        try {
            $agent->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Agent::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}