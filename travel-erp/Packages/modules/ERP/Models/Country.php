<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
 use Spatie\Translatable\HasTranslations;


class Country extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.Country';
    protected $table = "erp_countries";

    protected static $logAttributes = [];

    public $translatable = ['name','description'];
    
    protected $guarded = ['id'];
    

    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function cities(){
        return $this->hasMany(City::class, 'country_id');
    }

        public function drivers(){
        return $this->hasMany(Driver::class, 'country_id');
    }

    public function providers(){
        return $this->hasMany(Provider::class, 'country_id');
    }


}
