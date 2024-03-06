<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;
use Packages\Modules\ERP\DataTables\DriversDataTable;
use Packages\Modules\ERP\Http\Requests\DriverRequest;
use Packages\Modules\ERP\Models\DriverSalary;
use Packages\Modules\ERP\Models\Driver;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Models\Financial;

class DriversController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.driver.resource_url');

        $this->title = 'ERP::module.driver.title';
        $this->title_singular = 'ERP::module.driver.title_singular';

        parent::__construct();
    }

    /**
     * @param DriverRequest $request
     * @param DriversDataTable $dataTable
     * @return mixed
     */
    public function index(DriverRequest $request, DriversDataTable $dataTable)
    {
        return $dataTable->render('ERP::drivers.index');
    }

    /**
     * @param DriverRequest $request
     * @return $this
     */
    public function create(DriverRequest $request)
    {
        $driver = new Driver();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        $salary = new DriverSalary;

        return view('ERP::drivers.create_edit')->with(compact('driver', 'salary'));
    }

    /**
     * @param DriverRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(DriverRequest $request)
    {
        try {

            $driver = \ERP::storeUser($request, 'driver', ['financial_accounts', 'create_financial_account','salary']);

        //add financials and account

     $driver->salary($request->salary);
            if($request->create_financial_account == 'yes'){

         if(is_array($request->financial_accounts)){
    
        $accountData = array_merge($request->financial_accounts, [
            'name' => $request->input('financial_accounts.translated_name.ar'),
           'name_en' => $request->input('financial_accounts.translated_name.en'),
            'user_id' => $driver->id,

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
                'to_user_id' => $driver->id,
                'to_account_id' => $account->id,

            ]);

            } 

            }

            }

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Driver::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param DriverRequest $request
     * @param Driver $driver
     * @return Driver
     */
    public function show(DriverRequest $request, Driver $driver)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $driver->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Driver->hashed_id . '/edit']);

        return view('ERP::drivers.show')->with(compact('driver'));
    }

    /**
     * @param DriverRequest $request
     * @param Driver $driver
     * @return $this
     */
    public function edit(DriverRequest $request, Driver $driver)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $driver->name])]);
       $salary = $driver->salary;
       if(!$salary){
        $salary = new DriverSalary;

       }

        return view('ERP::drivers.create_edit')->with(compact('driver', 'salary'));
    }

    /**
     * @param DriverRequest $request
     * @param Driver $driver
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        try {
            \ERP::updateUser($request, $driver, 'driver',['financial_accounts', 'create_financial_account','salary']);

            $driver->salary()->delete();

            $driver->salary()->create($request->salary);


            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Driver::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param DriverRequest $request
     * @param Driver $driver
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DriverRequest $request, Driver $driver)
    {
        try {
            $driver->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Driver::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}