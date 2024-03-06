<?php

namespace Packages\Modules\Larashop\Widgets;

use ConsoleTVs\Charts\Facades\Charts;
use Packages\Modules\Larashop\Models\Product;

class BrandRatioWidget
{

    function __construct()
    {
    }

    function run($args)
    {
        $chart = Charts::database((Product::whereNotNull('brand_id')->get()), 'pie', 'chartjs')
            ->title(trans('Larashop::labels.widget.products_by_brand'))
            ->groupBy('brand_id', 'brand.name');
        return $chart->render();
    }

}