<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\AccountsDataTable;
use Packages\Modules\ERP\Http\Requests\AccountRequest;
use Packages\Modules\ERP\Models\Account;

class AccountsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.account.resource_url');

        $this->title = 'ERP::module.account.title';
        $this->title_singular = 'ERP::module.account.title_singular';

        parent::__construct();
    }

    /**
     * @param AccountRequest $request
     * @param AccountsDataTable $dataTable
     * @return mixed
     */
    public function index(AccountRequest $request, AccountsDataTable $dataTable)
    {
        return $dataTable->render('ERP::accounts.index');
    }

    /**
     * @param AccountRequest $request
     * @return $this
     */
    public function create(AccountRequest $request)
    {
        $account = new Account();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::accounts.create_edit')->with(compact('account'));
    }

    /**
     * @param AccountRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AccountRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $account = Account::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Account::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AccountRequest $request
     * @param Account $account
     * @return Account
     */
    public function show(AccountRequest $request, Account $account)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $account->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Account->hashed_id . '/edit']);

        return view('ERP::accounts.show')->with(compact('account'));
    }

    /**
     * @param AccountRequest $request
     * @param Account $account
     * @return $this
     */
    public function edit(AccountRequest $request, Account $account)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $account->name])]);

        return view('ERP::accounts.create_edit')->with(compact('account'));
    }

    /**
     * @param AccountRequest $request
     * @param Account $account
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AccountRequest $request, Account $account)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $account->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Account::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AccountRequest $request
     * @param Account $account
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AccountRequest $request, Account $account)
    {
        try {
            $account->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Account::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}
