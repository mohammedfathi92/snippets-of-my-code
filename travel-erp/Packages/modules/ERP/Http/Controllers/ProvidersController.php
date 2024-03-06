<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ProvidersDataTable;
use Packages\Modules\ERP\Http\Requests\ProviderRequest;
use Packages\Modules\ERP\Models\Provider;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Models\Financial;

class ProvidersController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.provider.resource_url');

        $this->title = 'ERP::module.provider.title';
        $this->title_singular = 'ERP::module.provider.title_singular';

        parent::__construct();
    }

    /**
     * @param ProviderRequest $request
     * @param ProvidersDataTable $dataTable
     * @return mixed
     */
    public function index(ProviderRequest $request, ProvidersDataTable $dataTable)
    {
        return $dataTable->render('ERP::providers.index');
    }

    /**
     * @param ProviderRequest $request
     * @return $this
     */
    public function create(ProviderRequest $request)
    {
        $provider = new Provider();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::providers.create_edit')->with(compact('provider'));
    }

    /**
     * @param ProviderRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProviderRequest $request)
    {
        try {

            $provider = \ERP::storeUser($request, 'provider', ['financial_accounts', 'create_financial_account']);

        //add financials and account

            if($request->create_financial_account == 'yes'){

         if(is_array($request->financial_accounts)){
    
        $accountData = array_merge($request->financial_accounts, [
            'name' => $request->input('financial_accounts.translated_name.ar'),
           'name_en' => $request->input('financial_accounts.translated_name.en'),
            'user_id' => $provider->id,

        ]);

       
            $account = Account::create($accountData);

            $opening_balance = $request->input('financial_accounts.opening_balance');
            $description_financial = [
                    'ar' => 'ايداع  مبلغ'. $opening_balance. ' كرصيد افتتاحي لحساب رقم  ['.$account->account_code.']',
                    'en' => 'Deposit of '. $opening_balance.' to account with code ['.$account->account_code.'] as opening balance',

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
                'to_user_id' => $provider->id,
                'to_account_id' => $account->id,

            ]);

            } 

            }

            }

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Provider::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ProviderRequest $request
     * @param Provider $provider
     * @return Provider
     */
    public function show(ProviderRequest $request, Provider $provider)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $provider->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Provider->hashed_id . '/edit']);

        return view('ERP::providers.show')->with(compact('provider'));
    }

    /**
     * @param ProviderRequest $request
     * @param Provider $provider
     * @return $this
     */
    public function edit(ProviderRequest $request, Provider $provider)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $provider->name])]);

        return view('ERP::providers.create_edit')->with(compact('provider'));
    }

    /**
     * @param ProviderRequest $request
     * @param Provider $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        try {
            \ERP::updateUser($request, $provider, 'provider',['financial_accounts', 'create_financial_account']);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Provider::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ProviderRequest $request
     * @param Provider $provider
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProviderRequest $request, Provider $provider)
    {
        try {
            $provider->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Provider::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}