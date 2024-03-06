<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = "products";
    use \Dimsav\Translatable\Translatable;
    protected $fillable = ['category_id', 'photo', 'price'];
    public $translatedAttributes = ['name', 'details'];

    public function category()
    {
        return $this->belongsTo("App\Category");
    }

    public function opportunities()
    {
        return $this->belongsToMany("App\Opportunity", 'opportunities_products', 'product_id', 'opportunity_id')
            ->groupBy("pivot_opportunity_id")
            ->withPivot(['category_id', 'quantity', 'price']);
    }


    public function validOpportunities()
    {
        return $this->belongsToMany("App\Opportunity", 'opportunities_products', 'product_id', 'opportunity_id')
            ->whereIn('status', [1, 2])
            ->withPivot(['category_id', 'quantity', 'price'])
            ->groupBy("opportunities_products.opportunity_id");
    }

    public function soldCount()
    {
        return $this->belongsToMany("App\Opportunity", 'opportunities_products', 'product_id', 'opportunity_id')
            ->withPivot(['category_id', 'quantity', 'price'])
            ->selectRaw("(sum(opportunities_products.quantity)) as aggregate")
            ->whereIn('status', [1, 2])
            ->groupBy('pivot_product_id');
    }

    // accessor for easier fetching the count
    public function getSoldCountAttribute()
    {
        if (!array_key_exists('soldCount', $this->relations)) $this->load('soldCount');

        $related = $this->getRelation('soldCount')->first();

        return ($related) ? $related->aggregate : 0;
    }




}
