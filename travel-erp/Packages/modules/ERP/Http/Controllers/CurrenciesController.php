<?php


namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\CurrenciesDataTable;
use Packages\Modules\ERP\Http\Requests\CurrencyRequest;
use Packages\Modules\ERP\Models\Currency;


class CurrenciesController extends BaseController
{

    public function __construct()
    {

        $this->setViewSharedData(['hideCreate' => true]);

        $this->resource_url = config('erp.models.currency.resource_url');
        $this->title = 'ERP::module.currency.title';
        $this->title_singular = 'ERP::module.currency.title_singular';


        parent::__construct();
    }

    public function index(CurrencyRequest $request, CurrenciesDataTable $dataTable)
    {
        return $dataTable->render('ERP::currencies.index');
    }


    public function edit(CurrencyRequest $request, Currency $currency)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $currency->code])]);

        return view('ERP::currencies.create_edit')->with(compact('currency'));
    }


    public function update(CurrencyRequest $request, Currency $currency)
    {
        try {
            $data = $request->all();

            $data['active'] = array_get($data, 'active', 0);

            $currency->update($data);

            $currencyClass = app('currency');

            $currencyClass->clearCache();
            $currencyClass->getCurrencies();

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Currency::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    public function destroy(CurrencyRequest $request, Currency $currency)
    {
        try {
            $default_currency = config('currency.default');

            if (strtoupper($currency->code) == strtoupper($default_currency)) {
                throw new \Exception(trans('ERP::exceptions.currency.delete_default'));
            }

            $currency->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Currency::class, 'destroy');

            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}