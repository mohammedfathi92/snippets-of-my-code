<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Collection extends Model
{
    protected $fillable = ['premium_id','contract_id','premium_date','call_date','phone','call_status','notes','created_by','date_cancellation','client_id'];


    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function premium(){
        return $this->belongsTo(ContractPremium::class);
    }

}
