<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LandingBlock extends Model
{
 
    protected $fillable = ['block_type', 'block_name', 'original_url', 'html_code', 'loader_function', 'height', 'global', 'order', 'status'];
    protected $table = "landing_blocks";


   function pages()
    {
        return $this->belongsTo(LandingPage::class, 'page_id');
    }


}
