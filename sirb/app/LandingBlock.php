<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LandingBlock extends Model
{
 
    protected $fillable = ['data_ids','is_dynamic','block_type', 'order', 'status','page_id', "country_id","city_id","category_id","lang",'description','content','amount'];
    protected $table = "landing_blocks";


   function page()
    {
        return $this->belongsTo(LandingPage::class, 'page_id');
    }
   

  


}
