<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financial_transaction extends Model
{
    protected $fillable = ['user_id','to_user','to_account','type','notes','price','contract_id', 'premium_id', 'account_id','product_id','target_id',
        'created_by','updated_by','created_at'];

    public function company_account(){
        return $this->belongsTo(Company_account::class,'account_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function target(){
        return $this->belongsTo(Target::class,'target_id');
    }


    public function employee(){
        return $this->belongsTo(User::class,'created_by');
    }
}
