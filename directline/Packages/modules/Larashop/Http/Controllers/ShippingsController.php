<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\DataTables\ShippingsDataTable;
use Packages\Modules\Larashop\Http\Requests\ShippingRequest;
use Packages\Modules\Larashop\Models\Shipping;

class ShippingsController extends BaseController
{


    public function __construct()
    {


        $this->resource_url = config('ecommerce.models.shipping.resource_url');
        $this->title = 'Larashop::module.shipping.title';
        $this->title_singular = 'Larashop::module.shipping.title_singular';
        parent::__construct();
    }

    /**
     * @param ShippingRequest $request
     * @param ShippingsDataTable $dataTable
     * @return mixed
     */
    public function index(ShippingRequest $request, ShippingsDataTable $dataTable)
    {
        return $dataTable->render('Larashop::shippings.index');
    }

    /**
     * @param ShippingRequest $request
     * @return $this
     */
    public function create(ShippingRequest $request)
    {
        $shipping = new Shipping();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('Larashop::shippings.create_edit')->with(compact('shipping'));
    }

    /**
     * @param ShippingRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ShippingRequest $request)
    {
        try {
            $data = $request->except('users', 'products');

            Shipping::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Shipping::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return Shipping
     */
    public function show(ShippingRequest $request, Shipping $shipping)
    {
        return $shipping;
    }

    /**
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return $this
     */
    public function edit(ShippingRequest $request, Shipping $shipping)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' =>$this->title_singular])]);

        return view('Larashop::shippings.create_edit')->with(compact('shipping'));
    }

    /**
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ShippingRequest $request, Shipping $shipping)
    {
        try {
            $data = $request->except('users', 'products');

            $shipping->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => trans('Larashop::module.shipping.index_title')]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Shipping::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ShippingRequest $request, Shipping $shipping)
    {
        try {
            $shipping->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => trans('Larashop::module.shipping.index_title')])];
        } catch (\Exception $exception) {
            log_exception($exception, Shipping::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

}