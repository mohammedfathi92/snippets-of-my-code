<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Facades\Actions;
use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\Classes\Larashop;
use Packages\Modules\Larashop\DataTables\ProductsDataTable;
use Packages\Modules\Larashop\Http\Requests\ProductRatingRequest;
use Packages\Modules\Larashop\Http\Requests\ProductRequest;
use Packages\Modules\Larashop\Models\Product;
use Packages\Modules\Larashop\Models\SKU;
use Packages\Modules\Larashop\Models\Tag;
use Packages\Modules\Larashop\Traits\DownloadableController;
use Packages\Modules\Larashop\Traits\LarashopGallery;
use Packages\User\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;
use Trexology\ReviewRateable\Models\Rating;
use Trexology\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;


class ProductsController extends BaseController
{
    use DownloadableController, ReviewRateableTrait, LarashopGallery;

    public $sku_attributes = ['regular_price', 'sale_price', 'code', 'inventory', 'inventory_value', 'allowed_quantity'];

    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.product.resource_url');
        $this->title = 'Larashop::module.product.title';
        $this->title_singular = trans('Larashop::module.product.title_singular');

        parent::__construct();
    }

    /**
     * @param ProductRequest $request
     * @return $this
     */
    public function index(ProductRequest $request, ProductsDataTable $dataTable)
    {
        return $dataTable->render('Larashop::products.index');
    }

    /**
     * @param ProductRequest $request
     * @return $this
     */
    public function create(ProductRequest $request)
    {
        $product = new Product();
        $sku = new SKU();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('Larashop::products.create_edit')->with(compact('product', 'sku'));
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request)
    {

        try {
            $data = $request->except(array_merge(['global_options', 'variation_options', 'create_gateway_product', 'tax_classes', 'categories', 'tags', 'posts', 'private_content_pages', 'downloads_enabled', 'downloads', 'cleared_downloads', 'external'], $this->sku_attributes));

            $data = $this->setShippingData($data);

            $product = Product::create($data);

            if ($product->type == "simple") {
                $sku_data = $request->only(array_merge($this->sku_attributes, ['status']));
                $product->sku()->create($sku_data);
            }

            $product->categories()->sync($request->get('categories', []));
            $product->tax_classes()->sync($request->get('tax_classes', []));

            $attributes = [];
            foreach ($request->get('global_options', []) as $option) {
                $attributes[] = [
                    'attribute_id' => $option,
                    'sku_level' => false,
                ];
            }
            if ($product->type == "variable") {

                foreach ($request->get('variation_options', []) as $option) {
                    $attributes[] = [
                        'attribute_id' => $option,
                        'sku_level' => true,
                    ];
                }
            }
            $product->attributes()->sync($attributes);

            $tags = $this->getTags($request);

            $product->tags()->sync($tags);

            $product->posts()->sync($request->get('posts', []));


            //if ($request->has('create_gateway_product')) {
            //    $this->createUpdateGatewayProductSend($product);
            //}


            $this->handleDownloads($request, $product);

            $product->indexRecord();

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Product::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    public function downloadFile(Request $request, $hashed_id)
    {
        if (!user()->hasPermissionTo('Larashop::product.update')) {
            abort(403);
        }

        $id = hashids_decode($hashed_id);

        $media = Media::findOrfail($id);

        return response()->download(storage_path($media->getUrl()));
    }

    protected function setShippingData($data)
    {
        if (!isset($data['shipping']['enabled'])) {
            $data['shipping']['enabled'] = 0;
        }

        return $data;
    }

    /**
     * @param $request
     * @return array
     */
    private function getTags($request)
    {
        $tags = [];

        $requestTags = $request->get('tags', []);

        foreach ($requestTags as $tag) {
            if (is_numeric($tag)) {
                array_push($tags, $tag);
            } else {
                try {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);

                    array_push($tags, $newTag->id);
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        return $tags;
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return $this
     */
    public function show(ProductRequest $request, Product $product)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $product->name])]);
        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $product->hashed_id . '/edit']);
        return view('Larashop::products.show')->with(compact('product'));
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return $this
     */
    public function edit(ProductRequest $request, Product $product)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $product->name])]);
        $sku = $product->sku->first();
        if (!$sku) {
            $sku = new SKU();
        }
        return view('Larashop::products.create_edit')->with(compact('product', 'sku'));
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProductRequest $request, Product $product)
    {
         dd($request->all());
        try {
            $data = $request->except(array_merge(['global_options', 'variation_options', 'categories', 'tags', 'tax_classes', 'downloads_enabled', 'downloads', 'cleared_downloads', 'private_content_pages', 'posts', 'external'], $this->sku_attributes));

            $data = $this->setShippingData($data);

            $data['is_featured'] = array_get($data, 'is_featured', false);

            $data['properties'] = array_get($data, 'properties', []);

            $product->update($data);

            if ($product->type == "simple") {
                $sku_data = $request->only(array_merge($this->sku_attributes, ['status']));
                if ($product->sku->first()) {
                    $product->sku->first()->update($sku_data);
                } else {
                    $product->sku()->create($sku_data);
                }
            }

            $attributes = [];
            foreach ($request->get('global_options', []) as $option) {
                $attributes[$option] = [
                    'sku_level' => false,
                ];
            }

            if ($product->type == "variable") {
                foreach ($request->get('variation_options', []) as $option) {
                    $attributes[$option] = [
                        'sku_level' => true,
                    ];
                }
            }

            $product->attributes()->sync($attributes);

            $product->categories()->sync($request->get('categories', []));

            $tags = $this->getTags($request);

            $product->posts()->sync($request->get('posts', []));

            $product->tags()->sync($tags);

            $product->tax_classes()->sync($request->get('tax_classes', []));

            $this->handleDownloads($request, $product);

            //$this->createUpdateGatewayProductSend($product);
            $product->indexRecord();

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Product::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ProductRatingRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createRating(ProductRatingRequest $request, Product $product)
    {
        try {
            $data = $request->all();
            $rating = Rating::where([
                'reviewrateable_id' => $product->id,
                'reviewrateable_type' => Product::class,
                'author_id' => user()->id,
                'author_type' => User::class])->first();
            if ($rating) {
                $product->updateRating($rating->id, [
                    'rating' => $data['review_rating'], 'title' => $data['review_subject'], 'body' => $data['review_text']
                ]);
            } else {
                $product->rating(['rating' => $data['review_rating'], 'title' => $data['review_subject'], 'body' => $data['review_text']], user());

            }
            $message = ['level' => 'success', 'message' => trans('Larashop::labels.product.add_success')];

        } catch (\Exception $exception) {
            log_exception($exception, Product::class, 'createRating');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];

        }
        return response()->json($message);
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProductRequest $request, Product $product)
    {
        try {
            $gateways = \Payments::getAvailableGateways();

            foreach ($gateways as $gateway => $gateway_title) {
                $Larashop = new Larashop($gateway);
                if (!$Larashop->gateway->getConfig('manage_remote_product')) {
                    continue;
                }

                $Larashop->deleteProduct($product);
                $product->setGatewayStatus($this->gateway->getName(), 'DELETED', null);
            }

            $product->clearMediaCollection('product-downloads');
            $product->clearMediaCollection($product->galleryMediaCollection);

            $product->delete();
            $product->unIndexRecord();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
            log_exception($exception, Product::class, 'destroy');
        }

        return response()->json($message);
    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    protected function createUpdateGatewayProductSend(Product $product, $gateway = null)
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


                if (!$Larashop->gateway->getConfig('manage_remote_product')) {
                    continue;
                }
                if ($Larashop->gateway->getGatewayIntegrationId($product)) {


                    // $request = $Larashop->gateway->FetchProduct(['id' => $Larashop->gateway->getGatewayIntegrationId($product)]);
                    // $response = $request->send();

                    $Larashop->updateProduct($product);
                } else {
                    $Larashop->createProduct($product);
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
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGatewayProduct(Request $request, Product $product)
    {
        $gateway = $request->get('gateway');
        user()->can('Larashop::product.create', Product::class);

        try {
            $this->createUpdateGatewayProductSend($product, $gateway);

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.created', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Product::class, 'createGatewayProduct');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}