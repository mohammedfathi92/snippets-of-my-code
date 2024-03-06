<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintTemplate extends Model
{
    protected $fillable = ['type','content','created_by','updated_by'];

    protected $table = 'print_templates';



}
