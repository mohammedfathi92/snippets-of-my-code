<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profit extends Model
{
    protected $fillable = ['contract_id','client_id','premium_id','paid'];
}
