<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Financial extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.financials';
    protected $table = "erp_financials";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public $translatable = ['description', 'notes','extra_update_reasons'];

        public function itemable()
    {

        return $this->morphTo();
    }

    public function to_user(){
        return $this->belongsTo(UserErp::class, 'to_user_id');
    }

    public function from_user(){
        return $this->belongsTo(UserErp::class, 'from_user_id');
    }

    public function to_account(){
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    public function from_account(){
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

public function parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

       public function data_created_by(){
        return $this->belongsTo(UserErp::class, 'created_by');
    }

           public function data_updated_by(){
        return $this->belongsTo(UserErp::class, 'updated_by');
    }

   public function recipient(){
        return $this->belongsTo(UserErp::class, 'recipient_id');
    }

       public function pay_method(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Category::class, 'pay_method_id');
    }

    public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Currency::class, 'value_currency_id');
    }

}
