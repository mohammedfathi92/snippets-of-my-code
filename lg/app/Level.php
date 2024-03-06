<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Level extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $table = "levels";
    protected $fillable = ['photo', 'parent_id', 'target', 'min'];
    public $translatedAttributes = ['name', 'description'];

    function parent()
    {
        return $this->belongsTo("App\Level", "parent_id");
    }

    function children()
    {
        return $this->hasMany("App\Level", "parent_id");
    }

    function members(){

     return DB::table("users")->join("opportunities",function ($join){
            $join->on("users.id","=","opportunities.user_id");
        })->havingRaw("SUM(opportunities.total_price) >  $this->min ")
         ->havingRaw("SUM(opportunities.total_price) <  $this->target ")->get();


    }
}
