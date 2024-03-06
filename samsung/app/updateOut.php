<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class updateOut extends Model
{
    protected $table="update_out";
    public $timestamps=false;
    protected $fillable=['table_name','action','action_id','query'];
}
