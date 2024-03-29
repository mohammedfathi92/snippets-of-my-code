<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\Classes\Larashop;
use Packages\Modules\Larashop\DataTables\SKUDataTable;
use Packages\Modules\Larashop\Http\Requests\SKURequest;
use Packages\Modules\Larashop\Models\SKU;
use Packages\Modules\Larashop\Models\Product;
use Packages\Modules\Larashop\Traits\DownloadableController;
use Illuminate\Http\Request;

class SKUController extends BaseController
{
    use DownloadableController;

    public function __construct()
    {
        $this->resource_url = route(
            config('ecommerce.models.sku.resource_route'),
            ['product' => request()->route('product')]
        );

        $this->title = 'Larashop::module.sku.title';
        $this->title_singular = 'Larashop::module.sku.title_singular';

        parent::__construct();
    }

    /**
     * @param SKURequest $request
     * @param Product $product
     * @param SKUDataTable $dataTable
     * @return mixed
     */
    public function index(SKURequest $request, Product $product, SKUDataTable $dataTable)
    {
        $this->setViewSharedData(['title' => trans('Larashop::labels.sku.index_title',['name' => $product->name ,'title' => $this->title])]);

        return $dataTable->render('Larashop::sku.index', compact('product'));
    }

    /**
     * @param SKURequest $request
     * @param Product $product
     * @return $this
     */
    public function create(SKURequest $request, Product $product)
    {
        $sku = new SKU();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('Larashop::sku.create_edit')->with(compact('sku', 'product'));
    }

    /**
     * @param SKURequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SKURequest $request, Product $product)
    {
        try {
            $data = $request->except('options', 'image', 'clear', 'downloads_enabled', 'downloads', 'cleared_downloads');

            $sku = $product->sku()->create($data);

            if ($request->hasFile('image')) {
                $sku->addMedia($request->file('image'))->withCustomProperties(['root' => 'user_' . user()->hashed_id])->toMediaCollection('ecommerce-sku-image');
            }

            $this->createOptions($request, $sku);

            $this->handleDownloads($request, $sku);
            //$this->createUpdateGatewaySKUSend(SKU::find($sku->id), true);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, SKU::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    protected function createOptions($request, $sku)
    {
        $sku->options()->delete();

        $options = [];
        if (isset($request->options)) {
            foreach ($request->options as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $value_option) {
                        $options[] = [
                            'attribute_id' => $key,
                            'value' => $value_option
                        ];
                    }
                } else {
                    $options[] = [
                        'attribute_id' => $key,
                        'value' => $value
                    ];
                }
            }

            $sku->options()->createMany($options);
        }

    }

    /**
     * @param SKURequest $request
     * @param Product $product
     * @param SKU $sku
     * @return $this
     */
    public function show(SKURequest $request, Product $product, SKU $sku)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $product->name])]);

        return view('Larashop::sku.show')->with(compact('sku', 'product'));
    }

    /**
     * @param SKURequest $request
     * @param Product $product
     * @param SKU $sku
     * @return $this
     */
    public function edit(SKURequest $request, Product $product, SKU $sku)
    {
        $this->setViewSharedData(['title_singular' => "Update SKU"]);

        return view('Larashop::sku.create_edit')->with(compact('sku', 'product'));
    }

    /**
     * @param SKURequest $request
     * @param Product $product
     * @param SKU $sku
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SKURequest $request, Product $product, SKU $sku)
    {
        try {
            $data = $request->except('options', 'code', 'image', 'clear', 'downloads_enabled', 'downloads', 'cleared_downloads');

            $sku->update($data);

            if ($request->has('clear') || $request->hasFile('image')) {
                $sku->clearMediaCollection('ecommerce-sku-image');
            }

            if ($request->hasFile('image') && !$request->has('clear')) {
                $sku->addMedia($request->file('image'))->withCustomProperties(['root' => 'user_' . user()->hashed_id])->toMediaCollection('ecommerce-sku-image');
            }

            $this->createOptions($request, $sku);

            $this->handleDownloads($request, $sku);
            //$this->createUpdateGatewaySKUSend($sku);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, SKU::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param SKU $sku
     * @param bool $create
     * @return bool
     * @throws \Exception
     */
    protected function createUpdateGatewaySKUSend(SKU $sku, $create = false, $gateway = null)
    {
        if ($gateway) {
            $gateways = [$gateway];
        } else {
            $gateways = \Payments::getAvailableGateways();
        }

        $exceptionMessage = '';
        foreach ($gateways as $gateway => $gateway_title) {

            try {
                $Larashop = new Larashop($gateway);


                if (!$Larashop->gateway->getConfig('manage_remote_sku')) {
                    continue;
                }
                if ($Larashop->gateway->getGatewayIntegrationId($sku)) {
                    $Larashop->updateSKU($sku);
                } else {
                    $Larashop->createSKU($sku);
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
     * @param SKURequest $request
     * @param Product $product
     * @param SKU $sku
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SKURequest $request, Product $product, SKU $sku)
    {
        try {

            $gateways = \Payments::getAvailableGateways();

            foreach ($gateways as $gateway => $gateway_title) {

                $Larashop = new Larashop($gateway);
                if (!$Larashop->gateway->getConfig('manage_remote_sku')) {
                    continue;
                }
                $Larashop->deleteSKU($sku);
                $sku->setGatewayStatus($this->gateway->getName(), 'DELETED', null);

            }

            $sku->clearMediaCollection('ecommerce-sku-image');
            $sku->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, SKU::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param SKU $sku
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGatewaySKU(Request $request, Product $product, SKU $sku)
    {
        user()->can('Larashop::product.create', Product::class);

        $gateway = $request->get('gateway');
        try {
            $this->createUpdateGatewaySKUSend($sku, true, $gateway);

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.created', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, SKU::class, 'createGatewaySKU');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}