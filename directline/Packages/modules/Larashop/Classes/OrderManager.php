<?php

namespace Packages\Modules\Larashop\Classes;


use Packages\Modules\Larashop\Models\Attribute;
use Packages\Modules\Larashop\Models\Order;
use Packages\Modules\Larashop\Models\OrderItem;
use Packages\Modules\Larashop\Models\SKU;

class OrderManager
{
    public function getOrderDownloadable(Order $order)
    {
        $downloads = [];

        foreach ($order->items as $item) {
            $sku = $this->getItemSKU($item);
            if (!empty($sku->downloads)) {
                $downloads = array_merge($downloads, $sku->downloads);
            }
            if (!empty($sku->product->downloads)) {
                $downloads = array_merge($downloads, $sku->product->downloads);
            }
        }

        if (empty($downloads)) {
            return false;
        }

        return $downloads;
    }

    /**
     * @param OrderItem $item
     * @return null
     */
    public function getItemSKU(OrderItem $item)
    {
        if ($item->type != 'Product') {
            return null;
        }

        $sku = SKU::where('code', $item->sku_code)->first();

        return $sku;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function mapSelectedAttributes($attributes)
    {
        if (!is_array($attributes)) {
            return [];
        }
        $mapped_attributes = [];
        foreach ($attributes as $attribute_id => $attribute_value) {
            $attribute = Attribute::find($attribute_id);
            if ($attribute) {
                if (!$attribute->options->isEmpty()) {
                    $attribute_option = $attribute->options->where('id', $attribute_value)->first();
                    if($attribute_option){
                        $value = $attribute_option->option_display;
                    }else{
                        $value = "";
                    }
                } else {
                    $value = $attribute_value;
                }

                $mapped_attributes[$attribute->label] = $value;
            }
        }
        return $mapped_attributes;
    }

}