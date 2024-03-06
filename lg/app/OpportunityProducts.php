<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpportunityProducts extends Model
{
    protected $table="opportunity_products";

    function opportunity(){
        return $this->belongsTo("App\Opportunity","opportunity_id");
    }

}
