<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
   
    protected $table = 'reviews';

    protected $fillable = ['id','amount', 'module_type', 'module_id'];

    

}
