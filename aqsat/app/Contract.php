<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    protected $fillable = ['investor_id','client_id','sponsor_id','sponsor_two_id','group_id','created_by',
                            'contract_date','premiums_date_type','schedule_type','premiums_start_date','contract_value',
                            'total_profit','first_payment','account_id','premiums_number'
                           ,'payment_date','premiums_value','last_premium','contract_profit','quittance',
                            'contract_type','kind','premiums_start_date_hijry','profit_type','profit_pay_type', 'contract_num','fees','commission_account','contract_profit_payment'];


    public function products()
    {
        return $this->belongsToMany(Product::class,'contract_product')
            ->withTimestamps()->withPivot('price', 'quantity','first_payment');
    }


    public function investor()
    {
        return $this->belongsTo(User::class,'investor_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(User::class,'sponsor_id');
    }

    public function sponsor_two()
    {
        return $this->belongsTo(User::class,'sponsor_two_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function contract_premium()
    {
        return $this->hasMany(ContractPremium::class,'contract_id');
    }

    public function notes(){
        return $this->hasMany(Note::class,'module_id');
    }

    public function financial_transactions(){
        return $this->hasMany(Financial_transaction::class,'contract_id');
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function collections()
    {
        return $this->hasManyThrough(Collection::class, ContractPremium::class,'contract_id','premium_id');
    }


    public function profits(){
        return $this->hasMany(Profit::class,'contract_id');
    }
}
