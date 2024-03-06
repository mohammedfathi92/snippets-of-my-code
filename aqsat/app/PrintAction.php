<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintAction extends Model
{
    protected $fillable = ['module','module_id','content','user_id','template_id','created_by','updated_by'];

    protected $table = 'print_actions';



}
