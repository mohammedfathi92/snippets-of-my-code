<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use Packages\Modules\ERP\Models\Order;


class Voucher extends BaseModel
{
	    use PresentableTrait, LogsActivity ,HasTranslations;

   
    protected $table = "erp_vouchers";

   public $translatable = ['text_html_content','web_html_content'];
   protected static $logAttributes = [];
   
    
    protected $guarded = ['id'];

     public function order(){
    	return $this->belongsTo(Order::class,'order_id');
    }


  
}
