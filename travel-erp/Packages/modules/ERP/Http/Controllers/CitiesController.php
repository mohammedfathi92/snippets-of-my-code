<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\Classes\ERP;
use Packages\Modules\ERP\DataTables\CitiesDataTable;
use Packages\Modules\ERP\Http\Requests\CityRequest;
use Packages\Modules\ERP\Models\City;
use Packages\Modules\ERP\Models\Country;
use Illuminate\Http\Request;

class CitiesController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = route(
            config('erp.models.city.resource_route'),
            ['country' => request()->route('country')]
        );

        $this->title = 'ERP::module.city.title';
        $this->title_singular = 'ERP::module.city.title_singular';

        parent::__construct();
    }

    /**
     * @param CityRequest $request
     * @param Country $country
     * @param CitiesDataTable $dataTable
     * @return mixed
     */
    public function index(CityRequest $request, Country $country, CitiesDataTable $dataTable)
    {
        $this->setViewSharedData(['title' => trans('ERP::module.city.title',['name' => $country->name ,'title' => $this->title])]);

        return $dataTable->render('ERP::cities.index', compact('country'));
    }

    /**
     * @param CityRequest $request
     * @param Country $country
     * @return $this
     */
    public function create(CityRequest $request, Country $country)
    {
        $city = new City();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::cities.create_edit')->with(compact('city', 'country'));
    }

    /**
     * @param CityRequest $request
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CityRequest $request, Country $country)
    {
        try {

            $city = $country->cities()->create($request->all());
           
            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, City::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

 

    /**
     * @param CityRequest $request
     * @param Country $country
     * @param City $city
     * @return $this
     */
    public function show(CityRequest $request, Country $country, City $city)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $country->name])]);

        return view('ERP::cities.show')->with(compact('city', 'country'));
    }

    /**
     * @param CityRequest $request
     * @param Country $country
     * @param City $city
     * @return $this
     */
    public function edit(CityRequest $request, Country $country, City $city)
    {
        $this->setViewSharedData(['title_singular' => "Update City"]);

        return view('ERP::cities.create_edit')->with(compact('city', 'country'));
    }

    /**
     * @param CityRequest $request
     * @param Country $country
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CityRequest $request, Country $country, City $city)
    {
        try {
            $data = $request->except('options', 'code', 'image', 'clear', 'downloads_enabled', 'downloads', 'cleared_downloads');

            $city->update($data);

           

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, City::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param City $city
     * @param bool $create
     * @return bool
     * @throws \Exception
     */
    protected function createUpdateGatewayCitySend(City $city, $create = false, $gateway = null)
    {
        if ($gateway) {
            $gateways = [$gateway];
        } else {
            $gateways = \Payments::getAvailableGateways();
        }

        $exceptionMessage = '';
        foreach ($gateways as $gateway => $gateway_title) {

            try {
                $ERP = new ERP($gateway);


                if (!$ERP->gateway->getConfig('manage_remote_city')) {
                    continue;
                }
                if ($ERP->gateway->getGatewayIntegrationId($city)) {
                    $ERP->updateCity($city);
                } else {
                    $ERP->createCity($city);
                }
            } catch (\Exception $exception) {
                $exceptionMessage .= $exception->getMessage();
            }
        }
        if (!empty($exceptionMessage)) {
            throw new \Exception($exceptionMessage);
        }
    }


    /**
     * @param CityRequest $request
     * @param Country $country
     * @param City $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CityRequest $request, Country $country, City $city)
    {
        try {

            $gateways = \Payments::getAvailableGateways();

            foreach ($gateways as $gateway => $gateway_title) {

                $ERP = new ERP($gateway);
                if (!$ERP->gateway->getConfig('manage_remote_city')) {
                    continue;
                }
                $ERP->deleteCity($city);
                $city->setGatewayStatus($this->gateway->getName(), 'DELETED', null);

            }

            $city->clearMediaCollection('ecommerce-city-image');
            $city->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, City::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    /**
     * @param Request $request
     * @param Country $country
     * @param City $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGatewayCity(Request $request, Country $country, City $city)
    {
        user()->can('ERP::country.create', Country::class);

        $gateway = $request->get('gateway');
        try {
            $this->createUpdateGatewayCitySend($city, true, $gateway);

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.created', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, City::class, 'createGatewayCity');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}