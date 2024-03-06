<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Account extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.account';
    protected $table = "erp_accounts";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public $translatable = ['translated_name', 'description', 'notes'];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

        public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Currency::class, 'value_currency_id');
    }

}
