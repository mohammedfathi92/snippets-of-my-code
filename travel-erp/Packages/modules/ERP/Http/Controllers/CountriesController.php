<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\CountriesDataTable;
use Packages\Modules\ERP\Http\Requests\CountryRequest;
use Packages\Modules\ERP\Models\Country;
 
class CountriesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.country.resource_url');

        $this->title = 'ERP::module.country.title';
        $this->title_singular = 'ERP::module.country.title_singular';

        parent::__construct();
    }

    /**
     * @param CountryRequest $request
     * @param CountriesDataTable $dataTable
     * @return mixed
     */
    public function index(CountryRequest $request, CountriesDataTable $dataTable)
    {
        return $dataTable->render('ERP::countries.index');
    }

    /**
     * @param CountryRequest $request
     * @return $this
     */
    public function create(CountryRequest $request)
    {
        $country = new Country();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::countries.create_edit')->with(compact('country'));
    }

    /**
     * @param CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CountryRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $counrty = Country::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Country::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CountryRequest $request
     * @param Country $country
     * @return Country
     */
    public function show(CountryRequest $request, Country $country)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $country->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $country->hashed_id . '/edit']);

        return view('ERP::countries.show')->with(compact('country'));
    }



    /**
     * @param CountryRequest $request
     * @param Country $country
     * @return $this
     */
    public function edit(CountryRequest $request, Country $country)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $country->name])]);

        return view('ERP::countries.create_edit')->with(compact('country'));
    }

    /**
     * @param CountryRequest $request
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CountryRequest $request, Country $country)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $country->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Country::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CountryRequest $request
     * @param Country $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CountryRequest $request, Country $country)
    {
        try {
            $country->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Country::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}