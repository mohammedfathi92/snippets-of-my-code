<?php

namespace Packages\Modules\ERP\Models;

use Packages\Modules\ERP\Models\UserErp;


class Driver extends UserErp
{
   

    public $config = 'erp.models.customer';
    protected $table = "users";
   
    
    protected $guarded = ['id'];

     public function salary(){
    	return $this->hasOne(DriverSalary::class,'user_id');
    }


  
}
