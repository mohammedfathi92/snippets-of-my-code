<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use SoftDeletes;
    public $timestamps=true;
    protected $table = "opportunities";
    protected $fillable = ['client_name', 'details', 'deliver_at', 'delivered_at', 'user_id', 'updated_by', 'progress', 'status', 'status_changed_by', 'total_price'];

    function user()
    {
        return $this->belongsTo("App\User");
    }

    function statusChanger()
    {
        return $this->belongsTo("App\User", 'status_changed_by');
    }

    function updater()
    {
        return $this->belongsTo("App\User", 'updated_by');
    }

    function products(){
        return $this->belongsToMany("App\Product","opportunities_products",'opportunity_id','product_id')->withPivot(['category_id','quantity','price']);
    }
}
