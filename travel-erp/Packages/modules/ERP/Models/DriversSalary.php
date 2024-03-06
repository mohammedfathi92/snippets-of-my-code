<?php

namespace Packages\Modules\ERP\Models;

use Packages\Modules\ERP\Models\UserErp;
use Packages\Modules\ERP\Models\Driver;


class DriverSalary extends UserErp
{
   

    public $config = 'erp.models.customer';
    protected $table = "erp_drivers_salaries";
   
    
    protected $guarded = ['id'];


    public function driver(){
    	return $this->belongsTo(Driver::class,'user_id');
    }


  
}
