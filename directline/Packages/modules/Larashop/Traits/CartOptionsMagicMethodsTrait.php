<?php

namespace Packages\Modules\Larashop\Traits;

use Packages\Modules\Larashop\Classes\CartItem;
use Packages\Modules\Larashop\Exceptions\InvalidPrice;
use Packages\Modules\Larashop\Exceptions\InvalidQuantity;
use Packages\Modules\Larashop\Exceptions\InvalidTaxableValue;

/**
 * Class CartOptionsMagicMethodsTrait.
 */
trait CartOptionsMagicMethodsTrait
{
    public $options = [];

    /**
     * Magic Method allows for user input as an object.
     *
     * @param $option
     *
     * @return mixed | null
     */
    public function __get($option)
    {
        try {
            return $this->$option;
        } catch (\ErrorException $e) {
            return array_get($this->options, $option);
        }
    }

    /**
     * Magic Method allows for user input to set a value inside the options array.
     *
     * @param $option
     * @param $value
     *
     * @throws InvalidPrice
     * @throws InvalidQuantity
     * @throws InvalidTaxableValue
     */
    public function __set($option, $value)
    {
        switch ($option) {
            case CartItem::ITEM_QTY:
                if (!is_numeric($value) || $value <= 0) {
                    throw new InvalidQuantity(trans('Larashop::exception.cart.quantity_valid_num'));
                }
                break;
            case CartItem::ITEM_PRICE:
                if (!is_numeric($value)) {
                    throw new InvalidPrice(trans('Larashop::exception.cart.price_must_valid_num'));
                }
                break;
            case CartItem::ITEM_TAX:
                if (!empty($value) && (!is_numeric($value))) {
                    throw new InvalidTaxableValue(trans('Larashop::exception.cart.tax_must_number'));
                }
                break;
            case CartItem::ITEM_TAXABLE:
                if (!is_bool($value) && $value != 0 && $value != 1) {
                    throw new InvalidTaxableValue(trans('Larashop::exception.cart.taxable_option_must_boolean'));
                }
                break;
        }
        array_set($this->options, $option, $value);
        if (is_callable([$this, 'generateHash']) && !$this->itemHash) {
            $this->generateHash();
        }
    }

    /**
     * Magic Method allows for user to check if an option isset.
     *
     * @param $option
     *
     * @return bool
     */
    public function __isset($option)
    {
        if (!empty($this->options[$option])) {
            return true;
        } else {
            return false;
        }
    }
}
