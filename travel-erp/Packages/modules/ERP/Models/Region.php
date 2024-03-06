<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Region extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.region';
    protected $table = "world_continents";

    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function counries(){
    	return $this->hasMany(Country::class, 'continent_id');
    }
}
