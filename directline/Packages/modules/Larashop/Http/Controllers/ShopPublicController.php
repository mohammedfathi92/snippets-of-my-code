<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Modules\CMS\Traits\SEOTools;
use Packages\Foundation\Http\Controllers\PublicBaseController;
use Packages\Modules\Larashop\Facades\Shop;
use Packages\Modules\Larashop\Models\Product;
use Illuminate\Http\Request;

class ShopPublicController extends PublicBaseController
{
    use SEOTools;

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $layout = $request->get('layout', 'grid');

        $products = Shop::getProducts($request);

        $item = [
            'title' => 'Shop',
            'meta_description' => 'E-commerce Shop',
            'url' => url('shop'),
            'type' => 'shop',
            'image' => \Settings::get('site_logo'),
            'meta_keywords' => 'shop,e-commerce,products'
        ];

        $this->setSEO((object)$item);

        $shopText = null;

        if ($request->has('search')) {
            $shopText = trans('Larashop::labels.shop.search_results_for', ['search' => $request->get('search')]);
        }

        $sortOptions = trans(config('ecommerce.models.shop.sort_options'));


        if (\Settings::get('ecommerce_rating_enable') == "true") {
            $sortOptions['average_rating'] = trans('Larashop::attributes.product.average_rating');
        }

        return view('templates.shop')->with(compact('layout', 'products', 'shopText', 'sortOptions'));
    }

    public function show(Request $request, $hashed_id)
    {
        $id = hashids_decode($hashed_id);

        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        $categories = join(',', $product->activeCategories->pluck('name')->toArray());
        $tags = join(',', $product->activeTags->pluck('name')->toArray());

        $item = [
            'title' => $product->name,
            'meta_description' => str_limit(strip_tags($product->description), 500),
            'url' => url('shop/' . $product->slug),
            'type' => 'product',
            'image' => $product->image,
            'meta_keywords' => $categories . ',' . $tags
        ];

        $this->setSEO((object)$item);

        return view('templates/product_single')->with(compact('product'));
    }

}