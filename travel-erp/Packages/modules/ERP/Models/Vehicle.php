<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class Vehicle extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.vehicle';
    protected $table = "erp_vehicles";

    public $translatable = ['name','description','notes'];



    protected static $logAttributes = [];

    protected $guarded = ['id'];



    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
            public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
        public function driver(){
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
