<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Activity extends BaseModel
{
    use PresentableTrait, LogsActivity,HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.activity';
    protected $table = "erp_activities";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public $translatable = ['name','description','notes'];


    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    
}
