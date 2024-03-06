<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractPremium extends Model
{
	use SoftDeletes;
    protected $table = 'contract_premiums';


    public function contract()
    {
        return $this->belongsTo(Contract::class,'contract_id');
    }
}



